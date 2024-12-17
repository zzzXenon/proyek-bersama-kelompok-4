<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use App\Models\PelanggaranLog;
use App\Models\ListPelanggaran;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PelanggaranController extends Controller
{
    protected function getPoinPelanggaran()
    {
        if (Auth::user()->role === 'Keasramaan') {
            return ListPelanggaran::where('tingkat', 'LIKE', '%Ringan%')
                ->orWhere('tingkat', 'LIKE', '%Sedang%')
                ->get();
        }

        return ListPelanggaran::all();
    }

    public function create()
    {
        // Use the helper function
        $poinPelanggaran = $this->getPoinPelanggaran();

        // Return the form view
        return view('fitur.addPelanggaran', compact('poinPelanggaran'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'angkatan' => 'required|string',
            'prodi' => 'required|string',
            'nim' => 'required|string',
            'nama' => 'required|string',
            'list_pelanggaran_id' => 'required|exists:list_pelanggaran,id',
            'comment' => 'required|string|max:500', // Validate the comment field
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // Optional file validation for comment
        ]);

        // Find the user by their details
        $user = User::where('angkatan', $request->angkatan)
            ->where('prodi', $request->prodi)
            ->where('nim', $request->nim)
            ->where('nama', $request->nama)
            ->first();

        // Check if the user exists and has the correct role
        if (!$user || $user->role !== 'Orang Tua') {
            return redirect()->route('pelanggaran.create')->withErrors([
                'user' => 'Mahasiswa tidak ditemukan!',
            ])->withInput();
        }

        try {
            // Fetch the related 'list_pelanggaran' record
            $listPelanggaran = ListPelanggaran::findOrFail($request->list_pelanggaran_id);

            // Determine the initial 'level' and 'status' based on the 'tingkat' attribute
            $level = null;
            $status = 'Sedang diproses'; // Default status

            if (str_contains($listPelanggaran->tingkat, 'Berat')) {
                $level = 'Level 1'; // Start the process at Level 1 for Pelanggaran Berat
            } elseif (str_contains($listPelanggaran->tingkat, 'Ringan') || str_contains($listPelanggaran->tingkat, 'Sedang')) {
                $level = null;  // Set level to null for Ringan/Sedang Pelanggaran
                $status = 'Selesai'; // Set status to 'Selesai' for Ringan/Sedang Pelanggaran
            }

            // Create the pelanggaran record
            $pelanggaran = Pelanggaran::create([
                'user_id' => $user->id,
                'list_pelanggaran_id' => $request->list_pelanggaran_id,
                'status' => $status, // Set the status
                'level' => $level, // Set the process level
            ]);

            // Handle file upload for comment
            $filePath = null;
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('pelanggaran_files', 'public');
            }

            // Create the comment for the pelanggaran
            Comment::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'comment' => $request->comment,
                'file_path' => $filePath,
            ]);

            // Log the action for comment creation
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Create Pelanggaran',
                'details' => $request->comment,
            ]);

            // Redirect to the dashboard with a success message
            return redirect()->route('dashboard.admin')->with('success', 'Pelanggaran berhasil dibuat dan komentar berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            Log::error('Gagal membuat pelanggaran atau komentar: ' . $e->getMessage());

            return redirect()->route('pelanggaran.create')->withErrors([
                'general' => 'Terjadi kesalahan saat membuat Pelanggaran atau menambahkan komentar. Silakan coba lagi.',
            ])->withInput();
        }
    }

    public function showPelanggaranMhs()
    {
        $userId = Auth::id();

        // Get the list of violations (pelanggaran) for the authenticated user
        $pelanggaran = Pelanggaran::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return to the view
        return view('fitur.pelanggaranMahasiswa', compact('pelanggaran'));
    }

    public function showDetailMahasiswa($id)
    {
        // Retrieve the pelanggaran record by its ID
        $pelanggaran = Pelanggaran::findOrFail($id);

        // Fetch logs with user data (role and name) using a join on the 'users' table
        $pelanggaranLogs = PelanggaranLog::where('pelanggaran_id', $id)
            ->join('users', 'pelanggaran_logs.user_id', '=', 'users.id')  // Join the 'users' table
            ->select(
                'pelanggaran_logs.*',  // Select all columns from pelanggaran_logs
                'users.nama as user_nama',  // Select 'nama' as 'user_nama' from the users table
                'users.role as user_role'  // Select 'role' as 'user_role' from the users table
            )
            ->orderBy('pelanggaran_logs.created_at', 'desc')
            ->get();

        // Pass the data to the view
        return view('fitur.detailMahasiswa', [
            'pelanggaran' => $pelanggaran,
            'pelanggaranLogs' => $pelanggaranLogs
        ]);
    }

    public function showComments($id)
    {
        // Fetch the pelanggaran record with related comments, user, and listPelanggaran data
        $pelanggaran = Pelanggaran::with(['user', 'listPelanggaran', 'comments.user'])->findOrFail($id);

        // Get the level attribute and the currently authenticated user
        $level = $pelanggaran->level;
        $user = Auth::user();

        // Check for unauthorized access based on the level and user role
        if ($user->role === 'Dosen' && $level !== 'Level 1') {
            // Dosen can only view Level 1
            return view('fitur.detailAdmin-no-response', compact('pelanggaran'));
        }

        if ($user->role === 'Komisi Disiplin' && in_array($level, ['Level 4', 'Level 5'])) {
            // Komisi Disiplin cannot view Level 4 or Level 5
            return view('fitur.detailAdmin-no-response', compact('pelanggaran'));
        }

        if ($user->role === 'Kemahasiswaan' && in_array($level, ['Level 1', 'Level 3', 'Level 4'])) {
            // Kemahasiswaan cannot view Level 1, Level 3, or Level 4
            return view('fitur.detailAdmin-no-response', compact('pelanggaran'));
        }

        if ($level === 'Level 5') {
            return view('fitur.detailAdmin-no-response', compact('pelanggaran'));
        }

        // If authorized, show the comments page
        return view('fitur.detailPelanggaran', compact('pelanggaran'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // Optional file validation
        ]);

        $pelanggaran = Pelanggaran::findOrFail($id);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('files', 'public');
        }

        Comment::create([
            'pelanggaran_id' => $pelanggaran->id,
            'user_id' => $request->user()->id,
            'comment' => $request->comment,
            'file_path' => $filePath,
        ]);

        // Log the action for comment creation
        PelanggaranLog::create([
            'pelanggaran_id' => $pelanggaran->id,
            'user_id' => $request->user()->id,
            'action' => 'New Comment Added',
            'details' => $request->comment,
        ]);

        // Check if the user is 'Dosen' and the current level is 'Level 1'
        if ($request->user()->role === 'Dosen' && $pelanggaran->level === 'Level 1') {
            // Update level to 'Level 2'
            $pelanggaran->level = 'Level 2';
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Level Updated',
                'details' => 'Level changed to Level 2 by Dosen Wali',
            ]);
        }

        // Check if the user is 'Komisi Disiplin' and the current level is 'Level 3'
        if ($request->user()->role === 'Komisi Disiplin' && $pelanggaran->level === 'Level 3') {
            // Update level to 'Level 3'
            $pelanggaran->level = 'Level 4';
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Level Updated',
                'details' => 'Level changed to Level 4 by Komisi Disiplin',
            ]);
        }

        // Check if the user is 'Rektor' and the current level is 'Level 4'
        if ($request->user()->role === 'Rektor' && $pelanggaran->level === 'Level 4') {
            // Update status to 'Selesai'
            $pelanggaran->status = 'Selesai';

            // Log the status update
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Status Updated',
                'details' => 'Status changed to Selesai by Rektor',
            ]);

            // Now update the level using the existing updateLevel method
            $this->updateLevel($request, $pelanggaran); // Calls the updateLevel method to transition to 'Level 5'
        } else {
            // If the action involves level changes like 'Kemahasiswaan' moving to 'Level 3' or 'Level 4'
            if ($request->has('action')) {
                $this->updateLevel($request, $pelanggaran);
            }
        }

        // Save the changes (status and level)
        $pelanggaran->save();

        // Redirect to the admin dashboard after the comment is added and level is updated
        return redirect()->route('dashboard.admin')
            ->with('success', 'Berhasil membuat tanggapan dan mengupdate level!');
    }

    public function updateLevel(Request $request, $pelanggaran)
    {
        // Get the current level of the pelanggaran
        $currentLevel = $pelanggaran->level;

        // Check if the current level is 'Level 1' and handle transition to 'Level 2'
        if ($currentLevel === 'Level 1') {
            $pelanggaran->level = 'Level 2';
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Level Updated',
                'details' => 'Level changed to Level 2 by Dosen Wali',
            ]);
        }
        // Check if the current level is 'Level 2' and handle transitions to 'Level 3' or 'Level 4'
        elseif ($currentLevel === 'Level 2') {
            if ($request->action == 'level_3') {
                // Move to Level 3 (Komdis)
                $pelanggaran->level = 'Level 3';
                PelanggaranLog::create([
                    'pelanggaran_id' => $pelanggaran->id,
                    'user_id' => $request->user()->id,
                    'action' => 'Level Updated',
                    'details' => 'Level changed to Level 3 by Kemahasiswaan',
                ]);
            } elseif ($request->action == 'level_4') {
                // Move to Level 4 (Rektor)
                $pelanggaran->level = 'Level 4';
                PelanggaranLog::create([
                    'pelanggaran_id' => $pelanggaran->id,
                    'user_id' => $request->user()->id,
                    'action' => 'Level Updated',
                    'details' => 'Level changed to Level 4 by Kemahasiswaan',
                ]);
            }
            // Check if the current level is 'Level 3' and handle transition to 'Level 4'
        } elseif ($currentLevel === 'Level 3') {
            $pelanggaran->level = 'Level 4';
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Level Updated',
                'details' => 'Level changed to Level 4 by Komisi Disiplin',
            ]);
        }
        // Check if the current level is 'Level 4' and handle transition to 'Level 5'
        elseif ($currentLevel === 'Level 4') {
            // Automatically move to Level 5 (Rektor's action)
            $pelanggaran->level = 'Level 5';
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Level Updated',
                'details' => 'Level changed to Level 5 by Rektor',
            ]);
        }

        // Save the changes
        $pelanggaran->save();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
  public function home()
  {
    $user = Auth::user();
    if (!$user) {
      return redirect()->route('login');
    }
    if ($user->role === 'Orang Tua') {
      return redirect()->route('dashboard.orangtua');
    }
    return redirect()->route('dashboard.admin');
  }

  public function showDashboardOrangtua()
  {
    if (Gate::denies('access-ortu')) {
      abort(403, 'Unauthorized action.');
    }

    $user = Auth::user();

    // Cek apakah pengguna ada
    if (!$user) {
      return redirect()->route('home');
    }

    // Ambil data pelanggaran yang diurutkan berdasarkan created_at secara descending dan paginated
    $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')
      ->whereHas('user', function ($query) use ($user) {
        $query->where('wali', $user->nama);
      })
      ->orderBy('created_at', 'desc')
      ->paginate(10); // 10 item per halaman

    // Pass data ke view dengan benar
    return view('dashboard.orangtua', compact('pelanggaran', 'user'));
  }

  public function showDashboardAdmin()
  {
    if (Gate::denies('access-admin')) {
      abort(403, 'Unauthorized action.');
    }

    $user = Auth::user();
    $pelanggaranQuery = Pelanggaran::with('user', 'listPelanggaran');

    // Filter pelanggaran data based on roles and levels
    if ($user->role === 'Dosen') {
      // Dosen Wali: Only see pelanggaran assigned to students where 'wali' matches the Dosen's name
      $pelanggaran = $pelanggaranQuery->whereHas('user', function ($query) use ($user) {
        $query->where('wali', $user->nama);
      })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    } elseif ($user->role === 'Komisi Disiplin') {
      // Komisi Disiplin: See Level 3, 4, and 5
      $pelanggaran = $pelanggaranQuery->where(function ($query) {
        $query->where('level', 'Level 3')
          ->orWhere('level', 'Level 4')
          ->orWhere('level', 'Level 5');
      })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    } elseif ($user->role === 'Rektor') {
      // Rektor: See both Level 4 and Level 5
      $pelanggaran = $pelanggaranQuery->where(function ($query) {
        $query->where('level', 'Level 4')
          ->orWhere('level', 'Level 5');
      })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    } elseif ($user->role === 'Kemahasiswaan' || $user->role === 'Keasramaan') {
      // Kemahasiswaan & Keasramaan: View all pelanggaran
      $pelanggaran = $pelanggaranQuery->orderBy('created_at', 'desc')->paginate(10);
    } else {
      // Default: admin has master access
      $pelanggaran = $pelanggaranQuery->orderBy('created_at', 'desc')->paginate(10);
    }

    // Filter for "Pelanggaran Butuh Tanggapan" (violations that need immediate response)
    $urgentPelanggaran = collect();  // Empty collection by default

    // Update logic for "Butuh Tanggapan" based on role and level
    if ($user->role === 'Dosen') {
      // Dosen: Show pelanggaran with level "Level 1" that need immediate response
      $urgentPelanggaran = Pelanggaran::where('level', 'Level 1')
        ->where('status', 'Sedang diproses')
        ->whereHas('user', function ($q) use ($user) {
          $q->where('wali', $user->nama);
        })->get();
    } elseif ($user->role === 'Kemahasiswaan') {
      // Kemahasiswaan: Show pelanggaran with level "Level 2" that need immediate response
      $urgentPelanggaran = Pelanggaran::where('level', 'Level 2')
        ->where('status', 'Sedang diproses')
        ->get();
    } elseif ($user->role === 'Komisi Disiplin') {
      // Komisi Disiplin: Show pelanggaran with level "Level 3" that need immediate response
      $urgentPelanggaran = Pelanggaran::where('level', 'Level 3')
        ->where('status', 'Sedang diproses')
        ->get();
    } elseif ($user->role === 'Rektor') {
      // Rektor: Show pelanggaran with level "Level 4" that need immediate response
      $urgentPelanggaran = Pelanggaran::where('level', 'Level 4')
        ->where('status', 'Sedang diproses')
        ->get();
    }

    // Pass data to the view with pagination and urgent pelanggaran
    return view('dashboard.admin', compact('pelanggaran', 'urgentPelanggaran'));
  }

  public function search(Request $request)
  {
    $request->validate([
      'kategori' => 'required|string|in:nama,nim,status,nama_pelanggaran',
      'search' => 'required|string',
    ]);

    $kategori = $request->input('kategori');
    $search = $request->input('search');

    $user = Auth::user();

    $query = Pelanggaran::with('user', 'listPelanggaran');

    // Terapkan filter berdasarkan role
    if ($user->role === 'Orang Tua') {
      $query->where('user_id', $user->id);
    }

    switch ($kategori) {
      case 'nama':
        $query->whereHas('user', function ($q) use ($search) {
          $q->where('nama', 'like', "%{$search}%");
        });
        break;
      case 'nim':
        $query->whereHas('user', function ($q) use ($search) {
          $q->where('nim', 'like', "%{$search}%");
        });
        break;
      case 'status':
        $query->where('status', 'like', "%{$search}%");
        break;
      case 'nama_pelanggaran':
        $query->whereHas('listPelanggaran', function ($q) use ($search) {
          $q->where('nama_pelanggaran', 'like', "%{$search}%");
        });
        break;
      default:
        return redirect()->back()->withErrors('Kategori tidak valid');
    }

    $pelanggaran = $query->orderBy('created_at', 'desc')->paginate(10);

    // Tentukan view berdasarkan role
    if ($user->role === 'Orang Tua') {
      return view('fitur.pelanggaranMahasiswa', compact('pelanggaran', 'user'));
    } else {
      return view('dashboard.admin', compact('pelanggaran'));
    }
  }
}

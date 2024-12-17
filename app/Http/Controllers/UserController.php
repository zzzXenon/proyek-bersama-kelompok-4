<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showStudentProfile($id)
    {
        // Fetch user data based on ID
        $student = User::where('id', $id)
            ->select('nama as name', 'angkatan', 'nim', 'username', 'email', 'kelas', 'prodi', 'wali', 'image')
            ->first();

        // If student not found, redirect with error message
        if (!$student) {
            return redirect()->back()->with('error', 'Data Mahasiswa tidak ditemukan.');
        }

        // Pass data to the view
        return view('infoMahasiswa', compact('student'));
    }
}

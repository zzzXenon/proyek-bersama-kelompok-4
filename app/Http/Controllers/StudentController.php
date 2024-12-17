<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
  public function showProfile()
  {
      // Data mahasiswa (gunakan data contoh atau dari database)
      $student = [
          'name' => 'Mario Agustin Sijabat',
          'angkatan' => 2022,
          'nim' => '11S22030',
          'username' => 'ifs22030',
          'email' => 'ifs22030@students.del.ac.id',
          'kelas' => '13IF2',
          'prodi' => 'S1 Informatika',
          'wali' => 'Iustisia Natalia Simbolon, S.Kom., M.T.',
      ];
  
      // Kirim data ke view
      return view('view-1.infoMahasiswa', compact('student'));
  }  
}

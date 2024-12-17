<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'nama' => 'Mario Sijabat',
                'username' => 'ifs22030',
                'password' => Hash::make('admin'),
                'angkatan' => '2022',
                'nim' => '11S22030',
                'email' => 'mariosijabat@del.ac.id',
                'kelas' => 'Kelas A',
                'prodi' => 'S1 Informatika',
                'wali' => 'Iustisia Natalia Simbolon, S.Kom., M.T.',
                'role' => 'Orang Tua',
                'image' => '/img/pp.jpg'
            ],
            [
                'nama' => 'Dr. Arnaldo Marulitua Sinaga, S.T, M.InfoTech',
                'username' => 'rektor',
                'password' => Hash::make('admin'),
                'angkatan' => null,
                'nim' => null,
                'email' => 'ArnaldoSinaga@del.ac.id',
                'kelas' => null,
                'prodi' => null,
                'wali' => null,
                'role' => 'Rektor',
            ],
            [
                'nama' => 'Pdt. Leonal Ady Winata Purba, M.Th',
                'username' => 'asrama1',
                'password' => Hash::make('admin'),
                'angkatan' => null,
                'nim' => null,
                'email' => 'leonalpurba@del.ac.id',
                'kelas' => null,
                'prodi' => null,
                'wali' => null,
                'role' => 'Keasramaan',
            ],
            [
                'nama' => 'Pdt. Kristin Juliana Siahaan, S.Th',
                'username' => 'asrama2',
                'password' => Hash::make('admin'),
                'angkatan' => null,
                'nim' => null,
                'email' => 'kristinsiahaan@del.ac.id',
                'kelas' => null,
                'prodi' => null,
                'wali' => null,
                'role' => 'Keasramaan',
            ],
            [
                'nama' => 'Pdt. Irianto Sitorus, S.Th',
                'username' => 'asrama3',
                'password' => Hash::make('admin'),
                'angkatan' => null,
                'nim' => null,
                'email' => 'iriantositorus@del.ac.id',
                'kelas' => null,
                'prodi' => null,
                'wali' => null,
                'role' => 'Keasramaan',
            ],
            [
                'nama' => 'Melva Sabar Maria Hutagalung, S.Sos',
                'username' => 'melva',
                'password' => Hash::make('admin'),
                'angkatan' => null,
                'nim' => null,
                'email' => 'melvahutagalung@del.ac.id',
                'kelas' => null,
                'prodi' => null,
                'wali' => null,
                'role' => 'Kemahasiswaan',
            ],
            [
                'nama' => 'Yoke April Lia Purba, S.Kom',
                'username' => 'yokepurba',
                'password' => Hash::make('admin'),
                'angkatan' => null,
                'nim' => null,
                'email' => 'yokepurba@del.ac.id',
                'kelas' => null,
                'prodi' => null,
                'wali' => null,
                'role' => 'Komisi Disiplin',
            ],
            [
                'nama' => 'Dr. Johannes Harungguan Sianipar, S.T., M.T.',
                'username' => 'johannes',
                'password' => Hash::make('admin'),
                'angkatan' => null,
                'nim' => null,
                'email' => 'johannessianipar@del.ac.id',
                'kelas' => null,
                'prodi' => 'S1 Informatika',
                'wali' => null,
                'role' => 'Dosen',
            ],
            [
                'nama' => 'Dr. Arlinta Christy Barus, ST., M.InfoTech.',
                'username' => 'arlinta',
                'password' => Hash::make('admin'),
                'angkatan' => null,
                'nim' => null,
                'email' => 'arlintabarus@del.ac.id',
                'kelas' => null,
                'prodi' => 'S1 Informatika',
                'wali' => null,
                'role' => 'Dosen',
            ],
            [
                'nama' => 'Iustisia Natalia Simbolon, S.Kom., M.T.',
                'username' => 'iustisia',
                'password' => Hash::make('admin'),
                'angkatan' => null,
                'nim' => null,
                'email' => 'iustisiasimbolon@del.ac.id',
                'kelas' => null,
                'prodi' => 'S1 Informatika',
                'wali' => null,
                'role' => 'Dosen',
            ],
            [
                'nama' => 'Herimanto, S.Kom., M.Kom',
                'username' => 'herimanto',
                'password' => Hash::make('admin'),
                'angkatan' => null,
                'nim' => null,
                'email' => 'herimanto@del.ac.id',
                'kelas' => null,
                'prodi' => 'S1 Informatika',
                'wali' => null,
                'role' => 'Dosen',
            ],
            [
                'nama' => 'Ranty Deviana Siahaan, S.Kom, M.Eng.',
                'username' => 'ranty',
                'password' => Hash::make('admin'),
                'angkatan' => null,
                'nim' => null,
                'email' => 'rantysiahaan@del.ac.id',
                'kelas' => null,
                'prodi' => 'S1 Informatika',
                'wali' => null,
                'role' => 'Dosen',
            ],
        ];

        // Loop untuk menambah setiap user ke dalam tabel 'users'
        foreach ($users as $user) {
            User::create($user);
        }
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'password' => Hash::make('admin'),
            'angkatan' => $this->faker->year,
            'nim' => $this->faker->unique()->numerify('11S#####'),
            'email' => $this->faker->unique()->safeEmail,
            'kelas' => $this->faker->randomElement(['Kelas A', 'Kelas B', 'Kelas C']),
            'prodi' => $this->faker->randomElement(['S1 Informatika', 'S1 Sistem Informasi', 'S1 Teknik Elektro', 'S1 Teknik Bioproses']),
            'wali' => $this->faker->name,
            'role' => $this->faker->randomElement(['Orang Tua', 'Dosen', 'Keasramaan', 'Kemahasiswaan']),
        ];
    }
}

<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    public function accessOrtu(User $user)
    {
        return $user->role === 'Orang Tua';
    }

    public function accessDosen(User $user)
    {
        return $user->role === 'Dosen';
    }

    public function accessKeasramaan(User $user)
    {
        return $user->role === 'Keasramaan';
    }

    public function accessKemahasiswaan(User $user)
    {
        return $user->role === 'Kemahasiswaan';
    }

    public function accessAdmin(User $user)
    {
        $allowedRoles = ['Keasramaan', 'Kemahasiswaan', 'Dosen', 'Komisi Disiplin', 'Rektor'];

        return in_array($user->role, $allowedRoles);
    }

    public function accessKemKem(User $user)
    {
        $allowedRoles = ['Keasramaan', 'Kemahasiswaan'];

        return in_array($user->role, $allowedRoles);
    }
}

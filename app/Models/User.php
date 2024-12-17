<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'username',
        'password',
        'angkatan',
        'nim',
        'email',
        'kelas',
        'prodi',
        'wali',
        'image',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getVisibleAttributesByRole($role)
    {
        if ($role === 'Orang Tua') {
            return $this->only([
                'nama',
                'username',
                'angkatan',
                'nim',
                'email',
                'kelas',
                'prodi',
                'wali',
                'image',
            ]);
        }

        // For other roles, return only limited fields
        return $this->only([
            'nama',
            'username',
        ]);
    }

    public function pelanggarans()
    {
        return $this->hasMany(Pelanggaran::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function getRoleAttribute($value)
    {
        return ucfirst($value);
    }

    public function adminlte_image()
    {
        return asset('/img/shutdown.png'); // Pastikan file ada di 'public/images/'
    }
}

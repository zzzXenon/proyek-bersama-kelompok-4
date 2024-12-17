<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class ListPelanggaran extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'list_pelanggaran';

    protected $fillable = [
        'nama_pelanggaran',
        'poin',
        'tingkat',
    ];

    public function pelanggarans()
    {
        return $this->hasMany(Pelanggaran::class, 'list_pelanggaran_id');
    }
}

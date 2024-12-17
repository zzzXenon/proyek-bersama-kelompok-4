<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelanggaranLog extends Model
{
    protected $table = 'pelanggaran_logs';

    protected $fillable = [
        'pelanggaran_id',
        'user_id',
        'action',
        'details',
    ];

    // Relationships
    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

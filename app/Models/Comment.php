<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'pelanggaran_id',
        'user_id',
        'comment',
        'file_path',
    ];

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

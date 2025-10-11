<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [
        'user_id', 'judul_laporan', 'deskripsi', 'lokasi_mesin', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class);
    }
}


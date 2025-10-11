<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'pengaduan_id', 'teknisi_id', 'tanggal_perbaikan', 'hasil_perbaikan'
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class);
    }
}

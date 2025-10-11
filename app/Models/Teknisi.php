<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    protected $fillable = [
        'nama', 'email', 'telepon', 'keahlian'
    ];

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}

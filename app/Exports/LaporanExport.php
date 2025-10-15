<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $tanggal_awal, $tanggal_akhir;

    public function __construct($tanggal_awal, $tanggal_akhir)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
    }

    public function collection()
    {
        return Pengaduan::whereBetween('created_at', [$this->tanggal_awal, $this->tanggal_akhir])
            ->select('kode_pengaduan', 'nama_pelapor', 'lokasi_mesin', 'status', 'created_at')
            ->get();
    }

    public function headings(): array
    {
        return ['Kode Pengaduan', 'Nama Pelapor', 'Lokasi Mesin', 'Status', 'Tanggal'];
    }
}

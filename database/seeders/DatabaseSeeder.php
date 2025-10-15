<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pengaduan;
use App\Models\Teknisi;
use App\Models\Laporan;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@example.com',
            'phone' => '081234000000',
            'departemen' => '',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        $departemenList = ['produksi', 'pemeliharaan', 'quality_control', 'logistik'];
        $roleList = ['user', 'teknisi'];
        $users = User::factory()
            ->count(8)
            ->create([
                'departemen' => $departemenList[array_rand($departemenList)],
                'password' => bcrypt('password'),
                'role' => $roleList[array_rand($roleList)],
            ]);


        $pengaduans = collect($users)->flatMap(function ($user) {
            return collect([
                [
                    'nama_mesin' => 'Mesin Produksi A1',
                    'jabatan_pelapor' => 'Operator Mesin',
                    'departemen' => 'Produksi',
                    'keterangan' => 'Mesin tidak menyala sama sekali sejak pagi.',
                    'status' => 'menunggu',
                ],
                [
                    'nama_mesin' => 'Mesin A3',
                    'jabatan_pelapor' => 'Teknisi Lapangan',
                    'departemen' => 'Maintenance',
                    'keterangan' => 'Terjadi kebocoran oli di bagian bawah mesin.',
                    'status' => 'diproses',
                ],
                [
                    'nama_mesin' => 'Panel Listrik Utama',
                    'jabatan_pelapor' => 'Staff Gudang',
                    'departemen' => 'Gudang',
                    'keterangan' => 'Percikan api terlihat di panel utama.',
                    'status' => 'selesai',
                ],
            ])->map(function ($data) use ($user) {
                return Pengaduan::create([
                    'user_id' => $user->id,
                    'nama_pelapor' => $user->name,
                    'jabatan_pelapor' => $data['jabatan_pelapor'],
                    'departemen' => $data['departemen'],
                    'nama_mesin' => $data['nama_mesin'],
                    'tanggal_laporan' => now()->subDays(rand(0, 10)),
                    'keterangan' => $data['keterangan'],
                    'status' => $data['status'],
                ]);
            });
        });
    }
}

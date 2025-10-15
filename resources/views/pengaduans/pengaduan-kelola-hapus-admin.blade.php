@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md">
        <div class="p-4 border-b">
            <h2 class="text-lg font-semibold">Halo, {{ Auth::user()->name }}</h2>
        </div>

        <nav class="p-4">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-home"></i><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pengaduan') }}" class="flex items-center space-x-2 text-blue-600 font-semibold">
                        <i class="fas fa-clipboard-list"></i><span>Data Pengaduan</span>
                    </a>
                </li>
                <li x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 w-full">
                        <i class="fas fa-folder-open"></i>
                        <span>Kelola Data</span>
                        <i class="ml-auto fas fa-chevron-down text-xs" :class="{ 'rotate-180': open }"></i>
                    </button>
                    <ul x-show="open" class="pl-8 mt-2 space-y-2">
                        <li><a href="{{ route('admin.user') }}" class="block hover:text-blue-600">Data User</a></li>
                        <li><a href="{{ route('admin.teknisi') }}" class="block hover:text-blue-600">Data Teknisi</a></li>
                        <li><a href="{{ route('admin.profile') }}" class="block hover:text-blue-600">Profil Akun</a></li>
                    </ul>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-2 text-gray-700 hover:text-red-600">
                            <i class="fas fa-sign-out-alt"></i><span>Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-semibold mb-6">Data Pengaduan Kerusakan Mesin</h1>

        {{-- Tabel Data (Ringkas) --}}
        <div class="bg-white shadow rounded-lg p-6">
            <table class="w-full border border-gray-300 text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Nama</th>
                        <th class="p-2 border">Mesin</th>
                        <th class="p-2 border">Keterangan</th>
                        <th class="p-2 border">Tanggal</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduan as $index => $item)
                    <tr class="text-center">
                        <td class="border p-2">{{ $index + 1 }}</td>
                        <td class="border p-2">{{ $item->kode_pengaduan }}</td>
                        <td class="border p-2">{{ $item->nama_pelapor }}</td>
                        <td class="border p-2">{{ $item->lokasi_mesin }}</td>
                        <td class="border p-2">{{ $item->deskripsi }}</td>
                        <td class="border p-2">{{ $item->created_at->format('Y-m-d') }}</td>
                        <td class="border p-2">
                            @if($item->status == 'menunggu')
                                <span class="text-yellow-600">Sedang diajukan</span>
                            @elseif($item->status == 'diproses')
                                <span class="text-blue-600">Sedang diproses</span>
                            @else
                                <span class="text-green-600">Selesai diproses</span>
                            @endif
                        </td>
                        <td class="border p-2">
                            <a href="{{ route('admin.pengaduan.detail', $item->id) }}" class="text-blue-600 hover:underline">Detail</a> |
                            <a href="{{ route('admin.pengaduan.confirmDelete', $item->id) }}" class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Popup Konfirmasi --}}
        @if(isset($confirm) && $confirm)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-8 text-center w-96">
                <h2 class="text-xl font-bold mb-4">PERINGATAN</h2>
                <p class="mb-6 text-gray-700">Apakah anda ingin menghapus data ini?</p>
                <div class="flex justify-center space-x-6">
                    <form method="POST" action="{{ route('admin.pengaduan.delete', $pengaduanItem->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Ya</button>
                    </form>
                    <a href="{{ route('admin.pengaduan') }}" class="bg-gray-300 px-4 py-2 rounded-md hover:bg-gray-400">Tidak</a>
                </div>
            </div>
        </div>
        @endif
    </main>
</div>
@endsection

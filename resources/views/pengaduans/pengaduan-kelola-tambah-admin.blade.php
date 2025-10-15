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
        <h1 class="text-2xl font-semibold mb-6">Form Pengaduan Kerusakan Mesin</h1>

        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-3xl">
            <form action="{{ route('admin.pengaduan.store') }}" method="POST">
                @csrf

                {{-- ID Otomatis --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">ID Pengaduan</label>
                    <input type="text" value="NP{{ str_pad(($lastId ?? 0) + 1, 4, '0', STR_PAD_LEFT) }}" readonly
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Nama Pelapor --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelapor</label>
                    <input type="text" name="nama_pelapor" required class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Tanggal Laporan --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Laporan</label>
                    <input type="date" name="tanggal_laporan" value="{{ date('Y-m-d') }}" required
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Jabatan Pelapor --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan Pelapor</label>
                    <input type="text" name="jabatan_pelapor" required class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Departemen --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Departemen</label>
                    <input type="text" name="departemen" required class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Nama Mesin --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mesin</label>
                    <input type="text" name="lokasi_mesin" required class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Keterangan --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea name="deskripsi" rows="3" required class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                {{-- Tombol Simpan --}}
                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Simpan</button>
                    <a href="{{ route('admin.pengaduan') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Batal</a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

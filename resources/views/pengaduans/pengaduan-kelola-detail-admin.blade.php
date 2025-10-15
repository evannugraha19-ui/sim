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
        <h1 class="text-2xl font-semibold mb-6">Detail Pengaduan {{ $pengaduan->kode_pengaduan ?? 'NPXXXX' }}</h1>

        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
            {{-- ID dan Tanggal --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">ID Pengaduan</label>
                    <input type="text" value="{{ $pengaduan->kode_pengaduan }}" readonly class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Pengaduan</label>
                    <input type="text" value="{{ $pengaduan->created_at->format('Y-m-d') }}" readonly class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            {{-- Nama dan Jabatan --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Pelapor</label>
                    <input type="text" value="{{ $pengaduan->nama_pelapor }}" readonly class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <input type="text" value="{{ $pengaduan->jabatan_pelapor }}" readonly class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            {{-- Departemen dan Nama Mesin --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Departemen</label>
                    <input type="text" value="{{ $pengaduan->departemen }}" readonly class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Mesin</label>
                    <input type="text" value="{{ $pengaduan->lokasi_mesin }}" readonly class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            {{-- Keterangan --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea readonly rows="3" class="w-full border-gray-300 rounded-md shadow-sm">{{ $pengaduan->deskripsi }}</textarea>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <div class="flex space-x-6 mt-2">
                    <label class="flex items-center space-x-2">
                        <input type="radio" disabled {{ $pengaduan->status == 'menunggu' ? 'checked' : '' }}>
                        <span>Sedang diajukan</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" disabled {{ $pengaduan->status == 'diproses' ? 'checked' : '' }}>
                        <span>Sedang diproses</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" disabled {{ $pengaduan->status == 'selesai' ? 'checked' : '' }}>
                        <span>Selesai diproses</span>
                    </label>
                </div>
            </div>

            {{-- Catatan Petugas --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Catatan dari Petugas</label>
                <textarea readonly rows="3" class="w-full border-gray-300 rounded-md shadow-sm">{{ $pengaduan->catatan_petugas ?? '-' }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex space-x-4">
                <a href="{{ route('admin.pengaduan') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Kembali</a>
            </div>
        </div>
    </main>
</div>
@endsection

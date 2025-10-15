@extends('layout.app')

@section('content')
    @php
        $user = $user ?? ($teknisi ?? null);
        $isTeknisi = Request::is('teknisi/create') || Request::is('teknisi/*/edit');
    @endphp

    <div class="flex min-h-screen bg-gradient-to-br from-gray-800 via-amber-950 to-gray-800 text-gray-100">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 shadow-2xl border-r border-amber-900/40 relative">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
                style="background-image: radial-gradient(circle at 2px 2px, rgb(245, 158, 11) 1px, transparent 0); background-size: 28px 28px;">
            </div>

            {{-- Header --}}
            <div class="relative p-6 border-b border-amber-900/40">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="/logo.png" alt="Logo" class="w-8 h-8 object-contain">
                    <h1
                        class="text-xl font-bold bg-gradient-to-r from-amber-400 to-yellow-400 bg-clip-text text-transparent">
                        Golden Dragon
                    </h1>
                </div>
                <p class="text-sm text-amber-200/70">
                    Halo, <span class="text-amber-400 font-semibold">{{ Auth::user()->name }}</span>
                </p>
            </div>

            {{-- Navigation --}}
            <nav class="relative p-4" x-data="{ openMenu: false }">
                <ul class="space-y-1.5">
                    <li>
                        <a href="/dashboard-admin"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                            <i class="fas fa-home text-lg"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/riwayat-pengaduan"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                            <i class="fas fa-list text-lg"></i>
                            <span>Riwayat Pengaduan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/laporan"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                            <i class="fas fa-file-alt text-lg"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <li>
                        <button @click="openMenu = !openMenu"
                            class="w-full flex items-center justify-between px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-folder-open text-lg"></i>
                                <span>Kelola Data</span>
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                :class="{ 'rotate-180': openMenu }"></i>
                        </button>

                        {{-- Submenu --}}
                        <ul x-show="openMenu" x-transition class="pl-12 mt-1 space-y-1 text-amber-300/80 text-sm">
                            <li>
                                <a href="/users"
                                    class="block px-3 py-2 rounded-lg {{ Request::is('users/create') ? 'bg-amber-600/20 text-amber-100' : 'text-amber-300' }} hover:text-amber-100 hover:bg-gray-700 transition-all">
                                    <i class="fas fa-user mr-2 text-xs"></i> Data User
                                </a>
                            </li>
                            <li>
                                <a href="/teknisi"
                                    class="block px-3 py-2 rounded-lg {{ Request::is('teknisi') ? 'bg-amber-600/20 text-amber-100' : '' }} hover:text-amber-100 hover:bg-gray-700 transition-all">
                                    <i class="fas fa-user-cog mr-2 text-xs"></i> Data Teknisi
                                </a>
                            </li>
                            <li>
                                <a href="/admin/profile"
                                    class="block px-3 py-2 rounded-lg {{ Request::is('admin/profile') ? 'bg-amber-600/20 text-amber-100' : '' }} hover:text-amber-100 hover:bg-gray-700 transition-all">
                                    <i class="fas fa-id-badge mr-2 text-xs"></i> Profil Akun
                                </a>
                            </li>
                        </ul>

                    </li>
                </ul>

                {{-- Logout --}}
                <div class="mt-8 pt-4 border-t border-amber-900/40">
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-300/70 hover:text-red-400 hover:bg-red-500/10 transition-all w-full">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 bg-gray-800 text-gray-100 overflow-auto flex flex-col">
            {{-- Header --}}
            <div class="p-8 pb-4 flex justify-between items-center border-b border-amber-900/30">
                <div>
                    <h1
                        class="text-4xl font-bold mb-2 bg-gradient-to-r from-amber-400 via-yellow-400 to-orange-400 bg-clip-text text-transparent">
                        {{ $isTeknisi ? (isset($user) ? 'Edit Data Teknisi' : 'Tambah Data Teknisi') : (isset($user) ? 'Edit Data User' : 'Tambah Data User') }}
                    </h1>
                    <p class="text-amber-200/70">
                        {{ $isTeknisi ? (isset($user) ? 'Ubah informasi teknisi yang sudah ada' : 'Isi form berikut untuk menambahkan teknisi baru') : (isset($user) ? 'Ubah informasi pengguna yang sudah ada' : 'Isi form berikut untuk menambahkan pengguna baru') }}
                    </p>
                </div>

                <a href="{{ $isTeknisi ? '/teknisi' : '/users' }}"
                    class="bg-gray-700 hover:bg-gray-600 text-white font-semibold px-5 py-2.5 rounded-xl shadow-md transition-all flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>

            {{-- Form --}}
            <div class="flex-1 flex items-center justify-center p-8">
                <div class="w-full max-w-md">
                    <div class="bg-gray-900/60 border border-amber-800/40 rounded-2xl shadow-2xl p-8">
                        <form
                            action="{{ isset($user) ? ($isTeknisi ? route('teknisi.update', $user->id) : route('users.update', $user->id)) : ($isTeknisi ? route('teknisi.store') : route('users.store')) }}"
                            method="POST" class="space-y-5">
                            @csrf
                            @if (isset($user))
                                @method('PUT')
                            @endif
                            <input type="hidden" name="role" value="{{ $isTeknisi ? 'teknisi' : 'user' }}">


                            {{-- Nama --}}
                            <div>
                                <label class="block text-sm font-medium text-amber-300 mb-2" for="name">
                                    <i class="fas fa-user mr-2"></i>Nama Lengkap
                                </label>
                                <input type="text" name="name" id="name"
                                    class="w-full px-4 py-3 rounded-lg bg-gray-800/80 border border-amber-700/50 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                                    placeholder="Masukkan nama lengkap" value="{{ old('name', $user->name ?? '') }}"
                                    required>
                                @error('name')
                                    <p class="text-red-400 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-sm font-medium text-amber-300 mb-2" for="email">
                                    <i class="fas fa-envelope mr-2"></i>Email
                                </label>
                                <input type="email" name="email" id="email"
                                    class="w-full px-4 py-3 rounded-lg bg-gray-800/80 border border-amber-700/50 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                                    placeholder="contoh@email.com" value="{{ old('email', $user->email ?? '') }}" required>
                                @error('email')
                                    <p class="text-red-400 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- No. Telepon --}}
                            <div>
                                <label class="block text-sm font-medium text-amber-300 mb-2" for="phone">
                                    <i class="fas fa-phone mr-2"></i>No. Telepon
                                </label>
                                <input type="text" name="phone" id="phone"
                                    class="w-full px-4 py-3 rounded-lg bg-gray-800/80 border border-amber-700/50 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                                    placeholder="08xxxxxxxxxx" value="{{ old('phone', $user->phone ?? '') }}">
                                @error('phone')
                                    <p class="text-red-400 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Departemen (hanya teknisi) --}}
                            @if ($isTeknisi)
                                <div>
                                    <label class="block text-sm font-medium text-amber-300 mb-2" for="departemen">
                                        <i class="fas fa-building mr-2"></i>Departemen
                                    </label>
                                    <select name="departemen" id="departemen"
                                        class="w-full px-4 py-3 rounded-lg bg-gray-800/80 border border-amber-700/50 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                                        <option value="">-- Pilih Departemen --</option>
                                        <option value="produksi"
                                            {{ old('departemen', $user->departemen ?? '') == 'produksi' ? 'selected' : '' }}>
                                            Produksi</option>
                                        <option value="pemeliharaan"
                                            {{ old('departemen', $user->departemen ?? '') == 'pemeliharaan' ? 'selected' : '' }}>
                                            Pemeliharaan</option>
                                        <option value="quality_control"
                                            {{ old('departemen', $user->departemen ?? '') == 'quality_control' ? 'selected' : '' }}>
                                            Quality Control</option>
                                        <option value="logistik"
                                            {{ old('departemen', $user->departemen ?? '') == 'logistik' ? 'selected' : '' }}>
                                            Logistik</option>
                                    </select>
                                    @error('departemen')
                                        <p class="text-red-400 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @endif


                            {{-- Password --}}
                            <div>
                                <label class="block text-sm font-medium text-amber-300 mb-2" for="password">
                                    <i class="fas fa-lock mr-2"></i>Password
                                    @if (isset($user))
                                        <span class="text-xs text-amber-500">(Kosongkan jika tidak ingin mengubah)</span>
                                    @endif
                                </label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-3 rounded-lg bg-gray-800/80 border border-amber-700/50 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                                    placeholder="Minimal 8 karakter" {{ isset($user) ? '' : 'required' }}>
                                @error('password')
                                    <p class="text-red-400 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-500 hover:to-amber-400 text-white font-semibold py-3 rounded-xl shadow-lg shadow-amber-600/30 transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                                    <i class="fas fa-save mr-2"></i>
                                    {{ isset($user) ? ($isTeknisi ? 'Update Data Teknisi' : 'Update Data User') : ($isTeknisi ? 'Simpan Data Teknisi' : 'Simpan Data User') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Info Text --}}
                    <p class="text-center text-amber-200/50 text-sm mt-4">
                        <i class="fas fa-info-circle mr-1"></i>
                        Pastikan semua data terisi dengan benar
                    </p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="p-6 border-t border-amber-900/30 text-center">
                <p class="text-sm text-amber-200/60">© 2025 Maintenance Machines System</p>
            </div>
        </main>
    </div>
@endsection

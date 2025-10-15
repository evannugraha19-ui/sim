@extends('layout.app')

@section('content')
    <div class="flex min-h-screen bg-gradient-to-br from-gray-900 via-amber-950 to-gray-900 text-gray-100">

        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 border-r border-amber-900/40 relative shadow-2xl">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
                style="background-image: radial-gradient(circle at 2px 2px, rgb(245,158,11) 1px, transparent 0); background-size: 28px 28px;">
            </div>

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

            <nav class="relative p-4" x-data="{ openMenu: false }">
                <ul class="space-y-1.5">
                    @if (Auth::user()->role === 'admin')
                        <li>
                            <a href="/dashboard-admin"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                                <i class="fas fa-home text-lg"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    @elseif (Auth::user()->role === 'teknisi')
                        <li>
                            <a href="/dashboard-teknisi"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                                <i class="fas fa-home text-lg"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="/dashboard"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                                <i class="fas fa-home text-lg"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="/riwayat-pengaduan"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-amber-600 text-white font-medium transition-all hover:bg-amber-500">
                            <i class="fas fa-list text-lg"></i>
                            <span>Riwayat Pengaduan</span>
                        </a>
                    </li>
                    @if (Auth::user()->role === 'user')
                        <li>
                            <a href="/input-pengaduan"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                                <i class="fas fa-plus-circle text-lg"></i>
                                <span>Input Pengaduan</span>
                            </a>
                        </li>
                    @elseif (Auth::user()->role === 'admin')
                        <li>
                            <a href="/laporan"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                                <i class="fas fa-file-alt text-lg"></i>
                                <span>Laporan</span>
                            </a>
                        </li>

                        {{-- Dropdown Kelola Data --}}
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
                                        class="block px-3 py-2 rounded-lg {{ Request::is('users') ? 'bg-amber-600/20 text-amber-100' : 'text-amber-300' }} hover:text-amber-100 hover:bg-gray-700 transition-all">
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
                    @endif
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
        <main class="flex-1 p-10 bg-gray-900 text-gray-100 overflow-auto">
            {{-- Dynamic Title Based on Role --}}
            <h1
                class="text-4xl font-bold mb-8 pb-2 bg-gradient-to-r from-amber-400 via-yellow-400 to-orange-400 bg-clip-text text-transparent">
                @if (Auth::user()->role === 'teknisi')
                    Update Pengaduan {{ 'NP' . str_pad($pengaduan->id, 4, '0', STR_PAD_LEFT) }}
                @else
                    Detail Pengaduan {{ 'NP' . str_pad($pengaduan->id, 4, '0', STR_PAD_LEFT) }}
                @endif
            </h1>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 bg-green-900/50 border border-green-700 text-green-300 rounded-lg px-4 py-3">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            {{-- Form untuk Teknisi, View biasa untuk User --}}
            @if (Auth::user()->role === 'teknisi')
                <form method="POST" action="{{ url('/pengaduan/' . $pengaduan->id) }}"
                    class="bg-gray-800 border border-amber-800/40 rounded-2xl p-8 shadow-lg w-full max-w-5xl">
                    @csrf
                    @method('PUT')
                @else
                    <div class="bg-gray-800 border border-amber-800/40 rounded-2xl p-8 shadow-lg w-full max-w-5xl">
            @endif

            {{-- Grid Informasi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-amber-300 mb-1">ID Pengaduan</label>
                    <input type="text" readonly value="{{ 'NP' . str_pad($pengaduan->id, 4, '0', STR_PAD_LEFT) }}"
                        class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-amber-300 mb-1">Tanggal Laporan</label>
                    <input type="text" readonly value="{{ $pengaduan->tanggal_laporan }}"
                        class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-amber-300 mb-1">Nama Pelapor</label>
                    <input type="text" readonly value="{{ $pengaduan->user->name ?? '-' }}"
                        class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-amber-300 mb-1">Jabatan</label>
                    <input type="text" readonly value="{{ $pengaduan->jabatan_pelapor ?? '-' }}"
                        class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-amber-300 mb-1">Departemen</label>
                    <input type="text" readonly value="{{ $pengaduan->departemen ?? '-' }}"
                        class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-amber-300 mb-1">Nama Mesin</label>
                    <input type="text" readonly value="{{ $pengaduan->nama_mesin ?? '-' }}"
                        class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2">
                </div>
            </div>

            {{-- Keterangan --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-amber-300 mb-1">Keterangan</label>
                <textarea rows="3" readonly
                    class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2">{{ $pengaduan->keterangan }}</textarea>
            </div>

            {{-- Status --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-amber-300 mb-2">Status Pengaduan</label>

                @if (Auth::user()->role === 'teknisi')
                    {{-- Teknisi: Dropdown untuk update status --}}
                    <select name="status" required
                        class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        <option value="menunggu" {{ $pengaduan->status == 'menunggu' ? 'selected' : '' }}>Sedang Diajukan
                        </option>
                        <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Sedang Diproses
                        </option>
                        <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai Diproses
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                @else
                    {{-- User: Readonly display dengan badge --}}
                    <div class="bg-gray-900 border border-amber-900/40 rounded-lg px-4 py-3">
                        @if ($pengaduan->status == 'menunggu')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-900/50 text-yellow-300 border border-yellow-700">
                                <i class="fas fa-clock mr-2"></i>Sedang Diajukan
                            </span>
                        @elseif($pengaduan->status == 'diproses')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-900/50 text-blue-300 border border-blue-700">
                                <i class="fas fa-cog fa-spin mr-2"></i>Sedang Diproses
                            </span>
                        @elseif($pengaduan->status == 'selesai')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-900/50 text-green-300 border border-green-700">
                                <i class="fas fa-check-circle mr-2"></i>Selesai Diproses
                            </span>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Catatan Petugas --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-amber-300 mb-1">
                    Catatan dari Petugas
                    @if (Auth::user()->role === 'teknisi')
                        <span class="text-amber-500 text-xs ml-1">(Wajib diisi)</span>
                    @endif
                </label>

                @if (Auth::user()->role === 'teknisi')
                    {{-- Teknisi: Editable textarea --}}
                    <textarea name="hasil_perbaikan" rows="4" required
                        class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                        placeholder="Masukkan hasil perbaikan atau catatan...">{{ $pengaduan->hasil_perbaikan ?? '' }}</textarea>
                    @error('hasil_perbaikan')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                @else
                    {{-- User: Readonly textarea --}}
                    <textarea rows="4" readonly
                        class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2">{{ $pengaduan->hasil_perbaikan ?? 'Belum ada catatan dari petugas.' }}</textarea>
                @endif
            </div>

            {{-- Tombol --}}
            <div class="mt-8 flex gap-3">
                <a href="/riwayat-pengaduan"
                    class="bg-gray-700 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition-all">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>

                @if (Auth::user()->role === 'teknisi')
                    <button type="submit"
                        class="bg-amber-600 hover:bg-amber-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition-all">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                @endif
            </div>

            @if (Auth::user()->role === 'teknisi')
                </form>
            @else
    </div>
    @endif
    </main>
    </div>
@endsection

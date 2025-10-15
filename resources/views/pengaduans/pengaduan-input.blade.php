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
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                            <i class="fas fa-list text-lg"></i>
                            <span>Riwayat Pengaduan</span>
                        </a>
                    </li>
                    @if (Auth::user()->role === 'user')
                        <li>
                            <a href="/input-pengaduan"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-amber-600 text-white font-medium transition-all hover:bg-amber-500">
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

        {{-- Main Form --}}
        <main class="flex-1 p-10 bg-gray-900 text-gray-100 overflow-auto">
            <h1
                class="text-4xl font-bold mb-8 pb-3 bg-gradient-to-r from-amber-400 via-yellow-400 to-orange-400 bg-clip-text text-transparent">
                Form Pengaduan Kerusakan Mesin
            </h1>

            <form action="/input-pengaduan" method="POST"
                class="bg-gray-800 border border-amber-800/40 rounded-2xl p-8 shadow-lg w-full max-w-5xl">
                @csrf

                {{-- Grid dua kolom --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- ID --}}
                    <div>
                        <label class="block text-sm font-medium text-amber-300 mb-1">ID Laporan</label>
                        <input type="text" name="kode" value="NP{{ str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT) }}"
                            readonly
                            class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    {{-- Nama Pelapor --}}
                    <div>
                        <label class="block text-sm font-medium text-amber-300 mb-1">Nama Pelapor</label>
                        <input type="text" name="nama_pelapor" value="{{ Auth::user()->name }}" readonly
                            class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    {{-- Tanggal Laporan --}}
                    <div>
                        <label class="block text-sm font-medium text-amber-300 mb-1">Tanggal Laporan</label>
                        <input type="date" name="tanggal_laporan" required
                            class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    {{-- Jabatan --}}
                    <div>
                        <label class="block text-sm font-medium text-amber-300 mb-1">Jabatan Pelapor</label>
                        <input type="text" name="jabatan_pelapor" placeholder="Contoh: Operator Mesin" required
                            class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    {{-- Departemen --}}
                    <div>
                        <label class="block text-sm font-medium text-amber-300 mb-1">Departemen</label>
                        <input type="text" name="departemen" placeholder="Contoh: Produksi" required
                            class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    {{-- Nama Mesin --}}
                    <div>
                        <label class="block text-sm font-medium text-amber-300 mb-1">Nama Mesin</label>
                        <input type="text" name="nama_mesin" placeholder="Contoh: Mesin Potong A12" required
                            class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                {{-- Keterangan full width --}}
                <div class="mt-6">
                    <label class="block text-sm font-medium text-amber-300 mb-1">Keterangan</label>
                    <textarea name="keterangan" rows="4" placeholder="Jelaskan kerusakan yang terjadi..." required
                        class="w-full bg-gray-900 border border-amber-900/40 text-amber-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"></textarea>
                </div>

                {{-- Tombol --}}
                <div class="flex space-x-4 mt-8">
                    <button type="submit"
                        class="bg-amber-600 hover:bg-amber-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition-all">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                    <button type="reset"
                        class="bg-gray-700 hover:bg-gray-600 text-amber-200 font-semibold px-6 py-2 rounded-lg transition-all">
                        <i class="fas fa-redo mr-2"></i> Reset
                    </button>
                </div>
            </form>
        </main>
    </div>
@endsection

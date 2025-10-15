@extends('layout.app')

@section('content')
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
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-amber-600 text-white font-medium transition-all hover:bg-amber-500">
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
                                    class="block px-3 py-2 rounded-lg hover:text-amber-100 hover:bg-gray-700 transition-all">
                                    <i class="fas fa-user mr-2 text-xs"></i> Data User
                                </a>
                            </li>
                            <li>
                                <a href="/teknisi"
                                    class="block px-3 py-2 rounded-lg hover:text-amber-100 hover:bg-gray-700 transition-all">
                                    <i class="fas fa-user-cog mr-2 text-xs"></i> Data Teknisi
                                </a>
                            </li>
                            <li>
                                <a href="/admin/profile"
                                    class="block px-3 py-2 rounded-lg hover:text-amber-100 hover:bg-gray-700 transition-all">
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
        <main class="flex-1 p-8 bg-gray-800 text-gray-100 overflow-auto">
            {{-- Header --}}
            <div class="mb-8">
                <h1
                    class="text-4xl font-bold mb-2 pb-3 bg-gradient-to-r from-amber-400 via-yellow-400 to-orange-400 bg-clip-text text-transparent">
                    Laporan Pengaduan
                </h1>
                <p class="text-amber-200/70">Filter dan cetak laporan berdasarkan tanggal</p>
            </div>

            {{-- Filter Form --}}
            <div class="bg-gray-900/40 border border-amber-800/40 rounded-2xl shadow-lg p-6 mb-8">
                <form action="/laporan" method="GET" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm text-amber-300 mb-1">Dari Tanggal</label>
                            <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" required
                                class="w-full bg-gray-800 border border-amber-800/40 rounded-lg px-3 py-2 text-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        </div>
                        <div>
                            <label class="block text-sm text-amber-300 mb-1">Ke Tanggal</label>
                            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" required
                                class="w-full bg-gray-800 border border-amber-800/40 rounded-lg px-3 py-2 text-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <button type="submit"
                            class="bg-amber-600 hover:bg-amber-500 text-white font-semibold px-5 py-2.5 rounded-xl shadow-md transition-all flex items-center space-x-2">
                            <i class="fas fa-search"></i>
                            <span>Cari</span>
                        </button>

                        <a href="/laporan"
                            class="bg-gray-700 hover:bg-gray-600 text-gray-200 font-semibold px-5 py-2.5 rounded-xl shadow-md transition-all flex items-center space-x-2">
                            <i class="fas fa-undo"></i>
                            <span>Reset</span>
                        </a>
                    </div>
                </form>
                @if (isset($laporan) && count($laporan) > 0)
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="/laporan/export/pdf?tanggal_awal={{ request('tanggal_awal') }}&tanggal_akhir={{ request('tanggal_akhir') }} )}}"
                            target="_blank"
                            class="bg-red-600 hover:bg-red-500 text-white px-5 py-2.5 rounded-xl shadow-md flex items-center space-x-2 transition-all">
                            <i class="fas fa-file-pdf"></i>
                            <span>Export PDF</span>
                        </a>

                        <a href=""
                            class="bg-green-600 hover:bg-green-500 text-white px-5 py-2.5 rounded-xl shadow-md flex items-center space-x-2 transition-all">
                            <i class="fas fa-file-excel"></i>
                            <span>Export Excel</span>
                        </a>

                        {{-- <button onclick="window.print()"
                            class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2.5 rounded-xl shadow-md flex items-center space-x-2 transition-all">
                            <i class="fas fa-print"></i>
                            <span>Print</span>
                        </button> --}}
                    </div>
                @endif
            </div>

            {{-- Hasil Laporan --}}
            @if (isset($laporan))
                <div class="bg-gray-900/40 border border-amber-800/40 rounded-2xl shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-amber-400 mb-4">Hasil Laporan</h2>

                    <table class="min-w-full text-sm text-left border-collapse">
                        <thead class="bg-amber-900/40 text-amber-200 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-4 py-3 border-b border-amber-800/40">No</th>
                                <th class="px-4 py-3 border-b border-amber-800/40">ID</th>
                                <th class="px-4 py-3 border-b border-amber-800/40">Nama</th>
                                <th class="px-4 py-3 border-b border-amber-800/40">Mesin</th>
                                <th class="px-4 py-3 border-b border-amber-800/40">Tanggal</th>
                                <th class="px-4 py-3 border-b border-amber-800/40">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporan as $index => $data)
                                <tr class="hover:bg-amber-900/10 transition-all">
                                    <td class="px-4 py-2 border-b border-amber-900/40">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border-b border-amber-900/40">
                                        NP{{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-4 py-2 border-b border-amber-900/40">{{ $data->nama_pelapor }}</td>
                                    <td class="px-4 py-2 border-b border-amber-900/40">{{ $data->nama_mesin }}</td>
                                    <td class="px-4 py-2 border-b border-amber-900/40">
                                        {{ $data->tanggal_laporan }}</td>
                                    <td class="px-4 py-2 border-b border-amber-900/40 capitalize">{{ $data->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-amber-200/60 py-6">Tidak ada data
                                        ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- Footer --}}
            <div class="mt-96 pt-6  border-t border-amber-900/40 text-center">
                <p class="text-sm text-amber-200/60">
                    © 2025 Golden Dragon Maintenance System. All rights reserved.
                </p>
            </div>
        </main>
    </div>
@endsection

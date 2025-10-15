@extends('layout.app')

@section('content')
    <div class="flex min-h-screen bg-gradient-to-br from-gray-800 via-amber-950 to-gray-800 text-gray-100">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 shadow-2xl border-r border-amber-900/40 relative">
            {{-- Pattern --}}
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
                style="background-image: radial-gradient(circle at 2px 2px, rgb(245, 158, 11) 1px, transparent 0); background-size: 28px 28px;">
            </div>

            {{-- Logo/Header --}}
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
                        <a href="/dashboard"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-amber-600 text-white font-medium transition-all hover:bg-amber-500">
                            <i class="fas fa-home text-lg"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/riwayat-pengaduan"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                            <i class="fas fa-clipboard-list text-lg"></i>
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
        <main class="flex-1 p-8 bg-gray-900 text-gray-100 overflow-auto">
            {{-- Header --}}
            <div class="mb-8">
                <h1
                    class="text-4xl font-bold mb-2 bg-gradient-to-r from-amber-400 via-yellow-400 to-orange-400 bg-clip-text text-transparent">
                    Dashboard Admin
                </h1>
                <p class="text-amber-200/70">Selamat datang di sistem monitoring pengaduan mesin</p>
            </div>

            {{-- Cards Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                {{-- Data Pengaduan --}}
                <div
                    class="bg-gray-800 border border-amber-800/40 rounded-2xl p-6 shadow-md hover:border-amber-500 transition duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clipboard-list text-white text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-amber-400 bg-amber-500/10 px-3 py-1 rounded-full">
                            Pengaduan
                        </span>
                    </div>
                    <h2 class="font-semibold text-amber-200 mb-2 text-sm uppercase tracking-wide">Total Pengaduan</h2>
                    <p class="text-3xl font-bold text-amber-400">{{ $pengaduanCount ?? 0 }}</p>
                </div>

                {{-- Data User --}}
                <div
                    class="bg-gray-800 border border-amber-800/40 rounded-2xl p-6 shadow-md hover:border-yellow-500 transition duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-yellow-400 bg-yellow-500/10 px-3 py-1 rounded-full">
                            Users
                        </span>
                    </div>
                    <h2 class="font-semibold text-amber-200 mb-2 text-sm uppercase tracking-wide">Total User</h2>
                    <p class="text-3xl font-bold text-yellow-400">{{ $userCount ?? 0 }}</p>
                </div>

                {{-- Data Teknisi --}}
                <div
                    class="bg-gray-800 border border-amber-800/40 rounded-2xl p-6 shadow-md hover:border-lime-500 transition duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-lime-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user-cog text-white text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-lime-400 bg-lime-500/10 px-3 py-1 rounded-full">
                            Teknisi
                        </span>
                    </div>
                    <h2 class="font-semibold text-amber-200 mb-2 text-sm uppercase tracking-wide">Total Teknisi</h2>
                    <p class="text-3xl font-bold text-lime-400">{{ $teknisiCount ?? 0 }}</p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="mt-96 pt-6  border-t border-amber-900/40 text-center">
                <p class="text-sm text-amber-200/60">
                    © 2025 Golden Dragon Maintenance System. All rights reserved.

                </p>
            </div>
        </main>
    </div>
@endsection

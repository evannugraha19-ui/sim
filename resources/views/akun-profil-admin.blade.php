@extends('layout.app')

@section('content')
    <div class="flex min-h-screen bg-gradient-to-br from-gray-800 via-amber-950 to-gray-800 text-gray-100">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 shadow-2xl border-r border-amber-900/40 relative">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
                style="background-image: radial-gradient(circle at 2px 2px, rgb(245, 158, 11) 1px, transparent 0); background-size: 28px 28px;">
            </div>

            {{-- Header Sidebar --}}
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
            <nav class="relative p-4" x-data="{ openMenu: true }">
                <ul class="space-y-1.5">
                    <li>
                        <a href="/dashboard-admin"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                            <i class="fas fa-home text-lg"></i>
                            <span>Dashboard</span>
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
                                    class="block px-3 py-2 rounded-lg bg-amber-600/20 text-amber-100 hover:bg-gray-700 transition-all">
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
        <main class="flex-1 flex flex-col min-h-screen bg-gray-900 text-gray-100 overflow-auto">
            <div class="flex-1 p-8">
                <h1
                    class="text-3xl font-bold mb-6 bg-gradient-to-r from-amber-400 via-yellow-400 to-orange-400 bg-clip-text text-transparent">
                    Profil Akun
                </h1>

                {{-- Dummy data admin --}}
                @php
                    $admin = (object) [
                        'nip' => 'AD001',
                        'email' => 'admin@goldendragon.com',
                        'fullname' => 'Administrator PT Golden Dragon',
                        'profile_picture' => 'https://i.pravatar.cc/150?img=12',
                    ];
                @endphp

                <div class="bg-gray-800 border border-amber-800/40 rounded-2xl p-6 shadow-md">
                    <div class="flex flex-col md:flex-row gap-6 items-center md:items-start">
                        {{-- Foto Profil --}}
                        <div class="flex flex-col items-center md:items-start">
                            <img src="{{ $admin->profile_picture }}" alt="Foto Profil"
                                class="w-36 h-36 rounded-xl object-cover border border-amber-800/60 mb-4 shadow-md">

                        </div>

                        {{-- Detail Akun --}}
                        <div class="flex-1">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-amber-400 text-sm mb-1">Nomor Induk Pegawai</label>
                                    <p class="text-gray-200 font-semibold">{{ $admin->nip }}</p>
                                </div>
                                <div>
                                    <label class="block text-amber-400 text-sm mb-1">Email</label>
                                    <p class="text-gray-200 font-semibold">{{ $admin->email }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-amber-400 text-sm mb-1">Nama Lengkap</label>
                                    <p class="text-gray-200 font-semibold">{{ $admin->fullname }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer tetap di bawah --}}
            <footer class="border-t border-amber-900/40 text-center py-4 bg-gray-900 mt-auto">
                <p class="text-sm text-amber-200/60">
                    © 2025 Golden Dragon Maintenance System. All rights reserved.
                </p>
            </footer>
        </main>
    </div>
@endsection

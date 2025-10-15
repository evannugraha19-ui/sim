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
                    <img src="logo.png" alt="Logo" class="w-8 h-8 object-contain">
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
            <nav class="relative p-4">
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
                            <i class="fas fa-list text-lg"></i>
                            <span>Riwayat Pengaduan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/input-pengaduan"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-amber-200/80 hover:text-white hover:bg-gray-800 transition-all">
                            <i class="fas fa-plus-circle text-lg"></i>
                            <span>Input Pengaduan</span>
                        </a>
                    </li>
                </ul>

                {{-- Logout --}}
                <div class="mt-8 pt-4 border-t border-amber-900/40">
                    <form method="POST" action="">
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
                    class="text-4xl font-bold mb-2 bg-gradient-to-r from-amber-400 via-yellow-400 to-orange-400 bg-clip-text text-transparent">
                    Dashboard
                </h1>
                <p class="text-amber-200/70">Selamat datang di sistem monitoring mesin</p>
            </div>

            {{-- Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                {{-- Sedang Diajukan --}}
                <div
                    class="bg-gray-800 border border-amber-800/40 rounded-2xl p-6 shadow-md hover:border-amber-500 transition duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-amber-400 bg-amber-500/10 px-3 py-1 rounded-full">
                            Pending
                        </span>
                    </div>
                    <h2 class="font-semibold text-amber-200 mb-2 text-sm uppercase tracking-wide">Sedang Diajukan</h2>
                    <p class="text-3xl font-bold text-amber-400">{{ $pendingCount ?? 0 }} Data</p>
                </div>

                {{-- Sedang Diproses --}}
                <div
                    class="bg-gray-800 border border-amber-800/40 rounded-2xl p-6 shadow-md hover:border-yellow-500 transition duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-cog fa-spin text-white text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-yellow-400 bg-yellow-500/10 px-3 py-1 rounded-full">
                            Processing
                        </span>
                    </div>
                    <h2 class="font-semibold text-amber-200 mb-2 text-sm uppercase tracking-wide">Sedang Diproses</h2>
                    <p class="text-3xl font-bold text-yellow-400">{{ $processingCount ?? 0 }} Data</p>
                </div>

                {{-- Selesai Diproses --}}
                <div
                    class="bg-gray-800 border border-amber-800/40 rounded-2xl p-6 shadow-md hover:border-lime-500 transition duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-lime-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-lime-400 bg-lime-500/10 px-3 py-1 rounded-full">
                            Completed
                        </span>
                    </div>
                    <h2 class="font-semibold text-amber-200 mb-2 text-sm uppercase tracking-wide">Selesai Diproses</h2>
                    <p class="text-3xl font-bold text-lime-400">{{ $completedCount ?? 0 }} Data</p>
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

@extends('layout.app')

@section('content')
    <div class="relative h-screen w-full overflow-hidden bg-gradient-to-br from-black via-gray-900 to-black">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 2px 2px, rgb(202, 138, 4) 1px, transparent 0); background-size: 40px 40px;">
            </div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-10 flex items-center justify-between px-8 py-6 border-b border-gray-800">
            <div class="flex items-center gap-3">
                {{-- <img src="logo.png" alt="Logo" class="h-10 w-auto"> --}}
                <span class="text-lg font-bold text-yellow-500">Golden Dragon</span>
            </div>
            <div class="flex items-center gap-6">
                <a href="/" class="text-yellow-500 text-sm font-medium">Home</a>
                <a href="/about" class="text-gray-400 hover:text-yellow-500 transition text-sm font-medium">About</a>
                <a href="/contact" class="text-gray-400 hover:text-yellow-500 transition text-sm font-medium">Contact</a>
                <a href="/login"
                    class="px-5 py-2 bg-yellow-600 text-black font-semibold rounded-lg hover:bg-yellow-500 transition text-sm shadow-md">Login</a>
            </div>
        </nav>

        <!-- Hero Content -->
        <!-- Hero Content -->
        <div class="relative z-10 flex flex-col items-center justify-center px-6" style="height: calc(100vh - 89px);">
            <div class="text-center max-w-4xl mb-20">
                <h1 class="text-6xl font-bold text-gray-100 mb-6 leading-tight">
                    Maintenance <span class="text-yellow-500">Machines</span>
                </h1>
                <p class="text-xl text-gray-400 mb-4 leading-relaxed">
                    Sistem manajemen pemeliharaan mesin yang efisien dan terpercaya untuk meningkatkan produktivitas
                    operasional Anda
                </p>
                <p class="text-md text-gray-300 mb-10 italic">
                    <span class="text-yellow-500 font-semibold">PT Golden Dragon</span> – Tangerang, Banten, Indonesia
                </p>
                <div class="flex items-center justify-center gap-4">
                    <a href="/login"
                        class="px-8 py-4 bg-gradient-to-r from-yellow-600 to-yellow-500 text-black font-bold rounded-lg hover:from-yellow-500 hover:to-yellow-400 transition shadow-lg hover:shadow-yellow-600/30 transform hover:scale-105">
                        Mulai Sekarang
                    </a>
                    <a href="/about"
                        class="px-8 py-4 bg-transparent border-2 border-gray-700 text-gray-300 font-semibold rounded-lg hover:border-yellow-600 hover:text-yellow-500 transition">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>


        <!-- Decorative Elements -->
        <div class="absolute top-1/4 left-10 w-32 h-32 bg-yellow-600/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-10 w-40 h-40 bg-yellow-600/5 rounded-full blur-3xl"></div>
    </div>
@endsection

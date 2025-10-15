@extends('layout.app')

@section('content')
    <div
        class="relative min-h-screen w-full overflow-hidden bg-gradient-to-br from-black via-gray-900 to-black text-gray-200">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 2px 2px, rgb(202, 138, 4) 1px, transparent 0); background-size: 40px 40px;">
            </div>
        </div>

        <!-- Decorative Blurs -->
        <div class="absolute top-1/3 left-10 w-40 h-40 bg-yellow-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/3 right-10 w-52 h-52 bg-yellow-600/10 rounded-full blur-3xl"></div>

        <!-- Navigation -->
        <nav class="relative z-10 flex items-center justify-between px-8 py-6 border-b border-gray-800">
            <div class="flex items-center gap-3">
                <span class="text-lg font-bold text-yellow-500">Golden Dragon</span>
            </div>
            <div class="flex items-center gap-6">
                <a href="/" class="text-gray-400 hover:text-yellow-500 transition text-sm font-medium">Home</a>
                <a href="/about" class="text-yellow-500 text-sm font-medium">About</a>
                <a href="/contact" class="text-gray-400 hover:text-yellow-500 transition text-sm font-medium">Contact</a>
                <a href="/login"
                    class="px-5 py-2 bg-yellow-600 text-black font-semibold rounded-lg hover:bg-yellow-500 transition text-sm shadow-md">
                    Login
                </a>
            </div>
        </nav>

        <!-- About Content -->
        <section class="relative z-10 max-w-5xl mx-auto px-6 py-20">
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold text-yellow-500 mb-4">Tentang Kami</h1>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">
                    PT <span class="font-semibold text-yellow-500">Golden Dragon</span> adalah perusahaan yang bergerak di
                    bidang manufaktur.
                    Kami menciptakan sistem manajemen pemeliharaan mesin yang efisien, modern, dan mudah digunakan untuk
                    mendukung operasional internal perusahaan serta meningkatkan produktivitas industri.
                </p>
            </div>


            <!-- Two Column Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div
                    class="bg-gradient-to-b from-yellow-900/10 to-gray-900/30 border border-yellow-700/20 rounded-2xl p-8 shadow-lg hover:shadow-yellow-600/10 transition">
                    <h2 class="text-2xl font-bold text-yellow-500 mb-4">Visi Kami</h2>
                    <p class="text-gray-400 leading-relaxed">
                        Menjadi platform digital terbaik dalam pengelolaan dan pemantauan mesin industri
                        dengan sistem yang cerdas, transparan, dan terintegrasi untuk meningkatkan efisiensi
                        serta memperpanjang umur peralatan produksi.
                    </p>
                </div>

                <div
                    class="bg-gradient-to-b from-yellow-900/10 to-gray-900/30 border border-yellow-700/20 rounded-2xl p-8 shadow-lg hover:shadow-yellow-600/10 transition">
                    <h2 class="text-2xl font-bold text-yellow-500 mb-4">Misi Kami</h2>
                    <ul class="space-y-3 text-gray-400 leading-relaxed list-disc list-inside">
                        <li>Menyediakan sistem pelaporan kerusakan mesin yang cepat dan akurat.</li>
                        <li>Mempermudah komunikasi antara operator dan teknisi.</li>
                        <li>Meningkatkan efisiensi perawatan mesin melalui data dan analitik.</li>
                        <li>Mendukung digitalisasi industri menuju era industri 4.0.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="relative z-10 text-center text-gray-600 py-6 border-t border-gray-800">
            <p>© 2025 Golden Dragon Maintenance System. All rights reserved.</p>
        </footer>
    </div>
@endsection

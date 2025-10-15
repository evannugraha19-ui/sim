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

        <!-- Decorative Elements -->
        <div class="absolute top-1/3 left-10 w-40 h-40 bg-yellow-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/3 right-10 w-52 h-52 bg-yellow-600/10 rounded-full blur-3xl"></div>

        <!-- Navigation -->
        <nav class="relative z-10 flex items-center justify-between px-8 py-6 border-b border-gray-800">
            <div class="flex items-center gap-3">
                <span class="text-lg font-bold text-yellow-500">Golden Dragon</span>
            </div>
            <div class="flex items-center gap-6">
                <a href="/" class="text-gray-400 hover:text-yellow-500 transition text-sm font-medium">Home</a>
                <a href="/about" class="text-gray-400 hover:text-yellow-500 transition text-sm font-medium">About</a>
                <a href="/contact" class="text-yellow-500 text-sm font-medium">Contact</a>
                <a href="/login"
                    class="px-5 py-2 bg-yellow-600 text-black font-semibold rounded-lg hover:bg-yellow-500 transition text-sm shadow-md">
                    Login
                </a>
            </div>
        </nav>

        <!-- Contact Section -->
        <section class="relative z-10 max-w-6xl mx-auto px-6 py-20">
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold text-yellow-500 mb-4">Hubungi Kami</h1>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">
                    Punya pertanyaan, saran, atau ingin bekerja sama? Kami siap membantu Anda.
                    Silakan isi formulir di bawah ini atau hubungi kami melalui media sosial resmi.
                </p>
            </div>

            <!-- Form dan Tim -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-stretch">
                <!-- Form -->
                <form action="#" method="POST"
                    class="bg-gradient-to-b from-yellow-900/10 to-gray-900/30 border border-yellow-700/20 rounded-2xl p-8 shadow-lg flex flex-col justify-between h-full">
                    @csrf
                    <div>
                        <div class="mb-5">
                            <label for="name" class="block text-yellow-500 font-medium mb-2">Nama</label>
                            <input type="text" name="name" id="name"
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-gray-200 rounded-lg focus:ring-2 focus:ring-yellow-600 placeholder-gray-500"
                                placeholder="Nama lengkap Anda" required>
                        </div>
                        <div class="mb-5">
                            <label for="email" class="block text-yellow-500 font-medium mb-2">Email</label>
                            <input type="email" name="email" id="email"
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-gray-200 rounded-lg focus:ring-2 focus:ring-yellow-600 placeholder-gray-500"
                                placeholder="Alamat email aktif" required>
                        </div>
                        <div class="mb-5">
                            <label for="message" class="block text-yellow-500 font-medium mb-2">Pesan</label>
                            <textarea name="message" id="message" rows="5"
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-gray-200 rounded-lg focus:ring-2 focus:ring-yellow-600 placeholder-gray-500"
                                placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full mt-4 bg-gradient-to-r from-yellow-600 to-yellow-500 text-black font-bold py-3 rounded-lg hover:from-yellow-500 hover:to-yellow-400 transition-all shadow-lg hover:shadow-yellow-600/50 transform hover:scale-105">
                        Kirim Pesan
                    </button>
                </form>

                <!-- Tim Pengembang -->
                <div class="flex flex-col justify-between h-full">
                    <h2 class="text-2xl font-bold text-yellow-500 mb-8 text-center md:text-left">Tim Pengembang</h2>

                    <!-- Grid Card -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 flex-grow">
                        <!-- Card Template -->
                        <div
                            class="bg-gray-900/60 border border-yellow-700/30 rounded-2xl p-6 shadow-lg hover:shadow-yellow-600/30 transition-all hover:scale-105 flex flex-col justify-between">
                            <div>
                                <img src="boy.png" alt="Evan Nugraha"
                                    class="w-24 h-24 rounded-full mx-auto mb-4 border-2 border-yellow-600 object-cover">
                                <h3 class="text-lg font-semibold text-yellow-400 text-center">Evan Nugraha</h3>
                                <p class="text-sm text-gray-400 mb-2 text-center">Backend Developer</p>
                                <p class="text-gray-400 text-sm mb-3 text-center">Spesialis API dan sistem database. Fokus
                                    pada performa dan keamanan server.</p>
                                <blockquote class="italic text-yellow-600 text-sm text-center">“Kesulitan hanya rintangan, bukan kemustahilan.”</blockquote>
                            </div>
                            <div class="flex justify-center gap-3 mt-4">
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-linkedin"></i></a>
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-github"></i></a>
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>

                        <!-- Ebenheser Atakari -->
                        <div
                            class="bg-gray-900/60 border border-yellow-700/30 rounded-2xl p-6 shadow-lg hover:shadow-yellow-600/30 transition-all hover:scale-105 flex flex-col justify-between">
                            <div>
                                <img src="stylish-boy.png" alt="Ebenheser Atakari"
                                    class="w-24 h-24 rounded-full mx-auto mb-4 border-2 border-yellow-600 object-cover">
                                <h3 class="text-lg font-semibold text-yellow-400 text-center">Ebenheser Atakari</h3>
                                <p class="text-sm text-gray-400 mb-2 text-center">UI/UX Designer</p>
                                <p class="text-gray-400 text-sm mb-3 text-center">Merancang antarmuka intuitif dan
                                    pengalaman pengguna memukau.</p>
                                <blockquote class="italic text-yellow-600 text-sm text-center">“Jangan menyimpan semua sendiri, ceritakan apa yang membuatmu tersakiti.”</blockquote>
                            </div>
                            <div class="flex justify-center gap-3 mt-4">
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-linkedin"></i></a>
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-dribbble"></i></a>
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>

                        <!-- Hanum Dwi Salsabila -->
                        <div
                            class="bg-gray-900/60 border border-yellow-700/30 rounded-2xl p-6 shadow-lg hover:shadow-yellow-600/30 transition-all hover:scale-105 flex flex-col justify-between">
                            <div>
                                <img src="girl.png" alt="Hanum Dwi Salsabila"
                                    class="w-24 h-24 rounded-full mx-auto mb-4 border-2 border-yellow-600 object-cover">
                                <h3 class="text-lg font-semibold text-yellow-400 text-center">Hanum Dwi Salsabila</h3>
                                <p class="text-sm text-gray-400 mb-2 text-center">Frontend Engineer</p>
                                <p class="text-gray-400 text-sm mb-3 text-center">Membangun UI cepat, responsif, dan modern.
                                </p>
                                <blockquote class="italic text-yellow-600 text-sm text-center">“Ikhlaskan apa yang terjadi, jalani apa yang ada.”</blockquote>
                            </div>
                            <div class="flex justify-center gap-3 mt-4">
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-linkedin"></i></a>
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-github"></i></a>
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>

                        <!-- Fajar Arief Budiman -->
                        <div
                            class="bg-gray-900/60 border border-yellow-700/30 rounded-2xl p-6 shadow-lg hover:shadow-yellow-600/30 transition-all hover:scale-105 flex flex-col justify-between">
                            <div>
                                <img src="young-boy.png" alt="Fajar Arief Budiman"
                                    class="w-24 h-24 rounded-full mx-auto mb-4 border-2 border-yellow-600 object-cover">
                                <h3 class="text-lg font-semibold text-yellow-400 text-center">Fajar Arief Budiman</h3>
                                <p class="text-sm text-gray-400 mb-2 text-center">Project Manager</p>
                                <p class="text-gray-400 text-sm mb-3 text-center">Mengatur alur kerja, komunikasi tim, dan
                                    memastikan deadline terpenuhi.</p>
                                <blockquote class="italic text-yellow-600 text-sm text-center">“Melihatmu Bahagia adalah mimpi yang sempurna.”</blockquote>
                            </div>
                            <div class="flex justify-center gap-3 mt-4">
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-linkedin"></i></a>
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-instagram"></i></a>
                                <a href="#" class="text-gray-400 hover:text-yellow-500"><i
                                        class="fab fa-dribbble"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="relative z-10 text-center text-gray-600 py-6 border-t border-gray-800">
            <p>© 2025 Golden Dragon Maintenance System. All rights reserved.</p>
        </footer>
    </div>
@endsection

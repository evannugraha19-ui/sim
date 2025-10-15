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
                        <a href="/dashboard"
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
        <main class="flex-1 p-8 bg-gray-800 text-gray-100 overflow-auto">
            {{-- Header --}}
            <div class="mb-8 flex justify-between items-center">
                <div>
                    @if (Request::is('teknisi'))
                        <h1
                            class="text-4xl font-bold mb-2 pb-3 bg-gradient-to-r from-amber-400 via-yellow-400 to-orange-400 bg-clip-text text-transparent">
                            Kelola Data Teknisi
                        </h1>
                    @elseif (Request::is('users'))
                        <h1
                            class="text-4xl font-bold mb-2 pb-3 bg-gradient-to-r from-amber-400 via-yellow-400 to-orange-400 bg-clip-text text-transparent">
                            Kelola Data User
                        </h1>
                    @endif
                    <p class="text-amber-200/70">Daftar seluruh pengguna sistem</p>
                </div>

                @if (Request::is('teknisi'))
                    <a href="/teknisi/create"
                        class="bg-amber-600 hover:bg-amber-500 text-white font-semibold px-5 py-2.5 rounded-xl shadow-md transition-all flex items-center space-x-2">
                        <i class="fas fa-user-plus"></i>
                        <span>Tambah Teknisi</span>
                    </a>
                @else
                    <a href="/users/create"
                        class="bg-amber-600 hover:bg-amber-500 text-white font-semibold px-5 py-2.5 rounded-xl shadow-md transition-all flex items-center space-x-2">
                        <i class="fas fa-user-plus"></i>
                        <span>Tambah User</span>
                    </a>
                @endif
            </div>

            {{-- Table --}}
            <div class="bg-gray-900/40 border border-amber-800/40 rounded-2xl shadow-lg p-6">
                <table class="min-w-full text-sm text-left border-collapse">
                    <thead class="bg-amber-900/40 text-amber-200 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 border-b border-amber-800/40">No</th>
                            <th class="px-4 py-3 border-b border-amber-800/40">Nama</th>
                            <th class="px-4 py-3 border-b border-amber-800/40">Email</th>
                            <th class="px-4 py-3 border-b border-amber-800/40">No. Telephone</th>
                            <th class="px-4 py-3 border-b border-amber-800/40">Departemen</th>
                            <th class="px-4 py-3 border-b border-amber-800/40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr class="hover:bg-amber-900/10 transition-all">
                                <td class="px-4 py-2 border-b border-amber-900/40">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 border-b border-amber-900/40">{{ $user->name }}</td>
                                <td class="px-4 py-2 border-b border-amber-900/40">{{ $user->email }}</td>
                                <td class="px-4 py-2 border-b border-amber-900/40">{{ $user->phone }}</td>
                                <td class="px-4 py-2 border-b border-amber-900/40">
                                    {{ $user->role === 'teknisi' ? $user->departemen : '-' }}
                                </td>
                                @if (Request::is('teknisi'))
                                    <td class="px-4 py-2 border-b border-amber-900/40 space-x-3">
                                        <a href="{{ route('teknisi.edit', $user->id) }}"
                                            class="text-amber-400 hover:text-yellow-300 font-semibold transition-all">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('teknisi.destroy', $user->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="text-red-500 hover:text-red-400 font-semibold transition-all"
                                                onclick="openDeleteModal({{ $user->id }})">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                @else
                                    <td class="px-4 py-2 border-b border-amber-900/40 space-x-3">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-amber-400 hover:text-yellow-300 font-semibold transition-all">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="text-red-500 hover:text-red-400 font-semibold transition-all"
                                                onclick="openDeleteModal({{ $user->id }})">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-amber-200/60 py-6">Belum ada data user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>

            <div id="deleteModal" class="fixed inset-0 bg-black/60 hidden justify-center items-center z-50">
                <div class="bg-gray-900 border border-amber-800/40 rounded-2xl p-6 w-full max-w-md shadow-xl">
                    <h2 class="text-xl font-bold text-amber-400 mb-3">Konfirmasi Hapus</h2>
                    <p class="text-gray-300 mb-6">Apakah kamu yakin ingin menghapus user ini? Tindakan ini tidak bisa
                        dibatalkan.</p>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeDeleteModal()"
                            class="bg-gray-700 hover:bg-gray-600 text-gray-200 px-4 py-2 rounded-lg transition-all">Batal</button>

                        <form id="deleteForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded-lg transition-all">Hapus</button>
                        </form>
                    </div>
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
    <script>
        function openDeleteModal(id) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `/pengaduan/${id}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
@endsection

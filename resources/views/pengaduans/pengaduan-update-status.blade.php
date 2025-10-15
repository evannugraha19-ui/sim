@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md">
        <div class="p-4 border-b">
            <h2 class="text-lg font-semibold">Halo, {{ Auth::user()->name }}</h2>
        </div>
        <nav class="p-4">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('teknisi.dashboard') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-home"></i><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teknisi.data') }}" class="flex items-center space-x-2 text-blue-600 font-semibold">
                        <i class="fas fa-tools"></i><span>Data Pengaduan</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-2 text-gray-700 hover:text-red-600">
                            <i class="fas fa-sign-out-alt"></i><span>Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-semibold mb-6">Data Pengaduan Kerusakan Mesin</h1>

        <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
            <table class="min-w-full border border-gray-300 text-sm text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border text-center">No</th>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Mesin</th>
                        <th class="px-4 py-2 border">Keterangan</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengaduans as $index => $p)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">NP{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-4 py-2 border">{{ $p->user->name }}</td>
                        <td class="px-4 py-2 border">{{ $p->lokasi_mesin }}</td>
                        <td class="px-4 py-2 border">{{ Str::limit($p->deskripsi, 30) }}</td>
                        <td class="px-4 py-2 border">{{ $p->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 border">
                            @if($p->status == 'menunggu')
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">Sedang diajukan</span>
                            @elseif($p->status == 'diproses')
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">Sedang diproses</span>
                            @else
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded">Selesai diproses</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border text-center">
                            <a href="{{ route('teknisi.edit', $p->id) }}" class="text-blue-600 hover:underline">Update</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-gray-500 py-4">Belum ada pengaduan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $pengaduans->links() }}
            </div>
        </div>
    </main>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md">
        <div class="p-4 border-b">
            <h2 class="text-lg font-semibold">Halo, {{ Auth::user()->name }}</h2>
        </div>
        <nav class="p-4">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('teknisi.dashboard') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-home"></i><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teknisi.data') }}" class="flex items-center space-x-2 text-blue-600 font-semibold">
                        <i class="fas fa-tools"></i><span>Data Pengaduan</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-semibold mb-6">Update Status Pengaduan</h1>

        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-3xl">
            <form method="POST" action="{{ route('teknisi.update', $pengaduan->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">ID Pengaduan</label>
                    <input type="text" value="NP{{ str_pad($pengaduan->id, 4, '0', STR_PAD_LEFT) }}" readonly class="w-full border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelapor</label>
                    <input type="text" value="{{ $pengaduan->user->name }}" readonly class="w-full border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border-gray-300 rounded-md">
                        <option value="menunggu" {{ $pengaduan->status == 'menunggu' ? 'selected' : '' }}>Sedang diajukan</option>
                        <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Sedang diproses</option>
                        <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai diproses</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Perbaikan</label>
                    <textarea name="hasil_perbaikan" rows="3" class="w-full border-gray-300 rounded-md">{{ $pengaduan->laporan->hasil_perbaikan ?? '' }}</textarea>
                </div>

                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Simpan</button>
                    <a href="{{ route('teknisi.data') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Batal</a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

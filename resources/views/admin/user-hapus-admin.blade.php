@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <p>Halo, Admin</p>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Data Pengaduan</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Laporan</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Kelola Data</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Data User</a></li>
                                <li><a class="dropdown-item" href="#">Data Teknisi</a></li>
                                <li><a class="dropdown-item" href="#">Profil Akun</a></li>
                                <li><a class="dropdown-item" href="#">Keluar</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Tabel Data User --}}
        <div class="col-md-9">
            <div class="d-flex justify-content-between mb-3">
                <h4>List Data User</h4>
                <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah Data</a>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title text-danger fw-bold" id="deleteModalLabel">PERINGATAN</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body text-center">
                                    <p>Apakah anda ingin menghapus data ini?</p>
                                  </div>
                                  <div class="modal-footer justify-content-center">
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Ya</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-end">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

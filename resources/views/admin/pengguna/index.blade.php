@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center fw-bold mb-4">Data Pengguna</h2>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a href="{{ route('admin.pengguna.create') }}" class="btn btn-success btn-sm">Tambah
                                    Pengguna</a>
                                <form method="GET" action="{{ route('admin.pengguna.index') }}" class="d-flex">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control me-2" placeholder="Cari nama pengguna...">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </form>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ ucwords(str_replace('_', ' ', $user->role)) }}</td>
                                            <td class="text-nowrap text-center">
                                                <div class="btn-group" role="group">
                                                    {{-- <a href="{{ route('admin.pengguna.show', $user->id) }}" class="btn btn-success btn-sm me-1" title="Lihat Detail">
                                                <i class='bx bx-show'></i>
                                            </a> --}}
                                                    <a href="{{ route('admin.pengguna.edit', $user->id) }}"
                                                        class="btn btn-warning btn-sm me-1" title="Edit Data">
                                                        <i class='mdi mdi-pencil'></i>
                                                    </a>
                                                    <form action="{{ route('admin.pengguna.destroy', $user->id) }}"
                                                        method="POST" class="d-inline form-delete">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm btn-delete"
                                                            onclick="return confirm('Yakin akan menghapus data ini?')"
                                                            title="Hapus Data">
                                                            <i class='mdi mdi-delete'></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Bagian Pagination untuk navigasi halaman -->
                            <div class="d-flex justify-content-center mt-4">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <!-- Tombol Previous -->
                                        <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $users->previousPageUrl() }}"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        <!-- Loop untuk nomor halaman -->
                                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                                            <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        <!-- Tombol Next -->
                                        <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

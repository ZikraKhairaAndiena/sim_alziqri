@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center fw-bold mb-4">Data Siswa</h4>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <div class="d-flex justify-content-end mb-3">
                            <form method="GET" action="{{ route('admin.siswa.index') }}" class="mb-3 d-flex justify-content-end">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control me-2" placeholder="Cari nama siswa...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Foto</th>
                                    <th>NISN</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                    <td>
                                        @if($siswa->foto)
                                            <img src="{{ asset('img/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama_siswa }}" width="50" height="50" class="rounded">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $siswa->nisn ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d-m-Y') }}</td>
                                    <td>
                                        @if($siswa->status == 'aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.siswa.show', $siswa->id) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail"><i class='mdi mdi-eye'></i></a>
                                            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Data"><i class='mdi mdi-pencil'></i></a>
                                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="d-inline form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Yakin akan menghapus data ini?')" title="Hapus Data"><i class='mdi mdi-delete'></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-4">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <!-- Tombol Previous -->
                                    <li class="page-item {{ $siswas->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $siswas->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <!-- Loop untuk nomor halaman -->
                                    @for ($i = 1; $i <= $siswas->lastPage(); $i++)
                                        <li class="page-item {{ ($siswas->currentPage() == $i) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $siswas->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <!-- Tombol Next -->
                                    <li class="page-item {{ $siswas->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $siswas->nextPageUrl() }}" aria-label="Next">
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

@extends('admin.layouts.main')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center fw-bold mb-4">Data Kelas</h4>
                    <div class="table-responsive">
                        <a href="{{ route('admin.kelas.create') }}" class="btn btn-success btn-sm mb-3">Tambah Kelas</a>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>Nama Kelas</th>
                                <th>Guru Kelas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelass as $kelas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kelas->tahunAjaran->nama ?? 'N/A' }}</td>
                                    <td>{{ $kelas->nama_kelas }}</td>
                                    <td>{{ $kelas->guru->nama_guru ?? 'N/A' }}</td>
                                    <td class="text-nowrap text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.kelas.show', $kelas->id) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail">
                                                <i class='mdi mdi-eye'></i>
                                            </a>
                                            <a href="{{ route('admin.kelas.edit', $kelas->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Data">
                                                <i class='mdi mdi-pencil'></i>
                                            </a>
                                            <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" method="POST" class="d-inline form-delete">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Yakin akan menghapus data ini?')" title="Hapus Data">
                                                    <i class='mdi mdi-delete'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Bagian Pagination untuk navigasi halaman kelas -->
                        <div class="d-flex justify-content-center mt-4">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <!-- Tombol Previous -->
                                    <li class="page-item {{ $kelass->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $kelass->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <!-- Loop untuk nomor halaman -->
                                    @for ($i = 1; $i <= $kelass->lastPage(); $i++)
                                        <li class="page-item {{ ($kelass->currentPage() == $i) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $kelass->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <!-- Tombol Next -->
                                    <li class="page-item {{ $kelass->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $kelass->nextPageUrl() }}" aria-label="Next">
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

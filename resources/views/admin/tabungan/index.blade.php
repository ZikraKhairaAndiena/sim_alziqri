@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center fw-bold mb-4">Tabungan Siswa</h2>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('admin.tabungan.create') }}" class="btn btn-success btn-sm">Tambah Tabungan</a>

                        <form method="GET" action="{{ route('admin.tabungan.index') }}" class="d-flex">
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control me-2" placeholder="Cari nama siswa...">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Saldo</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswaList as $index => $siswa)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $siswa['nama_siswa'] }}</td>
                                        <td>Rp {{ number_format($siswa['saldo'], 0, ',', '.') }}</td>
                                        <td class="text-nowrap">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.tabungan.riwayat', $siswa['id']) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail">
                                                    <i class='mdi mdi-eye'></i>
                                                </a>
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
                                    <li class="page-item {{ $siswaList->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $siswaList->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <!-- Loop untuk nomor halaman -->
                                    @for ($i = 1; $i <= $siswaList->lastPage(); $i++)
                                        <li class="page-item {{ ($siswaList->currentPage() == $i) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $siswaList->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <!-- Tombol Next -->
                                    <li class="page-item {{ $siswaList->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $siswaList->nextPageUrl() }}" aria-label="Next">
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

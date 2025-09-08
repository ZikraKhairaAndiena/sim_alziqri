@extends('admin.layouts.main')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center fw-bold mb-4">Daftar Pendaftaran Siswa</h4>
                    <div class="table-responsive">
                        <div class="d-flex justify-content-end mb-3">
                            <form action="{{ route('admin.ppdb.admin') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control me-2"
                                    placeholder="Cari Nama Siswa..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ppdbs as $index => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->thn_ajaran->nama }}</td>
                                    <td>{{ $item->siswa->nama_siswa }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tgl_daftar)->format('d-m-Y') }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('admin.ppdb.show', $item->id) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail"><i class='mdi mdi-eye'></i></a>
                                        <a href="{{ route('admin.ppdb.cetak', $item->id) }}"class="btn btn-danger btn-sm" title="Cetak Bukti Pendaftaran" target="_blank"><i class="mdi mdi-printer"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-4">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <!-- Tombol Previous -->
                                    <li class="page-item {{ $ppdbs->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $ppdbs->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <!-- Loop untuk nomor halaman -->
                                    @for ($i = 1; $i <= $ppdbs->lastPage(); $i++)
                                        <li class="page-item {{ ($ppdbs->currentPage() == $i) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $ppdbs->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <!-- Tombol Next -->
                                    <li class="page-item {{ $ppdbs->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $ppdbs->nextPageUrl() }}" aria-label="Next">
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

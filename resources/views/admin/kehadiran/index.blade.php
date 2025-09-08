@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center fw-bold mb-4">Kehadiran Siswa</h2>
                    <a href="{{ route('admin.kehadiran.create') }}" class="btn btn-success btn-sm mb-3">Tambah Kehadiran</a>

                    {{-- Filter & Export --}}
                    <form action="{{ route('admin.kehadiran.export') }}" method="GET" class="row g-2 mb-3 align-items-end">
                        <div class="col-md-4">
                            <label for="kelas" class="form-label">Pilih Kelas</label>
                            <select name="kelas_id" id="kelas" class="form-select" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="bulan" class="form-label">Pilih Bulan</label>
                            <input type="month" name="bulan" id="bulan" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                 <i class="mdi mdi-file-excel me-1"></i>
                            </button>
                        </div>
                    </form>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kehadirans as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->kelas->nama_kelas }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                            <td class="text-nowrap">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.kehadiran.show', $item->id) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail">
                                                        <i class='mdi mdi-eye'></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada data kehadiran</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <!-- Tombol Previous -->
                                        <li class="page-item {{ $kehadirans->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $kehadirans->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        <!-- Loop untuk nomor halaman -->
                                        @for ($i = 1; $i <= $kehadirans->lastPage(); $i++)
                                            <li class="page-item {{ ($kehadirans->currentPage() == $i) ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $kehadirans->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        <!-- Tombol Next -->
                                        <li class="page-item {{ $kehadirans->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $kehadirans->nextPageUrl() }}" aria-label="Next">
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

@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fw-bold text-dark mb-0">Kehadiran Anak: {{ $siswa->nama_siswa }}</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kehadirans as $kehadiran)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($kehadiran->tanggal)->format('d-m-Y') }}</td>
                                            <td>{{ ucfirst($kehadiran->status) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada kehadiran.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <!-- Tombol Previous -->
                                        <li class="page-item {{ $kehadirans->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $kehadirans->previousPageUrl() }}"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        <!-- Loop untuk nomor halaman -->
                                        @for ($i = 1; $i <= $kehadirans->lastPage(); $i++)
                                            <li class="page-item {{ $kehadirans->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $kehadirans->url($i) }}">{{ $i }}</a>
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

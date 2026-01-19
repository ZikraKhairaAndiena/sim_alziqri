@extends('admin.layouts.main')

@section('title', 'Data Kriteria Penilaian')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center fw-bold mb-4">Data Kriteria Penilaian</h2>
                        <div class="table-responsive">
                            <a href="{{ route('admin.kriteria.create') }}" class="btn btn-success btn-sm mb-3">Tambah
                                Kriteria</a>

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Kriteria</th>
                                        <th>Deskripsi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kriterias as $kriteria)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $kriteria->nama_kriteria }}</td>
                                            <td>{{ $kriteria->deskripsi ?? '-' }}</td>
                                            <td class="text-nowrap text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.kriteria.edit', $kriteria->id) }}"
                                                        class="btn btn-warning btn-sm me-1" title="Edit Data">
                                                        <i class='mdi mdi-pencil'></i>
                                                    </a>
                                                    <form action="{{ route('admin.kriteria.destroy', $kriteria->id) }}"
                                                        method="POST" class="d-inline form-delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-delete"
                                                            onclick="return confirm('Yakin akan menghapus data ini?')">
                                                            <i class='mdi mdi-delete'></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada data kriteria
                                                penilaian</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li class="page-item {{ $kriterias->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $kriterias->previousPageUrl() }}"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        @for ($i = 1; $i <= $kriterias->lastPage(); $i++)
                                            <li class="page-item {{ $kriterias->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $kriterias->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item {{ $kriterias->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $kriterias->nextPageUrl() }}" aria-label="Next">
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

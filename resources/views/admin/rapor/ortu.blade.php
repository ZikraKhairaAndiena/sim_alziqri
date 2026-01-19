@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">

                        <h4 class="fw-bold text-dark mb-0">Rapor Anak: {{ $siswa->nama_siswa }}</h4>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Semester</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Semester 1 --}}
                                    <tr>
                                        <td>Semester 1</td>
                                        <td>{{ $tahunAjaran }}</td>
                                        <td>
                                            @if ($rapor_semester_1)
                                                <a href="{{ route('admin.rapor.cetak', $rapor_semester_1->id) }}"
                                                    class="btn btn-primary btn-sm" target="_blank">
                                                    <i class="bx bx-printer"></i> Cetak
                                                </a>
                                            @else
                                                <span class="badge bg-secondary">Belum tersedia</span>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Semester 2 --}}
                                    <tr>
                                        <td>Semester 2</td>
                                        <td>{{ $tahunAjaran }}</td>
                                        <td>
                                            @if ($rapor_semester_2)
                                                <a href="{{ route('admin.rapor.cetak', $rapor_semester_2->id) }}"
                                                    class="btn btn-primary btn-sm" target="_blank">
                                                    <i class="bx bx-printer"></i> Cetak
                                                </a>
                                            @else
                                                <span class="badge bg-secondary">Belum tersedia</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

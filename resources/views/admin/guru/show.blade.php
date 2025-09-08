@extends('admin.layouts.main')

@section('title', 'Detail Guru')

@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h4 class="fw-bold text-dark mb-0">Detail Guru</h4>
        </div>
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="text-center">
                            {{-- Foto Guru --}}
                            @if ($guru->foto)
                                <img src="{{ asset('img/' . $guru->foto) }}"
                                    alt="Foto {{ $guru->nama_guru }}"
                                    class="img-thumbnail mb-3"
                                    style="max-width: 200px;">
                            @else
                                <img src="{{ asset('images/default-user.png') }}"
                                    alt="Default Foto"
                                    class="img-thumbnail mb-3"
                                    style="max-width: 200px;">
                            @endif
                        </div>

                        {{-- Data Guru --}}
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>{{ $guru->nama_guru }}</td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td>{{ $guru->jabatan }}</td>
                                </tr>
                                <tr>
                                    <th>NIP</th>
                                    <td>{{ $guru->nip }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ \Carbon\Carbon::parse($guru->tgl_lahir)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $guru->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>No. Telepon</th>
                                    <td>{{ $guru->no_telp }}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan Terakhir</th>
                                    <td>{{ $guru->pend_terakhir }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Mulai Mengajar</th>
                                    <td>{{ \Carbon\Carbon::parse($guru->tgl_mulai_ngajar)->format('d-m-Y') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary mt-3">
                                <i class="bx bx-arrow-back me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.main')

@section('title', 'Detail Siswa')

@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h4 class="fw-bold text-dark mb-0">Detail Siswa</h4>
        </div>
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="text-center">
                            {{-- Foto siswa --}}
                            @if ($siswa->foto)
                                <img src="{{ asset('img/' . $siswa->foto) }}"
                                    alt="Foto {{ $siswa->nama_siswa }}"
                                    class="img-thumbnail mb-3"
                                    style="max-width: 200px;">
                            @else
                                <img src="{{ asset('images/default-user.png') }}"
                                    alt="Default Foto"
                                    class="img-thumbnail mb-3"
                                    style="max-width: 200px;">
                            @endif
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>NISN</th>
                                    <td>{{ $siswa->nisn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td>{{ $siswa->tmp_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ $siswa->tgl_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td>{{ ucfirst($siswa->agama) }}</td>
                                </tr>
                                <tr>
                                    <th>Suku Bangsa</th>
                                    <td>{{ $siswa->suku_bangsa }}</td>
                                </tr>
                                <tr>
                                    <th>Anak Ke</th>
                                    <td>{{ $siswa->anak_ke }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Saudara Kandung</th>
                                    <td>{{ $siswa->jmlh_saudara_kandung }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $siswa->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Tinggal</th>
                                    <td>{{ ucfirst(str_replace('_', ' ', $siswa->tmp_tinggal)) }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Wali</th>
                                    <td>{{ $siswa->nama_wali }}</td>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <td>{{ $siswa->no_telp }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $siswa->no_nik }}</td>
                                </tr>
                                <tr>
                                    <th>No KK</th>
                                    <td>{{ $siswa->no_kk }}</td>
                                </tr>
                                <tr>
                                    <th>No Akte Kelahiran</th>
                                    <td>{{ $siswa->no_akte }}</td>
                                </tr>
                                <tr>
                                    <th>Gambar KK</th>
                                    <td>
                                        @if($siswa->foto_kk)
                                            <img src="{{ asset('img/' . $siswa->foto_kk) }}"
                                                alt="{{ $siswa->nama_siswa }}"
                                                width="200"
                                                class="img-thumbnail">
                                        @else
                                            <em>Belum diunggah</em>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Gambar Akte</th>
                                    <td>
                                        @if($siswa->foto_akte)
                                            <img src="{{ asset('img/' . $siswa->foto_akte) }}"
                                                alt="{{ $siswa->nama_siswa }}"
                                                width="200"
                                                class="img-thumbnail">
                                        @else
                                            <em>Belum diunggah</em>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $siswa->status }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary mt-3">
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

<style>
    .table img.img-thumbnail {
        width: 500px !important; /* sebelumnya 200px */
        height: auto !important;
        border-radius: 0 !important; /* supaya tidak bulat */
        object-fit: contain !important; /* supaya gambar tidak terpotong */
    }
</style>


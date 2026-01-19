@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card-header text-center">
                        <h4 class="card-title text-center fw-bold mb-4">Status Pendaftaran PPDB</h4>
                    </div>
                    <div class="card-body">
                        @if ($ppdbs)
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $ppdbs->siswa->nama_siswa }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Daftar</th>
                                        <td>{{ \Carbon\Carbon::parse($ppdbs->tgl_daftar)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <td>{{ $ppdbs->thn_ajaran->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($ppdbs->status === 'Diterima')
                                                <span class="badge bg-success">Diterima</span>
                                            @elseif ($ppdbs->status === 'Ditolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Diproses</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            @if ($ppdbs->status === 'Diterima')
                                <div class="alert alert-info mt-3 text-center">
                                    Silahkan melakukan pembayaran <a href="{{ route('admin.pembayaran.index') }}">di
                                        sini</a>.
                                </div>
                            @endif
                        @else
                            <div class="text-center">
                                <p>Anda belum mendaftarkan siswa.</p>
                                <a href="{{ route('orang_tua.ppdb.create') }}" class="btn btn-primary">Daftar Sekarang</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

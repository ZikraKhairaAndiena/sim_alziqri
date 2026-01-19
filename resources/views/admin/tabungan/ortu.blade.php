@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fw-bold text-dark mb-0">Tabungan Anak: {{ $siswa->nama_siswa }}</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Saldo</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tabungans as $tabungan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tabungan->tanggal)->format('d-m-Y') }}</td>
                                            <td>{{ ucfirst($tabungan->jenis_transaksi) }}</td>
                                            <td>Rp{{ number_format($tabungan->jumlah, 0, ',', '.') }}</td>
                                            <td>Rp{{ number_format($tabungan->saldo, 0, ',', '.') }}</td>
                                            <td>{{ $tabungan->ket }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada transaksi tabungan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

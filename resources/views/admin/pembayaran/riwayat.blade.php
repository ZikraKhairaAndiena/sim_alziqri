@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="fw-bold text-dark mb-3">Riwayat Pembayaran - {{ $siswa->nama_siswa }}</h4>

                {{-- Rincian Biaya --}}
                <div class="alert alert-info">
                    <h5 class="fw-bold mb-2">📋 Rincian Pembayaran Uang Sekolah (1 Tahun)</h5>
                    <ul class="mb-1">
                        <li>Uang pakaian (4 stel baju dan tas) <strong>Rp 720.000</strong></li>
                        <li>Uang partisipasi dan kegiatan <strong>Rp 1.080.000</strong></li>
                        <li>Uang bangunan <strong>Rp 200.000</strong></li>
                    </ul>
                    <p class="fw-bold mt-2">Total Tagihan: Rp {{ number_format($totalTagihan, 0, ',', '.') }}</p>
                    <p class="mb-1 text-success">Sudah Dibayar: Rp {{ number_format($totalTerbayar, 0, ',', '.') }}</p>
                    <p class="mb-1 text-danger">Sisa Tagihan: Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</p>

                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $persentaseBayar }}%"
                            aria-valuenow="{{ $persentaseBayar }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $persentaseBayar }}%
                        </div>
                    </div>
                </div>

                {{-- Tabel Riwayat Pembayaran --}}
                <div class="table-responsive mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Bayar</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayarans as $index => $pembayaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d/m/Y') }}</td>
                                    <td>Rp {{ number_format($pembayaran->nominal_bayar, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($pembayaran->status_bayar) }}</td>
                                    <td>
                                        @if ($pembayaran->status_bayar == 'pending')
                                            <a href="{{ $pembayaran->link_pembayaran }}"
                                                class="btn btn-sm btn-primary">Bayar</a>
                                        @else
                                            <a href="{{ route('admin.pembayaran.invoice', $pembayaran->id) }}"
                                                class="btn btn-sm btn-warning" target="_blank">Cetak Invoice</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada pembayaran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
            </div>
        </div>
    </div>
@endsection

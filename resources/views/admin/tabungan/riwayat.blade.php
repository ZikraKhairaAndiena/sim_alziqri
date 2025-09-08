@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="card shadow-sm">
        <!-- Header -->
        <div class="card-header bg-white text-center">
            <h4 class="fw-bold mb-0">RIWAYAT TABUNGAN SISWA</h4>
            <div class="mt-1">{{ $siswa->nama_siswa }}</div>
        </div>

        <!-- Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Transaksi</th>
                            <th>Jumlah</th>
                            <th>Saldo</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tabungans as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $siswa->nama_siswa }}</td>
                                <td>{{ strtoupper($item->jenis_transaksi) }}</td>
                                <td>Rp. {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($item->saldo, 0, ',', '.') }}</td>
                                <td>{{ $item->ket }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada riwayat transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.tabungan.index') }}" class="btn btn-secondary mt-3">
                        <i class="bx bx-arrow-back me-1"></i> Kembali
                    </a>
                    <a href="{{ route('admin.tabungan.cetak', $siswa->id) }}" class="btn btn-sm btn-danger ms-1" target="_blank" title="Cetak PDF"><i class="mdi mdi-file-pdf-box"></i></a>
                </div>
            </div>

            {{-- <div class="mt-3">
                <a href="{{ route('admin.tabungan.index') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                <a href="{{ route('admin.tabungan.cetak', $siswa->id) }}" class="btn btn-sm btn-danger ms-1" target="_blank" title="Cetak PDF"><i class="mdi mdi-file-pdf-box"></i></a>
            </div> --}}
        </div>
    </div>
</div>
@endsection

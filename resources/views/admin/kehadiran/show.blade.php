@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h4 class="fw-bold text-dark mb-0">Kehadiran Siswa - {{ $kehadiran->kelas->nama_kelas }}</h4>
        </div>
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($kehadiran->tanggal)->format('d-m-Y') }}</p>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kehadiran_siswa as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                        <td>{{ ucfirst($item->status) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada data kehadiran untuk tanggal ini</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.kehadiran.index') }}" class="btn btn-secondary">
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

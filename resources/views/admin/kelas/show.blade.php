@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center fw-bold mb-4">
                            Detail Kelas: {{ $kelas->nama_kelas }}
                        </h2>

                        <div class="mb-4">
                            <p><strong>Tahun Ajaran:</strong> {{ $kelas->tahunAjaran->nama ?? 'N/A' }}</p>
                            <p><strong>Guru Kelas:</strong> {{ $kelas->guru->nama_guru ?? 'N/A' }}</p>
                        </div>

                        <h4 class="fw-bold mb-3">Daftar Siswa</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>NISN</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kelas->siswas as $siswa)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $siswa->nama_siswa }}</td>
                                            <td>{{ $siswa->nisn }}</td>
                                            <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $siswa->status == 'aktif' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($siswa->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Belum ada siswa di kelas ini
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary mt-3">
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

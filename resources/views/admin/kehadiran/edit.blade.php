@extends('admin.layouts.main')

@section('title', 'Edit Kehadiran')

@section('content')
    <div class="content-wrapper">

        <div class="card shadow-sm mt-3">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0">Edit Kehadiran</h4>
                <a href="{{ route('admin.kehadiran.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.kehadiran.update', $kehadiran->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Pilih Siswa -->
                    <div class="mb-3">
                        <label for="siswa_id" class="form-label">Nama Siswa</label>
                        <select name="siswa_id" id="siswa_id" class="form-select @error('siswa_id') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}"
                                    {{ old('siswa_id', $kehadiran->siswa_id) == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('siswa_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal', $kehadiran->tanggal) }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Kehadiran</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Status --</option>
                            <option value="hadir" {{ old('status', $kehadiran->status) == 'hadir' ? 'selected' : '' }}>
                                Hadir</option>
                            <option value="izin" {{ old('status', $kehadiran->status) == 'izin' ? 'selected' : '' }}>Izin
                            </option>
                            <option value="sakit" {{ old('status', $kehadiran->status) == 'sakit' ? 'selected' : '' }}>
                                Sakit</option>
                            <option value="alpha" {{ old('status', $kehadiran->status) == 'alpha' ? 'selected' : '' }}>
                                Alpha</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Perbarui
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

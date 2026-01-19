@extends('admin.layouts.main')

@section('title', 'Edit Tahun Ajaran')

@section('content')
    <div class="content-wrapper">

        <div class="card shadow-sm">
            <!-- Header -->
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark mb-0">Edit Tahun Ajaran</h4>
            </div>

            <!-- Body -->
            <div class="card-body">
                <form action="{{ route('admin.thn_ajaran.update', $thn_ajaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Tahun Ajaran<span class="text-danger">*</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" value="{{ old('nama', $thn_ajaran->nama) }}" placeholder="Contoh: 2025/2026"
                            maxlength="15" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status<span class="text-danger">*</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif" {{ old('status', $thn_ajaran->status) == 'aktif' ? 'selected' : '' }}>
                                Aktif</option>
                            <option value="tidak_aktif"
                                {{ old('status', $thn_ajaran->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.thn_ajaran.index') }}" class="btn btn-secondary d-flex align-items-center">
                            <i class="bx bx-arrow-back me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary d-flex align-items-center">
                            <i class="bx bx-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

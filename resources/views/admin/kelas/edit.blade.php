@extends('admin.layouts.main')

@section('title', 'Edit Kelas')

@section('content')
    <div class="content-wrapper">

        <div class="card shadow-sm">
            <!-- Header -->
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark mb-0">Edit Kelas</h4>
            </div>

            <!-- Body -->
            <div class="card-body">
                <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Tahun Ajaran (readonly) -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tahun Ajaran</label>
                        <input type="text" class="form-control" value="{{ $kelas->tahunAjaran->nama }}" disabled>
                        <input type="hidden" name="thn_ajaran_id" value="{{ $kelas->thn_ajaran_id }}">
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama_kelas" class="form-label fw-semibold">Nama Kelas<span class="text-danger">*</label>
                        <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas"
                            name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                            placeholder="Contoh: Kelas A" maxlength="20" required>
                        @error('nama_kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Guru -->
                    <div class="mb-3">
                        <label for="guru_id" class="form-label fw-semibold">Wali Kelas (Guru)<span
                                class="text-danger">*</span></label>
                        <select name="guru_id" id="guru_id" class="form-select @error('guru_id') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Guru --</option>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id }}"
                                    {{ old('guru_id', $kelas->guru_id) == $guru->id ? 'selected' : '' }}>
                                    {{ $guru->nama_guru }}
                                </option>
                            @endforeach
                        </select>
                        @error('guru_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary d-flex align-items-center">
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

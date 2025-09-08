@extends('admin.layouts.main')

@section('title', 'Edit Guru')

@section('content')
<div class="content-wrapper">
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Data Guru</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Akun User</label>
                <input type="text" class="form-control" value="{{ $guru->user->name }}" disabled>
                <input type="hidden" name="user_id" value="{{ $guru->user_id }}">
            </div>

            <div class="mb-3">
                <label class="form-label">NIP<span class="text-danger">*</span></label>
                <input type="text" name="nip" maxlength="30"
                       class="form-control @error('nip') is-invalid @enderror"
                       value="{{ old('nip', $guru->nip) }}" required>
                @error('nip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_guru" maxlength="100"
                       class="form-control @error('nama_guru') is-invalid @enderror"
                       value="{{ old('nama_guru', $guru->nama_guru) }}" required>
                @error('nama_guru')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jabatan<span class="text-danger">*</span></label>
                <select name="jabatan" class="form-select @error('jabatan') is-invalid @enderror" required>
                    <option value="kepala_sekolah" {{ old('jabatan', $guru->jabatan) == 'kepala_sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                    <option value="guru_kelas" {{ old('jabatan', $guru->jabatan) == 'guru_kelas' ? 'selected' : '' }}>Guru Kelas</option>
                </select>
                @error('jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="L" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                <input type="date" name="tgl_lahir"
                       class="form-control @error('tgl_lahir') is-invalid @enderror"
                       value="{{ old('tgl_lahir', $guru->tgl_lahir) }}" required>
                @error('tgl_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat<span class="text-danger">*</span></label>
                <textarea name="alamat" rows="3"
                          class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $guru->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">No. Telepon<span class="text-danger">*</span></label>
                <input type="text" name="no_telp" maxlength="15"
                       class="form-control @error('no_telp') is-invalid @enderror"
                       value="{{ old('no_telp', $guru->no_telp) }}" required>
                @error('no_telp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Mulai Mengajar<span class="text-danger">*</span></label>
                <input type="date" name="tgl_mulai_ngajar"
                       class="form-control @error('tgl_mulai_ngajar') is-invalid @enderror"
                       value="{{ old('tgl_mulai_ngajar', $guru->tgl_mulai_ngajar) }}" required>
                @error('tgl_mulai_ngajar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Pendidikan Terakhir<span class="text-danger">*</span></label>
                <input type="text" name="pend_terakhir" maxlength="30"
                       class="form-control @error('pend_terakhir') is-invalid @enderror"
                       value="{{ old('pend_terakhir', $guru->pend_terakhir) }}" required>
                @error('pend_terakhir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                    <label>Foto guru<span class="text-danger">*</span></label><br>
                    @if($guru->foto)
                        <img src="{{ asset('img/' . $guru->foto) }}" alt="Foto guru" width="100" class="mb-2"><br>
                    @endif
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                    <small class="form-text text-muted">Format file: jpeg, png, jpg, gif. Maksimal ukuran 2 MB.</small>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

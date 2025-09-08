@extends('admin.layouts.main')

@section('title', 'Tambah Guru')

@section('content')
<div class="content-wrapper">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="fw-bold text-dark mb-0">Tambah Guru</h4>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card-body">
            <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="user_id">Akun User<span class="text-danger">*</span></label>
                    <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Akun --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">NIP<span class="text-danger">*</span></label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                           value="{{ old('nip') }}" required>
                    @error('nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap<span class="text-danger">*</span></label>
                    <input type="text" name="nama_guru" class="form-control @error('nama_guru') is-invalid @enderror"
                           value="{{ old('nama_guru') }}" required>
                    @error('nama_guru')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jabatan --}}
                <div class="mb-3">
                    <label for="form-label fw-semibold">Jabatan<span class="text-danger">*</span></label>
                    <select name="jabatan" id="jabatan" class="form-select @error('jabatan') is-invalid @enderror" required>
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="kepala_sekolah" {{ old('jabatan') == 'kepala_sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                        <option value="guru_kelas" {{ old('jabatan') == 'guru_kelas' ? 'selected' : '' }}>Guru Kelas</option>
                    </select>
                    @error('jabatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Jenis Kelamin<span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Lahir<span class="text-danger">*</span></label>
                    <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror"
                           value="{{ old('tgl_lahir') }}" required>
                    @error('tgl_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat<span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">No. Telepon<span class="text-danger">*</span></label>
                    {{-- <small class="text-muted d-block mb-1">Gunakan format 628..., contoh: 628123456789</small> --}}
                    <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" maxlength="15"
                           value="{{ old('no_telp') }}" required>
                    @error('no_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pendidikan Terakhir<span class="text-danger">*</span></label>
                    <input type="text" name="pend_terakhir" class="form-control @error('pend_terakhir') is-invalid @enderror"
                           maxlength="30" value="{{ old('pend_terakhir') }}" required>
                    @error('pend_terakhir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Mulai Mengajar<span class="text-danger">*</span></label>
                    <input type="date" name="tgl_mulai_ngajar" class="form-control @error('tgl_mulai_ngajar') is-invalid @enderror"
                           value="{{ old('tgl_mulai_ngajar') }}" required>
                    @error('tgl_mulai_ngajar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Foto</label>
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
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
                        <i class="bx bx-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

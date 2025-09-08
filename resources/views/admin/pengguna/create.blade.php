@extends('admin.layouts.main')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="content-wrapper">

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Tambah Pengguna</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.pengguna.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label fw-semibold">Nama<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                       id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Pengguna" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role" class="form-label fw-semibold">Role<span class="text-danger">*</span></label>
                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="orang_tua" {{ old('role') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password<span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password" placeholder="Masukkan Password" required>
                <small class="form-text text-muted">Password minimal 5 karakter</small>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password<span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                       id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary d-flex align-items-center">
                    <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary d-flex align-items-center">
                    <i class="bx bx-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
</div>

@endsection

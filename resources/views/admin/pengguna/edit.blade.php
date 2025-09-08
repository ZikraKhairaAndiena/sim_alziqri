@extends('admin.layouts.main')

@section('title', 'Edit Pengguna')

@section('content')
<div class="content-wrapper">

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Pengguna</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label fw-semibold">Nama<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                       id="nama" name="nama" value="{{ old('nama', $user->nama) }}" placeholder="Masukkan Nama Pengguna" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan Email" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role" class="form-label fw-semibold">Role</label>
                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="orang_tua" {{ old('role', $user->role) == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password (optional) -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password Baru (Opsional)</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                       id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password Baru">
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
                    <i class="bx bx-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

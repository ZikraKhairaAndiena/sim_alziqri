@extends('admin.layouts.main')

@section('title', 'Tambah Rapor')

@section('content')
<div class="content-wrapper">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="fw-bold text-dark mb-0">Tambah Rapor</h4>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Form Tambah Rapor --}}
        <div class="card-body">
            <form action="{{ route('admin.rapor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Pilih Siswa --}}
                <div class="mb-3">
                    <label for="siswa_id" class="form-label fw-semibold">Siswa<span class="text-danger">*</span></label>
                    <select name="siswa_id" id="siswa_id"
                            class="form-select @error('siswa_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswas as $siswa)
                            <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                {{ $siswa->nama_siswa }}
                            </option>
                        @endforeach
                    </select>
                    @error('siswa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pilih Tahun Ajaran --}}

                {{-- Tahun Ajaran --}}
                <input type="hidden" name="thn_ajaran_id" value="{{ $thnAjarans->id }}">
                <div class="mb-3">
                    <label class="form-label">Tahun Ajaran</label>
                    <input type="text" class="form-control" value="{{ $thnAjarans->nama }}" disabled>
                </div>

                {{-- <div class="mb-3">
                    <label for="thn_ajaran_id" class="form-label">Tahun Ajaran<span class="text-danger">*</span></label>
                    <select name="thn_ajaran_id" id="thn_ajaran_id"
                            class="form-select @error('thn_ajaran_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Tahun Ajaran --</option>
                        @foreach($thnAjarans as $thn)
                            <option value="{{ $thn->id }}" {{ old('thn_ajaran_id') == $thn->id ? 'selected' : '' }}>
                                {{ $thn->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('thn_ajaran_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- Semester --}}
                <div class="mb-3">
                    <label for="semester" class="form-label fw-semibold">Semester<span class="text-danger">*</span></label>
                    <select name="semester" id="semester"
                            class="form-select @error('semester') is-invalid @enderror" required>
                        <option value="">-- Pilih Semester --</option>
                        <option value="1" {{ old('semester') == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ old('semester') == 2 ? 'selected' : '' }}>2</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <h5 class="fw-bold">Penilaian</h5>

                {{-- Agama --}}
                <div class="mb-3">
                    <label for="agama" class="form-label fw-semibold">Agama<span class="text-danger">*</span></label>
                    <textarea name="agama" id="agama" rows="6"
                              class="form-control @error('agama') is-invalid @enderror">{{ old('agama') }}</textarea>
                    @error('agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto_agama" class="form-label fw-semibold">Foto Kegiatan Agama Siswa<span class="text-danger">*</span></label>
                    <input type="file" name="foto_agama" id="foto_agama"
                           class="form-control @error('foto_agama') is-invalid @enderror" accept="image/*">
                    @error('foto_agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jati Diri --}}
                <div class="mb-3">
                    <label for="jati_diri" class="form-label fw-semibold">Jati Diri<span class="text-danger">*</span></label>
                    <textarea name="jati_diri" id="jati_diri" rows="6"
                              class="form-control @error('jati_diri') is-invalid @enderror">{{ old('jati_diri') }}</textarea>
                    @error('jati_diri')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto_jati_diri" class="form-label fw-semibold">Foto Kegiatan Jati Diri Siswa<span class="text-danger">*</span></label>
                    <input type="file" name="foto_jati_diri" id="foto_jati_diri"
                           class="form-control @error('foto_jati_diri') is-invalid @enderror" accept="image/*">
                    @error('foto_jati_diri')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Literasi --}}
                <div class="mb-3">
                    <label for="literasi" class="form-label fw-semibold">Literasi<span class="text-danger">*</span></label>
                    <textarea name="literasi" id="literasi" rows="6"
                              class="form-control @error('literasi') is-invalid @enderror">{{ old('literasi') }}</textarea>
                    @error('literasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto_literasi" class="form-label fw-semibold">Foto Kegiatan Literasi Siswa<span class="text-danger">*</span></label>
                    <input type="file" name="foto_literasi" id="foto_literasi"
                           class="form-control @error('foto_literasi') is-invalid @enderror" accept="image/*">
                    @error('foto_literasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- STEAM --}}
                <div class="mb-3">
                    <label for="steam" class="form-label fw-semibold">STEAM<span class="text-danger">*</span></label>
                    <textarea name="steam" id="steam" rows="6"
                              class="form-control @error('steam') is-invalid @enderror">{{ old('steam') }}</textarea>
                    @error('steam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto_steam" class="form-label fw-semibold">Foto Kegiatan STEAM Siswa<span class="text-danger">*</span></label>
                    <input type="file" name="foto_steam" id="foto_steam"
                           class="form-control @error('foto_steam') is-invalid @enderror" accept="image/*">
                    @error('foto_steam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Simpan --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.rapor.index') }}" class="btn btn-secondary">
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

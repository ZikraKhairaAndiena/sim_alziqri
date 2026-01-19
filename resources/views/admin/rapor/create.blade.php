@extends('admin.layouts.main')

@section('title', 'Tambah Rapor')

@section('content')
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark mb-0">Tambah Rapor</h4>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card-body">
                <form action="{{ route('admin.rapor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="siswa_id" class="form-label fw-semibold">Siswa<span class="text-danger">*</span></label>
                        <select name="siswa_id" id="siswa_id" class="form-select @error('siswa_id') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->nama_siswa }}
                                </option>
                            @endforeach
                        </select>
                        @error('siswa_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="hidden" name="thn_ajaran_id" value="{{ $thnAjarans->id }}">
                    <div class="mb-3">
                        <label class="form-label">Tahun Ajaran</label>
                        <input type="text" class="form-control" value="{{ $thnAjarans->nama }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="semester" class="form-label fw-semibold">Semester<span
                                class="text-danger">*</span></label>
                        <select name="semester" id="semester" class="form-select @error('semester') is-invalid @enderror"
                            required>
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

                    @foreach ($kriterias as $kriteria)
                        <div class="mb-2">
                            <label class="form-label fw-semibold">{{ $loop->iteration }}.
                                {{ $kriteria->nama_kriteria }}</label>
                            <textarea name="penilaian[{{ $loop->index }}][deskripsi]" rows="5" class="form-control">{{ old("penilaian.$loop->index.deskripsi") }}</textarea>
                            <input type="hidden" name="penilaian[{{ $loop->index }}][kriteria_id]"
                                value="{{ $kriteria->id }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto {{ $kriteria->nama_kriteria }}</label>
                            <input type="file" name="penilaian[{{ $loop->index }}][foto]" class="form-control"
                                accept="image/*">
                        </div>
                    @endforeach

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

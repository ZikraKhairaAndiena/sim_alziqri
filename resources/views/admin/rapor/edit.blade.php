@extends('admin.layouts.main')

@section('title', 'Edit Rapor')

@section('content')
<div class="content-wrapper">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="fw-bold text-dark mb-0">Edit Rapor Siswa</h4>
        </div>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Edit Rapor --}}
        <div class="card-body">
            <form action="{{ route('admin.rapor.update', $rapor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Pilih Siswa --}}
                <div class="mb-3">
                    <label for="siswa_id" class="form-label fw-semibold">Siswa<span class="text-danger">*</span></label>
                    <select name="siswa_id" id="siswa_id" class="form-control" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswas as $siswa)
                            <option value="{{ $siswa->id }}" {{ $rapor->siswa_id == $siswa->id ? 'selected' : '' }}>
                                {{ $siswa->nama_siswa }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Pilih Tahun Ajaran --}}
                <div class="mb-3">
                    <label for="thn_ajaran_id" class="form-label fw-semibold">Tahun Ajaran</label>
                    <input type="hidden" name="thn_ajaran_id" value="{{ $thnAjarans->id }}">
                    <input type="text" class="form-control" value="{{ $thnAjarans->nama }}" disabled>
                </div>

                {{-- Semester --}}
                <div class="mb-3">
                    <label for="semester" class="form-label fw-semibold">Semester<span class="text-danger">*</span></label>
                    <select name="semester" id="semester" class="form-control" required>
                        <option value="">-- Pilih Semester --</option>
                        <option value="1" {{ $rapor->semester == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $rapor->semester == 2 ? 'selected' : '' }}>2</option>
                    </select>
                </div>

                <hr>
                <h5 class="fw-bold">Penilaian</h5>

                {{-- Agama --}}
                <div class="mb-3">
                    <label for="agama" class="form-label fw-semibold">Agama<span class="text-danger">*</span></label>
                    <textarea name="agama" id="agama" class="form-control" rows="6">{{ old('agama', $rapor->agama) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="foto_agama" class="form-label fw-semibold">Foto Agama</label><br>
                    @if($rapor->foto_agama)
                        <img src="{{ asset('img/' . $rapor->foto_agama) }}" alt="Foto Agama" width="80" class="mb-2">
                    @endif
                    <input type="file" name="foto_agama" id="foto_agama" class="form-control">
                </div>

                {{-- Jati Diri --}}
                <div class="mb-3">
                    <label for="jati_diri" class="form-label fw-semibold">Jati Diri<span class="text-danger">*</span></label>
                    <textarea name="jati_diri" id="jati_diri" class="form-control" rows="6">{{ old('jati_diri', $rapor->jati_diri) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="foto_jati_diri" class="form-label fw-semibold">Foto Kegiatan Jati Diri Siswa<span class="text-danger">*</span></label><br>
                    @if($rapor->foto_jati_diri)
                        <img src="{{ asset('img/' . $rapor->foto_jati_diri) }}" alt="Foto Jati Diri" width="80" class="mb-2">
                    @endif
                    <input type="file" name="foto_jati_diri" id="foto_jati_diri" class="form-control" accept="image/*">
                </div>

                {{-- Literasi --}}
                <div class="mb-3">
                    <label for="literasi" class="form-label fw-semibold">Literasi<span class="text-danger">*</span></label>
                    <textarea name="literasi" id="literasi" class="form-control" rows="6">{{ old('literasi', $rapor->literasi) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="foto_literasi" class="form-label fw-semibold">Foto Kegiatan Literasi Siswa<span class="text-danger">*</span></label><br>
                    @if($rapor->foto_literasi)
                        <img src="{{ asset('img/' . $rapor->foto_literasi) }}" alt="Foto Literasi" width="80" class="mb-2">
                    @endif
                    <input type="file" name="foto_literasi" id="foto_literasi" class="form-control" accept="image/*">
                </div>

                {{-- STEAM --}}
                <div class="mb-3">
                    <label for="steam" class="form-label fw-semibold">STEAM<span class="text-danger">*</span></label>
                    <textarea name="steam" id="steam" class="form-control" rows="6">{{ old('steam', $rapor->steam) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="foto_steam" class="form-label fw-semibold">Foto Kegiatan STEAM Siswa<span class="text-danger">*</span></label><br>
                    @if($rapor->foto_steam)
                        <img src="{{ asset('img/' . $rapor->foto_steam) }}" alt="Foto STEAM" width="80" class="mb-2">
                    @endif
                    <input type="file" name="foto_steam" id="foto_steam" class="form-control" accept="image/*">
                </div>

                {{-- Tombol Update --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.rapor.index') }}" class="btn btn-secondary">
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

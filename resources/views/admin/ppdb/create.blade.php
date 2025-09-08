@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h4 class="fw-bold text-dark mb-0">Formulir Pendaftaran PPDB</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('orang_tua.ppdb.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Siswa --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Siswa <span class="text-danger">*</span></label>
                    <input type="text" name="nama_siswa" value="{{ old('nama_siswa') }}"
                        class="form-control @error('nama_siswa') is-invalid @enderror" required>
                    @error('nama_siswa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jenis Kelamin --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" name="tmp_lahir" value="{{ old('tmp_lahir') }}"
                            class="form-control @error('tmp_lahir') is-invalid @enderror" required>
                        @error('tmp_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}"
                            class="form-control @error('tgl_lahir') is-invalid @enderror" required>
                        @error('tgl_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tempat Lahir --}}
                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tmp_lahir" value="{{ old('tmp_lahir') }}"
                        class="form-control @error('tmp_lahir') is-invalid @enderror" required>
                    @error('tmp_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- Tanggal Lahir --}}
                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}"
                        class="form-control @error('tgl_lahir') is-invalid @enderror" required>
                    @error('tgl_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Agama <span class="text-danger">*</span></label>
                        <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                            <option value="">-- Pilih --</option>
                            <option value="islam" {{ old('agama') == 'islam' ? 'selected' : '' }}>Islam</option>
                            <option value="kristen" {{ old('agama') == 'kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="hindu" {{ old('agama') == 'hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="budha" {{ old('agama') == 'budha' ? 'selected' : '' }}>Buddha</option>
                            <option value="kong_hu_cu" {{ old('agama') == 'kong_hu_cu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Suku Bangsa <span class="text-danger">*</span></label>
                        <input type="text" name="suku_bangsa" value="{{ old('suku_bangsa') }}"
                            class="form-control @error('suku_bangsa') is-invalid @enderror" required>
                        @error('suku_bangsa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Agama --}}
                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Agama <span class="text-danger">*</span></label>
                    <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="islam" {{ old('agama') == 'islam' ? 'selected' : '' }}>Islam</option>
                        <option value="kristen" {{ old('agama') == 'kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="hindu" {{ old('agama') == 'hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="budha" {{ old('agama') == 'budha' ? 'selected' : '' }}>Buddha</option>
                        <option value="kong_hu_cu" {{ old('agama') == 'kong_hu_cu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                    @error('agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- Suku Bangsa --}}
                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Suku Bangsa <span class="text-danger">*</span></label>
                    <input type="text" name="suku_bangsa" value="{{ old('suku_bangsa') }}"
                        class="form-control @error('suku_bangsa') is-invalid @enderror" required>
                    @error('suku_bangsa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Anak Ke<span class="text-danger">*</span></label>
                        <input type="number" name="anak_ke" value="{{ old('anak_ke') }}"
                            class="form-control @error('anak_ke') is-invalid @enderror">
                        @error('anak_ke')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Jumlah Saudara Kandung </label>
                        <input type="number" name="jmlh_saudara_kandung" value="{{ old('jmlh_saudara_kandung') }}"
                            class="form-control @error('jmlh_saudara_kandung') is-invalid @enderror">
                        @error('jmlh_saudara_kandung')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Anak Ke --}}
                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Anak Ke<span class="text-danger">*</span></label>
                    <input type="number" name="anak_ke" value="{{ old('anak_ke') }}"
                        class="form-control @error('anak_ke') is-invalid @enderror">
                    @error('anak_ke')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- Jumlah Saudara Kandung --}}
                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Jumlah Saudara Kandung </label>
                    <input type="number" name="jmlh_saudara_kandung" value="{{ old('jmlh_saudara_kandung') }}"
                        class="form-control @error('jmlh_saudara_kandung') is-invalid @enderror">
                    @error('jmlh_saudara_kandung')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Bertempat Tinggal Pada <span class="text-danger">*</span></label>
                        <select name="tmp_tinggal" class="form-select @error('tmp_tinggal') is-invalid @enderror" required>
                            <option value="">-- Pilih --</option>
                            <option value="orang_tua" {{ old('tmp_tinggal') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                            <option value="wali" {{ old('tmp_tinggal') == 'wali' ? 'selected' : '' }}>Wali</option>
                            <option value="nenek" {{ old('tmp_tinggal') == 'nenek' ? 'selected' : '' }}>Nenek</option>
                            <option value="saudara" {{ old('tmp_tinggal') == 'saudara' ? 'selected' : '' }}>Saudara</option>
                        </select>
                        @error('tmp_tinggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Alamat --}}
                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- Tempat Tinggal --}}
                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Bertempat Tinggal Pada <span class="text-danger">*</span></label>
                    <select name="tmp_tinggal" class="form-select @error('tmp_tinggal') is-invalid @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="orang_tua" {{ old('tmp_tinggal') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                        <option value="wali" {{ old('tmp_tinggal') == 'wali' ? 'selected' : '' }}>Wali</option>
                        <option value="nenek" {{ old('tmp_tinggal') == 'nenek' ? 'selected' : '' }}>Nenek</option>
                        <option value="saudara" {{ old('tmp_tinggal') == 'saudara' ? 'selected' : '' }}>Saudara</option>
                    </select>
                    @error('tmp_tinggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">No NIK <span class="text-danger">*</span></label>
                        <input type="text" name="no_nik" value="{{ old('no_nik') }}"
                            class="form-control @error('no_nik') is-invalid @enderror" required>
                        @error('no_nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">No KK <span class="text-danger">*</span></label>
                        <input type="text" name="no_kk" value="{{ old('no_kk') }}"
                            class="form-control @error('no_kk') is-invalid @enderror" required>
                        @error('no_kk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- No NIK --}}
                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">No NIK <span class="text-danger">*</span></label>
                    <input type="text" name="no_nik" value="{{ old('no_nik') }}"
                        class="form-control @error('no_nik') is-invalid @enderror" required>
                    @error('no_nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- No KK --}}
                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">No KK <span class="text-danger">*</span></label>
                    <input type="text" name="no_kk" value="{{ old('no_kk') }}"
                        class="form-control @error('no_kk') is-invalid @enderror" required>
                    @error('no_kk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- No Akte --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">No Akte Kelahiran <span class="text-danger">*</span></label>
                    <input type="text" name="no_akte" value="{{ old('no_akte') }}"
                        class="form-control @error('no_akte') is-invalid @enderror" required>
                    @error('no_akte')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama Wali --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Wali <span class="text-danger">*</span></label>
                    <input type="text" name="nama_wali" value="{{ old('nama_wali') }}"
                        class="form-control @error('nama_wali') is-invalid @enderror" required>
                    @error('nama_wali')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- No Telepon --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">No Telepon Wali<span class="text-danger">*</span></label>
                    {{-- <small class="text-muted d-block mb-1">Gunakan format 628..., contoh: 628123456789</small> --}}
                    <input type="text" name="no_telp" value="{{ old('no_telp') }}"
                        class="form-control @error('no_telp') is-invalid @enderror" required>
                    @error('no_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Upload KK --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Upload KK<span class="text-danger">*</span></label>
                    <input type="file" name="foto_kk" class="form-control @error('foto_kk') is-invalid @enderror" id="foto_kk">
                    <small class="form-text text-muted">Format file: jpeg, png, jpg, gif. Maksimal ukuran 2 MB.</small>
                    @error('foto_kk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Upload Akte --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Upload Akte Kelahiran<span class="text-danger">*</span></label>
                    <input type="file" name="foto_akte" class="form-control @error('foto_akte') is-invalid @enderror" id="foto_akte">
                    <small class="form-text text-muted">Format file: jpeg, png, jpg, gif. Maksimal ukuran 2 MB.</small>
                    @error('foto_akte')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="thn_ajaran_id" value="{{ $tahunAktif->id }}">

                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i> Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

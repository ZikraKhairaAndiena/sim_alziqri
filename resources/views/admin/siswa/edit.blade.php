@extends('admin.layouts.main')

@section('title', 'Edit Siswa')

@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h4 class="fw-bold text-dark mb-0">Edit Data Siswa</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">NISN<span class="text-danger">*</span></label>
                    <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn', $siswa->nisn) }}" placeholder="Masukkan NISN" required>
                    @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Siswa<span class="text-danger">*</span></label>
                    <input type="text" name="nama_siswa"class="form-control @error('nama_siswa') is-invalid @enderror"value="{{ old('nama_siswa', $siswa->nama_siswa) }}"placeholder="Masukkan nama siswa" required>
                    @error('nama_siswa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kelas<span class="text-danger">*</span></label>
                    <select name="kelas_id" id="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id', $siswa->kelas_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Kelamin<span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- <div class="mb-3">
                    <label>Tempat Lahir<span class="text-danger">*</span></label>
                    <input type="text" name="tmp_lahir" class="form-control @error('tmp_lahir') is-invalid @enderror" value="{{ old('tmp_lahir', $siswa->tmp_lahir) }}" placeholder="Masukkan tempat lahir" required>
                    @error('tmp_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label>Tanggal Lahir<span class="text-danger">*</span></label>
                    <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', $siswa->tgl_lahir) }}" required>
                    @error('tgl_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div> --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tempat Lahir<span class="text-danger">*</span></label>
                        <input type="text" name="tmp_lahir" class="form-control @error('tmp_lahir') is-invalid @enderror" value="{{ old('tmp_lahir', $siswa->tmp_lahir) }}" placeholder="Masukkan tempat lahir" required>
                            @error('tmp_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Lahir<span class="text-danger">*</span></label>
                        <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', $siswa->tgl_lahir) }}" required>
                    @error('tgl_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Agama<span class="text-danger">*</span></label>
                        <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                            <option value="islam" {{ old('agama', $siswa->agama) == 'islam' ? 'selected' : '' }}>Islam</option>
                            <option value="kristen" {{ old('agama', $siswa->agama) == 'kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="budha" {{ old('agama', $siswa->agama) == 'budha' ? 'selected' : '' }}>Budha</option>
                            <option value="hindu" {{ old('agama', $siswa->agama) == 'hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="kong_hu_cu" {{ old('agama', $siswa->agama) == 'kong_hu_cu' ? 'selected' : '' }}>Kong Hu Cu</option>
                        </select>
                        @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Suku Bangsa<span class="text-danger">*</span></label>
                    <input type="text" name="suku_bangsa" class="form-control @error('suku_bangsa') is-invalid @enderror" value="{{ old('suku_bangsa', $siswa->suku_bangsa) }}">
                    @error('suku_bangsa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Agama<span class="text-danger">*</span></label>
                    <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                        <option value="islam" {{ old('agama', $siswa->agama) == 'islam' ? 'selected' : '' }}>Islam</option>
                        <option value="kristen" {{ old('agama', $siswa->agama) == 'kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="budha" {{ old('agama', $siswa->agama) == 'budha' ? 'selected' : '' }}>Budha</option>
                        <option value="hindu" {{ old('agama', $siswa->agama) == 'hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="kong_hu_cu" {{ old('agama', $siswa->agama) == 'kong_hu_cu' ? 'selected' : '' }}>Kong Hu Cu</option>
                    </select>
                    @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div> --}}

                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Suku Bangsa<span class="text-danger">*</span></label>
                    <input type="text" name="suku_bangsa" class="form-control @error('suku_bangsa') is-invalid @enderror" value="{{ old('suku_bangsa', $siswa->suku_bangsa) }}">
                    @error('suku_bangsa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div> --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Anak ke<span class="text-danger">*</span></label>
                        <input type="number" name="anak_ke" min="0" class="form-control @error('anak_ke') is-invalid @enderror" value="{{ old('anak_ke', $siswa->anak_ke) }}" required>
                        @error('anak_ke') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Jumlah Saudara Kandung<span class="text-danger">*</span></label>
                        <input type="number" name="jmlh_saudara_kandung" min="0" class="form-control @error('jmlh_saudara_kandung') is-invalid @enderror" value="{{ old('jmlh_saudara_kandung', $siswa->jmlh_saudara_kandung) }}" required>
                        @error('jmlh_saudara_kandung') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tempat Tinggal<span class="text-danger">*</span></label>
                        <select name="tmp_tinggal" class="form-select @error('tmp_tinggal') is-invalid @enderror" required>
                            <option value="orang_tua" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                            <option value="wali" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'wali' ? 'selected' : '' }}>Wali</option>
                            <option value="nenek" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'nenek' ? 'selected' : '' }}>Nenek</option>
                            <option value="saudara" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'saudara' ? 'selected' : '' }}>Saudara</option>
                        </select>
                        @error('tmp_tinggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Alamat Tempat Tinggal<span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Tempat Tinggal<span class="text-danger">*</span></label>
                    <select name="tmp_tinggal" class="form-select @error('tmp_tinggal') is-invalid @enderror" required>
                        <option value="orang_tua" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                        <option value="wali" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'wali' ? 'selected' : '' }}>Wali</option>
                        <option value="nenek" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'nenek' ? 'selected' : '' }}>Nenek</option>
                        <option value="saudara" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'saudara' ? 'selected' : '' }}>Saudara</option>
                    </select>
                    @error('tmp_tinggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div> --}}

                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat<span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                    @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div> --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">No NIK<span class="text-danger">*</span></label>
                            <input type="text" name="no_nik" class="form-control @error('no_nik') is-invalid @enderror"value="{{ old('no_nik', $siswa->no_nik) }}" placeholder="Masukkan NIK" required>
                            @error('no_nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </select>
                        @error('tmp_tinggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">No Kartu Keluarga<span class="text-danger">*</span></label>
                        <input type="text" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror" value="{{ old('no_kk', $siswa->no_kk) }}" placeholder="Masukkan No KK" required>
                        @error('no_kk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">No NIK<span class="text-danger">*</span></label>
                    <input type="text" name="no_nik" class="form-control @error('no_nik') is-invalid @enderror"value="{{ old('no_nik', $siswa->no_nik) }}" placeholder="Masukkan NIK" required>
                    @error('no_nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div> --}}

                {{-- <div class="mb-3">
                    <label class="form-label fw-semibold">No KK<span class="text-danger">*</span></label>
                    <input type="text" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror" value="{{ old('no_kk', $siswa->no_kk) }}" placeholder="Masukkan No KK" required>
                    @error('no_kk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div> --}}

                <div class="mb-3">
                    <label class="form-label fw-semibold">No Akte Kelahiran<span class="text-danger">*</span></label>
                    <input type="text" name="no_akte" class="form-control @error('no_akte') is-invalid @enderror" value="{{ old('no_akte', $siswa->no_akte) }}" placeholder="Masukkan No Akte" required>
                    @error('no_akte') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Orang Tua / Wali<span class="text-danger">*</span></label>
                    <input type="text" name="nama_wali" class="form-control @error('nama_wali') is-invalid @enderror" value="{{ old('nama_wali', $siswa->nama_wali) }}" placeholder="Masukkan nama wali" required>
                    @error('nama_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">No Telepon Orang Tua / Wali<span class="text-danger">*</span></label>
                    {{-- <small class="text-muted d-block mb-1">Gunakan format 628..., contoh: 628123456789</small> --}}
                    <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp', $siswa->no_telp) }}" placeholder="Masukkan nomor telepon" required>
                    @error('no_telp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Foto Siswa</label><br>
                    @if($siswa->foto)
                        <img src="{{ asset('img/' . $siswa->foto) }}" alt="Foto Siswa" width="100" class="mb-2"><br>
                    @endif
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                    <small class="form-text text-muted">Format file: jpeg, png, jpg, gif. Maksimal ukuran 2 MB.</small>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Kartu Keluarga (KK)<span class="text-danger">*</span></label><br>
                    @if($siswa->foto_kk)
                        <img src="{{ asset('img/' . $siswa->foto_kk) }}" alt="Gambar KK" width="100" class="mb-2"><br>
                    @endif
                    <input type="file" name="foto_kk" class="form-control @error('foto_kk') is-invalid @enderror">
                    <small class="form-text text-muted">Format file: jpeg, png, jpg, gif. Maksimal ukuran 2 MB.</small>
                    @error('foto_kk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Akta Kelahiran<span class="text-danger">*</span></label><br>
                    @if($siswa->foto_akte)
                        <img src="{{ asset('img/' . $siswa->foto_akte) }}" alt="Gambar Akte" width="100" class="mb-2"><br>
                    @endif
                    <input type="file" name="foto_akte" class="form-control @error('foto_akte') is-invalid @enderror">
                    <small class="form-text text-muted">Format file: jpeg, png, jpg, gif. Maksimal ukuran 2 MB.</small>
                    @error('foto_akte')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="aktif" {{ old('status', $siswa->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak_aktif" {{ old('status', $siswa->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i> Simpan Perubahan
                    </button>
                </div>

                {{-- <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div> --}}

            </form>
        </div>
    </div>
</div>
@endsection

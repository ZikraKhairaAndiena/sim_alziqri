@extends('admin.layouts.main')

@section('title', 'Edit Rapor')

@section('content')
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark mb-0">Edit Rapor Siswa</h4>
            </div>

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

            <div class="card-body">
                <form action="{{ route('admin.rapor.update', $rapor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label for="siswa_id" class="form-label fw-semibold">Siswa<span class="text-danger">*</span></label>
                        <select name="siswa_id" id="siswa_id" class="form-control" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ $rapor->siswa_id == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->nama_siswa }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tahun Ajaran</label>
                        <input type="hidden" name="thn_ajaran_id" value="{{ $thnAjarans->id }}">
                        <input type="text" class="form-control" value="{{ $thnAjarans->nama }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="semester" class="form-label fw-semibold">Semester<span
                                class="text-danger">*</span></label>
                        <select name="semester" id="semester" class="form-control" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="1" {{ $rapor->semester == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ $rapor->semester == 2 ? 'selected' : '' }}>2</option>
                        </select>
                    </div>

                    <hr>
                    <h5 class="fw-bold">Penilaian</h5>

                    @foreach ($kriterias as $kriteria)
                        @php $n = $nilaiByKriteria->get($kriteria->id); @endphp
                        <div class="mb-2">
                            <label class="form-label fw-semibold">{{ $loop->iteration }}.
                                {{ $kriteria->nama_kriteria }}</label>
                            <textarea name="penilaian[{{ $loop->index }}][deskripsi]" rows="5" class="form-control">{{ old("penilaian.$loop->index.deskripsi", $n->deskripsi ?? '') }}</textarea>
                            <input type="hidden" name="penilaian[{{ $loop->index }}][kriteria_id]"
                                value="{{ $kriteria->id }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto {{ $kriteria->nama_kriteria }}</label><br>
                            @if (!empty($n?->foto))
                                <img src="{{ asset('img/' . $n->foto) }}" alt="Foto {{ $kriteria->nama_kriteria }}"
                                    width="120" class="mb-2">
                            @endif
                            <input type="file" name="penilaian[{{ $loop->index }}][foto]" class="form-control"
                                accept="image/*">
                        </div>
                    @endforeach

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

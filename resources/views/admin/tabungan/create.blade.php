@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">

        <div class="card shadow-sm">
            <!-- Header -->
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark mb-0">Tambah Tabungan</h4>
            </div>

            <!-- Body -->
            <div class="card-body">

                <form action="{{ route('admin.tabungan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-2">
                        <label for="siswa_id">Nama Siswa<span class="text-danger">*</span></label>
                        <select name="siswa_id" id="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror"
                            required>
                            <option value="">Pilih</option>
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

                    <div class="form-group mb-2">
                        <label for="tanggal">Tanggal<span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" id="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="jenis_transaksi">Jenis Transaksi<span class="text-danger">*</span></label>
                        <select name="jenis_transaksi" id="jenis_transaksi"
                            class="form-control @error('jenis_transaksi') is-invalid @enderror" required>
                            <option value="">-- Pilih jenis transaksi --</option>
                            <option value="setor" {{ old('jenis_transaksi') == 'setor' ? 'selected' : '' }}>Setor</option>
                            <option value="tarik" {{ old('jenis_transaksi') == 'tarik' ? 'selected' : '' }}>Tarik</option>
                        </select>
                        @error('jenis_transaksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="jumlah">Jumlah<span class="text-danger">*</span></label>
                        <input type="text" name="jumlah" id="jumlah"
                            class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}"
                            required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan<span class="text-danger">*</span></label>
                        <input type="text" name="ket" class="form-control @error('ket') is-invalid @enderror"
                            value="{{ old('ket') }}" required>
                        <small class="form-text text-muted">Jika tidak ada keterangan, ketik tanda (-)</small>
                        @error('ket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.tabungan.index') }}" class="btn btn-secondary d-flex align-items-center">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahInput = document.getElementById('jumlah');

        jumlahInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, ''); // hapus semua selain angka
            this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // format ribuan
        });

        // Hapus titik sebelum form submit
        jumlahInput.form.addEventListener('submit', function() {
            jumlahInput.value = jumlahInput.value.replace(/\./g, '');
        });
    });
</script>

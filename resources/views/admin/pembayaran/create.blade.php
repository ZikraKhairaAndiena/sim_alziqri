@extends('admin.layouts.main')

@section('title', 'Pembayaran Cicilan')

@section('content')
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <!-- Header -->
            <div class="card-header bg-white">
                <h4 class="fw-bold mb-0">Form Pembayaran Cicilan</h4>
            </div>

            <!-- Body -->
            <div class="card-body">
                <!-- Info Tagihan -->
                <div class="alert alert-info">
                    <strong>Total Tagihan:</strong> Rp {{ number_format($totalTagihan, 0, ',', '.') }} <br>
                    <strong>Total Terbayar:</strong> Rp {{ number_format($totalTerbayar, 0, ',', '.') }} <br>
                    <strong>Sisa Tagihan:</strong> Rp {{ number_format($sisaTagihan, 0, ',', '.') }}
                </div>

                <!-- Error Message -->
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Form Pembayaran -->
                <form action="{{ route('admin.pembayaran.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nominal_bayar" class="form-label">Nominal Bayar<span
                                class="text-danger">*</span></label>
                        <input type="text" name="nominal_bayar" id="nominal_bayar"
                            class="form-control @error('nominal_bayar') is-invalid @enderror" min="10000"
                            max="{{ $sisaTagihan }}" required>
                        <small class="text-muted">Minimal Rp 10.000, maksimal Rp
                            {{ number_format($sisaTagihan, 0, ',', '.') }}</small>
                        @error('nominal_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nominalInput = document.getElementById('nominal_bayar');

        nominalInput.addEventListener('input', function(e) {
            // Hapus semua karakter selain angka
            let value = this.value.replace(/\D/g, '');

            // Format angka pakai titik setiap ribuan
            this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        });

        // Pastikan sebelum submit, titik dihapus
        nominalInput.form.addEventListener('submit', function() {
            nominalInput.value = nominalInput.value.replace(/\./g, '');
        });
    });
</script>

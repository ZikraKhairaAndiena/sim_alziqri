@extends('admin.layouts.main')

@section('title', 'Pembayaran Berhasil')

@section('content')
    <div class="content-wrapper">
        <div class="card shadow-sm">

            <!-- Body -->
            <div class="card-body text-center">
                <div class="success-icon mb-4"
                    style="font-size: 60px; color: #4CAF50; background: #E8F5E9; width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                    ✔
                </div>

                <h5 class="text-success fw-bold">Terima kasih!</h5>
                <p>Pembayaran Anda telah berhasil diproses.</p>

                <div class="alert alert-success text-start mx-auto" style="max-width: 400px;">
                    <strong>Status:</strong> Paid <br>
                    <strong>Tanggal:</strong> {{ now()->format('d-m-Y') }}
                </div>

                <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-primary">
                    Lihat Riwayat Pembayaran
                </a>
            </div>
        </div>
    </div>
@endsection

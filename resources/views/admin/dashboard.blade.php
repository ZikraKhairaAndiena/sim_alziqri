{{-- dashboard.blade.php --}}
@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>
        </div>

        {{-- Role Admin --}}
        @if (Auth::user()->role == 'admin')
            <div class="row">
                {{-- Card Jumlah Siswa --}}
                <div class="col-md-4 stretch-card grid-margin">
                    <a href="{{ route('admin.siswa.index') }}" class="text-decoration-none w-100 d-block">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                {{-- <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" /> --}}
                                <h4 class="font-weight-normal mb-3">Jumlah Siswa <i
                                        class="mdi mdi-account-group mdi-24px float-end"></i></h4>
                                <h2 class="mb-5">{{ $jumlahSiswa }}</h2>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Card Jumlah Guru --}}
                <div class="col-md-4 stretch-card grid-margin">
                    <a href="{{ route('admin.guru.index') }}" class="text-decoration-none w-100 d-block">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                {{-- <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" /> --}}
                                <h4 class="font-weight-normal mb-3">Jumlah Guru <i
                                        class="mdi mdi-account-group mdi-24px float-end"></i></h4>
                                <h2 class="mb-5">{{ $jumlahGuru }}</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="fw-bold text-dark mb-0">Pertumbuhan Siswa per Tahun Ajaran</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartPertumbuhan"></canvas>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('chartPertumbuhan').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($tahunAjaranLabels),
                        datasets: [{
                            label: 'Jumlah Siswa',
                            data: @json($siswaPerTahun),
                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    // hanya tampilkan bilangan genap
                                    callback: function(value) {
                                        if (value % 2 === 0) {
                                            return value;
                                        }
                                        return '';
                                    }
                                }
                            }
                        }
                    }
                });
            </script>

            {{-- Progress Pembayaran --}}
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title text-center">RINCIAN PEMBAYARAN UANG SEKOLAH</h4>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Sisa Tagihan</th>
                                <th>Progress Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPembayaran as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item['nama_siswa'] }}</td>
                                    <td>Rp {{ number_format($item['sisa_tagihan'], 0, ',', '.') }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $item['persentase'] }}%"
                                                aria-valuenow="{{ $item['persentase'] }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                {{ $item['persentase'] }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-primary btn-sm">
                            Lihat Selengkapnya
                        </a>
                    </div>
                </div>
            </div>

        @endif


        {{-- Role Guru --}}
        @if (Auth::user()->role == 'guru')
            <div class="col-md-4 stretch-card grid-margin">
                <a href="{{ route('admin.siswa.index') }}" class="text-decoration-none">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <h4 class="font-weight-normal mb-3">Jumlah Siswa <i
                                    class="mdi mdi-account-group mdi-24px float-end"></i></h4>
                            <h2 class="mb-5">{{ $jumlahSiswa }}</h2>
                        </div>
                    </div>
            </div>

            {{-- Diagram Pertumbuhan Siswa --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="fw-bold text-dark mb-0">Pertumbuhan Siswa per Tahun Ajaran</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartPertumbuhanGuru"></canvas>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctxGuru = document.getElementById('chartPertumbuhanGuru').getContext('2d');
                new Chart(ctxGuru, {
                    type: 'bar',
                    data: {
                        labels: @json($tahunAjaranLabels),
                        datasets: [{
                            label: 'Jumlah Siswa',
                            data: @json($siswaPerTahun),
                            backgroundColor: 'rgba(75, 192, 192, 0.7)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        if (value % 2 === 0) {
                                            return value;
                                        }
                                        return '';
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        @endif

        {{-- Role Orang Tua --}}
        @if (Auth::user()->role == 'orang_tua')
            <div class="text-center mt-4">
                <h4>Selamat Datang di Dashboard Orang Tua</h4>
                <p>Di sini Anda dapat melihat informasi perkembangan anak, tagihan, dan laporan sekolah.</p>
                {{-- <img src="{{ asset('assets/images/dashboard/orangtua.png') }}" class="img-fluid" alt="Dashboard Orang Tua"> --}}
            </div>
        @endif

    </div>

@endsection

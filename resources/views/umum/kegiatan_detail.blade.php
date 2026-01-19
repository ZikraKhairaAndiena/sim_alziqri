@extends('umum.layouts.main')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('img/' . $informasi->gambar) }}">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-2 bread">{{ $informasi->title }}</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ route('umum.home') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span>
                        <span><a href="{{ route('umum.kegiatan') }}">Kegiatan <i
                                    class="ion-ios-arrow-forward"></i></a></span>
                        <span>Detail</span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="blog-entry align-self-stretch">
                        {{-- <div class="mb-4">
                        <img src="{{ asset('img/'.$informasi->gambar) }}" class="img-fluid w-100 rounded shadow" style="height:400px; object-fit:cover; border-radius:10px;">
                    </div> --}}
                        <h2 class="mb-3">{{ $informasi->title }}</h2>
                        <p class="text-muted">
                            <i class="icon-calendar"></i>
                            {{ \Carbon\Carbon::parse($informasi->tanggal)->format('d M Y') }}
                        </p>
                        <div class="content">
                            {!! nl2br(e($informasi->content)) !!}
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('umum.kegiatan') }}" class="btn btn-secondary">&laquo; Kembali ke Daftar
                                Kegiatan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

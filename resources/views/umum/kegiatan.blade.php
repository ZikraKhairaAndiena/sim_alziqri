@extends('umum.layouts.main')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('img/4.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-2 bread">Kegiatan</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ url('/') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span>
                        <span>Kegiatan <i class="ion-ios-arrow-forward"></i></span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                @foreach ($informasi as $item)
                    <div class="col-md-6 course d-lg-flex ftco-animate">
                        <div class="img" style="background-image: url('{{ asset('img/' . $item->gambar) }}');"></div>
                        <div class="text bg-light p-4">
                            <h3><a href="{{ route('umum.kegiatan.detail', $item->id) }}">{{ $item->title }}</a></h3>
                            <p class="subheading">
                                <span>Tanggal:</span> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                            </p>
                            <p>{{ Str::limit($item->content, 150) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

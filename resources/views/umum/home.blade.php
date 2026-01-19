@extends('umum.layouts.main')
@section('content')
    {{-- Hero Section --}}
    <section class="hero-wrap"
        style="
    background-image: url('{{ asset('img/foto.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 80vh;">
        <div class="container h-100">
            <div class="row no-gutters slider-text align-items-center justify-content-center h-100">
                <div class="col-md-8 text-center">
                    <h1 class="mb-4 text-white display-3">Selamat Datang di <br>
                        <span class="text-warning">TK Al-Ziqri</span>
                    </h1>
                    <p class="lead text-white fs-4">
                        Mewujudkan Generasi Cerdas, Kreatif, dan Berakhlak Mulia
                    </p>
                    <a href="{{ route('login') }}" class="btn btn-primary px-4 py-3 mt-3">
                        Daftar PPDB Online
                    </a>
                </div>
            </div>
        </div>
    </section>


    {{-- Tentang Sekolah --}}
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 text-center heading-section">
                    <h2 class="mb-4">Tentang <span>TK Al-Ziqri</span></h2>
                    <p>TK Al-Ziqri berlokasi di Desa Tarantang, Kec. Lubuk Kilangan, Kota Padang.
                        Kami hadir untuk mendukung perkembangan kognitif, sosial, emosional, dan spiritual anak
                        melalui kegiatan belajar yang menyenangkan, islami, dan mendidik.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Kurikulum --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 text-center heading-section">
                    <h2 class="mb-4"><span>Kurikulum</span> Pembelajaran</h2>
                    <p>Kurikulum TK Al-Ziqri mengacu pada kegiatan intrakurikuler dan Projek Penguatan Profil Pelajar
                        Pancasila (P5).</p>
                </div>
            </div>
            <div class="row">
                {{-- Hardcode data kurikulum --}}
                <div class="col-md-6 d-flex ftco-animate">
                    <div class="services-2 p-4 bg-light shadow-sm rounded d-flex flex-column h-100 w-100">
                        <h3 class="mb-3">Aku Ciptaan Allah Swt</h3>
                        <p><strong>Topik:</strong> Identitasku</p>
                        <p><strong>Subtopik:</strong> Nama, TTL, Nama orang tua, Jenis kelamin, Cita-cita</p>
                        <p class="mt-auto"><strong>Alokasi Waktu:</strong> 4 Minggu</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex ftco-animate">
                    <div class="services-2 p-4 bg-light shadow-sm rounded d-flex flex-column h-100 w-100">
                        <h3 class="mb-3">Aku Sayang Keluarga</h3>
                        <p><strong>Topik:</strong> Keluargaku</p>
                        <p><strong>Subtopik:</strong> Ayah, Ibu, Kakak, Adik</p>
                        <p class="mt-auto"><strong>Alokasi Waktu:</strong> 2 Minggu</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex ftco-animate">
                    <div class="services-2 p-4 bg-light shadow-sm rounded d-flex flex-column h-100 w-100">
                        <h3 class="mb-3">Lingkunganku yang Bersih</h3>
                        <p><strong>Topik:</strong> Sekolah Impianku</p>
                        <p><strong>Subtopik:</strong> Ruangan sekolah, Guru & teman, APE sekolah, Cara merawat sekolah</p>
                        <p class="mt-auto"><strong>Alokasi Waktu:</strong> 2 Minggu</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex ftco-animate">
                    <div class="services-2 p-4 bg-light shadow-sm rounded d-flex flex-column h-100 w-100">
                        <h3 class="mb-3">P5 - Imajinasi & Kreativitas</h3>
                        <p><strong>Topik:</strong> Membangun Dunia Mini</p>
                        <p><strong>Subtopik:</strong> Playdough, origami, miniatur hewan & tempat ibadah</p>
                        <p class="mt-auto"><strong>Alokasi Waktu:</strong> 2 Minggu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Profil Guru --}}
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 text-center heading-section">
                    <h2 class="mb-4">Profil <span>Guru</span></h2>
                </div>
            </div>
            <div class="row justify-content-center"> {{-- tambahin justify-content-center --}}
                @foreach ($guru as $g)
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center ftco-animate">
                        <div class="staff text-center"> {{-- tambahin text-center --}}
                            <div class="img-wrap d-flex align-items-stretch">
                                <div class="img align-self-stretch"
                                    style="background-image: url('{{ asset('img/' . $g->foto) }}');
                                    background-size: cover; background-position: center;
                                    width: 100%; height: 250px; border-radius: 10px;">
                                </div>
                            </div>
                            <div class="text pt-3">
                                <h3>{{ $g->nama_guru }}</h3>
                                <span class="position mb-2">{{ ucfirst(str_replace('_', ' ', $g->jabatan)) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- Informasi/Kegiatan --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 text-center heading-section">
                    <h2 class="mb-4">Informasi & Kegiatan</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($informasi as $info)
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="blog-entry bg-white shadow-sm rounded d-flex flex-column h-100 w-100">
                            <a href="{{ route('umum.kegiatan.detail', $info->id) }}" class="block-20"
                                style="background-image: url('{{ asset('img/' . $info->gambar) }}');
                              min-height:200px; background-size:cover; background-position:center;">
                            </a>
                            <div class="text p-4 d-flex flex-column flex-grow-1">
                                <h3 class="heading mb-3">
                                    <a href="{{ route('umum.kegiatan.detail', $info->id) }}">{{ $info->title }}</a>
                                </h3>
                                <p class="flex-grow-1">{{ Str::limit($info->content, 100) }}</p>
                                <div>
                                    <a href="{{ route('umum.kegiatan.detail', $info->id) }}"
                                        class="btn btn-primary btn-sm mt-auto">
                                        Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

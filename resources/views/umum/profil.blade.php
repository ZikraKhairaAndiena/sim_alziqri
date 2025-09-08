@extends('umum.layouts.main')
@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url('img/4.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h1 class="mb-2 bread">Profil</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Profil <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pt ftc-no-pb">
    <div class="container">
        <div class="row">
            <div class="col-md-12 wrap-about py-5 bg-light">
                <div class="text px-4 ftco-animate text-center">
                    {{-- Perkenalan --}}
                    <h2 class="mb-4">Perkenalan</h2>
                    <p>TK Al-Ziqri adalah lembaga pendidikan anak usia dini yang berlokasi di Padang, berkomitmen membentuk generasi yang berakhlak mulia, cerdas, dan kreatif. Kami menyediakan lingkungan belajar yang aman, nyaman, dan menyenangkan, dengan pembelajaran berbasis karakter dan nilai-nilai islami.</p>

                    {{-- Visi --}}
                    <h2 class="mt-5 mb-3">Visi</h2>
                    <p>“Mewujudkan generasi yang beriman, berilmu, berakhlak mulia, kreatif, dan mandiri.”</p>

                    {{-- Misi --}}
                    <h2 class="mt-5 mb-3">Misi</h2>

                        <li>Menanamkan nilai-nilai keimanan dan ketakwaan kepada Allah SWT sejak usia dini.</li>
                        <li>Menyelenggarakan pembelajaran yang aktif, kreatif, inovatif, efektif, dan menyenangkan.</li>
                        <li>Mengembangkan potensi anak sesuai minat dan bakatnya.</li>
                        <li>Membentuk karakter disiplin, tanggung jawab, dan mandiri.</li>
                        <li>Menjalin kerja sama yang harmonis dengan orang tua dan masyarakat.</li>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand" href="{{ route('umum.home') }}">
            <img src="{{ asset('img/LogoAlZiqri.png') }}" alt="Logo" height="50">
            <span class="menu-title">TK AL ZIQRI</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item {{ request()->routeIs('umum.home') ? 'active' : '' }}">
                    <a href="{{ route('umum.home') }}" class="nav-link pl-0">Home</a>
                </li>
                <li class="nav-item {{ request()->routeIs('umum.profil') ? 'active' : '' }}">
                    <a href="{{ route('umum.profil') }}" class="nav-link">Profil</a>
                </li>
                <li class="nav-item {{ request()->routeIs('umum.kegiatan') ? 'active' : '' }}">
                    <a href="{{ route('umum.kegiatan') }}" class="nav-link">Kegiatan</a>
                </li>
                <li class="nav-item {{ request()->routeIs('umum.kontak') ? 'active' : '' }}">
                    <a href="{{ route('umum.kontak') }}" class="nav-link">Kontak</a>
                </li>
                {{-- <li class="nav-item {{ request()->routeIs('umum.bantuan') ? 'active' : '' }}">
                <a href="{{ route('umum.bantuan') }}" class="nav-link">Bantuan</a>
            </li> --}}
                <li class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                    <a href="{{ route('login') }}"
                        class="nav-link btn btn-primary px-3 py-1 rounded-pill text-white ml-lg-3">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

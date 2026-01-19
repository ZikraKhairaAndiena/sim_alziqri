<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-view-dashboard menu-icon"></i>
            </a>
        </li>

        @if (Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('thn_ajaran') ? 'active' : '' }}">
                <a class="nav-link" href="/thn_ajaran">
                    <span class="menu-title">Tahun Ajaran</span>
                    <i class="mdi mdi-calendar-clock menu-icon"></i>
                </a>
            </li>
        @endif

        @if (Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('kelas') ? 'active' : '' }}">
                <a class="nav-link" href="/kelas">
                    <span class="menu-title">Kelas</span>
                    <i class="mdi mdi-domain menu-icon"></i>
                </a>
            </li>
        @endif

        @auth
            @if (auth()->user()->role == 'admin')
                <li class="nav-item {{ request()->is('ppdb') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.ppdb.admin') }}">
                        <span class="menu-title">PPDB</span>
                        <i class="mdi mdi-school menu-icon"></i>
                    </a>
                </li>
            @elseif (auth()->user()->role == 'orang_tua')
                <li class="nav-item {{ request()->is('ppdb') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('orang_tua.ppdb.index') }}">
                        <span class="menu-title">PPDB</span>
                        <i class="mdi mdi-school-outline menu-icon"></i>
                    </a>
                </li>
            @endif
        @endauth

        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'orang_tua')
            <li class="nav-item {{ request()->is('pembayaran') ? 'active' : '' }}">
                <a class="nav-link" href="/pembayaran">
                    <span class="menu-title">Pembayaran</span>
                    <i class="mdi mdi-cash-multiple menu-icon"></i>
                </a>
            </li>
        @endif

        @if (Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('siswa') ? 'active' : '' }}">
                <a class="nav-link" href="/siswa">
                    <span class="menu-title">Siswa</span>
                    <i class="mdi mdi-account-group menu-icon"></i>
                </a>
            </li>
        @endif

        @if (Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('guru') ? 'active' : '' }}">
                <a class="nav-link" href="/guru">
                    <span class="menu-title">Guru</span>
                    <i class="mdi mdi-account-tie menu-icon"></i>
                </a>
            </li>
        @endif

        @if (Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('user') ? 'active' : '' }}">
                <a class="nav-link" href="/user">
                    <span class="menu-title">User</span>
                    <i class="mdi mdi-account-key menu-icon"></i>
                </a>
            </li>
        @endif

        @if (Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('fonnte') ? 'active' : '' }}">
                <a class="nav-link" href="/fonnte">
                    <span class="menu-title">Whatsapp</span>
                    <i class="mdi mdi-whatsapp menu-icon"></i>
                </a>
            </li>
        @endif

        @if (Auth::user()->role === 'guru')
            <li class="nav-item {{ request()->is('kriteria') ? 'active' : '' }}">
                <a class="nav-link" href="/kriteria">
                    <span class="menu-title">Kriteria Penilaian Rapor</span>
                    <i class="mdi mdi-book-open-variant menu-icon"></i>
                </a>
            </li>
        @endif

        @auth
            @if (auth()->user()->role == 'guru')
                <li class="nav-item {{ request()->is('kehadiran') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.kehadiran.index') }}">
                        <span class="menu-title">Kehadiran</span>
                        <i class="mdi mdi-calendar-check menu-icon"></i>
                    </a>
                </li>
            @elseif (auth()->user()->role == 'orang_tua')
                <li class="nav-item {{ request()->is('kehadiran') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.kehadiran.ortu') }}">
                        <span class="menu-title">Kehadiran</span>
                        <i class="mdi mdi-calendar-account menu-icon"></i>
                    </a>
                </li>
            @endif
        @endauth

        @auth
            @if (auth()->user()->role == 'guru')
                <li class="nav-item {{ request()->is('tabungan') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.tabungan.index') }}">
                        <span class="menu-title">Tabungan</span>
                        <i class="mdi mdi-bank menu-icon"></i>
                    </a>
                </li>
            @elseif (auth()->user()->role == 'orang_tua')
                <li class="nav-item {{ request()->is('tabungan') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.tabungan.ortu') }}">
                        <span class="menu-title">Tabungan</span>
                        <i class="mdi mdi-piggy-bank menu-icon"></i>
                    </a>
                </li>
            @endif
        @endauth

        @auth
            @if (auth()->user()->role == 'guru')
                <li class="nav-item {{ request()->is('rapor') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.rapor.index') }}">
                        <span class="menu-title">Rapor</span>
                        <i class="mdi mdi-file-document-outline menu-icon"></i>
                    </a>
                </li>
            @elseif (auth()->user()->role == 'orang_tua')
                <li class="nav-item {{ request()->is('rapor') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.rapor.ortu') }}">
                        <span class="menu-title">Rapor</span>
                        <i class="mdi mdi-file-document-outline menu-icon"></i>
                    </a>
                </li>
            @endif
        @endauth

        @if (Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('informasi') ? 'active' : '' }}">
                <a class="nav-link" href="/informasi">
                    <span class="menu-title">Informasi</span>
                    <i class="mdi mdi-information menu-icon"></i>
                </a>
            </li>
        @endif
    </ul>
</nav>
<!-- partial -->

<!-- ========================= SITE HEADER / NAVBAR COMPONENT ========================= -->
<header class="site-header" id="mainHeader">
    <div class="container site-header__container">
        <!-- Brand Logo & Title -->
        <a href="{{ route('home') }}" class="brand" aria-label="Beranda Dinas Arsip dan Perpustakaan Kota Semarang">
            <div class="brand__logo">
                <img src="{{ asset('asset/LOGO.png') }}" alt="Logo Resmi Dinas Arsip dan Perpustakaan Kota Semarang" width="48" height="48" loading="eager" />
            </div>
            <div class="brand__text">
                <div class="brand__title">DINAS ARSIP DAN PERPUSTAKAAN</div>
                <div class="brand__subtitle">KOTA SEMARANG</div>
            </div>
        </a>

        <!-- Mobile Toggle Burger Button -->
        <button type="button" class="nav-toggle" id="navToggleBtn" aria-label="Buka navigasi menu utama" aria-expanded="false" aria-controls="primaryNav">
            <span class="nav-toggle__bar"></span>
            <span class="nav-toggle__bar"></span>
            <span class="nav-toggle__bar"></span>
        </button>

        <!-- Main Navigation List -->
        <nav class="main-nav" id="primaryNav" aria-label="Navigasi Utama Portal">
            <ul class="main-nav__list">
                <!-- BERANDA -->
                <li class="main-nav__item">
                    <a href="{{ route('home') }}" class="main-nav__link {{ request()->routeIs('home', 'dashboard') ? 'active' : '' }}">
                        BERANDA
                    </a>
                </li>

                <!-- PROFIL DROPDOWN -->
                <li class="main-nav__item dropdown">
                    <button type="button" class="dropdown-toggle main-nav__link {{ request()->routeIs('visikota', 'visiarpus', 'tupoksi', 'struktur', 'tentang') ? 'active' : '' }}" aria-expanded="false">
                        PROFIL <span class="arrow" aria-hidden="true">&#9662;</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li role="none">
                            <a href="{{ route('visikota') }}" class="dropdown-item {{ request()->routeIs('visikota') ? 'active-sub' : '' }}" role="menuitem">
                                Visi Misi Kota
                            </a>
                        </li>
                        <li role="none">
                            <a href="{{ route('visiarpus') }}" class="dropdown-item {{ request()->routeIs('visiarpus') ? 'active-sub' : '' }}" role="menuitem">
                                Visi Misi Arpus
                            </a>
                        </li>
                        <li role="none">
                            <a href="{{ route('tupoksi') }}" class="dropdown-item {{ request()->routeIs('tupoksi') ? 'active-sub' : '' }}" role="menuitem">
                                Tupoksi Dinas
                            </a>
                        </li>
                        <li role="none">
                            <a href="{{ route('struktur') }}" class="dropdown-item {{ request()->routeIs('struktur') ? 'active-sub' : '' }}" role="menuitem">
                                Struktur Organisasi
                            </a>
                        </li>
                        <li role="none">
                            <a href="{{ route('tentang') }}" class="dropdown-item {{ request()->routeIs('tentang') ? 'active-sub' : '' }}" role="menuitem">
                                Tentang Arpusda
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- GALERI DROPDOWN -->
                <li class="main-nav__item dropdown">
                    <button type="button" class="dropdown-toggle main-nav__link {{ request()->routeIs('foto', 'video', 'arsip') ? 'active' : '' }}" aria-expanded="false">
                        GALERI <span class="arrow" aria-hidden="true">&#9662;</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li role="none">
                            <a href="{{ route('foto') }}" class="dropdown-item {{ request()->routeIs('foto') ? 'active-sub' : '' }}" role="menuitem">
                                Galeri Foto
                            </a>
                        </li>
                        <li role="none">
                            <a href="{{ route('video') }}" class="dropdown-item {{ request()->routeIs('video') ? 'active-sub' : '' }}" role="menuitem">
                                Galeri Video
                            </a>
                        </li>
                        <li role="none">
                            <a href="{{ route('arsip') }}" class="dropdown-item {{ request()->routeIs('arsip') ? 'active-sub' : '' }}" role="menuitem">
                                Pameran Arsip
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- BERITA -->
                <li class="main-nav__item">
                    <a href="{{ route('berita') }}" class="main-nav__link {{ request()->routeIs('berita') ? 'active' : '' }}">
                        BERITA
                    </a>
                </li>

                <!-- PPID EXTERNAL -->
                <li class="main-nav__item">
                    <a href="https://ppid.arpusda.semarangkota.go.id/" class="main-nav__link" target="_blank" rel="noopener noreferrer">
                        PPID <svg class="icon icon-ext" aria-hidden="true"><use href="#icon-external" /></svg>
                    </a>
                </li>

                <!-- FAQ DROPDOWN -->
                <li class="main-nav__item dropdown">
                    <button type="button" class="dropdown-toggle main-nav__link {{ request()->routeIs('FAQarsip', 'FAQperpus') ? 'active' : '' }}" aria-expanded="false">
                        FAQ <span class="arrow" aria-hidden="true">&#9662;</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li role="none">
                            <a href="{{ route('FAQarsip') }}" class="dropdown-item {{ request()->routeIs('FAQarsip') ? 'active-sub' : '' }}" role="menuitem">
                                Urusan Arsip
                            </a>
                        </li>
                        <li role="none">
                            <a href="{{ route('FAQperpus') }}" class="dropdown-item {{ request()->routeIs('FAQperpus') ? 'active-sub' : '' }}" role="menuitem">
                                Urusan Perpustakaan
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- KONTAK -->
                <li class="main-nav__item">
                    <a href="{{ route('kontak') }}" class="main-nav__link {{ request()->routeIs('kontak') ? 'active' : '' }}">
                        KONTAK
                    </a>
                </li>

                <!-- LOGIN ADMIN -->
                <li class="main-nav__item main-nav__item--admin">
                    <a href="{{ route('admin.login') }}" class="btn-login-admin" title="Masuk ke Panel Admin CMS Arpusda">
                        <svg class="icon icon-lock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <span>Login Admin</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

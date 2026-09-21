<aside class="admin-sidebar" id="adminSidebar">
    <!-- Brand Logo & Title -->
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <div class="sidebar-brand__logo">
            <img src="{{ asset('asset/LOGO.png') }}" alt="Logo Arpusda Semarang" width="36" height="36" />
        </div>
        <div class="sidebar-brand__text">
            <span class="sidebar-brand__title">CMS ARPUSDA</span>
            <span class="sidebar-brand__badge">KOTA SEMARANG</span>
        </div>
    </a>

    <!-- Navigation Menu -->
    <nav class="sidebar-nav">
        <!-- UTAMA -->
        <div class="sidebar-section-title">Menu Utama</div>
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    </span>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <!-- PERPUSTAKAAN -->
        <div class="sidebar-section-title">Perpustakaan</div>
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ route('admin.perpustakaan.buku') }}" class="sidebar-link {{ request()->routeIs('admin.perpustakaan.buku*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    </span>
                    <span>Katalog Buku (OPAC)</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.perpustakaan.usulan') }}" class="sidebar-link {{ request()->routeIs('admin.perpustakaan.usulan*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="7"></line><line x1="10" y1="9" x2="14" y2="9"></line></svg>
                    </span>
                    <span>SI ULAN (Usulan Buku)</span>
                    <span class="sidebar-badge">5</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.perpustakaan.jadwal') }}" class="sidebar-link {{ request()->routeIs('admin.perpustakaan.jadwal*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </span>
                    <span>Jadwal Keliling</span>
                </a>
            </li>
        </ul>

        <!-- KEARSIPAN -->
        <div class="sidebar-section-title">Kearsipan</div>
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ route('admin.kearsipan.permohonan') }}" class="sidebar-link {{ request()->routeIs('admin.kearsipan.permohonan*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><circle cx="10" cy="14" r="3"></circle><line x1="12" y1="16" x2="15" y2="19"></line></svg>
                    </span>
                    <span>Permohonan Arsip</span>
                    <span class="sidebar-badge">3</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.kearsipan.galeri') }}" class="sidebar-link {{ request()->routeIs('admin.kearsipan.galeri*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    </span>
                    <span>Galeri Arsip Sejarah</span>
                </a>
            </li>
        </ul>

        <!-- PENGATURAN -->
        <div class="sidebar-section-title">Pengaturan Sistem</div>
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ route('admin.pengaturan.kategori') }}" class="sidebar-link {{ request()->routeIs('admin.pengaturan.kategori*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                    </span>
                    <span>Manajemen Kategori</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.pengaturan.pengguna') }}" class="sidebar-link {{ request()->routeIs('admin.pengaturan.pengguna*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </span>
                    <span>Manajemen Pengguna</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.pengaturan.banner') }}" class="sidebar-link {{ request()->routeIs('admin.pengaturan.banner*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    </span>
                    <span>Manajemen Banner</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar User Footer -->
    <div class="sidebar-footer">
        @php
            $adminUser = session('admin_user', [
                'name' => 'Administrator Arpusda',
                'role' => 'Super Admin',
                'jabatan' => 'Pranata Komputer Ahli'
            ]);
        @endphp
        <div class="sidebar-user">
            <div class="sidebar-user__avatar">
                {{ strtoupper(substr($adminUser['name'] ?? 'A', 0, 1)) }}
            </div>
            <div class="sidebar-user__info">
                <div class="sidebar-user__name">{{ $adminUser['name'] ?? 'Admin' }}</div>
                <div class="sidebar-user__role">{{ $adminUser['role'] ?? 'Super Admin' }}</div>
            </div>
        </div>
    </div>
</aside>

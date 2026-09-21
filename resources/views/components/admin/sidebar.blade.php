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

    <!-- Navigation Menu (Linear Pill Style) -->
    <nav class="sidebar-nav">
        <!-- UTAMA -->
        <div class="sidebar-section-title">Overview</div>
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <i data-lucide="layout-dashboard" style="width: 18px; height: 18px;"></i>
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
                        <i data-lucide="book-open" style="width: 18px; height: 18px;"></i>
                    </span>
                    <span>Katalog Buku (OPAC)</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.perpustakaan.usulan') }}" class="sidebar-link {{ request()->routeIs('admin.perpustakaan.usulan*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <i data-lucide="message-square-plus" style="width: 18px; height: 18px;"></i>
                    </span>
                    <span>SI ULAN (Usulan Buku)</span>
                    <span class="sidebar-badge">5</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.perpustakaan.jadwal') }}" class="sidebar-link {{ request()->routeIs('admin.perpustakaan.jadwal*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <i data-lucide="truck" style="width: 18px; height: 18px;"></i>
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
                        <i data-lucide="file-search" style="width: 18px; height: 18px;"></i>
                    </span>
                    <span>Permohonan Arsip</span>
                    <span class="sidebar-badge">3</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.kearsipan.galeri') }}" class="sidebar-link {{ request()->routeIs('admin.kearsipan.galeri*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <i data-lucide="image" style="width: 18px; height: 18px;"></i>
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
                        <i data-lucide="tags" style="width: 18px; height: 18px;"></i>
                    </span>
                    <span>Manajemen Kategori</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.pengaturan.pengguna') }}" class="sidebar-link {{ request()->routeIs('admin.pengaturan.pengguna*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <i data-lucide="users-round" style="width: 18px; height: 18px;"></i>
                    </span>
                    <span>Manajemen Pengguna</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.pengaturan.banner') }}" class="sidebar-link {{ request()->routeIs('admin.pengaturan.banner*') ? 'is-active' : '' }}">
                    <span class="sidebar-icon">
                        <i data-lucide="layout-template" style="width: 18px; height: 18px;"></i>
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

<header class="admin-topbar">
    <!-- Left Section: Sidebar Toggle & Search -->
    <div class="topbar-left">
        <button type="button" class="sidebar-toggle-btn" id="sidebarToggleBtn" aria-label="Buka/Tutup Navigasi Menu">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>

        <div class="topbar-search">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" placeholder="Cari data atau modul..." aria-label="Pencarian Cepat CMS">
        </div>
    </div>

    <!-- Right Section: Time, Notifications, Dark Mode, User Profile -->
    <div class="topbar-right">
        <!-- Date Badge -->
        <div class="topbar-time-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span>{{ now()->translatedFormat('d M Y') }}</span>
        </div>

        <!-- Dark Mode Toggle -->
        <button type="button" class="topbar-btn" id="darkModeToggle" title="Ganti Mode Gelap/Terang" aria-label="Mode Tampilan">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
        </button>

        <!-- Notification Bell & Dropdown -->
        <div style="position: relative;">
            <button type="button" class="topbar-btn" id="notifMenuTrigger" title="Notifikasi Sistem" aria-label="Notifikasi">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                <span class="btn-badge">2</span>
            </button>

            <!-- Notifications Dropdown Menu -->
            <div class="admin-dropdown" id="notifDropdownMenu" style="width: 320px;">
                <div class="admin-dropdown__header">
                    <div class="admin-dropdown__title">Notifikasi Masuk</div>
                    <div class="admin-dropdown__subtitle">2 aktivitas memerlukan perhatian</div>
                </div>
                <div>
                    <a href="{{ route('admin.perpustakaan.usulan') }}" class="admin-dropdown__item" style="align-items: flex-start;">
                        <span style="color: var(--warning); margin-top: 2px;">•</span>
                        <div>
                            <div style="font-weight: 700; color: var(--text-dark);">5 Usulan Buku Baru</div>
                            <div style="font-size: 0.72rem; color: var(--text-muted);">Menunggu validasi pustakawan</div>
                        </div>
                    </a>
                    <a href="{{ route('admin.kearsipan.permohonan') }}" class="admin-dropdown__item" style="align-items: flex-start;">
                        <span style="color: var(--info); margin-top: 2px;">•</span>
                        <div>
                            <div style="font-weight: 700; color: var(--text-dark);">3 Permohonan Arsip</div>
                            <div style="font-size: 0.72rem; color: var(--text-muted);">Perlu diproses oleh arsiparis</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- User Profile Dropdown -->
        @php
            $adminUser = session('admin_user', [
                'name' => 'Administrator Arpusda',
                'role' => 'Super Admin',
                'jabatan' => 'Pranata Komputer Ahli',
                'email' => 'admin@arpusda.semarangkota.go.id'
            ]);
        @endphp
        <div class="topbar-user">
            <button type="button" class="topbar-user__trigger" id="userMenuTrigger" aria-label="Menu Pengguna">
                <div class="topbar-user__avatar">
                    {{ strtoupper(substr($adminUser['name'] ?? 'A', 0, 1)) }}
                </div>
                <div class="topbar-user__meta">
                    <span class="topbar-user__name">{{ $adminUser['name'] ?? 'Admin' }}</span>
                    <span class="topbar-user__role">{{ $adminUser['role'] ?? 'Super Admin' }}</span>
                </div>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--text-muted); margin-left: 2px;">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>

            <!-- User Menu Box -->
            <div class="admin-dropdown" id="userDropdownMenu">
                <div class="admin-dropdown__header">
                    <div class="admin-dropdown__title">{{ $adminUser['name'] ?? 'Admin' }}</div>
                    <div class="admin-dropdown__subtitle">{{ $adminUser['email'] ?? 'admin@semarangkota.go.id' }}</div>
                </div>

                <a href="{{ route('home') }}" class="admin-dropdown__item" target="_blank">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                    <span>Lihat Portal Publik</span>
                </a>

                <a href="{{ route('admin.pengaturan.pengguna') }}" class="admin-dropdown__item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>Profil & Pengguna</span>
                </a>

                <div class="admin-dropdown__divider"></div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="admin-dropdown__item text-danger" style="width: 100%; text-align: left; background: none; border: none; font-family: inherit;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span>Keluar (Logout)</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

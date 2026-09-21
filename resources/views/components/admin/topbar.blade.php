<header class="admin-topbar">
    <!-- Left Section: Sidebar Toggle & ⌘K Search -->
    <div class="topbar-left">
        <button type="button" class="sidebar-toggle-btn" id="sidebarToggleBtn" aria-label="Buka/Tutup Navigasi Menu">
            <i data-lucide="menu" style="width: 20px; height: 20px;"></i>
        </button>

        <div class="topbar-search">
            <i data-lucide="search" class="search-icon"></i>
            <input type="text" id="globalSearchInput" placeholder="Cari data, buku, permohonan..." aria-label="Pencarian Cepat CMS">
            <span class="kbd-badge">Ctrl K</span>
        </div>
    </div>

    <!-- Right Section: Time, Dark Mode, Notifications, User Profile -->
    <div class="topbar-right">
        <!-- Live Date Badge -->
        <div class="topbar-time-badge">
            <i data-lucide="calendar" style="width: 15px; height: 15px; color: var(--accent-gold-dark);"></i>
            <span>{{ now()->translatedFormat('d F Y') }}</span>
        </div>

        <!-- Dark Mode Toggle Button -->
        <button type="button" class="topbar-btn" id="darkModeToggle" title="Ganti Mode Gelap/Terang" aria-label="Mode Tampilan">
            <i data-lucide="moon" style="width: 18px; height: 18px;"></i>
        </button>

        <!-- Notification Bell & Action Center Dropdown -->
        <div style="position: relative;">
            <button type="button" class="topbar-btn" id="notifMenuTrigger" title="Notifikasi Sistem" aria-label="Notifikasi">
                <i data-lucide="bell" style="width: 18px; height: 18px;"></i>
                <span class="btn-badge">2</span>
            </button>

            <!-- Notifications Dropdown Menu -->
            <div class="admin-dropdown" id="notifDropdownMenu" style="width: 330px;">
                <div class="admin-dropdown__header">
                    <div class="admin-dropdown__title">Pusat Aktivitas</div>
                    <div class="admin-dropdown__subtitle">2 permohonan baru memerlukan tindakan</div>
                </div>
                <div>
                    <a href="{{ route('admin.perpustakaan.usulan') }}" class="admin-dropdown__item" style="align-items: flex-start; gap: 12px;">
                        <div style="width: 32px; height: 32px; border-radius: 10px; background: var(--warning-bg); color: var(--warning); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                            <i data-lucide="book-plus" style="width: 16px; height: 16px;"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; color: var(--text-dark); font-size: 0.84rem;">5 Usulan Buku Baru</div>
                            <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.4;">Menunggu validasi pustakawan</div>
                        </div>
                    </a>
                    <a href="{{ route('admin.kearsipan.permohonan') }}" class="admin-dropdown__item" style="align-items: flex-start; gap: 12px;">
                        <div style="width: 32px; height: 32px; border-radius: 10px; background: var(--info-bg); color: var(--info); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                            <i data-lucide="file-search" style="width: 16px; height: 16px;"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; color: var(--text-dark); font-size: 0.84rem;">3 Permohonan Arsip</div>
                            <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.4;">Perlu diproses oleh arsiparis</div>
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
                <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: var(--text-muted); margin-left: 2px;"></i>
            </button>

            <!-- User Menu Box -->
            <div class="admin-dropdown" id="userDropdownMenu">
                <div class="admin-dropdown__header">
                    <div class="admin-dropdown__title">{{ $adminUser['name'] ?? 'Admin' }}</div>
                    <div class="admin-dropdown__subtitle">{{ $adminUser['email'] ?? 'admin@semarangkota.go.id' }}</div>
                </div>

                <a href="{{ route('home') }}" class="admin-dropdown__item" target="_blank">
                    <i data-lucide="external-link" style="width: 16px; height: 16px; color: var(--primary);"></i>
                    <span>Buka Portal Publik</span>
                </a>

                <a href="{{ route('admin.pengaturan.pengguna') }}" class="admin-dropdown__item">
                    <i data-lucide="user-cog" style="width: 16px; height: 16px;"></i>
                    <span>Profil & Pengguna</span>
                </a>

                <div class="admin-dropdown__divider"></div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="admin-dropdown__item text-danger" style="width: 100%; text-align: left; background: none; border: none; font-family: inherit;">
                        <i data-lucide="log-out" style="width: 16px; height: 16px; color: var(--danger);"></i>
                        <span>Keluar (Logout)</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<x-admin.layout title="Dashboard Utama CMS | Dinas Arsip dan Perpustakaan Kota Semarang">
    <!-- Page Header -->
    <x-admin.page-header
        title="Dashboard Utama"
        subtitle="Selamat datang di Content Management System (CMS) Dinas Arsip dan Perpustakaan Kota Semarang."
        :breadcrumbs="[['label' => 'Dashboard']]"
    >
        <x-slot:actions>
            <a href="{{ route('admin.perpustakaan.buku') }}" class="admin-btn admin-btn--primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Tambah Buku Baru</span>
            </a>
            <a href="{{ route('admin.kearsipan.galeri') }}" class="admin-btn admin-btn--secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
                <span>Upload Arsip</span>
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- 1. STATISTIC CARDS WIDGETS -->
    <div class="stat-cards-grid">
        <x-admin.stat-card
            title="Total Koleksi Buku"
            value="{{ $stats['total_buku']['value'] }}"
            description="{{ $stats['total_buku']['description'] }}"
            growth="{{ $stats['total_buku']['growth'] }}"
            icon="book-open"
            color="maroon"
        />

        <x-admin.stat-card
            title="Total Arsip Sejarah"
            value="{{ $stats['total_arsip']['value'] }}"
            description="{{ $stats['total_arsip']['description'] }}"
            growth="{{ $stats['total_arsip']['growth'] }}"
            icon="archive"
            color="gold"
        />

        <x-admin.stat-card
            title="Kunjungan Website"
            value="{{ $stats['kunjungan_web']['value'] }}"
            description="{{ $stats['kunjungan_web']['description'] }}"
            growth="{{ $stats['kunjungan_web']['growth'] }}"
            icon="globe"
            color="blue"
        />

        <x-admin.stat-card
            title="Usulan Buku Baru"
            value="{{ $stats['usulan_pending']['value'] }}"
            description="{{ $stats['usulan_pending']['description'] }}"
            growth="{{ $stats['usulan_pending']['growth'] }}"
            icon="file-text"
            color="amber"
        />
    </div>

    <!-- 2. NOTIFICATION / ACTION REQUIRED ALERTS WIDGETS -->
    <div class="admin-alerts-grid">
        <div class="admin-alert-card admin-alert-card--warning">
            <div class="admin-alert-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
            </div>
            <div class="admin-alert-content">
                <h4 class="admin-alert-title">Usulan Buku Baru</h4>
                <p class="admin-alert-message">Ada <strong>5 Usulan Buku Baru</strong> dari masyarakat yang perlu ditinjau dan divalidasi oleh pustakawan.</p>
                <div class="admin-alert-footer">
                    <a href="{{ route('admin.perpustakaan.usulan') }}" class="admin-alert-link">
                        <span>Tinjau Usulan Sekarang</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <span class="admin-alert-time">Hari ini</span>
                </div>
            </div>
        </div>

        <div class="admin-alert-card admin-alert-card--info">
            <div class="admin-alert-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <circle cx="10" cy="14" r="3"></circle>
                    <line x1="12" y1="16" x2="15" y2="19"></line>
                </svg>
            </div>
            <div class="admin-alert-content">
                <h4 class="admin-alert-title">Permohonan Penelusuran Arsip</h4>
                <p class="admin-alert-message">Ada <strong>3 Permohonan Penelusuran Arsip</strong> yang perlu diproses dan diverifikasi berkasnya oleh arsiparis.</p>
                <div class="admin-alert-footer">
                    <a href="{{ route('admin.kearsipan.permohonan') }}" class="admin-alert-link">
                        <span>Proses Berkas Masuk</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <span class="admin-alert-time">Hari ini</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. TABLE: JADWAL PERPUSTAKAAN KELILING TERDEKAT -->
    <x-admin.data-table
        title="Jadwal Perpustakaan Keliling Terdekat"
        subtitle="Daftar jadwal operasional armada perpustakaan keliling pekan ini di wilayah Kota Semarang."
        searchPlaceholder="Cari lokasi atau armada..."
    >
        <x-slot:actions>
            <a href="{{ route('admin.perpustakaan.jadwal') }}" class="admin-btn admin-btn--sm admin-btn--secondary">
                <span>Kelola Seluruh Jadwal</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        </x-slot:actions>

        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 140px;">Tanggal</th>
                    <th>Lokasi & Wilayah</th>
                    <th style="width: 180px;">Jam Operasional</th>
                    <th style="width: 180px;">Status Armada</th>
                    <th style="width: 100px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwalList as $jadwal)
                    <tr>
                        <td>
                            <div style="font-weight: 700; color: var(--text-dark);">{{ $jadwal['tanggal'] }}</div>
                            <div style="font-size: 0.74rem; color: var(--text-muted);">{{ $jadwal['hari'] }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--text-dark);">{{ $jadwal['lokasi'] }}</div>
                            <div style="font-size: 0.74rem; color: var(--text-muted);">{{ $jadwal['armada'] }}</div>
                        </td>
                        <td>
                            <span style="display: inline-flex; align-items: center; gap: 6px; font-weight: 500;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--text-muted);">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                {{ $jadwal['jam'] }}
                            </span>
                        </td>
                        <td>
                            <x-admin.status-badge :status="$jadwal['status']" />
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.perpustakaan.jadwal') }}" class="btn-table-action" title="Lihat detail jadwal">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="admin-empty-state">
                                <p>Belum ada jadwal yang terdaftar.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-admin.data-table>

    <!-- 4. QUICK SUMMARY 2-COLUMN GRID (Usulan Baru & Permohonan Terakhir) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 24px;">
        <!-- Usulan Buku Terkini -->
        <x-admin.data-table
            title="Usulan Buku Terkini (SI ULAN)"
            subtitle="Pengajuan pengadaan buku dari masyarakat"
            searchPlaceholder="Cari usulan..."
        >
            <x-slot:actions>
                <a href="{{ route('admin.perpustakaan.usulan') }}" class="admin-btn admin-btn--sm admin-btn--secondary">Lihat Semua</a>
            </x-slot:actions>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Judul & Pengusul</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usulanRecent as $u)
                        <tr>
                            <td>
                                <div style="font-weight: 700; color: var(--text-dark);">{{ $u['judul'] }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">Oleh: {{ $u['nama'] }}</div>
                            </td>
                            <td style="font-size: 0.78rem; color: var(--text-muted);">{{ $u['tanggal'] }}</td>
                            <td>
                                <x-admin.status-badge :status="$u['status']" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-admin.data-table>

        <!-- Permohonan Kearsipan Terkini -->
        <x-admin.data-table
            title="Permohonan Penelusuran Arsip"
            subtitle="Permohonan riset akademis & sejarah"
            searchPlaceholder="Cari pemohon..."
        >
            <x-slot:actions>
                <a href="{{ route('admin.kearsipan.permohonan') }}" class="admin-btn admin-btn--sm admin-btn--secondary">Lihat Semua</a>
            </x-slot:actions>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Pemohon & Institusi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permohonanRecent as $p)
                        <tr>
                            <td>
                                <div style="font-weight: 700; color: var(--text-dark);">{{ $p['nama'] }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $p['institusi'] }}</div>
                            </td>
                            <td style="font-size: 0.78rem; color: var(--text-muted);">{{ $p['tanggal'] }}</td>
                            <td>
                                <x-admin.status-badge :status="$p['status']" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-admin.data-table>
    </div>
</x-admin.layout>

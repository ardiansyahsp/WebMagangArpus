<x-admin.layout title="Dashboard Utama CMS | Dinas Arsip dan Perpustakaan Kota Semarang">
    <!-- Page Header -->
    <x-admin.page-header
        title="Dashboard Utama"
        subtitle="Selamat datang di Portal Manajemen CMS Dinas Arsip dan Perpustakaan Kota Semarang."
        :breadcrumbs="[['label' => 'Dashboard']]"
    >
        <x-slot:actions>
            <a href="{{ route('admin.perpustakaan.buku') }}" class="admin-btn admin-btn--primary">
                <i data-lucide="plus" style="width: 16px; height: 16px;"></i>
                <span>Tambah Buku Baru</span>
            </a>
            <a href="{{ route('admin.kearsipan.galeri') }}" class="admin-btn admin-btn--secondary">
                <i data-lucide="upload-cloud" style="width: 16px; height: 16px;"></i>
                <span>Upload Khazanah Arsip</span>
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- 1. FLOATING STAT CARDS WITH SPARKLINES & ANIMATED COUNTERS -->
    <div class="stat-cards-grid">
        <x-admin.stat-card
            title="Total Koleksi Buku"
            value="{{ $stats['total_buku']['value'] }}"
            raw="{{ $stats['total_buku']['raw'] }}"
            description="{{ $stats['total_buku']['description'] }}"
            growth="{{ $stats['total_buku']['growth'] }}"
            icon="book-open"
            color="maroon"
        />

        <x-admin.stat-card
            title="Total Arsip Sejarah"
            value="{{ $stats['total_arsip']['value'] }}"
            raw="{{ $stats['total_arsip']['raw'] }}"
            description="{{ $stats['total_arsip']['description'] }}"
            growth="{{ $stats['total_arsip']['growth'] }}"
            icon="archive"
            color="gold"
        />

        <x-admin.stat-card
            title="Kunjungan Website"
            value="{{ $stats['kunjungan_web']['value'] }}"
            raw="{{ $stats['kunjungan_web']['raw'] }}"
            description="{{ $stats['kunjungan_web']['description'] }}"
            growth="{{ $stats['kunjungan_web']['growth'] }}"
            icon="globe"
            color="blue"
        />

        <x-admin.stat-card
            title="Usulan Buku Baru"
            value="{{ $stats['usulan_pending']['value'] }}"
            raw="{{ $stats['usulan_pending']['raw'] }}"
            description="{{ $stats['usulan_pending']['description'] }}"
            growth="{{ $stats['usulan_pending']['growth'] }}"
            icon="file-text"
            color="amber"
        />
    </div>

    <!-- 2. ACTION CENTER: NOTIFICATION & PENDING ACTION WIDGETS -->
    <div class="admin-alerts-grid animate-fade-up delay-200">
        <div class="admin-alert-card admin-alert-card--warning">
            <div class="admin-alert-icon">
                <i data-lucide="book-marked" style="width: 22px; height: 22px;"></i>
            </div>
            <div class="admin-alert-content">
                <h4 class="admin-alert-title">Usulan Buku Baru (SI ULAN)</h4>
                <p class="admin-alert-message">Ada <strong>5 Usulan Buku Baru</strong> dari masyarakat yang perlu ditinjau dan divalidasi oleh tim pustakawan.</p>
                <div class="admin-alert-footer">
                    <a href="{{ route('admin.perpustakaan.usulan') }}" class="admin-alert-link">
                        <span>Tinjau Usulan Sekarang</span>
                        <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                    </a>
                    <span class="admin-alert-time">Hari ini • 10 menit lalu</span>
                </div>
            </div>
        </div>

        <div class="admin-alert-card admin-alert-card--info">
            <div class="admin-alert-icon">
                <i data-lucide="file-search-2" style="width: 22px; height: 22px;"></i>
            </div>
            <div class="admin-alert-content">
                <h4 class="admin-alert-title">Permohonan Riset Kearsipan</h4>
                <p class="admin-alert-message">Ada <strong>3 Permohonan Penelusuran Arsip</strong> yang perlu diverifikasi dan diproses oleh arsiparis daerah.</p>
                <div class="admin-alert-footer">
                    <a href="{{ route('admin.kearsipan.permohonan') }}" class="admin-alert-link">
                        <span>Proses Berkas Masuk</span>
                        <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                    </a>
                    <span class="admin-alert-time">Hari ini • 35 menit lalu</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. TABLE: JADWAL PERPUSTAKAAN KELILING TERDEKAT (SUPABASE/LINEAR STYLE) -->
    <div class="animate-fade-up delay-300">
        <x-admin.data-table
            title="Jadwal Perpustakaan Keliling Terdekat"
            subtitle="Agenda operasional armada mobil perpustakaan keliling pekan ini di wilayah Kota Semarang"
            searchPlaceholder="Cari lokasi, armada, tanggal..."
        >
            <x-slot:actions>
                <a href="{{ route('admin.perpustakaan.jadwal') }}" class="admin-btn admin-btn--sm admin-btn--secondary">
                    <span>Kelola Semua Jadwal</span>
                    <i data-lucide="arrow-up-right" style="width: 14px; height: 14px;"></i>
                </a>
            </x-slot:actions>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 160px;">Tanggal</th>
                        <th>Lokasi & Wilayah Singgah</th>
                        <th style="width: 200px;">Jam Operasional</th>
                        <th style="width: 180px;">Status Armada</th>
                        <th style="width: 100px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwalList as $jadwal)
                        <tr>
                            <td>
                                <div style="font-weight: 700; color: var(--text-dark); font-size: 0.88rem;">{{ $jadwal['tanggal'] }}</div>
                                <div style="font-size: 0.74rem; color: var(--text-muted); font-weight: 500;">{{ $jadwal['hari'] }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: var(--text-dark);">{{ $jadwal['lokasi'] }}</div>
                                <div style="font-size: 0.74rem; color: var(--text-muted); display: flex; align-items: center; gap: 4px; margin-top: 2px;">
                                    <i data-lucide="truck" style="width: 12px; height: 12px; color: var(--accent-gold-dark);"></i>
                                    <span>{{ $jadwal['armada'] }}</span>
                                </div>
                            </td>
                            <td>
                                <span style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; font-size: 0.82rem; color: var(--text-body);">
                                    <i data-lucide="clock" style="width: 14px; height: 14px; color: var(--text-muted);"></i>
                                    {{ $jadwal['jam'] }}
                                </span>
                            </td>
                            <td>
                                <x-admin.status-badge :status="$jadwal['status']" />
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.perpustakaan.jadwal') }}" class="btn-table-action" title="Detail Jadwal">
                                    <i data-lucide="eye" style="width: 14px; height: 14px;"></i>
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
    </div>

    <!-- 4. QUICK 2-COLUMN SUMMARY (USULAN & PERMOHONAN RECENT) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 24px;" class="animate-fade-up delay-400">
        <!-- Usulan Buku Terkini -->
        <x-admin.data-table
            title="Usulan Buku Baru (SI ULAN)"
            subtitle="Pengajuan buku terkini dari masyarakat"
            searchPlaceholder="Cari judul..."
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
                                <div style="font-size: 0.74rem; color: var(--text-muted);">Oleh: {{ $u['nama'] }}</div>
                            </td>
                            <td style="font-size: 0.78rem; color: var(--text-muted); font-family: var(--font-mono);">{{ $u['tanggal'] }}</td>
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
            subtitle="Permohonan riset akademis & naskah kuno"
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
                                <div style="font-size: 0.74rem; color: var(--text-muted);">{{ $p['institusi'] }}</div>
                            </td>
                            <td style="font-size: 0.78rem; color: var(--text-muted); font-family: var(--font-mono);">{{ $p['tanggal'] }}</td>
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

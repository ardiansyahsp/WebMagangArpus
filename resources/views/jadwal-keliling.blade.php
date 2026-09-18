<x-layout.app title="Jadwal Perpustakaan Keliling | Dinas Arpusda">
    
    @php
        // Mengelompokkan data berdasarkan tanggal untuk sistem Tab
        $groupedJadwal = [];
        foreach($jadwalList as $j) {
            $dateNum = explode(' ', $j['tanggal'])[0]; 
            $shortDay = substr($j['hari'], 0, 3); 
            $groupKey = $dateNum;

            if(!isset($groupedJadwal[$groupKey])) {
                $groupedJadwal[$groupKey] = [
                    'hari_singkat' => $shortDay,
                    'tanggal_angka' => $dateNum,
                    'tanggal_full' => $j['tanggal'],
                    'items' => []
                ];
            }
            $groupedJadwal[$groupKey]['items'][] = $j;
        }
        $firstKey = array_key_first($groupedJadwal);
    @endphp

    <style>
        .jadwal-page-wrapper { background-color: #f8fafc; min-height: 100vh; padding-bottom: 80px; }
        
        /* 1. HERO BANNER */
        .page-hero {
            /* Menggunakan gambar background yang sama dengan Beranda */
            background: linear-gradient(rgba(0, 10, 30, 0.75), rgba(0, 10, 30, 0.85)), url('{{ asset("asset/bakgron.jpg") }}') center/cover;
            padding: 70px 0;
            text-align: center;
            color: white;
            margin-bottom: 50px;
        }
        .hero-title { font-family: var(--font-heading); font-size: 2.8rem; font-weight: 800; margin-bottom: 10px; }
        .hero-breadcrumb { font-size: 0.95rem; color: #cbd5e1; }
        .hero-breadcrumb a { color: white; text-decoration: none; opacity: 0.8; transition: opacity 0.2s; }
        .hero-breadcrumb a:hover { opacity: 1; }

        /* 2. LAYOUT 2 KOLOM */
        .layout-grid {
            display: grid;
            grid-template-columns: 1.1fr 1fr; /* Kolom Kiri sedikit lebih lebar */
            gap: 50px;
            align-items: start;
        }

        /* 3. KOLOM KIRI (Informasi & Foto) */
        .info-section {
            background: white;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-sm);
        }
        .info-tagline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--danger);
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        .info-tagline .line { width: 30px; height: 2px; background: var(--danger); }
        .info-title { font-family: var(--font-heading); font-size: 2rem; color: var(--text-dark); line-height: 1.3; font-weight: 800; margin-bottom: 20px; }
        .info-desc { font-size: 1.05rem; color: var(--text-muted); line-height: 1.7; margin-bottom: 25px; }
        .info-image { width: 100%; height: 250px; object-fit: cover; border-radius: 12px; margin-bottom: 25px; }
        
        .btn-print-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background-color: var(--text-dark);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-print-action:hover { background-color: #334155; }

        /* 4. KOLOM KANAN (Widget Jadwal) */
        .widget-container {
            background: white;
            border: 1px solid var(--border-light);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow-md); /* Bayangan sedikit lebih tebal agar menonjol */
        }
        .widget-subtitle { font-size: 0.95rem; color: var(--text-muted); margin-bottom: 6px; }
        .widget-title { font-family: var(--font-heading); font-size: 1.6rem; font-weight: 800; color: var(--text-dark); margin-bottom: 24px; }

        .date-selector { display: flex; gap: 12px; overflow-x: auto; padding-bottom: 10px; margin-bottom: 20px; }
        .date-selector::-webkit-scrollbar { height: 4px; }
        .date-selector::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

        .date-pill {
            position: relative;
            min-width: 75px;
            text-align: center;
            border: 1px solid var(--border-light);
            border-radius: 16px;
            padding: 14px 10px;
            cursor: pointer;
            background: white;
            transition: all 0.2s ease;
        }
        .date-pill:hover { background: #f1f5f9; }
        /* Branding Arpusda: Warna Aktif diubah menjadi Maroon/Merah Gelap */
        .date-pill.active {
            border: 2px solid var(--danger);
            background: var(--danger);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
        }
        .pill-day { font-size: 0.85rem; color: var(--text-muted); font-weight: 700; margin-bottom: 2px; }
        .pill-date { font-size: 1.5rem; font-weight: 800; color: var(--text-dark); }
        .date-pill.active .pill-day, .date-pill.active .pill-date { color: white; }

        .pill-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: white;
            color: var(--danger);
            font-size: 0.75rem;
            font-weight: bold;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid var(--danger);
        }

        .tab-content { display: none; animation: fadeIn 0.3s ease; }
        .tab-content.active { display: block; }

        /* Area Scroll Khusus untuk Kartu Jadwal */
        #tab-contents-wrapper {
            max-height: 420px; /* Batas maksimal tinggi sebelum muncul scroll */
            overflow-y: auto;
            padding-right: 12px;
            margin-bottom: 20px;
        }
        
        /* Desain Scrollbar Custom agar terlihat modern */
        #tab-contents-wrapper::-webkit-scrollbar { width: 6px; }
        #tab-contents-wrapper::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 8px; }
        #tab-contents-wrapper::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }
        #tab-contents-wrapper::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        .schedule-card {
            border: 1px solid var(--border-light);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
            background: white;
            transition: border-color 0.2s;
        }
        .schedule-card:hover { border-color: #cbd5e1; box-shadow: var(--shadow-sm); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
        .card-time { font-family: monospace; font-size: 1.1rem; font-weight: 700; color: var(--text-dark); }
        
        .status-badge { font-size: 0.8rem; font-weight: 700; padding: 4px 12px; border-radius: 20px; }
        .badge-berlangsung { background: #f0fdf4; color: #15803d; }
        .badge-berikutnya { background: #eff6ff; color: #1d4ed8; }
        .badge-selesai { background: #f1f5f9; color: #64748b; }

        .card-title { font-size: 1.25rem; font-weight: 800; color: var(--text-dark); margin-bottom: 8px; }
        .card-location { display: flex; align-items: center; gap: 8px; font-size: 0.95rem; color: var(--text-muted); }

        .other-schedules-wrapper { margin-top: 30px; border-top: 1px solid var(--border-light); padding-top: 20px; }
        .other-title { font-size: 1rem; color: var(--text-muted); font-weight: 600; margin-bottom: 16px; }
        .other-item { display: flex; align-items: center; gap: 16px; padding: 12px 0; border-bottom: 1px solid var(--border-light); cursor: pointer; }
        .other-item:last-child { border-bottom: none; }
        .other-item:hover .other-location { color: var(--danger); }
        .other-dot { width: 8px; height: 8px; background: #cbd5e1; border-radius: 50%; }
        .other-info { flex: 1; }
        .other-location { font-size: 1.05rem; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; transition: color 0.2s; }
        .other-meta { font-size: 0.85rem; color: var(--text-muted); }
        
        /* Print Styles */
        @media print {
            .page-hero, .btn-print-action, footer, header { display: none !important; }
            .jadwal-page-wrapper { background: white; padding: 0; }
            .layout-grid { grid-template-columns: 1fr; }
            .widget-container, .info-section { box-shadow: none; border: none; padding: 0; }
        }

        /* Responsif Mobile */
        @media (max-width: 992px) {
            .layout-grid { grid-template-columns: 1fr; }
            .hero-title { font-size: 2rem; }
        }
    </style>

    <div class="jadwal-page-wrapper">
        
        <!-- Hero Banner Area -->
        <div class="page-hero">
            <div class="container">
                <h1 class="hero-title">Layanan Perpustakaan Keliling</h1>
                <div class="hero-breadcrumb">
                    <a href="{{ route('home') }}">Beranda</a> / Layanan / <span style="color: white; font-weight: 600;">Jadwal Keliling</span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="layout-grid">
                
                <!-- KOLOM KIRI: Informasi & Konteks -->
                <div class="info-section">
                    <div class="info-tagline">
                        <span class="line"></span> PROGRAM UNGGULAN
                    </div>
                    <h2 class="info-title">Mendekatkan Jendela Dunia ke Lingkungan Anda</h2>
                    <p class="info-desc">
                        Mobil Pintar Perpustakaan Keliling Dinas Arpusda Kota Semarang beroperasi setiap minggu untuk menjangkau kawasan padat penduduk, balai warga, dan sekolah-sekolah dasar guna meningkatkan minat literasi masyarakat tanpa harus berkunjung ke perpustakaan pusat.
                    </p>
                    
                    <!-- Mengambil gambar dari asset yang sudah ada (asset/tradisingaliyan.jpg) -->
                    <img src="{{ asset('asset/tradisingaliyan.jpg') }}" alt="Armada Perpustakaan Keliling" class="info-image">
                    
                    <div style="margin-bottom: 25px; font-size: 0.95rem; color: var(--text-muted);">
                        <strong>Ingin armada kami datang ke wilayah Anda?</strong><br>
                        Silakan ajukan permohonan melalui surat resmi kelurahan atau kepala sekolah yang ditujukan kepada Kepala Dinas Arpusda Kota Semarang.
                    </div>

                    <button onclick="window.print()" class="btn-print-action" title="Cetak atau Simpan PDF">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                        Cetak Jadwal Mingguan
                    </button>
                </div>

                <!-- KOLOM KANAN: Widget Jadwal Interaktif -->
                <div class="widget-container">
                    <div class="widget-subtitle">Periode 14–20 September 2026</div>
                    <h3 class="widget-title">Jadwal Operasional</h3>

                    <!-- Date Pills / Tab Selector -->
                    <div class="date-selector">
                        @foreach($groupedJadwal as $key => $group)
                            <div class="date-pill {{ $loop->first ? 'active' : '' }}" onclick="switchTab('{{ $key }}')" id="pill-{{ $key }}">
                                @if(count($group['items']) > 1)
                                    <span class="pill-badge">{{ count($group['items']) }}</span>
                                @endif
                                <div class="pill-day">{{ $group['hari_singkat'] }}</div>
                                <div class="pill-date">{{ $group['tanggal_angka'] }}</div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Active Content Cards -->
                    <div id="tab-contents-wrapper">
                        @foreach($groupedJadwal as $key => $group)
                            <div class="tab-content {{ $loop->first ? 'active' : '' }}" id="content-{{ $key }}">
                                @foreach($group['items'] as $item)
                                    @php
                                        $statusClass = 'badge-berikutnya';
                                        if (strtolower($item['status']) === 'selesai') {
                                            $statusClass = 'badge-selesai';
                                        } elseif (strtolower($item['status']) === 'sedang berjalan' || strtolower($item['status']) === 'sedang berlangsung') {
                                            $statusClass = 'badge-berlangsung';
                                        }
                                    @endphp

                                    <div class="schedule-card" style="{{ strtolower($item['status']) === 'sedang berjalan' ? 'border-color: var(--danger);' : '' }}">
                                        <div class="card-header">
                                            <div class="card-time">{{ $item['waktu'] }}</div>
                                            <div class="status-badge {{ $statusClass }}">{{ $item['status'] }}</div>
                                        </div>
                                        <h4 class="card-title">{{ $item['titik'] }}</h4>
                                        <div class="card-location">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                            {{ $item['wilayah'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <!-- Other Schedules List -->
                    <div class="other-schedules-wrapper">
                        <h4 class="other-title">Jadwal lainnya minggu ini</h4>
                        
                        @foreach($jadwalList as $item)
                            @php $itemKey = explode(' ', $item['tanggal'])[0]; @endphp
                            
                            <div class="other-item" data-date="{{ $itemKey }}" style="display: {{ $itemKey == $firstKey ? 'none' : 'flex' }};" onclick="switchTab('{{ $itemKey }}')">
                                <div class="other-dot"></div>
                                <div class="other-info">
                                    <div class="other-location">{{ $item['titik'] }}</div>
                                    <div class="other-meta">{{ $item['hari'] }}, {{ explode(' ', $item['tanggal'])[0] }} {{ explode(' ', $item['tanggal'])[1] }} &bull; {{ $item['status'] }}</div>
                                </div>
                                <div>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(dateKey) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.getElementById('content-' + dateKey).classList.add('active');

            document.querySelectorAll('.date-pill').forEach(el => el.classList.remove('active'));
            document.getElementById('pill-' + dateKey).classList.add('active');

            document.querySelectorAll('.other-item').forEach(el => {
                if(el.getAttribute('data-date') === dateKey) {
                    el.style.display = 'none';
                } else {
                    el.style.display = 'flex';
                }
            });
        }
    </script>
</x-layout.app>
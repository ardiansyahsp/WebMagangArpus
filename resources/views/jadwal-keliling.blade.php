<x-layout.app title="Jadwal Perpustakaan Keliling | Dinas Arpusda">
    
    <style>
        .timeline-section { padding: 60px 0 80px; }
        .timeline-container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            padding-left: 40px; /* Ruang untuk garis */
        }
        
        /* Garis Vertikal Utama */
        .timeline-container::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 10px;
            bottom: 10px;
            width: 3px;
            background: var(--border-light);
            border-radius: 5px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 40px;
            background: white;
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-light);
            transition: transform 0.2s;
        }
        
        .timeline-item:hover { transform: translateX(5px); box-shadow: var(--shadow-md); }

        /* Titik Pin Lokasi pada Garis */
        .timeline-pin {
            position: absolute;
            left: -40px; /* Menarik pin ke tengah garis vertikal */
            top: 24px;
            width: 32px;
            height: 32px;
            background: white;
            border: 4px solid var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 5px rgba(255,255,255,0.8);
        }

        .timeline-date {
            display: inline-block;
            background: var(--surface-light);
            color: var(--text-dark);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .timeline-title {
            font-family: var(--font-heading);
            font-size: 1.4rem;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .timeline-meta {
            display: flex;
            gap: 15px;
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .status-badge {
            font-size: 0.8rem;
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: 600;
        }
        .status-badge.Selesai { background: #f8d7da; color: #842029; }
        .status-badge.Akan.Datang { background: #cfe2ff; color: #084298; }
    </style>

    <div class="timeline-section">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 50px;">
                <h1 class="section-title">Jadwal <span class="text-maroon">Perpustakaan Keliling</span></h1>
                <p style="color: var(--text-muted); margin-top: 10px;">Periode 14 - 20 September 2026. Jadwal dapat berubah sewaktu-waktu.</p>
            </div>

            <div class="timeline-container">
                @foreach($jadwalList as $jadwal)
                    <div class="timeline-item">
                        <!-- Titik Pin dengan warna dinamis -->
                        <div class="timeline-pin" style="border-color: {{ $jadwal['warna_pin'] }};">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="{{ $jadwal['warna_pin'] }}"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        </div>
                        
                        <div class="timeline-date">{{ $jadwal['hari'] }}, {{ $jadwal['tanggal'] }}</div>
                        <h3 class="timeline-title">{{ $jadwal['titik'] }}</h3>
                        
                        <div class="timeline-meta">
                            <span>🕒 {{ $jadwal['waktu'] }}</span>
                            <span>📍 {{ $jadwal['wilayah'] }}</span>
                        </div>

                        <span class="status-badge {{ str_replace(' ', '.', $jadwal['status']) }}">
                            {{ $jadwal['status'] }}
                        </span>
                    </div>
                @endforeach
            </div>
            
        </div>
    </div>
</x-layout.app>
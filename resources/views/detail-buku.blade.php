<x-layout.app title="Detail Buku - {{ $buku['judul'] }} | OPAC Arpusda">
    
    <style>
        .detail-wrapper { background-color: var(--bg-light); min-height: 100vh; padding: 40px 0 80px; }
        
        /* Breadcrumb (Navigasi Jejak) */
        .breadcrumb-nav { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 30px; }
        .breadcrumb-nav a { color: var(--primary); text-decoration: none; font-weight: 600; }
        .breadcrumb-nav a:hover { text-decoration: underline; }

        /* LAYOUT 2 KOLOM */
        .book-layout {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 40px;
            align-items: start;
        }

        /* KOLOM KIRI: FOTO BUKU & AKSI */
        .book-cover-card {
            background: white;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-light);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            text-align: center;
        }
        .cover-image-placeholder {
            width: 100%;
            aspect-ratio: 2/3;
            background: #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            margin-bottom: 20px;
        }
        
        .action-buttons { display: flex; flex-direction: column; gap: 12px; }
        .btn-action {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-fav { background: white; border: 1px solid var(--border-color); color: var(--text-dark); }
        .btn-fav:hover { background: #f8fafc; border-color: var(--primary); color: var(--primary); }
        .btn-share { background: var(--primary-soft); border: 1px solid transparent; color: var(--primary); }
        .btn-share:hover { background: var(--primary); color: white; }

        /* KOLOM KANAN: DETAIL INFORMASI */
        .book-info-card {
            background: white;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-light);
            padding: 35px;
            box-shadow: var(--shadow-sm);
        }
        
        .b-kategori { font-size: 0.85rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; }
        .b-judul { font-family: var(--font-heading); font-size: 2.2rem; font-weight: 800; color: var(--text-dark); line-height: 1.3; margin-bottom: 8px; }
        .b-penulis { font-size: 1.1rem; color: var(--text-muted); margin-bottom: 24px; }
        
        .section-title { font-family: var(--font-heading); font-size: 1.2rem; font-weight: 700; color: var(--text-dark); margin: 30px 0 15px; border-bottom: 2px solid var(--border-light); padding-bottom: 10px; }
        
        .b-sinopsis { font-size: 0.95rem; color: var(--text-body); line-height: 1.7; }

        /* TABEL METADATA */
        .metadata-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            background: #f8fafc;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid var(--border-light);
        }
        .meta-item { display: flex; flex-direction: column; }
        .meta-label { font-size: 0.8rem; color: var(--text-muted); font-weight: 600; margin-bottom: 4px; }
        .meta-value { font-size: 0.95rem; color: var(--text-dark); font-weight: 500; }

        /* KOTAK KETERSEDIAAN (PALING PENTING DI OPAC) */
        .availability-box {
            margin-top: 35px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }
        .av-header {
            background: #f1f5f9;
            padding: 16px 24px;
            font-family: var(--font-heading);
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .badge { padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; }
        .badge-sedia { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
        .badge-pinjam { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

        .av-body { padding: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .location-info h4 { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; }
        .location-info p { font-size: 1.05rem; font-weight: 700; color: var(--text-dark); }
        .call-number { 
            display: inline-block;
            background: var(--primary-soft);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 8px;
            font-family: monospace;
            font-size: 1.2rem;
            font-weight: 800;
            border: 1px dashed var(--primary);
        }

        /* Responsif */
        @media (max-width: 992px) {
            .book-layout { grid-template-columns: 1fr; }
            .book-cover-card { max-width: 320px; margin: 0 auto; }
        }
        @media (max-width: 640px) {
            .metadata-grid { grid-template-columns: 1fr; }
            .av-body { grid-template-columns: 1fr; }
        }
    </style>

    <div class="detail-wrapper">
        <div class="container">
            
            <!-- Breadcrumb -->
            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Beranda</a> / 
                <a href="{{ route('katalog.buku') }}">Katalog OPAC</a> / 
                <span style="color: var(--text-dark);">{{ $buku['judul'] }}</span>
            </div>

            <div class="book-layout">
                
                <!-- KIRI: Foto & Tombol -->
                <div class="book-cover-card">
                    <!-- Ganti dengan tag img sesungguhnya saat integrasi database -->
                    <div class="cover-image-placeholder">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="btn-action btn-fav">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            Simpan ke Favorit
                        </button>
                        <button class="btn-action btn-share">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
                            Bagikan Link Buku
                        </button>
                    </div>
                </div>

                <!-- KANAN: Detail Info & Rak -->
                <div class="book-info-card">
                    <div class="b-kategori">{{ $buku['kategori'] }}</div>
                    <h1 class="b-judul">{{ $buku['judul'] }}</h1>
                    <div class="b-penulis">Oleh: <strong>{{ $buku['penulis'] }}</strong></div>

                    <!-- KOTAK KETERSEDIAAN RAK (Ini Inti dari OPAC) -->
                    <div class="availability-box">
                        <div class="av-header">
                            Info Ketersediaan
                            <span class="badge {{ $buku['status'] == 'Tersedia' ? 'badge-sedia' : 'badge-pinjam' }}">
                                {{ $buku['status'] }} (Sisa {{ $buku['sisa_eksemplar'] }} dari {{ $buku['total_eksemplar'] }})
                            </span>
                        </div>
                        <div class="av-body">
                            <div class="location-info">
                                <h4>Nomor Panggil (Call Number)</h4>
                                <div class="call-number">{{ $buku['no_panggil'] }}</div>
                                <p style="font-size: 0.8rem; margin-top: 8px; color: var(--text-muted); font-weight: normal;">*Catat nomor ini untuk mencari di rak</p>
                            </div>
                            <div class="location-info">
                                <h4>Lokasi Fisik Ruangan</h4>
                                <p>{{ $buku['lokasi_rak'] }}</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="section-title">Sinopsis Buku</h3>
                    <p class="b-sinopsis">{{ $buku['sinopsis'] }}</p>

                    <h3 class="section-title">Detail Identitas Buku</h3>
                    <div class="metadata-grid">
                        <div class="meta-item">
                            <span class="meta-label">Penerbit</span>
                            <span class="meta-value">{{ $buku['penerbit'] }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Tahun Terbit</span>
                            <span class="meta-value">{{ $buku['tahun_terbit'] }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">ISBN</span>
                            <span class="meta-value">{{ $buku['isbn'] }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Bahasa</span>
                            <span class="meta-value">{{ $buku['bahasa'] }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Jumlah Halaman</span>
                            <span class="meta-value">{{ $buku['halaman'] }}</span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
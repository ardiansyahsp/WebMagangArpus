<x-layout.app title="SI ULAN - Sistem Informasi Usulan Buku | Dinas Arpusda">
    
    <style>
        .usulan-page-wrapper { background-color: var(--bg-light); min-height: 100vh; padding-bottom: 80px; }
        
        /* HERO BANNER */
        .page-hero {
            background: linear-gradient(rgba(0, 10, 30, 0.75), rgba(0, 10, 30, 0.85)), url('{{ asset("asset/bakgron.jpg") }}') center/cover;
            padding: 70px 0;
            text-align: center;
            color: white;
            margin-bottom: 50px;
        }
        .hero-title { font-family: var(--font-heading); font-size: 2.5rem; font-weight: 800; margin-bottom: 10px; }
        .hero-breadcrumb { font-size: 0.95rem; color: #cbd5e1; }
        .hero-breadcrumb a { color: white; text-decoration: none; opacity: 0.8; transition: opacity 0.2s; }
        .hero-breadcrumb a:hover { opacity: 1; }

        /* LAYOUT 2 KOLOM */
        .layout-grid {
            display: grid;
            grid-template-columns: 1.3fr 1fr; /* Form sedikit lebih lebar dari tabel */
            gap: 40px;
            align-items: start;
        }

        /* CARD STYLE UMUM */
        .modern-card {
            background: white;
            padding: 35px;
            border-radius: 20px;
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-sm);
        }
        .card-header-title {
            font-family: var(--font-heading);
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        .card-header-desc { font-size: 0.95rem; color: var(--text-muted); margin-bottom: 30px; line-height: 1.6; }

        /* FORM USULAN (KOLOM KIRI) */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group.full-width { grid-column: span 2; }
        
        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            background: #f8fafc;
            font-size: 0.95rem;
            color: var(--text-dark);
            transition: all 0.2s ease;
        }
        .form-control:focus {
            background: white;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(122, 20, 20, 0.1);
            outline: none;
        }
        
        .btn-submit {
            width: 100%;
            padding: 14px;
            margin-top: 10px;
            background-color: var(--primary);
            color: white;
            font-family: var(--font-heading);
            font-size: 1.05rem;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(122, 20, 20, 0.2);
        }
        .btn-submit:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* DAFTAR USULAN (KOLOM KANAN) */
        .usulan-list-wrapper {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .usulan-item {
            padding: 16px;
            border-radius: 12px;
            border: 1px solid var(--border-light);
            background: #f8fafc;
            transition: all 0.2s ease;
        }
        .usulan-item:hover {
            background: white;
            border-color: #cbd5e1;
            box-shadow: var(--shadow-xs);
        }
        
        .usulan-title { font-size: 1.05rem; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; }
        .usulan-author { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 12px; }
        
        .usulan-meta { display: flex; justify-content: space-between; align-items: center; }
        .usulan-date { font-size: 0.8rem; color: var(--text-light); font-weight: 600; }
        
        .badge { padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
        .badge-tunggu { background: #fffbeb; color: #d97706; } /* Kuning/Warning */
        .badge-setuju { background: #eff6ff; color: #1d4ed8; } /* Biru/Info */
        .badge-sedia { background: #f0fdf4; color: #15803d; }  /* Hijau/Success */
        
        .btn-outline-primary {
            display: inline-block;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            padding: 10px 24px;
            border: 1px solid var(--primary);
            border-radius: 25px;
            transition: all 0.2s ease;
        }
        .btn-outline-primary:hover {
            background: var(--primary-soft);
        }

        /* Responsif Mobile */
        @media (max-width: 992px) {
            .layout-grid { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full-width { grid-column: span 1; }
        }
    </style>

    <div class="usulan-page-wrapper">
        
        <!-- Hero Banner Area -->
        <div class="page-hero">
            <div class="container">
                <h1 class="hero-title">SI ULAN (Sistem Informasi Usulan Buku)</h1>
                <div class="hero-breadcrumb">
                    <a href="{{ route('home') }}">Beranda</a> / Layanan / <span style="color: white; font-weight: 600;">Usulan Buku</span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="layout-grid">
                
                <!-- KOLOM KIRI: Form Input (Privasi Terjaga) -->
                <div class="modern-card">
                    <h2 class="card-header-title">Formulir Usulan Buku</h2>
                    <p class="card-header-desc">Bantu kami memperkaya koleksi perpustakaan. Buku yang Anda usulkan akan ditinjau oleh tim pengadaan kami.</p>
                    
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-grid">
                            <!-- Data Buku -->
                            <div class="form-group full-width">
                                <label class="form-label">Judul Buku *</label>
                                <input type="text" name="judul" class="form-control" placeholder="Contoh: The Psychology of Money" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Pengarang / Penulis</label>
                                <input type="text" name="pengarang" class="form-control" placeholder="Contoh: Morgan Housel">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tahun Terbitan</label>
                                <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2021">
                            </div>

                            <hr style="grid-column: span 2; border: 0; border-top: 1px dashed var(--border-color); margin: 10px 0;">

                            <!-- Data Pengusul (Rahasia/Private) -->
                            <div class="form-group">
                                <label class="form-label">Nama Pengusul *</label>
                                <input type="text" name="nama_pengusul" class="form-control" placeholder="Nama Lengkap Anda" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nomor Anggota (KTA)</label>
                                <input type="text" name="kta" class="form-control" placeholder="Masukkan Nomor KTA jika ada">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nomor WhatsApp / HP *</label>
                                <input type="tel" name="no_hp" class="form-control" placeholder="Untuk pemberitahuan status buku" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Alamat Email</label>
                                <input type="email" name="email" class="form-control" placeholder="alamat@email.com">
                            </div>

                            <div class="form-group full-width">
                                <button type="submit" class="btn-submit">Kirim Usulan Buku</button>
                            </div>
                        </div>
                        <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 15px; text-align: center;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            Data pribadi (Nama, KTA, HP, Email) dijamin kerahasiaannya dan tidak akan ditampilkan ke publik.
                        </p>
                    </form>
                </div>

                <!-- KOLOM KANAN: Live Feed Riwayat Usulan -->
                <div class="modern-card">
                    <h2 class="card-header-title">Daftar Usulan Terbaru</h2>
                    <p class="card-header-desc">Melihat buku apa saja yang sedang banyak diminta oleh masyarakat Semarang.</p>

                    <div class="usulan-list-wrapper">
                        <!-- Menggunakan array_slice untuk membatasi tampilan hanya 5 data terbaru -->
                        @foreach(array_slice($usulanList, 0, 5) as $usulan)
                            @php
                                $badgeClass = 'badge-tunggu';
                                if($usulan['status'] == 'Disetujui') $badgeClass = 'badge-setuju';
                                if($usulan['status'] == 'Tersedia') $badgeClass = 'badge-sedia';
                            @endphp

                            <div class="usulan-item">
                                <h3 class="usulan-title">{{ $usulan['judul'] }}</h3>
                                <div class="usulan-author">Oleh: {{ $usulan['pengarang'] }}</div>
                                
                                <div class="usulan-meta">
                                    <span class="usulan-date">🗓 {{ $usulan['tanggal'] }}</span>
                                    <span class="badge {{ $badgeClass }}">{{ $usulan['status'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Tombol Lihat Semua (Mengarahkan ke rute usulan.semua) -->
                    <div style="text-align: center; margin-top: 25px;">
                        <a href="{{ route('usulan.semua') }}" class="btn-outline-primary">
                            Lihat Seluruh Usulan &rarr;
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</x-layout.app>
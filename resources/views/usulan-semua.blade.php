<x-layout.app title="Daftar Seluruh Usulan Buku | Dinas Arpusda">
    
    <style>
        .usulan-page-wrapper { background-color: var(--bg-light); min-height: 100vh; padding-bottom: 80px; }
        
        /* HERO BANNER - Dibuat lebih ringkas karena ini halaman turunan */
        .page-hero-mini {
            background: linear-gradient(rgba(0, 10, 30, 0.8), rgba(0, 10, 30, 0.9)), url('{{ asset("asset/bakgron.jpg") }}') center/cover;
            padding: 40px 0;
            color: white;
            margin-bottom: 40px;
        }
        .hero-breadcrumb { font-size: 0.9rem; color: #cbd5e1; margin-bottom: 10px; }
        .hero-breadcrumb a { color: white; text-decoration: none; opacity: 0.8; transition: opacity 0.2s; }
        .hero-breadcrumb a:hover { opacity: 1; }
        .hero-title-mini { font-family: var(--font-heading); font-size: 2rem; font-weight: 800; }

        /* TABEL CONTAINER */
        .table-card {
            background: white;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }
        
        /* TABLE TOOLBAR (Search & Filter) */
        .table-toolbar {
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-light);
            flex-wrap: wrap;
            gap: 16px;
        }
        .toolbar-title { font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; color: var(--text-dark); }
        .search-box {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 16px;
            width: 300px;
        }
        .search-box svg { color: var(--text-muted); margin-right: 10px; }
        .search-box input { border: none; background: transparent; outline: none; width: 100%; font-size: 0.9rem; }

        /* MODERN DATA TABLE */
        .table-responsive { overflow-x: auto; }
        .modern-table { width: 100%; border-collapse: collapse; text-align: left; }
        .modern-table thead { background-color: #f8fafc; }
        .modern-table th {
            padding: 16px 24px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            font-weight: 700;
            border-bottom: 2px solid var(--border-light);
        }
        .modern-table td {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
            color: var(--text-dark);
            font-size: 0.95rem;
        }
        .modern-table tbody tr { transition: background-color 0.15s; }
        .modern-table tbody tr:hover { background-color: #f8fafc; }
        
        .td-judul { font-weight: 700; color: var(--text-dark); }
        .td-pengarang { color: var(--text-muted); font-size: 0.9rem; }
        .td-tanggal { color: var(--text-light); font-size: 0.85rem; font-weight: 600; }

        /* BADGES */
        .badge { padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; display: inline-block;}
        .badge-tunggu { background: #fffbeb; color: #d97706; }
        .badge-setuju { background: #eff6ff; color: #1d4ed8; }
        .badge-sedia { background: #f0fdf4; color: #15803d; }

        /* PAGINATION (Penomoran Halaman) */
        .table-pagination {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            font-size: 0.9rem;
            color: var(--text-muted);
        }
        .page-numbers { display: flex; gap: 6px; }
        .page-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1px solid var(--border-light);
            background: white;
            color: var(--text-dark);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        .page-btn:hover { background: #f1f5f9; }
        .page-btn.active { background: var(--primary); color: white; border-color: var(--primary); }

        @media (max-width: 768px) {
            .search-box { width: 100%; }
            .table-pagination { flex-direction: column; gap: 16px; }
        }
    </style>

    <div class="usulan-page-wrapper">
        
        <!-- Hero Banner Mini -->
        <div class="page-hero-mini">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('usulan.buku') }}">Usulan Buku</a> / <span style="color: white; font-weight: 600;">Semua Data</span>
                </div>
                <h1 class="hero-title-mini">Seluruh Riwayat Usulan Buku</h1>
            </div>
        </div>

        <div class="container">
            <!-- Tabel Data Modern -->
            <div class="table-card">
                
                <!-- Toolbar Area -->
                <div class="table-toolbar">
                    <div class="toolbar-title">Data Usulan Masyarakat</div>
                    <div class="search-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" placeholder="Cari judul buku atau nama pengarang...">
                    </div>
                </div>

                <!-- Table Area -->
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Pengarang / Penulis</th>
                                <th>Tanggal Usulan</th>
                                <th>Status Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usulanList as $index => $usulan)
                                @php
                                    $badgeClass = 'badge-tunggu';
                                    if($usulan['status'] == 'Disetujui') $badgeClass = 'badge-setuju';
                                    if($usulan['status'] == 'Tersedia') $badgeClass = 'badge-sedia';
                                @endphp
                                <tr>
                                    <td style="color: var(--text-light); font-weight: 600;">{{ $index + 1 }}</td>
                                    <td class="td-judul">{{ $usulan['judul'] }}</td>
                                    <td class="td-pengarang">{{ $usulan['pengarang'] }}</td>
                                    <td class="td-tanggal">{{ $usulan['tanggal'] }}</td>
                                    <td>
                                        <span class="badge {{ $badgeClass }}">{{ $usulan['status'] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Area (Statis untuk mockup UI) -->
                <div class="table-pagination">
                    <div>Menampilkan 1 hingga 10 dari 248 usulan</div>
                    <div class="page-numbers">
                        <a href="#" class="page-btn" aria-label="Sebelumnya">&laquo;</a>
                        <a href="#" class="page-btn active">1</a>
                        <a href="#" class="page-btn">2</a>
                        <a href="#" class="page-btn">3</a>
                        <span style="padding: 8px;">...</span>
                        <a href="#" class="page-btn">25</a>
                        <a href="#" class="page-btn" aria-label="Berikutnya">&raquo;</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout.app>
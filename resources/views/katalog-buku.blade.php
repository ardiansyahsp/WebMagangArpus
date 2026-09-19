<x-layout.app title="Katalog Buku (OPAC) | Dinas Arpusda">
    
    <style>
        .katalog-wrapper { background-color: var(--bg-light); min-height: 100vh; padding-bottom: 80px; }
        
        /* HERO SEARCH SECTION */
        .opac-hero {
            background: linear-gradient(rgba(122, 20, 20, 0.85), rgba(90, 14, 14, 0.95)), url('{{ asset("asset/bakgron.jpg") }}') center/cover;
            padding: 80px 0 60px;
            text-align: center;
            color: white;
        }
        .opac-title { font-family: var(--font-heading); font-size: 2.8rem; font-weight: 800; margin-bottom: 15px; }
        .opac-subtitle { font-size: 1.1rem; opacity: 0.9; margin-bottom: 40px; }
        
        /* SEARCH BAR */
        .search-container {
            max-width: 700px;
            margin: 0 auto;
            position: relative;
        }
        .search-input {
            width: 100%;
            padding: 20px 24px 20px 55px;
            font-size: 1.1rem;
            border-radius: 50px;
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            outline: none;
        }
        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }
        .search-btn {
            position: absolute;
            right: 8px;
            top: 8px;
            bottom: 8px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 40px;
            padding: 0 25px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }
        .search-btn:hover { background: var(--accent-gold); color: var(--text-dark); }

        /* FILTER KATEGORI */
        .filter-section { padding: 30px 0; border-bottom: 1px solid var(--border-light); background: white; margin-bottom: 40px; }
        .filter-scroll { display: flex; gap: 12px; overflow-x: auto; padding-bottom: 10px; }
        .filter-scroll::-webkit-scrollbar { height: 4px; }
        .filter-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .filter-pill {
            padding: 8px 20px;
            border-radius: 20px;
            border: 1px solid var(--border-light);
            background: white;
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: 0.2s;
        }
        .filter-pill.active, .filter-pill:hover { background: var(--primary-soft); color: var(--primary); border-color: var(--primary); }

        /* GRID BUKU */
        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 24px;
        }
        .book-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-light);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: 0.3s;
            display: flex;
            flex-direction: column;
        }
        .book-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-md); border-color: var(--primary); }
        
        .book-cover-placeholder {
            height: 280px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            position: relative;
        }
        .book-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .badge-sedia { background: #f0fdf4; color: #15803d; }
        .badge-pinjam { background: #fef2f2; color: #dc2626; }

        .book-info { padding: 20px; flex: 1; display: flex; flex-direction: column; }
        .book-category { font-size: 0.75rem; color: var(--primary); font-weight: 700; text-transform: uppercase; margin-bottom: 8px; }
        .book-title { font-family: var(--font-heading); font-size: 1.1rem; font-weight: 800; color: var(--text-dark); margin-bottom: 6px; line-height: 1.4; }
        .book-author { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 12px; flex: 1; }
        .book-year { font-size: 0.85rem; color: var(--text-light); font-weight: 600; }
    </style>

    <div class="katalog-wrapper">
        
        <!-- Hero Search -->
        <div class="opac-hero">
            <div class="container">
                <h1 class="opac-title">Katalog Koleksi Perpustakaan</h1>
                <p class="opac-subtitle">Jelajahi ribuan literatur, jurnal, dan karya fiksi di genggaman Anda.</p>
                
                <div class="search-container">
                    <svg class="search-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <!-- Ditambahkan ID searchInput -->
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari judul buku, penulis, atau ISBN...">
                    <button class="search-btn">Telusuri</button>
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="filter-section">
            <div class="container">
                <!-- Ditambahkan ID filterContainer dan data-filter -->
                <div class="filter-scroll" id="filterContainer">
                    <div class="filter-pill active" data-filter="all">Semua Koleksi</div>
                    <div class="filter-pill" data-filter="fiksi">Fiksi & Sastra</div>
                    <div class="filter-pill" data-filter="sejarah">Sejarah Lokal</div>
                    <div class="filter-pill" data-filter="sains">Sains & Teknologi</div>
                    <div class="filter-pill" data-filter="pengembangan diri">Pengembangan Diri</div>
                    <div class="filter-pill" data-filter="filsafat">Filsafat</div>
                </div>
            </div>
        </div>

        <!-- Book Grid -->
        <div class="container">
            <!-- Ditambahkan ID bookGrid -->
            <div class="book-grid" id="bookGrid">
                @foreach($katalogList as $buku)
                    @php
                        $badgeClass = $buku['status'] == 'Tersedia' ? 'badge-sedia' : 'badge-pinjam';
                    @endphp
                    
                    <!-- Ditambahkan Data Attributes untuk Pencarian -->
                    <a href="{{ route('katalog.detail', 'dummy-slug') }}" 
                       class="book-card" style="text-decoration: none; color: inherit;"
                       data-title="{{ strtolower($buku['judul']) }}" 
                       data-author="{{ strtolower($buku['penulis']) }}" 
                       data-category="{{ strtolower($buku['kategori']) }}">
                         
                        <!-- Nanti src gambar ini diganti dengan data gambar dari database -->
                        <div class="book-cover-placeholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                            <span class="book-badge {{ $badgeClass }}">{{ $buku['status'] }}</span>
                        </div>
                        <div class="book-info">
                            <div class="book-category">{{ $buku['kategori'] }}</div>
                            <h3 class="book-title">{{ $buku['judul'] }}</h3>
                            <div class="book-author">{{ $buku['penulis'] }}</div>
                            <div class="book-year">Terbit: {{ $buku['tahun'] }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <!-- Pesan jika buku tidak ditemukan (Sembunyi secara default) -->
            <div id="noDataMessage" style="display: none; text-align: center; padding: 50px 0; color: var(--text-muted);">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 15px; opacity: 0.5;"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <h3>Buku tidak ditemukan</h3>
                <p>Coba gunakan kata kunci atau kategori lain.</p>
            </div>
        </div>
        
    </div>

    <!-- Script Interaktif Pencarian & Filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterPills = document.querySelectorAll('.filter-pill');
            const bookCards = document.querySelectorAll('.book-card');
            const noDataMessage = document.getElementById('noDataMessage');

            let currentCategory = 'all';
            let searchQuery = '';

            // Fungsi utama untuk memfilter buku
            function filterBooks() {
                let visibleCount = 0;

                bookCards.forEach(card => {
                    const title = card.getAttribute('data-title');
                    const author = card.getAttribute('data-author');
                    const category = card.getAttribute('data-category');

                    // Cek apakah buku cocok dengan kata kunci pencarian (judul/penulis)
                    const matchesSearch = title.includes(searchQuery) || author.includes(searchQuery);
                    
                    // Cek apakah buku cocok dengan kategori yang dipilih
                    const matchesCategory = currentCategory === 'all' || category.includes(currentCategory);

                    // Tampilkan hanya jika cocok keduanya
                    if (matchesSearch && matchesCategory) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Tampilkan pesan "Tidak ditemukan" jika hasil kosong
                if (visibleCount === 0) {
                    noDataMessage.style.display = 'block';
                } else {
                    noDataMessage.style.display = 'none';
                }
            }

            // Trigger saat pengguna mengetik di kolom pencarian
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    searchQuery = e.target.value.toLowerCase();
                    filterBooks();
                });
            }

            // Trigger saat pengguna mengeklik tab kategori
            filterPills.forEach(pill => {
                pill.addEventListener('click', function(e) {
                    // Hapus class 'active' dari semua tombol, lalu tambahkan ke tombol yang diklik
                    filterPills.forEach(p => p.classList.remove('active'));
                    e.target.classList.add('active');

                    // Ambil nilai kategori dan jalankan filter
                    currentCategory = e.target.getAttribute('data-filter');
                    filterBooks();
                });
            });
            
            // Mencegah tombol "Telusuri" merefresh halaman (karena pencarian sudah real-time)
            const searchBtn = document.querySelector('.search-btn');
            if(searchBtn) {
                searchBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                });
            }
        });
    </script>
</x-layout.app>
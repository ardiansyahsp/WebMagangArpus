<x-layout.app title="Beranda | Dinas Arsip dan Perpustakaan Kota Semarang">
    <!-- ========================= HERO SECTION ========================= -->
    <x-ui.hero
        tagline="WEBSITE RESMI DINAS ARSIP & PERPUSTAKAAN KOTA SEMARANG"
        title="Inovasi Layanan Menuju"
        highlight="Arsip & Literasi Sempurna"
        description="Menyediakan keterbukaan informasi publik, kemudahan akses koleksi pustaka, serta pengelolaan arsip daerah yang modern, akurat, dan terpercaya bagi masyarakat Kota Semarang."
        :pills="$pills"
        :image="asset('asset/bakgron.jpg')"
        :stats="$stats"
    />

    <!-- ========================= ADDRESS RUNNING BAR ========================= -->
    <x-ui.address-bar />

    <!-- ========================= SIBAJA SEARCH BAR ========================= -->
    <section class="search-section-modern" aria-label="Pencarian Kamus Budaya Jawa Sibaja">
        <div class="container">
            <div class="search-form-modern">
                <div class="search-input-wrapper">
                    <svg class="search-icon icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    
                    <!-- Tag label dihapus, diganti menggunakan aria-label di dalam input -->
                    <input id="sibaja-search" type="text" aria-label="Cari istilah budaya Jawa Sibaja" placeholder="Cari istilah budaya Jawa di SIBAJA (contoh: Unggah-ungguh, Weton, Batik)..." autocomplete="off">
                    
                    <button type="button" id="mic-btn" class="mic-action-btn" aria-label="Pencarian Suara Voice Search">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                            <line x1="12" y1="19" x2="12" y2="23"></line>
                            <line x1="8" y1="23" x2="16" y2="23"></line>
                        </svg>
                    </button>
                </div>
                <!-- Async Results Dropdown -->
                <div id="sibaja-results" class="sibaja-results-box" role="region" aria-live="polite"></div>
            </div>
        </div>
    </section>

    <!-- ========================= MENU KATALOG LAYANAN ========================= -->
    <section class="menu-kami-katalog" aria-label="Katalog Layanan & Informasi">
        <div class="container">
            <div class="section-header">
                <div class="section-tagline">
                    <span class="line-accent" aria-hidden="true"></span>
                    <span>EKSPLORASI LAYANAN</span>
                </div>
                <h2 class="section-title">Menu & <span class="text-maroon">Katalog Unggulan</span></h2>
            </div>

            <!-- Tab Buttons -->
            <div class="mk-tabs-nav" role="tablist">
                <button type="button" class="mk-tab is-active" role="tab" aria-selected="true" data-target="tab-perpus">Perpustakaan</button>
                <button type="button" class="mk-tab" role="tab" aria-selected="false" data-target="tab-arsip">Kearsipan</button>
                <button type="button" class="mk-tab" role="tab" aria-selected="false" data-target="tab-digital">Layanan Digital</button>
            </div>

            <!-- Tab 1: Perpustakaan -->
            <div id="tab-perpus" class="mk-panel is-active" role="tabpanel">
                <div class="mk-grid">
                    <div class="katalog-card">
                        <div class="katalog-card__img-wrap">
                            <img src="{{ asset('asset/buku1.jpg') }}" alt="Koleksi Buku Sejarah & Sastra" class="katalog-card__img" loading="lazy">
                        </div>
                        <div class="katalog-card__body">
                            <span class="katalog-card__badge">Buku Fisik</span>
                            <h3 class="katalog-card__title">Koleksi Sejarah & Budaya Semarang</h3>
                            <p class="katalog-card__desc">Ribuan koleksi buku sejarah lokal, monografi daerah, dan sastra klasik yang siap dibaca di ruang baca umum.</p>
                            <x-ui.button href="{{ route('FAQperpus') }}" variant="outline" size="sm">Panduan Peminjaman</x-ui.button>
                        </div>
                    </div>

                    <div class="katalog-card">
                        <div class="katalog-card__img-wrap">
                            <img src="{{ asset('asset/tradisingaliyan.jpg') }}" alt="Layanan Perpustakaan Keliling" class="katalog-card__img" loading="lazy">
                        </div>
                        <div class="katalog-card__body">
                            <span class="katalog-card__badge">Mobil Pintar</span>
                            <h3 class="katalog-card__title">Armada Perpustakaan Keliling</h3>
                            <p class="katalog-card__desc">Menjangkau sekolah dasar, taman kota, dan balai RW untuk mendekatkan bahan bacaan bermutu ke masyarakat.</p>
                            <x-ui.button href="{{ route('jadwal.keliling') }}" variant="outline" size="sm">Jadwal Keliling</x-ui.button>
                        </div>
                    </div>

                    <div class="katalog-card">
                        <div class="katalog-card__img-wrap">
                            <img src="{{ asset('asset/tembalang.jpg') }}" alt="Sistem Informasi Usulan Buku" class="katalog-card__img" loading="lazy">
                        </div>
                        <div class="katalog-card__body">
                            <span class="katalog-card__badge">Layanan Interaktif</span>
                            <h3 class="katalog-card__title">SI ULAN (Usulan Buku)</h3>
                            <p class="katalog-card__desc">Bantu kami memperkaya koleksi perpustakaan dengan mengusulkan buku favorit atau referensi bacaan yang Anda butuhkan.</p>
                            <x-ui.button href="{{ route('usulan.buku') }}" variant="outline" size="sm">Usulkan Buku</x-ui.button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Kearsipan -->
            <div id="tab-arsip" class="mk-panel" role="tabpanel" hidden>
                <div class="mk-grid">
                    <div class="katalog-card">
                        <div class="katalog-card__img-wrap">
                            <img src="{{ asset('asset/arsip1.jpg') }}" alt="Peta Kolonial Semarang" class="katalog-card__img" loading="lazy">
                        </div>
                        <div class="katalog-card__body">
                            <span class="katalog-card__badge">Arsip Statis</span>
                            <h3 class="katalog-card__title">Peta & Dokumen Kolonial</h3>
                            <p class="katalog-card__desc">Penelusuran peta tata ruang kuno dan arsip citra sejarah Kota Semarang untuk kebutuhan riset akademik.</p>
                            <x-ui.button href="{{ route('arsip') }}" variant="outline" size="sm">Lihat Pameran</x-ui.button>
                        </div>
                    </div>

                    <div class="katalog-card">
                        <div class="katalog-card__img-wrap">
                            <img src="{{ asset('asset/Card Background Image.png') }}" alt="Konsultasi Kearsipan Perangkat Daerah" class="katalog-card__img" loading="lazy">
                        </div>
                        <div class="katalog-card__body">
                            <span class="katalog-card__badge">Pembinaan</span>
                            <h3 class="katalog-card__title">Pembinaan Tata Naskah Dinas</h3>
                            <p class="katalog-card__desc">Konsultasi klasifikasi arsip, jadwal retensi arsip, serta penyusutan berkas bagi instansi pemerintah kota.</p>
                            <x-ui.button href="{{ route('tupoksi') }}" variant="outline" size="sm">Tupoksi Kearsipan</x-ui.button>
                        </div>
                    </div>

                    <div class="katalog-card">
                        <div class="katalog-card__img-wrap">
                            <img src="{{ asset('asset/arpus.jpg') }}" alt="Depo Arsip Modern" class="katalog-card__img" loading="lazy">
                        </div>
                        <div class="katalog-card__body">
                            <span class="katalog-card__badge">Preservasi</span>
                            <h3 class="katalog-card__title">Penyimpanan & Alih Media</h3>
                            <p class="katalog-card__desc">Layanan digitalisasi dokumen naskah kuno dan perawatan fisik arsip bersejarah dari kerusakan lingkungan.</p>
                            <x-ui.button href="{{ route('FAQarsip') }}" variant="outline" size="sm">FAQ Kearsipan</x-ui.button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 3: Layanan Digital -->
            <div id="tab-digital" class="mk-panel" role="tabpanel" hidden>
                <div class="mk-grid">
                    <div class="katalog-card">
                        <div class="katalog-card__img-wrap">
                            <img src="{{ asset('asset/sibooky.png') }}" alt="Aplikasi SiBooky" class="katalog-card__img" style="object-fit:contain; padding:20px; background:#f8fafc;" loading="lazy">
                        </div>
                        <div class="katalog-card__body">
                            <span class="katalog-card__badge">E-Library</span>
                            <h3 class="katalog-card__title">SiBooky E-Book Reader</h3>
                            <p class="katalog-card__desc">Akses ribuan judul buku digital secara legal dan gratis dari gadget ponsel cerdas Anda kapan saja.</p>
                            <x-ui.button href="https://sibooky.semarangkota.go.id/" target="_blank" variant="primary" size="sm">Buka SiBooky</x-ui.button>
                        </div>
                    </div>

                    <div class="katalog-card">
                        <div class="katalog-card__img-wrap">
                            <img src="{{ asset('asset/selaras.png') }}" alt="Aplikasi Selaras" class="katalog-card__img" style="object-fit:contain; padding:20px; background:#f8fafc;" loading="lazy">
                        </div>
                        <div class="katalog-card__body">
                            <span class="katalog-card__badge">E-Arsip</span>
                            <h3 class="katalog-card__title">Aplikasi SELARAS</h3>
                            <p class="katalog-card__desc">Integrasi tata naskah dinas elektronik dan sistem informasi kearsipan terpadu Pemerintah Kota Semarang.</p>
                            <x-ui.button href="https://selaras.semarangkota.go.id/" target="_blank" variant="primary" size="sm">Buka SELARAS</x-ui.button>
                        </div>
                    </div>

                    <div class="katalog-card">
                        <div class="katalog-card__img-wrap">
                            <img src="{{ asset('asset/LOGO.png') }}" alt="Layanan PPID Arpusda" class="katalog-card__img" style="object-fit:contain; padding:20px; background:#f8fafc;" loading="lazy">
                        </div>
                        <div class="katalog-card__body">
                            <span class="katalog-card__badge">Keterbukaan Publik</span>
                            <h3 class="katalog-card__title">Portal PPID Pembantu</h3>
                            <p class="katalog-card__desc">Akses dokumen informasi berkala, serta merta, dan informasi setiap saat yang transparan dan akuntabel.</p>
                            <x-ui.button href="https://ppid.arpusda.semarangkota.go.id/" target="_blank" variant="primary" size="sm">Portal PPID</x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================= GELIAT & PUBLIKASI ========================= -->
    <section class="geliat-modern" aria-label="Geliat Literasi dan Berita Terbaru">
        <div class="container">
            <div class="section-header">
                <div class="section-tagline">
                    <span class="line-accent" aria-hidden="true"></span>
                    <span>AKTIVITAS & DOKUMENTASI</span>
                </div>
                <h2 class="section-title">Geliat <span class="text-maroon">Literasi & Kearsipan</span></h2>
            </div>

            <div class="news-grid">
                @foreach($geliat as $item)
                    <x-ui.news-card
                        :title="$item['title']"
                        :category="$item['category']"
                        :date="$item['date']"
                        :excerpt="$item['desc']"
                        :image="asset($item['image'])"
                        :link="route('berita')"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <!-- ========================= MODERN SERVICES OVERVIEW ========================= -->
    <section class="layanan-modern" aria-label="Layanan Utama Dinas">
        <div class="container">
            <div class="section-header">
                <div class="section-tagline">
                    <span class="line-accent" aria-hidden="true"></span>
                    <span>STANDAR PELAYANAN</span>
                </div>
                <h2 class="section-title">Fasilitas & <span class="text-maroon">Pelayanan Publik</span></h2>
            </div>

            <div class="layanan-grid">
                <div class="layanan-card">
                    <div class="layanan-icon-box" aria-hidden="true">📖</div>
                    <h3 class="layanan-title">Peminjaman Buku</h3>
                    <p class="layanan-desc">Koleksi buku fisik lengkap bebas pinjam hingga 7 hari dengan kartu anggota digital.</p>
                </div>

                <div class="layanan-card">
                    <div class="layanan-icon-box" aria-hidden="true">🏛️</div>
                    <h3 class="layanan-title">Riset Kearsipan</h3>
                    <p class="layanan-desc">Akses penelusuran naskah statis dan peta sejarah daerah untuk keperluan penelitian ilmiah.</p>
                </div>

                <div class="layanan-card">
                    <div class="layanan-icon-box" aria-hidden="true">💻</div>
                    <h3 class="layanan-title">Ruang Baca Digital</h3>
                    <p class="layanan-desc">Fasilitas komputer daring, akses e-journal, dan perpustakaan digital interaktif.</p>
                </div>

                <div class="layanan-card">
                    <div class="layanan-icon-box" aria-hidden="true">🚌</div>
                    <h3 class="layanan-title">Mobil Pintar</h3>
                    <p class="layanan-desc">Perpustakaan keliling yang hadir langsung ke sekolah dan ruang publik Kota Semarang.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================= APLIKASI DIGITAL KAMI ========================= -->
    <section class="aplikasi-modern" aria-label="Aplikasi Digital Terpadu">
        <div class="container">
            <div class="section-header">
                <div class="section-tagline">
                    <span class="line-accent" aria-hidden="true"></span>
                    <span>EKOSISTEM DIGITAL</span>
                </div>
                <h2 class="section-title">Aplikasi <span class="text-maroon">Layanan Cerdas</span></h2>
            </div>

            <div class="aplikasi-grid">
                @foreach($aplikasi as $app)
                    <div class="aplikasi-card">
                        <div class="aplikasi-logo-wrap">
                            <img src="{{ asset($app['logo']) }}" alt="{{ $app['name'] }}" class="aplikasi-logo-img" loading="lazy">
                        </div>
                        <div class="aplikasi-info">
                            <span class="pill-light" style="margin-bottom:8px;">{{ $app['badge'] }}</span>
                            <h3>{{ $app['name'] }}</h3>
                            <p>{{ $app['description'] }}</p>
                            <x-ui.button :href="$app['url']" target="_blank" variant="primary" size="sm">Akses Aplikasi</x-ui.button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ========================= FAQ PREVIEW SECTION ========================= -->
    <section class="info-section-modern" aria-label="Pertanyaan Umum Seputar Layanan">
        <div class="container">
            <div class="section-header">
                <div class="section-tagline">
                    <span class="line-accent" aria-hidden="true"></span>
                    <span>PUSAT BANTUAN</span>
                </div>
                <h2 class="section-title">Pertanyaan <span class="text-maroon">Sering Diajukan</span></h2>
            </div>

            <div class="faq-container-mod">
                @foreach($faqList as $faq)
                    <x-ui.accordion-item :number="$faq['id']" :title="$faq['question']">
                        @if(is_array($faq['answer']))
                            <ul class="faq-list">
                                @foreach($faq['answer'] as $ans)
                                    <li>{{ $ans }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ $faq['answer'] }}</p>
                        @endif
                    </x-ui.accordion-item>
                @endforeach
            </div>

            <div style="text-align:center; margin-top:30px;">
                <x-ui.button href="{{ route('FAQarsip') }}" variant="outline" size="md">Lihat Semua FAQ</x-ui.button>
            </div>
        </div>
    </section>

    <!-- ========================= MEDIA PARTNERS ========================= -->
    <section class="media-section" aria-label="Publikasi Media Partner">
        <div class="container">
            <div class="media-grid">
                @foreach($partners as $partner)
                    <a href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer" class="media-logo-item" aria-label="{{ $partner['name'] }}">
                        <img src="{{ asset($partner['logo']) }}" alt="{{ $partner['name'] }}" loading="lazy">
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-layout.app>
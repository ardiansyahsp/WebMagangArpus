<x-layout.app title="Berita & Informasi Terkini | Dinas Arpusda Kota Semarang">
    <section class="news-section" aria-label="Berita dan Artikel Terkini">
        <div class="container news-container">
            <!-- Judul Section -->
            <div class="section-header">
                <div class="gallery-tagline">
                    <span class="line-accent" aria-hidden="true"></span>
                    <span>INFORMASI & PUBLIKASI</span>
                </div>
                <h1 class="section-title">Berita <span class="text-maroon">Terbaru</span></h1>
            </div>

            <!-- Grid Kartu Berita -->
            <div class="news-grid">
                @foreach($beritaList as $berita)
                    <x-ui.news-card
                        :title="$berita['title']"
                        :category="$berita['category']"
                        :badgeClass="$berita['badge_class']"
                        :date="$berita['date']"
                        :excerpt="$berita['excerpt']"
                        :image="asset($berita['image'])"
                        :link="route('berita.detail', $berita['slug'])"
                    />
                @endforeach
            </div>
        </div>
    </section>
</x-layout.app>
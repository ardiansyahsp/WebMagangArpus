<x-layout.app title="{{ $berita['title'] }} | Dinas Arpusda Kota Semarang">
    <div class="article-detail-section" style="padding-top: 40px; padding-bottom: 80px;">
        <div class="container">
            
            <!-- Breadcrumb / Navigasi -->
            <div style="margin-bottom: 30px;">
                <a href="{{ route('berita') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.95rem;">
                    Beranda / Berita / <span style="color: var(--primary); font-weight: 600;">{{ $berita['category'] }}</span>
                </a>
            </div>

            <!-- Grid 2 Kolom -->
            <div class="detail-grid">
                
                <!-- KOLOM KIRI (70%): Konten Utama -->
                <article class="main-article">
                    <header class="article-header" style="margin-bottom: 25px;">
                        <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 15px;">
                            <span class="badge-category">{{ $berita['category'] }}</span>
                            <span class="text-date">📅 {{ $berita['date'] }}</span>
                        </div>
                        <h1 class="article-title">{{ $berita['title'] }}</h1>
                    </header>

                    <figure class="article-hero-image">
                        <img src="{{ asset($berita['image']) }}" alt="{{ $berita['title'] }}">
                    </figure>

                    <div class="article-content">
                        {!! $berita['content'] !!}
                    </div>

                    <!-- Tombol Bagikan (Share) -->
                    <div class="share-section">
                        <h4 style="font-size: 1.1rem; margin-bottom: 15px; font-family: var(--font-heading);">Bagikan Artikel Ini:</h4>
                        <div class="share-buttons">
                            
                            <!-- WhatsApp -->
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($berita['title'] . ' - Baca selengkapnya di: ' . url()->current()) }}" target="_blank" class="btn-share wa" title="Bagikan ke WhatsApp">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            </a>
                            
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn-share fb" title="Bagikan ke Facebook">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                            </a>

                            <!-- X (Twitter) -->
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita['title']) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="btn-share x" title="Bagikan ke X (Twitter)">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>

                            <!-- Instagram -->
                            <a href="https://www.instagram.com/" target="_blank" class="btn-share ig" title="Bagikan ke Instagram" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan disalin! Silakan paste link ini di Story atau Bio Instagram Anda.');">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            </a>

                            <!-- Salin Link -->
                            <button onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan berhasil disalin!');" class="btn-share copy" title="Salin Link">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                            </button>

                        </div>
                    </div>
                </article>

                <!-- KOLOM KANAN (30%): Sidebar -->
                <aside class="sidebar-section">
                    <div class="sidebar-widget">
                        <div class="widget-header">
                            <span class="line-accent"></span>
                            <h3>Baca Juga</h3>
                        </div>
                        <div class="widget-content">
                            @foreach($beritaLainnya as $item)
                                <a href="{{ route('berita.detail', $item['slug']) }}" class="mini-news-card">
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}">
                                    <div class="mini-news-info">
                                        <span class="mini-date">{{ $item['date'] }}</span>
                                        <h5 class="mini-title">{{ Str::limit($item['title'], 55) }}</h5>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>
</x-layout.app>
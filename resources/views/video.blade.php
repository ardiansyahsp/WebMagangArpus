<x-layout.app title="Media Hub | Dinas Arpusda Kota Semarang">
    <section class="video-gallery-section" aria-label="Publikasi Media Arpusda">
        <div class="container">
            <!-- Header Section -->
            <div class="section-header" style="text-align: center;">
                <div class="gallery-tagline">
                    <span class="line-accent" aria-hidden="true"></span>
                    <span>PUBLIKASI AUDIO VISUAL</span>
                </div>
                <h1 class="section-title">Media <span class="text-maroon">Arpusda</span></h1>
                <p style="color: var(--text-muted); margin-top: 10px;">Ikuti dokumentasi, kegiatan, dan informasi terbaru dari kami.</p>
            </div>

            <!-- Tombol Navigasi Media (Menggunakan class dari tabs.js) -->
            <div class="mk-tabs-nav" role="tablist" style="margin-bottom: 30px;">
                <button type="button" class="mk-tab is-active" role="tab" aria-selected="true" data-target="tab-youtube">
                    ▶ YouTube
                </button>
                <button type="button" class="mk-tab" role="tab" aria-selected="false" data-target="tab-instagram">
                    ◎ Instagram
                </button>
            </div>

            <!-- ========================= TAB 1: YOUTUBE ========================= -->
            <div id="tab-youtube" class="mk-panel is-active" role="tabpanel">
                <div class="hub-youtube-layout">
                    
                    <!-- Kiri: Video Utama (Featured Video) -->
                    <div class="hub-hero-video">
                        <span class="hub-badge">FEATURED VIDEO</span>
                        <div class="video-wrapper" style="border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-md);">
                            @if(count($videos) > 0)
                                <iframe 
                                    src="{{ $videos[0]['embed_url'] }}" 
                                    title="{{ $videos[0]['title'] }}" 
                                    allowfullscreen 
                                    loading="lazy" 
                                    style="border:none;">
                                </iframe>
                            @endif
                        </div>
                        <div class="hub-hero-info">
                            <h3>{{ $videos[0]['title'] ?? 'Video Terbaru' }}</h3>
                            <div class="hub-action-row">
                                <x-ui.button href="https://www.youtube.com/channel/UCKW_vxNCRgWO60Ny1wC_rUQ" target="_blank" variant="outline" size="sm">
                                    Kunjungi YouTube KAMI →
                                </x-ui.button>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: Daftar Video Lainnya -->
                    <div class="hub-side-playlist">
                        <div class="hub-side-header">
                            <h4>VIDEO LAINNYA</h4>
                        </div>
                        <div class="hub-playlist-scroll">
                            @foreach(array_slice($videos, 1, 3) as $video)
                                <div class="hub-playlist-item">
                                    <div class="playlist-thumb">
                                        <!-- Agar di thumbnail tidak bisa di-play langsung, kita beri div overlay transparan -->
                                        <div class="thumb-blocker"></div>
                                        <iframe src="{{ $video['embed_url'] }}" title="{{ $video['title'] }}" loading="lazy"></iframe>
                                    </div>
                                    <div class="playlist-info">
                                        <h5>{{ $video['title'] }}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            <!-- ========================= TAB 2: INSTAGRAM REELS ========================= -->
            <div id="tab-instagram" class="mk-panel" role="tabpanel" hidden>
                
                <!-- Grid 4 Postingan -->
                <div class="hub-ig-grid">
                    @foreach($instagramPosts as $post)
                        
                        @if($post['media_type'] === 'VIDEO')
                            <!-- Card Iframe khusus untuk Reels/Video -->
                            <!-- Card Iframe khusus untuk Reels/Video -->
                            <div class="ig-card reels-card" style="display: flex; flex-direction: column; overflow: hidden; height: 100%; min-height: 480px; padding: 0;">
                                <iframe 
                                    src="{{ rtrim($post['permalink'], '/') }}/embed" 
                                    width="100%" 
                                    height="100%" 
                                    frameborder="0" 
                                    scrolling="no" 
                                    allowtransparency="true"
                                    allowfullscreen="true"
                                    style="border: none; flex-grow: 1;">
                                </iframe>
                            </div>
                        @else
                            <!-- Card Tag <a> khusus untuk Foto biasa -->
                            <a href="{{ $post['permalink'] }}" target="_blank" rel="noopener noreferrer" class="ig-card reels-card" style="display: block;">
                                <img src="{{ asset($post['thumbnail_url']) }}" alt="Instagram Post" loading="lazy">
                                <div class="ig-overlay">
                                    <span>◎ Lihat Foto</span>
                                </div>
                            </a>
                        @endif

                    @endforeach
                </div>
                
                <!-- Footer Instagram -->
                <div class="hub-ig-footer-row">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #e1306c; width: 24px; height: 24px;">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                        <span class="ig-username">@dinasarpus_semarang</span>
                    </div>
                    
                    <x-ui.button href="https://www.instagram.com/dinasarpus_semarang/" target="_blank" variant="primary" size="md">
                        Ikuti Instagram Kami →
                    </x-ui.button>
                </div>

            </div>
        </div>
    </section>
</x-layout.app>
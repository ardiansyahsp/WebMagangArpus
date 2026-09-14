<x-layout.app title="Tentang Kearsipan & Perpustakaan | Dinas Arpusda Semarang">
    <section class="about-kp-section" aria-label="Profil dan Definisi Kearsipan dan Perpustakaan">
        <div class="container about-kp-container">
            <!-- Header Section -->
            <div class="section-header">
                <div class="about-kp-tagline">
                    <span class="line-accent" aria-hidden="true"></span>
                    <span>PROFIL & DEFINISI</span>
                </div>
                <h1 class="section-title">Mengenal Lebih Dekat <span class="text-maroon">Kearsipan & Perpustakaan</span></h1>
            </div>

            <!-- Grid Dua Kolom -->
            <div class="about-kp-grid">
                @foreach($tentangList as $card)
                    <div class="about-kp-card">
                        <div class="about-kp-img-wrapper">
                            <img src="{{ asset($card['image']) }}" alt="Ilustrasi {{ $card['title'] }}" class="about-kp-img" loading="lazy">
                            <div class="about-kp-badge {{ $card['badge_class'] }}">{{ $card['badge'] }}</div>
                        </div>
                        <div class="about-kp-content">
                            <h2 class="about-kp-title">{{ $card['title'] }}</h2>
                            <p class="about-kp-text">
                                {{ $card['definition'] }}
                            </p>
                            <p class="about-kp-citation">{{ $card['citation'] }}</p>
                            <p class="about-kp-text highlight-text">
                                {{ $card['highlight'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Menu Navigasi Profil Lainnya -->
            <div style="margin-top: 60px; padding-top: 30px; border-top: 1px solid var(--border-light); text-align: center;">
                <h3 style="font-family: var(--font-heading); font-size: 1.1rem; color: var(--text-dark); margin-bottom: 20px;">Jelajahi Profil Lainnya:</h3>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 12px;">
                    <x-ui.button href="{{ route('visikota') }}" variant="outline" size="sm">Visi & Misi Kota</x-ui.button>
                    <x-ui.button href="{{ route('visiarpus') }}" variant="outline" size="sm">Visi & Misi Arpusda</x-ui.button>
                    <x-ui.button href="{{ route('tupoksi') }}" variant="outline" size="sm">Tupoksi Dinas</x-ui.button>
                    <x-ui.button href="{{ route('struktur') }}" variant="outline" size="sm">Struktur Organisasi</x-ui.button>
                </div>
            </div>
        </div>
    </section>
</x-layout.app>
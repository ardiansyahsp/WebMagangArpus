<x-layout.app title="Tugas Pokok dan Fungsi | Dinas Arpusda Kota Semarang">
    <main class="tupoksi-page" aria-label="Tugas Pokok dan Fungsi">
        <div class="container">
            <!-- Header Judul -->
            <div class="section-header">
                <div class="about-kp-tagline">
                    <span class="line-accent" aria-hidden="true"></span>
                    <span>TUGAS POKOK DAN FUNGSI</span>
                </div>
                <h1 class="section-title">Tupoksi <span class="text-maroon">Dinas Arpusda</span></h1>
                <p style="color:var(--text-muted); margin-top:10px;">
                    Dalam melaksanakan tugas pokoknya, Dinas Arsip dan Perpustakaan Kota Semarang menyelenggarakan fungsi-fungsi utama sebagai berikut:
                </p>
            </div>

            <!-- Daftar Fungsi (Grid Card Modern) -->
            <div class="tupoksi-grid">
                @foreach($tupoksiList as $item)
                    <div class="tupoksi-card">
                        <div class="card-num">{{ $item['num'] }}</div>
                        <div class="card-text">
                            {{ $item['text'] }}
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Tombol Navigasi Lanjut -->
            <!-- Menu Navigasi Profil Lainnya -->
            <div style="margin-top: 60px; padding-top: 30px; border-top: 1px solid var(--border-light); text-align: center;">
                <h3 style="font-family: var(--font-heading); font-size: 1.1rem; color: var(--text-dark); margin-bottom: 20px;">Jelajahi Profil Lainnya:</h3>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 12px;">
                    <x-ui.button href="{{ route('visikota') }}" variant="outline" size="sm">Visi & Misi Kota</x-ui.button>
                    <x-ui.button href="{{ route('visiarpus') }}" variant="outline" size="sm">Visi & Misi Arpusda</x-ui.button>
                    <x-ui.button href="{{ route('struktur') }}" variant="outline" size="sm">Struktur Organisasi</x-ui.button>
                    <x-ui.button href="{{ route('tentang') }}" variant="outline" size="sm">Tentang Arpusda</x-ui.button>
                </div>
            </div>
        </div>
    </main>
</x-layout.app>
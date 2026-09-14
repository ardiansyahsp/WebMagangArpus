<x-layout.app title="Visi & Misi Kota Semarang | Dinas Arpusda">
    <section class="vm-section" aria-label="Visi Misi Kota Semarang">
        <div class="container vm-container">
            <!-- Header Halaman -->
            <div class="vm-header">
                <div class="about-kp-tagline">
                    <span class="line-accent" aria-hidden="true"></span>
                    <span>{{ $data['tagline'] }}</span>
                </div>
                <h1 class="vm-title">Visi & Misi <span class="vm-accent">Kota Semarang</span></h1>
            </div>

            <div class="vm-grid">
                <!-- Kolom Kiri: VISI & Gambar Ilustrasi -->
                <div class="vm-left">
                    <div class="vm-visi-card">
                        <div class="vm-label">VISI</div>
                        <h2 class="vm-visi-text">
                            "{{ $data['visi'] }}"
                        </h2>
                    </div>

                    <div class="vm-image-wrapper">
                        <img src="{{ asset($data['image']) }}" alt="Pemandangan Kota Semarang" class="vm-image" loading="lazy">
                    </div>
                </div>

                <!-- Kolom Kanan: MISI -->
                <div class="vm-right">
                    <div class="vm-label">MISI</div>

                    <div class="vm-misi-list">
                        @foreach($data['misi'] as $misi)
                            <div class="vm-misi-item">
                                <div class="vm-misi-number">{{ $misi['number'] }}</div>
                                <div class="vm-misi-desc">
                                    {{ $misi['desc'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Menu Navigasi Profil Lainnya -->
            <div style="margin-top: 60px; padding-top: 30px; border-top: 1px solid var(--border-light); text-align: center;">
                <h3 style="font-family: var(--font-heading); font-size: 1.1rem; color: var(--text-dark); margin-bottom: 20px;">Jelajahi Profil Lainnya:</h3>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 12px;">
                    <x-ui.button href="{{ route('visiarpus') }}" variant="outline" size="sm">Visi & Misi Arpusda</x-ui.button>
                    <x-ui.button href="{{ route('tupoksi') }}" variant="outline" size="sm">Tupoksi Dinas</x-ui.button>
                    <x-ui.button href="{{ route('struktur') }}" variant="outline" size="sm">Struktur Organisasi</x-ui.button>
                    <x-ui.button href="{{ route('tentang') }}" variant="outline" size="sm">Tentang Arpusda</x-ui.button>
                </div>
            </div>
        </div>
    </section>
</x-layout.app>
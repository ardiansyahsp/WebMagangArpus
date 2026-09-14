<x-layout.app title="FAQ Perpustakaan | Dinas Arpusda Kota Semarang">
    <main class="faq-page" aria-label="FAQ Urusan Perpustakaan">
        <div class="container">
            <!-- Header Judul -->
            <div class="faq-header">
                <span class="faq-subtitle">Pusat Bantuan & Informasi</span>
                <h1 class="faq-title">FAQ <span class="faq-accent">Urusan Perpustakaan</span></h1>
                <p class="faq-desc">
                    Temukan informasi lengkap seputar keanggotaan, koleksi buku, jam operasional perpustakaan kota dan mobil pintar.
                </p>
            </div>

            <!-- Daftar Accordion FAQ -->
            <div class="faq-container-mod">
                @foreach($faqs as $faq)
                    <x-ui.accordion-item :number="$faq['id']" :title="$faq['question']">
                        @if($faq['is_list'] && is_array($faq['answer']))
                            <ul class="faq-list">
                                @foreach($faq['answer'] as $line)
                                    <li>{{ $line }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ $faq['answer'] }}</p>
                        @endif
                    </x-ui.accordion-item>
                @endforeach
            </div>

            <!-- Tombol Navigasi Lintas FAQ -->
            <div style="text-align:center; margin-top: 40px;">
                <p style="margin-bottom: 15px; font-size: 0.95rem; color: var(--text-muted);">
                    Ingin mencari informasi seputar peminjaman dan pengelolaan arsip?
                </p>
                <x-ui.button href="{{ route('FAQarsip') }}" variant="outline" size="md">
                    Lihat FAQ Kearsipan
                </x-ui.button>
            </div>
        </div>
    </main>
</x-layout.app>
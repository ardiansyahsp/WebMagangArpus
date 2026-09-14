<x-layout.app title="FAQ Kearsipan | Dinas Arpusda Kota Semarang">
    <main class="faq-page" aria-label="FAQ Urusan Kearsipan">
        <div class="container">
            <!-- Header Judul -->
            <div class="faq-header">
                <span class="faq-subtitle">Pusat Bantuan & Informasi</span>
                <h1 class="faq-title">FAQ <span class="faq-accent">Urusan Kearsipan</span></h1>
                <p class="faq-desc">
                    Temukan informasi lengkap seputar layanan, syarat peminjaman, serta operasional gedung arsip Dinas Arsip dan Perpustakaan Kota Semarang.
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
                    Tidak menemukan jawaban yang Anda cari? Mungkin ada di bagian Perpustakaan.
                </p>
                <x-ui.button href="{{ route('FAQperpus') }}" variant="outline" size="md">
                    Lihat FAQ Perpustakaan 
                </x-ui.button>
            </div>
        </div>
    </main>
</x-layout.app>
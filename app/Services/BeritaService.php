<?php

namespace App\Services;

class BeritaService
{
    /**
     * Get news articles list.
     *
     * @return array<int, array<string, string>>
     */
    public function getBeritaList(): array
    {
        return [
            [
                'id' => '1',
                'title' => 'Optimalisasi Pengelolaan Arsip Daerah Menuju Era Digitalisasi Modern',
                'category' => 'Kearsipan',
                'badge_class' => '',
                'date' => '08 September 2026',
                'excerpt' => 'Dinas Arsip dan Perpustakaan terus meningkatkan kualitas tata naskah dinas serta penyelamatan memori kolektif daerah melalui implementasi sistem kearsipan cerdas.',
                'content' => '<p>Dinas Arsip dan Perpustakaan terus meningkatkan kualitas tata naskah dinas serta penyelamatan memori kolektif daerah melalui implementasi sistem kearsipan cerdas. Digitalisasi ini bertujuan untuk mempercepat proses temu kembali arsip dan mengamankan dokumen fisik dari kerusakan usia.</p><p>Kepala Dinas menyampaikan bahwa transformasi digital bukan sekadar memindai kertas menjadi file PDF, melainkan membangun sistem informasi manajemen yang terintegrasi dengan seluruh Organisasi Perangkat Daerah (OPD) di Kota Semarang.</p>',
                'image' => 'asset/Card Background Image.png',
                'slug' => 'optimalisasi-pengelolaan-arsip-daerah-modern',
            ],
            [
                'id' => '2',
                'title' => 'Peningkatan Minat Baca Melalui Revitalisasi Ruang Baca Digital',
                'category' => 'Perpustakaan',
                'badge_class' => 'gold-badge',
                'date' => '05 September 2026',
                'excerpt' => 'Fasilitas ruang baca digital kini hadir dengan koleksi ribuan e-book interaktif yang ramah bagi pelajar, mahasiswa, dan masyarakat umum Kota Semarang.',
                'content' => '<p>Fasilitas ruang baca digital kini hadir dengan koleksi ribuan e-book interaktif yang ramah bagi pelajar, mahasiswa, dan masyarakat umum Kota Semarang. Pengunjung dapat mengakses literatur nasional maupun internasional langsung dari gawai pintar yang disediakan di area perpustakaan.</p><p>Revitalisasi ini juga mencakup penyediaan ruang diskusi kedap suara dan area co-working space yang dilengkapi internet berkecepatan tinggi, menjadikan perpustakaan tidak hanya sebagai tempat membaca, namun juga pusat interaksi dan inovasi generasi muda.</p>',
                'image' => 'asset/bakgron.jpg',
                'slug' => 'peningkatan-minat-baca-revitalisasi-digital',
            ],
            [
                'id' => '3',
                'title' => 'Seminar Internasional Naskah Kuno dan Pelestarian Budaya Nusantara',
                'category' => 'Kegiatan',
                'badge_class' => '',
                'date' => '01 September 2026',
                'excerpt' => 'Membedah warisan leluhur bangsa melalui konservasi manuskrip kuno guna memperkuat identitas budaya serta literasi sejarah bagi generasi muda.',
                'content' => '<p>Membedah warisan leluhur bangsa melalui konservasi manuskrip kuno guna memperkuat identitas budaya serta literasi sejarah bagi generasi muda. Acara ini dihadiri oleh para filolog, sejarawan, dan akademisi dari berbagai negara di Asia Tenggara.</p><p>Fokus utama seminar ini adalah mendiskusikan metode preservasi naskah lontar dan kertas daluang menggunakan teknologi konservasi mutakhir tanpa menghilangkan nilai historis aslinya. Diharapkan generasi muda semakin peduli terhadap kekayaan literasi nenek moyang.</p>',
                'image' => 'asset/Card Background Image.png',
                'slug' => 'seminar-internasional-naskah-kuno-nusantara',
            ],
        ];
    }

    /**
     * Get geliat / trending publications for home page.
     *
     * @return array<int, array<string, string>>
     */
    public function getGeliatList(): array
    {
        return [
            [
                'id' => '1',
                'title' => 'Pemberdayaan Perpustakaan Komunitas di 16 Kecamatan',
                'category' => 'Pustaka',
                'date' => '10 September 2026',
                'desc' => 'Kolaborasi bersama penggiat literasi lokal untuk memperluas akses bahan bacaan berkualitas di pelosok kelurahan.',
                'image' => 'asset/bakgron.jpg',
            ],
            [
                'id' => '2',
                'title' => 'Digitalisasi Naskah Kuno Koleksi Abad ke-19',
                'category' => 'Preservasi',
                'date' => '07 September 2026',
                'desc' => 'Penyelamatan dokumen bernilai sejarah tinggi dengan pemindaian optik beresolusi tinggi tanpa merusak serat kertas kuno.',
                'image' => 'asset/arpus.jpg',
            ],
            [
                'id' => '3',
                'title' => 'Sosialisasi Tertib Arsip Bagi Perangkat Daerah',
                'category' => 'Tata Kelola',
                'date' => '03 September 2026',
                'desc' => 'Mewujudkan akuntabilitas birokrasi melalui kepatuhan pengelolaan arsip aktif dan inaktif yang sistematis.',
                'image' => 'asset/Card Background Image.png',
            ],
        ];
    }

    /**
     * Mengambil detail satu berita berdasarkan Slug
     *
     * @param string $slug
     * @return array<string, string>|null
     */
    public function getBeritaBySlug(string $slug): ?array
    {
        $beritaList = $this->getBeritaList();

        foreach ($beritaList as $berita) {
            if ($berita['slug'] === $slug) {
                return $berita;
            }
        }

        return null;
    }
}
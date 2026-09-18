<?php

namespace App\Services;

class BerandaService
{
    /**
     * Get statistics data for the showcase counter widget.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getStatistics(): array
    {
        return [
            [
                'target' => 8245,
                'separator' => '.',
                'decimal' => 0,
                'suffix' => '',
                'title' => 'Arsip & Dokumen',
                'description' => 'Dokumen arsip terkelola dan terdigitalisasi',
            ],
            [
                'target' => 120676,
                'separator' => '.',
                'decimal' => 0,
                'suffix' => '',
                'title' => 'Koleksi Buku',
                'description' => 'Judul buku fisik dan e-book siap baca',
            ],
            [
                'target' => 88.9,
                'separator' => '',
                'decimal' => 1,
                'suffix' => '%',
                'title' => 'Indeks Kepuasan Masyarakat',
                'description' => 'Tingkat kepuasan layanan publik Arpusda',
            ],
        ];
    }

    /**
     * Get service pills for hero section.
     *
     * @return array<int, string>
     */
    public function getHeroPills(): array
    {
        return [
            'Layanan Kearsipan',
            'Pengolahan Buku',
            'Konsultasi Arsip',
            'Wisata Edukasi',
            'Ruang Baca Digital',
        ];
    }

    /**
     * Get modern digital applications list.
     *
     * @return array<int, array<string, string>>
     */
    public function getAplikasiList(): array
    {
        return [
            [
                'name' => 'SELARAS',
                'title' => 'Sistem Informasi Kearsipan Terpadu',
                'description' => 'Layanan pengelolaan tata naskah dan arsip dinas secara elektronik terintegrasi di lingkungan Pemkot Semarang.',
                'logo' => 'asset/selaras.png',
                'url' => 'https://selaras.semarangkota.go.id/',
                'badge' => 'Kearsipan',
            ],
            [
                'name' => 'SI BOOOKY',
                'title' => 'Perpustakaan Digital Kota Semarang',
                'description' => 'Aplikasi peminjaman dan baca buku elektronik gratis dengan ribuan koleksi digital bagi masyarakat Kota Semarang.',
                'logo' => 'asset/sibooky.png',
                'url' => 'https://sibooky.semarangkota.go.id/',
                'badge' => 'Perpustakaan',
            ],
        ];
    }

    /**
     * Get partner media logos.
     *
     * @return array<int, array<string, string>>
     */
    public function getMediaPartners(): array
    {
        return [
            ['name' => 'detikcom', 'logo' => 'asset/detik.png', 'url' => 'https://news.detik.com/'],
            ['name' => 'Liputan6', 'logo' => 'asset/liputan6.png', 'url' => 'https://www.liputan6.com/'],
            ['name' => 'KOMPAS.com', 'logo' => 'asset/kompas.png', 'url' => 'https://www.kompas.com/'],
            ['name' => 'TribunJateng', 'logo' => 'asset/tribunjateng.png', 'url' => 'https://jateng.tribunnews.com/'],
            ['name' => 'SuaraMerdeka', 'logo' => 'asset/suaramerdeka.png', 'url' => 'https://www.suaramerdeka.com/'],
        ];
    }

    /**
     * Get jadwal perpustakaan keliling.
     *
     * @return array<int, array<string, string>>
     */
    public function getJadwalKeliling(): array
    {
        return [
            // --- 4 JADWAL DI HARI SENIN ---
            [
                'hari' => 'Senin', 'tanggal' => '14 September 2026', 'waktu' => '08:00 - 10:00 WIB',
                'titik' => 'SDN 01 Ngaliyan', 'wilayah' => 'Kecamatan Ngaliyan', 'status' => 'Selesai'
            ],
            [
                'hari' => 'Senin', 'tanggal' => '14 September 2026', 'waktu' => '10:30 - 12:00 WIB',
                'titik' => 'Balai RW 03 Kalipancur', 'wilayah' => 'Kecamatan Ngaliyan', 'status' => 'Selesai'
            ],
            [
                'hari' => 'Senin', 'tanggal' => '14 September 2026', 'waktu' => '13:00 - 14:30 WIB',
                'titik' => 'SMPN 16 Semarang', 'wilayah' => 'Kecamatan Ngaliyan', 'status' => 'Selesai'
            ],
            [
                'hari' => 'Senin', 'tanggal' => '14 September 2026', 'waktu' => '15:00 - 16:30 WIB',
                'titik' => 'Taman Lele Indah', 'wilayah' => 'Kecamatan Ngaliyan', 'status' => 'Selesai'
            ],
            
            // --- JADWAL HARI LAINNYA ---
            [
                'hari' => 'Rabu', 'tanggal' => '16 September 2026', 'waktu' => '09:00 - 13:00 WIB',
                'titik' => 'Balai RW 05 Tembalang', 'wilayah' => 'Kecamatan Tembalang', 'status' => 'Akan Datang'
            ],
            [
                'hari' => 'Kamis', 'tanggal' => '17 September 2026', 'waktu' => '08:30 - 12:00 WIB',
                'titik' => 'Taman Tirto Agung', 'wilayah' => 'Kecamatan Banyumanik', 'status' => 'Akan Datang'
            ],
            [
                'hari' => 'Sabtu', 'tanggal' => '19 September 2026', 'waktu' => '15:00 - 17:30 WIB',
                'titik' => 'Simpang Lima (Car Free Day)', 'wilayah' => 'Kecamatan Semarang Selatan', 'status' => 'Akan Datang'
            ],
        ];
    }
    }

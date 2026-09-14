<?php

namespace App\Services;

class ProfilService
{
    /**
     * Get Visi & Misi data for Kota Semarang.
     *
     * @return array<string, mixed>
     */
    public function getVisiMisiKota(): array
    {
        return [
            'tagline' => 'Rancangan RPJMD 2021-2026',
            'visi' => 'Terwujudnya Kota Semarang yang Semakin Hebat yang berlandaskan Pancasila, dalam Bingkai NKRI yang Ber-Bhinneka Tunggal Ika',
            'image' => 'asset/semarang.jpg',
            'misi' => [
                [
                    'number' => '01',
                    'desc' => 'Meningkatkan kualitas dan kapasitas Sumber Daya Manusia yang Unggul dan Produktif untuk mencapai kesejahteraan dan keadilan sosial.',
                ],
                [
                    'number' => '02',
                    'desc' => 'Meningkatkan potensi ekonomi lokal yang berdaya saing dan stimulasi pembangunan industri, berlandaskan riset dan inovasi berdasar prinsip demokrasi ekonomi pancasila.',
                ],
                [
                    'number' => '03',
                    'desc' => 'Menjamin kemerdekaan masyarakat menjalankan ibadah, pemenuhan hak dasar dan perlindungan kesejahteraan sosial serta hak asasi manusia bagi masyarakat secara berkeadilan.',
                ],
                [
                    'number' => '04',
                    'desc' => 'Mewujudkan infrastruktur berkualitas yang berwawasan lingkungan untuk mendukung kemajuan kota.',
                ],
                [
                    'number' => '05',
                    'desc' => 'Menjalankan reformasi birokrasi pemerintahan secara dinamis dan menyusun produk hukum yang sesuai nilai-nilai Pancasila dalam kerangka Negara Kesatuan Republik Indonesia.',
                ],
            ],
        ];
    }

    /**
     * Get Visi & Misi data for Dinas Arpusda Kota Semarang.
     *
     * @return array<string, mixed>
     */
    public function getVisiMisiArpus(): array
    {
        return [
            'tagline' => 'Rancangan RENSTRA 2021-2026',
            'visi' => 'Terwujudnya Layanan Kearsipan dan Perpustakaan yang Atraktif Dalam Mendukung Semarang Semakin Hebat',
            'image' => 'asset/arpus.jpg',
            'misi' => [
                [
                    'number' => '01',
                    'desc' => 'Meningkatkan kompetensi SDM kearsipan dan perpustakaan untuk optimalisasi pelayanan manajemen pemerintah dan masyarakat.',
                ],
                [
                    'number' => '02',
                    'desc' => 'Meningkatkan potensi serta daya saing kearsipan dan perpustakaan menuju digitalisasi layanan cerdas.',
                ],
                [
                    'number' => '03',
                    'desc' => 'Mewujudkan infrastruktur kearsipan dan perpustakaan yang berkualitas untuk mendukung kemajuan kota.',
                ],
                [
                    'number' => '04',
                    'desc' => 'Menjalankan reformasi birokrasi layanan kearsipan dan perpustakaan menuju Tata Kelola yang efektif dan efisien.',
                ],
                [
                    'number' => '05',
                    'desc' => 'Menjamin aksesibilitas layanan kearsipan dan perpustakaan bagi aparatur maupun masyarakat.',
                ],
            ],
        ];
    }

    /**
     * Get Tupoksi items.
     *
     * @return array<int, array<string, string>>
     */
    public function getTupoksi(): array
    {
        return [
            [
                'num' => '01',
                'text' => 'Perumusan kebijakan Bidang Pengelolaan dan Layanan Kearsipan, Bidang Pengembangan, Pembinaan dan Pengawasan Kearsipan, Bidang Pengembangan dan Pengolahan Bahan Perpustakaan, dan Bidang Pemberdayaan dan Layanan Perpustakaan.',
            ],
            [
                'num' => '02',
                'text' => 'Perumusan rencana strategis sesuai dengan visi misi Walikota.',
            ],
            [
                'num' => '03',
                'text' => 'Pengkoordinasian tugas-tugas dalam rangka pelaksanaan program kegiatan Bidang Pengelolaan dan Layanan Kearsipan, Bidang Pengembangan, Pembinaan dan Pengawasan Kearsipan, Bidang Pengembangan dan Pengolahan Bahan Perpustakaan, dan Bidang Pemberdayaan dan Layanan Perpustakaan.',
            ],
            [
                'num' => '04',
                'text' => 'Penyelenggaraan pembinaan kepada bawahan dalam tanggungjawabnya.',
            ],
            [
                'num' => '05',
                'text' => 'Penyelenggaraan penyusunan Sasaran Kinerja Pegawai.',
            ],
            [
                'num' => '06',
                'text' => 'Penyelenggaraan Kerja Sama Bidang Pengelolaan dan Layanan Kearsipan, Bidang Pengembangan, Pembinaan dan Pengawasan Kearsipan, Bidang Pengembangan dan Pengolahan Bahan Perpustakaan, dan Bidang Pemberdayaan dan Layanan Perpustakaan.',
            ],
            [
                'num' => '07',
                'text' => 'Penyelenggaraan kesekretariatan Dinas Arsip dan Perpustakaan.',
            ],
            [
                'num' => '08',
                'text' => 'Penyelenggaraan program dan kegiatan Bidang Pengelolaan dan Layanan Kearsipan, Bidang Pengembangan, Pembinaan dan Pengawasan Kearsipan, Bidang Pengembangan dan Pengolahan Bahan Perpustakaan, dan Bidang Pemberdayaan dan Layanan Perpustakaan.',
            ],
            [
                'num' => '09',
                'text' => 'Penyelenggaraan pemantauan, evaluasi dan pelaporan pelaksanaan tugas.',
            ],
            [
                'num' => '10',
                'text' => 'Pelaksanaan tugas kedinasan lain yang diberikan oleh Walikota sesuai dengan tugas dan fungsinya.',
            ],
        ];
    }

    /**
     * Get Struktur Organisasi data.
     *
     * @return array<string, string>
     */
    public function getStruktur(): array
    {
        return [
            'tagline' => 'Bagan Organisasi Dinas',
            'legal' => 'Peraturan Walikota Semarang Nomor 112 Tahun 2021 tentang Kedudukan, Susunan Organisasi, Tugas dan Fungsi Serta Sistem Kerja Dinas Arsip dan Perpustakaan Kota Semarang.',
            'image' => 'asset/bagan.png',
        ];
    }

    /**
     * Get Tentang definition cards.
     *
     * @return array<int, array<string, string>>
     */
    public function getTentang(): array
    {
        return [
            [
                'badge' => 'Arsip Daerah',
                'badge_class' => '',
                'image' => 'asset/bakgron.jpg',
                'title' => 'Kearsipan',
                'definition' => 'adalah hal-hal yang berkenaan dengan arsip. Arsip adalah rekaman kegiatan atau peristiwa dalam berbagai bentuk dan media sesuai dengan perkembangan teknologi informasi dan komunikasi yang dibuat dan diterima oleh lembaga negara, pemerintahan daerah, lembaga pendidikan, perusahaan, organisasi politik, organisasi kemasyarakatan, dan perseorangan dalam pelaksanaan kehidupan bermasyarakat berbangsa dan bernegara.',
                'citation' => '(UU No. 43 Tahun 2009)',
                'highlight' => 'Arsip daerah adalah lembaga kearsipan berbentuk satuan kerja perangkat daerah yang melaksanakan tugas pemerintahan di bidang kearsipan pemerintahan kota yang berkedudukan di kota.',
            ],
            [
                'badge' => 'Pustaka & Digital',
                'badge_class' => 'gold-badge',
                'image' => 'asset/Foto-perpustakaan.jpg',
                'title' => 'Perpustakaan',
                'definition' => 'adalah institusi yang mengumpulkan pengetahuan tercetak dan terekam, mengelolanya dengan cara khusus guna memenuhi kebutuhan intelektualitas para penggunanya melalui beragam cara interaksi pengetahuan.',
                'citation' => '(UU No. 43 Tahun 2007)',
                'highlight' => 'Perpustakaan modern adalah merupakan tempat untuk mengakses informasi dalam format atau bentuk apapun, apakah informasi itu disimpan dalam gedung perpustakaan tersebut atau tidak dalam gedung perpustakaan. Dalam perpustakaan modern selain kumpulan buku tercetak, sebagian buku dan koleksinya ada dalam perpustakaan digital.',
            ],
        ];
    }
}

<?php

namespace App\Services\Admin;

class AdminService
{
    /**
     * Get summary KPI statistics for main admin dashboard.
     *
     * @return array<string, mixed>
     */
    public function getDashboardStats(): array
    {
        return [
            'total_buku' => [
                'value' => '120.676',
                'raw' => 120676,
                'label' => 'Total Koleksi Buku',
                'description' => 'Buku fisik & e-book terdaftar',
                'growth' => '+4.2%',
                'trend' => 'up',
                'icon' => 'book-open',
                'color' => 'maroon',
            ],
            'total_arsip' => [
                'value' => '8.245',
                'raw' => 8245,
                'label' => 'Total Arsip Sejarah',
                'description' => 'Dokumen & foto terdigitalisasi',
                'growth' => '+12.5%',
                'trend' => 'up',
                'icon' => 'archive',
                'color' => 'gold',
            ],
            'kunjungan_web' => [
                'value' => '45.890',
                'raw' => 45890,
                'label' => 'Kunjungan Website',
                'description' => 'Trafik pengunjung bulan ini',
                'growth' => '+18.1%',
                'trend' => 'up',
                'icon' => 'globe',
                'color' => 'blue',
            ],
            'usulan_pending' => [
                'value' => '5',
                'raw' => 5,
                'label' => 'Usulan Buku Baru',
                'description' => 'Perlu validasi pustakawan',
                'growth' => 'Pending',
                'trend' => 'neutral',
                'icon' => 'file-text',
                'color' => 'amber',
            ],
            'permohonan_arsip' => [
                'value' => '3',
                'raw' => 3,
                'label' => 'Permohonan Arsip',
                'description' => 'Sedang dalam penelusuran',
                'growth' => 'Diproses',
                'trend' => 'neutral',
                'icon' => 'search',
                'color' => 'purple',
            ],
        ];
    }

    /**
     * Get system notifications / action required items.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getDashboardAlerts(): array
    {
        return [
            [
                'id' => 1,
                'type' => 'warning',
                'icon' => 'book-open',
                'title' => 'Usulan Buku Baru Perlu Ditinjau',
                'message' => 'Ada 5 Usulan Buku Baru yang perlu ditinjau oleh tim pustakawan.',
                'link' => route('admin.perpustakaan.usulan'),
                'link_text' => 'Tinjau Usulan',
                'time' => '10 menit yang lalu',
            ],
            [
                'id' => 2,
                'type' => 'info',
                'icon' => 'file-search',
                'title' => 'Permohonan Penelusuran Arsip Masuk',
                'message' => 'Ada 3 Permohonan Penelusuran Arsip yang perlu diproses oleh tim arsiparis.',
                'link' => route('admin.kearsipan.permohonan'),
                'link_text' => 'Proses Berkas',
                'time' => '35 menit yang lalu',
            ],
        ];
    }

    /**
     * Get nearest mobile library schedule for dashboard table.
     *
     * @return array<int, array<string, string>>
     */
    public function getJadwalTerdekat(): array
    {
        return [
            [
                'tanggal' => '22 Sep 2026',
                'hari' => 'Senin',
                'lokasi' => 'SDN 01 Ngaliyan, Semarang Barat',
                'jam' => '08:00 - 10:00 WIB',
                'armada' => 'Mobil Keliling 01 (H 9541 XA)',
                'status' => 'Beroperasi',
            ],
            [
                'tanggal' => '22 Sep 2026',
                'hari' => 'Senin',
                'lokasi' => 'Balai RW 03 Kalipancur, Ngaliyan',
                'jam' => '10:30 - 12:00 WIB',
                'armada' => 'Mobil Keliling 01 (H 9541 XA)',
                'status' => 'Beroperasi',
            ],
            [
                'tanggal' => '23 Sep 2026',
                'hari' => 'Selasa',
                'lokasi' => 'Taman Lele Indah, Semarang Barat',
                'jam' => '09:00 - 12:00 WIB',
                'armada' => 'Mobil Keliling 02 (H 9542 XA)',
                'status' => 'Beroperasi',
            ],
            [
                'tanggal' => '24 Sep 2026',
                'hari' => 'Rabu',
                'lokasi' => 'Balai RW 05 Tembalang',
                'jam' => '09:00 - 13:00 WIB',
                'armada' => 'Mobil Keliling 03 (H 9543 XA)',
                'status' => 'Beroperasi',
            ],
            [
                'tanggal' => '25 Sep 2026',
                'hari' => 'Kamis',
                'lokasi' => 'Taman Tirto Agung, Banyumanik',
                'jam' => '08:30 - 12:00 WIB',
                'armada' => 'Mobil Keliling 02 (H 9542 XA)',
                'status' => 'Pemeliharaan',
            ],
        ];
    }

    /**
     * Get full library catalogue (OPAC).
     *
     * @return array<int, array<string, mixed>>
     */
    public function getKatalogBuku(): array
    {
        return [
            [
                'id' => 1,
                'judul' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'Kepustakaan Populer Gramedia',
                'tahun' => '2017',
                'isbn' => '978-602-424-933-2',
                'kategori' => 'Sains',
                'status' => 'Tersedia',
                'lokasi_rak' => 'Rak A-01 (Lantai 2)',
                'no_panggil' => '909 HAR s',
                'total_eksemplar' => 3,
                'sisa_eksemplar' => 2,
                'sinopsis' => 'Menjelajah sejarah peradaban dan evolusi manusia dari zaman batu hingga revolusi kecerdasan buatan.',
            ],
            [
                'id' => 2,
                'judul' => 'Sejarah Kota Semarang: Dari Bergota Hingga Kota Modern',
                'penulis' => 'Amen Budiman',
                'penerbit' => 'Tanjung Sari',
                'tahun' => '1978',
                'isbn' => '978-979-123-456-1',
                'kategori' => 'Sejarah',
                'status' => 'Tersedia',
                'lokasi_rak' => 'Rak C-05 (Lokal Konten)',
                'no_panggil' => '959.82 BUD s',
                'total_eksemplar' => 4,
                'sisa_eksemplar' => 4,
                'sinopsis' => 'Rekam jejak komprehensif terbentuknya Semarang sejak masa Ki Ageng Pandanaran hingga era kotapraja.',
            ],
            [
                'id' => 3,
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Lentera Dipantara',
                'tahun' => '2005',
                'isbn' => '978-979-973-123-5',
                'kategori' => 'Fiksi',
                'status' => 'Dipinjam',
                'lokasi_rak' => 'Rak B-12 (Sastra)',
                'no_panggil' => '899.221 TOE b',
                'total_eksemplar' => 5,
                'sisa_eksemplar' => 0,
                'sinopsis' => 'Kisah perjuangan Minke di era kolonial Hindia Belanda dalam memperjuangkan hak dan martabat kemanusiaan.',
            ],
            [
                'id' => 4,
                'judul' => 'The Psychology of Money',
                'penulis' => 'Morgan Housel',
                'penerbit' => 'Baca',
                'tahun' => '2020',
                'isbn' => '978-602-6486-53-0',
                'kategori' => 'Teknologi',
                'status' => 'Tersedia',
                'lokasi_rak' => 'Rak D-02 (Ekonomi & Bisnis)',
                'no_panggil' => '332.024 HOU p',
                'total_eksemplar' => 2,
                'sisa_eksemplar' => 1,
                'sinopsis' => 'Pelajaran abadi mengenai kekayaan, ketamakan, dan kebahagiaan finansial pribadi.',
            ],
            [
                'id' => 5,
                'judul' => 'Atomic Habits: Perubahan Kecil yang Memberikan Hasil Luar Biasa',
                'penulis' => 'James Clear',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun' => '2019',
                'isbn' => '978-602-06-3317-6',
                'kategori' => 'Pendidikan',
                'status' => 'Tersedia',
                'lokasi_rak' => 'Rak D-04 (Pengembangan Diri)',
                'no_panggil' => '158.1 CLE a',
                'total_eksemplar' => 6,
                'sisa_eksemplar' => 3,
                'sinopsis' => 'Kerangka kerja praktis untuk membentuk kebiasaan baik dan membuang kebiasaan buruk setiap hari.',
            ],
            [
                'id' => 6,
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas Penerbit Buku',
                'tahun' => '2018',
                'isbn' => '978-602-412-518-9',
                'kategori' => 'Pendidikan',
                'status' => 'Dipinjam',
                'lokasi_rak' => 'Rak D-01 (Filsafat Populer)',
                'no_panggil' => '188 MAN f',
                'total_eksemplar' => 4,
                'sisa_eksemplar' => 0,
                'sinopsis' => 'Penerapan ajaran Stoisisme kuno untuk menghadapi kekhawatiran dan emosi negatif generasi modern.',
            ],
            [
                'id' => 7,
                'judul' => 'Laut Bercerita',
                'penulis' => 'Leila S. Chudori',
                'penerbit' => 'Kepustakaan Populer Gramedia',
                'tahun' => '2017',
                'isbn' => '978-602-424-694-5',
                'kategori' => 'Fiksi',
                'status' => 'Tersedia',
                'lokasi_rak' => 'Rak B-10 (Novel Indonesia)',
                'no_panggil' => '899.221 CHU l',
                'total_eksemplar' => 3,
                'sisa_eksemplar' => 2,
                'sinopsis' => 'Kisah para aktivis mahasiswa era Reformasi 1998 yang hilang dan keluarga yang tak pernah berhenti mencari.',
            ],
            [
                'id' => 8,
                'judul' => 'Artificial Intelligence: A Modern Approach (4th Edition)',
                'penulis' => 'Stuart Russell, Peter Norvig',
                'penerbit' => 'Pearson Education',
                'tahun' => '2021',
                'isbn' => '978-0134610993',
                'kategori' => 'Teknologi',
                'status' => 'Tersedia',
                'lokasi_rak' => 'Rak E-03 (Ilmu Komputer)',
                'no_panggil' => '006.3 RUS a',
                'total_eksemplar' => 2,
                'sisa_eksemplar' => 2,
                'sinopsis' => 'Buku standar dunia mengenai kecerdasan buatan, machine learning, robotics, dan etika AI.',
            ],
        ];
    }

    /**
     * Get SI ULAN (Sistem Usulan Buku) list.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getUsulanBuku(): array
    {
        return [
            [
                'id' => 1,
                'nama' => 'Rizky Pratama, S.Kom',
                'email' => 'rizky.pratama@gmail.com',
                'judul' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'pengarang' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'alasan' => 'Dibutuhkan sebagai referensi riset pengembangan aplikasi instansi pemerintah daerah.',
                'tanggal' => '19 Sep 2026',
                'status' => 'Menunggu Validasi',
            ],
            [
                'id' => 2,
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti.nur@student.undip.ac.id',
                'judul' => 'Metodologi Penelitian Kualitatif Kearsipan Modern',
                'pengarang' => 'Prof. Dr. Burhan Bungin',
                'penerbit' => 'Rajawali Pers',
                'alasan' => 'Bahan rujukan utama penyusunan skripsi mahasiswa program studi kearsipan.',
                'tanggal' => '18 Sep 2026',
                'status' => 'Menunggu Validasi',
            ],
            [
                'id' => 3,
                'nama' => 'Drs. Hendro Wibowo',
                'email' => 'hendro.wibowo@semarangkota.go.id',
                'judul' => 'Manajemen Arsip Statis dan Dinamis Pemerintah',
                'pengarang' => 'ANRI (Arsip Nasional RI)',
                'penerbit' => 'ANRI Press',
                'alasan' => 'Standarisasi SOP tata naskah dinas dan retensi arsip bagi pegawai OPD.',
                'tanggal' => '17 Sep 2026',
                'status' => 'Disetujui',
            ],
            [
                'id' => 4,
                'nama' => 'Maya Kartika Dewi',
                'email' => 'maya.kartika@yahoo.com',
                'judul' => 'Bumi Manusia (Edisi Hardcover Koleksi)',
                'pengarang' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Lentera Dipantara',
                'alasan' => 'Koleksi fiksi di perpustakaan sering dipinjam dan habis antreannya.',
                'tanggal' => '15 Sep 2026',
                'status' => 'Akan Dibeli',
            ],
            [
                'id' => 5,
                'nama' => 'Budi Santoso',
                'email' => 'budisantoso99@gmail.com',
                'judul' => 'The Psychology of Money',
                'pengarang' => 'Morgan Housel',
                'penerbit' => 'Baca',
                'alasan' => 'Buku pengembangan diri yang sangat banyak diminati pemuda Semarang.',
                'tanggal' => '12 Sep 2026',
                'status' => 'Tersedia',
            ],
            [
                'id' => 6,
                'nama' => 'Ahmad Fadhil',
                'email' => 'fadhil.ahmad@unnes.ac.id',
                'judul' => 'Desain Grafis Komunikasi Visual Era AI',
                'pengarang' => 'Surya Wijaya',
                'penerbit' => 'Andi Offset',
                'alasan' => 'Materi pendukung pelatihan vokasi literasi digital pemuda.',
                'tanggal' => '10 Sep 2026',
                'status' => 'Tersedia',
            ],
        ];
    }

    /**
     * Get Mobile Library Schedules with vehicle status.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getJadwalKeliling(): array
    {
        return [
            [
                'id' => 1,
                'tanggal' => '2026-09-22',
                'tanggal_formatted' => '22 September 2026',
                'jam' => '08:00 - 10:00 WIB',
                'lokasi' => 'SDN 01 Ngaliyan, Semarang Barat',
                'status_armada' => 'Beroperasi',
                'armada_nama' => 'Pusling Unit 1 (H 9541 XA)',
                'petugas' => 'Supriyanto & Dedi Kurniawan',
                'kontak' => '0812-3456-7890',
            ],
            [
                'id' => 2,
                'tanggal' => '2026-09-22',
                'tanggal_formatted' => '22 September 2026',
                'jam' => '10:30 - 12:00 WIB',
                'lokasi' => 'Balai RW 03 Kalipancur, Ngaliyan',
                'status_armada' => 'Beroperasi',
                'armada_nama' => 'Pusling Unit 1 (H 9541 XA)',
                'petugas' => 'Supriyanto & Dedi Kurniawan',
                'kontak' => '0812-3456-7890',
            ],
            [
                'id' => 3,
                'tanggal' => '2026-09-23',
                'tanggal_formatted' => '23 September 2026',
                'jam' => '09:00 - 12:00 WIB',
                'lokasi' => 'Taman Lele Indah, Semarang Barat',
                'status_armada' => 'Beroperasi',
                'armada_nama' => 'Pusling Unit 2 (H 9542 XA)',
                'petugas' => 'Bambang Irawan',
                'kontak' => '0813-8899-7711',
            ],
            [
                'id' => 4,
                'tanggal' => '2026-09-24',
                'tanggal_formatted' => '24 September 2026',
                'jam' => '09:00 - 13:00 WIB',
                'lokasi' => 'Balai RW 05 Tembalang',
                'status_armada' => 'Beroperasi',
                'armada_nama' => 'Pusling Unit 3 (H 9543 XA)',
                'petugas' => 'Agus Subekti',
                'kontak' => '0857-1122-3344',
            ],
            [
                'id' => 5,
                'tanggal' => '2026-09-25',
                'tanggal_formatted' => '25 September 2026',
                'jam' => '08:30 - 12:00 WIB',
                'lokasi' => 'Taman Tirto Agung, Banyumanik',
                'status_armada' => 'Pemeliharaan',
                'armada_nama' => 'Pusling Unit 2 (H 9542 XA)',
                'petugas' => 'Bambang Irawan (Servis Berkala)',
                'kontak' => '0813-8899-7711',
            ],
            [
                'id' => 6,
                'tanggal' => '2026-09-26',
                'tanggal_formatted' => '26 September 2026',
                'jam' => '15:00 - 17:30 WIB',
                'lokasi' => 'Simpang Lima Semarang (Car Free Day)',
                'status_armada' => 'Beroperasi',
                'armada_nama' => 'Pusling Unit 1 & 3',
                'petugas' => 'Tim Gabungan Arpusda',
                'kontak' => '024-3584077',
            ],
        ];
    }

    /**
     * Get Archive inquiry requests (Permohonan Penelusuran Arsip).
     *
     * @return array<int, array<string, mixed>>
     */
    public function getPermohonanArsip(): array
    {
        return [
            [
                'id' => 1,
                'nomor_tiket' => 'ARS-2026-0091',
                'nama' => 'Dr. Raden Mas Sudarmono',
                'institusi' => 'Fakultas Ilmu Budaya, Universitas Diponegoro',
                'judul' => 'Studi Transformasi Kawasan Pelabuhan Tanjung Emas Era Kolonial (1910 - 1945)',
                'surat_pengantar' => 'Surat_Pengantar_UNDIP_0891.pdf',
                'tanggal' => '20 Sep 2026',
                'status' => 'Diproses',
                'email' => 'sudarmono@lecturer.undip.ac.id',
                'telepon' => '0811-2233-4455',
                'catatan' => 'Memerlukan dokumen peta jalur rel kereta NIS dan foto pembangunan dermaga.',
            ],
            [
                'id' => 2,
                'nomor_tiket' => 'ARS-2026-0088',
                'nama' => 'Anisa Rahmawati, S.Ars',
                'institusi' => 'Ikatan Arsitek Indonesia (IAI) Cabang Jateng',
                'judul' => 'Dokumentasi Blueprint Gedung Cagar Budaya Kota Lama Semarang',
                'surat_pengantar' => 'Surat_Rekomendasi_IAI_2026.pdf',
                'tanggal' => '18 Sep 2026',
                'status' => 'Revisi Berkas',
                'email' => 'anisa.ars@gmail.com',
                'telepon' => '0856-7890-1234',
                'catatan' => 'Surat tugas instansi belum mencantumkan tanda tangan ketua dan cap basah.',
            ],
            [
                'id' => 3,
                'nomor_tiket' => 'ARS-2026-0085',
                'nama' => 'Farhan Maulana Hakim',
                'institusi' => 'Pusat Dokumentasi dan Informasi Sejarah Semarang',
                'judul' => 'Naskah Kuno dan Silsilah Bupati Semarang Periode 1700-1850',
                'surat_pengantar' => 'Surat_Permohonan_PDIS_044.pdf',
                'tanggal' => '16 Sep 2026',
                'status' => 'Diproses',
                'email' => 'farhan.pdis@gmail.com',
                'telepon' => '0822-4455-6677',
                'catatan' => 'Penyalinan digital naskah berhuruf pegon babad semarang.',
            ],
            [
                'id' => 4,
                'nomor_tiket' => 'ARS-2026-0079',
                'nama' => 'Prof. Katherine Miller, Ph.D',
                'institusi' => 'Leiden University - KITLV Department',
                'judul' => 'Urban Sanitation and Spatial Planning in Semarang Municipality (1920-1940)',
                'surat_pengantar' => 'Leiden_Research_Permit_2026.pdf',
                'tanggal' => '10 Sep 2026',
                'status' => 'Selesai',
                'email' => 'kmiller@hum.leidenuniv.nl',
                'telepon' => '+31 71 527 2727',
                'catatan' => 'Berkas digital telah dikirimkan via repositori terenkripsi.',
            ],
            [
                'id' => 5,
                'nomor_tiket' => 'ARS-2026-0072',
                'nama' => 'Yohanes Kristianto',
                'institusi' => 'Kompas Gramedia Heritage Section',
                'judul' => 'Fotografi Pembangunan Kanal Banjir Barat & Timur Tahun 1930',
                'surat_pengantar' => 'Surat_Tugas_Redaksi_KG_88.pdf',
                'tanggal' => '05 Sep 2026',
                'status' => 'Selesai',
                'email' => 'yohanes.k@kompas.id',
                'telepon' => '0818-0998-1122',
                'catatan' => 'Watermark resmi Arpusda disematkan pada seluruh resolusi publikasi.',
            ],
        ];
    }

    /**
     * Get Historic Archive Gallery (Galeri Arsip Sejarah).
     *
     * @return array<int, array<string, mixed>>
     */
    public function getGaleriArsip(): array
    {
        return [
            [
                'id' => 1,
                'judul' => 'Gedung NIS (Lawang Sewu) Tampak Depan',
                'tahun' => '1910',
                'era' => 'Kolonial',
                'hak_cipta' => 'Domain Publik / Koleksi ANRI & Arpusda',
                'thumbnail' => 'asset/lawang_sewu_1910.jpg',
                'kategori' => 'Foto',
                'deskripsi' => 'Foto konstruksi awal kantor pusat Nederlandsch-Indische Spoorweg Maatschappij (NIS) di Bodjongweg Semarang dengan gaya arsitektur Nieuwe Kunst.',
            ],
            [
                'id' => 2,
                'judul' => 'Gereja Blenduk & Suasana Heerenstraat Kota Lama',
                'tahun' => '1928',
                'era' => 'Kolonial',
                'hak_cipta' => 'Koleksi Dinas Arsip dan Perpustakaan Kota Semarang',
                'thumbnail' => 'asset/blenduk_1928.jpg',
                'kategori' => 'Foto',
                'deskripsi' => 'Pemandangan lanskap kawasan perdagangan Heerenstraat (kini Jl. Letjen Suprapto) dengan kubah ikonik Gereja Blenduk pasca renovasi tahun 1894.',
            ],
            [
                'id' => 3,
                'judul' => 'Rapat Raksasa Proklamasi Kemerdekaan di Alun-Alun Semarang',
                'tahun' => '1945',
                'era' => 'Kemerdekaan',
                'hak_cipta' => 'Arsip Daerah Jawa Tengah & Komando Militer',
                'thumbnail' => 'asset/proklamasi_semarang_1945.jpg',
                'kategori' => 'Foto',
                'deskripsi' => 'Antusiasme ribuan pemuda dan pejuang Semarang menyambut pengibaran sang saka merah putih dan deklarasi kemerdekaan Republik Indonesia.',
            ],
            [
                'id' => 4,
                'judul' => 'Peta Topografi & Saluran Drainase Kota Semarang (Gemente Samarang)',
                'tahun' => '1935',
                'era' => 'Kolonial',
                'hak_cipta' => 'Topografische Inrichting Batavia / Repositori Arpusda',
                'thumbnail' => 'asset/peta_semarang_1935.jpg',
                'kategori' => 'Peta',
                'deskripsi' => 'Peta kartografi resmi gemente Samarang karya Ir. Herman Thomas Karsten yang memetakan zona permukiman Candi Baru dan kawasan pelabuhan.',
            ],
            [
                'id' => 5,
                'judul' => 'Peresmian Pasar Johar Karya Arsitek Thomas Karsten',
                'tahun' => '1938',
                'era' => 'Kolonial',
                'hak_cipta' => 'Koleksi Historis Pemerintah Kota Semarang',
                'thumbnail' => 'asset/pasar_johar_1938.jpg',
                'kategori' => 'Foto',
                'deskripsi' => 'Arsitektur tiang cendawan (mushroom column) beton Pasar Johar yang pada zamannya merupakan pasar modern termegah di Asia Tenggara.',
            ],
            [
                'id' => 6,
                'judul' => 'Pembangunan Monumen Tugu Muda Semarang',
                'tahun' => '1953',
                'era' => 'Modern',
                'hak_cipta' => 'Pemerintah Kota Semarang',
                'thumbnail' => 'asset/tugumuda_1953.jpg',
                'kategori' => 'Foto',
                'deskripsi' => 'Dokumentasi peletakan batu pertama dan peresmian Monumen Tugu Muda oleh Presiden Ir. Soekarno untuk mengenang Pertempuran Lima Hari di Semarang.',
            ],
        ];
    }

    /**
     * Get Book Categories for system settings.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getKategoriBuku(): array
    {
        return [
            ['id' => 1, 'nama' => 'Sains', 'kode' => 'SCI', 'deskripsi' => 'Koleksi sains alam, biologi, fisika, dan astronomi', 'total_item' => 1420],
            ['id' => 2, 'nama' => 'Teknologi', 'kode' => 'TECH', 'deskripsi' => 'Ilmu komputer, rekayasa informatika, dan robotika', 'total_item' => 2310],
            ['id' => 3, 'nama' => 'Fiksi', 'kode' => 'FIC', 'deskripsi' => 'Novel, cerpen, puisi sastra klasik dan modern', 'total_item' => 4500],
            ['id' => 4, 'nama' => 'Pendidikan', 'kode' => 'EDU', 'deskripsi' => 'Buku pegangan ajar, pedagogi, dan pengembangan diri', 'total_item' => 3120],
            ['id' => 5, 'nama' => 'Sejarah', 'kode' => 'HIST', 'deskripsi' => 'Sejarah lokal Semarang, Indonesia, dan peradaban dunia', 'total_item' => 1890],
            ['id' => 6, 'nama' => 'Filsafat', 'kode' => 'PHIL', 'deskripsi' => 'Filsafat barat, etika, logika, dan pemikiran timur', 'total_item' => 870],
        ];
    }

    /**
     * Get Archive Categories for system settings.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getKategoriArsip(): array
    {
        return [
            ['id' => 1, 'nama' => 'Foto', 'kode' => 'FTO', 'deskripsi' => 'Foto dokumentasi sejarah, peristiwa, dan lanskap kota', 'total_item' => 3450],
            ['id' => 2, 'nama' => 'Peta', 'kode' => 'MAP', 'deskripsi' => 'Peta kartografi, tata ruang, dan jalur transportasi kuno', 'total_item' => 780],
            ['id' => 3, 'nama' => 'Dokumen', 'kode' => 'DOC', 'deskripsi' => 'Surat keputusan, staatsblad, dan arsip statis dinas', 'total_item' => 2940],
            ['id' => 4, 'nama' => 'Naskah Kuno', 'kode' => 'MSS', 'deskripsi' => 'Manuskrip aksara jawa, pegon, dan lontar bersejarah', 'total_item' => 415],
            ['id' => 5, 'nama' => 'Rekaman Suara', 'kode' => 'AUD', 'deskripsi' => 'Pidato sejarah, wawancara lisan pelaku kemerdekaan', 'total_item' => 230],
            ['id' => 6, 'nama' => 'Video Arsip', 'kode' => 'VID', 'deskripsi' => 'Rekaman film dokumenter Semarang tempo doeloe', 'total_item' => 430],
        ];
    }

    /**
     * Get Users list for user management.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getPenggunaList(): array
    {
        return [
            [
                'id' => 1,
                'nama' => 'Administrator Utama',
                'username' => 'admin',
                'email' => 'admin@arpusda.semarangkota.go.id',
                'jabatan' => 'Pranata Komputer Ahli Muda',
                'role' => 'Super Admin',
                'status' => 'Aktif',
                'terakhir_login' => 'Sedang Aktif',
                'avatar' => 'asset/LOGO.png',
            ],
            [
                'id' => 2,
                'nama' => 'Hj. Sri Wahyuni, S.Sos',
                'username' => 'sri.pustakawan',
                'email' => 'sri.wahyuni@semarangkota.go.id',
                'jabatan' => 'Pustakawan Ahli Madya',
                'role' => 'Pustakawan',
                'status' => 'Aktif',
                'terakhir_login' => '21 Sep 2026, 08:30 WIB',
                'avatar' => 'asset/LOGO.png',
            ],
            [
                'id' => 3,
                'nama' => 'Rahmat Hidayat, S.S',
                'username' => 'rahmat.arsiparis',
                'email' => 'rahmat.hidayat@semarangkota.go.id',
                'jabatan' => 'Arsiparis Ahli Pertama',
                'role' => 'Arsiparis',
                'status' => 'Aktif',
                'terakhir_login' => '20 Sep 2026, 16:15 WIB',
                'avatar' => 'asset/LOGO.png',
            ],
            [
                'id' => 4,
                'nama' => 'Dewi Anggraini, A.Md',
                'username' => 'dewi.katalog',
                'email' => 'dewi.anggraini@semarangkota.go.id',
                'jabatan' => 'Pengelola Bahan Pustaka',
                'role' => 'Pustakawan',
                'status' => 'Aktif',
                'terakhir_login' => '19 Sep 2026, 11:20 WIB',
                'avatar' => 'asset/LOGO.png',
            ],
            [
                'id' => 5,
                'nama' => 'Agus Priyono, S.Hum',
                'username' => 'agus.arsip',
                'email' => 'agus.priyono@semarangkota.go.id',
                'jabatan' => 'Pengolah Data Kearsipan',
                'role' => 'Arsiparis',
                'status' => 'Nonaktif',
                'terakhir_login' => '01 Sep 2026, 09:00 WIB',
                'avatar' => 'asset/LOGO.png',
            ],
        ];
    }

    /**
     * Get Hero Banners list for banner settings.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getBannerList(): array
    {
        return [
            [
                'id' => 1,
                'tagline' => 'WEBSITE RESMI DINAS ARSIP & PERPUSTAKAAN KOTA SEMARANG',
                'judul' => 'Inovasi Layanan Menuju Arsip & Literasi Sempurna',
                'deskripsi' => 'Menyediakan keterbukaan informasi publik, kemudahan akses koleksi pustaka, serta pengelolaan arsip daerah yang modern, akurat, dan terpercaya bagi masyarakat Kota Semarang.',
                'gambar' => 'asset/bakgron.jpg',
                'status' => 'Aktif',
                'urutan' => 1,
                'cta_text' => 'Jelajahi Layanan',
                'cta_url' => '#layanan',
            ],
            [
                'id' => 2,
                'tagline' => 'LAYANAN PERPUSTAKAAN DIGITAL KOTA SEMARANG',
                'judul' => 'SiBooky: Baca Ribuan Buku Digital Gratis Dimanapun',
                'deskripsi' => 'Akses koleksi ribuan e-book, jurnal ilmiah, dan bahan bacaan bermutu hanya dengan satu genggaman melalui aplikasi SiBooky.',
                'gambar' => 'asset/bakgron.jpg',
                'status' => 'Aktif',
                'urutan' => 2,
                'cta_text' => 'Buka SiBooky',
                'cta_url' => 'https://sibooky.semarangkota.go.id/',
            ],
            [
                'id' => 3,
                'tagline' => 'KHAZANAH SEJARAH & BUDAYA',
                'judul' => 'Pameran Daring Arsip dan Manuskrip Kuno Semarang',
                'deskripsi' => 'Telusuri jejak sejarah Kota Semarang dari era kolonial hingga kemerdekaan melalui dokumentasi otentik dan kurasi ahli kearsipan.',
                'gambar' => 'asset/bakgron.jpg',
                'status' => 'Nonaktif',
                'urutan' => 3,
                'cta_text' => 'Lihat Koleksi',
                'cta_url' => '/arsip',
            ],
        ];
    }
}

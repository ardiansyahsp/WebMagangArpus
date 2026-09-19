<?php

namespace App\Http\Controllers;

use App\Services\BerandaService;
use App\Services\BeritaService;
use App\Services\FaqService;
use App\Services\GaleriService;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function __construct(
        protected BerandaService $berandaService,
        protected BeritaService $beritaService,
        protected GaleriService $galeriService,
        protected FaqService $faqService
    ) {}

    /**
     * Display the portal landing page.
     */
    public function index(): View
    {
        $stats = $this->berandaService->getStatistics();
        $pills = $this->berandaService->getHeroPills();
        $aplikasi = $this->berandaService->getAplikasiList();
        $partners = $this->berandaService->getMediaPartners();
        $geliat = $this->beritaService->getGeliatList();
        $fotoList = array_slice($this->galeriService->getFotoList(), 0, 3);
        $videoList = array_slice($this->galeriService->getVideoList(), 0, 2);
        $arsipList = array_slice($this->galeriService->getArsipList(), 0, 3);
        $faqList = array_slice($this->faqService->getFaqArsip(), 0, 4);

        return view('welcome', compact(
            'stats',
            'pills',
            'aplikasi',
            'partners',
            'geliat',
            'fotoList',
            'videoList',
            'arsipList',
            'faqList'
        ));
    }

    /**
     * Menampilkan Halaman Jadwal Perpustakaan Keliling
     */
    public function jadwal(): View
    {
        $jadwalList = $this->berandaService->getJadwalKeliling();
        
        return view('jadwal-keliling', compact('jadwalList'));
    }

    /**
     * Menampilkan Halaman SI ULAN (Usulan Buku)
     */
    public function usulanBuku(): View
    {
        // Data sementara untuk daftar usulan (Tanpa menampilkan data pribadi KTA/Email)
        $usulanList = [
            // 5 Data Pertama (Muncul awal)
            ['judul' => 'The Psychology of Money', 'pengarang' => 'Morgan Housel', 'tanggal' => '18 Sep 2026', 'status' => 'Tersedia'],
            ['judul' => 'Ilmu Memahami Hadist Nabi', 'pengarang' => 'Zein, Ma\'shum', 'tanggal' => '17 Sep 2026', 'status' => 'Menunggu Review'],
            ['judul' => 'Buku psikologi penunjang kuliah', 'pengarang' => 'Bebas', 'tanggal' => '16 Sep 2026', 'status' => 'Menunggu Review'],
            ['judul' => 'Pulang-Pergi', 'pengarang' => 'Tere Liye', 'tanggal' => '14 Sep 2026', 'status' => 'Disetujui'],
            ['judul' => 'Mengenal Pribadi Agung Muhammad', 'pengarang' => 'Imam Al Tirmidzi', 'tanggal' => '12 Sep 2026', 'status' => 'Tersedia'],
            
            // Data Tambahan (Tersembunyi, muncul saat diklik)
            ['judul' => 'Atomic Habits', 'pengarang' => 'James Clear', 'tanggal' => '10 Sep 2026', 'status' => 'Tersedia'],
            ['judul' => 'Filosofi Teras', 'pengarang' => 'Henry Manampiring', 'tanggal' => '09 Sep 2026', 'status' => 'Disetujui'],
            ['judul' => 'Bumi Manusia', 'pengarang' => 'Pramoedya Ananta Toer', 'tanggal' => '05 Sep 2026', 'status' => 'Menunggu Review'],
            ['judul' => 'Sapiens', 'pengarang' => 'Yuval Noah Harari', 'tanggal' => '01 Sep 2026', 'status' => 'Tersedia'],
            ['judul' => 'Laut Bercerita', 'pengarang' => 'Leila S. Chudori', 'tanggal' => '28 Ags 2026', 'status' => 'Disetujui'],
        ];
        
        return view('usulan-buku', compact('usulanList'));
    }
    /**
     * Menampilkan Halaman Seluruh Usulan Buku (Tabel Full Width)
     */
    public function usulanSemua(): View
    {
        $usulanList = [
            ['judul' => 'The Psychology of Money', 'pengarang' => 'Morgan Housel', 'tanggal' => '18 Sep 2026', 'status' => 'Tersedia'],
            ['judul' => 'Ilmu Memahami Hadist Nabi', 'pengarang' => 'Zein, Ma\'shum', 'tanggal' => '17 Sep 2026', 'status' => 'Menunggu Review'],
            ['judul' => 'Buku psikologi penunjang kuliah', 'pengarang' => 'Bebas', 'tanggal' => '16 Sep 2026', 'status' => 'Menunggu Review'],
            ['judul' => 'Pulang-Pergi', 'pengarang' => 'Tere Liye', 'tanggal' => '14 Sep 2026', 'status' => 'Disetujui'],
            ['judul' => 'Mengenal Pribadi Agung Muhammad', 'pengarang' => 'Imam Al Tirmidzi', 'tanggal' => '12 Sep 2026', 'status' => 'Tersedia'],
            ['judul' => 'Atomic Habits', 'pengarang' => 'James Clear', 'tanggal' => '10 Sep 2026', 'status' => 'Tersedia'],
            ['judul' => 'Filosofi Teras', 'pengarang' => 'Henry Manampiring', 'tanggal' => '09 Sep 2026', 'status' => 'Disetujui'],
            ['judul' => 'Bumi Manusia', 'pengarang' => 'Pramoedya Ananta Toer', 'tanggal' => '05 Sep 2026', 'status' => 'Menunggu Review'],
            ['judul' => 'Sapiens', 'pengarang' => 'Yuval Noah Harari', 'tanggal' => '01 Sep 2026', 'status' => 'Tersedia'],
            ['judul' => 'Laut Bercerita', 'pengarang' => 'Leila S. Chudori', 'tanggal' => '28 Ags 2026', 'status' => 'Disetujui'],
        ];
        
        return view('usulan-semua', compact('usulanList'));
    }

    public function katalogBuku(): View
    {
        $katalogList = [
            ['judul' => 'Sejarah Kota Semarang', 'penulis' => 'Amen Budiman', 'tahun' => '1978', 'kategori' => 'Sejarah', 'status' => 'Tersedia'],
            ['judul' => 'Bumi Manusia', 'penulis' => 'Pramoedya Ananta Toer', 'tahun' => '1980', 'kategori' => 'Fiksi', 'status' => 'Dipinjam'],
            ['judul' => 'The Psychology of Money', 'penulis' => 'Morgan Housel', 'tahun' => '2020', 'kategori' => 'Pengembangan Diri', 'status' => 'Tersedia'],
            ['judul' => 'Sapiens: Riwayat Singkat Umat Manusia', 'penulis' => 'Yuval Noah Harari', 'tahun' => '2011', 'kategori' => 'Sains', 'status' => 'Tersedia'],
            ['judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'tahun' => '2005', 'kategori' => 'Fiksi', 'status' => 'Tersedia'],
            ['judul' => 'Filosofi Teras', 'penulis' => 'Henry Manampiring', 'tahun' => '2018', 'kategori' => 'Filsafat', 'status' => 'Dipinjam'],
            ['judul' => 'Atomic Habits', 'penulis' => 'James Clear', 'tahun' => '2018', 'kategori' => 'Pengembangan Diri', 'status' => 'Tersedia'],
            ['judul' => 'Laut Bercerita', 'penulis' => 'Leila S. Chudori', 'tahun' => '2017', 'kategori' => 'Fiksi', 'status' => 'Tersedia'],
        ];

        return view('katalog-buku', compact('katalogList'));
    }

    /**
     * Menampilkan Halaman Detail Buku (OPAC)
     */
    public function detailBuku($slug): View
    {
        // Dummy data detail satu buku
        $buku = [
            'judul' => 'Sapiens: Riwayat Singkat Umat Manusia',
            'penulis' => 'Yuval Noah Harari',
            'penerbit' => 'Kepustakaan Populer Gramedia (KPG)',
            'tahun_terbit' => '2011 (Edisi Terjemahan 2017)',
            'kategori' => 'Sains & Sejarah',
            'isbn' => '978-602-424-933-2',
            'halaman' => '526 Halaman',
            'bahasa' => 'Indonesia',
            'status' => 'Tersedia',
            'lokasi_rak' => 'Lantai 2 - Koleksi Pengetahuan Umum',
            'no_panggil' => '909 HAR s', // Call number (Sangat penting di perpustakaan)
            'total_eksemplar' => 3,
            'sisa_eksemplar' => 2,
            'sinopsis' => 'Seratus ribu tahun yang lalu, setidaknya ada enam spesies manusia yang tinggal di bumi. Hari ini hanya tersisa satu. Kita. Homo sapiens. Bagaimana spesies kita berhasil memenangkan pertempuran untuk mendominasi planet ini? Sapiens membahas sejarah umat manusia dari Zaman Batu hingga Abad ke-21, mengeksplorasi bagaimana biologi dan sejarah telah mendefinisikan kita dan meningkatkan pemahaman kita tentang apa artinya menjadi manusia.',
        ];

        return view('detail-buku', compact('buku'));
    }
}



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
}



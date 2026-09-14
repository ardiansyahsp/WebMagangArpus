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
}

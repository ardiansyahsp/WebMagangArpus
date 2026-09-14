<?php

namespace App\Http\Controllers;

use App\Services\BeritaService;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function __construct(
        protected BeritaService $beritaService
    ) {}

    /**
     * Display News and Publications list.
     */
    public function index(): View
    {
        $beritaList = $this->beritaService->getBeritaList();

        return view('berita', compact('beritaList'));
    }
    /**
     * Menampilkan halaman detail berita berdasarkan slug
     */
    public function show($slug): View
    {
        $berita = $this->beritaService->getBeritaBySlug($slug);

        if (!$berita) {
            abort(404, 'Berita tidak ditemukan.');
        }

        // Ambil 3 berita lain untuk sidebar (kecuali berita yang sedang dibaca)
        $semuaBerita = collect($this->beritaService->getBeritaList());
        $beritaLainnya = $semuaBerita->where('slug', '!=', $slug)->take(3);

        return view('berita-detail', compact('berita', 'beritaLainnya'));
    }
}

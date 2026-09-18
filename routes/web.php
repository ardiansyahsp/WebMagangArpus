<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Dinas Arsip dan Perpustakaan Kota Semarang
|--------------------------------------------------------------------------
*/

// Beranda / Landing Page
Route::get('/', [BerandaController::class, 'index'])->name('home');
Route::get('/welcome', [BerandaController::class, 'index'])->name('dashboard');

// Jadwal Keliling
Route::get('/jadwal-keliling', [BerandaController::class, 'jadwal'])->name('jadwal.keliling');
Route::get('/usulan-buku', [BerandaController::class, 'usulanBuku'])->name('usulan.buku');
Route::get('/usulan-buku/semua', [BerandaController::class, 'usulanSemua'])->name('usulan.semua');

// Profil Dinas
Route::controller(ProfilController::class)->group(function () {
    Route::get('/visikota', 'visiKota')->name('visikota');
    Route::get('/visiarpus', 'visiArpus')->name('visiarpus');
    Route::get('/tupoksi', 'tupoksi')->name('tupoksi');
    Route::get('/struktur', 'struktur')->name('struktur');
    Route::get('/tentang', 'tentang')->name('tentang');
});

// FAQ (Frequently Asked Questions)
Route::controller(FaqController::class)->group(function () {
    Route::get('/FAQarsip', 'arsip')->name('FAQarsip');
    Route::get('/FAQperpus', 'perpus')->name('FAQperpus');
});

// Galeri & Koleksi Arsip
Route::controller(GaleriController::class)->group(function () {
    Route::get('/foto', 'foto')->name('foto');
    Route::get('/video', 'video')->name('video');
    Route::get('/arsip', 'arsip')->name('arsip');
});

// Berita & Publikasi
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');

Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.detail');

// Kontak & Pengaduan
Route::controller(KontakController::class)->group(function () {
    Route::get('/kontak', 'index')->name('kontak');
    Route::post('/kontak', 'submit')->name('kontak.submit');
});

// API / Async Search Endpoint
Route::get('/api/sibaja/search', [PencarianController::class, 'searchSibaja'])->name('api.sibaja.search');

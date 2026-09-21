<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KearsipanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PerpustakaanController;
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

Route::get('/katalog-buku', [BerandaController::class, 'katalogBuku'])->name('katalog.buku');
Route::get('/katalog-buku/{slug}', [BerandaController::class, 'detailBuku'])->name('katalog.detail');
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

/*
|--------------------------------------------------------------------------
| Admin Authentication & CMS Dashboard Routes
|--------------------------------------------------------------------------
*/

// Admin Guest Routes (Login & Auth Processing)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'submitLogin'])->name('admin.login.submit');
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes (Requires dummy session via admin.auth middleware)
    Route::middleware('admin.auth')->group(function () {
        // Dashboard Utama
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        // Modul Manajemen Perpustakaan
        Route::prefix('perpustakaan')->name('admin.perpustakaan.')->group(function () {
            // 1. Katalog Buku (OPAC)
            Route::get('/buku', [PerpustakaanController::class, 'buku'])->name('buku');
            Route::post('/buku', [PerpustakaanController::class, 'storeBuku'])->name('buku.store');
            Route::put('/buku/{id}', [PerpustakaanController::class, 'updateBuku'])->name('buku.update');
            Route::delete('/buku/{id}', [PerpustakaanController::class, 'destroyBuku'])->name('buku.destroy');

            // 2. SI ULAN (Usulan Buku)
            Route::get('/usulan', [PerpustakaanController::class, 'usulan'])->name('usulan');
            Route::post('/usulan/{id}/status', [PerpustakaanController::class, 'updateStatusUsulan'])->name('usulan.status');

            // 3. Jadwal Perpustakaan Keliling
            Route::get('/jadwal-keliling', [PerpustakaanController::class, 'jadwal'])->name('jadwal');
            Route::post('/jadwal-keliling', [PerpustakaanController::class, 'storeJadwal'])->name('jadwal.store');
            Route::put('/jadwal-keliling/{id}', [PerpustakaanController::class, 'updateJadwal'])->name('jadwal.update');
            Route::delete('/jadwal-keliling/{id}', [PerpustakaanController::class, 'destroyJadwal'])->name('jadwal.destroy');
        });

        // Modul Manajemen Kearsipan
        Route::prefix('kearsipan')->name('admin.kearsipan.')->group(function () {
            // 1. Permohonan Penelusuran Arsip
            Route::get('/permohonan', [KearsipanController::class, 'permohonan'])->name('permohonan');
            Route::post('/permohonan/{id}/status', [KearsipanController::class, 'updateStatusPermohonan'])->name('permohonan.status');

            // 2. Galeri Arsip Sejarah
            Route::get('/galeri', [KearsipanController::class, 'galeri'])->name('galeri');
            Route::post('/galeri', [KearsipanController::class, 'storeGaleri'])->name('galeri.store');
            Route::put('/galeri/{id}', [KearsipanController::class, 'updateGaleri'])->name('galeri.update');
            Route::delete('/galeri/{id}', [KearsipanController::class, 'destroyGaleri'])->name('galeri.destroy');
        });

        // Modul Pengaturan Sistem
        Route::prefix('pengaturan')->name('admin.pengaturan.')->group(function () {
            // 1. Manajemen Kategori
            Route::get('/kategori', [PengaturanController::class, 'kategori'])->name('kategori');
            Route::post('/kategori', [PengaturanController::class, 'storeKategori'])->name('kategori.store');
            Route::put('/kategori/{id}', [PengaturanController::class, 'updateKategori'])->name('kategori.update');
            Route::delete('/kategori/{id}', [PengaturanController::class, 'destroyKategori'])->name('kategori.destroy');

            // 2. Manajemen Pengguna
            Route::get('/pengguna', [PengaturanController::class, 'pengguna'])->name('pengguna');
            Route::post('/pengguna', [PengaturanController::class, 'storePengguna'])->name('pengguna.store');
            Route::put('/pengguna/{id}', [PengaturanController::class, 'updatePengguna'])->name('pengguna.update');
            Route::delete('/pengguna/{id}', [PengaturanController::class, 'destroyPengguna'])->name('pengguna.destroy');

            // 3. Manajemen Banner Utama
            Route::get('/banner', [PengaturanController::class, 'banner'])->name('banner');
            Route::post('/banner', [PengaturanController::class, 'storeBanner'])->name('banner.store');
            Route::put('/banner/{id}', [PengaturanController::class, 'updateBanner'])->name('banner.update');
            Route::post('/banner/{id}/toggle', [PengaturanController::class, 'toggleBannerStatus'])->name('banner.toggle');
        });
    });
});

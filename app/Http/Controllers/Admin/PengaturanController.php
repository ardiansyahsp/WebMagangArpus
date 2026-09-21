<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengaturanController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {}

    /**
     * Display Category Management page.
     */
    public function kategori(): View
    {
        $kategoriBuku = $this->adminService->getKategoriBuku();
        $kategoriArsip = $this->adminService->getKategoriArsip();

        return view('admin.pengaturan.kategori', compact('kategoriBuku', 'kategoriArsip'));
    }

    /**
     * Store new category simulation.
     */
    public function storeKategori(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'tipe' => 'required|in:buku,arsip',
            'deskripsi' => 'nullable|string',
        ]);

        return redirect()->route('admin.pengaturan.kategori')
            ->with('success', 'Kategori "'.e($request->input('nama')).'" berhasil ditambahkan!');
    }

    /**
     * Update category simulation.
     */
    public function updateKategori(Request $request, int $id): RedirectResponse
    {
        return redirect()->route('admin.pengaturan.kategori')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Delete category simulation.
     */
    public function destroyKategori(int $id): RedirectResponse
    {
        return redirect()->route('admin.pengaturan.kategori')
            ->with('success', 'Kategori telah berhasil dihapus.');
    }

    /**
     * Display User Management page.
     */
    public function pengguna(): View
    {
        $penggunaList = $this->adminService->getPenggunaList();

        return view('admin.pengaturan.pengguna', compact('penggunaList'));
    }

    /**
     * Store new user simulation.
     */
    public function storePengguna(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'jabatan' => 'required|string|max:255',
            'role' => 'required|in:Super Admin,Pustakawan,Arsiparis',
        ]);

        return redirect()->route('admin.pengaturan.pengguna')
            ->with('success', 'Pengguna baru "'.e($request->input('nama')).'" ('.e($request->input('role')).') berhasil didaftarkan!');
    }

    /**
     * Update user simulation.
     */
    public function updatePengguna(Request $request, int $id): RedirectResponse
    {
        return redirect()->route('admin.pengaturan.pengguna')
            ->with('success', 'Data akun pegawai berhasil diperbarui!');
    }

    /**
     * Delete user simulation.
     */
    public function destroyPengguna(int $id): RedirectResponse
    {
        return redirect()->route('admin.pengaturan.pengguna')
            ->with('success', 'Akun pengguna telah berhasil dinonaktifkan.');
    }

    /**
     * Display Main Banner & Hero settings page.
     */
    public function banner(): View
    {
        $bannerList = $this->adminService->getBannerList();

        return view('admin.pengaturan.banner', compact('bannerList'));
    }

    /**
     * Store/upload new banner simulation.
     */
    public function storeBanner(Request $request): RedirectResponse
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        return redirect()->route('admin.pengaturan.banner')
            ->with('success', 'Banner promosi baru berhasil dipublikasikan!');
    }

    /**
     * Update banner simulation.
     */
    public function updateBanner(Request $request, int $id): RedirectResponse
    {
        return redirect()->route('admin.pengaturan.banner')
            ->with('success', 'Pengaturan hero banner berhasil disimpan!');
    }

    /**
     * Toggle banner active status simulation.
     */
    public function toggleBannerStatus(int $id): RedirectResponse
    {
        return redirect()->route('admin.pengaturan.banner')
            ->with('success', 'Status visibilitas banner berhasil diubah.');
    }
}

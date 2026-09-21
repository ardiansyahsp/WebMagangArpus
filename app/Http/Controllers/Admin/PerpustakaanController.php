<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PerpustakaanController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {}

    /**
     * Display the Book Catalogue (OPAC) management page.
     */
    public function buku(Request $request): View
    {
        $bukuList = $this->adminService->getKatalogBuku();
        $kategoriList = $this->adminService->getKategoriBuku();

        // Filter pencarian opsional
        if ($search = $request->query('q')) {
            $bukuList = array_filter($bukuList, function ($item) use ($search) {
                return str_contains(strtolower($item['judul']), strtolower($search))
                    || str_contains(strtolower($item['penulis']), strtolower($search))
                    || str_contains(strtolower($item['isbn']), strtolower($search))
                    || str_contains(strtolower($item['kategori']), strtolower($search));
            });
        }

        if ($kategori = $request->query('kategori')) {
            $bukuList = array_filter($bukuList, function ($item) use ($kategori) {
                return strtolower($item['kategori']) === strtolower($kategori);
            });
        }

        return view('admin.perpustakaan.buku', compact('bukuList', 'kategoriList'));
    }

    /**
     * Store a newly created book in dummy storage.
     */
    public function storeBuku(Request $request): RedirectResponse
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|numeric',
            'isbn' => 'required|string',
            'kategori' => 'required|string',
            'lokasi_rak' => 'required|string',
        ]);

        return redirect()->route('admin.perpustakaan.buku')
            ->with('success', 'Buku "'.e($request->input('judul')).'" berhasil ditambahkan ke katalog OPAC!');
    }

    /**
     * Update an existing book in dummy storage.
     */
    public function updateBuku(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'kategori' => 'required|string',
        ]);

        return redirect()->route('admin.perpustakaan.buku')
            ->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Remove a book from dummy storage.
     */
    public function destroyBuku(int $id): RedirectResponse
    {
        return redirect()->route('admin.perpustakaan.buku')
            ->with('success', 'Buku telah berhasil dihapus dari katalog.');
    }

    /**
     * Display SI ULAN (Sistem Usulan Buku) page.
     */
    public function usulan(Request $request): View
    {
        $usulanList = $this->adminService->getUsulanBuku();

        if ($status = $request->query('status')) {
            $usulanList = array_filter($usulanList, function ($item) use ($status) {
                return strtolower($item['status']) === strtolower($status);
            });
        }

        return view('admin.perpustakaan.usulan', compact('usulanList'));
    }

    /**
     * Update proposal status in dummy storage.
     */
    public function updateStatusUsulan(Request $request, int $id): RedirectResponse
    {
        $status = $request->input('status', 'Disetujui');

        return redirect()->route('admin.perpustakaan.usulan')
            ->with('success', 'Status usulan buku berhasil diubah menjadi: '.$status);
    }

    /**
     * Display Mobile Library Schedule management page.
     */
    public function jadwal(): View
    {
        $jadwalList = $this->adminService->getJadwalKeliling();

        return view('admin.perpustakaan.jadwal', compact('jadwalList'));
    }

    /**
     * Store mobile library schedule in dummy storage.
     */
    public function storeJadwal(Request $request): RedirectResponse
    {
        $request->validate([
            'tanggal' => 'required|string',
            'jam' => 'required|string',
            'lokasi' => 'required|string',
            'status_armada' => 'required|string',
        ]);

        return redirect()->route('admin.perpustakaan.jadwal')
            ->with('success', 'Jadwal perpustakaan keliling baru berhasil dijadwalkan!');
    }

    /**
     * Update mobile library schedule in dummy storage.
     */
    public function updateJadwal(Request $request, int $id): RedirectResponse
    {
        return redirect()->route('admin.perpustakaan.jadwal')
            ->with('success', 'Jadwal perpustakaan keliling berhasil diperbarui!');
    }

    /**
     * Delete mobile library schedule in dummy storage.
     */
    public function destroyJadwal(int $id): RedirectResponse
    {
        return redirect()->route('admin.perpustakaan.jadwal')
            ->with('success', 'Jadwal telah berhasil dihapus.');
    }
}

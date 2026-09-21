<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KearsipanController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {}

    /**
     * Display Archive Research Inquiries (Permohonan Penelusuran Arsip).
     */
    public function permohonan(Request $request): View
    {
        $permohonanList = $this->adminService->getPermohonanArsip();

        if ($status = $request->query('status')) {
            $permohonanList = array_filter($permohonanList, function ($item) use ($status) {
                return strtolower($item['status']) === strtolower($status);
            });
        }

        return view('admin.kearsipan.permohonan', compact('permohonanList'));
    }

    /**
     * Update archive request status simulation.
     */
    public function updateStatusPermohonan(Request $request, int $id): RedirectResponse
    {
        $status = $request->input('status', 'Selesai');

        return redirect()->route('admin.kearsipan.permohonan')
            ->with('success', 'Status permohonan arsip #'.$id.' berhasil diubah menjadi: '.$status);
    }

    /**
     * Display Historical Archive Gallery (Galeri Arsip Sejarah).
     */
    public function galeri(Request $request): View
    {
        $galeriList = $this->adminService->getGaleriArsip();
        $kategoriList = $this->adminService->getKategoriArsip();

        if ($era = $request->query('era')) {
            $galeriList = array_filter($galeriList, function ($item) use ($era) {
                return strtolower($item['era']) === strtolower($era);
            });
        }

        if ($search = $request->query('q')) {
            $galeriList = array_filter($galeriList, function ($item) use ($search) {
                return str_contains(strtolower($item['judul']), strtolower($search))
                    || str_contains(strtolower($item['deskripsi']), strtolower($search));
            });
        }

        return view('admin.kearsipan.galeri', compact('galeriList', 'kategoriList'));
    }

    /**
     * Store new historical archive item simulation.
     */
    public function storeGaleri(Request $request): RedirectResponse
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|string',
            'era' => 'required|string',
            'hak_cipta' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        return redirect()->route('admin.kearsipan.galeri')
            ->with('success', 'Dokumen arsip sejarah "'.e($request->input('judul')).'" berhasil ditambahkan ke khazanah galeri!');
    }

    /**
     * Update historical archive item simulation.
     */
    public function updateGaleri(Request $request, int $id): RedirectResponse
    {
        return redirect()->route('admin.kearsipan.galeri')
            ->with('success', 'Informasi arsip sejarah berhasil diperbarui!');
    }

    /**
     * Delete historical archive item simulation.
     */
    public function destroyGaleri(int $id): RedirectResponse
    {
        return redirect()->route('admin.kearsipan.galeri')
            ->with('success', 'Arsip sejarah telah berhasil dihapus dari galeri.');
    }
}

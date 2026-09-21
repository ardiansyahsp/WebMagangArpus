<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {}

    /**
     * Display the main Admin Dashboard overview.
     */
    public function index(): View
    {
        $stats = $this->adminService->getDashboardStats();
        $alerts = $this->adminService->getDashboardAlerts();
        $jadwalList = $this->adminService->getJadwalTerdekat();
        $usulanRecent = array_slice($this->adminService->getUsulanBuku(), 0, 4);
        $permohonanRecent = array_slice($this->adminService->getPermohonanArsip(), 0, 3);
        $katalogRecent = array_slice($this->adminService->getKatalogBuku(), 0, 4);

        return view('admin.dashboard.index', compact(
            'stats',
            'alerts',
            'jadwalList',
            'usulanRecent',
            'permohonanRecent',
            'katalogRecent'
        ));
    }
}

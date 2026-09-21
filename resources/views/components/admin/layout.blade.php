@props([
    'title' => 'Dashboard CMS Admin | Dinas Arsip dan Perpustakaan Kota Semarang'
])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $title }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('asset/LOGO.png') }}">

    <!-- Google Fonts Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800;900&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite CSS & JS -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    <!-- Lucide Icons Script -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @stack('styles')
</head>
<body class="admin-body">
    <!-- Main Admin Layout Wrapper -->
    <div class="admin-wrapper">
        <!-- Sidebar Navigation -->
        <x-admin.sidebar />

        <!-- Mobile Sidebar Overlay Backdrop -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Workspace Area -->
        <div class="admin-main">
            <!-- Topbar Header -->
            <x-admin.topbar />

            <!-- Page Content Area -->
            <main class="admin-content" id="adminMainContent">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Global Toast Alert Container -->
    <x-admin.toast />

    <!-- Simulated Document / PDF Viewer Modal -->
    <x-admin.modal id="pdfPreviewModal" title="Pratinjau Dokumen Berkas" size="lg">
        <div style="text-align: center; padding: 20px;">
            <div style="width: 72px; height: 72px; border-radius: 50%; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
            <h4 style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; color: var(--text-dark); margin-bottom: 6px;" id="pdfPreviewTitle">
                Pratinjau Dokumen
            </h4>
            <p style="font-size: 0.84rem; color: var(--text-muted); max-width: 480px; margin: 0 auto 20px;">
                Dokumen digital resmi kearsipan Pemerintah Kota Semarang telah terverifikasi dengan tanda tangan elektronik (TTE).
            </p>

            <div style="background: var(--bg-admin); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 30px 20px; font-family: monospace; font-size: 0.85rem; color: var(--text-body); text-align: left; max-height: 240px; overflow-y: auto;">
                <div style="text-align: center; border-bottom: 2px solid var(--border-color); padding-bottom: 12px; margin-bottom: 16px;">
                    <strong>PEMERINTAH KOTA SEMARANG</strong><br>
                    <strong>DINAS ARSIP DAN PERPUSTAKAAN</strong><br>
                    <span style="font-size: 0.75rem;">Jl. Pemuda No. 148, Kota Semarang, Jawa Tengah 50132</span>
                </div>
                <p><strong>HAL:</strong> SURAT PENGANTAR PENELITIAN KEARSIPAN DAERAH</p>
                <p><strong>STATUS DOKUMEN:</strong> <span style="color: var(--success); font-weight: bold;">VALID & TERVERIFIKASI</span></p>
                <p style="margin-top: 10px;">Dengan ini menerangkan bahwa pemohon telah mengajukan izin penelusuran naskah kuno/dokumen sejarah untuk kepentingan studi akademis sesuai dengan Perda Kearsipan Kota Semarang.</p>
            </div>
        </div>

        <x-slot:footer>
            <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Tutup Pratinjau</button>
            <button type="button" class="admin-btn admin-btn--primary" onclick="window.showToast('Mengunduh dokumen PDF resmi...', 'success'); closeAdminModal('pdfPreviewModal');">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                <span>Unduh Berkas PDF</span>
            </button>
        </x-slot:footer>
    </x-admin.modal>

    <script>
        // Render Lucide icons on load
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>

    @stack('scripts')
</body>
</html>

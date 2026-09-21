@props([
    'title' => 'Dashboard CMS Admin | Dinas Arsip dan Perpustakaan Kota Semarang'
])
<!DOCTYPE html>
<html lang="id" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $title }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('asset/LOGO.png') }}">

    <!-- Google Fonts Preconnect: Inter (Primary) & Poppins (Fallback/Brand) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Theme State Anti-Flicker Script -->
    <script>
        (function() {
            try {
                const theme = localStorage.getItem('arpus_admin_theme') || 'light';
                if (theme === 'dark') {
                    document.documentElement.setAttribute('data-theme', 'dark');
                } else {
                    document.documentElement.removeAttribute('data-theme');
                }
            } catch (e) {}
        })();
    </script>

    <!-- Vite CSS & JS Assets -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    <!-- Lucide Icons Script -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @stack('styles')
</head>
<body class="admin-body">
    <!-- Ambient Background Lighting Mesh (Subtle Linear/Vercel Glow) -->
    <div class="ambient-glow" aria-hidden="true"></div>

    <!-- Main Admin Layout Wrapper -->
    <div class="admin-wrapper">
        <!-- Sidebar Navigation (Linear Style) -->
        <x-admin.sidebar />

        <!-- Mobile Sidebar Overlay Backdrop -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Workspace Area -->
        <div class="admin-main">
            <!-- Topbar Header (Stripe Glassmorphism) -->
            <x-admin.topbar />

            <!-- Page Content Area with Staggered Fade-Up -->
            <main class="admin-content" id="adminMainContent">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Global Toast Alert Container -->
    <x-admin.toast />

    <!-- Simulated Document / PDF Viewer Modal (Glassmorphic) -->
    <x-admin.modal id="pdfPreviewModal" title="Pratinjau Dokumen Berkas" size="lg">
        <div style="text-align: center; padding: 10px 0 20px;">
            <div style="width: 76px; height: 76px; border-radius: 20px; background: linear-gradient(135deg, rgba(161, 18, 18, 0.1), rgba(244, 180, 0, 0.15)); border: 1px solid rgba(161, 18, 18, 0.2); color: var(--primary); display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; box-shadow: 0 10px 30px rgba(161, 18, 18, 0.1);">
                <i data-lucide="file-check-2" style="width: 36px; height: 36px;"></i>
            </div>
            <h4 style="font-family: var(--font-heading); font-size: 1.15rem; font-weight: 800; color: var(--text-dark); margin-bottom: 6px;" id="pdfPreviewTitle">
                Pratinjau Dokumen Kearsipan
            </h4>
            <p style="font-size: 0.85rem; color: var(--text-muted); max-width: 460px; margin: 0 auto 24px;">
                Dokumen digital resmi kearsipan Pemerintah Kota Semarang telah terverifikasi dengan Tanda Tangan Elektronik (TTE) tersertifikasi BSrE.
            </p>

            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px; padding: 28px 24px; font-family: var(--font-mono); font-size: 0.82rem; color: var(--text-body); text-align: left; max-height: 250px; overflow-y: auto; box-shadow: var(--shadow-sm);">
                <div style="text-align: center; border-bottom: 1.5px dashed var(--border-color); padding-bottom: 14px; margin-bottom: 16px;">
                    <div style="font-weight: 800; color: var(--text-dark); font-size: 0.95rem; letter-spacing: 0.5px;">PEMERINTAH KOTA SEMARANG</div>
                    <div style="font-weight: 700; color: var(--primary); font-size: 0.85rem;">DINAS ARSIP DAN PERPUSTAKAAN</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 2px;">Jl. Pemuda No. 148, Sekayu, Semarang Tengah, Kota Semarang (50132)</div>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span><strong>HAL:</strong> SURAT IZIN RISET KEARSIPAN</span>
                    <span class="status-badge status-badge--success">TERVERIFIKASI TTE</span>
                </div>
                <p style="line-height: 1.6; margin-top: 10px; color: var(--text-body);">
                    Dengan ini menerangkan bahwa pemohon telah memenuhi persyaratan administratif penelusuran naskah kuno, dokumen staatsblad, dan arsip statis daerah untuk keperluan penelitian akademis sesuai dengan Perda Kearsipan Kota Semarang.
                </p>
            </div>
        </div>

        <x-slot:footer>
            <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Tutup</button>
            <button type="button" class="admin-btn admin-btn--primary" onclick="window.showToast('Mengunduh berkas PDF resmi tersertifikasi...', 'success'); closeAdminModal('pdfPreviewModal');">
                <i data-lucide="download" style="width: 16px; height: 16px;"></i>
                <span>Unduh Dokumen PDF</span>
            </button>
        </x-slot:footer>
    </x-admin.modal>

    <!-- Global Keydown Listener for ⌘K / Ctrl+K Quick Search -->
    <script>
        document.addEventListener('keydown', function(e) {
            if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.getElementById('globalSearchInput') || document.querySelector('.table-search-input input');
                if (searchInput) {
                    searchInput.focus();
                    searchInput.select();
                }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>

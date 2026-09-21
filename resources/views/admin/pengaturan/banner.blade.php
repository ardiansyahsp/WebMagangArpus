<x-admin.layout title="Manajemen Banner Utama | Pengaturan Sistem">
    <!-- Page Header -->
    <x-admin.page-header
        title="Manajemen Banner Utama (Hero)"
        subtitle="Atur konten slider promo, pesan informasi kepala dinas, dan gambar latar beranda utama portal website."
        :breadcrumbs="[
            ['label' => 'Pengaturan', 'url' => route('admin.pengaturan.kategori')],
            ['label' => 'Banner Utama']
        ]"
    >
        <x-slot:actions>
            <button type="button" class="admin-btn admin-btn--primary" data-modal-target="tambahBannerModal">
                <i data-lucide="image-plus" style="width: 16px; height: 16px;"></i>
                <span>Tambah Banner Baru</span>
            </button>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- 1. LIVE PREVIEW BANNER SECTION (Stripe/Linear Luxury Glass Style) -->
    <div class="admin-card" style="margin-bottom: 26px;">
        <div class="admin-card__header">
            <div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="display: inline-flex; width: 8px; height: 8px; border-radius: 50%; background: #10b981; box-shadow: 0 0 8px #10b981;"></span>
                    <h3 class="admin-card__title">Pratinjau Langsung (Live Preview Hero Beranda)</h3>
                </div>
                <p class="admin-card__subtitle">Tampilan banner aktif saat diakses oleh pengunjung di beranda portal publik Arpusda</p>
            </div>
            <a href="{{ route('home') }}" target="_blank" class="admin-btn admin-btn--sm admin-btn--secondary">
                <i data-lucide="external-link" style="width: 14px; height: 14px;"></i>
                <span>Buka Beranda Publik</span>
            </a>
        </div>

        <div style="padding: 24px;">
            <div style="position: relative; border-radius: 20px; overflow: hidden; background: linear-gradient(135deg, rgba(74, 9, 9, 0.96) 0%, rgba(26, 2, 2, 0.98) 100%); color: #ffffff; padding: 48px 36px; box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.3); border: 1px solid rgba(232, 184, 75, 0.35);">
                <!-- Ambient Background Image Overlay -->
                <div style="position: absolute; right: 0; top: 0; bottom: 0; width: 50%; opacity: 0.22; background: url('{{ asset('asset/bakgron.jpg') }}') center/cover no-repeat; pointer-events: none; mask-image: linear-gradient(to right, transparent, black);"></div>
                <div style="position: absolute; top: -60px; right: -60px; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(244, 180, 0, 0.25) 0%, transparent 70%); pointer-events: none;"></div>

                <div style="position: relative; z-index: 2; max-width: 640px;">
                    <div style="display: inline-flex; align-items: center; gap: 8px; font-family: var(--font-heading); font-size: 0.76rem; font-weight: 800; letter-spacing: 1.5px; color: var(--accent-gold); margin-bottom: 14px; text-transform: uppercase;" id="previewTagline">
                        <span style="width: 20px; height: 2px; background: var(--accent-gold);"></span>
                        WEBSITE RESMI DINAS ARSIP & PERPUSTAKAAN KOTA SEMARANG
                    </div>
                    
                    <h2 style="font-family: var(--font-heading); font-size: 1.85rem; font-weight: 800; line-height: 1.25; margin-bottom: 14px; color: #ffffff;" id="previewJudul">
                        Inovasi Layanan Menuju <span style="color: var(--accent-gold);">Arsip & Literasi Sempurna</span>
                    </h2>

                    <p style="font-size: 0.88rem; color: rgba(255, 255, 255, 0.85); line-height: 1.65; margin-bottom: 24px;" id="previewDeskripsi">
                        Menyediakan keterbukaan informasi publik, kemudahan akses koleksi pustaka, serta pengelolaan arsip daerah yang modern, akurat, dan terpercaya bagi masyarakat Kota Semarang.
                    </p>

                    <div style="display: flex; gap: 12px; align-items: center;">
                        <button type="button" class="admin-btn admin-btn--gold" id="previewBtn" style="border-radius: 12px; padding: 10px 22px; font-weight: 700;">
                            Jelajahi Layanan
                        </button>
                        <span style="font-size: 0.78rem; color: rgba(255, 255, 255, 0.6); font-family: var(--font-mono);" id="previewLink">
                            Link: #layanan
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. DATA TABLE: DAFTAR BANNER & SLIDES (Linear/Supabase Style) -->
    <x-admin.data-table
        title="Daftar Banner & Slideshow Beranda"
        subtitle="Kelola urutan perputaran, status aktif slide, dan parameter banner utama"
        searchPlaceholder="Cari judul atau tagline banner..."
    >
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Urutan</th>
                    <th style="width: 120px;">Thumbnail</th>
                    <th>Judul Banner & Tagline</th>
                    <th>Tombol Aksi (CTA)</th>
                    <th>Status Slide</th>
                    <th style="width: 140px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bannerList as $b)
                    <tr>
                        <td>
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--bg-admin); border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; font-family: var(--font-mono); font-weight: 800; font-size: 0.85rem; color: var(--primary);">
                                #{{ $b['urutan'] }}
                            </div>
                        </td>
                        <td>
                            <div style="width: 96px; height: 54px; border-radius: 10px; overflow: hidden; background: #000; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); position: relative;">
                                <img src="{{ asset('asset/bakgron.jpg') }}" alt="{{ $b['judul'] }}" style="width: 100%; height: 100%; object-fit: cover;" />
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.72rem; font-weight: 800; color: var(--accent-gold-dark); text-transform: uppercase; letter-spacing: 0.5px;">{{ $b['tagline'] }}</div>
                            <div style="font-weight: 700; color: var(--text-dark); font-size: 0.9rem; margin: 2px 0;">{{ $b['judul'] }}</div>
                            <div style="font-size: 0.76rem; color: var(--text-muted); max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $b['deskripsi'] }}</div>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 0.82rem; font-weight: 600; color: var(--text-dark);">
                                <i data-lucide="mouse-pointer-click" style="width: 13px; height: 13px; color: var(--primary);"></i>
                                <span>{{ $b['cta_text'] }}</span>
                            </div>
                            <div style="font-size: 0.72rem; color: var(--text-muted); font-family: var(--font-mono); margin-top: 2px;">{{ $b['cta_url'] }}</div>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.pengaturan.banner.toggle', $b['id']) }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="status-badge {{ $b['status'] === 'Aktif' ? 'status-badge--success' : 'status-badge--danger' }}" style="border: none; cursor: pointer;" title="Klik untuk ubah status aktif">
                                    <span style="width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
                                    <span>{{ $b['status'] }}</span>
                                </button>
                            </form>
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <button type="button" class="btn-table-action" title="Terapkan ke Pratinjau Atas" onclick="setPreview({{ json_encode($b) }})">
                                    <i data-lucide="eye" style="width: 14px; height: 14px;"></i>
                                </button>
                                <button type="button" class="btn-table-action" title="Edit Pengaturan Banner" onclick="editBanner({{ json_encode($b) }})">
                                    <i data-lucide="pencil" style="width: 14px; height: 14px;"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="admin-empty-state">
                                <i data-lucide="image" style="width: 44px; height: 44px; color: var(--text-muted);"></i>
                                <div class="admin-empty-title">Belum ada banner terdaftar</div>
                                <p class="admin-empty-desc">Tambahkan slide banner baru untuk mempercantik tampilan beranda website.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-admin.data-table>

    <!-- 1. MODAL TAMBAH BANNER -->
    <x-admin.modal id="tambahBannerModal" title="Upload & Publikasikan Banner Baru" size="lg">
        <form method="POST" action="{{ route('admin.pengaturan.banner.store') }}">
            @csrf
            <div class="admin-form-grid admin-form-grid--2col">
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="gambar_banner" label="File Gambar Hero / Banner" type="file" required helper="Ukuran rekomendasi: 1920x800 px (Format: JPG/PNG/WebP, Maks. 5MB)" />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="tagline" label="Tagline / Subheading Kecil" placeholder="Contoh: WEBSITE RESMI DINAS ARSIP & PERPUSTAKAAN" required />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="judul" label="Judul Utama Banner" placeholder="Contoh: Inovasi Layanan Menuju Arsip & Literasi Sempurna" required />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="deskripsi" label="Deskripsi Paragraf Lengkap" type="textarea" rows="3" placeholder="Tuliskan pesan utama yang ingin disampaikan kepada masyarakat..." required />
                </div>
                <x-admin.form-input name="cta_text" label="Teks Tombol Aksi" placeholder="Contoh: Jelajahi Layanan" value="Jelajahi Layanan" />
                <x-admin.form-input name="cta_url" label="Tautan / Link Tombol" placeholder="Contoh: #layanan atau /katalog-buku" value="#layanan" />
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="check" style="width: 16px; height: 16px;"></i>
                    <span>Simpan & Aktifkan Banner</span>
                </button>
            </div>
        </form>
    </x-admin.modal>

    <!-- 2. MODAL EDIT BANNER -->
    <x-admin.modal id="editBannerModal" title="Edit Pengaturan Banner" size="lg">
        <form method="POST" id="formEditBanner" action="{{ route('admin.pengaturan.banner.update', 1) }}">
            @csrf
            @method('PUT')
            <div class="admin-form-grid admin-form-grid--2col">
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="edit_tagline" id="edit_tagline" label="Tagline / Subheading" required />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="edit_judul_banner" id="edit_judul_banner" label="Judul Banner" required />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="edit_deskripsi_banner" id="edit_deskripsi_banner" label="Deskripsi Paragraf" type="textarea" rows="3" required />
                </div>
                <x-admin.form-input name="edit_cta_text" id="edit_cta_text" label="Teks Tombol (CTA)" required />
                <x-admin.form-input name="edit_cta_url" id="edit_cta_url" label="Link Tombol" required />
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </x-admin.modal>

    @push('scripts')
    <script>
        function setPreview(banner) {
            document.getElementById('previewTagline').innerHTML = `<span style="width: 20px; height: 2px; background: var(--accent-gold);"></span> ${banner.tagline}`;
            document.getElementById('previewJudul').textContent = banner.judul;
            document.getElementById('previewDeskripsi').textContent = banner.deskripsi;
            document.getElementById('previewBtn').textContent = banner.cta_text;
            const linkEl = document.getElementById('previewLink');
            if (linkEl) {
                linkEl.textContent = `Link: ${banner.cta_url}`;
            }
            window.showToast(`Pratinjau hero banner "${banner.judul}" berhasil dimuat!`, 'info');
        }

        function editBanner(banner) {
            document.getElementById('edit_tagline').value = banner.tagline;
            document.getElementById('edit_judul_banner').value = banner.judul;
            document.getElementById('edit_deskripsi_banner').value = banner.deskripsi;
            document.getElementById('edit_cta_text').value = banner.cta_text;
            document.getElementById('edit_cta_url').value = banner.cta_url;
            const form = document.getElementById('formEditBanner');
            form.action = `/admin/pengaturan/banner/${banner.id}`;
            openAdminModal('editBannerModal');
        }
    </script>
    @endpush
</x-admin.layout>

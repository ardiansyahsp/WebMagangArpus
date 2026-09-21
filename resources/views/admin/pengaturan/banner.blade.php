<x-admin.layout title="Manajemen Banner Utama | Pengaturan Sistem">
    <!-- Page Header -->
    <x-admin.page-header
        title="Manajemen Banner Utama (Hero)"
        subtitle="Atur konten slider promo, pesan informasi kepala dinas, dan gambar latar beranda utama website."
        :breadcrumbs="[
            ['label' => 'Pengaturan', 'url' => route('admin.pengaturan.kategori')],
            ['label' => 'Banner Utama']
        ]"
    >
        <x-slot:actions>
            <button type="button" class="admin-btn admin-btn--primary" data-modal-target="tambahBannerModal">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                <span>Tambah Banner Baru</span>
            </button>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- 1. LIVE PREVIEW BANNER SECTION -->
    <div class="admin-card" style="margin-bottom: 26px;">
        <div class="admin-card__header">
            <div>
                <h3 class="admin-card__title">Pratinjau Langsung (Live Preview Hero Beranda)</h3>
                <p class="admin-card__subtitle">Tampilan banner aktif saat diakses oleh pengunjung di beranda portal publik</p>
            </div>
            <a href="{{ route('home') }}" target="_blank" class="admin-btn admin-btn--sm admin-btn--secondary">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
                <span>Buka Beranda</span>
            </a>
        </div>

        <div style="padding: 24px;">
            <div style="position: relative; border-radius: var(--radius-lg); overflow: hidden; background: linear-gradient(135deg, rgba(74, 9, 9, 0.95) 0%, rgba(26, 2, 2, 0.98) 100%); color: #ffffff; padding: 40px 32px; box-shadow: var(--shadow-lg); border: 1px solid rgba(232, 184, 75, 0.3);">
                <div style="position: absolute; right: 0; top: 0; bottom: 0; width: 45%; opacity: 0.25; background: url('{{ asset('asset/bakgron.jpg') }}') center/cover no-repeat; pointer-events: none;"></div>
                
                <div style="position: relative; z-index: 2; max-width: 620px;">
                    <div style="display: inline-flex; align-items: center; gap: 8px; font-family: var(--font-heading); font-size: 0.76rem; font-weight: 800; letter-spacing: 1.5px; color: var(--accent-gold); margin-bottom: 12px;" id="previewTagline">
                        <span style="width: 24px; height: 2px; background: var(--accent-gold);"></span>
                        WEBSITE RESMI DINAS ARSIP & PERPUSTAKAAN KOTA SEMARANG
                    </div>
                    
                    <h2 style="font-family: var(--font-heading); font-size: 1.8rem; font-weight: 800; line-height: 1.25; margin-bottom: 12px; color: #ffffff;" id="previewJudul">
                        Inovasi Layanan Menuju <span style="color: var(--accent-gold);">Arsip & Literasi Sempurna</span>
                    </h2>

                    <p style="font-size: 0.88rem; color: rgba(255, 255, 255, 0.8); line-height: 1.6; margin-bottom: 20px;" id="previewDeskripsi">
                        Menyediakan keterbukaan informasi publik, kemudahan akses koleksi pustaka, serta pengelolaan arsip daerah yang modern, akurat, dan terpercaya bagi masyarakat Kota Semarang.
                    </p>

                    <div style="display: flex; gap: 12px;">
                        <button type="button" class="admin-btn admin-btn--gold" id="previewBtn">
                            Jelajahi Layanan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. DATA TABLE: DAFTAR BANNER & SLIDES -->
    <x-admin.data-table
        title="Daftar Banner & Slideshow"
        subtitle="Kelola urutan dan status aktif slide banner promosi"
        searchPlaceholder="Cari judul banner..."
    >
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 60px;">Urutan</th>
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
                        <td style="font-family: monospace; font-weight: 700; font-size: 1rem; color: var(--text-dark);">
                            #{{ $b['urutan'] }}
                        </td>
                        <td>
                            <div style="width: 90px; height: 50px; border-radius: var(--radius-xs); overflow: hidden; background: #000; border: 1px solid var(--border-color);">
                                <img src="{{ asset('asset/bakgron.jpg') }}" alt="{{ $b['judul'] }}" style="width: 100%; height: 100%; object-fit: cover;" />
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.72rem; font-weight: 700; color: var(--accent-gold-dark); text-transform: uppercase;">{{ $b['tagline'] }}</div>
                            <div style="font-weight: 700; color: var(--text-dark); font-size: 0.88rem;">{{ $b['judul'] }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-muted); max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $b['deskripsi'] }}</div>
                        </td>
                        <td>
                            <span style="font-size: 0.8rem; font-weight: 600;">{{ $b['cta_text'] }}</span>
                            <div style="font-size: 0.72rem; color: var(--text-muted); font-family: monospace;">{{ $b['cta_url'] }}</div>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.pengaturan.banner.toggle', $b['id']) }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="status-badge {{ $b['status'] === 'Aktif' ? 'status-badge--success' : 'status-badge--danger' }}" style="border: none; cursor: pointer;">
                                    {{ $b['status'] }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <button type="button" class="btn-table-action" title="Terapkan ke Pratinjau" onclick="setPreview({{ json_encode($b) }})">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                                <button type="button" class="btn-table-action" title="Edit Banner" onclick="editBanner({{ json_encode($b) }})">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="admin-empty-state">
                                <p>Belum ada banner yang terdaftar.</p>
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
                    <x-admin.form-input name="gambar_banner" label="File Gambar Hero / Banner" type="file" required helper="Ukuran rekomendasi: 1920x800 px (Maks. 5MB)" />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="tagline" label="Tagline / Subheading Kecil" placeholder="Contoh: WEBSITE RESMI DINAS ARSIP & PERPUSTAKAAN" required />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="judul" label="Judul Utama Banner" placeholder="Contoh: Inovasi Layanan Menuju Arsip & Literasi Sempurna" required />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="deskripsi" label="Deskripsi Paragraf" type="textarea" rows="3" placeholder="Tuliskan pesan utama yang ingin disampaikan..." required />
                </div>
                <x-admin.form-input name="cta_text" label="Teks Tombol Aksi" placeholder="Contoh: Jelajahi Layanan" value="Jelajahi Layanan" />
                <x-admin.form-input name="cta_url" label="Tautan / Link Tombol" placeholder="Contoh: #layanan atau /katalog-buku" value="#layanan" />
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Simpan Banner</button>
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
                    <x-admin.form-input name="edit_tagline" id="edit_tagline" label="Tagline" required />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="edit_judul_banner" id="edit_judul_banner" label="Judul" required />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="edit_deskripsi_banner" id="edit_deskripsi_banner" label="Deskripsi" type="textarea" rows="3" required />
                </div>
                <x-admin.form-input name="edit_cta_text" id="edit_cta_text" label="Teks Tombol" required />
                <x-admin.form-input name="edit_cta_url" id="edit_cta_url" label="Link Tombol" required />
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Simpan</button>
            </div>
        </form>
    </x-admin.modal>

    @push('scripts')
    <script>
        function setPreview(banner) {
            document.getElementById('previewTagline').innerHTML = `<span style="width: 24px; height: 2px; background: var(--accent-gold);"></span> ${banner.tagline}`;
            document.getElementById('previewJudul').textContent = banner.judul;
            document.getElementById('previewDeskripsi').textContent = banner.deskripsi;
            document.getElementById('previewBtn').textContent = banner.cta_text;
            window.showToast(`Pratinjau banner "${banner.judul}" dimuat!`, 'info');
        }

        function editBanner(banner) {
            document.getElementById('edit_tagline').value = banner.tagline;
            document.getElementById('edit_judul_banner').value = banner.judul;
            document.getElementById('edit_deskripsi_banner').value = banner.deskripsi;
            document.getElementById('edit_cta_text').value = banner.cta_text;
            document.getElementById('edit_cta_url').value = banner.cta_url;
            openAdminModal('editBannerModal');
        }
    </script>
    @endpush
</x-admin.layout>

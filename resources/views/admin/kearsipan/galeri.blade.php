<x-admin.layout title="Galeri Arsip Sejarah | Manajemen Kearsipan">
    <!-- Page Header -->
    <x-admin.page-header
        title="Galeri Arsip Sejarah"
        subtitle="Kurasi dan dokumentasi visual khazanah arsip foto, peta, dan naskah kuno Kota Semarang tempo doeloe."
        :breadcrumbs="[
            ['label' => 'Kearsipan', 'url' => route('admin.kearsipan.permohonan')],
            ['label' => 'Galeri Arsip']
        ]"
    >
        <x-slot:actions>
            <button type="button" class="admin-btn admin-btn--primary" data-modal-target="tambahGaleriModal">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Upload Arsip Baru</span>
            </button>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Filter Tab Bar by Era -->
    <div style="display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap;">
        <a href="{{ route('admin.kearsipan.galeri') }}" class="admin-btn admin-btn--sm {{ !request('era') ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
            Semua Era ({{ count($galeriList) }})
        </a>
        <a href="{{ route('admin.kearsipan.galeri', ['era' => 'Kolonial']) }}" class="admin-btn admin-btn--sm {{ request('era') === 'Kolonial' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
            Era Kolonial (Hindia Belanda)
        </a>
        <a href="{{ route('admin.kearsipan.galeri', ['era' => 'Kemerdekaan']) }}" class="admin-btn admin-btn--sm {{ request('era') === 'Kemerdekaan' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
            Era Kemerdekaan (1945-1950)
        </a>
        <a href="{{ route('admin.kearsipan.galeri', ['era' => 'Modern']) }}" class="admin-btn admin-btn--sm {{ request('era') === 'Modern' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
            Era Pembangunan Modern
        </a>
    </div>

    <!-- Data Table Card -->
    <x-admin.data-table
        title="Koleksi Khazanah Galeri Arsip"
        subtitle="Dokumentasi arsip sejarah yang dipublikasikan pada portal pameran daring"
        searchPlaceholder="Cari judul, kurasi, era..."
    >
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 100px;">Thumbnail</th>
                    <th>Judul Arsip Sejarah</th>
                    <th>Tahun Rekaman</th>
                    <th>Era Sejarah</th>
                    <th>Sumber Hak Cipta</th>
                    <th style="width: 140px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galeriList as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div style="width: 70px; height: 50px; border-radius: var(--radius-xs); overflow: hidden; background: #000; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('asset/bakgron.jpg') }}" alt="{{ $item['judul'] }}" style="width: 100%; height: 100%; object-fit: cover;" />
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: var(--text-dark); font-size: 0.88rem;">{{ $item['judul'] }}</div>
                            <div style="font-size: 0.76rem; color: var(--text-muted); max-width: 320px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                {{ $item['deskripsi'] }}
                            </div>
                        </td>
                        <td>
                            <span style="font-family: var(--font-heading); font-weight: 700; color: var(--primary);">{{ $item['tahun'] }}</span>
                        </td>
                        <td>
                            <span class="status-badge {{ $item['era'] === 'Kolonial' ? 'status-badge--warning' : ($item['era'] === 'Kemerdekaan' ? 'status-badge--danger' : 'status-badge--info') }}">
                                {{ $item['era'] }}
                            </span>
                        </td>
                        <td>
                            <div style="font-size: 0.78rem; color: var(--text-body);">{{ $item['hak_cipta'] }}</div>
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <button type="button" class="btn-table-action" title="Detail Kuratorial" onclick="detailGaleri({{ json_encode($item) }})">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                </button>
                                <button type="button" class="btn-table-action" title="Edit Arsip" onclick="editGaleri({{ json_encode($item) }})">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </button>
                                <form method="POST" action="{{ route('admin.kearsipan.galeri.destroy', $item['id']) }}" onsubmit="return confirm('Hapus arsip sejarah ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-table-action btn-table-action--delete" title="Hapus Arsip">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="admin-empty-state">
                                <p>Tidak ada data arsip sejarah untuk kategori era ini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-admin.data-table>

    <!-- 1. MODAL TAMBAH ARSIP -->
    <x-admin.modal id="tambahGaleriModal" title="Upload Arsip Sejarah Baru" size="lg">
        <form method="POST" action="{{ route('admin.kearsipan.galeri.store') }}">
            @csrf
            <div class="admin-form-grid admin-form-grid--2col">
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="gambar" label="Upload File Gambar / Dokumen Arsip" type="file" required helper="Format didukung: JPG, PNG, TIFF, PDF (Maks. 10MB)" />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="judul" label="Judul Arsip Sejarah" placeholder="Contoh: Gedung NIS Lawang Sewu Tahun 1910" required />
                </div>
                <x-admin.form-input name="tahun" label="Tahun Pembuatan / Rekaman" placeholder="Contoh: 1910 atau ca. 1920-an" required />
                
                <x-admin.form-select name="era" label="Kategori Era Sejarah" required>
                    <option value="Kolonial">Kolonial (Hindia Belanda)</option>
                    <option value="Kemerdekaan">Kemerdekaan (1945-1950)</option>
                    <option value="Modern">Modern (Pascakemerdekaan / Orde Baru)</option>
                </x-admin.form-select>

                <div style="grid-column: span 2;">
                    <x-admin.form-input name="hak_cipta" label="Sumber / Hak Cipta Kepemilikan" placeholder="Contoh: Domain Publik / Koleksi ANRI & Arpusda" required />
                </div>

                <div style="grid-column: span 2;">
                    <x-admin.form-input name="deskripsi" label="Deskripsi Kuratorial & Konteks Sejarah" type="textarea" placeholder="Tuliskan ulasan kuratorial mengenai foto/dokumen sejarah ini..." rows="4" required />
                </div>
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Publikasikan ke Galeri</button>
            </div>
        </form>
    </x-admin.modal>

    <!-- 2. MODAL EDIT ARSIP -->
    <x-admin.modal id="editGaleriModal" title="Edit Arsip Sejarah" size="lg">
        <form method="POST" id="formEditGaleri" action="{{ route('admin.kearsipan.galeri.update', 1) }}">
            @csrf
            @method('PUT')
            <div class="admin-form-grid admin-form-grid--2col">
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="edit_judul_arsip" id="edit_judul_arsip" label="Judul Arsip" required />
                </div>
                <x-admin.form-input name="edit_tahun_arsip" id="edit_tahun_arsip" label="Tahun" required />
                <x-admin.form-select name="edit_era_arsip" id="edit_era_arsip" label="Era Sejarah" required>
                    <option value="Kolonial">Kolonial</option>
                    <option value="Kemerdekaan">Kemerdekaan</option>
                    <option value="Modern">Modern</option>
                </x-admin.form-select>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="edit_hak_cipta" id="edit_hak_cipta" label="Hak Cipta" required />
                </div>
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="edit_deskripsi_arsip" id="edit_deskripsi_arsip" label="Deskripsi Kuratorial" type="textarea" rows="3" required />
                </div>
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Perbarui Arsip</button>
            </div>
        </form>
    </x-admin.modal>

    <!-- 3. MODAL DETAIL KURATORIAL -->
    <x-admin.modal id="detailGaleriModal" title="Informasi Kuratorial Arsip" size="md">
        <div id="detailGaleriContent" style="display: flex; flex-direction: column; gap: 14px;"></div>
        <x-slot:footer>
            <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Tutup</button>
        </x-slot:footer>
    </x-admin.modal>

    @push('scripts')
    <script>
        function detailGaleri(item) {
            const container = document.getElementById('detailGaleriContent');
            container.innerHTML = `
                <div style="border-radius: var(--radius-md); overflow: hidden; height: 180px; background: #000; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('asset/bakgron.jpg') }}" alt="${item.judul}" style="width: 100%; height: 100%; object-fit: cover;" />
                </div>
                <div>
                    <span class="status-badge status-badge--info" style="margin-bottom: 6px;">Era ${item.era} (${item.tahun})</span>
                    <h3 style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 800; color: var(--primary); margin-top: 4px;">${item.judul}</h3>
                    <p style="font-size: 0.78rem; color: var(--text-muted);">Hak Cipta: <strong>${item.hak_cipta}</strong></p>
                </div>
                <div style="background: var(--bg-admin); border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: 12px; font-size: 0.84rem; line-height: 1.6;">
                    <strong>Deskripsi Kurasi:</strong><br>
                    ${item.deskripsi}
                </div>
            `;
            openAdminModal('detailGaleriModal');
        }

        function editGaleri(item) {
            document.getElementById('edit_judul_arsip').value = item.judul;
            document.getElementById('edit_tahun_arsip').value = item.tahun;
            document.getElementById('edit_era_arsip').value = item.era;
            document.getElementById('edit_hak_cipta').value = item.hak_cipta;
            document.getElementById('edit_deskripsi_arsip').value = item.deskripsi;
            openAdminModal('editGaleriModal');
        }
    </script>
    @endpush
</x-admin.layout>

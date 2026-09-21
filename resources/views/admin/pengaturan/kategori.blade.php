<x-admin.layout title="Manajemen Kategori | Pengaturan Sistem">
    <!-- Page Header -->
    <x-admin.page-header
        title="Manajemen Kategori"
        subtitle="Kelola klasifikasi taksonomi untuk koleksi buku perpustakaan dan khazanah kearsipan daerah."
        :breadcrumbs="[
            ['label' => 'Pengaturan', 'url' => route('admin.pengaturan.kategori')],
            ['label' => 'Kategori']
        ]"
    >
        <x-slot:actions>
            <button type="button" class="admin-btn admin-btn--primary" data-modal-target="tambahKategoriModal">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Tambah Kategori Baru</span>
            </button>
        </x-slot:actions>
    </x-admin.page-header>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 24px;">
        <!-- 1. KATEGORI BUKU -->
        <x-admin.data-table
            title="Kategori Koleksi Buku"
            subtitle="Klasifikasi klas buku perpustakaan (DDC)"
            searchPlaceholder="Cari kategori buku..."
        >
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Buku</th>
                        <th style="width: 90px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoriBuku as $kat)
                        <tr>
                            <td>
                                <span style="font-family: monospace; font-weight: 700; color: var(--primary);">
                                    {{ $kat['kode'] }}
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: var(--text-dark);">{{ $kat['nama'] }}</div>
                                <div style="font-size: 0.74rem; color: var(--text-muted);">{{ $kat['deskripsi'] }}</div>
                            </td>
                            <td>
                                <span style="font-weight: 600;">{{ number_format($kat['total_item'], 0, ',', '.') }} judul</span>
                            </td>
                            <td style="text-align: right;">
                                <div class="action-buttons" style="justify-content: flex-end;">
                                    <button type="button" class="btn-table-action" title="Edit Kategori" onclick="editKat('buku', {{ json_encode($kat) }})">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <form method="POST" action="{{ route('admin.pengaturan.kategori.destroy', $kat['id']) }}" onsubmit="return confirm('Hapus kategori ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table-action btn-table-action--delete" title="Hapus">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-admin.data-table>

        <!-- 2. KATEGORI ARSIP -->
        <x-admin.data-table
            title="Kategori Khazanah Kearsipan"
            subtitle="Klasifikasi jenis media arsip statis & dinamis"
            searchPlaceholder="Cari kategori arsip..."
        >
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Dokumen</th>
                        <th style="width: 90px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoriArsip as $kat)
                        <tr>
                            <td>
                                <span style="font-family: monospace; font-weight: 700; color: var(--accent-gold-dark);">
                                    {{ $kat['kode'] }}
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: var(--text-dark);">{{ $kat['nama'] }}</div>
                                <div style="font-size: 0.74rem; color: var(--text-muted);">{{ $kat['deskripsi'] }}</div>
                            </td>
                            <td>
                                <span style="font-weight: 600;">{{ number_format($kat['total_item'], 0, ',', '.') }} berkas</span>
                            </td>
                            <td style="text-align: right;">
                                <div class="action-buttons" style="justify-content: flex-end;">
                                    <button type="button" class="btn-table-action" title="Edit Kategori" onclick="editKat('arsip', {{ json_encode($kat) }})">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <form method="POST" action="{{ route('admin.pengaturan.kategori.destroy', $kat['id']) }}" onsubmit="return confirm('Hapus kategori ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table-action btn-table-action--delete" title="Hapus">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-admin.data-table>
    </div>

    <!-- 1. MODAL TAMBAH KATEGORI -->
    <x-admin.modal id="tambahKategoriModal" title="Tambah Kategori Baru" size="md">
        <form method="POST" action="{{ route('admin.pengaturan.kategori.store') }}">
            @csrf
            <div class="admin-form-grid">
                <x-admin.form-select name="tipe" label="Jenis Klasifikasi" required>
                    <option value="buku">Kategori Buku Perpustakaan</option>
                    <option value="arsip">Kategori Arsip Kearsipan</option>
                </x-admin.form-select>
                <x-admin.form-input name="kode" label="Kode Singkatan" placeholder="Contoh: SCI, TECH, DOC..." required />
                <x-admin.form-input name="nama" label="Nama Kategori" placeholder="Contoh: Sains Terapan, Naskah Kuno..." required />
                <x-admin.form-input name="deskripsi" label="Deskripsi / Ruang Lingkup" type="textarea" rows="2" placeholder="Penjelasan singkat kategori..." />
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Simpan Kategori</button>
            </div>
        </form>
    </x-admin.modal>

    <!-- 2. MODAL EDIT KATEGORI -->
    <x-admin.modal id="editKategoriModal" title="Edit Kategori" size="md">
        <form method="POST" id="formEditKategori" action="{{ route('admin.pengaturan.kategori.update', 1) }}">
            @csrf
            @method('PUT')
            <div class="admin-form-grid">
                <x-admin.form-input name="edit_kode" id="edit_kode" label="Kode" required />
                <x-admin.form-input name="edit_nama" id="edit_nama" label="Nama Kategori" required />
                <x-admin.form-input name="edit_deskripsi" id="edit_deskripsi" label="Deskripsi" type="textarea" rows="2" />
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Perbarui</button>
            </div>
        </form>
    </x-admin.modal>

    @push('scripts')
    <script>
        function editKat(tipe, item) {
            document.getElementById('edit_kode').value = item.kode;
            document.getElementById('edit_nama').value = item.nama;
            document.getElementById('edit_deskripsi').value = item.deskripsi || '';
            openAdminModal('editKategoriModal');
        }
    </script>
    @endpush
</x-admin.layout>

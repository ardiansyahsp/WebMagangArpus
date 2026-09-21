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
                <i data-lucide="plus" style="width: 16px; height: 16px;"></i>
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
                        <th style="width: 70px;">Kode</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Buku</th>
                        <th style="width: 90px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoriBuku as $kat)
                        <tr>
                            <td>
                                <span style="font-family: var(--font-mono); font-weight: 700; color: var(--primary); font-size: 0.82rem;">
                                    {{ $kat['kode'] }}
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: var(--text-dark);">{{ $kat['nama'] }}</div>
                                <div style="font-size: 0.74rem; color: var(--text-muted);">{{ $kat['deskripsi'] }}</div>
                            </td>
                            <td>
                                <span style="font-weight: 600; font-size: 0.84rem;">{{ number_format($kat['total_item'], 0, ',', '.') }} judul</span>
                            </td>
                            <td style="text-align: right;">
                                <div class="action-buttons" style="justify-content: flex-end;">
                                    <button type="button" class="btn-table-action" title="Edit Kategori" onclick="editKat('buku', {{ json_encode($kat) }})">
                                        <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i>
                                    </button>
                                    <form method="POST" action="{{ route('admin.pengaturan.kategori.destroy', $kat['id']) }}" onsubmit="return confirm('Hapus kategori ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table-action btn-table-action--delete" title="Hapus">
                                            <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
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
                        <th style="width: 70px;">Kode</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Dokumen</th>
                        <th style="width: 90px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoriArsip as $kat)
                        <tr>
                            <td>
                                <span style="font-family: var(--font-mono); font-weight: 700; color: var(--accent-gold-dark); font-size: 0.82rem;">
                                    {{ $kat['kode'] }}
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: var(--text-dark);">{{ $kat['nama'] }}</div>
                                <div style="font-size: 0.74rem; color: var(--text-muted);">{{ $kat['deskripsi'] }}</div>
                            </td>
                            <td>
                                <span style="font-weight: 600; font-size: 0.84rem;">{{ number_format($kat['total_item'], 0, ',', '.') }} berkas</span>
                            </td>
                            <td style="text-align: right;">
                                <div class="action-buttons" style="justify-content: flex-end;">
                                    <button type="button" class="btn-table-action" title="Edit Kategori" onclick="editKat('arsip', {{ json_encode($kat) }})">
                                        <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i>
                                    </button>
                                    <form method="POST" action="{{ route('admin.pengaturan.kategori.destroy', $kat['id']) }}" onsubmit="return confirm('Hapus kategori ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table-action btn-table-action--delete" title="Hapus">
                                            <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
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
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="check" style="width: 16px; height: 16px;"></i>
                    <span>Simpan Kategori</span>
                </button>
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
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i>
                    <span>Perbarui</span>
                </button>
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

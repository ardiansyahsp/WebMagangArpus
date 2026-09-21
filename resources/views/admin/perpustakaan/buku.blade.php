<x-admin.layout title="Katalog Buku OPAC | Manajemen Perpustakaan">
    <!-- Page Header -->
    <x-admin.page-header
        title="Katalog Buku (OPAC)"
        subtitle="Kelola data koleksi buku fisik dan pustaka digital Dinas Arsip dan Perpustakaan Kota Semarang."
        :breadcrumbs="[
            ['label' => 'Perpustakaan', 'url' => route('admin.perpustakaan.buku')],
            ['label' => 'Katalog Buku']
        ]"
    >
        <x-slot:actions>
            <button type="button" class="admin-btn admin-btn--primary" data-modal-target="tambahBukuModal">
                <i data-lucide="plus" style="width: 16px; height: 16px;"></i>
                <span>Tambah Buku Baru</span>
            </button>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Data Table Card (Supabase/Linear Style) -->
    <x-admin.data-table
        title="Daftar Koleksi Pustaka"
        subtitle="Total {{ count($bukuList) }} data buku terdaftar dalam katalog sistem"
        searchPlaceholder="Cari judul, penulis, ISBN, nomor panggil..."
    >
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Judul & Nomor Panggil</th>
                    <th>Penulis / Pengarang</th>
                    <th>Penerbit & Tahun</th>
                    <th>ISBN</th>
                    <th>Kategori</th>
                    <th>Lokasi Rak</th>
                    <th>Status</th>
                    <th style="width: 130px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bukuList as $index => $buku)
                    <tr>
                        <td style="font-family: var(--font-mono); color: var(--text-muted);">{{ $index + 1 }}</td>
                        <td>
                            <div style="font-weight: 700; color: var(--text-dark); font-size: 0.92rem;">
                                {{ $buku['judul'] }}
                            </div>
                            <div style="font-size: 0.72rem; color: var(--text-muted); font-family: var(--font-mono); margin-top: 2px;">
                                No. Panggil: <strong style="color: var(--primary);">{{ $buku['no_panggil'] }}</strong>
                            </div>
                        </td>
                        <td>
                            <span style="font-weight: 600; color: var(--text-body);">{{ $buku['penulis'] }}</span>
                        </td>
                        <td>
                            <div style="font-weight: 500;">{{ $buku['penerbit'] }}</div>
                            <div style="font-size: 0.72rem; color: var(--text-muted); font-family: var(--font-mono);">Tahun: {{ $buku['tahun'] }}</div>
                        </td>
                        <td style="font-family: var(--font-mono); font-size: 0.78rem;">
                            {{ $buku['isbn'] }}
                        </td>
                        <td>
                            <span class="status-badge status-badge--info">{{ $buku['kategori'] }}</span>
                        </td>
                        <td>
                            <span style="font-size: 0.8rem; font-weight: 500;">{{ $buku['lokasi_rak'] }}</span>
                        </td>
                        <td>
                            <x-admin.status-badge :status="$buku['status']" />
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <!-- Detail Button -->
                                <button type="button" class="btn-table-action" title="Detail Informasi Buku" onclick="lihatDetailBuku({{ json_encode($buku) }})">
                                    <i data-lucide="eye" style="width: 14px; height: 14px;"></i>
                                </button>
                                <!-- Edit Button -->
                                <button type="button" class="btn-table-action" title="Edit Data Buku" onclick="editBuku({{ json_encode($buku) }})">
                                    <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i>
                                </button>
                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('admin.perpustakaan.buku.destroy', $buku['id']) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-table-action btn-table-action--delete" title="Hapus Buku">
                                        <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <div class="admin-empty-state">
                                <i data-lucide="book-x" style="width: 44px; height: 44px; color: var(--text-muted);"></i>
                                <div class="admin-empty-title">Tidak ada buku ditemukan</div>
                                <p class="admin-empty-desc">Coba gunakan kata kunci pencarian yang berbeda.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <x-slot:footer>
            <div>Menampilkan 1 hingga {{ count($bukuList) }} dari total {{ count($bukuList) }} entri</div>
            <div class="admin-pagination">
                <button class="admin-page-btn" disabled>&laquo;</button>
                <button class="admin-page-btn is-active">1</button>
                <button class="admin-page-btn">&raquo;</button>
            </div>
        </x-slot:footer>
    </x-admin.data-table>

    <!-- 1. MODAL TAMBAH BUKU -->
    <x-admin.modal id="tambahBukuModal" title="Tambah Koleksi Buku Baru (OPAC)" size="lg">
        <form method="POST" action="{{ route('admin.perpustakaan.buku.store') }}" id="formTambahBuku">
            @csrf
            <div class="admin-form-grid admin-form-grid--2col">
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="judul" label="Judul Lengkap Buku" placeholder="Masukkan judul buku..." required />
                </div>
                <x-admin.form-input name="penulis" label="Penulis / Pengarang" placeholder="Nama penulis..." required />
                <x-admin.form-input name="penerbit" label="Penerbit" placeholder="Nama penerbit..." required />
                <x-admin.form-input name="tahun" label="Tahun Terbit" type="number" placeholder="Contoh: 2024" required />
                <x-admin.form-input name="isbn" label="Nomor ISBN" placeholder="Contoh: 978-602-xxx" required />
                
                <x-admin.form-select name="kategori" label="Kategori Buku" required>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat['nama'] }}">{{ $kat['nama'] }}</option>
                    @endforeach
                </x-admin.form-select>

                <x-admin.form-select name="status" label="Status Ketersediaan" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Dipinjam">Dipinjam</option>
                </x-admin.form-select>

                <x-admin.form-input name="no_panggil" label="Nomor Panggil (Call Number)" placeholder="Contoh: 909 HAR s" required />
                <x-admin.form-input name="lokasi_rak" label="Lokasi Rak Penyimpanan" placeholder="Contoh: Rak A-01 (Lantai 2)" required />

                <div style="grid-column: span 2;">
                    <x-admin.form-input name="sinopsis" label="Sinopsis / Deskripsi Buku" type="textarea" placeholder="Tuliskan ringkasan sinopsis isi buku..." rows="3" />
                </div>
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="check" style="width: 16px; height: 16px;"></i>
                    <span>Simpan ke Katalog</span>
                </button>
            </div>
        </form>
    </x-admin.modal>

    <!-- 2. MODAL EDIT BUKU -->
    <x-admin.modal id="editBukuModal" title="Edit Data Katalog Buku" size="lg">
        <form method="POST" id="formEditBuku" action="{{ route('admin.perpustakaan.buku.update', 1) }}">
            @csrf
            @method('PUT')
            <div class="admin-form-grid admin-form-grid--2col">
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="edit_judul" id="edit_judul" label="Judul Lengkap Buku" required />
                </div>
                <x-admin.form-input name="edit_penulis" id="edit_penulis" label="Penulis / Pengarang" required />
                <x-admin.form-input name="edit_penerbit" id="edit_penerbit" label="Penerbit" required />
                <x-admin.form-input name="edit_tahun" id="edit_tahun" label="Tahun Terbit" type="number" required />
                <x-admin.form-input name="edit_isbn" id="edit_isbn" label="Nomor ISBN" required />
                <x-admin.form-input name="edit_kategori" id="edit_kategori" label="Kategori" required />
                <x-admin.form-input name="edit_lokasi_rak" id="edit_lokasi_rak" label="Lokasi Rak" required />
                <x-admin.form-input name="edit_no_panggil" id="edit_no_panggil" label="Nomor Panggil" required />
                <div style="grid-column: span 2;">
                    <x-admin.form-input name="edit_sinopsis" id="edit_sinopsis" label="Sinopsis" type="textarea" rows="3" />
                </div>
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i>
                    <span>Perbarui Data</span>
                </button>
            </div>
        </form>
    </x-admin.modal>

    <!-- 3. MODAL DETAIL BUKU -->
    <x-admin.modal id="detailBukuModal" title="Detail Informasi Katalog Buku" size="md">
        <div id="detailBukuContent" style="display: flex; flex-direction: column; gap: 16px;">
            <!-- Populated via JavaScript -->
        </div>
        <x-slot:footer>
            <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Tutup</button>
        </x-slot:footer>
    </x-admin.modal>

    @push('scripts')
    <script>
        function lihatDetailBuku(buku) {
            const container = document.getElementById('detailBukuContent');
            container.innerHTML = `
                <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 14px;">
                    <h3 style="font-family: var(--font-heading); font-size: 1.15rem; font-weight: 800; color: var(--primary); margin-bottom: 4px;">${buku.judul}</h3>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Penulis: <strong>${buku.penulis}</strong> | Penerbit: <strong>${buku.penerbit} (${buku.tahun})</strong></p>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; font-size: 0.82rem; background: var(--bg-admin); padding: 16px; border-radius: 14px; border: 1px solid var(--border-color);">
                    <div><strong>ISBN:</strong> <span style="font-family: var(--font-mono);">${buku.isbn}</span></div>
                    <div><strong>Nomor Panggil:</strong> <span style="font-family: var(--font-mono); color: var(--primary); font-weight: 700;">${buku.no_panggil}</span></div>
                    <div><strong>Kategori:</strong> ${buku.kategori}</div>
                    <div><strong>Lokasi Rak:</strong> ${buku.lokasi_rak}</div>
                    <div><strong>Status:</strong> ${buku.status}</div>
                    <div><strong>Ketersediaan:</strong> ${buku.sisa_eksemplar || 1} / ${buku.total_eksemplar || 1} Eksemplar</div>
                </div>
                <div>
                    <h5 style="font-family: var(--font-heading); font-size: 0.86rem; font-weight: 700; margin-bottom: 4px; color: var(--text-dark);">Sinopsis Buku:</h5>
                    <p style="font-size: 0.84rem; color: var(--text-body); line-height: 1.6; background: var(--bg-card); padding: 12px; border-radius: 10px; border: 1px solid var(--border-light);">${buku.sinopsis || 'Tidak ada deskripsi sinopsis.'}</p>
                </div>
            `;
            openAdminModal('detailBukuModal');
        }

        function editBuku(buku) {
            document.getElementById('edit_judul').value = buku.judul;
            document.getElementById('edit_penulis').value = buku.penulis;
            document.getElementById('edit_penerbit').value = buku.penerbit;
            document.getElementById('edit_tahun').value = buku.tahun;
            document.getElementById('edit_isbn').value = buku.isbn;
            document.getElementById('edit_kategori').value = buku.kategori;
            document.getElementById('edit_lokasi_rak').value = buku.lokasi_rak;
            document.getElementById('edit_no_panggil').value = buku.no_panggil;
            document.getElementById('edit_sinopsis').value = buku.sinopsis || '';
            openAdminModal('editBukuModal');
        }
    </script>
    @endpush
</x-admin.layout>

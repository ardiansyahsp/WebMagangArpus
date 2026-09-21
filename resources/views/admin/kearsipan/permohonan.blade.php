<x-admin.layout title="Permohonan Penelusuran Arsip | Manajemen Kearsipan">
    <!-- Page Header -->
    <x-admin.page-header
        title="Permohonan Penelusuran Arsip"
        subtitle="Verifikasi izin riset, surat pengantar penelitian, dan akses khazanah naskah kuno Kota Semarang."
        :breadcrumbs="[
            ['label' => 'Kearsipan', 'url' => route('admin.kearsipan.permohonan')],
            ['label' => 'Permohonan Penelusuran']
        ]"
    >
        <x-slot:actions>
            <div style="display: flex; gap: 8px;">
                <a href="{{ route('admin.kearsipan.permohonan') }}" class="admin-btn admin-btn--sm {{ !request('status') ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Semua ({{ count($permohonanList) }})
                </a>
                <a href="{{ route('admin.kearsipan.permohonan', ['status' => 'Diproses']) }}" class="admin-btn admin-btn--sm {{ request('status') === 'Diproses' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Diproses
                </a>
                <a href="{{ route('admin.kearsipan.permohonan', ['status' => 'Revisi Berkas']) }}" class="admin-btn admin-btn--sm {{ request('status') === 'Revisi Berkas' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Revisi Berkas
                </a>
                <a href="{{ route('admin.kearsipan.permohonan', ['status' => 'Selesai']) }}" class="admin-btn admin-btn--sm {{ request('status') === 'Selesai' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Selesai
                </a>
            </div>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Data Table Card -->
    <x-admin.data-table
        title="Daftar Permohonan Riset Arsip Masuk"
        subtitle="Berkas permohonan penelusuran dokumen sejarah oleh akademisi, instansi, dan masyarakat umum"
        searchPlaceholder="Cari nama, institusi, tiket..."
    >
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 120px;">No. Tiket</th>
                    <th>Nama Pemohon</th>
                    <th>Institusi / Universitas</th>
                    <th>Judul Penelitian & Fokus Riset</th>
                    <th>Surat Pengantar</th>
                    <th>Status Berkas</th>
                    <th style="width: 180px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permohonanList as $p)
                    <tr>
                        <td>
                            <span style="font-family: monospace; font-weight: 700; color: var(--primary);">
                                {{ $p['nomor_tiket'] }}
                            </span>
                            <div style="font-size: 0.72rem; color: var(--text-muted);">{{ $p['tanggal'] }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: var(--text-dark);">{{ $p['nama'] }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $p['email'] }}</div>
                        </td>
                        <td>
                            <span style="font-weight: 500;">{{ $p['institusi'] }}</span>
                        </td>
                        <td>
                            <div style="font-size: 0.85rem; font-weight: 600; color: var(--text-dark); max-width: 320px;" title="{{ $p['judul'] }}">
                                {{ $p['judul'] }}
                            </div>
                        </td>
                        <td>
                            <button type="button" class="admin-btn admin-btn--sm admin-btn--secondary" data-view-pdf="{{ $p['surat_pengantar'] }}" style="gap: 5px; font-size: 0.75rem;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                                <span>{{ substr($p['surat_pengantar'], 0, 16) }}...</span>
                            </button>
                        </td>
                        <td>
                            <x-admin.status-badge :status="$p['status']" />
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <!-- Lihat PDF -->
                                <button type="button" class="btn-table-action" title="Lihat PDF Dokumen" data-view-pdf="{{ $p['surat_pengantar'] }}">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                                <!-- Unduh PDF -->
                                <button type="button" class="btn-table-action" title="Unduh PDF Berkas" data-download-pdf="{{ $p['surat_pengantar'] }}">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                </button>
                                <!-- Ubah Status -->
                                <button type="button" class="btn-table-action" title="Ubah Status Permohonan" onclick="ubahStatusArsip({{ json_encode($p) }})">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="admin-empty-state">
                                <p>Tidak ada permohonan penelusuran arsip dengan status ini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-admin.data-table>

    <!-- MODAL UBAH STATUS PERMOHONAN -->
    <x-admin.modal id="modalStatusArsip" title="Ubah Status Permohonan Penelusuran" size="md">
        <form method="POST" id="formStatusArsip" action="{{ route('admin.kearsipan.permohonan.status', 1) }}">
            @csrf
            <div style="background: var(--bg-admin); padding: 14px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); margin-bottom: 16px;">
                <div style="font-size: 0.74rem; font-weight: 700; color: var(--text-muted);">NOMOR TIKET: <span id="spanTiket" style="color: var(--primary);"></span></div>
                <h4 style="font-family: var(--font-heading); font-size: 0.95rem; font-weight: 700; color: var(--text-dark); margin: 4px 0;" id="spanPemohon"></h4>
                <div style="font-size: 0.78rem; color: var(--text-muted);" id="spanJudul"></div>
            </div>

            <x-admin.form-select name="status" label="Status Tindak Lanjut" required>
                <option value="Diproses">Diproses (Sedang dalam pencarian berkas)</option>
                <option value="Revisi Berkas">Revisi Berkas (Syarat pengantar belum lengkap)</option>
                <option value="Selesai">Selesai (Naskah siap diakses / dikirim)</option>
            </x-admin.form-select>

            <div style="margin-top: 14px;">
                <x-admin.form-input name="catatan_arsiparis" label="Pesan / Rekomendasi Arsiparis" placeholder="Tuliskan nomor register arsip atau catatan revisi..." />
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Simpan Perubahan</button>
            </div>
        </form>
    </x-admin.modal>

    @push('scripts')
    <script>
        function ubahStatusArsip(item) {
            document.getElementById('spanTiket').textContent = item.nomor_tiket;
            document.getElementById('spanPemohon').textContent = `${item.nama} (${item.institusi})`;
            document.getElementById('spanJudul').textContent = item.judul;
            const form = document.getElementById('formStatusArsip');
            form.action = `/admin/kearsipan/permohonan/${item.id}/status`;
            openAdminModal('modalStatusArsip');
        }
    </script>
    @endpush
</x-admin.layout>

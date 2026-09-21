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
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
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

    <!-- Data Table Card (Linear/Supabase Style) -->
    <x-admin.data-table
        title="Daftar Permohonan Riset Arsip Masuk"
        subtitle="Berkas permohonan penelusuran dokumen sejarah oleh akademisi, instansi, dan masyarakat umum"
        searchPlaceholder="Cari nama, institusi, tiket..."
    >
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 140px;">No. Tiket</th>
                    <th>Nama Pemohon</th>
                    <th>Institusi / Universitas</th>
                    <th>Judul Penelitian & Fokus Riset</th>
                    <th>Surat Pengantar</th>
                    <th>Status Berkas</th>
                    <th style="width: 160px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permohonanList as $p)
                    <tr>
                        <td>
                            <span style="font-family: var(--font-mono); font-weight: 700; color: var(--primary); font-size: 0.82rem;">
                                {{ $p['nomor_tiket'] }}
                            </span>
                            <div style="font-size: 0.72rem; color: var(--text-muted); font-family: var(--font-mono);">{{ $p['tanggal'] }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: var(--text-dark);">{{ $p['nama'] }}</div>
                            <div style="font-size: 0.74rem; color: var(--text-muted);">{{ $p['email'] }}</div>
                        </td>
                        <td>
                            <span style="font-weight: 500;">{{ $p['institusi'] }}</span>
                        </td>
                        <td>
                            <div style="font-size: 0.84rem; font-weight: 600; color: var(--text-dark); max-width: 300px;" title="{{ $p['judul'] }}">
                                {{ $p['judul'] }}
                            </div>
                        </td>
                        <td>
                            <button type="button" class="admin-btn admin-btn--sm admin-btn--secondary" data-view-pdf="{{ $p['surat_pengantar'] }}" style="gap: 6px; font-size: 0.75rem; border-radius: 8px;">
                                <i data-lucide="file-text" style="width: 14px; height: 14px; color: var(--primary);"></i>
                                <span>{{ substr($p['surat_pengantar'], 0, 14) }}...</span>
                            </button>
                        </td>
                        <td>
                            <x-admin.status-badge :status="$p['status']" />
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <!-- Lihat PDF -->
                                <button type="button" class="btn-table-action" title="Lihat PDF Dokumen" data-view-pdf="{{ $p['surat_pengantar'] }}">
                                    <i data-lucide="file-check-2" style="width: 14px; height: 14px;"></i>
                                </button>
                                <!-- Unduh PDF -->
                                <button type="button" class="btn-table-action" title="Unduh PDF Berkas" data-download-pdf="{{ $p['surat_pengantar'] }}">
                                    <i data-lucide="download" style="width: 14px; height: 14px;"></i>
                                </button>
                                <!-- Ubah Status -->
                                <button type="button" class="btn-table-action" title="Ubah Status Permohonan" onclick="ubahStatusArsip({{ json_encode($p) }})">
                                    <i data-lucide="check-square" style="width: 14px; height: 14px;"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="admin-empty-state">
                                <i data-lucide="folder-search" style="width: 44px; height: 44px; color: var(--text-muted);"></i>
                                <div class="admin-empty-title">Tidak ada permohonan arsip</div>
                                <p class="admin-empty-desc">Tidak ditemukan data pengajuan dengan status ini.</p>
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
            <div style="background: var(--bg-admin); padding: 16px; border-radius: 14px; border: 1px solid var(--border-color); margin-bottom: 18px;">
                <div style="font-size: 0.72rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">NOMOR TIKET: <span id="spanTiket" style="color: var(--primary); font-family: var(--font-mono);"></span></div>
                <h4 style="font-family: var(--font-heading); font-size: 0.95rem; font-weight: 800; color: var(--text-dark); margin: 4px 0;" id="spanPemohon"></h4>
                <div style="font-size: 0.8rem; color: var(--text-muted);" id="spanJudul"></div>
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
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="check" style="width: 16px; height: 16px;"></i>
                    <span>Simpan Perubahan</span>
                </button>
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

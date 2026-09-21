<x-admin.layout title="SI ULAN (Sistem Usulan Buku) | Manajemen Perpustakaan">
    <!-- Page Header -->
    <x-admin.page-header
        title="SI ULAN (Sistem Usulan Buku)"
        subtitle="Verifikasi dan tindak lanjuti usulan pengadaan buku baru yang diajukan oleh masyarakat Kota Semarang."
        :breadcrumbs="[
            ['label' => 'Perpustakaan', 'url' => route('admin.perpustakaan.buku')],
            ['label' => 'Usulan Buku (SI ULAN)']
        ]"
    >
        <x-slot:actions>
            <div style="display: flex; gap: 8px;">
                <a href="{{ route('admin.perpustakaan.usulan') }}" class="admin-btn admin-btn--sm {{ !request('status') ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Semua ({{ count($usulanList) }})
                </a>
                <a href="{{ route('admin.perpustakaan.usulan', ['status' => 'Menunggu Validasi']) }}" class="admin-btn admin-btn--sm {{ request('status') === 'Menunggu Validasi' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Menunggu Validasi
                </a>
                <a href="{{ route('admin.perpustakaan.usulan', ['status' => 'Disetujui']) }}" class="admin-btn admin-btn--sm {{ request('status') === 'Disetujui' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Disetujui
                </a>
                <a href="{{ route('admin.perpustakaan.usulan', ['status' => 'Tersedia']) }}" class="admin-btn admin-btn--sm {{ request('status') === 'Tersedia' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Tersedia
                </a>
            </div>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Data Table Card -->
    <x-admin.data-table
        title="Daftar Pengajuan Usulan Buku"
        subtitle="Verifikasi permohonan pengadaan buku baru untuk koleksi perpustakaan"
        searchPlaceholder="Cari nama pengusul, judul..."
    >
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Pengusul</th>
                    <th>Judul Buku & Pengarang</th>
                    <th>Alasan Pengusulan</th>
                    <th>Tanggal Masuk</th>
                    <th>Status Pengadaan</th>
                    <th style="width: 140px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usulanList as $index => $usulan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div style="font-weight: 700; color: var(--text-dark);">{{ $usulan['nama'] }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $usulan['email'] }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: var(--primary);">{{ $usulan['judul'] }}</div>
                            <div style="font-size: 0.74rem; color: var(--text-muted);">Pengarang: {{ $usulan['pengarang'] }} ({{ $usulan['penerbit'] }})</div>
                        </td>
                        <td>
                            <div style="font-size: 0.82rem; color: var(--text-body); max-width: 280px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $usulan['alasan'] }}">
                                {{ $usulan['alasan'] }}
                            </div>
                        </td>
                        <td style="font-size: 0.78rem; color: var(--text-muted); white-space: nowrap;">
                            {{ $usulan['tanggal'] }}
                        </td>
                        <td>
                            <x-admin.status-badge :status="$usulan['status']" />
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <!-- Ubah Status Button -->
                                <button type="button" class="btn-table-action" title="Ubah Status Usulan" onclick="bukaModalStatus({{ json_encode($usulan) }})">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                </button>
                                <!-- Detail Modal Button -->
                                <button type="button" class="btn-table-action" title="Detail Lengkap" onclick="bukaModalDetailUsulan({{ json_encode($usulan) }})">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="admin-empty-state">
                                <p>Tidak ada usulan buku dengan status ini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-admin.data-table>

    <!-- 1. MODAL UBAH STATUS -->
    <x-admin.modal id="ubahStatusModal" title="Ubah Status Usulan Buku" size="md">
        <form method="POST" id="formUbahStatus" action="{{ route('admin.perpustakaan.usulan.status', 1) }}">
            @csrf
            <div style="margin-bottom: 16px;">
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 4px;">Judul Buku yang Diusulkan:</p>
                <h4 style="font-family: var(--font-heading); font-size: 1rem; font-weight: 700; color: var(--text-dark);" id="modalStatusJudul">Judul Buku</h4>
            </div>

            <x-admin.form-select name="status" label="Pilih Status Baru" required>
                <option value="Menunggu Validasi">Menunggu Validasi</option>
                <option value="Disetujui">Disetujui</option>
                <option value="Akan Dibeli">Akan Dibeli</option>
                <option value="Tersedia">Tersedia</option>
            </x-admin.form-select>

            <div style="margin-top: 14px;">
                <x-admin.form-input name="catatan_admin" label="Catatan Pustakawan (Opsional)" placeholder="Contoh: Telah dimasukkan ke daftar belanja anggaran DPA..." />
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Simpan Status</button>
            </div>
        </form>
    </x-admin.modal>

    <!-- 2. MODAL DETAIL USULAN -->
    <x-admin.modal id="detailUsulanModal" title="Detail Usulan Pengadaan Buku" size="md">
        <div id="detailUsulanContent" style="display: flex; flex-direction: column; gap: 14px;"></div>
        <x-slot:footer>
            <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Tutup</button>
        </x-slot:footer>
    </x-admin.modal>

    @push('scripts')
    <script>
        function bukaModalStatus(usulan) {
            document.getElementById('modalStatusJudul').textContent = usulan.judul;
            const form = document.getElementById('formUbahStatus');
            form.action = `/admin/perpustakaan/usulan/${usulan.id}/status`;
            openAdminModal('ubahStatusModal');
        }

        function bukaModalDetailUsulan(usulan) {
            const container = document.getElementById('detailUsulanContent');
            container.innerHTML = `
                <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
                    <div style="font-size: 0.74rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Diusulkan Oleh</div>
                    <div style="font-size: 1rem; font-weight: 700; color: var(--text-dark);">${usulan.nama} (${usulan.email})</div>
                    <div style="font-size: 0.76rem; color: var(--text-muted);">Tanggal: ${usulan.tanggal}</div>
                </div>
                <div style="background: var(--bg-admin); padding: 14px; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                    <div style="font-size: 0.74rem; font-weight: 700; color: var(--text-muted);">Informasi Buku:</div>
                    <h4 style="font-family: var(--font-heading); font-size: 1.05rem; font-weight: 800; color: var(--primary); margin: 4px 0;">${usulan.judul}</h4>
                    <div style="font-size: 0.82rem;">Pengarang: <strong>${usulan.pengarang}</strong></div>
                    <div style="font-size: 0.82rem;">Penerbit: <strong>${usulan.penerbit}</strong></div>
                    <div style="margin-top: 8px;">Status Saat Ini: <span class="status-badge status-badge--info">${usulan.status}</span></div>
                </div>
                <div>
                    <div style="font-size: 0.76rem; font-weight: 700; color: var(--text-muted); margin-bottom: 4px;">Alasan Pengusulan:</div>
                    <p style="font-size: 0.84rem; color: var(--text-body); background: #ffffff; border: 1px solid var(--border-color); padding: 12px; border-radius: var(--radius-sm); line-height: 1.5;">${usulan.alasan}</p>
                </div>
            `;
            openAdminModal('detailUsulanModal');
        }
    </script>
    @endpush
</x-admin.layout>

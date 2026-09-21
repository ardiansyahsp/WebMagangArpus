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
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <a href="{{ route('admin.perpustakaan.usulan') }}" class="admin-btn admin-btn--sm {{ !request('status') ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Semua ({{ count($usulanList) }})
                </a>
                <a href="{{ route('admin.perpustakaan.usulan', ['status' => 'Menunggu Validasi']) }}" class="admin-btn admin-btn--sm {{ request('status') === 'Menunggu Validasi' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Menunggu Validasi
                </a>
                <a href="{{ route('admin.perpustakaan.usulan', ['status' => 'Disetujui']) }}" class="admin-btn admin-btn--sm {{ request('status') === 'Disetujui' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Disetujui
                </a>
                <a href="{{ route('admin.perpustakaan.usulan', ['status' => 'Akan Dibeli']) }}" class="admin-btn admin-btn--sm {{ request('status') === 'Akan Dibeli' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Akan Dibeli
                </a>
                <a href="{{ route('admin.perpustakaan.usulan', ['status' => 'Tersedia']) }}" class="admin-btn admin-btn--sm {{ request('status') === 'Tersedia' ? 'admin-btn--primary' : 'admin-btn--secondary' }}">
                    Tersedia
                </a>
            </div>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Data Table Card (Linear Issue Tracking Style) -->
    <x-admin.data-table
        title="Daftar Pengajuan Usulan Buku"
        subtitle="Verifikasi permohonan pengadaan buku baru untuk koleksi perpustakaan"
        searchPlaceholder="Cari nama pengusul, judul buku, email..."
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
                    <th style="width: 120px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usulanList as $index => $usulan)
                    <tr>
                        <td style="font-family: var(--font-mono); color: var(--text-muted);">{{ $index + 1 }}</td>
                        <td>
                            <div style="font-weight: 700; color: var(--text-dark);">{{ $usulan['nama'] }}</div>
                            <div style="font-size: 0.74rem; color: var(--text-muted);">{{ $usulan['email'] }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: var(--primary);">{{ $usulan['judul'] }}</div>
                            <div style="font-size: 0.74rem; color: var(--text-muted);">Pengarang: <strong>{{ $usulan['pengarang'] }}</strong> ({{ $usulan['penerbit'] }})</div>
                        </td>
                        <td>
                            <div style="font-size: 0.82rem; color: var(--text-body); max-width: 260px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $usulan['alasan'] }}">
                                {{ $usulan['alasan'] }}
                            </div>
                        </td>
                        <td style="font-size: 0.78rem; color: var(--text-muted); font-family: var(--font-mono); white-space: nowrap;">
                            {{ $usulan['tanggal'] }}
                        </td>
                        <td>
                            <x-admin.status-badge :status="$usulan['status']" />
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <!-- Ubah Status Button -->
                                <button type="button" class="btn-table-action" title="Ubah Status Workflow" onclick="bukaModalStatus({{ json_encode($usulan) }})">
                                    <i data-lucide="check-square" style="width: 14px; height: 14px;"></i>
                                </button>
                                <!-- Detail Modal Button -->
                                <button type="button" class="btn-table-action" title="Detail Lengkap" onclick="bukaModalDetailUsulan({{ json_encode($usulan) }})">
                                    <i data-lucide="info" style="width: 14px; height: 14px;"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="admin-empty-state">
                                <i data-lucide="inbox" style="width: 44px; height: 44px; color: var(--text-muted);"></i>
                                <div class="admin-empty-title">Tidak ada usulan buku</div>
                                <p class="admin-empty-desc">Tidak ditemukan data pengajuan dengan filter ini.</p>
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
            <div style="margin-bottom: 18px; background: var(--bg-admin); padding: 14px; border-radius: 12px; border: 1px solid var(--border-color);">
                <span style="font-size: 0.72rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Judul Buku yang Diusulkan</span>
                <h4 style="font-family: var(--font-heading); font-size: 1rem; font-weight: 800; color: var(--primary); margin-top: 2px;" id="modalStatusJudul">Judul Buku</h4>
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
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="check" style="width: 16px; height: 16px;"></i>
                    <span>Simpan Status</span>
                </button>
            </div>
        </form>
    </x-admin.modal>

    <!-- 2. MODAL DETAIL USULAN -->
    <x-admin.modal id="detailUsulanModal" title="Detail Pengajuan Usulan Buku" size="md">
        <div id="detailUsulanContent" style="display: flex; flex-direction: column; gap: 16px;"></div>
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
                <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 14px;">
                    <div style="font-size: 0.72rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Diusulkan Oleh</div>
                    <div style="font-size: 1rem; font-weight: 800; color: var(--text-dark);">${usulan.nama}</div>
                    <div style="font-size: 0.78rem; color: var(--text-muted);">${usulan.email} • Tanggal: ${usulan.tanggal}</div>
                </div>
                <div style="background: var(--bg-admin); padding: 16px; border-radius: 14px; border: 1px solid var(--border-color);">
                    <div style="font-size: 0.72rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Informasi Buku:</div>
                    <h4 style="font-family: var(--font-heading); font-size: 1.05rem; font-weight: 800; color: var(--primary); margin: 4px 0;">${usulan.judul}</h4>
                    <div style="font-size: 0.84rem; color: var(--text-body);">Pengarang: <strong>${usulan.pengarang}</strong></div>
                    <div style="font-size: 0.84rem; color: var(--text-body);">Penerbit: <strong>${usulan.penerbit}</strong></div>
                    <div style="margin-top: 10px;">Status: <span class="status-badge status-badge--info">${usulan.status}</span></div>
                </div>
                <div>
                    <div style="font-size: 0.76rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px;">Alasan Pengusulan:</div>
                    <p style="font-size: 0.84rem; color: var(--text-body); background: var(--bg-card); border: 1px solid var(--border-light); padding: 14px; border-radius: 10px; line-height: 1.6;">${usulan.alasan}</p>
                </div>
            `;
            openAdminModal('detailUsulanModal');
        }
    </script>
    @endpush
</x-admin.layout>

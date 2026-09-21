<x-admin.layout title="Jadwal Perpustakaan Keliling | Manajemen Perpustakaan">
    <!-- Page Header -->
    <x-admin.page-header
        title="Jadwal Perpustakaan Keliling"
        subtitle="Kelola agenda kunjungan armada mobil perpustakaan keliling dan status kesiapan kendaraan."
        :breadcrumbs="[
            ['label' => 'Perpustakaan', 'url' => route('admin.perpustakaan.buku')],
            ['label' => 'Jadwal Keliling']
        ]"
    >
        <x-slot:actions>
            <button type="button" class="admin-btn admin-btn--primary" data-modal-target="tambahJadwalModal">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Tambah Jadwal Baru</span>
            </button>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Data Table Card -->
    <x-admin.data-table
        title="Agenda Kunjungan Armada"
        subtitle="Daftar jadwal operasional layanan mobil perpustakaan keliling"
        searchPlaceholder="Cari lokasi, petugas..."
    >
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Tanggal & Waktu</th>
                    <th>Lokasi Kunjungan</th>
                    <th>Armada Mobil</th>
                    <th>Petugas Lapangan</th>
                    <th>Status Armada</th>
                    <th style="width: 120px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwalList as $index => $jadwal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div style="font-weight: 700; color: var(--text-dark);">{{ $jadwal['tanggal_formatted'] }}</div>
                            <div style="font-size: 0.74rem; color: var(--text-muted); display: inline-flex; align-items: center; gap: 4px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                {{ $jadwal['jam'] }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--primary);">{{ $jadwal['lokasi'] }}</div>
                        </td>
                        <td>
                            <span style="font-weight: 500;">{{ $jadwal['armada_nama'] }}</span>
                        </td>
                        <td>
                            <div style="font-size: 0.82rem;">{{ $jadwal['petugas'] }}</div>
                            <div style="font-size: 0.72rem; color: var(--text-muted);">Kontak: {{ $jadwal['kontak'] }}</div>
                        </td>
                        <td>
                            <x-admin.status-badge :status="$jadwal['status_armada']" />
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <button type="button" class="btn-table-action" title="Edit Jadwal" onclick="editJadwal({{ json_encode($jadwal) }})">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </button>
                                <form method="POST" action="{{ route('admin.perpustakaan.jadwal.destroy', $jadwal['id']) }}" onsubmit="return confirm('Hapus jadwal keliling ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-table-action btn-table-action--delete" title="Hapus Jadwal">
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
                                <p>Belum ada jadwal yang terdaftar.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-admin.data-table>

    <!-- 1. MODAL TAMBAH JADWAL -->
    <x-admin.modal id="tambahJadwalModal" title="Tambah Jadwal Perpustakaan Keliling" size="md">
        <form method="POST" action="{{ route('admin.perpustakaan.jadwal.store') }}">
            @csrf
            <div class="admin-form-grid">
                <x-admin.form-input name="tanggal" label="Tanggal Pelaksanaan" type="date" required />
                <x-admin.form-input name="jam" label="Jam Operasional" placeholder="Contoh: 08:30 - 11:30 WIB" required />
                <x-admin.form-input name="lokasi" label="Lokasi / Titik Singgah" placeholder="Contoh: SDN 01 Ngaliyan" required />
                <x-admin.form-input name="armada_nama" label="Nama & Nomor Polisi Armada" placeholder="Contoh: Pusling Unit 1 (H 9541 XA)" required />
                <x-admin.form-input name="petugas" label="Petugas yang Bertugas" placeholder="Contoh: Agus & Bambang" required />

                <x-admin.form-select name="status_armada" label="Status Kesiapan Armada" required>
                    <option value="Beroperasi">Beroperasi</option>
                    <option value="Pemeliharaan">Pemeliharaan</option>
                </x-admin.form-select>
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Simpan Jadwal</button>
            </div>
        </form>
    </x-admin.modal>

    <!-- 2. MODAL EDIT JADWAL -->
    <x-admin.modal id="editJadwalModal" title="Edit Jadwal Keliling" size="md">
        <form method="POST" id="formEditJadwal" action="{{ route('admin.perpustakaan.jadwal.update', 1) }}">
            @csrf
            @method('PUT')
            <div class="admin-form-grid">
                <x-admin.form-input name="edit_tanggal" id="edit_tanggal" label="Tanggal" type="text" required />
                <x-admin.form-input name="edit_jam" id="edit_jam" label="Jam Operasional" required />
                <x-admin.form-input name="edit_lokasi" id="edit_lokasi" label="Lokasi" required />
                <x-admin.form-input name="edit_armada" id="edit_armada" label="Armada" required />
                <x-admin.form-select name="edit_status" id="edit_status" label="Status Armada" required>
                    <option value="Beroperasi">Beroperasi</option>
                    <option value="Pemeliharaan">Pemeliharaan</option>
                </x-admin.form-select>
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Perbarui</button>
            </div>
        </form>
    </x-admin.modal>

    @push('scripts')
    <script>
        function editJadwal(jadwal) {
            document.getElementById('edit_tanggal').value = jadwal.tanggal_formatted;
            document.getElementById('edit_jam').value = jadwal.jam;
            document.getElementById('edit_lokasi').value = jadwal.lokasi;
            document.getElementById('edit_armada').value = jadwal.armada_nama;
            document.getElementById('edit_status').value = jadwal.status_armada;
            openAdminModal('editJadwalModal');
        }
    </script>
    @endpush
</x-admin.layout>

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
                <i data-lucide="plus" style="width: 16px; height: 16px;"></i>
                <span>Tambah Jadwal Baru</span>
            </button>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Data Table Card (Supabase Style) -->
    <x-admin.data-table
        title="Agenda Kunjungan Armada"
        subtitle="Daftar jadwal operasional layanan mobil perpustakaan keliling"
        searchPlaceholder="Cari lokasi, petugas, armada..."
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
                        <td style="font-family: var(--font-mono); color: var(--text-muted);">{{ $index + 1 }}</td>
                        <td>
                            <div style="font-weight: 700; color: var(--text-dark);">{{ $jadwal['tanggal_formatted'] }}</div>
                            <div style="font-size: 0.74rem; color: var(--text-muted); display: inline-flex; align-items: center; gap: 4px; font-weight: 500; margin-top: 2px;">
                                <i data-lucide="clock" style="width: 12px; height: 12px;"></i>
                                <span>{{ $jadwal['jam'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--primary);">{{ $jadwal['lokasi'] }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 500; display: flex; align-items: center; gap: 6px;">
                                <i data-lucide="truck" style="width: 14px; height: 14px; color: var(--accent-gold-dark);"></i>
                                <span>{{ $jadwal['armada_nama'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.84rem; font-weight: 500;">{{ $jadwal['petugas'] }}</div>
                            <div style="font-size: 0.72rem; color: var(--text-muted); font-family: var(--font-mono);">Telp: {{ $jadwal['kontak'] }}</div>
                        </td>
                        <td>
                            <x-admin.status-badge :status="$jadwal['status_armada']" />
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <button type="button" class="btn-table-action" title="Edit Jadwal" onclick="editJadwal({{ json_encode($jadwal) }})">
                                    <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i>
                                </button>
                                <form method="POST" action="{{ route('admin.perpustakaan.jadwal.destroy', $jadwal['id']) }}" onsubmit="return confirm('Hapus jadwal keliling ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-table-action btn-table-action--delete" title="Hapus Jadwal">
                                        <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="admin-empty-state">
                                <i data-lucide="calendar-x" style="width: 44px; height: 44px; color: var(--text-muted);"></i>
                                <div class="admin-empty-title">Belum ada agenda jadwal</div>
                                <p class="admin-empty-desc">Klik Tambah Jadwal Baru untuk membuat agenda operasional.</p>
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
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="check" style="width: 16px; height: 16px;"></i>
                    <span>Simpan Jadwal</span>
                </button>
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
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i>
                    <span>Perbarui</span>
                </button>
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

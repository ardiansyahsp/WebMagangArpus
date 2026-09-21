<x-admin.layout title="Manajemen Pengguna & Hak Akses | Pengaturan Sistem">
    <!-- Page Header -->
    <x-admin.page-header
        title="Manajemen Pengguna"
        subtitle="Kelola akun pegawai, pembagian peran akses (Super Admin, Pustakawan, Arsiparis), dan audit keamanan sistem."
        :breadcrumbs="[
            ['label' => 'Pengaturan', 'url' => route('admin.pengaturan.kategori')],
            ['label' => 'Pengguna']
        ]"
    >
        <x-slot:actions>
            <button type="button" class="admin-btn admin-btn--primary" data-modal-target="tambahPenggunaModal">
                <i data-lucide="user-plus" style="width: 16px; height: 16px;"></i>
                <span>Tambah Pengguna Baru</span>
            </button>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Data Table Card (Linear/Supabase Style) -->
    <x-admin.data-table
        title="Daftar Akun Pegawai & Administrator"
        subtitle="Total {{ count($penggunaList) }} akun pengguna terdaftar dengan hak akses CMS Arpusda"
        searchPlaceholder="Cari nama, email, jabatan..."
    >
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Nama Pegawai & Akun</th>
                    <th>Email Kedinasan</th>
                    <th>Jabatan Struktural / Fungsional</th>
                    <th>Peran Akses (Role)</th>
                    <th>Status Akun</th>
                    <th>Aktivitas Terakhir</th>
                    <th style="width: 120px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penggunaList as $index => $user)
                    <tr>
                        <td style="font-family: var(--font-mono); font-weight: 700; color: var(--text-muted);">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="position: relative; flex-shrink: 0;">
                                    <div style="width: 38px; height: 38px; border-radius: 12px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #ffffff; display: flex; align-items: center; justify-content: center; font-family: var(--font-heading); font-weight: 800; font-size: 0.9rem; box-shadow: 0 4px 10px rgba(139, 0, 0, 0.25);">
                                        {{ strtoupper(substr($user['nama'], 0, 1)) }}
                                    </div>
                                    <span style="position: absolute; bottom: -2px; right: -2px; width: 10px; height: 10px; border-radius: 50%; background: {{ $user['status'] === 'Aktif' ? '#10b981' : '#ef4444' }}; border: 2px solid var(--bg-card);"></span>
                                </div>
                                <div>
                                    <div style="font-weight: 700; color: var(--text-dark); font-size: 0.88rem;">{{ $user['nama'] }}</div>
                                    <div style="font-size: 0.74rem; color: var(--text-muted); font-family: var(--font-mono);">@ {{ $user['username'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 0.82rem; color: var(--text-body);">
                                <i data-lucide="mail" style="width: 13px; height: 13px; color: var(--text-muted);"></i>
                                <span>{{ $user['email'] }}</span>
                            </div>
                        </td>
                        <td>
                            <span style="font-size: 0.82rem; font-weight: 500; color: var(--text-dark);">{{ $user['jabatan'] }}</span>
                        </td>
                        <td>
                            <x-admin.status-badge :status="$user['role']" />
                        </td>
                        <td>
                            <x-admin.status-badge :status="$user['status']" />
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 5px; font-size: 0.76rem; color: var(--text-muted); font-family: var(--font-mono);">
                                <i data-lucide="clock" style="width: 12px; height: 12px;"></i>
                                <span>{{ $user['terakhir_login'] }}</span>
                            </div>
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <button type="button" class="btn-table-action" title="Edit Akun Pegawai" onclick="editUser({{ json_encode($user) }})">
                                    <i data-lucide="pencil" style="width: 14px; height: 14px;"></i>
                                </button>
                                @if($user['username'] !== 'admin')
                                    <form method="POST" action="{{ route('admin.pengaturan.pengguna.destroy', $user['id']) }}" onsubmit="return confirm('Nonaktifkan akun pengguna ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table-action btn-table-action--delete" title="Nonaktifkan Akun">
                                            <i data-lucide="user-x" style="width: 14px; height: 14px;"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="admin-empty-state">
                                <i data-lucide="users" style="width: 44px; height: 44px; color: var(--text-muted);"></i>
                                <div class="admin-empty-title">Tidak ada data pengguna</div>
                                <p class="admin-empty-desc">Belum ada akun pegawai yang terdaftar dalam sistem.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-admin.data-table>

    <!-- 1. MODAL TAMBAH PENGGUNA -->
    <x-admin.modal id="tambahPenggunaModal" title="Tambah Pengguna Baru" size="lg">
        <form method="POST" action="{{ route('admin.pengaturan.pengguna.store') }}">
            @csrf
            <div class="admin-form-grid admin-form-grid--2col">
                <x-admin.form-input name="nama" label="Nama Lengkap Pegawai" placeholder="Contoh: Budi Santoso, S.STP" required />
                <x-admin.form-input name="username" label="Username Akun" placeholder="Contoh: budi.pustakawan" required />
                <x-admin.form-input name="email" label="Alamat Email Kedinasan" type="email" placeholder="nama@arpusda.semarangkota.go.id" required />
                <x-admin.form-input name="jabatan" label="Jabatan Pegawai" placeholder="Contoh: Pustakawan Ahli Pertama" required />
                
                <x-admin.form-select name="role" label="Peran Wewenang (Role)" required>
                    <option value="Super Admin">Super Admin (Akses Penuh Seluruh Modul)</option>
                    <option value="Pustakawan">Pustakawan (Katalog, Usulan, Jadwal)</option>
                    <option value="Arsiparis">Arsiparis (Permohonan & Galeri Arsip)</option>
                </x-admin.form-select>

                <x-admin.form-input name="password" label="Kata Sandi Sementara" type="password" value="admin123" required helper="Minimal 6 karakter kombinasi" />
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="user-check" style="width: 16px; height: 16px;"></i>
                    <span>Daftarkan Pengguna</span>
                </button>
            </div>
        </form>
    </x-admin.modal>

    <!-- 2. MODAL EDIT PENGGUNA -->
    <x-admin.modal id="editPenggunaModal" title="Edit Data Pengguna" size="md">
        <form method="POST" id="formEditPengguna" action="{{ route('admin.pengaturan.pengguna.update', 1) }}">
            @csrf
            @method('PUT')
            <div class="admin-form-grid">
                <x-admin.form-input name="edit_nama_user" id="edit_nama_user" label="Nama Lengkap" required />
                <x-admin.form-input name="edit_email_user" id="edit_email_user" label="Email Kedinasan" type="email" required />
                <x-admin.form-input name="edit_jabatan_user" id="edit_jabatan_user" label="Jabatan Struktural / Fungsional" required />
                <x-admin.form-select name="edit_role_user" id="edit_role_user" label="Peran Wewenang (Role)" required>
                    <option value="Super Admin">Super Admin</option>
                    <option value="Pustakawan">Pustakawan</option>
                    <option value="Arsiparis">Arsiparis</option>
                </x-admin.form-select>
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </x-admin.modal>

    @push('scripts')
    <script>
        function editUser(user) {
            document.getElementById('edit_nama_user').value = user.nama;
            document.getElementById('edit_email_user').value = user.email;
            document.getElementById('edit_jabatan_user').value = user.jabatan;
            document.getElementById('edit_role_user').value = user.role;
            const form = document.getElementById('formEditPengguna');
            form.action = `/admin/pengaturan/pengguna/${user.id}`;
            openAdminModal('editPenggunaModal');
        }
    </script>
    @endpush
</x-admin.layout>

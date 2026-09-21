<x-admin.layout title="Manajemen Pengguna & Hak Akses | Pengaturan Sistem">
    <!-- Page Header -->
    <x-admin.page-header
        title="Manajemen Pengguna"
        subtitle="Kelola akun pegawai, pembagian peran akses (Super Admin, Pustakawan, Arsiparis), dan keamanan sistem."
        :breadcrumbs="[
            ['label' => 'Pengaturan', 'url' => route('admin.pengaturan.kategori')],
            ['label' => 'Pengguna']
        ]"
    >
        <x-slot:actions>
            <button type="button" class="admin-btn admin-btn--primary" data-modal-target="tambahPenggunaModal">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
                <span>Tambah Pengguna Baru</span>
            </button>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Data Table Card -->
    <x-admin.data-table
        title="Daftar Akun Pegawai & Administrator"
        subtitle="Total {{ count($penggunaList) }} pengguna terdaftar dengan wewenang akses CMS"
        searchPlaceholder="Cari nama, email, jabatan..."
    >
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Pegawai & Username</th>
                    <th>Email Resmi</th>
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
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-family: var(--font-heading); font-weight: 700; font-size: 0.8rem; flex-shrink: 0;">
                                    {{ strtoupper(substr($user['nama'], 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 700; color: var(--text-dark);">{{ $user['nama'] }}</div>
                                    <div style="font-size: 0.74rem; color: var(--text-muted); font-family: monospace;">@ {{ $user['username'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="font-size: 0.82rem; color: var(--text-body);">{{ $user['email'] }}</span>
                        </td>
                        <td>
                            <span style="font-size: 0.82rem; font-weight: 500;">{{ $user['jabatan'] }}</span>
                        </td>
                        <td>
                            <x-admin.status-badge :status="$user['role']" />
                        </td>
                        <td>
                            <x-admin.status-badge :status="$user['status']" />
                        </td>
                        <td style="font-size: 0.76rem; color: var(--text-muted);">
                            {{ $user['terakhir_login'] }}
                        </td>
                        <td style="text-align: right;">
                            <div class="action-buttons" style="justify-content: flex-end;">
                                <button type="button" class="btn-table-action" title="Edit Akun" onclick="editUser({{ json_encode($user) }})">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </button>
                                @if($user['username'] !== 'admin')
                                    <form method="POST" action="{{ route('admin.pengaturan.pengguna.destroy', $user['id']) }}" onsubmit="return confirm('Nonaktifkan akun pengguna ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table-action btn-table-action--delete" title="Nonaktifkan User">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
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
                                <p>Tidak ada data pengguna.</p>
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

                <x-admin.form-input name="password" label="Kata Sandi Sementara" type="password" value="admin123" required helper="Minimal 6 karakter" />
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Daftarkan Pengguna</button>
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
                <x-admin.form-input name="edit_email_user" id="edit_email_user" label="Email" type="email" required />
                <x-admin.form-input name="edit_jabatan_user" id="edit_jabatan_user" label="Jabatan" required />
                <x-admin.form-select name="edit_role_user" id="edit_role_user" label="Role" required>
                    <option value="Super Admin">Super Admin</option>
                    <option value="Pustakawan">Pustakawan</option>
                    <option value="Arsiparis">Arsiparis</option>
                </x-admin.form-select>
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="admin-btn admin-btn--secondary" data-modal-close>Batal</button>
                <button type="submit" class="admin-btn admin-btn--primary">Simpan Perubahan</button>
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
            openAdminModal('editPenggunaModal');
        }
    </script>
    @endpush
</x-admin.layout>

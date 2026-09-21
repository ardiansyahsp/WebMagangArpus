<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminCmsTest extends TestCase
{
    /**
     * Test public navbar contains Login Admin button.
     */
    public function test_navbar_contains_login_admin_button(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(route('admin.login'));
        $response->assertSee('Login Admin');
    }

    /**
     * Test unauthenticated access to admin dashboard redirects to login.
     */
    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * Test admin login page renders successfully.
     */
    public function test_admin_login_page_renders(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('LOGIN ADMIN CMS');
        $response->assertSee('Username atau Email');
        $response->assertSee('Kata Sandi');
    }

    /**
     * Test login submission with dummy authentication.
     */
    public function test_admin_login_submission_succeeds(): void
    {
        $response = $this->post('/admin/login', [
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertTrue(session('admin_logged_in') === true);
    }

    /**
     * Test all protected admin routes render 200 OK for authenticated session.
     */
    public function test_all_admin_modules_render_successfully(): void
    {
        $authenticatedSession = [
            'admin_logged_in' => true,
            'admin_user' => [
                'name' => 'Administrator Arpusda',
                'role' => 'Super Admin',
                'email' => 'admin@arpusda.semarangkota.go.id',
                'jabatan' => 'Pranata Komputer Ahli Muda',
            ],
        ];

        // 1. Dashboard Utama
        $response = $this->withSession($authenticatedSession)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Utama');
        $response->assertSee('Total Koleksi Buku');
        $response->assertSee('Total Arsip Sejarah');
        $response->assertSee('Jadwal Perpustakaan Keliling Terdekat');

        // 2. Perpustakaan - Buku (OPAC)
        $response = $this->withSession($authenticatedSession)->get('/admin/perpustakaan/buku');
        $response->assertStatus(200);
        $response->assertSee('Katalog Buku (OPAC)');
        $response->assertSee('Sapiens: Riwayat Singkat Umat Manusia');

        // 3. Perpustakaan - SI ULAN
        $response = $this->withSession($authenticatedSession)->get('/admin/perpustakaan/usulan');
        $response->assertStatus(200);
        $response->assertSee('SI ULAN');
        $response->assertSee('Menunggu Validasi');

        // 4. Perpustakaan - Jadwal Keliling
        $response = $this->withSession($authenticatedSession)->get('/admin/perpustakaan/jadwal-keliling');
        $response->assertStatus(200);
        $response->assertSee('Jadwal Perpustakaan Keliling');
        $response->assertSee('Beroperasi');

        // 5. Kearsipan - Permohonan
        $response = $this->withSession($authenticatedSession)->get('/admin/kearsipan/permohonan');
        $response->assertStatus(200);
        $response->assertSee('Permohonan Penelusuran Arsip');
        $response->assertSee('Diproses');

        // 6. Kearsipan - Galeri Sejarah
        $response = $this->withSession($authenticatedSession)->get('/admin/kearsipan/galeri');
        $response->assertStatus(200);
        $response->assertSee('Galeri Arsip Sejarah');
        $response->assertSee('Kolonial');

        // 7. Pengaturan - Kategori
        $response = $this->withSession($authenticatedSession)->get('/admin/pengaturan/kategori');
        $response->assertStatus(200);
        $response->assertSee('Manajemen Kategori');
        $response->assertSee('Sains');

        // 8. Pengaturan - Pengguna
        $response = $this->withSession($authenticatedSession)->get('/admin/pengaturan/pengguna');
        $response->assertStatus(200);
        $response->assertSee('Manajemen Pengguna');
        $response->assertSee('Super Admin');

        // 9. Pengaturan - Banner
        $response = $this->withSession($authenticatedSession)->get('/admin/pengaturan/banner');
        $response->assertStatus(200);
        $response->assertSee('Manajemen Banner Utama');
    }

    /**
     * Test admin logout.
     */
    public function test_admin_logout_clears_session(): void
    {
        $response = $this->withSession(['admin_logged_in' => true])->post('/admin/logout');
        $response->assertRedirect(route('admin.login'));
        $this->assertFalse(session()->has('admin_logged_in'));
    }
}

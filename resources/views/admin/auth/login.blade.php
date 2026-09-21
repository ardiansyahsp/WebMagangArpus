<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk Admin CMS | Dinas Arsip dan Perpustakaan Kota Semarang</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('asset/LOGO.png') }}">

    <!-- Google Fonts Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800;900&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="admin-body">
    <div class="admin-login-wrapper">
        <div class="admin-login-card">
            <!-- Brand Header -->
            <div class="admin-login-header">
                <div class="admin-login-logo">
                    <img src="{{ asset('asset/LOGO.png') }}" alt="Logo Resmi Dinas Arsip dan Perpustakaan Kota Semarang" />
                </div>
                <h1 class="admin-login-title">LOGIN ADMIN CMS</h1>
                <p class="admin-login-subtitle">Dinas Arsip dan Perpustakaan Kota Semarang</p>
            </div>

            <!-- Demo Account Helper Box -->
            <div class="admin-login-demo-box">
                <strong>💡 Akun Uji Coba (Mode Prototipe):</strong>
                <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 6px;">
                    <button type="button" class="admin-btn admin-btn--sm admin-btn--secondary" data-fill-demo="superadmin" style="font-size: 0.72rem; padding: 3px 8px;">
                        Super Admin
                    </button>
                    <button type="button" class="admin-btn admin-btn--sm admin-btn--secondary" data-fill-demo="pustakawan" style="font-size: 0.72rem; padding: 3px 8px;">
                        Pustakawan
                    </button>
                    <button type="button" class="admin-btn admin-btn--sm admin-btn--secondary" data-fill-demo="arsiparis" style="font-size: 0.72rem; padding: 3px 8px;">
                        Arsiparis
                    </button>
                </div>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login.submit') }}" id="adminLoginForm">
                @csrf

                <!-- Username / Email -->
                <div class="admin-form-group" style="margin-bottom: 16px;">
                    <label for="admin_username" class="admin-form-label">Username atau Email <span class="required">*</span></label>
                    <div class="admin-input-wrapper has-icon">
                        <span class="admin-input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </span>
                        <input
                            type="text"
                            name="username"
                            id="admin_username"
                            class="admin-input @error('username') is-invalid @enderror"
                            placeholder="Contoh: admin atau nama@arpusda.go.id"
                            value="{{ old('username', 'admin') }}"
                            required
                            autocomplete="username"
                        />
                    </div>
                    @error('username')
                        <span class="admin-form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="admin-form-group" style="margin-bottom: 18px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <label for="admin_password" class="admin-form-label">Kata Sandi <span class="required">*</span></label>
                        <a href="javascript:void(0)" onclick="window.showToast('Silakan gunakan kredensial demo default: admin123', 'info');" style="font-size: 0.75rem; color: var(--primary); text-decoration: none;">
                            Lupa Sandi?
                        </a>
                    </div>
                    <div class="admin-input-wrapper has-icon" style="position: relative;">
                        <span class="admin-input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </span>
                        <input
                            type="password"
                            name="password"
                            id="admin_password"
                            class="admin-input @error('password') is-invalid @enderror"
                            placeholder="Masukkan kata sandi..."
                            value="admin123"
                            required
                            autocomplete="current-password"
                        />
                        <button type="button" id="togglePasswordBtn" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-muted); cursor: pointer;" aria-label="Tampilkan sandi">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="admin-form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Captcha Note -->
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 22px;">
                    <label style="display: flex; align-items: center; gap: 8px; font-size: 0.8rem; color: var(--text-body); cursor: pointer;">
                        <input type="checkbox" name="remember" checked style="accent-color: var(--primary);">
                        Ingat sesi saya
                    </label>
                    <span style="font-size: 0.72rem; color: var(--text-muted); display: flex; align-items: center; gap: 4px;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        SSL Enkripsi
                    </span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="admin-btn admin-btn--primary" style="width: 100%; padding: 12px; font-size: 0.95rem; font-weight: 700; border-radius: var(--radius-md);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                    </svg>
                    <span>Masuk ke Dashboard</span>
                </button>
            </form>

            <!-- Back to Public Site -->
            <div style="text-align: center; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--border-light);">
                <a href="{{ route('home') }}" style="font-size: 0.82rem; color: var(--text-muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span>Kembali ke Halaman Utama Website</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Toast Alerts -->
    <x-admin.toast />

    <script>
        // Toggle password visibility
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passInput = document.getElementById('admin_password');
        if (toggleBtn && passInput) {
            toggleBtn.addEventListener('click', () => {
                const type = passInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passInput.setAttribute('type', type);
            });
        }
    </script>
</body>
</html>

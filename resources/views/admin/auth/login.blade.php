<!DOCTYPE html>
<html lang="id" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk Admin CMS | Dinas Arsip dan Perpustakaan Kota Semarang</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('asset/LOGO.png') }}">

    <!-- Google Fonts Preconnect: Inter & Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="admin-body">
    <div class="admin-login-wrapper">
        <div class="admin-login-card animate-fade-up">
            <!-- Brand Header -->
            <div class="admin-login-header">
                <div class="admin-login-logo">
                    <img src="{{ asset('asset/LOGO.png') }}" alt="Logo Resmi Dinas Arsip dan Perpustakaan Kota Semarang" />
                </div>
                <h1 class="admin-login-title">LOGIN ADMIN CMS</h1>
                <p class="admin-login-subtitle">Dinas Arsip dan Perpustakaan Kota Semarang</p>
            </div>

            <!-- Demo Account Helper Box (Clerk Style Quick Fill) -->
            <div class="admin-login-demo-box">
                <div style="font-size: 0.74rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px; display: flex; align-items: center; gap: 5px;">
                    <i data-lucide="zap" style="width: 14px; height: 14px; color: var(--accent-gold-dark);"></i>
                    <span>Akun Pengujian Demo Cepat:</span>
                </div>
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <button type="button" class="admin-btn admin-btn--sm admin-btn--secondary" data-fill-demo="superadmin" style="font-size: 0.74rem; padding: 4px 10px; border-radius: 8px;">
                        <i data-lucide="shield" style="width: 12px; height: 12px; color: var(--primary);"></i>
                        <span>Super Admin</span>
                    </button>
                    <button type="button" class="admin-btn admin-btn--sm admin-btn--secondary" data-fill-demo="pustakawan" style="font-size: 0.74rem; padding: 4px 10px; border-radius: 8px;">
                        <i data-lucide="book-open" style="width: 12px; height: 12px; color: var(--info);"></i>
                        <span>Pustakawan</span>
                    </button>
                    <button type="button" class="admin-btn admin-btn--sm admin-btn--secondary" data-fill-demo="arsiparis" style="font-size: 0.74rem; padding: 4px 10px; border-radius: 8px;">
                        <i data-lucide="archive" style="width: 12px; height: 12px; color: var(--success);"></i>
                        <span>Arsiparis</span>
                    </button>
                </div>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login.submit') }}" id="adminLoginForm">
                @csrf

                <!-- Username / Email -->
                <div class="admin-form-group" style="margin-bottom: 18px;">
                    <label for="admin_username" class="admin-form-label">Username atau Email <span class="required">*</span></label>
                    <div class="admin-input-wrapper has-icon">
                        <span class="admin-input-icon">
                            <i data-lucide="user" style="width: 18px; height: 18px;"></i>
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
                <div class="admin-form-group" style="margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <label for="admin_password" class="admin-form-label">Kata Sandi <span class="required">*</span></label>
                        <a href="javascript:void(0)" onclick="window.showToast('Gunakan kata sandi demo default: admin123', 'info');" style="font-size: 0.75rem; color: var(--primary); text-decoration: none; font-weight: 600;">
                            Lupa Sandi?
                        </a>
                    </div>
                    <div class="admin-input-wrapper has-icon" style="position: relative;">
                        <span class="admin-input-icon">
                            <i data-lucide="lock" style="width: 18px; height: 18px;"></i>
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
                        <button type="button" id="togglePasswordBtn" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-muted); cursor: pointer; display: flex; align-items: center;" aria-label="Tampilkan sandi">
                            <i data-lucide="eye" style="width: 17px; height: 17px;"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="admin-form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & SSL Security Badge -->
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 26px;">
                    <label style="display: flex; align-items: center; gap: 8px; font-size: 0.82rem; color: var(--text-body); cursor: pointer; font-weight: 500;">
                        <input type="checkbox" name="remember" checked style="accent-color: var(--primary); width: 16px; height: 16px;">
                        Ingat sesi saya
                    </label>
                    <span style="font-size: 0.74rem; color: var(--text-muted); display: flex; align-items: center; gap: 4px;">
                        <i data-lucide="shield-check" style="width: 14px; height: 14px; color: var(--success);"></i>
                        SSL 256-bit Enkripsi
                    </span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="admin-btn admin-btn--primary" style="width: 100%; padding: 13px; font-size: 0.95rem; font-weight: 700; border-radius: 14px;">
                    <i data-lucide="log-in" style="width: 18px; height: 18px;"></i>
                    <span>Masuk ke Dashboard CMS</span>
                </button>
            </form>

            <!-- Back to Public Site -->
            <div style="text-align: center; margin-top: 26px; padding-top: 20px; border-top: 1px solid var(--border-light);">
                <a href="{{ route('home') }}" style="font-size: 0.84rem; color: var(--text-muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; font-weight: 500; transition: color 0.2s ease;">
                    <i data-lucide="arrow-left" style="width: 15px; height: 15px;"></i>
                    <span>Kembali ke Portal Publik Arpusda</span>
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
                toggleBtn.innerHTML = type === 'password' 
                    ? '<i data-lucide="eye" style="width: 17px; height: 17px;"></i>' 
                    : '<i data-lucide="eye-off" style="width: 17px; height: 17px;"></i>';
                if (typeof lucide !== 'undefined') lucide.createIcons();
            });
        }
    </script>
</body>
</html>

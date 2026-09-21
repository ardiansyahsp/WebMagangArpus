<!-- Toast Container & Session Flash Alerts -->
<div id="adminToastContainer" class="admin-toast-container" aria-live="polite">
    @if(session('success'))
        <div class="admin-toast admin-toast--success" role="alert">
            <div class="admin-toast__icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="admin-toast__content">
                <div class="admin-toast__title">Berhasil!</div>
                <div class="admin-toast__message">{{ session('success') }}</div>
            </div>
            <button type="button" class="admin-toast__close" onclick="this.closest('.admin-toast').remove()" aria-label="Tutup">&times;</button>
        </div>
    @endif

    @if(session('warning'))
        <div class="admin-toast admin-toast--warning" role="alert">
            <div class="admin-toast__icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <div class="admin-toast__content">
                <div class="admin-toast__title">Pemberitahuan</div>
                <div class="admin-toast__message">{{ session('warning') }}</div>
            </div>
            <button type="button" class="admin-toast__close" onclick="this.closest('.admin-toast').remove()" aria-label="Tutup">&times;</button>
        </div>
    @endif

    @if(session('info'))
        <div class="admin-toast admin-toast--info" role="alert">
            <div class="admin-toast__icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
            </div>
            <div class="admin-toast__content">
                <div class="admin-toast__title">Informasi</div>
                <div class="admin-toast__message">{{ session('info') }}</div>
            </div>
            <button type="button" class="admin-toast__close" onclick="this.closest('.admin-toast').remove()" aria-label="Tutup">&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div class="admin-toast admin-toast--danger" role="alert">
            <div class="admin-toast__icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
            </div>
            <div class="admin-toast__content">
                <div class="admin-toast__title">Periksa Kembali Data!</div>
                <div class="admin-toast__message">
                    @foreach($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            </div>
            <button type="button" class="admin-toast__close" onclick="this.closest('.admin-toast').remove()" aria-label="Tutup">&times;</button>
        </div>
    @endif
</div>

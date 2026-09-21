<!-- Toast Container & Session Flash Alerts -->
<div id="adminToastContainer" class="admin-toast-container" aria-live="polite">
    @if(session('success'))
        <div class="admin-toast admin-toast--success" role="alert">
            <div class="admin-toast__icon">
                <i data-lucide="check-circle-2" style="width: 20px; height: 20px;"></i>
            </div>
            <div class="admin-toast__content">
                <div class="admin-toast__title">Berhasil!</div>
                <div class="admin-toast__message">{{ session('success') }}</div>
            </div>
            <button type="button" class="admin-toast__close" onclick="this.closest('.admin-toast').remove()" aria-label="Tutup">
                <i data-lucide="x" style="width: 14px; height: 14px;"></i>
            </button>
        </div>
    @endif

    @if(session('warning'))
        <div class="admin-toast admin-toast--warning" role="alert">
            <div class="admin-toast__icon">
                <i data-lucide="alert-triangle" style="width: 20px; height: 20px;"></i>
            </div>
            <div class="admin-toast__content">
                <div class="admin-toast__title">Pemberitahuan</div>
                <div class="admin-toast__message">{{ session('warning') }}</div>
            </div>
            <button type="button" class="admin-toast__close" onclick="this.closest('.admin-toast').remove()" aria-label="Tutup">
                <i data-lucide="x" style="width: 14px; height: 14px;"></i>
            </button>
        </div>
    @endif

    @if(session('info'))
        <div class="admin-toast admin-toast--info" role="alert">
            <div class="admin-toast__icon">
                <i data-lucide="info" style="width: 20px; height: 20px;"></i>
            </div>
            <div class="admin-toast__content">
                <div class="admin-toast__title">Informasi</div>
                <div class="admin-toast__message">{{ session('info') }}</div>
            </div>
            <button type="button" class="admin-toast__close" onclick="this.closest('.admin-toast').remove()" aria-label="Tutup">
                <i data-lucide="x" style="width: 14px; height: 14px;"></i>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="admin-toast admin-toast--danger" role="alert">
            <div class="admin-toast__icon">
                <i data-lucide="alert-circle" style="width: 20px; height: 20px;"></i>
            </div>
            <div class="admin-toast__content">
                <div class="admin-toast__title">Periksa Kembali Data!</div>
                <div class="admin-toast__message">
                    @foreach($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            </div>
            <button type="button" class="admin-toast__close" onclick="this.closest('.admin-toast').remove()" aria-label="Tutup">
                <i data-lucide="x" style="width: 14px; height: 14px;"></i>
            </button>
        </div>
    @endif
</div>

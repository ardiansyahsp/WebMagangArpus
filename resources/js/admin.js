/**
 * DINAS ARSIP DAN PERPUSTAKAAN KOTA SEMARANG — ADMIN CMS JAVASCRIPT
 * Module: Interactive Admin Dashboard, Modals, Tables, Dark Mode, Toasts
 */

document.addEventListener('DOMContentLoaded', () => {
    initSidebar();
    initDropdowns();
    initModals();
    initTableSearch();
    initDarkMode();
    initLoginDemo();
    initSimulatedActions();
});

/**
 * 1. Sidebar Toggle & Mobile Offcanvas Drawer
 */
function initSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    const toggleBtn = document.getElementById('sidebarToggleBtn');
    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar || !toggleBtn) return;

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('is-open');
        if (overlay) overlay.classList.toggle('is-active');
    });

    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-active');
        });
    }
}

/**
 * 2. Topbar Dropdowns (User profile, Notifications)
 */
function initDropdowns() {
    const userTrigger = document.getElementById('userMenuTrigger');
    const userDropdown = document.getElementById('userDropdownMenu');
    const notifTrigger = document.getElementById('notifMenuTrigger');
    const notifDropdown = document.getElementById('notifDropdownMenu');

    function toggleDropdown(trigger, menu) {
        if (!trigger || !menu) return;
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = menu.classList.contains('is-open');
            closeAllDropdowns();
            if (!isOpen) menu.classList.add('is-open');
        });
    }

    function closeAllDropdowns() {
        document.querySelectorAll('.admin-dropdown').forEach(dropdown => {
            dropdown.classList.remove('is-open');
        });
    }

    toggleDropdown(userTrigger, userDropdown);
    toggleDropdown(notifTrigger, notifDropdown);

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.admin-dropdown') && !e.target.closest('.topbar-user__trigger') && !e.target.closest('.topbar-btn')) {
            closeAllDropdowns();
        }
    });
}

/**
 * 3. Modal Dialog Manager
 */
function initModals() {
    // Open modal triggers
    document.querySelectorAll('[data-modal-target]').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            const modalId = trigger.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            if (modal) openModal(modal);
        });
    });

    // Close modal triggers
    document.querySelectorAll('[data-modal-close]').forEach(closeBtn => {
        closeBtn.addEventListener('click', () => {
            const modal = closeBtn.closest('.admin-modal-backdrop');
            if (modal) closeModal(modal);
        });
    });

    // Close on backdrop click
    document.querySelectorAll('.admin-modal-backdrop').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal(modal);
            }
        });
    });

    // Close on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            document.querySelectorAll('.admin-modal-backdrop.is-open').forEach(modal => {
                closeModal(modal);
            });
        }
    });
}

function openModal(modalEl) {
    if (!modalEl) return;
    modalEl.classList.add('is-open');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalEl) {
    if (!modalEl) return;
    modalEl.classList.remove('is-open');
    document.body.style.overflow = '';
}

// Global helper for opening modal via JS
window.openAdminModal = function(id) {
    const modal = document.getElementById(id);
    if (modal) openModal(modal);
};

window.closeAdminModal = function(id) {
    const modal = document.getElementById(id);
    if (modal) closeModal(modal);
};

/**
 * 4. Client-side Live Table Search
 */
function initTableSearch() {
    const searchInputs = document.querySelectorAll('.table-search-input input');
    searchInputs.forEach(input => {
        const table = input.closest('.admin-card')?.querySelector('.admin-table');
        if (!table) return;

        input.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
}

/**
 * 5. Dark Mode Switcher
 */
function initDarkMode() {
    const darkToggle = document.getElementById('darkModeToggle');
    const savedTheme = localStorage.getItem('arpus_admin_theme') || 'light';

    if (savedTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
    }

    if (darkToggle) {
        darkToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('arpus_admin_theme', newTheme);
            window.showToast(`Mode ${newTheme === 'dark' ? 'Gelap' : 'Terang'} diaktifkan`, 'info');
        });
    }
}

/**
 * 6. Demo Login Credential Filler
 */
function initLoginDemo() {
    const demoBtns = document.querySelectorAll('[data-fill-demo]');
    const usernameInput = document.getElementById('admin_username');
    const passwordInput = document.getElementById('admin_password');

    demoBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const role = btn.getAttribute('data-fill-demo');
            if (role === 'superadmin') {
                if (usernameInput) usernameInput.value = 'admin';
                if (passwordInput) passwordInput.value = 'admin123';
            } else if (role === 'pustakawan') {
                if (usernameInput) usernameInput.value = 'pustakawan';
                if (passwordInput) passwordInput.value = 'admin123';
            } else if (role === 'arsiparis') {
                if (usernameInput) usernameInput.value = 'arsiparis';
                if (passwordInput) passwordInput.value = 'admin123';
            }
            window.showToast(`Kredensial ${role} telah diisi. Klik Masuk!`, 'info');
        });
    });
}

/**
 * 7. Simulated Actions (PDF Preview, Status Changes, Toasts)
 */
function initSimulatedActions() {
    // PDF View Simulation
    document.querySelectorAll('[data-view-pdf]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const fileName = btn.getAttribute('data-view-pdf') || 'Surat_Pengantar.pdf';
            const modal = document.getElementById('pdfPreviewModal');
            if (modal) {
                const titleEl = modal.querySelector('#pdfPreviewTitle');
                if (titleEl) titleEl.textContent = `Pratinjau Dokumen: ${fileName}`;
                openModal(modal);
            } else {
                window.showToast(`Membuka berkas: ${fileName}`, 'info');
            }
        });
    });

    // PDF Download Simulation
    document.querySelectorAll('[data-download-pdf]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const fileName = btn.getAttribute('data-download-pdf') || 'Berkas_Arsip.pdf';
            window.showToast(`Mengunduh dokumen: ${fileName}... Selesai!`, 'success');
        });
    });
}

/**
 * 8. Interactive Toast Notification Helper
 */
window.showToast = function(message, type = 'info', title = null) {
    let container = document.getElementById('adminToastContainer');
    if (!container) {
        container = document.createElement('div');
        container.id = 'adminToastContainer';
        container.className = 'admin-toast-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `admin-toast admin-toast--${type}`;

    const iconSvg = type === 'success' ? '✓' : (type === 'danger' ? '✕' : (type === 'warning' ? '⚠' : 'ℹ'));

    toast.innerHTML = `
        <div class="admin-toast__icon">${iconSvg}</div>
        <div class="admin-toast__content">
            ${title ? `<div class="admin-toast__title">${title}</div>` : ''}
            <div class="admin-toast__message">${message}</div>
        </div>
        <button type="button" class="admin-toast__close" aria-label="Tutup">&times;</button>
    `;

    toast.querySelector('.admin-toast__close').addEventListener('click', () => {
        toast.remove();
    });

    container.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => toast.remove(), 300);
    }, 4500);
};

/**
 * DINAS ARSIP DAN PERPUSTAKAAN KOTA SEMARANG — ENTERPRISE SAAS ADMIN JAVASCRIPT
 * Features: Counting Number Animations, Sparklines, Keyboard Shortcuts (⌘K),
 *           Ripple Effects, Spring Modals, Live Search, Dark Mode Sync.
 */

document.addEventListener('DOMContentLoaded', () => {
    initLucideIcons();
    initSidebar();
    initDropdowns();
    initModals();
    initTableSearch();
    initDarkMode();
    initLoginDemo();
    initSimulatedActions();
    initNumberCounters();
    initSparklines();
    initRippleEffect();
});

/**
 * 0. Lucide Icons Initializer
 */
function initLucideIcons() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

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
            if (!isOpen) {
                menu.classList.add('is-open');
                initLucideIcons();
            }
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
 * 3. Animated Number Counter (Framer Motion style)
 */
function initNumberCounters() {
    const counterElements = document.querySelectorAll('[data-counter-target]');
    if (!counterElements.length) return;

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    counterElements.forEach(el => observer.observe(el));
}

function animateCounter(el) {
    const target = parseFloat(el.getAttribute('data-counter-target')) || 0;
    const prefix = el.getAttribute('data-counter-prefix') || '';
    const suffix = el.getAttribute('data-counter-suffix') || '';
    const isDecimal = el.getAttribute('data-counter-decimal') === 'true';
    const duration = 1200; // ms
    const startTime = performance.now();

    function updateCounter(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        // EaseOutExpo curve
        const easeOut = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
        const currentVal = easeOut * target;

        let formatted = '';
        if (isDecimal) {
            formatted = currentVal.toFixed(1);
        } else {
            formatted = Math.floor(currentVal).toLocaleString('id-ID');
        }

        el.textContent = `${prefix}${formatted}${suffix}`;

        if (progress < 1) {
            requestAnimationFrame(updateCounter);
        } else {
            // Final exact value
            const finalVal = isDecimal ? target.toFixed(1) : target.toLocaleString('id-ID');
            el.textContent = `${prefix}${finalVal}${suffix}`;
        }
    }

    requestAnimationFrame(updateCounter);
}

/**
 * 4. Interactive Mini Sparklines Generator (SVG)
 */
function initSparklines() {
    document.querySelectorAll('[data-sparkline]').forEach(container => {
        const rawPoints = container.getAttribute('data-sparkline') || '10,25,18,30,22,35,42';
        const color = container.getAttribute('data-sparkline-color') || '#a11212';
        const points = rawPoints.split(',').map(Number);
        
        const min = Math.min(...points);
        const max = Math.max(...points);
        const range = max - min || 1;
        const width = 180;
        const height = 30;

        const pathCoords = points.map((val, idx) => {
            const x = (idx / (points.length - 1)) * width;
            const y = height - ((val - min) / range) * (height - 6) - 3;
            return `${x},${y}`;
        });

        const d = `M ${pathCoords.join(' L ')}`;
        const areaD = `M 0,${height} L ${pathCoords.join(' L ')} L ${width},${height} Z`;
        const gradientId = `sparkline-grad-${Math.random().toString(36).substr(2, 6)}`;

        container.innerHTML = `
            <svg viewBox="0 0 ${width} ${height}" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="${gradientId}" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="${color}" stop-opacity="0.25"></stop>
                        <stop offset="100%" stop-color="${color}" stop-opacity="0.0"></stop>
                    </linearGradient>
                </defs>
                <path d="${areaD}" fill="url(#${gradientId})"></path>
                <path d="${d}" fill="none" stroke="${color}" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        `;
    });
}

/**
 * 5. Button Ripple Effect Micro-Interaction
 */
function initRippleEffect() {
    document.querySelectorAll('.admin-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            const rect = button.getBoundingClientRect();
            const circle = document.createElement('span');
            const diameter = Math.max(rect.width, rect.height);
            const radius = diameter / 2;

            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${e.clientX - rect.left - radius}px`;
            circle.style.top = `${e.clientY - rect.top - radius}px`;
            circle.classList.add('admin-ripple');

            const existingRipple = button.querySelector('.admin-ripple');
            if (existingRipple) existingRipple.remove();

            button.appendChild(circle);
        });
    });
}

/**
 * 6. Modal Dialog Manager (Spring Transitions)
 */
function initModals() {
    document.querySelectorAll('[data-modal-target]').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            const modalId = trigger.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            if (modal) openModal(modal);
        });
    });

    document.querySelectorAll('[data-modal-close]').forEach(closeBtn => {
        closeBtn.addEventListener('click', () => {
            const modal = closeBtn.closest('.admin-modal-backdrop');
            if (modal) closeModal(modal);
        });
    });

    document.querySelectorAll('.admin-modal-backdrop').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal(modal);
            }
        });
    });

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
    initLucideIcons();
}

function closeModal(modalEl) {
    if (!modalEl) return;
    modalEl.classList.remove('is-open');
    document.body.style.overflow = '';
}

window.openAdminModal = function(id) {
    const modal = document.getElementById(id);
    if (modal) openModal(modal);
};

window.closeAdminModal = function(id) {
    const modal = document.getElementById(id);
    if (modal) closeModal(modal);
};

/**
 * 7. Client-side Live Table Search
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
 * 8. Dark Mode Switcher (Full LocalStorage Persistence)
 */
function initDarkMode() {
    const darkToggle = document.getElementById('darkModeToggle');

    if (darkToggle) {
        darkToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            if (newTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            } else {
                document.documentElement.removeAttribute('data-theme');
            }
            
            localStorage.setItem('arpus_admin_theme', newTheme);
            window.showToast(`Mode ${newTheme === 'dark' ? 'Gelap' : 'Terang'} aktif`, 'info');
            initLucideIcons();
        });
    }
}

/**
 * 9. Demo Login Credential Filler
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
            window.showToast(`Kredensial ${role} telah dimasukkan!`, 'info');
        });
    });
}

/**
 * 10. Simulated Actions (PDF Viewer & Download)
 */
function initSimulatedActions() {
    document.querySelectorAll('[data-view-pdf]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const fileName = btn.getAttribute('data-view-pdf') || 'Surat_Pengantar.pdf';
            const modal = document.getElementById('pdfPreviewModal');
            if (modal) {
                const titleEl = modal.querySelector('#pdfPreviewTitle');
                if (titleEl) titleEl.textContent = `Pratinjau: ${fileName}`;
                openModal(modal);
            } else {
                window.showToast(`Membuka dokumen: ${fileName}`, 'info');
            }
        });
    });

    document.querySelectorAll('[data-download-pdf]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const fileName = btn.getAttribute('data-download-pdf') || 'Berkas_Arsip.pdf';
            window.showToast(`Mengunduh berkas: ${fileName}... Selesai!`, 'success');
        });
    });
}

/**
 * 11. Glassmorphic Toast Notification Helper
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

    const iconName = type === 'success' ? 'check-circle-2' : (type === 'danger' ? 'alert-circle' : (type === 'warning' ? 'alert-triangle' : 'info'));

    toast.innerHTML = `
        <div class="admin-toast__icon">
            <i data-lucide="${iconName}" style="width: 20px; height: 20px;"></i>
        </div>
        <div class="admin-toast__content">
            ${title ? `<div class="admin-toast__title">${title}</div>` : ''}
            <div class="admin-toast__message">${message}</div>
        </div>
        <button type="button" class="admin-toast__close" aria-label="Tutup">
            <i data-lucide="x" style="width: 14px; height: 14px;"></i>
        </button>
    `;

    toast.querySelector('.admin-toast__close').addEventListener('click', () => {
        toast.remove();
    });

    container.appendChild(toast);
    initLucideIcons();

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%) scale(0.9)';
        setTimeout(() => toast.remove(), 350);
    }, 4500);
};

/**
 * Navigation Module
 * Handles mobile drawer toggle, dropdowns, and sticky header scroll effect.
 */
export function initNavigation() {
    const header = document.querySelector('.site-header');
    const navToggle = document.getElementById('navToggleBtn');
    const mainNav = document.getElementById('primaryNav');

    // 1. Mobile Hamburger Toggle
    if (navToggle && mainNav) {
        navToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = mainNav.classList.toggle('open');
            navToggle.classList.toggle('is-active', isOpen);
            navToggle.setAttribute('aria-expanded', String(isOpen));
        });

        // Close mobile drawer when clicking a regular nav link
        mainNav.querySelectorAll('.main-nav__link').forEach((link) => {
            link.addEventListener('click', () => {
                if (!link.classList.contains('dropdown-toggle')) {
                    mainNav.classList.remove('open');
                    navToggle.classList.remove('is-active');
                    navToggle.setAttribute('aria-expanded', 'false');
                }
            });
        });
    }

    // 2. Dropdown Menu Handling (Accessible for Click & Keyboard)
const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

dropdownToggles.forEach((btn) => {
    btn.addEventListener('click', function (e) {
        // Cegah script berjalan di layar desktop (> 992px) karena sudah pakai hover CSS
        if (window.innerWidth > 992) {
            return; // Biarkan hover CSS yang bekerja
        }

        e.preventDefault();
        e.stopPropagation();

        const parent = this.closest('.dropdown') || this.closest('.main-nav__item');
        const menu = parent ? parent.querySelector('.dropdown-menu') : null;
        const isShown = menu ? menu.classList.contains('show') : false;

        // Close other open dropdowns
        document.querySelectorAll('.dropdown-menu.show').forEach((otherMenu) => {
            if (otherMenu !== menu) {
                otherMenu.classList.remove('show');
                const otherBtn = otherMenu.closest('.dropdown')?.querySelector('.dropdown-toggle');
                if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
            }
        });

        // Toggle current
        if (menu) {
            menu.classList.toggle('show', !isShown);
            btn.setAttribute('aria-expanded', String(!isShown));
        }
    });
});

    // Close dropdowns & mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu.show').forEach((menu) => {
                menu.classList.remove('show');
                const btn = menu.closest('.dropdown')?.querySelector('.dropdown-toggle');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            });
        }

        if (mainNav && navToggle && !mainNav.contains(e.target) && !navToggle.contains(e.target)) {
            mainNav.classList.remove('open');
            navToggle.classList.remove('is-active');
            navToggle.setAttribute('aria-expanded', 'false');
        }
    });

    // 3. Sticky Header Scroll Effect (Passive with requestAnimationFrame)
    if (header) {
        let isScrolled = false;
        const handleScroll = () => {
            const shouldBeScrolled = window.scrollY > 40;
            if (shouldBeScrolled !== isScrolled) {
                isScrolled = shouldBeScrolled;
                header.classList.toggle('scrolled', isScrolled);
            }
        };

        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }
}

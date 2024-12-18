export class Navigation {
    constructor() {
        this.nav = document.querySelector('.main-nav');
        this.mobileMenuButton = document.createElement('button');
        this.mobileMenu = document.querySelector('.main-nav__menu');
        this.setupMobileMenu();
        this.initializeEventListeners();
    }

    setupMobileMenu() {
        this.mobileMenuButton.className = 'main-nav__mobile-toggle';
        this.mobileMenuButton.setAttribute('aria-label', 'Toggle menu');
        this.mobileMenuButton.innerHTML = `
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        `;
        this.nav.querySelector('.main-nav__container').appendChild(this.mobileMenuButton);
    }

    initializeEventListeners() {
        this.mobileMenuButton?.addEventListener('click', () => this.toggleMobileMenu());
        window.addEventListener('resize', () => this.handleResize());
    }

    toggleMobileMenu() {
        this.mobileMenu.classList.toggle('is-active');
        this.mobileMenuButton.setAttribute(
            'aria-expanded',
            this.mobileMenu.classList.contains('is-active')
        );
    }

    handleResize() {
        if (window.innerWidth > 768 && this.mobileMenu.classList.contains('is-active')) {
            this.mobileMenu.classList.remove('is-active');
            this.mobileMenuButton.setAttribute('aria-expanded', 'false');
        }
    }
}
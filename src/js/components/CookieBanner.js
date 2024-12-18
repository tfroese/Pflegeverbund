import { COOKIE_PREFERENCES_KEY, getCookiePreferences, setCookiePreferences } from '../utils/cookies.js';

export class CookieBanner {
    constructor() {
        this.banner = document.getElementById('cookieBanner');
        this.settingsPanel = document.getElementById('cookieSettings');
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        document.getElementById('acceptNecessary').addEventListener('click', () => this.acceptNecessaryCookies());
        document.getElementById('acceptAll').addEventListener('click', () => this.acceptAllCookies());
        document.getElementById('toggleSettings').addEventListener('click', () => this.toggleSettings());
        document.getElementById('allCookies').addEventListener('change', (e) => this.toggleAllCookies(e));
    }

    acceptNecessaryCookies() {
        setCookiePreferences({
            necessary: true,
            analytics: false,
            marketing: false
        });
        this.hideBanner();
    }

    acceptAllCookies() {
        setCookiePreferences({
            necessary: true,
            analytics: true,
            marketing: true
        });
        this.hideBanner();
        this.loadOptionalScripts();
    }

    toggleSettings() {
        this.settingsPanel.classList.toggle('is-visible');
    }

    toggleAllCookies(event) {
        const checkboxes = this.settingsPanel.querySelectorAll('input[type="checkbox"]:not([disabled])');
        checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
    }

    hideBanner() {
        this.banner.style.display = 'none';
    }

    loadOptionalScripts() {
        const preferences = getCookiePreferences();
        
        if (preferences?.analytics) {
            // Load analytics scripts
            console.log('Analytics scripts loaded');
        }
        
        if (preferences?.marketing) {
            // Load marketing scripts
            console.log('Marketing scripts loaded');
        }
    }
}
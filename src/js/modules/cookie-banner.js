import { setCookie, getCookie, hasAcceptedCookies } from '../utils/cookies.js';
import { initAnalytics } from './analytics.js';
import { $, $$ } from '../utils/dom.js';

const COOKIE_TYPES = {
    NECESSARY: 'necessary_cookies',
    ANALYTICS: 'analytics_cookies',
    MARKETING: 'marketing_cookies'
};

export function initCookieBanner() {
    const cookieBanner = $('#cookieBanner');
    if (!cookieBanner) return;

    // Show banner if preferences not set
    if (!hasAcceptedCookies()) {
        cookieBanner.style.display = 'block';
    }

    setupCookieControls();
    loadSavedPreferences();
}

function setupCookieControls() {
    // Remove inline onclick handlers and use proper event listeners
    const acceptAllBtn = $('[data-cookie-action="accept-all"]');
    const acceptNecessaryBtn = $('[data-cookie-action="accept-necessary"]');
    const settingsBtn = $('[data-cookie-action="toggle-settings"]');
    const saveSettingsBtn = $('[data-cookie-action="save-settings"]');
    
    if (acceptAllBtn) acceptAllBtn.addEventListener('click', acceptAllCookies);
    if (acceptNecessaryBtn) acceptNecessaryBtn.addEventListener('click', acceptNecessaryCookies);
    if (settingsBtn) settingsBtn.addEventListener('click', toggleCookieSettings);
    if (saveSettingsBtn) saveSettingsBtn.addEventListener('click', saveSettings);

    // Setup "Select All" checkbox
    const allCheckbox = $('#allCookies');
    if (allCheckbox) {
        allCheckbox.addEventListener('change', toggleAllCookies);
    }
}

function acceptAllCookies() {
    setCookie(COOKIE_TYPES.NECESSARY, 'accepted');
    setCookie(COOKIE_TYPES.ANALYTICS, 'accepted');
    setCookie(COOKIE_TYPES.MARKETING, 'accepted');
    setCookie('cookie_preferences', 'all');
    
    hideCookieBanner();
    initAnalytics();
}

function acceptNecessaryCookies() {
    setCookie(COOKIE_TYPES.NECESSARY, 'accepted');
    setCookie(COOKIE_TYPES.ANALYTICS, 'rejected');
    setCookie(COOKIE_TYPES.MARKETING, 'rejected');
    setCookie('cookie_preferences', 'necessary');
    
    hideCookieBanner();
}

function saveSettings() {
    const analytics = $('#analyticsCookies').checked;
    const marketing = $('#marketingCookies').checked;
    
    setCookie(COOKIE_TYPES.NECESSARY, 'accepted');
    setCookie(COOKIE_TYPES.ANALYTICS, analytics ? 'accepted' : 'rejected');
    setCookie(COOKIE_TYPES.MARKETING, marketing ? 'accepted' : 'rejected');
    setCookie('cookie_preferences', 'custom');
    
    if (marketing) {
        initAnalytics();
    }
    
    hideCookieBanner();
}

function toggleCookieSettings() {
    const settings = $('#cookieSettings');
    if (settings) {
        settings.classList.toggle('is-visible');
    }
}

function toggleAllCookies() {
    const allCheckbox = $('#allCookies');
    const checkboxes = $$('.cookie-settings__option input[type="checkbox"]:not([disabled])');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = allCheckbox.checked;
    });
}

function loadSavedPreferences() {
    const analyticsCookie = getCookie(COOKIE_TYPES.ANALYTICS);
    const marketingCookie = getCookie(COOKIE_TYPES.MARKETING);
    
    if (analyticsCookie === 'accepted') {
        $('#analyticsCookies').checked = true;
    }
    
    if (marketingCookie === 'accepted') {
        $('#marketingCookies').checked = true;
        initAnalytics();
    }
    
    updateAllCheckbox();
}

function updateAllCheckbox() {
    const allCheckbox = $('#allCookies');
    const checkboxes = $$('.cookie-settings__option input[type="checkbox"]:not([disabled])');
    const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
    
    if (allCheckbox) {
        allCheckbox.checked = allChecked;
    }
}

function hideCookieBanner() {
    const banner = $('#cookieBanner');
    if (banner) {
        banner.style.display = 'none';
    }
}
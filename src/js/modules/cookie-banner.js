import { setCookie, getCookie, hasAcceptedCookies } from '../utils/cookies.js';
import { initAnalytics } from './analytics.js';
import { $, $$ } from '../utils/dom.js';

const COOKIE_TYPES = {
    NECESSARY: 'necessary_cookies',
    ANALYTICS: 'analytics_cookies',
    MARKETING: 'marketing_cookies'
};

const ANIMATION_DURATION = 400; // Match this with CSS transition duration

export function initCookieBanner() {
    const cookieBanner = $('#cookieBanner');
    if (!cookieBanner) {
        console.log('Cookie banner not found in DOM');
        return;
    }

    // Show banner with animation if preferences not set
    if (!hasAcceptedCookies()) {
        // Delay to ensure smooth animation
        requestAnimationFrame(() => {
            cookieBanner.style.display = 'block';
            // Trigger reflow
            cookieBanner.offsetHeight;
            cookieBanner.classList.add('is-visible');
        });
    }

    setupCookieControls();
    loadSavedPreferences();
}

function setupCookieControls() {
    const controls = {
        acceptAll: $('[data-cookie-action="accept-all"]'),
        acceptNecessary: $('[data-cookie-action="accept-necessary"]'),
        toggleSettings: $('[data-cookie-action="toggle-settings"]'),
        saveSettings: $('[data-cookie-action="save-settings"]'),
        allCheckbox: $('#allCookies')
    };

    // Safely add event listeners
    if (controls.acceptAll) {
        controls.acceptAll.addEventListener('click', acceptAllCookies);
    }
    
    if (controls.acceptNecessary) {
        controls.acceptNecessary.addEventListener('click', acceptNecessaryCookies);
    }
    
    if (controls.toggleSettings) {
        controls.toggleSettings.addEventListener('click', toggleCookieSettings);
    }
    
    if (controls.saveSettings) {
        controls.saveSettings.addEventListener('click', saveSettings);
    }
    
    if (controls.allCheckbox) {
        controls.allCheckbox.addEventListener('change', toggleAllCookies);
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
    const analyticsCookie = $('#analyticsCookies');
    const marketingCookie = $('#marketingCookies');
    
    if (!analyticsCookie || !marketingCookie) return;
    
    setCookie(COOKIE_TYPES.NECESSARY, 'accepted');
    setCookie(COOKIE_TYPES.ANALYTICS, analyticsCookie.checked ? 'accepted' : 'rejected');
    setCookie(COOKIE_TYPES.MARKETING, marketingCookie.checked ? 'accepted' : 'rejected');
    setCookie('cookie_preferences', 'custom');
    
    if (marketingCookie.checked) {
        initAnalytics();
    }
    
    hideCookieBanner();
}

function toggleCookieSettings() {
    const settings = $('#cookieSettings');
    if (!settings) return;

    const isVisible = settings.classList.contains('is-visible');
    
    if (!isVisible) {
        settings.style.display = 'block';
        // Trigger reflow
        settings.offsetHeight;
        settings.classList.add('is-visible');
    } else {
        settings.classList.remove('is-visible');
        setTimeout(() => {
            settings.style.display = 'none';
        }, 300); // Match CSS transition duration
    }
}

function toggleAllCookies() {
    const allCheckbox = $('#allCookies');
    if (!allCheckbox) return;
    
    const checkboxes = $$('.cookie-settings__option input[type="checkbox"]:not([disabled])');
    checkboxes.forEach(checkbox => {
        checkbox.checked = allCheckbox.checked;
    });
}

function loadSavedPreferences() {
    const analyticsCookie = $('#analyticsCookies');
    const marketingCookie = $('#marketingCookies');
    
    if (!analyticsCookie || !marketingCookie) return;
    
    if (getCookie(COOKIE_TYPES.ANALYTICS) === 'accepted') {
        analyticsCookie.checked = true;
    }
    
    if (getCookie(COOKIE_TYPES.MARKETING) === 'accepted') {
        marketingCookie.checked = true;
        initAnalytics();
    }
    
    updateAllCheckbox();
}

function updateAllCheckbox() {
    const allCheckbox = $('#allCookies');
    if (!allCheckbox) return;
    
    const checkboxes = $$('.cookie-settings__option input[type="checkbox"]:not([disabled])');
    const allChecked = checkboxes.length > 0 && checkboxes.every(checkbox => checkbox.checked);
    
    allCheckbox.checked = allChecked;
}

function hideCookieBanner() {
    const banner = $('#cookieBanner');
    if (!banner) return;
    
    banner.classList.add('is-hiding');
    banner.classList.remove('is-visible');
    
    // Wait for animation to complete before removing from DOM
    setTimeout(() => {
        banner.style.display = 'none';
        banner.classList.remove('is-hiding');
    }, ANIMATION_DURATION);
}
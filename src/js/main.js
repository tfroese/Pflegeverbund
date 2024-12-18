import { onReady } from './utils/dom.js';
import { addCacheBuster } from './utils/cache.js';
import { initFAQ } from './modules/faq.js';
import { initCookieBanner } from './modules/cookie-banner.js';
import { initAnalytics } from './modules/analytics.js';

// Add cache buster to script URLs
const scripts = document.querySelectorAll('script[src]');
scripts.forEach(script => {
    if (script.src && !script.src.includes('data:')) {
        script.src = addCacheBuster(script.src);
    }
});

// Initialize modules
onReady(() => {
    console.log('Initializing application...', new Date().toISOString());
    initFAQ();
    initCookieBanner();
    // Analytics will be initialized by cookie banner if consent is given
});
import { onReady } from './utils/dom.js';
import { addCacheBuster } from './utils/cache.js';
import { initCookieBanner } from './modules/cookie-banner.js';
import { initAnalytics } from './modules/analytics.js';
import { initFAQAccordion } from './modules/faq-accordion.js';
import { FAQSearch } from './modules/faq-search/index.js';
import { initGuideSidemenu } from './modules/guide-sidemenu.js';
import { initNewsletter } from './modules/newsletter/index.js';

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
    initFAQAccordion();
    initCookieBanner();
    initGuideSidemenu();
    initNewsletter();
    new FAQSearch();
    // Analytics will be initialized by cookie banner if consent is given
});
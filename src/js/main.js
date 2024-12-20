import { onReady } from './utils/dom.js';
import { addCacheBuster } from './utils/cache.js';
import { initCookieBanner } from './modules/cookie-banner.js';
import { initAnalytics } from './modules/analytics.js';
import { initFAQAccordion } from './modules/faq-accordion.js';
import { FAQSearch } from './modules/faq-search/index.js';
import { initGuideSidemenu } from './modules/guide-sidemenu.js';
import { initNewsletter } from './modules/newsletter/index.js';
import { initStickyNav } from './modules/sticky-nav.js';
import { initEmbeddedFAQ } from './modules/embedded-faq/index.js';
import { initContactForm } from './modules/contact-form.js';
import { initHeaderForm } from './modules/funnel-form.js';

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
    initStickyNav();
    initEmbeddedFAQ();
    initContactForm();
    initHeaderForm();
    new FAQSearch();
});
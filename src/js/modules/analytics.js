import { getCookie } from '../utils/cookies.js';

const GA_MEASUREMENT_ID = 'G-P87FPKHXX8'; // Replace with your actual GA4 measurement ID

export function initAnalytics() {
    // Only initialize if marketing cookies are accepted
    if (getCookie('marketing_cookies') === 'accepted') {
        loadGoogleAnalytics();
    }
}

function loadGoogleAnalytics() {
    // Load Google Analytics script
    const script = document.createElement('script');
    script.src = `https://www.googletagmanager.com/gtag/js?id=${GA_MEASUREMENT_ID}`;
    script.async = true;
    document.head.appendChild(script);

    // Initialize dataLayer
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    window.gtag = gtag;

    gtag('js', new Date());
    gtag('config', GA_MEASUREMENT_ID, {
        'cookie_flags': 'max-age=7200;secure;samesite=none'
    });
}
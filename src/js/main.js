import { FAQ } from './components/FAQ.js';

// Initialize FAQ component
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.faq-accordion')) {
        new FAQ();
    }
});
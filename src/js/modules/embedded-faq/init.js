import { initAccordions } from './accordion.js';
import { observeContentChanges } from './observer.js';

export function initEmbeddedFAQ() {
    // Initialize embedded FAQs
    initAccordions();

    // Add mutation observer to handle dynamically added content
    observeContentChanges();
}
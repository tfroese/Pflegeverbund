import { initAccordions } from './accordion.js';

export function observeContentChanges() {
    // Create mutation observer to watch for dynamically added content
    const observer = new MutationObserver((mutations) => {
        mutations.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType === Node.ELEMENT_NODE) {
                    // Check if added node is or contains embedded FAQs
                    if (node.classList?.contains('embedded-faq')) {
                        initAccordions(node);
                    } else if (node.querySelector?.('.embedded-faq')) {
                        initAccordions(node);
                    }
                }
            });
        });
    });
    
    // Start observing
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
}
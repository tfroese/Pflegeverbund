/**
 * DOM utility functions
 */
export function $(selector, context = document) {
    if (!context) return null;
    return context.querySelector(selector);
}

export function $$(selector, context = document) {
    if (!context) return [];
    return Array.from(context.querySelectorAll(selector));
}

export function onReady(fn) {
    if (document.readyState !== 'loading') {
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
}

export function addEvent(element, event, handler, options = {}) {
    if (element) {
        element.addEventListener(event, handler, options);
    }
}

export function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
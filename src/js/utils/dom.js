/**
 * DOM utility functions
 */
export function $(selector, context = document) {
    return context.querySelector(selector);
}

export function $$(selector, context = document) {
    return [...context.querySelectorAll(selector)];
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
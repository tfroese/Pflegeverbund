import { $ } from '../utils/dom.js';

export function initStickyNav() {
    const nav = $('.main-nav');
    if (!nav) return;

    // Get initial offset position of nav
    const navOffset = nav.offsetTop;
    
    // Create a placeholder to prevent content jump
    const placeholder = document.createElement('div');
    placeholder.style.display = 'none';
    placeholder.style.height = nav.offsetHeight + 'px';
    nav.parentNode.insertBefore(placeholder, nav);

    // Handle scroll event
    function handleScroll() {
        if (window.pageYOffset >= navOffset) {
            if (!nav.classList.contains('is-sticky')) {
                nav.classList.add('is-sticky');
                placeholder.style.display = 'block';
            }
        } else {
            if (nav.classList.contains('is-sticky')) {
                nav.classList.remove('is-sticky');
                placeholder.style.display = 'none';
            }
        }
    }

    // Add scroll event listener
    window.addEventListener('scroll', handleScroll, { passive: true });
    
    // Initial check
    handleScroll();
}
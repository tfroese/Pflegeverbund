/**
 * Animation utility functions
 */
export function smoothScroll(element, options = {}) {
    if (!element) return;
    
    element.scrollIntoView({
        behavior: 'smooth',
        block: 'start',
        ...options
    });
}

export function fadeIn(element, duration = 300) {
    if (!element) return;
    
    element.style.opacity = 0;
    element.style.display = 'block';
    
    let start = null;
    function animate(timestamp) {
        if (!start) start = timestamp;
        const progress = timestamp - start;
        
        element.style.opacity = Math.min(progress / duration, 1);
        
        if (progress < duration) {
            requestAnimationFrame(animate);
        }
    }
    
    requestAnimationFrame(animate);
}
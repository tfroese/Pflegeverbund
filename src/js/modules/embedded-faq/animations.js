export function openAccordion(question, answer) {
    question.setAttribute('aria-expanded', 'true');
    
    // Get the content height before showing
    answer.style.height = '0';
    answer.style.opacity = '0';
    answer.hidden = false;
    
    // Trigger reflow
    answer.offsetHeight;
    
    // Add animation
    answer.style.height = `${answer.scrollHeight}px`;
    answer.style.opacity = '1';
    
    // Clean up after animation
    answer.addEventListener('transitionend', function cleanup(e) {
        if (e.propertyName === 'height') {
            answer.style.height = '';
            answer.removeEventListener('transitionend', cleanup);
        }
    });
}

export function closeAccordion(question, answer) {
    question.setAttribute('aria-expanded', 'false');
    
    // Set explicit height before animating
    answer.style.height = `${answer.scrollHeight}px`;
    // Trigger reflow
    answer.offsetHeight;
    
    // Add animation
    answer.style.height = '0';
    answer.style.opacity = '0';
    
    // Hide after animation
    answer.addEventListener('transitionend', function cleanup(e) {
        if (e.propertyName === 'height') {
            answer.hidden = true;
            answer.style.height = '';
            answer.style.opacity = '';
            answer.removeEventListener('transitionend', cleanup);
        }
    });
}
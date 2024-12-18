import { $, $$ } from '../utils/dom.js';

class FAQAccordion {
    constructor(container = '.faq-container') {
        this.container = $(container);
        this.questions = $$('.faq-question', this.container);
        this.activeItem = null;
        
        this.init();
    }
    
    init() {
        if (!this.container) return;
        
        this.questions.forEach(question => {
            question.addEventListener('click', () => this.toggleQuestion(question));
        });
    }
    
    toggleQuestion(question) {
        const answer = question.nextElementSibling;
        const isExpanded = question.getAttribute('aria-expanded') === 'true';
        
        // Close currently open item if it's different from the clicked one
        if (this.activeItem && this.activeItem !== question) {
            this.closeItem(this.activeItem);
        }
        
        // Toggle clicked item
        if (isExpanded) {
            this.closeItem(question);
            this.activeItem = null;
        } else {
            this.openItem(question);
            this.activeItem = question;
        }
    }
    
    openItem(question) {
        const answer = question.nextElementSibling;
        question.setAttribute('aria-expanded', 'true');
        answer.hidden = false;
        
        // Add animation class
        answer.style.height = '0';
        answer.style.opacity = '0';
        requestAnimationFrame(() => {
            answer.style.height = answer.scrollHeight + 'px';
            answer.style.opacity = '1';
        });
    }
    
    closeItem(question) {
        const answer = question.nextElementSibling;
        question.setAttribute('aria-expanded', 'false');
        
        // Add animation
        answer.style.height = '0';
        answer.style.opacity = '0';
        
        // Wait for animation to complete before hiding
        setTimeout(() => {
            answer.hidden = true;
            // Reset styles after hiding
            answer.style.height = '';
            answer.style.opacity = '';
        }, 300); // Match the CSS transition duration
    }
}

export function initFAQAccordion() {
    new FAQAccordion();
}
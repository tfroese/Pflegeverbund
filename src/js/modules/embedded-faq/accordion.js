import { $$ } from '../../utils/dom.js';
import { openAccordion, closeAccordion } from './animations.js';

export function initAccordions(context = document) {
    const questions = $$('.embedded-faq__question', context);
    
    questions.forEach(question => {
        // Skip if already initialized
        if (question.dataset.initialized) return;
        
        question.dataset.initialized = 'true';
        question.addEventListener('click', () => toggleAccordion(question));
    });
}

function toggleAccordion(question) {
    const isExpanded = question.getAttribute('aria-expanded') === 'true';
    const answer = question.nextElementSibling;
    
    // Close other open items in the same accordion
    const accordion = question.closest('.embedded-faq__list');
    if (accordion && !isExpanded) {
        const openQuestions = $$('.embedded-faq__question[aria-expanded="true"]', accordion);
        openQuestions.forEach(openQuestion => {
            if (openQuestion !== question) {
                closeAccordion(openQuestion, openQuestion.nextElementSibling);
            }
        });
    }
    
    if (!isExpanded) {
        openAccordion(question, answer);
    } else {
        closeAccordion(question, answer);
    }
}
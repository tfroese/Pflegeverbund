import { $$, addEvent } from '../utils/dom.js';
import { smoothScroll } from '../utils/animation.js';

/**
 * FAQ module for handling accordion functionality
 */
export function initFAQ() {
    const questions = $$('.faq-item__question');
    if (!questions.length) return;
    
    questions.forEach(setupQuestion);
    initSmoothScroll();
}

function setupQuestion(question) {
    // Set initial ARIA attributes
    const answerId = `answer-${Math.random().toString(36).substr(2, 9)}`;
    question.setAttribute('aria-expanded', 'false');
    question.setAttribute('aria-controls', answerId);
    question.nextElementSibling.id = answerId;
    
    addEvent(question, 'click', () => toggleQuestion(question));
    addEvent(question, 'keydown', handleKeyboardNav);
}

function toggleQuestion(question) {
    const answer = question.nextElementSibling;
    const isExpanded = question.getAttribute('aria-expanded') === 'true';
    
    // Close other questions
    $$('.faq-item__question[aria-expanded="true"]').forEach(otherQuestion => {
        if (otherQuestion !== question) {
            closeQuestion(otherQuestion);
        }
    });
    
    // Toggle current question
    if (isExpanded) {
        closeQuestion(question);
    } else {
        openQuestion(question);
    }
}

function openQuestion(question) {
    const answer = question.nextElementSibling;
    question.setAttribute('aria-expanded', 'true');
    answer.classList.add('active');
    answer.setAttribute('tabindex', '0');
    answer.focus();
}

function closeQuestion(question) {
    const answer = question.nextElementSibling;
    question.setAttribute('aria-expanded', 'false');
    answer.classList.remove('active');
    answer.setAttribute('tabindex', '-1');
}

function handleKeyboardNav(e) {
    if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        e.target.click();
    }
}

function initSmoothScroll() {
    $$('a[href^="#"]').forEach(link => {
        addEvent(link, 'click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href').slice(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                smoothScroll(targetElement);
            }
        });
    });
}
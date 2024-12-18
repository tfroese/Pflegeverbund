export class FAQ {
    constructor() {
        this.initializeAccordions();
    }

    initializeAccordions() {
        const accordions = document.querySelectorAll('.faq-accordion');
        
        accordions.forEach(accordion => {
            accordion.addEventListener('click', (e) => {
                const question = e.target.closest('.faq-item__question');
                if (!question) return;

                this.toggleAnswer(question);
            });
        });
    }

    toggleAnswer(question) {
        const answer = question.nextElementSibling;
        const isExpanded = question.getAttribute('aria-expanded') === 'true';
        
        // Close all other answers in the same accordion
        const accordion = question.closest('.faq-accordion');
        const otherQuestions = accordion.querySelectorAll('.faq-item__question');
        
        otherQuestions.forEach(otherQuestion => {
            if (otherQuestion !== question) {
                otherQuestion.setAttribute('aria-expanded', 'false');
                otherQuestion.nextElementSibling.hidden = true;
            }
        });

        // Toggle current answer
        question.setAttribute('aria-expanded', !isExpanded);
        answer.hidden = isExpanded;

        // Smooth scroll if answer is not in view
        if (!isExpanded) {
            const answerRect = answer.getBoundingClientRect();
            const isInView = (
                answerRect.top >= 0 &&
                answerRect.bottom <= window.innerHeight
            );

            if (!isInView) {
                answer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }
    }
}
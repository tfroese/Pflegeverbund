document.addEventListener('DOMContentLoaded', function() {
    const questions = document.querySelectorAll('.faq-item__question');
    
    questions.forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            const isExpanded = question.getAttribute('aria-expanded') === 'true';
            
            // Toggle current question
            question.setAttribute('aria-expanded', !isExpanded);
            answer.style.display = isExpanded ? 'none' : 'block';
            
            // Optional: Close other questions
            if (!isExpanded) {
                questions.forEach(otherQuestion => {
                    if (otherQuestion !== question) {
                        otherQuestion.setAttribute('aria-expanded', 'false');
                        otherQuestion.nextElementSibling.style.display = 'none';
                    }
                });
            }
        });
    });
});
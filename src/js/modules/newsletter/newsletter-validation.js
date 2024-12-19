import { $ } from '../../utils/dom.js';

export function initNewsletterValidation() {
    const form = $('#newsletterForm');
    const emailInput = $('#newsletterEmail');
    
    if (!form || !emailInput) return;

    emailInput.addEventListener('input', () => {
        const isValid = emailInput.checkValidity();
        emailInput.classList.toggle('is-invalid', !isValid);
    });

    form.addEventListener('submit', (e) => {
        if (!form.checkValidity()) {
            e.preventDefault();
            showValidationErrors(form);
        }
    });
}

function showValidationErrors(form) {
    const inputs = form.querySelectorAll('input:invalid');
    inputs.forEach(input => {
        input.classList.add('is-invalid');
    });
}
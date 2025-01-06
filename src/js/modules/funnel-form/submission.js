import { $$ } from '../../utils/dom.js';
import { showError } from './validation-ui.js';

export function initFormSubmission(form) {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        
        if (!validateTopics(form)) {
            return;
        }

        try {
            const response = await submitForm(form);
            if (response.ok) {
                showSuccessView(form);
            } else {
                throw new Error('Submission failed');
            }
        } catch (error) {
            console.error('Form submission error:', error);
            alert('Es gab ein Problem beim Senden des Formulars. Bitte versuchen Sie es später erneut.');
        }
    });
}

function validateTopics(form) {
    const topicCheckboxes = $$('input[type="checkbox"][name^="lead_topic_"]', form);
    const topicsContainer = topicCheckboxes[0]?.closest('.flex-content');
    
    if (!Array.from(topicCheckboxes).some(cb => cb.checked)) {
        if (topicsContainer) {
            showError(topicCheckboxes[0], 'Bitte wählen Sie mindestens ein Thema aus');
            topicsContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        return false;
    }
    return true;
}

async function submitForm(form) {
    const formData = new FormData(form);
    return fetch('api/funnel.send.php', {
        method: 'POST',
        body: formData
    });
}

function showSuccessView(form) {
    const currentFieldset = form.querySelector('fieldset.active');
    const successView = form.querySelector('#successView');
    if (!successView) return;

    currentFieldset.classList.add('slide-up');
    currentFieldset.addEventListener('animationend', () => {
        currentFieldset.classList.remove('active', 'slide-up');
        currentFieldset.style.display = 'none';
    }, { once: true });

    successView.classList.add('slide-down');
    successView.style.display = 'block';
    successView.addEventListener('animationend', () => {
        successView.classList.remove('slide-down');
    }, { once: true });
}
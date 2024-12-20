import { $ } from '../utils/dom.js';

export function initHeaderForm() {
    const form = $('#headerForm');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const messageEl = $('#headerFormMessage');
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                showMessage(messageEl, data.message, 'success');
                form.reset();
            } else {
                showMessage(messageEl, data.error, 'error');
            }
        } catch (error) {
            showMessage(messageEl, 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.', 'error');
        }
    });
}

function showMessage(element, message, type) {
    if (!element) return;

    element.textContent = message;
    element.className = `header-form__message header-form__message--${type}`;
    element.hidden = false;

    if (type === 'success') {
        setTimeout(() => {
            element.hidden = true;
        }, 5000);
    }
}
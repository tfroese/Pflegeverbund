import { $ } from '../../utils/dom.js';

export function showMessage(message, type) {
    const messageEl = $('#contactMessage');
    if (!messageEl) return;

    messageEl.textContent = message;
    messageEl.className = `contact-form__message contact-form__message--${type}`;
    messageEl.hidden = false;

    if (type === 'success') {
        // Scroll to message
        messageEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Hide success messages after 5 seconds
    if (type === 'success') {
        setTimeout(() => {
            messageEl.hidden = true;
        }, 5000);
    }
}
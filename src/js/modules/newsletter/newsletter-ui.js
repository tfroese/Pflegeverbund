import { $ } from '../../utils/dom.js';

export function showMessage(message, type) {
    const messageEl = $('#newsletterMessage');
    if (!messageEl) return;

    messageEl.textContent = message;
    messageEl.className = `newsletter-form__message newsletter-form__message--${type}`;
    messageEl.hidden = false;

    // Hide message after 5 seconds
    setTimeout(() => {
        messageEl.hidden = true;
    }, 5000);
}
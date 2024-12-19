import { $ } from '../../utils/dom.js';
import { showMessage } from './newsletter-ui.js';

export function initNewsletterForm() {
    const form = $('#newsletterForm');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                showMessage(data.message, 'success');
                form.reset();
            } else {
                showMessage(data.error, 'error');
            }
        } catch (error) {
            showMessage('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.', 'error');
        }
    });
}
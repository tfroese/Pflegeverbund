export class ContactForm {
    constructor() {
        this.form = document.getElementById('contactForm');
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        this.form?.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    async handleSubmit(event) {
        event.preventDefault();
        const formData = new FormData(this.form);
        const data = Object.fromEntries(formData.entries());

        try {
            const response = await fetch('/api/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                this.showSuccess();
            } else {
                this.showError();
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            this.showError();
        }
    }

    showSuccess() {
        const message = document.createElement('div');
        message.className = 'form__message form__message--success';
        message.textContent = 'Vielen Dank für Ihre Nachricht. Wir werden uns schnellstmöglich bei Ihnen melden.';
        this.form.replaceWith(message);
    }

    showError() {
        const errorMessage = document.createElement('div');
        errorMessage.className = 'form__message form__message--error';
        errorMessage.textContent = 'Es ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.';
        this.form.insertBefore(errorMessage, this.form.firstChild);
    }
}
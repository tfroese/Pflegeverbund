export function showError(element, message) {
    const container = element.closest('.input-group') || element.closest('.input-field');
    if (container) {
        container.classList.add('has-error');
        
        let errorMessage = container.querySelector('.error-message');
        if (!errorMessage) {
            errorMessage = document.createElement('div');
            errorMessage.className = 'error-message';
            container.appendChild(errorMessage);
        }
        errorMessage.textContent = message;
        errorMessage.style.display = 'block';
    }
}

export function clearErrors(fieldset) {
    fieldset.querySelectorAll('.has-error').forEach(el => {
        el.classList.remove('has-error');
    });
    fieldset.querySelectorAll('.error-message').forEach(el => {
        el.style.display = 'none';
    });
    const fieldsetError = fieldset.querySelector('.fieldset-error');
    if (fieldsetError) {
        fieldsetError.style.display = 'none';
    }
}
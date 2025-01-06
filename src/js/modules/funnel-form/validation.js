import { $, $$ } from '../../utils/dom.js';
import { showError, clearErrors } from './validation-ui.js';

export function initFormValidation(form, state) {
    // Add validation to navigation buttons
    $$('[data-link="next"]', form).forEach(button => {
        button.addEventListener('click', (event) => {
            const currentFieldset = state.fieldsets[state.currentFieldset];
            if (!validateFieldset(currentFieldset)) {
                event.preventDefault();
            }
        });
    });
}

export function validateFieldset(fieldset) {
    clearErrors(fieldset);
    let isValid = true;
    let firstInvalidElement = null;

    // Validate radio groups
    const radioGroups = new Set(
        Array.from(fieldset.querySelectorAll('input[type="radio"][required]'))
            .map(radio => radio.name)
    );
    
    radioGroups.forEach(name => {
        const radios = fieldset.querySelectorAll(`input[name="${name}"]`);
        const checked = Array.from(radios).some(radio => radio.checked);
        if (!checked) {
            isValid = false;
            const container = radios[0].closest('.input-group');
            if (container && !firstInvalidElement) {
                firstInvalidElement = container;
            }
            showError(radios[0], 'Bitte wählen Sie eine Option aus');
        }
    });

    // Validate other required fields
    fieldset.querySelectorAll('input[required]:not([type="radio"])').forEach(input => {
        if (!input.value || (input.type === 'checkbox' && !input.checked)) {
            isValid = false;
            if (!firstInvalidElement) {
                firstInvalidElement = input;
            }
            const message = input.type === 'checkbox' 
                ? 'Bitte stimmen Sie den Bedingungen zu'
                : 'Dieses Feld ist erforderlich';
            showError(input, message);
        }
    });

    if (!isValid && firstInvalidElement) {
        showFieldsetError(fieldset);
        firstInvalidElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    return isValid;
}

function showFieldsetError(fieldset) {
    let fieldsetError = fieldset.querySelector('.fieldset-error');
    if (!fieldsetError) {
        fieldsetError = document.createElement('div');
        fieldsetError.className = 'fieldset-error';
        fieldset.appendChild(fieldsetError);
    }
    fieldsetError.textContent = 'Bitte füllen Sie alle erforderlichen Felder aus';
    fieldsetError.style.display = 'block';
}
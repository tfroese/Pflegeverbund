import { initFormValidation } from './validation.js';
import { initFormNavigation } from './navigation.js';
import { initFormSubmission } from './submission.js';
import { initFormIcons } from './icons.js';
import { $, $$ } from '../../utils/dom.js';

export function initHeaderForm() {
    const form = $('#questionnaireForm');
    if (!form) return;

    const state = {
        currentFieldset: 0,
        fieldsets: $$('fieldset'),
        skipLocationFieldset: false
    };

    // Initialize all form modules
    initFormValidation(form, state);
    initFormNavigation(form, state);
    initFormSubmission(form);
    initFormIcons();

    // Show initial fieldset
    showFieldset(state.currentFieldset, state.fieldsets);
}

function showFieldset(index, fieldsets) {
    fieldsets.forEach((fieldset, i) => {
        if (i === index) {
            fieldset.classList.add('active');
        } else {
            fieldset.classList.remove('active');
        }
    });
}
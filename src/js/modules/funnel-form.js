import { $, $$ } from '../utils/dom.js';

export function initHeaderForm() {
    const form = $('#questionnaireForm');
    if (!form) return;

    let currentFieldset = 0;
    const fieldsets = $$('fieldset');
    let skipLocationFieldset = false;

    function showFieldset(index) {
        fieldsets.forEach((fieldset, i) => {
            if (i === index) {
                fieldset.classList.add('active');
            } else {
                fieldset.classList.remove('active');
            }
        });
    }

    function validateFieldset(fieldset) {
        let isValid = true;
        let invalidField = null;

        // Check all required fields
        const requiredFields = fieldset.querySelectorAll('[required]');
        requiredFields.forEach(input => {
            // For radio buttons
            if (input.type === 'radio') {
                const name = input.name;
                if (!fieldset.querySelector(`input[name="${name}"]:checked`)) {
                    isValid = false;
                    if (!invalidField) invalidField = input;
                }
            }
            // For other fields
            else if (!input.value || (input.type === 'checkbox' && !input.checked)) {
                isValid = false;
                if (!invalidField) invalidField = input;
            }
        });

        if (invalidField) {
            invalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            invalidField.focus();

            if (invalidField.type === 'radio') {
                alert('Bitte wählen Sie eine Option aus.');
            }
        }

        return isValid;
    }

    function nextFieldset(event) {
        event.preventDefault();
        const current = fieldsets[currentFieldset];

        if (!validateFieldset(current)) {
            return;
        }

        // Check for free products only
        if (currentFieldset === 2) {
            const freeProductsOnly = 
                $('#lead_topic_free_products')?.checked &&
                !$('#lead_topic_free_consulting')?.checked &&
                !$('#lead_topic_housekeeping')?.checked;
            skipLocationFieldset = freeProductsOnly;
        }

        animateFieldsets(true);
    }

    function previousFieldset(event) {
        event.preventDefault();
        animateFieldsets(false);
    }

    function animateFieldsets(forward) {
        const current = fieldsets[currentFieldset];
        let next, prev;

        if (forward) {
            if (skipLocationFieldset && currentFieldset === 2) {
                currentFieldset += 2;
            } else {
                currentFieldset++;
            }
            if (currentFieldset >= fieldsets.length) {
                currentFieldset = fieldsets.length - 1;
                return;
            }
            next = fieldsets[currentFieldset];
            current.classList.add('slide-out-left');
            current.addEventListener('animationend', () => {
                current.classList.remove('active', 'slide-out-left');
            }, { once: true });
            next.classList.add('slide-in-right', 'active');
            next.addEventListener('animationend', () => {
                next.classList.remove('slide-in-right');
            }, { once: true });
        } else {
            if (skipLocationFieldset && currentFieldset === 4) {
                currentFieldset -= 2;
            } else {
                currentFieldset--;
            }
            if (currentFieldset < 0) {
                currentFieldset = 0;
                return;
            }
            prev = fieldsets[currentFieldset];
            current.classList.add('slide-out-right');
            current.addEventListener('animationend', () => {
                current.classList.remove('active', 'slide-out-right');
            }, { once: true });
            prev.classList.add('slide-in-left', 'active');
            prev.addEventListener('animationend', () => {
                prev.classList.remove('slide-in-left');
            }, { once: true });
        }
    }

    // Set up radio and checkbox icons
    $$('.input-group input[type="radio"], .input-group input[type="checkbox"]').forEach(input => {
        const label = input.nextElementSibling;
        const iconUrl = input.dataset.image;
        if (iconUrl && label) {
            label.style.setProperty('--icon-url', `url(../../../src/images/form/${iconUrl})`);

        }
    });

    // Form submission
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(form);

        try {
            const response = await fetch('api/funnel.send.php', {
                method: 'POST',
                body: formData
            });
            
            if (response.ok) {
                showSuccessView();
            } else {
                alert('Es gab ein Problem beim Senden des Formulars. Bitte versuchen Sie es später erneut.');
            }
        } catch (error) {
            alert('Es gab ein Problem beim Senden des Formulars. Bitte versuchen Sie es später erneut.');
        }
    });

    function showSuccessView() {
        const current = fieldsets[currentFieldset];
        const successView = $('#successView');
        if (!successView) return;

        current.classList.add('slide-up');
        current.addEventListener('animationend', () => {
            current.classList.remove('active', 'slide-up');
            current.style.display = 'none';
        }, { once: true });

        successView.classList.add('slide-down');
        successView.style.display = 'block';
        successView.addEventListener('animationend', () => {
            successView.classList.remove('slide-down');
        }, { once: true });
    }

    // Initialize
    showFieldset(currentFieldset);

    // Set up navigation buttons
    $$('[data-link]').forEach(button => {
        button.addEventListener('click', (event) => {
            const linkType = button.dataset.link;
            if (linkType === 'next') {
                nextFieldset(event);
            } else if (linkType === 'back') {
                previousFieldset(event);
            }
        });
    });

    // Handle Enter key
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            if (currentFieldset < fieldsets.length - 1) {
                nextFieldset(event);
            } else {
                form.requestSubmit();
            }
        }
    });

    // Validate topics on submit
    form.addEventListener('submit', (e) => {
        const topicCheckboxes = $$('input[type="checkbox"][name^="lead_topic_"]');
        if (!Array.from(topicCheckboxes).some(cb => cb.checked)) {
            e.preventDefault();
            alert('Bitte wählen Sie mindestens ein Thema aus.');
        }
    });
}
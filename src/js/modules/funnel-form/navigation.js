import { $$ } from '../../utils/dom.js';

export function initFormNavigation(form, state) {
    $$('[data-link]', form).forEach(button => {
        button.addEventListener('click', (event) => {
            const linkType = button.dataset.link;
            if (linkType === 'next') {
                handleNext(event, state);
            } else if (linkType === 'back') {
                handleBack(event, state);
            }
        });
    });
}

function handleNext(event, state) {
    event.preventDefault();
    
    if (state.skipLocationFieldset && state.currentFieldset === 2) {
        state.currentFieldset += 2;
    } else {
        state.currentFieldset++;
    }
    
    if (state.currentFieldset >= state.fieldsets.length) {
        state.currentFieldset = state.fieldsets.length - 1;
        return;
    }
    
    animateFieldsets(true, state);
}

function handleBack(event, state) {
    event.preventDefault();
    
    if (state.skipLocationFieldset && state.currentFieldset === 4) {
        state.currentFieldset -= 2;
    } else {
        state.currentFieldset--;
    }
    
    if (state.currentFieldset < 0) {
        state.currentFieldset = 0;
        return;
    }
    
    animateFieldsets(false, state);
}

function animateFieldsets(forward, state) {
    const current = state.fieldsets[state.currentFieldset];
    let next, prev;

    if (forward) {
        next = state.fieldsets[state.currentFieldset];
        current.classList.add('slide-out-left');
        current.addEventListener('animationend', () => {
            current.classList.remove('active', 'slide-out-left');
        }, { once: true });
        next.classList.add('slide-in-right', 'active');
        next.addEventListener('animationend', () => {
            next.classList.remove('slide-in-right');
        }, { once: true });
    } else {
        prev = state.fieldsets[state.currentFieldset];
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
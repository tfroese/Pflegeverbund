import { $$ } from '../../utils/dom.js';

export function initFormIcons() {
    $$('.input-group input[type="radio"], .input-group input[type="checkbox"]').forEach(input => {
        const label = input.nextElementSibling;
        const iconUrl = input.dataset.image;
        if (iconUrl && label) {
            label.style.setProperty('--icon-url', `url('../../images/form/${iconUrl}')`);
        }
    });
}
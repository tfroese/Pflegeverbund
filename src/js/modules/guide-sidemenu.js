export function initGuideSidemenu() {
    const toggles = document.querySelectorAll('.guide-sidemenu__toggle');
    
    toggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            const itemsId = toggle.getAttribute('aria-controls');
            const items = document.getElementById(itemsId);
            
            // Close all other expanded items
            if (!isExpanded) {
                toggles.forEach(otherToggle => {
                    if (otherToggle !== toggle && otherToggle.getAttribute('aria-expanded') === 'true') {
                        const otherId = otherToggle.getAttribute('aria-controls');
                        const otherItems = document.getElementById(otherId);
                        otherToggle.setAttribute('aria-expanded', 'false');
                        otherItems.classList.remove('is-visible');
                    }
                });
            }
            
            // Toggle current item
            toggle.setAttribute('aria-expanded', !isExpanded);
            items.classList.toggle('is-visible');
        });
    });
}
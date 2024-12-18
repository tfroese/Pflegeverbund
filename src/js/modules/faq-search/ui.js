export function createResultHTML(result, isSelected) {
    const detailUrl = `/faq/${result.id}/${createUrlSlug(result.question)}`;
    
    return `
        <div class="faq-search__result ${isSelected ? 'is-selected' : ''}" 
             data-faq-id="${result.id}"
             data-faq-url="${detailUrl}"
             role="option"
             aria-selected="${isSelected}">
            <div class="faq-search__result-question">${result.question}</div>
            <div class="faq-search__result-category">${result.category_name}</div>
        </div>
    `;
}

export function createNoResultsHTML() {
    return '<div class="faq-search__result">Keine Ergebnisse gefunden</div>';
}

export function navigateToFAQ(faqId, faqUrl) {
    // Check if we're on the FAQ overview page
    if (window.location.pathname.endsWith('/faq')) {
        const targetQuestion = document.querySelector(`.faq-item[data-faq-id="${faqId}"]`);
        if (targetQuestion) {
            targetQuestion.scrollIntoView({ behavior: 'smooth', block: 'center' });
            const questionButton = targetQuestion.querySelector('.faq-question');
            if (questionButton && questionButton.getAttribute('aria-expanded') === 'false') {
                questionButton.click();
            }
            return true;
        }
    }
    
    // If we're not on the FAQ page or the question isn't found, navigate to the detail page
    window.location.href = faqUrl;
    return false;
}

function createUrlSlug(text) {
    return text
        .toLowerCase()
        .replace(/[äöüß]/g, char => {
            const replacements = { 'ä': 'ae', 'ö': 'oe', 'ü': 'ue', 'ß': 'ss' };
            return replacements[char] || char;
        })
        .replace(/[^a-z0-9]+/g, '_')
        .replace(/^_+|_+$/g, '');
}
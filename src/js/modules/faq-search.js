import { $, debounce } from '../utils/dom.js';

export class FAQSearch {
    constructor() {
        this.searchInput = $('#faqSearch');
        this.resultsContainer = $('#searchResults');
        this.selectedIndex = -1;
        this.results = [];
        
        if (!this.searchInput || !this.resultsContainer) return;
        
        this.init();
    }
    
    init() {
        this.searchInput.addEventListener('input', debounce(() => this.handleSearch(), 300));
        this.searchInput.addEventListener('keydown', (e) => this.handleKeyboard(e));
        document.addEventListener('click', (e) => this.handleClickOutside(e));
    }
    
    async handleSearch() {
        const query = this.searchInput.value.trim();
        
        if (query.length < 2) {
            this.hideResults();
            return;
        }
        
        try {
            const response = await fetch(`${window.location.origin}${window.location.pathname}api/search-faq.php?q=${encodeURIComponent(query)}`);
            const data = await response.json();
            
            this.results = data.results;
            this.renderResults();
        } catch (error) {
            console.error('Error searching FAQ:', error);
        }
    }
    
    renderResults() {
        if (this.results.length === 0) {
            this.resultsContainer.innerHTML = '<div class="faq-search__result">Keine Ergebnisse gefunden</div>';
        } else {
            this.resultsContainer.innerHTML = this.results
                .map((result, index) => `
                    <div class="faq-search__result ${index === this.selectedIndex ? 'is-selected' : ''}" 
                         data-faq-id="${result.id}"
                         role="option"
                         aria-selected="${index === this.selectedIndex}">
                        <div class="faq-search__result-question">${result.question}</div>
                        <div class="faq-search__result-category">${result.category_name}</div>
                    </div>
                `).join('');
                
            this.addResultClickHandlers();
        }
        
        this.resultsContainer.hidden = false;
    }
    
    addResultClickHandlers() {
        const results = this.resultsContainer.querySelectorAll('.faq-search__result');
        results.forEach(result => {
            result.addEventListener('click', () => this.handleResultClick(result));
        });
    }
    
    handleResultClick(result) {
        const faqId = result.dataset.faqId;
        const targetQuestion = document.querySelector(`.faq-item[data-faq-id="${faqId}"]`);
        
        if (targetQuestion) {
            targetQuestion.scrollIntoView({ behavior: 'smooth', block: 'center' });
            const questionButton = targetQuestion.querySelector('.faq-question');
            if (questionButton && questionButton.getAttribute('aria-expanded') === 'false') {
                questionButton.click();
            }
        }
        
        this.hideResults();
    }
    
    handleKeyboard(e) {
        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                this.moveSelection(1);
                break;
            case 'ArrowUp':
                e.preventDefault();
                this.moveSelection(-1);
                break;
            case 'Enter':
                e.preventDefault();
                if (this.selectedIndex >= 0) {
                    const selectedResult = this.resultsContainer.querySelector('.faq-search__result.is-selected');
                    if (selectedResult) {
                        this.handleResultClick(selectedResult);
                    }
                }
                break;
            case 'Escape':
                this.hideResults();
                break;
        }
    }
    
    moveSelection(direction) {
        const newIndex = this.selectedIndex + direction;
        if (newIndex >= -1 && newIndex < this.results.length) {
            this.selectedIndex = newIndex;
            this.renderResults();
        }
    }
    
    handleClickOutside(e) {
        if (!this.searchInput.contains(e.target) && !this.resultsContainer.contains(e.target)) {
            this.hideResults();
        }
    }
    
    hideResults() {
        this.resultsContainer.hidden = true;
        this.selectedIndex = -1;
    }
}
import { $, debounce } from '../../utils/dom.js';
import { searchFAQ } from './api.js';
import { createResultHTML, createNoResultsHTML, navigateToFAQ } from './ui.js';

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
        
        this.results = await searchFAQ(query);
        this.renderResults();
    }
    
    renderResults() {
        if (this.results.length === 0) {
            this.resultsContainer.innerHTML = createNoResultsHTML();
        } else {
            this.resultsContainer.innerHTML = this.results
                .map((result, index) => createResultHTML(result, index === this.selectedIndex))
                .join('');
                
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
        const faqUrl = result.dataset.faqUrl;
        
        if (navigateToFAQ(faqId, faqUrl)) {
            this.hideResults();
        }
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
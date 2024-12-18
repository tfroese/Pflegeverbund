import { buildSearchUrl } from '../../utils/url.js';

export async function searchFAQ(query) {
    try {
        const url = buildSearchUrl('search-faq.php', { q: query });
        const response = await fetch(url);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        return data.results;
    } catch (error) {
        console.error('Error searching FAQ:', error);
        return [];
    }
}
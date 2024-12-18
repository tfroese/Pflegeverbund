/**
 * URL utility functions
 */
export function getApiUrl(endpoint) {
    const baseUrl = window.location.pathname.replace(/\/[^/]*$/, '/');
    return `${baseUrl}api/${endpoint}`;
}

export function buildSearchUrl(endpoint, params) {
    const url = new URL(getApiUrl(endpoint), window.location.origin);
    Object.entries(params).forEach(([key, value]) => {
        url.searchParams.append(key, value);
    });
    return url.toString();
}
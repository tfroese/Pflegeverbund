/**
 * Cache busting utilities
 */
export function getTimestamp() {
    return new Date().getTime();
}

export function addCacheBuster(url) {
    // Only add cache buster in development mode
    if (!window.DEV_MODE) {
        return url;
    }
    
    const separator = url.includes('?') ? '&' : '?';
    return `${url}${separator}v=${getTimestamp()}`;
}

export function preventCaching(headers) {
    if (window.DEV_MODE) {
        headers['Cache-Control'] = 'no-cache, no-store, must-revalidate';
        headers['Pragma'] = 'no-cache';
        headers['Expires'] = '0';
    }
    return headers;
}
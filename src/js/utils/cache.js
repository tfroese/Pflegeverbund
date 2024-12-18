/**
 * Cache busting utilities
 */
export function getTimestamp() {
    return new Date().getTime();
}

export function addCacheBuster(url) {
    const separator = url.includes('?') ? '&' : '?';
    return `${url}${separator}v=${getTimestamp()}`;
}
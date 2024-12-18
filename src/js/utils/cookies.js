// Cookie utility functions
export const COOKIE_PREFERENCES_KEY = 'pflegeverbund_cookie_preferences';

export function getCookiePreferences() {
    const preferences = localStorage.getItem(COOKIE_PREFERENCES_KEY);
    return preferences ? JSON.parse(preferences) : null;
}

export function setCookiePreferences(preferences) {
    localStorage.setItem(COOKIE_PREFERENCES_KEY, JSON.stringify(preferences));
}
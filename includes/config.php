<?php
// Development mode configuration
define('DEV_MODE', true); // Set to false in production

// Site configuration
define('SITE_NAME', 'Pflegeverbund');

// URL Configuration
define('SITE_DOMAIN', 'http://localhost:8888');
define('SITE_PATH', '/Pflegeverbundde');
define('SITE_URL', SITE_DOMAIN . SITE_PATH);

// Asset URLs with cache busting in production
define('ASSETS_URL', SITE_PATH . '/src');
define('CSS_URL', ASSETS_URL . '/css');
define('JS_URL', ASSETS_URL . '/js');
define('IMG_URL', ASSETS_URL . '/images');

// Cache control headers based on environment
if (DEV_MODE) {
    // Disable caching in development
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
} else {
    // Enable caching in production
    $cache_time = 60 * 60 * 24; // 24 hours
    header('Cache-Control: public, max-age=' . $cache_time);
}

// Default meta information
$defaultMeta = [
    'title' => 'Pflegeverbund - Ihre Experten für Pflegeberatung',
    'description' => 'Professionelle Pflegeberatung und Unterstützung bei der Beantragung von Pflegeleistungen. Kostenlose Beratung zu Pflegegraden und Pflegehilfsmitteln.'
];

// Development mode helper functions
function asset_url($path) {
    if (DEV_MODE) {
        // Add timestamp for cache busting in development
        return $path . '?v=' . time();
    }
    return $path;
}

// Ensure this file is only included once
if (!defined('CONFIG_LOADED')) {
    define('CONFIG_LOADED', true);
}
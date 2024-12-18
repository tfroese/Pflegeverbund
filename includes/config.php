<?php
// Site configuration
define('SITE_NAME', 'Pflegeverbund');

define('SITE_DOMAIN', 'http://localhost:8888');
define('SITE_PATH', '/Pflegeverbundde');
define('SITE_URL', SITE_DOMAIN . SITE_PATH);

// URL configuration
define('BASE_URL', SITE_PATH);
define('ASSETS_URL', BASE_URL . '/src');
define('CSS_URL', ASSETS_URL . '/css');
define('JS_URL', ASSETS_URL . '/js');
define('IMG_URL', ASSETS_URL . '/images');

// Default meta information
$defaultMeta = [
    'title' => 'Pflegeverbund - Ihre Experten für Pflegeberatung',
    'description' => 'Professionelle Pflegeberatung und Unterstützung bei der Beantragung von Pflegeleistungen. Kostenlose Beratung zu Pflegegraden und Pflegehilfsmitteln.'
];
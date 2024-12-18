<?php
// Check if config is already loaded
if (!defined('CONFIG_LOADED')) {
    require_once __DIR__ . '/../includes/config.php';
}

// Check if functions are already loaded
if (!function_exists('renderComponent')) {
    require_once __DIR__ . '/../includes/functions.php';
}

// Initialize common variables
$pageTitle = $pageTitle ?? null;
$pageDescription = $pageDescription ?? null;
$schemaMarkup = $schemaMarkup ?? null;

// Include header
include __DIR__ . '/header.php';

// Include cookie banner
renderComponent('cookie-banner');

// Main content placeholder
if (isset($content)) {
    echo $content;
}

// Include footer
include __DIR__ . '/footer.php';
?>
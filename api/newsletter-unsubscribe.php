<?php
require_once '../includes/config.php';
require_once '../includes/database.php';
require_once '../includes/newsletter-functions.php';

$token = $_GET['token'] ?? '';

if (!$token) {
    header('Location: ' . SITE_PATH . '/error?message=Invalid unsubscribe token');
    exit;
}

try {
    $result = unsubscribeFromNewsletter($token);
    if ($result['success']) {
        header('Location: ' . SITE_PATH . '/newsletter-unsubscribed');
    } else {
        header('Location: ' . SITE_PATH . '/error?message=' . urlencode($result['error']));
    }
} catch (Exception $e) {
    header('Location: ' . SITE_PATH . '/error?message=An error occurred');
}
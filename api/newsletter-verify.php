<?php
require_once '../includes/config.php';
require_once '../includes/database.php';
require_once '../includes/newsletter-functions.php';

$token = $_GET['token'] ?? '';

if (!$token) {
    header('Location: ' . SITE_PATH . '/error?message=Invalid verification token');
    exit;
}

try {
    $result = verifyNewsletter($token);
    if ($result['success']) {
        header('Location: ' . SITE_PATH . '/newsletter-verified');
    } else {
        header('Location: ' . SITE_PATH . '/error?message=' . urlencode($result['error']));
    }
} catch (Exception $e) {
    header('Location: ' . SITE_PATH . '/error?message=An error occurred');
}
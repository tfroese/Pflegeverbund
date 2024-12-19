<?php
require_once '../includes/config.php';
require_once '../includes/database.php';
require_once '../includes/newsletter-functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$privacyConsent = isset($_POST['privacy_consent']) && $_POST['privacy_consent'] === 'on';

if (!$email) {
    http_response_code(400);
    echo json_encode(['error' => 'Ungültige E-Mail-Adresse']);
    exit;
}

if (!$privacyConsent) {
    http_response_code(400);
    echo json_encode(['error' => 'Bitte stimmen Sie der Datenschutzerklärung zu']);
    exit;
}

try {
    $result = subscribeToNewsletter($email);
    echo json_encode($result);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Ein Fehler ist aufgetreten']);
}
<?php
require_once '../includes/config.php';
require_once '../includes/email-functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Validate required fields
$required = ['name', 'email', 'subject', 'message', 'privacy_consent'];
foreach ($required as $field) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        http_response_code(400);
        echo json_encode(['error' => 'Bitte füllen Sie alle Pflichtfelder aus.']);
        exit;
    }
}

// Validate email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.']);
    exit;
}

// Build email message
$message = "Neue Kontaktanfrage:\n\n";
$message .= "Name: " . $_POST['name'] . "\n";
$message .= "E-Mail: " . $_POST['email'] . "\n";
if (!empty($_POST['phone'])) {
    $message .= "Telefon: " . $_POST['phone'] . "\n";
}
$message .= "Betreff: " . $_POST['subject'] . "\n\n";
$message .= "Nachricht:\n" . $_POST['message'];

try {
    // Send email
    $success = sendEmail(
        'info@pflegeverbund.de',
        'Neue Kontaktanfrage: ' . $_POST['subject'],
        $message
    );

    if ($success) {
        echo json_encode([
            'success' => true,
            'message' => 'Vielen Dank für Ihre Nachricht. Wir werden uns schnellstmöglich bei Ihnen melden.'
        ]);
    } else {
        throw new Exception('Failed to send email');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.']);
}
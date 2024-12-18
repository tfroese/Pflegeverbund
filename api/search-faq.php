<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once '../includes/faq-functions.php';

header('Content-Type: application/json');

$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (strlen($query) < 2) {
    echo json_encode(['results' => []]);
    exit;
}

$results = searchFAQQuestions($query);

echo json_encode(['results' => $results]);
<?php
require_once __DIR__ . '/../database.php';

function getFAQCategories() {
    $db = getDbConnection();
    $sql = "SELECT * FROM faq_categories ORDER BY sort_order ASC, name ASC";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFAQCategoryById($id) {
    $db = getDbConnection();
    $sql = "SELECT * FROM faq_categories WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateFAQCategoryOrder($id, $newOrder) {
    $db = getDbConnection();
    $sql = "UPDATE faq_categories SET sort_order = :sort_order WHERE id = :id";
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        ':id' => $id,
        ':sort_order' => $newOrder
    ]);
}
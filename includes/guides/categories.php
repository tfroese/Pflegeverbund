<?php
require_once __DIR__ . '/../database.php';

function getGuideCategories() {
    $db = getDbConnection();
    $sql = "SELECT * FROM guide_categories ORDER BY sort_order ASC, name ASC";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getGuideCategoryBySlug($slug) {
    $db = getDbConnection();
    $sql = "SELECT * FROM guide_categories WHERE slug = :slug";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':slug', $slug);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateGuideCategoryOrder($id, $newOrder) {
    $db = getDbConnection();
    $sql = "UPDATE guide_categories SET sort_order = :sort_order WHERE id = :id";
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        ':id' => $id,
        ':sort_order' => $newOrder
    ]);
}
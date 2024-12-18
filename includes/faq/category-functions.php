<?php
require_once __DIR__ . '/../database.php';

function getFaqCategories($parentId = null) {
    $db = getDbConnection();
    $sql = "SELECT * FROM faq_categories WHERE parent_id " . ($parentId === null ? "IS NULL" : "= :parent_id");
    $stmt = $db->prepare($sql);
    
    if ($parentId !== null) {
        $stmt->bindParam(':parent_id', $parentId, PDO::PARAM_INT);
    }
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
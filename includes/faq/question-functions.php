<?php
require_once __DIR__ . '/../database.php';

function getFaqQuestions($categoryId) {
    $db = getDbConnection();
    $sql = "SELECT * FROM faq_questions WHERE category_id = :category_id ORDER BY id ASC";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFaqById($id) {
    $db = getDbConnection();
    $sql = "SELECT q.*, c.name as category_name 
            FROM faq_questions q 
            JOIN faq_categories c ON q.category_id = c.id 
            WHERE q.id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
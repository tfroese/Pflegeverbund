<?php
require_once 'database.php';

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

function getFaqQuestionById($id) {
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

function getRelatedQuestions($categoryId, $currentQuestionId, $limit = 3) {
    $db = getDbConnection();
    $sql = "SELECT * FROM faq_questions 
            WHERE category_id = :category_id 
            AND id != :current_id 
            ORDER BY RAND() 
            LIMIT :limit";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
    $stmt->bindParam(':current_id', $currentQuestionId, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
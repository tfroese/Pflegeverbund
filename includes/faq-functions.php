<?php
require_once 'database.php';

/**
 * FAQ utility functions
 */

function getFAQCategories() {
    $db = getDbConnection();
    $sql = "SELECT * FROM faq_categories ORDER BY name ASC";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFAQQuestionsByCategory() {
    $db = getDbConnection();
    $sql = "SELECT q.*, c.name as category_name 
            FROM faq_questions q 
            JOIN faq_categories c ON q.category_id = c.id 
            ORDER BY c.name ASC, q.question ASC";
    
    $stmt = $db->query($sql);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Group questions by category
    $questionsByCategory = [];
    foreach ($questions as $question) {
        $categoryName = $question['category_name'];
        if (!isset($questionsByCategory[$categoryName])) {
            $questionsByCategory[$categoryName] = [];
        }
        $questionsByCategory[$categoryName][] = $question;
    }
    
    return $questionsByCategory;
}

function getFAQQuestion($id) {
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
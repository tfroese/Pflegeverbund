<?php
require_once 'database.php';

/**
 * FAQ utility functions
 */

function getFAQCategories() {
    $db = getDbConnection();
    $sql = "SELECT * FROM faq_categories ORDER BY parent_id IS NULL DESC, name ASC";
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

function searchFAQQuestions($query) {
    $db = getDbConnection();
    $searchTerm = '%' . strtolower($query) . '%';
    
    $sql = "SELECT q.*, c.name as category_name 
            FROM faq_questions q 
            JOIN faq_categories c ON q.category_id = c.id 
            WHERE LOWER(q.question) LIKE :query 
            OR LOWER(q.answer_short) LIKE :query 
            OR LOWER(q.answer_extended) LIKE :query 
            ORDER BY 
                CASE 
                    WHEN LOWER(q.question) LIKE :exact THEN 1
                    WHEN LOWER(q.answer_short) LIKE :exact THEN 2
                    ELSE 3
                END,
                q.question ASC
            LIMIT 10";
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':query', $searchTerm, PDO::PARAM_STR);
    $stmt->bindValue(':exact', strtolower($query), PDO::PARAM_STR);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
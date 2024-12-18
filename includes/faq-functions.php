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

function getFaqQuestions($categoryId) {
    $db = getDbConnection();
    $sql = "SELECT * FROM faq_questions WHERE category_id = :category_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function renderFaqSection($categoryId, $categoryName) {
    $questions = getFaqQuestions($categoryId);
    $subcategories = getFaqCategories($categoryId);
    
    echo "<section class='faq-section' id='category-$categoryId'>";
    echo "<h2 class='faq-section__title'>$categoryName</h2>";
    
    if (!empty($questions)) {
        echo "<div class='faq-accordion'>";
        foreach ($questions as $question) {
            echo "<div class='faq-item'>";
            echo "<button class='faq-item__question' aria-expanded='false' aria-controls='answer-{$question['id']}'>";
            echo htmlspecialchars($question['question']);
            echo "</button>";
            echo "<div class='faq-item__answer' id='answer-{$question['id']}'>";
            echo nl2br(htmlspecialchars($question['answer']));
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    }
    
    if (!empty($subcategories)) {
        echo "<div class='faq-subcategories'>";
        foreach ($subcategories as $subcategory) {
            renderFaqSection($subcategory['id'], $subcategory['name']);
        }
        echo "</div>";
    }
    
    echo "</section>";
}
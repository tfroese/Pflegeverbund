<?php
require_once __DIR__ . '/category-functions.php';
require_once __DIR__ . '/question-functions.php';
require_once __DIR__ . '/../functions.php';

function renderFaqSection($categoryId, $categoryName) {
    $questions = getFaqQuestions($categoryId);
    $subcategories = getFaqCategories($categoryId);
    
    echo "<section class='faq-section' id='category-$categoryId'>";
    echo "<h2 class='faq-section__title'>$categoryName</h2>";
    
    if (!empty($questions)) {
        echo "<div class='faq-accordion'>";
        foreach ($questions as $question) {
            renderComponent('faq-item', ['faq' => $question]);
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
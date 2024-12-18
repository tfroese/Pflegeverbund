<?php
/**
 * FAQ component rendering functions
 */

function renderFaqItem($faq) {
    $detailUrl = SITE_PATH . '/faq/' . $faq['id'] . '/' . createFaqSlug($faq['question']);
    ?>
    <div class="faq-item">
        <button class="faq-item__question" aria-expanded="false" aria-controls="answer-<?= $faq['id'] ?>">
            <?= htmlspecialchars($faq['question']) ?>
        </button>
        <div class="faq-item__answer" id="answer-<?= $faq['id'] ?>">
            <div class="faq-item__short-answer">
                <?= htmlspecialchars($faq['answer_short']) ?>
            </div>
            <div class="faq-item__actions">
                <a href="<?= $detailUrl ?>" class="faq-item__more-link">Mehr erfahren</a>
            </div>
        </div>
    </div>
    <?php
}

function renderFaqSection($categoryId, $categoryName) {
    $questions = getFaqQuestions($categoryId);
    $subcategories = getFaqCategories($categoryId);
    
    echo "<section class='faq-section' id='category-$categoryId'>";
    echo "<h2 class='faq-section__title'>" . htmlspecialchars($categoryName) . "</h2>";
    
    if (!empty($questions)) {
        echo "<div class='faq-accordion'>";
        foreach ($questions as $question) {
            renderFaqItem($question);
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
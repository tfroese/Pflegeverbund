<?php
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../url-functions.php';

/**
 * Get FAQ category by ID
 */
function get_faq_category($category_id) {
    $db = getDbConnection();
    $stmt = $db->prepare("SELECT name FROM faq_categories WHERE id = ?");
    $stmt->execute([$category_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Get FAQ questions for a category
 */
function get_faq_questions($category_id, $limit = null) {
    $db = getDbConnection();
    
    $params = [$category_id];
    $sql = "SELECT * FROM faq_questions 
            WHERE category_id = ? 
            ORDER BY sort_order ASC, id DESC";
            
    if ($limit !== null) {
        $sql .= " LIMIT " . (int)$limit;
    }
    
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Render FAQ category HTML
 */
function render_faq_category($category_id, $limit = null) {
    $category = get_faq_category($category_id);
    
    if (!$category) {
        return '<!-- FAQ category not found -->';
    }
    
    $questions = get_faq_questions($category_id, $limit);
    
    if (empty($questions)) {
        return '<!-- No FAQ questions found -->';
    }
    
    ob_start();
    ?>
    <div class="embedded-faq">
        <h2 class="embedded-faq__title">Häufig gestellte Fragen: <?= htmlspecialchars($category['name']) ?></h2>
        <div class="embedded-faq__list">
            <?php foreach ($questions as $question): ?>
                <div class="embedded-faq__item" data-faq-id="<?= $question['id'] ?>">
                    <button class="embedded-faq__question" aria-expanded="false">
                        <?= htmlspecialchars($question['question']) ?>
                        <span class="embedded-faq__icon"></span>
                    </button>
                    <div class="embedded-faq__answer" hidden>
                        <div class="embedded-faq__content">
                            <?= $question['answer_short'] ?>
                        </div>
                        <a href="<?= SITE_PATH ?>/faq/<?= $question['id'] ?>/<?= createUrlSlug($question['question']) ?>" 
                           class="embedded-faq__more">
                            Mehr erfahren →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
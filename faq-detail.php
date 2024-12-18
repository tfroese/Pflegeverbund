<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/url-functions.php';
require_once 'includes/faq-functions.php';

// Get question ID from URL
$questionId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$question = getFAQQuestion($questionId);

if (!$question) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

$pageTitle = $question['question'];
$pageDescription = substr(strip_tags($question['answer_short']), 0, 160);

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'FAQ', 'url' => SITE_PATH . '/faq'],
    ['label' => $question['category_name'], 'url' => SITE_PATH . '/faq#' . createUrlSlug($question['category_name'])],
    ['label' => $question['question'], 'url' => '#']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <article class="faq-detail">
            <header class="faq-detail__header">
                <h1 class="faq-detail__title"><?= htmlspecialchars($question['question']) ?></h1>
                <p class="faq-detail__category">Kategorie: <?= htmlspecialchars($question['category_name']) ?></p>
            </header>
            
            <div class="faq-detail__content">
            <?= strip_tags($question['answer_extended'], '<b><strong><a><ul><li><ol><p>') ?>
            </div>
            
            <footer class="faq-detail__footer">
                <a href="<?= SITE_PATH ?>/faq" class="btn btn--secondary">
                    ← Zurück zur FAQ-Übersicht
                </a>
            </footer>
        </article>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
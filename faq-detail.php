<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/faq/question-functions.php';
require_once 'includes/faq/format-functions.php';
require_once 'includes/seo-functions.php';
require_once 'includes/faq-schema.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$faq = getFaqById($id);

if (!$faq) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'FAQ', 'url' => SITE_PATH . '/faq'],
    ['label' => $faq['category_name'], 'url' => SITE_PATH . '/faq#category-' . $faq['category_id']],
    ['label' => $faq['question'], 'url' => SITE_PATH . '/faq/' . $id . '/' . createFaqSlug($faq['question'])]
];

$metaTags = generateMetaTags([
    'title' => $faq['question'] . ' - FAQ - ' . SITE_NAME,
    'description' => $faq['answer_short'],
    'og_type' => 'article'
]);

$schemaMarkup = generateSchemaMarkup([
    generateFaqSchema($faq),
    generateBreadcrumbSchema($breadcrumbItems)
]);

include 'components/header.php';
renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <article class="faq-detail">
        <div class="container">
            <h1 class="faq-detail__title"><?= htmlspecialchars($faq['question']) ?></h1>
            
            <div class="faq-detail__content">
                <div class="faq-detail__answer">
                    <?= $faq['answer_extended'] ?>
                </div>
                
                <div class="faq-detail__meta">
                    <p>Kategorie: <a href="<?= SITE_PATH ?>/faq#category-<?= $faq['category_id'] ?>"><?= htmlspecialchars($faq['category_name']) ?></a></p>
                </div>
            </div>
        </div>
    </article>
</main>

<?php include 'components/footer.php'; ?>
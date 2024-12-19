<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/guides/guides.php';
require_once 'includes/guides/categories.php';
require_once 'includes/guides/preview.php';  // Add this line
require_once 'includes/utils/date.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$category = getGuideCategoryBySlug($slug);

if (!$category) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// Get guides for this category
$guides = getPublishedGuidesByCategory($category['id']);

$pageTitle = $category['name'] . ' - Ratgeber';
$pageDescription = $category['description'] ?? 'Informative Ratgeber und Artikel zum Thema ' . $category['name'];

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'Ratgeber', 'url' => SITE_PATH . '/ratgeber'],
    ['label' => $category['name'], 'url' => '#']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <header class="category-header">
            <h1 class="category-header__title"><?= htmlspecialchars($category['name']) ?></h1>
            <?php if ($category['description']): ?>
                <p class="category-header__description"><?= htmlspecialchars($category['description']) ?></p>
            <?php endif; ?>
        </header>

        <div class="guides-grid">
            <?php foreach ($guides as $guide): ?>
                <?php renderGuidePreview($guide); ?>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
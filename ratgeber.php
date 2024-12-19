<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/guides/guides.php';
require_once 'includes/guides/categories.php';
require_once 'includes/guides/sidemenu.php';
require_once 'includes/guides/preview.php';  // Add this line
require_once 'includes/utils/date.php';

// Get all published guides grouped by category
$guidesByCategory = getPublishedGuidesByCategory();

// Get all categories for sidemenu
$categories = getGuideCategories();

$pageTitle = 'Ratgeber - Pflegeverbund';
$pageDescription = 'Informative Ratgeber und Artikel rund um das Thema Pflege, Pflegegrade und Pflegeleistungen.';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'Ratgeber', 'url' => SITE_PATH . '/ratgeber']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <div class="guide-layout">
            <?php renderGuideSidemenu($categories); ?>
            
            <div class="guides-content">
                <h1 class="page-title">Ratgeber & Informationen</h1>
                <p class="page-description">
                    Hier finden Sie hilfreiche Informationen und Ratgeber rund um das Thema Pflege. 
                    Wir bereiten komplexe Themen verständlich für Sie auf.
                </p>
                
                <?php foreach ($guidesByCategory as $categoryName => $category): ?>
                    <section class="guides-category">
                        <h2 class="guides-category__title"><?= htmlspecialchars($categoryName) ?></h2>
                        <div class="guides-grid">
                            <?php foreach ($category['guides'] as $guide): ?>
                                <?php renderGuidePreview($guide); ?>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
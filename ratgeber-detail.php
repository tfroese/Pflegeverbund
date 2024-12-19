<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/guides/guides.php';
require_once 'includes/guides/categories.php';
require_once 'includes/guides/sidemenu.php';
require_once 'includes/utils/date.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$guide = getGuideBySlug($slug);

if (!$guide) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// Get all categories for sidemenu
$categories = getGuideCategories();

$pageTitle = $guide['headline'] . ' - Ratgeber - ' . SITE_NAME;
$pageDescription = $guide['subheadline'] ?? substr(strip_tags($guide['content']), 0, 160);

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'Ratgeber', 'url' => SITE_PATH . '/ratgeber'],
    ['label' => $guide['category_name'], 'url' => SITE_PATH . '/ratgeber/kategorie/' . $guide['category_slug']],
    ['label' => $guide['headline'], 'url' => '#']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <div class="guide-layout">
            <?php renderGuideSidemenu($categories, $guide); ?>
            
            <article class="guide-detail">
                <header class="guide-detail__header">
                    <div class="guide-detail__category">
                        <a href="<?= SITE_PATH ?>/ratgeber/kategorie/<?= htmlspecialchars($guide['category_slug']) ?>">
                            <?= htmlspecialchars($guide['category_name']) ?>
                        </a>
                    </div>
                    
                    <h1 class="guide-detail__title"><?= htmlspecialchars($guide['headline']) ?></h1>
                    
                    <?php if ($guide['subheadline']): ?>
                        <p class="guide-detail__subtitle"><?= htmlspecialchars($guide['subheadline']) ?></p>
                    <?php endif; ?>
                    
                    <div class="guide-detail__meta">
                        <time datetime="<?= $guide['published_on'] ?>">
                            Veröffentlicht am <?= formatDate($guide['published_on']) ?>
                        </time>
                        <?php if ($guide['updated_on'] > $guide['published_on']): ?>
                            <time datetime="<?= $guide['updated_on'] ?>">
                                Aktualisiert am <?= formatDate($guide['updated_on']) ?>
                            </time>
                        <?php endif; ?>
                    </div>
                </header>
                
                <?php if ($guide['image_path']): ?>
                    <div class="guide-detail__image">
                        <img src="<?= htmlspecialchars($guide['image_path']) ?>" 
                             alt="<?= htmlspecialchars($guide['headline']) ?>">
                    </div>
                <?php endif; ?>
                
                <div class="guide-detail__content">
                    <?= $guide['content'] ?>
                </div>
            </article>
        </div>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
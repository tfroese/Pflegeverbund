<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/guide-functions.php';
require_once 'includes/seo-functions.php';
require_once 'includes/guide-schema.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$guide = getGuideBySlug($slug);

if (!$guide) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'Ratgeber', 'url' => SITE_PATH . '/ratgeber'],
    ['label' => $guide['headline'], 'url' => SITE_PATH . '/ratgeber/' . $guide['link']]
];

// Generate SEO meta tags
$metaTags = generateMetaTags([
    'title' => $guide['headline'] . ' - Ratgeber - ' . SITE_NAME,
    'description' => $guide['subheadline'] ?? substr(strip_tags($guide['content']), 0, 160),
    'og_type' => 'article',
    'og_image' => $guide['image_path'] ? SITE_URL . $guide['image_path'] : null
]);

// Generate Schema.org markup
$schemaMarkup = generateSchemaMarkup([
    generateGuideSchema($guide),
    generateBreadcrumbSchema($breadcrumbItems)
]);

include 'components/header.php';

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <article class="guide-detail" itemscope itemtype="https://schema.org/Article">
        <div class="container">
            <header class="guide-detail__header">
                <h1 class="guide-detail__title" itemprop="headline">
                    <?= htmlspecialchars($guide['headline']) ?>
                </h1>
                
                <?php if ($guide['subheadline']): ?>
                    <p class="guide-detail__subtitle" itemprop="description">
                        <?= htmlspecialchars($guide['subheadline']) ?>
                    </p>
                <?php endif; ?>
                
                <div class="guide-detail__meta">
                    <time datetime="<?= $guide['published_on'] ?>" itemprop="datePublished">
                        Veröffentlicht am <?= formatDate($guide['published_on']) ?>
                    </time>
                    <?php if ($guide['updated_on'] > $guide['published_on']): ?>
                        <time datetime="<?= $guide['updated_on'] ?>" itemprop="dateModified">
                            Aktualisiert am <?= formatDate($guide['updated_on']) ?>
                        </time>
                    <?php endif; ?>
                </div>
            </header>
            
            <?php if ($guide['image_path']): ?>
                <div class="guide-detail__image">
                    <img src="<?= htmlspecialchars($guide['image_path']) ?>" 
                         alt="<?= htmlspecialchars($guide['headline']) ?>"
                         itemprop="image">
                </div>
            <?php endif; ?>
            
            <div class="guide-detail__content" itemprop="articleBody">
                <?= $guide['content'] ?>
            </div>
        </div>
    </article>
</main>

<?php include 'components/footer.php'; ?>
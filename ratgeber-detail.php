<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/guide-functions.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$guide = getGuideBySlug($slug);

if (!$guide) {
    header('Location: ' . SITE_PATH . '/ratgeber');
    exit;
}

$pageTitle = $guide['headline'] . ' - Ratgeber - Pflegeverbund';
$pageDescription = $guide['subheadline'] ?? null;

include 'components/header.php';

renderComponent('breadcrumb', [
    'items' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Ratgeber', 'url' => '/ratgeber'],
        ['label' => $guide['headline'], 'url' => null]
    ]
]);
?>

<main class="main-content">
    <article class="guide-detail">
        <div class="container">
            <header class="guide-detail__header">
                <h1 class="guide-detail__title"><?= htmlspecialchars($guide['headline']) ?></h1>
                
                <?php if ($guide['subheadline']): ?>
                    <p class="guide-detail__subtitle">
                        <?= htmlspecialchars($guide['subheadline']) ?>
                    </p>
                <?php endif; ?>
                
                <div class="guide-detail__meta">
                    <time datetime="<?= $guide['published_on'] ?>">
                        Veröffentlicht am <?= formatDate($guide['published_on']) ?>
                    </time>
                    <?php if ($guide['updated_on'] > $guide['published_on']): ?>
                        <span class="guide-detail__updated">
                            Aktualisiert am <?= formatDate($guide['updated_on']) ?>
                        </span>
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
                <?= $guide['content'] // Note: content is HTML ?>
            </div>
        </div>
    </article>
</main>

<?php include 'components/footer.php'; ?>
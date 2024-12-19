<?php
require_once __DIR__ . '/../utils/date.php';

function renderGuidePreview($guide) {
    ?>
    <article class="guide-preview">
        <?php if ($guide['image_path']): ?>
            <div class="guide-preview__image">
                <img src="<?= htmlspecialchars($guide['image_path']) ?>" 
                     alt="<?= htmlspecialchars($guide['headline']) ?>"
                     loading="lazy">
            </div>
        <?php endif; ?>
        
        <div class="guide-preview__content">
            <div class="guide-preview__category">
                <a href="<?= SITE_PATH ?>/ratgeber/kategorie/<?= htmlspecialchars($guide['category_slug']) ?>">
                    <?= htmlspecialchars($guide['category_name']) ?>
                </a>
            </div>
            
            <h2 class="guide-preview__title">
                <a href="<?= SITE_PATH ?>/ratgeber/<?= htmlspecialchars($guide['link']) ?>">
                    <?= htmlspecialchars($guide['headline']) ?>
                </a>
            </h2>
            
            <?php if ($guide['subheadline']): ?>
                <p class="guide-preview__subtitle">
                    <?= htmlspecialchars($guide['subheadline']) ?>
                </p>
            <?php endif; ?>
            
            <div class="guide-preview__meta">
                <time datetime="<?= $guide['published_on'] ?>">
                    Veröffentlicht am <?= formatDate($guide['published_on']) ?>
                </time>
                <?php if ($guide['updated_on'] > $guide['published_on']): ?>
                    <span class="guide-preview__updated">
                        Aktualisiert am <?= formatDate($guide['updated_on']) ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </article>
    <?php
}
?>
<?php
require_once 'database.php';

function getGuideCategories() {
    $db = getDbConnection();
    $sql = "SELECT * FROM guide_categories ORDER BY name ASC";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPublishedGuidesByCategory($limit = null, $offset = 0) {
    $db = getDbConnection();
    $currentDate = date('Y-m-d H:i:s');
    
    $sql = "SELECT g.*, c.name as category_name, c.slug as category_slug 
            FROM guides g 
            JOIN guide_categories c ON g.category_id = c.id 
            WHERE g.published_on <= :current_date 
            ORDER BY g.published_on DESC";
    
    if ($limit !== null) {
        $sql .= " LIMIT :limit OFFSET :offset";
    }
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':current_date', $currentDate);
    
    if ($limit !== null) {
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    }
    
    $stmt->execute();
    $guides = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Group guides by category
    $guidesByCategory = [];
    foreach ($guides as $guide) {
        $categoryName = $guide['category_name'];
        if (!isset($guidesByCategory[$categoryName])) {
            $guidesByCategory[$categoryName] = [
                'slug' => $guide['category_slug'],
                'guides' => []
            ];
        }
        $guidesByCategory[$categoryName]['guides'][] = $guide;
    }
    
    return $guidesByCategory;
}

function getGuideBySlug($slug) {
    $db = getDbConnection();
    $currentDate = date('Y-m-d H:i:s');
    
    $sql = "SELECT g.*, c.name as category_name, c.slug as category_slug 
            FROM guides g 
            JOIN guide_categories c ON g.category_id = c.id 
            WHERE g.link = :slug 
            AND g.published_on <= :current_date";
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':current_date', $currentDate);
    
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function formatDate($date) {
    return date('d.m.Y', strtotime($date));
}

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
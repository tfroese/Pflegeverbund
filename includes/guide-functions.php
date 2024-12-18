<?php
require_once 'database.php';

function getPublishedGuides($limit = null, $offset = 0) {
    $db = getDbConnection();
    $currentDate = date('Y-m-d H:i:s');
    
    $sql = "SELECT * FROM guides 
            WHERE published_on <= :current_date 
            ORDER BY published_on DESC";
    
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
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getGuideBySlug($slug) {
    $db = getDbConnection();
    $currentDate = date('Y-m-d H:i:s');
    
    $sql = "SELECT * FROM guides 
            WHERE link = :slug 
            AND published_on <= :current_date";
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':current_date', $currentDate);
    
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function formatDate($date) {
    return date('d.m.Y', strtotime($date));
}

function createUrlSlug($headline) {
    // Convert to lowercase and replace spaces with underscores
    $slug = mb_strtolower($headline, 'UTF-8');
    
    // Replace German special characters
    $replacements = [
        'ä' => 'ae',
        'ö' => 'oe',
        'ü' => 'ue',
        'ß' => 'ss'
    ];
    $slug = str_replace(array_keys($replacements), array_values($replacements), $slug);
    
    // Remove all characters except letters, numbers, and underscores
    $slug = preg_replace('/[^a-z0-9_]+/', '_', $slug);
    
    // Remove multiple consecutive underscores
    $slug = preg_replace('/_+/', '_', $slug);
    
    // Remove leading and trailing underscores
    $slug = trim($slug, '_');
    
    return $slug;
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
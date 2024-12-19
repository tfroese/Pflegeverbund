<?php
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/categories.php';
require_once __DIR__ . '/guides.php';

function getGuidesByCategory($categoryId) {
    $db = getDbConnection();
    $currentDate = date('Y-m-d H:i:s');
    
    $sql = "SELECT * FROM guides 
            WHERE category_id = :category_id 
            AND published_on <= :current_date 
            ORDER BY sort_order ASC, published_on DESC";
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':category_id', $categoryId);
    $stmt->bindParam(':current_date', $currentDate);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function renderGuideSidemenu($categories, $activeGuide = null) {
    ?>
    <aside class="guide-sidemenu">
        <h2 class="guide-sidemenu__title">Kategorien</h2>
        
        <nav class="guide-sidemenu__nav">
            <!-- Overview link -->
            <div class="guide-sidemenu__overview">
                <a href="<?= SITE_PATH ?>/ratgeber" 
                   class="guide-sidemenu__item <?= !$activeGuide ? 'is-current' : '' ?>">
                    Übersicht
                </a>
            </div>

            <?php 
            foreach ($categories as $index => $category): 
                $isActive = $activeGuide ? 
                    $activeGuide['category_slug'] === $category['slug'] : 
                    false;
                $categoryId = 'category-' . $category['slug'];
            ?>
                <div class="guide-sidemenu__category">
                    <button class="guide-sidemenu__toggle <?= $isActive ? 'is-active' : '' ?>"
                            aria-expanded="<?= $isActive ? 'true' : 'false' ?>"
                            aria-controls="<?= $categoryId ?>">
                        <?= htmlspecialchars($category['name']) ?>
                        <span class="guide-sidemenu__icon"></span>
                    </button>
                    
                    <div class="guide-sidemenu__items <?= $isActive ? 'is-visible' : '' ?>" 
                         id="<?= $categoryId ?>">
                        <?php
                        $guides = getGuidesByCategory($category['id']);
                        foreach ($guides as $guide):
                            $isCurrentGuide = $activeGuide && $activeGuide['id'] === $guide['id'];
                        ?>
                            <a href="<?= SITE_PATH ?>/ratgeber/<?= htmlspecialchars($guide['link']) ?>"
                               class="guide-sidemenu__item <?= $isCurrentGuide ? 'is-current' : '' ?>">
                                <?= htmlspecialchars($guide['headline']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </nav>
    </aside>
    <?php
}
?>
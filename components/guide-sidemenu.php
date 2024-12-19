<?php
function renderGuideSidemenu($categories, $activeGuide = null) {
    ?>
    <aside class="guide-sidemenu">
        <h2 class="guide-sidemenu__title">Kategorien</h2>
        
        <nav class="guide-sidemenu__nav">
            <?php foreach ($categories as $category): ?>
                <?php
                $isActive = $activeGuide && $activeGuide['category_slug'] === $category['slug'];
                $categoryId = 'category-' . $category['slug'];
                ?>
                <div class="guide-sidemenu__category">
                    <button class="guide-sidemenu__toggle <?= $isActive ? 'is-active' : '' ?>"
                            aria-expanded="<?= $isActive ? 'true' : 'false' ?>"
                            aria-controls="<?= $categoryId ?>">
                        <?= htmlspecialchars($category['name']) ?>
                        <span class="guide-sidemenu__icon"></span>
                    </button>
                    
                    <div class="guide-sidemenu__items" 
                         id="<?= $categoryId ?>"
                         <?= $isActive ? '' : 'hidden' ?>>
                        <?php
                        // Get guides for this category
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
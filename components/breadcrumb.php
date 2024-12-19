<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php 
            $lastIndex = count($items) - 1;
            foreach ($items as $index => $item): 
                $isLast = $index === $lastIndex;
            ?>
                <li class="breadcrumb-item">
                    <?php if (!$isLast): ?>
                        <a href="<?= htmlspecialchars($item['url']) ?>">
                            <?= htmlspecialchars($item['label']) ?>
                        </a>
                    <?php else: ?>
                        <span class="breadcrumb-current">
                            <?= htmlspecialchars($item['label']) ?>
                        </span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </nav>
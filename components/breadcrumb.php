<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php foreach ($items as $item): ?>
            <li class="breadcrumb-item">
                <a href="<?= htmlspecialchars($item['url']) ?>"><?= htmlspecialchars($item['label']) ?></a>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>

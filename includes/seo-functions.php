<?php
/**
 * SEO utility functions
 */

function generateMetaTags($data = []) {
    $defaults = [
        'title' => SITE_NAME,
        'description' => $GLOBALS['defaultMeta']['description'],
        'robots' => 'index, follow',
        'og_type' => 'website',
        'og_image' => SITE_URL . '/images/og-default.jpg',
        'twitter_card' => 'summary_large_image'
    ];

    $meta = array_merge($defaults, $data);

    // Ensure title doesn't exceed 60 characters
    $meta['title'] = strlen($meta['title']) > 60 
        ? substr($meta['title'], 0, 57) . '...' 
        : $meta['title'];

    // Ensure description doesn't exceed 160 characters
    $meta['description'] = strlen($meta['description']) > 160 
        ? substr($meta['description'], 0, 157) . '...' 
        : $meta['description'];

    ob_start();
    ?>
    <title><?= htmlspecialchars($meta['title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta['description']) ?>">
    <meta name="robots" content="<?= htmlspecialchars($meta['robots']) ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?= htmlspecialchars($meta['og_type']) ?>">
    <meta property="og:url" content="<?= htmlspecialchars(getCurrentUrl()) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($meta['title']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta['description']) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($meta['og_image']) ?>">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="<?= htmlspecialchars($meta['twitter_card']) ?>">
    <meta name="twitter:title" content="<?= htmlspecialchars($meta['title']) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($meta['description']) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($meta['og_image']) ?>">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?= htmlspecialchars(getCurrentUrl()) ?>">
    <?php
    return ob_get_clean();
}

function generateSchemaMarkup($data) {
    if (empty($data)) return '';
    
    return '<script type="application/ld+json">' . json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
}

function getCurrentUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function generateBreadcrumbSchema($items) {
    $breadcrumbList = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => []
    ];

    foreach ($items as $position => $item) {
        $breadcrumbList["itemListElement"][] = [
            "@type" => "ListItem",
            "position" => $position + 1,
            "item" => [
                "@id" => SITE_URL . $item['url'],
                "name" => $item['label']
            ]
        ];
    }

    return $breadcrumbList;
}
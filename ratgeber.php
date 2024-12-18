<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/guide-functions.php';

// Get all published guides
$guides = getPublishedGuides();

$pageTitle = 'Ratgeber - Pflegeverbund';
$pageDescription = 'Informative Ratgeber und Artikel rund um das Thema Pflege, Pflegegrade und Pflegeleistungen.';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'Ratgeber', 'url' => SITE_PATH . '/ratgeber']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <h1 class="page-title">Ratgeber & Informationen</h1>
        <p class="page-description">
            Hier finden Sie hilfreiche Informationen und Ratgeber rund um das Thema Pflege. 
            Wir bereiten komplexe Themen verständlich für Sie auf.
        </p>
        
        <section class="guides-grid">
            <?php foreach ($guides as $guide): ?>
                <?php renderGuidePreview($guide); ?>
            <?php endforeach; ?>
        </section>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/guide-functions.php';

$pageTitle = 'Ratgeber - Pflegeverbund';
$pageDescription = 'Informative Ratgeber und Artikel rund um das Thema Pflege, Pflegegrade und Pflegeleistungen.';

include 'components/header.php';

// Get all published guides
$guides = getPublishedGuides();

renderComponent('breadcrumb', [
    'items' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Ratgeber', 'url' => '/ratgeber']
    ]
]);
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

<?php include 'components/footer.php'; ?>
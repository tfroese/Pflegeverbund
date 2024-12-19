<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Datenschutzerklärung';
$pageDescription = 'Informationen zum Datenschutz und zur Verarbeitung Ihrer personenbezogenen Daten auf Pflegeverbund.de';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'Datenschutzerklärung', 'url' => '#']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <article class="legal-content">
    
        

        </article>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
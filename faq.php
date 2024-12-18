<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/faq-functions.php';

$pageTitle = 'Häufige Fragen (FAQ) - Pflegeverbund';
$pageDescription = 'Häufig gestellte Fragen zur Pflegeberatung, Pflegegraden und Pflegeleistungen. Finden Sie hier Antworten auf Ihre Fragen rund um das Thema Pflege.';

include 'components/header.php';

$breadcrumbItems = [
    'Häufige Fragen (FAQ)' => null
];
renderComponent('breadcrumb', [
    'items' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'FAQ', 'url' => '/faq']
    ]
]);
?>

<main class="main-content">
    <div class="container">
        <h1 class="page-title">Häufige Fragen (FAQ)</h1>
        
        <?php
        $mainCategories = getFaqCategories();
        foreach ($mainCategories as $category) {
            renderFaqSection($category['id'], $category['name']);
        }
        ?>
    </div>
</main>

<?php include 'components/footer.php'; ?>
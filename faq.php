<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/faq/category-functions.php';
require_once 'includes/faq/question-functions.php';
require_once 'includes/faq/format-functions.php';
require_once 'includes/faq/components.php';
require_once 'includes/seo-functions.php';
require_once 'includes/faq-schema.php';

$pageTitle = 'Häufige Fragen (FAQ) - Pflegeverbund';
$pageDescription = 'Häufig gestellte Fragen zur Pflegeberatung, Pflegegraden und Pflegeleistungen. Finden Sie hier Antworten auf Ihre Fragen rund um das Thema Pflege.';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'FAQ', 'url' => SITE_PATH . '/faq']
];

// Generate SEO meta tags
$metaTags = generateMetaTags([
    'title' => $pageTitle,
    'description' => $pageDescription
]);

// Generate Schema.org markup
$schemaMarkup = generateSchemaMarkup([
    generateBreadcrumbSchema($breadcrumbItems)
]);

include 'components/header.php';
renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <h1 class="page-title">Häufige Fragen (FAQ)</h1>
        <p class="page-description">
            Hier finden Sie Antworten auf die am häufigsten gestellten Fragen rund um das Thema Pflege. 
            Sollten Sie weitere Fragen haben, kontaktieren Sie uns gerne.
        </p>
        
        <?php
        $mainCategories = getFaqCategories();
        foreach ($mainCategories as $category) {
            renderFaqSection($category['id'], $category['name']);
        }
        ?>
    </div>
</main>

<?php include 'components/footer.php'; ?>
test
<?php
$pageTitle = 'Häufige Fragen (FAQ) - Pflegeverbund';
$pageDescription = 'Häufig gestellte Fragen zur Pflegeberatung, Pflegegraden und Pflegeleistungen. Finden Sie hier Antworten auf Ihre Fragen rund um das Thema Pflege.';

include 'components/header.php';

$breadcrumbItems = [
    'Häufige Fragen (FAQ)' => null
];
include 'components/breadcrumb.php';
renderBreadcrumb($breadcrumbItems);
?>

<main class="main-content">
    <div class="container">
        <h1 class="page-title">Häufige Fragen (FAQ)</h1>
        
        <section class="faq-section">
            <!-- FAQ content here -->
        </section>
    </div>
</main>

<?php include 'components/footer.php'; ?>
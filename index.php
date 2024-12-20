<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = null; // Use default
$pageDescription = null; // Use default
$schemaMarkup = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Pflegeverbund GmbH",
  "url": "' . SITE_URL . '",
  "logo": "' . SITE_URL . '/images/logo.svg",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+49-xxx-xxxxxxx",
    "contactType": "customer service"
  },
  "sameAs": [
    "https://www.facebook.com/pflegeverbund",
    "https://www.linkedin.com/company/pflegeverbund"
  ]
}
</script>';

// Start output buffering
ob_start();
?>

<header class="header">
    <div class="header__content">
        <h1 class="header__title">Professionelle Pflegeberatung für Sie und Ihre Angehörigen</h1>
        <p class="header__subtitle">Wir unterstützen Sie bei der Beantragung von Pflegeleistungen und beraten Sie kostenlos zu allen Fragen rund um die Pflege.</p>
        <?php renderComponent('header-form'); ?>
        Test
    </div>
</header>

<main class="main-content">
    <div class="container">
        <!-- Main content here -->
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
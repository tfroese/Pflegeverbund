<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Impressum';
$pageDescription = 'Impressum und rechtliche Informationen von Pflegeverbund.de';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'Impressum', 'url' => '#']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <article class="legal-content">
            <h1>Impressum</h1>

            <section>
                <h2>Angaben gemäß § 5 TMG</h2>
                <p>Pflegeverbund GmbH<br>
                Musterstraße 123<br>
                12345 Musterstadt</p>
            </section>

            <section>
                <h2>Kontakt</h2>
                <p>Telefon: +49 (0) xxx xxx xxx<br>
                E-Mail: info@pflegeverbund.de</p>
            </section>

            <section>
                <h2>Vertreten durch</h2>
                <p>Geschäftsführer: Max Mustermann</p>
            </section>

            <section>
                <h2>Registereintrag</h2>
                <p>Eintragung im Handelsregister<br>
                Registergericht: Amtsgericht Musterstadt<br>
                Registernummer: HRB xxxxx</p>
            </section>

            <section>
                <h2>Umsatzsteuer-ID</h2>
                <p>Umsatzsteuer-Identifikationsnummer gemäß §27 a Umsatzsteuergesetz:<br>
                DE XXX XXX XXX</p>
            </section>

            <section>
                <h2>Berufsbezeichnung und berufsrechtliche Regelungen</h2>
                <p>Berufsbezeichnung: Pflegedienst<br>
                Zuständige Kammer: Pflegekammer Musterland<br>
                Verliehen durch: Bundesrepublik Deutschland</p>
            </section>
        </article>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
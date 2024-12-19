<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Allgemeine Geschäftsbedingungen';
$pageDescription = 'Die Allgemeinen Geschäftsbedingungen von Pflegeverbund.de';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'AGB', 'url' => '#']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <article class="legal-content">
            <h1>Allgemeine Geschäftsbedingungen</h1>

            <section>
                <h2>1. Geltungsbereich</h2>
                <p>Diese Allgemeinen Geschäftsbedingungen gelten für alle gegenwärtigen und zukünftigen Geschäftsbeziehungen zwischen der Pflegeverbund GmbH (nachfolgend "Anbieter") und dem Kunden (nachfolgend "Auftraggeber").</p>
            </section>

            <section>
                <h2>2. Vertragsschluss</h2>
                <p>Der Vertrag kommt durch die Annahme des Auftrags durch den Anbieter zustande. Die Annahme kann entweder schriftlich (z.B. durch Auftragsbestätigung) oder durch Erbringung der Dienstleistung erklärt werden.</p>
            </section>

            <section>
                <h2>3. Leistungsumfang</h2>
                <p>Der Umfang der Leistungen ergibt sich aus der aktuellen Leistungsbeschreibung zum Zeitpunkt des Vertragsschlusses. Der Anbieter behält sich Änderungen der Leistungsbeschreibung vor, soweit dies aus triftigen Gründen erforderlich ist.</p>
            </section>

            <section>
                <h2>4. Preise und Zahlungsbedingungen</h2>
                <p>Alle Preise verstehen sich in Euro inklusive der gesetzlichen Mehrwertsteuer. Rechnungen sind innerhalb von 14 Tagen nach Rechnungsstellung ohne Abzug zur Zahlung fällig.</p>
            </section>

            <section>
                <h2>5. Haftung</h2>
                <p>Der Anbieter haftet für Schäden, die auf vorsätzlichem oder grob fahrlässigem Verhalten beruhen, sowie für Schäden aus der Verletzung des Lebens, des Körpers oder der Gesundheit, die auf einer fahrlässigen Pflichtverletzung beruhen.</p>
            </section>

            <section>
                <h2>6. Datenschutz</h2>
                <p>Der Anbieter erhebt und verwendet personenbezogene Daten des Auftraggebers ausschließlich im Rahmen der Bestimmungen des geltenden Datenschutzrechts. Weitere Informationen zum Datenschutz finden Sie in unserer Datenschutzerklärung.</p>
            </section>
        </article>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
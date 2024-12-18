<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = '500 - Interner Server-Fehler';
$pageDescription = 'Es ist ein unerwarteter Fehler aufgetreten. Bitte versuchen Sie es später erneut.';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => '500 - Interner Server-Fehler', 'url' => '#']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <div class="error-page">
            <div class="error-page__content">
                <h1 class="error-page__title">500 - Interner Server-Fehler</h1>
                <p class="error-page__message">
                    Entschuldigung, es ist ein unerwarteter Fehler aufgetreten. 
                    Unsere Techniker wurden automatisch benachrichtigt und arbeiten an einer Lösung.
                    Bitte versuchen Sie es in einigen Minuten erneut.
                </p>
                
                <div class="error-page__actions">
                    <a href="<?= SITE_PATH ?>/" class="btn btn--primary">Zur Startseite</a>
                    <button onclick="location.reload()" class="btn btn--secondary">Seite neu laden</button>
                </div>
                
                <div class="error-page__help">
                    <h2>Alternative Kontaktmöglichkeiten</h2>
                    <ul>
                        <li>Telefon: <a href="tel:+49xxx">+49 (0) xxx xxx xxx</a></li>
                        <li>E-Mail: <a href="mailto:info@pflegeverbund.de">info@pflegeverbund.de</a></li>
                        <li><a href="<?= SITE_PATH ?>/kontakt">Kontaktformular</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
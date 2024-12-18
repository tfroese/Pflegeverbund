<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = '404 - Seite nicht gefunden';
$pageDescription = 'Die angeforderte Seite konnte leider nicht gefunden werden.';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => '404 - Seite nicht gefunden', 'url' => '#']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <div class="error-page">
            <div class="error-page__content">
                <h1 class="error-page__title">404 - Seite nicht gefunden</h1>
                <p class="error-page__message">
                    Entschuldigung, die von Ihnen gesuchte Seite konnte leider nicht gefunden werden.
                    Möglicherweise wurde sie verschoben oder gelöscht.
                </p>
                
                <div class="error-page__actions">
                    <a href="<?= SITE_PATH ?>/" class="btn btn--primary">Zur Startseite</a>
                    <button onclick="history.back()" class="btn btn--secondary">Zurück zur vorherigen Seite</button>
                </div>
                
                <div class="error-page__help">
                    <h2>Hilfreiche Links</h2>
                    <ul>
                        <li><a href="<?= SITE_PATH ?>/ratgeber">Ratgeber & Informationen</a></li>
                        <li><a href="<?= SITE_PATH ?>/faq">Häufig gestellte Fragen (FAQ)</a></li>
                        <li><a href="<?= SITE_PATH ?>/leistungen">Unsere Leistungen</a></li>
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
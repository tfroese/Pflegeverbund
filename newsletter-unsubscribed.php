<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Newsletter abgemeldet';
$pageDescription = 'Sie wurden erfolgreich von unserem Newsletter abgemeldet.';

ob_start();
?>

<main class="main-content">
    <div class="container">
        <div class="message-page">
            <h1>Newsletter abgemeldet</h1>
            <p>Sie wurden erfolgreich von unserem Newsletter abgemeldet. Wir bedauern, dass Sie uns verlassen.</p>
            <p>Falls Sie sich zu einem späteren Zeitpunkt wieder anmelden möchten, können Sie dies jederzeit tun.</p>
            <a href="<?= SITE_PATH ?>/" class="btn btn--primary">Zur Startseite</a>
        </div>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
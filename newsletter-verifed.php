<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Newsletter-Anmeldung bestätigt';
$pageDescription = 'Ihre Newsletter-Anmeldung wurde erfolgreich bestätigt.';

ob_start();
?>

<main class="main-content">
    <div class="container">
        <div class="message-page">
            <h1>Newsletter-Anmeldung bestätigt</h1>
            <p>Vielen Dank! Ihre E-Mail-Adresse wurde erfolgreich bestätigt. Sie erhalten ab jetzt unseren Newsletter.</p>
            <a href="<?= SITE_PATH ?>/" class="btn btn--primary">Zur Startseite</a>
        </div>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
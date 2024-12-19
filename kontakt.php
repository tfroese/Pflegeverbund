<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Kontakt';
$pageDescription = 'Kontaktieren Sie uns - Wir sind für Sie da und beantworten gerne Ihre Fragen rund um das Thema Pflege.';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'Kontakt', 'url' => '#']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <div class="contact-page">
            <div class="contact-page__info">
                <h1>Haben Sie Fragen? Wir sind für Sie da und helfen Ihnen gerne weiter.</h1>
                
                <div class="contact-page__details">
                    <div class="contact-detail">
                        <h3>Adresse</h3>
                        <p>Pflegeverbund GmbH<br>
                        Musterstraße 123<br>
                        12345 Musterstadt</p>
                    </div>
                    
                    <div class="contact-detail">
                        <h3>Telefon</h3>
                        <p><a href="tel:+49xxxxx">+49 (0) xxx xxx xxx</a></p>
                        <p class="contact-detail__note">Mo-Fr: 08:00 - 18:00 Uhr</p>
                    </div>
                    
                    <div class="contact-detail">
                        <h3>E-Mail</h3>
                        <p><a href="mailto:info@pflegeverbund.de">info@pflegeverbund.de</a></p>
                    </div>
                </div>
            </div>

            <div class="contact-page__form">
                <h2>Kontaktformular</h2>
                <form id="contactForm" class="contact-form" method="post" action="<?= SITE_PATH ?>/api/contact.php">
                    <div class="contact-form__group">
                        <label for="name" class="contact-form__label">Name *</label>
                        <input type="text" id="name" name="name" class="contact-form__input" required>
                    </div>

                    <div class="contact-form__group">
                        <label for="email" class="contact-form__label">E-Mail *</label>
                        <input type="email" id="email" name="email" class="contact-form__input" required>
                    </div>

                    <div class="contact-form__group">
                        <label for="phone" class="contact-form__label">Telefon</label>
                        <input type="tel" id="phone" name="phone" class="contact-form__input">
                    </div>

                    <div class="contact-form__group">
                        <label for="subject" class="contact-form__label">Betreff *</label>
                        <input type="text" id="subject" name="subject" class="contact-form__input" required>
                    </div>

                    <div class="contact-form__group">
                        <label for="message" class="contact-form__label">Nachricht *</label>
                        <textarea id="message" name="message" class="contact-form__textarea" required></textarea>
                    </div>

                    <div class="contact-form__group">
                        <label class="contact-form__checkbox">
                            <input type="checkbox" name="privacy_consent" required>
                            <span>Ich stimme zu, dass meine Angaben zur Kontaktaufnahme und für Rückfragen gespeichert werden. Weitere Informationen finden Sie in der <a href="<?= SITE_PATH ?>/datenschutz">Datenschutzerklärung</a>.</span>
                        </label>
                    </div>

                    <div id="contactMessage" class="contact-form__message" hidden></div>

                    <button type="submit" class="btn btn--primary">Nachricht senden</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
<?php
$newsletterTitle = 'Newsletter';
$newsletterDescription = 'Abonnieren Sie unseren Newsletter und erhalten Sie regelmäßig aktuelle Infos zu Pflege, Pflegegraden, Unterstützungsmöglichkeiten und Gesetzesänderungen.';
?>

<section class="newsletter-section">
    <div class="newsletter-section__container">
        <div class="newsletter-section__content">
            <h3 class="newsletter-section__title"><?= htmlspecialchars($newsletterTitle) ?></h3>
            <p class="newsletter-section__description"><?= htmlspecialchars($newsletterDescription) ?></p>
        </div>

        <form id="newsletterForm" class="newsletter-section__form" method="post" action="<?= SITE_PATH ?>/api/newsletter-subscribe.php">
            <div class="newsletter-section__input-group">
                <div class="newsletter-section__field">
                    <input 
                        type="email" 
                        name="email" 
                        id="newsletterEmail" 
                        class="newsletter-section__input" 
                        placeholder="Ihre E-Mail-Adresse" 
                        required
                    >
                    <button type="submit" class="newsletter-section__submit">
                        <span>Newsletter abonnieren</span>
                        <svg class="newsletter-section__icon" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                        </svg>
                    </button>
                </div>
                <div id="newsletterMessage" class="newsletter-section__message" hidden></div>
            </div>

            <div class="newsletter-section__consent">
                <label class="newsletter-section__checkbox">
                    <input 
                        type="checkbox" 
                        name="privacy_consent" 
                        id="newsletterConsent" 
                        required
                    >
                    <span class="newsletter-section__checkbox-text">
                        Ich stimme zu, dass meine E-Mail-Adresse für den Newsletter gespeichert und verwendet wird. 
                        Die Einwilligung kann ich jederzeit per E-Mail an datenschutz@pflegeverbund.de oder über 
                        den Abmeldelink im Newsletter widerrufen. Weitere Informationen finde ich in der 
                        <a href="<?= SITE_PATH ?>/datenschutz">Datenschutzerklärung</a>.
                    </span>
                </label>
            </div>
        </form>
    </div>
</section>
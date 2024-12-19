<div class="newsletter-form">
    <h3 class="newsletter-form__title">Newsletter abonnieren</h3>
    <p class="newsletter-form__description">
        Bleiben Sie informiert über aktuelle Themen rund um die Pflege.
    </p>

    <form id="newsletterForm" class="newsletter-form__form" method="post" action="<?= SITE_PATH ?>/api/newsletter-subscribe.php">
        <div class="newsletter-form__input-group">
            <input 
                type="email" 
                name="email" 
                id="newsletterEmail" 
                class="newsletter-form__input" 
                placeholder="Ihre E-Mail-Adresse" 
                required
            >
            <button type="submit" class="newsletter-form__submit btn btn--primary">
                Anmelden
            </button>
        </div>

        <div class="newsletter-form__consent">
            <input 
                type="checkbox" 
                name="privacy_consent" 
                id="newsletterConsent" 
                required
            >
            <label for="newsletterConsent">
                Ich stimme zu, dass meine E-Mail-Adresse für den Newsletter gespeichert und verwendet wird. 
                Die Einwilligung kann ich jederzeit per E-Mail an datenschutz@pflegeverbund.de oder über 
                den Abmeldelink im Newsletter widerrufen. Weitere Informationen finde ich in der 
                <a href="<?= SITE_PATH ?>/datenschutz">Datenschutzerklärung</a>.
            </label>
        </div>

        <div id="newsletterMessage" class="newsletter-form__message" hidden></div>
    </form>
</div>
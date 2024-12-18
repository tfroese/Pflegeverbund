<div id="cookieBanner" class="cookie-banner">
    <div class="cookie-banner__container">
        <p>Die Pflegeverbund GmbH verwendet Cookies, um unsere Webseite zu verbessern und Ihnen relevante Inhalte sowie personalisierte Werbung anzuzeigen. Dabei arbeiten wir mit ausgewählten Partnern zusammen, die auch auf anderen Webseiten Werbung bereitstellen können.</p>
        
        <div class="cookie-banner__buttons">
            <button class="btn btn--secondary" onclick="acceptNecessaryCookies()">Nur technisch notwendige</button>
            <button class="btn btn--secondary" onclick="toggleCookieSettings()">Einstellungen</button>
            <button class="btn btn--primary" onclick="acceptAllCookies()">Alle akzeptieren</button>
        </div>

        <div id="cookieSettings" class="cookie-banner__settings">
            <?php include 'components/cookie-settings.php'; ?>
        </div>
    </div>
</div>
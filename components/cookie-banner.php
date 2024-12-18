<?php
$cookiePreferences = isset($_COOKIE['cookie_preferences']) ? $_COOKIE['cookie_preferences'] : null;
?>
<div id="cookieBanner" class="cookie-banner" style="display: <?= $cookiePreferences ? 'none' : 'block' ?>">
    <div class="cookie-banner__container">
        <p>Die Pflegeverbund.de verwendet Cookies, um unsere Webseite zu verbessern und Ihnen relevante Inhalte sowie personalisierte Werbung anzuzeigen. Dabei arbeiten wir mit ausgewählten Partnern zusammen, die auch auf anderen Webseiten Werbung bereitstellen können.</p>
        
        <div class="cookie-banner__buttons">
            <button class="btn btn--secondary" data-cookie-action="accept-necessary">Nur technisch notwendige</button>
            <button class="btn btn--secondary" data-cookie-action="toggle-settings">Einstellungen</button>
            <button class="btn btn--primary" data-cookie-action="accept-all">Alle akzeptieren</button>
        </div>

        <div id="cookieSettings" class="cookie-banner__settings">
            <div class="cookie-settings__option">
                <input type="checkbox" id="allCookies">
                <label for="allCookies">Alles auswählen</label>
            </div>

            <div class="cookie-settings__option">
                <input type="checkbox" id="technicalCookies" checked disabled>
                <label for="technicalCookies">Technisch erforderlich</label>
                <p>Erforderliche Web-Technologien und Cookies machen unsere Webseite für Sie technisch zugänglich und nutzbar.</p>
            </div>

            <div class="cookie-settings__option">
                <input type="checkbox" id="analyticsCookies">
                <label for="analyticsCookies">Analyse und Statistik</label>
                <p>Wir möchten Nutzerfreundlichkeit und Leistungsfähigkeit unserer Webseiten ständig verbessern.</p>
            </div>

            <div class="cookie-settings__option">
                <input type="checkbox" id="marketingCookies">
                <label for="marketingCookies">Marketing</label>
                <p>Wir verwenden Web-Technologien von ausgewählten Partnern, um Ihnen besonders auf Sie zugeschnittene Inhalte und Werbung anzeigen zu können.</p>
            </div>

            <button class="btn btn--primary" data-cookie-action="save-settings">Einstellungen speichern</button>
        </div>
    </div>
</div>
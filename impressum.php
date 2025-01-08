<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Impressum';
$pageDescription = 'Impressum und rechtliche Informationen von Pflegeverbund.de';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'Impressum', 'url' => '#']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <article class="legal-content">
            <h1>Impressum</h1>

            <!--
            <section>
                <h2>Angaben gemäß § 5 TMG</h2>
                <p>Pflegeverbund GmbH<br>
                Musterstraße 123<br>
                12345 Musterstadt</p>
            </section>

            <section>
                <h2>Kontakt</h2>
                <p>Telefon: +49 (0) xxx xxx xxx<br>
                E-Mail: info@pflegeverbund.de</p>
            </section>

            <section>
                <h2>Vertreten durch</h2>
                <p>Geschäftsführer: Max Mustermann</p>
            </section>

            <section>
                <h2>Registereintrag</h2>
                <p>Eintragung im Handelsregister<br>
                Registergericht: Amtsgericht Musterstadt<br>
                Registernummer: HRB xxxxx</p>
            </section>

            <section>
                <h2>Umsatzsteuer-ID</h2>
                <p>Umsatzsteuer-Identifikationsnummer gemäß §27 a Umsatzsteuergesetz:<br>
                DE XXX XXX XXX</p>
            </section>

            <section>
                <h2>Berufsbezeichnung und berufsrechtliche Regelungen</h2>
                <p>Berufsbezeichnung: Pflegedienst<br>
                Zuständige Kammer: Pflegekammer Musterland<br>
                Verliehen durch: Bundesrepublik Deutschland</p>
            </section>

-->

            <h1 style="padding-top: 12pt;text-indent: 0pt;text-align: center;">Pflichtangaben nach § 5 Telemediengesetz/Impressum</h1><p style="padding-top: 13pt;text-indent: 0pt;text-align: left;"><br/></p><h2 style="padding-left: 6pt;text-indent: 0pt;text-align: left;">7 Sense GmbH</h2><h2 style="padding-top: 8pt;padding-left: 6pt;text-indent: 0pt;line-height: 162%;text-align: left;">Geschäftsführer: <span class="p">Sascha Vjazov und Tjark Jesse Fröse Bismarckstraße 2</span></h2><p style="padding-left: 6pt;text-indent: 0pt;text-align: left;">25421 Pinneberg</p><p style="text-indent: 0pt;text-align: left;"><br/></p><p style="padding-left: 6pt;text-indent: 0pt;text-align: left;"><span class="s1" style=" background-color: #FF0;">Telefon: </span><span class="s2" style=" background-color: #FF0;">+ 49 (0) 4101 – 7853 605</span></p><p style="padding-top: 8pt;padding-left: 6pt;text-indent: 0pt;text-align: left;"><span class="s1" style=" background-color: #FF0;">Telefax: </span><span class="s2" style=" background-color: #FF0;">+ 49 (0) 4101 – 6013 788</span></p><h2 style="padding-top: 7pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Registergericht: <span class="p">Amtsgericht Pinneberg</span></h2><h2 style="padding-top: 7pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Registernummer: <span class="p">HRB 15892</span></h2><p style="padding-top: 7pt;padding-left: 6pt;text-indent: 0pt;text-align: left;"><a href="mailto:info@pflegeverbund.de" style=" color: black; font-family:Arial, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 11pt;" target="_blank">E-Mail: </a><a href="mailto:info@pflegeverbund.de" class="s3" target="_blank">info@pflegeverbund.de</a></p><p style="text-indent: 0pt;text-align: left;"><br/></p><h2 style="padding-left: 6pt;text-indent: 0pt;text-align: left;">Umsatzsteuer-Identifikationsnummer gem. § 27a Umsatzsteuergesetz<span class="p">: DE343990969</span></h2><h2 style="padding-top: 7pt;padding-left: 6pt;text-indent: 0pt;line-height: 114%;text-align: left;">Inhaltlich Verantwortliche gemäß § 18 MStV: <span class="p">Sascha Vjazov und Tjark Jesse Fröse, Bismarckstraße 2, 25421 Pinneberg</span></h2><p style="text-indent: 0pt;text-align: left;"><br/></p><h2 style="padding-left: 6pt;text-indent: 0pt;text-align: left;">Nutzungsbedingungen/Disclaimer</h2><ol id="l1"><li data-list-text="(1)"><p style="padding-top: 11pt;padding-left: 6pt;text-indent: 0pt;line-height: 114%;text-align: justify;">Diese Website ist Gegenstand der nachfolgenden Nutzungsbedingungen, die im Verhältnis zwischen Nutzer und Dienstanbieter mit dem Aufruf dieser Website verbindlich vereinbart sind. Soweit spezielle Bedingungen für einzelne Nutzungen dieser Website von den nachfolgenden Nutzungsbedingungen abweichen, wird in der Website an entsprechender Stelle ausdrücklich darauf hingewiesen. Es gelten dann im jeweiligen Einzelfall ergänzend die besonderen Nutzungsbedingungen.</p><p style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;line-height: 114%;text-align: justify;">Diese  Website  beinhaltet  Daten  und Informationen  aller Art,  die  marken-  und/oder urheberrechtlich zugunsten des Diensteanbieters oder im Einzelfall auch zugunsten Dritter geschützt sind. Es ist daher nicht gestattet, die Website im Ganzen oder einzelne Teile davon herunterzuladen, zu vervielfältigen und/oder zu verbreiten. Gestattet ist vor allem die technisch bedingte Vervielfältigung zum Zwecke des Browsing, soweit diese Handlung keinen wirtschaftlichen Zwecken dient, sowie die dauerhafte Vervielfältigung für den eigenen Gebrauch.</p></li><li data-list-text="(2)"><p style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;line-height: 114%;text-align: justify;">Es ist gestattet, einen Link auf diese Website zu setzen, soweit er allein der Querreferenz dient. Der Diensteanbieter behält sich das Recht vor, die Gestattung zu widerrufen. Das Framen dieser Website ist nicht gestattet.</p></li><li data-list-text="(3)"><p style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;line-height: 114%;text-align: justify;">Der Diensteanbieter übernimmt die Haftung für die Inhalte seiner Website gemäß den gesetzlichen Bestimmungen. Eine Gewähr für Richtigkeit und Vollständigkeit der auf der Website befindlichen Information wird nicht übernommen. Verweise und Links auf Websites Dritter bedeuten nicht, dass sich der Diensteanbieter die hinter dem Verweis oder Link liegenden Inhalte zu eigen macht. Die Inhalte begründen keine Verantwortung des</p><p style="text-indent: 0pt;text-align: left;"/><p style="padding-top: 3pt;padding-left: 6pt;text-indent: 0pt;line-height: 114%;text-align: justify;">Diensteanbieters für die dort bereit gehaltenen Daten und Informationen. Der Diensteanbieter hat keinen Einfluss auf die hinter dem Link liegenden Inhalte. Für rechtswidrige, fehlerhafte oder unvollständige Inhalte und für Schäden, die aufgrund der Nutzung von einem hinter dem Link liegenden Inhalt verursacht worden sind, haftet der Diensteanbieter daher nicht.</p></li><li data-list-text="(4)"><p style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;line-height: 114%;text-align: justify;">Die Nutzung des Internets erfolgt auf eigene Gefahr des Nutzers. Der Diensteanbieter haftet vor allem nicht für den technisch bedingten Ausfall des Internets bzw. des Zugangs zum Internet.</p></li><li data-list-text="(5)"><p style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;line-height: 114%;text-align: justify;">Gerichtsstand ist, wenn der Vertragspartner Kaufmann, juristische Person des öffentlichen Rechts oder öffentlich-rechtliches Sondervermögen ist, am Sitz des Diensteanbieters. Es gilt deutsches Recht unter Ausschluss des UN-Kaufrechts.</p></li><li data-list-text="(6)"><p style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;line-height: 114%;text-align: justify;"><a href="https://ec.europa.eu/consumers/odr" style=" color: black; font-family:Arial, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 11pt;" target="_blank">Für den Fall, dass der Nutzer Verbraucher (nicht Unternehmer) ist, erfolgt der Hinweis gemäß Art. 14  der  VO  (EU)  Nr. 524/2013  –  ODR-Verordnung  auf  die  Möglichkeit außergerichtlicher Streitbeilegung. Details hierzu finden sich in der vorgenannten Verordnung und unter </a><span style=" color: #0462C1; font-family:Arial, sans-serif; font-style: normal; font-weight: normal; text-decoration: underline; font-size: 11pt;">https://ec.europa.eu/consumers/odr</span>.</p></li><li data-list-text="(7)"><p style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;line-height: 114%;text-align: justify;">Der Diensteanbieter behält sich das Recht vor, diese Nutzungsbedingungen von Zeit zu Zeit zu modifizieren und sie der technischen sowie rechtlichen Entwicklung anzupassen. Der Nutzer – soweit er sich registriert hat – wird auf die Veränderung gesondert hingewiesen. Im Falle der Unwirksamkeit einzelner Regelungen dieser Nutzungsvereinbarung bleibt die Wirksamkeit im Übrigen unberührt.</p></li></ol><p style="text-indent: 0pt;text-align: left;"><br/></p><h2 style="padding-left: 6pt;text-indent: 0pt;text-align: justify;">© Copyright 2024 – Urheberrechtshinweis</h2><p style="padding-top: 8pt;padding-left: 6pt;text-indent: 0pt;line-height: 114%;text-align: justify;">Der Inhalt, die Gestaltung und der Aufbau unseres Internet-Angebotes sind urheberrechtlich geschützt und wir behalten uns sämtliche Schutzrechte ausdrücklich vor. Insbesondere bedürfen die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung unserer schriftlichen Zustimmung, sofern die Maßnahme nicht nach gesetzlichen Vorschriften zustimmungsfrei erlaubt ist. Downloads und Kopien dieser Seiten sind nur für den privaten, nicht kommerziellen Gebrauch gestattet.</p><p style="text-indent: 0pt;text-align: left;"/>
        </article>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
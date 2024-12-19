<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Allgemeine Geschäftsbedingungen';
$pageDescription = 'Die Allgemeinen Geschäftsbedingungen von Pflegeverbund.de';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'AGB', 'url' => '#']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <article class="legal-content">
            
        <h1>Allgemeine Nutzungsbedingungen</h1>

        <h2>§ 1 Anwendungsbereich</h2>
        <p>
            (1) Die folgenden Bestimmungen regeln die Nutzung der Dienstleistungen der 7 Sense GmbH, ansässig in der 
            Bismarckstraße 2, 25421 Pinneberg, vertreten durch die Geschäftsführer Sacha Vjazov und Tjark Jesse Fröse 
            (nachfolgend "Vermittler"). Sie gelten für alle Nutzer der Plattform <a href="http://www.pflegeverbund.de">www.pflegeverbund.de</a>.
        </p>
        <p>
            (2) Diese Allgemeinen Geschäftsbedingungen (AGB) sowie individuelle Absprachen bilden die Grundlage für die 
            Zusammenarbeit. Abweichende Regelungen des Nutzers gelten nur, wenn der Vermittler ihnen ausdrücklich schriftlich 
            zugestimmt hat.
        </p>

        <h2>§ 2 Beschreibung des Serviceangebots</h2>
        <p>
            (1) Der Vermittler stellt Personen, die Pflegeleistungen oder verwandte Dienste suchen, eine kostenfreie Plattform 
            zur Selbstinformation und Vermittlung bereit. Das Angebot richtet sich sowohl an pflegebedürftige Personen selbst 
            als auch an deren Angehörige oder autorisierte Vertreter.
        </p>
        <p>
            (2) Nutzer können über <a href="http://www.pflegeverbund.de">www.pflegeverbund.de</a> selbständig Informationen 
            abrufen und sich orientieren. Ziel ist es, geeignete Anbieter vorzuschlagen, die zu den individuellen Anforderungen 
            des Nutzers passen. Der Vermittler tritt dabei lediglich als Vermittlungsplattform auf und erbringt keine eigenen 
            Pflegeleistungen.
        </p>
        <p>
            (3) Nach Zustimmung zur Datenschutzerklärung können Kontaktdaten und Bedarfsinformationen des Nutzers an bis zu 
            drei geeignete Anbieter weitergegeben werden. Diese Anbieter können den Nutzer kontaktieren, um Angebote zu 
            unterbreiten. Die Entscheidung über einen Vertragsabschluss liegt allein beim Nutzer.
        </p>
        <p>
            (4) Anbieter sind angehalten, innerhalb von zwei Werktagen auf Anfragen zu reagieren. Der Vermittler überwacht 
            diesen Prozess und ergreift bei Bedarf Maßnahmen, um eine zügige Bearbeitung zu gewährleisten, hat jedoch keinen 
            direkten Einfluss auf die Geschwindigkeit der Anbieter.
        </p>

        <h2>§ 3 Haftung und Vertragsverhältnis</h2>
        <p>
            (1) Der Vermittler tritt nicht als Vertragspartner für Pflege- oder Dienstleistungen auf. Etwaige Verträge über 
            diese Leistungen werden ausschließlich zwischen Nutzern und Anbietern abgeschlossen.
        </p>
        <p>
            (2) Ansprüche des Nutzers gegen den Vermittler im Zusammenhang mit diesen Verträgen bestehen nicht. Der Vermittler 
            haftet weder für die Inhalte noch für die Durchführung solcher Verträge.
        </p>
        <p>
            (3) Der Vermittler bietet seinen Service unentgeltlich und freiwillig an. Ein Anspruch auf eine erfolgreiche 
            Beratung oder Vermittlung besteht nicht. Die Haftung des Vermittlers ist bei Vorsatz oder grober Fahrlässigkeit 
            begrenzt. Eine weitergehende Haftung wird nur bei Verletzung wesentlicher Vertragspflichten, Gesundheitsschäden 
            oder Gefährdung von Leben und Körper übernommen.
        </p>
        <p>
            (4) Bei Verletzung wesentlicher Vertragspflichten ist die Haftung des Vermittlers auf vorhersehbare, typische 
            Schäden begrenzt.
        </p>

        <h2>§ 4 Kostenfreiheit</h2>
        <p>
            (1) Die Nutzung der Plattform und die Inanspruchnahme der Beratungsleistungen sind für Nutzer kostenfrei.
        </p>
        <p>
            (2) Der Vermittler behält sich vor, die von Nutzern im Rahmen des Downloads von Informationsmaterial bereitgestellten 
            Kontaktdaten (z. B. E-Mail-Adressen) für eigene Werbezwecke zu nutzen, sofern eine ausdrückliche Einwilligung des 
            Nutzers vorliegt.
        </p>

        <h2>§ 5 Anbieter und Ranking-Mechanismen</h2>
        <p>
            (1) Es wird darauf hingewiesen, dass nicht alle verfügbaren Anbieter von Pflegeleistungen mit dem Vermittler 
            zusammenarbeiten. Nutzer werden prioritär an Partner vermittelt, die mit dem Vermittler eine Kooperationsvereinbarung 
            getroffen haben.
        </p>
        <p>
            (2) Der Vermittler arbeitet kontinuierlich daran, sein Netzwerk auszubauen, kann jedoch keine Gewähr für eine 
            vollständige Marktübersicht über Anbieter geben.
        </p>
        <p>
            (3) Die Bewertung und Reihenfolge von Anbietern auf der Plattform erfolgt anhand von Kundenbewertungen und der 
            Anzahl der Bewertungen. Kooperationsvereinbarungen zwischen Vermittler und Anbieter haben darauf keinen Einfluss.
        </p>

        <h2>§ 6 Datenschutz und Weitergabe von Informationen</h2>
        <p>
            (1) Die Weitergabe personenbezogener Daten an Anbieter erfolgt nur mit ausdrücklicher Zustimmung des Nutzers und 
            unter Einhaltung der geltenden Datenschutzgesetze. Ein Verkauf oder eine Weitergabe an unbeteiligte Dritte ist 
            ausgeschlossen.
        </p>
        <p>
            (2) Ausführliche Informationen zur Datenverarbeitung sind in der Datenschutzerklärung unter 
            <a href="http://www.pflegeverbund.de/datenschutz">www.pflegeverbund.de/datenschutz</a> zu finden.
        </p>

        <h2>§ 7 Anwendbares Recht und Gerichtsstand</h2>
        <p>
            (1) Für die Nutzung des Vermittlungsdienstes gilt das Recht der Bundesrepublik Deutschland. Verbindliche 
            Verbraucherschutzregelungen des Aufenthaltslandes des Nutzers bleiben unberührt.
        </p>
        <p>
            (2) Für Nutzer, die Kaufleute oder juristische Personen des öffentlichen Rechts sind, ist der Gerichtsstand Pinneberg.
        </p>

        <h2>§ 8 Online-Streitbeilegung</h2>
        <p>
            Die EU-Kommission bietet eine Plattform zur Online-Streitbeilegung unter 
            <a href="http://www.ec.europa.eu/consumers/odr">www.ec.europa.eu/consumers/odr</a> an. Diese Plattform dient der 
            außergerichtlichen Beilegung von Streitigkeiten, die aus Online-Verträgen resultieren. Der Vermittler nimmt an 
            solchen Verfahren nicht teil. Kontaktinformationen sind im Impressum zu finden.
        </p>

        </article>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
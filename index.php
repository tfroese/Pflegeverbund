<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = null; // Use default
$pageDescription = null; // Use default
$schemaMarkup = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Pflegeverbund GmbH",
  "url": "' . SITE_URL . '",
  "logo": "' . SITE_URL . '/images/logo.svg",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+49-xxx-xxxxxxx",
    "contactType": "customer service"
  },
  "sameAs": [
    "https://www.facebook.com/pflegeverbund",
    "https://www.linkedin.com/company/pflegeverbund"
  ]
}
</script>';

// Start output buffering
ob_start();
?>

<header class="header">
    <div class="header__content">
        <!-- Form start -->
        <div class="funnelform">
            <form id="questionnaireForm" action="" method="POST">
                <fieldset class="active">
                    <div class="flex-page">
                        <div class="flex-header">
                            <h1 class="header__title">Professionelle Pflegeberatung für Sie und Ihre Angehörigen</h1>
                            <p class="header__subtitle">Wir unterstützen Sie mit einer <strong>kostenlosen Pflegeberatung</strong> bei der Beantragung von Pflegeleistungen und beraten Sie kostenlos zu allen Fragen rund um die Pflege.</p>
                            <legend>Für welche Person suchen Sie Unterstützung?</legend>
                        </div>
                        <div class="flex-content">
                            <div class="input-group">
                                <input type="radio" id="lead_target_1" name="lead_target" value="others" data-image="care-person-2.png" required/>
                                <label for="lead_target_1">Für Angehörige</label>
                            </div>
                            <div class="input-group">
                                <input type="radio" id="lead_target_2" name="lead_target" value="myself" data-image="care-person-1.png" required/>
                                <label for="lead_target_2">Für mich</label>
                            </div>
                        </div>
                        <div class="flex-footer">
                            <a href="#" class="button full" data-link="next">Weiter</a>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="flex-page">
                        <div class="flex-header">
                            <legend>Welchen Pflegegrad?</legend>
                            <p>Es handelt sich um die betroffene Person.</p>
                        </div>
                        <div class="flex-content small">
                            <div class="input-group">
                                <input type="radio" id="lead_carelevel_1" name="lead_carelevel" value="1" data-image="care-level-1.png" required/>
                                <label for="lead_carelevel_1">Pflegegrad 1</label>
                            </div>
                            <div class="input-group">
                                <input type="radio" id="lead_carelevel_2" name="lead_carelevel" value="2" data-image="care-level-2.png" required/>
                                <label for="lead_carelevel_2">Pflegegrad 2</label>
                            </div>
                            <div class="input-group">
                                <input type="radio" id="lead_carelevel_3" name="lead_carelevel" value="3" data-image="care-level-3.png" required/>
                                <label for="lead_carelevel_3">Pflegegrad 3</label>
                            </div>
                            <div class="input-group">
                                <input type="radio" id="lead_carelevel_4" name="lead_carelevel" value="4" data-image="care-level-4.png" required/>
                                <label for="lead_carelevel_4">Pflegegrad 4</label>
                            </div>
                            <div class="input-group">
                                <input type="radio" id="lead_carelevel_5" name="lead_carelevel" value="5" data-image="care-level-5.png" required/>
                                <label for="lead_carelevel_5">Pflegegrad 5</label>
                            </div>
                            <div class="input-group">
                                <input type="radio" id="lead_carelevel_0" name="lead_carelevel" value="0" data-image="care-level-0.png" required/>
                                <label for="lead_carelevel_0">Keinen Pflegegrad</label>
                            </div>
                            <div class="input-group">
                                <input type="radio" id="lead_carelevel_unknown" name="lead_carelevel" value="unknown" data-image="care-level-unknown.png" />
                                <label for="lead_carelevel_unknown">Ich weiß es nicht</label>
                            </div>
                        </div>
                        <div class="flex-footer">
                            <a href="#" class="button secondary full" data-link="back">Zurück</a>
                            <a href="#" class="button full" data-link="next">Weiter</a>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="flex-page">
                        <div class="flex-header">
                            <legend>Welche Themen sind für Sie interessant?</legend>
                            <p>Mehrfachauswahl ist hier möglich.</p>
                        </div>
                        <div class="flex-content">
                            <div class="input-group multi mfull">
                                <input type="checkbox" id="lead_topic_free_consulting" name="lead_topic_free_consulting" data-image="consulting.png" />
                                <label for="lead_topic_free_consulting"><span>Kostenlose Pflegeberatung</span></label>
                            </div>
                            <div class="input-group multi mfull">
                                <input type="checkbox" id="lead_topic_free_products" name="lead_topic_free_products" data-image="utilities.png" />
                                <label for="lead_topic_free_products"><span>Kostenlose Pflegehilfsmittel</span></label>
                            </div>
                            <div class="input-group multi mfull">
                                <input type="checkbox" id="lead_topic_housekeeping" name="lead_topic_housekeeping" data-image="housekeeping.png" />
                                <label for="lead_topic_housekeeping"><span>Haushaltshilfe</span></label>
                            </div>
                            <div class="input-group multi mfull">
                                <input type="checkbox" id="lead_topic_emergency_device" name="lead_topic_emergency_device" data-image="emergency.png" />
                                <label for="lead_topic_emergency_device"><span>Hausnotrufgerät</span></label>
                            </div>
                        </div>
                        <div class="flex-footer">
                            <a href="#" class="button secondary full" data-link="back">Zurück</a>
                            <a href="#" class="button full" data-link="next">Weiter</a>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="flex-page">
                        <div class="flex-header">
                            <legend>Wo wird die Unterstützung benötigt?</legend>
                            <p>Bitte geben Sie die Postleitzahl der verpflegenden Person an.</p>
                        </div>
                        <div class="flex-content">
                            <div class="input-field">
                                <label for="lead_location_additional">Wohnort</label>
                                <input type="text" id="lead_location_additional" name="lead_location_additional" />
                            </div>
                        </div>
                        <div class="flex-footer">
                            <a href="#" class="button secondary full" data-link="back">Zurück</a>
                            <a href="#" class="button full" data-link="next">Weiter</a>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="flex-page">
                        <div class="flex-header">
                            <legend>Kontaktdaten</legend>
                            <p>Bitte geben Sie uns ein paar Kontaktinformationen, damit wir Sie schnellstmöglich kontaktieren können.</p>
                        </div>
                        <div class="flex-content">
                            <div class="input-field">
                                <label for="lead_name">Vorname</label>
                                <input type="text" id="lead_name" name="lead_name" required />
                            </div>
                            <div class="input-field">
                                <label for="lead_lastname">Nachname</label>
                                <input type="text" id="lead_lastname" name="lead_lastname" required />
                            </div>
                            <div class="input-field">
                                <label for="lead_email">E-Mail</label>
                                <input type="email" id="lead_email" name="lead_email" required />
                            </div>
                            <div class="input-field">
                                <label for="lead_phone">Telefon</label>
                                <input type="tel" id="lead_phone" name="lead_phone" required />
                            </div>
                            <!--
                                <div class="input-field">
                                    <label for="lead_location">Wohnort</label>
                                    <input type="text" id="lead_location" name="lead_location" required />
                                </div>
                            -->
                        </div>
                        <div class="flex-footer">
                            <a href="#" class="button secondary full" data-link="back">Zurück</a>
                            <a href="#" class="button full" data-link="next">Weiter</a>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="flex-page">
                        <div class="flex-header">
                            <legend>Ab wann brauchen Sie die Unterstützung?</legend>
                            <p>Bitte geben Sie an, wann die Unterstützung erwartet wird.</p>
                        </div>
                        <div class="flex-content">
                            <div class="input-field">
                                <label for="lead_start_time">Start der Unterstützung</label>
                                <input type="date" id="lead_start_time" name="lead_start_time" required />
                            </div>
                            <input type="checkbox" id="lead_terms" name="lead_terms" required />
                            <label for="lead_terms">Hiermit bestätige ich die Allgemeinen Geschäftsbedingungen sowie die Weitergabe meiner Daten an Dritte. *</label>
                        </div>
                        <div class="flex-footer">
                            <a href="#" class="button secondary full" data-link="back">Zurück</a>
                            <input type="submit" value="Kostenlos abschicken" class="button full">
                        </div>
                    </div>
                </fieldset>
                <div id="successView" class="flex-page success-view">
                    <div class="flex-header">
                        <div class="success"></div>
                        <h2>Vielen Dank!</h2>
                        <p>Wir haben Ihre Anfrage erhalten und werden uns in Kürze bei Ihnen melden.</p>
                        <a href="#" class="button">Mehr über Leistungen erfahren</a>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <!-- Form end -->
    </div>
</header>

<main class="main-content">
    <div class="container">
        <!-- Main content here -->
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>
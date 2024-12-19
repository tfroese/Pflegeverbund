<footer>

    <div class="block">
        <h5>Rechtliches</h5>
        <ul>
            <li><a href="agb.php">Allgemeine Geschäftsbedinungen</a></li>
            <li><a href="datenschutz.php">Datenschutzerklärung</a></li>
            <li><a href="impressum.php">Impressum</a></li>
        </ul>
    </div>

    <div class="block">
        <h5>Nützliche Links</h5>
        <ul>
            <li><a href="agbs.php">Bundesministerium für Gesundheit Artikel über Pflegestufen</a></li>
            <li><a href="datenschutz.php">Datenschutzerklärung</a></li>
            <li><a href="impressum.php">Impressum</a></li>
        </ul>
    </div>

</footer>

<script>
    $(document).ready(function() {

        /* cookie */
        var cookieBanner = $('#cookie-banner');
        var acceptAllButton = $('#accept-all-cookies');
        var acceptNecessaryButton = $('#accept-necessary-cookies');

        // Überprüfen, ob der Benutzer bereits eine Entscheidung getroffen hat
        var cookieConsent = localStorage.getItem('cookieConsent');
        if (cookieConsent) {
            cookieBanner.hide();
            if (cookieConsent === 'all') {
                enableTrackingCookies();
            }
        }

        // "Alle Cookies akzeptieren"-Button
        acceptAllButton.on('click', function() {
            localStorage.setItem('cookieConsent', 'all');
            cookieBanner.hide();
            enableTrackingCookies(); // Cookies aktivieren, die eine Zustimmung benötigen
        });

        // "Nur notwendige Cookies akzeptieren"-Button
        acceptNecessaryButton.on('click', function() {
            localStorage.setItem('cookieConsent', 'necessary');
            cookieBanner.hide();
        });

        function enableTrackingCookies() {
            // Beispiel: Google Analytics Cookie setzen (nur wenn zugestimmt)
            console.log("Tracking-Cookies aktiviert.");
            // Hier können z.B. externe Tracking-Skripte geladen werden
        }


        /* funnel */
        var currentFieldset = 0;
        var $fieldsets = $('fieldset');
        var skipLocationFieldset = false;

        function showFieldset(index) {
            $fieldsets.each(function(i) {
                if (i === index) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
        }

        function validateFieldset($fieldset) {
            var isValid = true;
            var $invalidField = null;

            // Durchläuft alle Felder, die als "required" markiert sind
            $fieldset.find('[required]').each(function() {
                var $input = $(this);

                // Für Radio-Buttons: prüfe, ob einer in der Gruppe ausgewählt ist
                if ($input.is(':radio')) {
                    var name = $input.attr('name'); // Name der Radio-Gruppe
                    if ($fieldset.find('input[name="' + name + '"]:checked').length === 0) {
                        isValid = false;
                        if (!$invalidField) {
                            $invalidField = $input;
                        }
                    }
                }
                // Für alle anderen Felder (Text, Checkboxen, etc.)
                else if (!$input.val() || ($input.is(':checkbox') && !$input.is(':checked'))) {
                    isValid = false;
                    if (!$invalidField) {
                        $invalidField = $input;
                    }
                }
            });

            // Wenn ein ungültiges Feld gefunden wurde
            if ($invalidField) {
                // Scrollt zum ungültigen Feld
                $('html, body').animate({
                    scrollTop: $invalidField.offset().top
                }, 500);
                // Setzt den Fokus auf das ungültige Feld
                $invalidField.focus();

                // Zeigt eine Warnung an, wenn es ein Radio-Button ist
                if ($invalidField.is(':radio')) {
                    alert('Bitte wählen Sie eine Option aus.');
                }
            }

            return isValid;
        }

        function nextFieldset(event) {
            event.preventDefault();
            var $current = $fieldsets.eq(currentFieldset);

            // Hier wird die Validierung aufgerufen
            if (!validateFieldset($current)) {
                //alert('Bitte füllen Sie alle erforderlichen Felder aus.');
                return;
            }

            // Spezifische Logik für das dritte Fieldset
            if (currentFieldset === 2) {
                var isOnlyFreeProductsChecked = $('#lead_topic_free_products').is(':checked') &&
                    !$('#lead_topic_free_consulting').is(':checked') &&
                    !$('#lead_topic_housekeeping').is(':checked');
                skipLocationFieldset = isOnlyFreeProductsChecked;
            }

            animateFieldsets(true);
        }

        function previousFieldset(event) {
            event.preventDefault();
            animateFieldsets(false);
        }

    



        function animateFieldsets(forward) {
            var $current = $fieldsets.eq(currentFieldset);
            var $next;
            var $prev;

            if (forward) {
                if (skipLocationFieldset && currentFieldset === 2) {
                    currentFieldset += 2;
                } else {
                    currentFieldset++;
                }
                if (currentFieldset >= $fieldsets.length) {
                    currentFieldset = $fieldsets.length - 1;
                    return;
                }
                $next = $fieldsets.eq(currentFieldset);
                $current.addClass('slide-out-left').one('animationend', function() {
                    $current.removeClass('active slide-out-left');
                });
                $next.addClass('slide-in-right active').one('animationend', function() {
                    $next.removeClass('slide-in-right');
                });
            } else {
                if (skipLocationFieldset && currentFieldset === 4) {
                    currentFieldset -= 2;
                } else {
                    currentFieldset--;
                }
                if (currentFieldset < 0) {
                    currentFieldset = 0;
                    return;
                }
                $prev = $fieldsets.eq(currentFieldset);
                $current.addClass('slide-out-right').one('animationend', function() {
                    $current.removeClass('active slide-out-right');
                });
                $prev.addClass('slide-in-left active').one('animationend', function() {
                    $prev.removeClass('slide-in-left');
                });
            }
        }

        $('.input-group input[type="radio"], .input-group input[type="checkbox"]').each(function() {
            var $label = $(this).next('label');
            var iconUrl = $(this).data('image');
            if (iconUrl) {
                $label.css('--icon-url', 'url(img/' + iconUrl + ')');
            }
        });

        $('#questionnaireForm').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'send.php',
                method: 'POST',
                data: formData,
                processData: false, // Verhindert, dass jQuery die Daten in einen Query-String umwandelt
                contentType: false, // Setzt den Content-Type korrekt auf multipart/form-data
                success: function(response) {
                    showSuccessView();
                },
                error: function() {
                    alert('Es gab ein Problem beim Senden des Formulars. Bitte versuchen Sie es später erneut.');
                }
            });
        });

        function showSuccessView() {
            var $current = $fieldsets.eq(currentFieldset);
            var $successView = $('#successView');

            $current.addClass('slide-up').one('animationend', function() {
                $current.removeClass('active slide-up').hide();
            });
            $successView.addClass('slide-down').show().one('animationend', function() {
                $successView.removeClass('slide-down');
            });
        }

        showFieldset(currentFieldset);

        $('[data-link]').on('click', function(event) {
            var linkType = $(this).data('link');
            if (linkType === 'next') {
                nextFieldset(event);
            } else if (linkType === 'back') {
                previousFieldset(event);
            }
        });

        $(document).on('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                if (currentFieldset < $fieldsets.length - 1) {
                    nextFieldset(event);
                } else {
                    $('#questionnaireForm').submit();
                }
            }
        });

        $(window).scroll(function(){
            if ($(window).scrollTop() >= 38) {
                $('header').addClass('fixed-header');
            }
            else {
                $('header').removeClass('fixed-header');
            }
        });

        $(document).ready(function() {
            $('#questionnaireForm').on('submit', function(e) {
                var topicCheckboxes = $('input[type="checkbox"][name^="lead_topic_"]');
                if (topicCheckboxes.filter(':checked').length === 0) {
                    e.preventDefault();
                    alert('Bitte wählen Sie mindestens ein Thema aus.');
                    return false;
                }
            });
        });

    });
</script>
<footer class="footer">
    <div class="footer__container">
        <div class="footer__column">
            <img src="<?=IMG_URL;?>/logo-light.svg" alt="Pflegeverbund Logo" class="footer__logo" width="200" height="100">
        </div>
        
        <div class="footer__column">
            <h3>Rechtliche Links</h3>
            <div class="footer__links">
                <a href="<?=SITE_PATH;?>/agb">Allgemeine Geschäftsbedingungen</a>
                <a href="<?=SITE_PATH;?>/datenschutz">Datenschutzerklärung</a>
                <a href="<?=SITE_PATH;?>/impressum">Impressum</a>
            </div>
        </div>
        
        <div class="footer__column">
            <h3>Nützliche Links</h3>
            <div class="footer__links">
                <a href="https://www.bundesgesundheitsministerium.de/themen/pflege/pflegegrade" target="_blank" rel="noopener">BMG: Pflegestufen</a>
                <a href="<?=SITE_PATH;?>/faq">Häufig gestellte Fragen</a>
            </div>
        </div>
        
        <div class="footer__column">
            <?php include 'newsletter-form.php'; ?>
        </div>
    </div>
</footer>

<script>
    // Global configuration
    window.JS_URL = '<?=JS_URL;?>';
    window.APP_VERSION = '<?=time();?>'; // Add timestamp for cache busting
</script>
<script type="module" src="<?=JS_URL;?>/main.js?v=<?=time();?>"></script>
</body>
</html>
<footer>
    <div class="container-fluid footer">
        <div class="container">
            <div class="row">
                <div class="col-2 footer__logo">
                   <img src="<?php echo get_theme_file_uri('media//img/logo-white.png') ?>" alt="Logo" class="banner-container__logo">
                </div>
                <div class="col-4 footer__copyright">
                    <p class="footer__copyright__text">Copyright © 2017 Hercha</p>
                </div>
                <div class="col-2 footer__links">
                    <?php bootstrap_footer(); ?>
                </div>
                <div class="col-2 footer__links">
                    <?php bootstrap_footer2(); ?>
                </div>
                <div class="col-2 footer__links">
                    <?php bootstrap_footer3(); ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
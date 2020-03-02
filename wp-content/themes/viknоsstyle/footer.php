<footer class="footer">
    <div class="wrapper">
        <div class="footer__content">
        <div class="footer__logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/prod/img/logo.png" alt="">
            <div class="footer__social">
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </div>
        </div>

            <nav class="footer__menu menu">
                <ul class="menu__list">
                    <li class="menu__item">
                        <a href="#about" class="menu__link">Про компанію</a>
                    </li>
                    <li class="menu__item">
                        <a href="#catalog" class="menu__link">Каталог продукції</a>
                    </li>
                    <li class="menu__item">
                        <a href="#stock" class="menu__link">Акції</a>
                    </li>
                    <li class="menu__item">
                        <a href="#portfolio" class="menu__link">Портфоліо</a>
                    </li>
                    <li class="menu__item">
                        <a href="#contacts" class="menu__link">Контакти</a>
                    </li>
                </ul>
            </nav>

        <div class="contacts__content">
                <div class="contacts__box">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span>viknos.style@gmail.com</span>
                </div>
                <div class="contacts__box">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span>+38 098 521 44 21</span>
                </div>
                <div class="contacts__box">
                    <i class="fa fa-location-arrow" aria-hidden="true"></i>
                    <span>Lorem ipsum, lorem ipsum, lorem ipsum</span>
                </div>
        </div>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="footer__copy">
            <span>&copy; <?php echo date("Y"); ?> viknasite.com</span>
        </div>
    </div>

</footer>
    <span class="button__top"></span>

   <?php require ('templates/popup.php'); ?>

    <?php wp_footer(); ?>

</body>
</html>
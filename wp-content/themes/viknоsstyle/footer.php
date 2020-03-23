<?php

$logo_footer     = get_field( 'logo_footer', 'option' );
$email_footer    = get_field( 'email_footer', 'option' );
$phone_footer    = get_field( 'phone_footer', 'option' );
$location_footer = get_field( 'location_footer', 'option' );
$shedules_time   = get_field( 'shedules_time', 'option' );

if ( have_rows( 'social_footer', 'option' ) ) {
	while ( have_rows( 'social_footer', 'option' ) ): the_row();
		$facebook  = get_sub_field( 'facebook' );
		$instagram = get_sub_field( 'instagram' );
	endwhile;
}

?>


<footer class="footer">
    <div class="wrapper">
        <div class="footer__content">
            <div class="footer__logo f-col">
                <img src="<?php echo $logo_footer['url']; ?>" alt="logo footer">
                <div class="footer__social">
                    <a href="<?php echo $facebook; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="<?php echo $instagram; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <nav class="footer__menu menu f-col">
				<?php $args = array(
					'theme_location' => 'footer_menu',
					'menu_class'     => 'menu__list',
				);
				wp_nav_menu( $args );
				?>
            </nav>

            <div class="contacts__content f-col">
                <div class="contacts__box">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <a href="mailto:<?php echo $email_footer; ?>">
                        <span><?php echo $email_footer; ?></span>
                    </a>
                </div>
                <div class="contacts__box">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <a href="tel:<?php echo $phone_footer; ?>">
                        <span><?php echo $phone_footer; ?></span>
                    </a>
                </div>
                <div class="contacts__box">
                    <i class="fa fa-location-arrow" aria-hidden="true"></i>
                    <span><?php echo $location_footer; ?></span>
                </div>
            </div>

			<?php if ( $shedules_time ): ?>
                <div class="works-time f-col">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <span>Графік роботи:</span>
                    <div class="works-time__text">
						<?php echo $shedules_time; ?>
                    </div>
                </div>
			<?php endif; ?>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="footer__copy">
            <span>&copy; <?php echo date( "Y" ); ?> vikna-s-style.lviv.ua</span>
        </div>
    </div>

</footer>
<span class="button__top"></span>

<?php require( 'templates/popup.php' ); ?>

<?php wp_footer(); ?>

</body>
</html>

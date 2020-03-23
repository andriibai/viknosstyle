<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">

    <link rel="apple-touch-icon" sizes="57x57"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage"
          content="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>
</head>
<body>

<?php

$logo_header     = get_field( 'logo_header', 'option' );
$slogan_header   = get_field( 'slogan_header', 'option' );
$location_header = get_field( 'location_header', 'option' );
$phone_header    = get_field( 'phone_header', 'option' );
$chat_header     = get_field( 'chat_header', 'option' );
$name_btn        = get_field( 'name_btn', 'option' );

?>

<header class="header">
    <div class="header__content" data-header-resize="1">
        <div class="wrapper header__top-info">
            <div class="header__logo">
                <a href="http://localhost/wordpress/">
                    <img src="<?php echo $logo_header['url']; ?>" alt="logo">
                </a>
            </div>
            <div class="header__text">
                <span class="text2"><?php echo $slogan_header; ?></span>
            </div>
            <div class="header__top-contact">
                <div class="header__contacts">
                    <a href="#">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <span class="chat"><?php echo $location_header; ?></span>
                    </a>

                    <a href="tel:<?php echo $phone_header; ?>">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span class="phone"><?php echo $phone_header; ?></span>
                    </a>
                    <a title="Viber" href="viber://chat?number=380985214421">
                        <img class="image-viber"
                             src="<?php echo get_template_directory_uri(); ?>/assets/prod/img/viber-icon.png" alt="">
                        <span class="chat"><?php echo $chat_header; ?></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="wrapper header__bottom-info">
            <div class="header__menu-mob">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="header__overlay"></div>

            <nav class="header__menu menu">
				<?php $args = array(
					'theme_location' => 'main_menu',
					'menu_class'     => 'menu__list',
				);
				wp_nav_menu( $args );
				?>

                <a class="mob-contact" href="tel:<?php echo $phone_header; ?>">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span class="phone"><?php echo $phone_header; ?></span>
                </a>
                <a class="mob-contact" title="Viber" href="viber://chat?number=380985214421">
                    <img class="image-viber"
                         src="<?php echo get_template_directory_uri(); ?>/assets/prod/img/viber-icon.png" alt="">
                    <span class="chat"><?php echo $chat_header; ?></span>
                </a>

            </nav>
            <a href="#contacts" class="header__btn-contact btn popup__btn">
                <span><?php echo $name_btn; ?></span>
            </a>
        </div>
    </div>

</header>
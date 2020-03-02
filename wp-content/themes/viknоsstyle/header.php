<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/prod/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <?php wp_head(); ?>
</head>
<body>

<header class="header">
    <div class="header__content" data-header-resize="1">
    <div class="wrapper header__top-info">
        <div class="header__logo">
            <a href="http://localhost/wordpress/">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/prod/img/logo.png" alt="logo">
            </a>
        </div>
        <div class="header__text">
            <span class="text2">запорука тепла і затишку</span>
        </div>
        <div class="header__top-contact">
            <div class="header__contacts">
                <a href="#">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span class="chat">м. Львів</span>
                </a>

                <a href="#">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span class="phone">+38 098 521 44 21</span>
                </a>
                <a href="#">
                    <i class="fa fa-commenting" aria-hidden="true"></i>
                    <span class="chat">задати запитання</span>
                </a>

            </div>
        </div>
    </div>

    <div class="wrapper header__bottom-info">
<!--        <div class="header__text">-->
<!--            <span class="text1">Вікна С-Cтиль</span>-->
<!--            <span class="text2">запорука тепла і затишку</span>-->
<!--        </div>-->

<!--        <div class="header__contacts">-->
<!--            <a href="#">-->
<!--                <i class="fa fa-mobile" aria-hidden="true"></i>-->
<!--            </a>-->
<!--            <a href="#">-->
<!--                <i class="fa fa-commenting-o" aria-hidden="true"></i>-->
<!--            </a>-->
<!--        </div>-->

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
                'theme_location' => 'top',
                'menu_class' => 'menu__list',
            );
            wp_nav_menu( $args );
            ?>
        </nav>
        <a href="#contacts" class="header__btn-contact btn popup__btn">
            <span>Замовити</span>
        </a>
        </div>
    </div>

</header>
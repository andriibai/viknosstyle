<?php

show_admin_bar(false);
//add_theme_support('title-tag');
//add_theme_support('post-thumbnails');

// REMOVE EMOJI ICONS
//remove_action('wp_head', 'print_emoji_detection_script', 7);
//remove_action('wp_print_styles', 'print_emoji_styles');


//add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2);
//add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2);
//function codeless_remove_type_attr($tag, $handle) {
//    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
//}

register_nav_menus(array(
    'top' => 'Main Menu',
    'bottom' => 'Footer Menu'
));


function vh_register_scripts() {
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/prod/js/main.min.js', array(), '1.1.0', true);
}
add_action( 'wp_enqueue_scripts', 'vh_register_scripts' );

// STYLE
add_action('wp_print_styles', 'add_styles');
if (!function_exists('add_styles')) {
    function add_styles() {
        if(is_admin()) return false;
        wp_enqueue_style( 'main', get_template_directory_uri(). '/assets/prod/css/main.min.css', array(), '1.0.0' );
    }
}



//add_action( 'wp_enqueue_scripts', 'jquery_script_method' );
//function jquery_script_method() {
//    wp_deregister_script('jquery');
//    wp_deregister_script( 'wp-embed' );
//    //wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.3.1.min.js', array(), '', true);
//    wp_enqueue_script('jquery');
//}

// SCRIPT




// Remake menu
add_filter( 'wp_nav_menu_args', 'filter_wp_menu_args' );
function filter_wp_menu_args( $args ) {
    //if ($args['theme_location'] === 'top') {
    $args['container']  = false;
    $args['items_wrap'] = '<ul id="%1$s" class="%2$s">%3$s</ul>';
    //$args['menu_class'] = false;
    //}
    return $args;
}

function atg_menu_classes($classes, $item, $args) {
    //if($args->theme_location == 'top') {
    $classes[] = 'menu__item';
    //}
    return $classes;
}
add_filter('nav_menu_css_class', 'atg_menu_classes', 1, 3);

function add_menuclass($ulclass) {
    return preg_replace('/<a /', '<a class="menu__link" ', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');



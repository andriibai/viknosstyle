<?php

// STYLE
add_action('wp_print_styles', 'add_styles');
if (!function_exists('add_styles')) {
    function add_styles() {
        if(is_admin()) return false;
        wp_enqueue_style( 'main', get_template_directory_uri(). '/assets/prod/css/main.min.css', array(), '1.0.0' );
    }
}

add_action( 'wp_enqueue_scripts', 'jquery_script_method' );
function jquery_script_method() {
    wp_deregister_script('jquery');
    wp_deregister_script( 'wp-embed' );
    //wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.3.1.min.js', array(), '', true);
    wp_enqueue_script('jquery');
}

// SCRIPT
add_action('wp_footer', 'add_scripts');
if (!function_exists('add_scripts')) {
    function add_scripts() {
        if(is_admin()) return false;
        //wp_deregister_script('jquery');
        wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/prod/js/main.min.js', array(), '1.0.0', 'in_footer');

    }
}

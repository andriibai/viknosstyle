<?php
/**
 * images sizes
 */
add_image_size( 'free', '1920', '', true );
add_image_size( '180x80', '180', '80', true );
add_image_size( '332_221', '332', '221', true );

/**
 * register menus
 **/
register_nav_menus(array(
    'main_menu' => 'Main menu',
    'footer_menu' => 'Footer menu'
));

/**
 * register sidebar
 **/
$reg_sidebars = array (
    'page_sidebar'     => 'Page Sidebar'
);
foreach ( $reg_sidebars as $id => $name ) {
    register_sidebar(
        array (
            'name'          => __( $name ),
            'id'            => $id,
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<strong class="widgetTitle h3">',
            'after_title'   => '</strong>',
        )
    );
}

/**
 * acf option pages
 */
if(function_exists('acf_add_options_page') ) {
    // Theme General Settings
    acf_add_options_page(array(
        'page_title'    => 'Опції',
        'menu_title'    => 'Опції',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

/**
 * Register post type
 */
if(class_exists('CustomPostType')){
    new CustomPostType('Каталог','catalog','dashicons-grid-view',false,true,array('thumbnail','title'));
}

/**
 * Registration taxonomy
 */
//if(class_exists('CustomTaxonomy')){
//
//};
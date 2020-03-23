<?php
//clear wp_head
show_admin_bar(false);

remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head' );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
add_filter( 'emoji_svg_url', '__return_false' );
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
//remove_action('wp_head', 'qtrans_header', 10, 0);

add_action( 'admin_menu', 'remove_default_post_type' );
function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}

add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
// Remove Emoji js/styles
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

/*Fis Custom Field Blockin*/
add_filter('acf/settings/remove_wp_meta_box', '__return_false',9999);

//remove ID and classes in menu list
//add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
    return is_array($var) ? array_intersect($var, array('current-menu-item','menu-item-has-children')) : '';
}

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

// HTML5 support for IE
function wp_IEhtml5_js () {
    global $is_IE;
    if ($is_IE)
        echo '<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><script src="//css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]--><!--[if lte IE 9]><link href="'.theme().'/style/animations-ie-fix.css" rel="stylesheet" /><![endif]-->';
}
add_action('wp_head', 'wp_IEhtml5_js');

// Contact form 7 remove AUTOTOP
if(defined('WPCF7_VERSION')) {
    function maybe_reset_autop( $form ) {
        $form_instance = WPCF7_ContactForm::get_current();
        $manager = WPCF7_ShortcodeManager::get_instance();
        $form_meta = get_post_meta( $form_instance->id(), '_form', true );
        $form = $manager->do_shortcode( $form_meta );
        $form_instance->set_properties( array(
            'form' => $form
        ) );
        return $form;
    }
    add_filter( 'wpcf7_form_elements', 'maybe_reset_autop' );
}
/* ACF Repeater Styles */
function acf_repeater_even() {
    $scheme = get_user_option( 'admin_color' );
    $color = '';
    if($scheme == 'fresh') {
        $color = '#0073aa';
    } else if($scheme == 'light') {
        $color = '#d64e07';
    } else if($scheme == 'blue') {
        $color = '#52accc';
    } else if($scheme == 'coffee') {
        $color = '#59524c';
    } else if($scheme == 'ectoplasm') {
        $color = '#523f6d';
    } else if($scheme == 'midnight') {
        $color = '#e14d43';
    } else if($scheme == 'ocean') {
        $color = '#738e96';
    } else if($scheme == 'sunrise') {
        $color = '#dd823b';
    }
    echo '<style>.acf-repeater > table > tbody > tr:nth-child(even) > td.order {color: #fff !important;background-color: '.$color.' !important; text-shadow: none}.acf-fc-layout-handle {color: #fff !important;background-color: #23282d!important; text-shadow: none}</style>';
}
add_action('admin_footer', 'acf_repeater_even');

/* BEGIN: Theme config section*/
define ('HOME_PAGE_ID', get_option('page_on_front'));
define ('BLOG_ID', get_option('page_for_posts'));
define ('POSTS_PER_PAGE', get_option('posts_per_page'));
/* END: Theme config section*/

/*remove type of js if is not admin*/
if( !is_admin() ){
    add_filter('script_loader_tag', 'clean_script_tag');
}

function clean_script_tag($input) {
    if(strpos($input,'wp-polyfill-fetch.min.js') === false) {
        $input = str_replace("type='text/javascript' ", '', $input);
        return str_replace("'", '"', $input);
    } else {return false; }
}
// Remove jquery migrate
function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];

        if ( $script->deps ) { // Check whether the script has any dependencies
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}

add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

//function load_custom_scripts() {
//    wp_deregister_script( 'jquery' );
//    wp_deregister_script('wp-embed');
//    wp_register_script('jquery', '//code.jquery.com/jquery-3.4.1.min.js', array(), '3.4.1', true);
//    wp_enqueue_script( 'jquery' );
//}
//if(!is_admin()) {
//    add_action('wp_enqueue_scripts', 'load_custom_scripts', 99);
//}
/**
 * Restore SVG & CSV upload functionality for WordPress 4.9.9 and up
 */
add_filter('wp_check_filetype_and_ext', function($values, $file, $filename, $mimes) {
    if ( extension_loaded( 'fileinfo' ) ) {
        // with the php-extension, a CSV file is issues type text/plain so we fix that back to
        // text/csv by trusting the file extension.
        $finfo     = finfo_open( FILEINFO_MIME_TYPE );
        $real_mime = finfo_file( $finfo, $file );
        finfo_close( $finfo );
        if ( $real_mime === 'text/plain' && preg_match( '/\.(svg)$/i', $filename ) ) {
            $values['ext']  = 'svg';
            $values['type'] = 'image/svg+xml';
        }
        if ( $real_mime === 'text/plain' && preg_match( '/\.(csv)$/i', $filename ) ) {
            $values['ext']  = 'csv';
            $values['type'] = 'text/csv';
        }
    } else {
        // without the php-extension, we probably don't have the issue at all, but just to be sure...
        if ( preg_match( '/\.(csv)$/i', $filename ) ) {
            $values['ext']  = 'svg';
            $values['type'] = 'image/svg+xml';
        }
        if ( preg_match( '/\.(csv)$/i', $filename ) ) {
            $values['ext']  = 'csv';
            $values['type'] = 'text/csv';
        }
    }
    return $values;
}, PHP_INT_MAX, 4);

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function wpa_fix_svg_thumb() {
    echo '<style>td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {width: 100% !important;height: auto !important}</style>';
}
add_action('admin_head', 'wpa_fix_svg_thumb');

//custom SEO title
function seo_title(){
    global $post;
    if(!defined('WPSEO_VERSION')) {
        if(is_404()) {
            echo '404 Page not found - ';
        } elseif((is_single() || is_page()) && $post->post_parent) {
            $parent_title = get_the_title($post->post_parent);
            echo wp_title('-', true, 'right') . $parent_title.' - ';
        } elseif(class_exists('Woocommerce') && is_shop()) {
            echo get_the_title(SHOP_ID) . ' - ';
        } else {
            wp_title('-', true, 'right');
        }
        bloginfo('name');
    } else {
        wp_title();
    }
}

/*Noindex to Adminpage*/
function frontheader() {
    if(is_admin()){ ?>
        <meta name="robots" content="noindex, nofollow" />
    <?php }
}
add_action('admin_head', 'frontheader');

//Show empty categories in category widget
function show_empty_categories_links($args)
{
    $args['hide_empty'] = 0;
    return $args;
}

add_filter('widget_categories_args', 'show_empty_categories_links');
//remove empty title from widget
function foo_widget_title($title)
{
    return $title == '&nbsp;' ? '' : $title;
}

add_filter('widget_title', 'foo_widget_title');

/**
 * Adding post thumbnail support
 */
add_theme_support( 'post-thumbnails' );

///**
// * Menu change a[src="#"] to span
// */
//add_filter( 'walker_nav_menu_start_el', 'my_walker_nav_menu_start_el', 10, 4 );
//function my_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {
//    if ( empty( $item->url ) || '#' === $item->url || $item->current ) {
//        $item_output = $args->before;
//        $item_output .= '<span class="empty_link">';
//        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
//        $item_output .= '</span>';
//        $item_output .= $args->after;
//    }
//    return $item_output;
//}

/**
 * Disable ACF from admin bar
 */

if(class_exists('acf')) {
    if(constant('DISALLOW_FILE_MODS')) {
        add_filter('acf/settings/show_admin', '__return_false');
    }
}

/**
 * ACF json auto import and update
 */
//add
add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    // return
    return $path;
}
//load
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    // return
    return $paths;
}

/**
 * Set default permalink structure
 */
function set_permalink(){
    update_option( 'permalink_structure' , '/%postname%/');
}
add_action('after_switch_theme','set_permalink');

/**
 * @param $columns
 * @return array
 * Add fields to admin pages list
 */
function wpcs_add_thumbnail_columns( $columns ) {
    $columns = array();
    $columns['cb'] = '<input type="checkbox" />';
    $columns['title'] = 'Title';
    $columns['featured_thumb'] = 'Thumbnail';
    if($_GET['post_type'] == 'page'){
        $columns['tpl_page'] = 'Template';
    }
    $columns['index_no_index'] = 'Index (by button in page)';
    $columns['date'] = 'Date';
    return $columns;
}

function wpcs_add_thumbnail_columns_data( $column, $post_id ) {
    switch ( $column ) {
        case 'featured_thumb':
            echo '<style>.admin_thumb img {max-width: 100%; width:80px; height: auto;}</style>';
            echo '<a class="admin_thumb" href="' . get_edit_post_link() . '">';
            echo the_post_thumbnail( 'thumbnail' );
            echo '</a>';
            break;
        case 'index_no_index':
            if(class_exists('acf')){
                echo '<span>';
                echo get_field('index_button') ? '<span style="color: #FF0000" class="dashicons dashicons-chart-bar"></span>' : '<span style="color:#7ad03a" class="dashicons dashicons-chart-bar"></span>';
                echo '</span>';
            }
            break;
        case 'tpl_page':
            if($tpl = str_replace('.php','',get_post_meta( get_the_ID(), '_wp_page_template' ))){
                $tpl = str_replace('tpl-','',$tpl);
                echo '<span style="color:#333; font-weight: 700;text-transform: capitalize;">';
                echo $tpl[0];
                echo '</span>';
            }
            break;
    }
}

if ( function_exists( 'add_theme_support' ) ) {
    add_filter( 'manage_posts_columns' , 'wpcs_add_thumbnail_columns' );
    add_action( 'manage_posts_custom_column' , 'wpcs_add_thumbnail_columns_data', 10, 2 );
    add_filter( 'manage_pages_columns' , 'wpcs_add_thumbnail_columns' );
    add_action( 'manage_pages_custom_column' , 'wpcs_add_thumbnail_columns_data', 10, 2 );
}

/**
 * Remove Yoast SEO comment
 */
if (defined('WPSEO_VERSION')) {
    add_action('wp_head',function() { ob_start(function($o) {
        return preg_replace('/^\n?<!--.*?[Y]oast.*?-->\n?$/mi','',$o);
    }); },~PHP_INT_MAX);
}

/**
 * Disable canonical (Yoast SEO)
 */
add_filter( 'wpseo_canonical', '__return_false' );


/**
 * Disable Feed
 */
function itsme_disable_feed() {
    wp_redirect( home_url(), '301' );
}

add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);

//WPS Hide login default
//add_filter( 'pre_update_option_whl_page', 'deny_whl_page_change', 10, 0 );
//function deny_whl_page_change() {
//    return 'sec-adm';
//}

/**
 * Remove Comments Support
 */

// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
// Removes from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );
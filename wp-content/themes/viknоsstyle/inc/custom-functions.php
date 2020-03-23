<?php

// Custom theme url
function theme($filepath = NULL){
    return preg_replace( '(https?://)', '//', get_stylesheet_directory_uri() . ($filepath?'/' . $filepath:'') );
}

// light function fo wp_get_attachment_image_src()
function image_src($id, $size = 'full', $background_image = false, $height = false) {
    if ($image = wp_get_attachment_image_src($id, $size, true)) {
        return $background_image ? 'background-image: url('.$image[0].');' . ($height?'min-height:'.$image[2].'px':'') : $image[0];
    }
}

/* Social media */
function get_social_media() {
    $some = get_field('some', 'option');
    $soc = '';
    if($some) {
        $soc .= '<div class="some">';
        foreach($some as $sm) {
            $soc .= '<a class="i-'.$sm['icon'].'" target="_blank" rel="nofollow noopener" href="'.$sm['link'].'" rel="nofollow"></a>';
        }
        $soc .= '</div>';
    }
    return $soc;
}

/*GET Alt*/
function get_alt($id){
    $c_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
    $c_tit = get_the_title($id);
    return $c_alt?$c_alt:$c_tit;
}

/*Get Current Url*/
function get_current_url() {
    $pageURL = 'http';
    if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    return str_replace('www.', '', $pageURL);
}

/*Custom Canonical*/
function custom_canonical(){
    global $paged;
    $str =  get_current_url();
    if($paged > 1 && is_home()) {
        $str = get_permalink( get_option( 'page_for_posts' ) );
    }
//    if($paged > 1 && is_page_template('tpl-reviews.php')) {
//        $str = substr(get_current_url(), 0, strpos( get_current_url(), 'page/'));
//    }
    if(strpos( $str, '?')){
        $str = substr($str, 0, strpos( $str, '?'));
    }
    return $str;
}

/*For Svg Icons (with code)*/
function svg_icon_c($icon) {
    $item = glob(get_template_directory().'/assets/images/'.$icon.'.svg');
    return $item ? file_get_contents($item[0]) :'<span class="svg_err">SVG Error: Sorry, file '.$icon.'.svg is not in directory</span>';
}
/*For Flags Icons (without code)*/
function svg_icon($icon) {
    $item = theme('assets/images/'.strtolower($icon).'.svg');
    return $item;
}

/*War Dump function*/
function wpa_dump($variable){
    $pretty = function($v='',$c="&nbsp;&nbsp;&nbsp;&nbsp;",$in=-1,$k=null)use(&$pretty){$r='';if(in_array(gettype($v),array('object','array'))){$r.=($in!=-1?str_repeat($c,$in):'').(is_null($k)?'':"$k: ").'<br>';foreach($v as $sk=>$vl){$r.=$pretty($vl,$c,$in+1,$sk).'<br>';}}else{$r.=($in!=-1?str_repeat($c,$in):'').(is_null($k)?'':"$k: ").(is_null($v)?'&lt;NULL&gt;':"<strong>$v</strong>");}return$r;};
    echo '<pre style="padding-left: 50px; font-family: Courier New"><code class="json">' . $pretty($variable) . '</code></pre>';
}

/*Console var dump*/
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
};

/*Test speed*/
function speed($function, $callback) {
    $time = microtime(TRUE);
    $mem = memory_get_usage();?>
    <div class="speed_hidden" style="display: none!important;">
        <?php
        for($i = 1; $i<$callback; $i++) {
            echo $function;
        }
        ?>
    </div>
    <?php print_r(array(
        'memory' => (memory_get_usage() - $mem) / (1024 * 1024),
        'seconds' => microtime(TRUE) - $time
    ));
}

// HTML Compress
if(!is_admin()) {
    add_action('get_header','compress',99999);
}
function compress() {
    get_field('compress_html','option') ? ob_start('ob_html_compress') : false;
}
function ob_html_compress($buf){
    return preg_replace(array('/<!--(?>(?!\[).)(.*)(?>(?!\]).)-->/Uis','/[[:blank:]]+/'),array('',' '),str_replace(array("\n","\r","\t"),'',$buf));
}
/*
 * Hide editor on specific pages.
 *
 */
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
    // Get the Post ID.
    if(isset($_GET['post'])){
        $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    }
    if( !isset( $post_id ) ) return;
    // Hide the editor on the page title
    if(get_the_title($post_id) == 'Test page' || get_the_title($post_id) == 'Test Page'){
        remove_post_type_support('page', 'editor');
    }
    // Hide the editor on a page with a specific page template
    // Get the name of the Page Template file.
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
    if($template_file == 'tpl-blank.php'){ // the filename of the page template
        remove_post_type_support('page', 'editor');
    }
}

/**
 * Rating ajax
 */
function add_rating_count(){
    $count = $_POST['count'];
    $id = $_POST['id'];
    if($count){
        update_field('rating_count', $count++, $id);
    }
    else {
        update_field('rating_count', 1, $id);
    }
    die();
}
add_action('wp_ajax_add_rating_count', 'add_rating_count');
add_action('wp_ajax_nopriv_add_rating_count', 'add_rating_count');


/**
 * Ajax for blog
 */
function true_load_posts(){
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';
    $q = new WP_Query($args);
    if( $q->have_posts() ): ?>
        <?php while($q->have_posts())  : $q->the_post(); ?>
            <?php get_template_part('template-parts/blog/blog-item'); ?>
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
    <?php endif;
    wp_reset_postdata();
    die();
}

add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');

//get_option_lang
function get_option_page_id() {
    return 'option';
}


if(!function_exists('get_theme_sidebar')) {
    function get_theme_sidebar($template = null) {
        switch($template) {
            case 'minified' :
                echo '
                    <aside class="sidebar js-sidebar js-sidebar-minified">
                        ' , get_sidebar_cat('mini') , '
                        ' , get_sidebar() , '
                    </aside>
                ';
            break;
            case 'homepage' ;
                echo '
                    <aside class="sidebar js-sidebar js-sidebar-homepage">
                        ' , get_sidebar_cat('homepage') , '       
                        ' , get_sidebar() , '
                    </aside>
                ';
            break;
            case 'simple' :
            default : 
                echo '
                    <aside class="sidebar js-sidebar js-sidebar-simple">
                        ' , get_sidebar() , '
                    </aside>
                ';            
        }

        return false;
    }
}

if(!function_exists('get_table_headings')) {
    function get_table_headings() {
        $data = get_field('labels_tab_table_labels', 'option') ? get_field('labels_tab_table_labels', 'option') : null;
        $headings = array();
        $it = 0;

        if($data) {
            foreach($data as $heading) {
                $headings[$it] = $heading['labels_tab_table_labels_heading'] ? $heading['labels_tab_table_labels_heading'] : '';
                ++$it;
            }
        }

        return $headings;
    }
}

if(!function_exists('wrap_the_heading')) {
    function wrap_the_heading($class, $heading) {
        return '
            <div class="row">
                <div class="col-12">
                    <div class="' . $class . '">' . $heading . '</div>
                </div>
            </div>
        ';
    }
}


// Get featured image alt
if(!function_exists('get_image_alt')) {
    function get_image_alt(int $post_id) {
        $thumbnail_id = get_post_thumbnail_id($post_id);
        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) 
            ? get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true)
            : get_the_title($post_id);

        return $alt;
    }
}

if(!function_exists('get_footer_term_icons')) {
    function get_footer_term_icons($keyword) {
        $term_type      = strtolower($keyword);
        $list_of_terms  = get_field('footer_' . $term_type, 'option');
        $icons_output   = '';

        if($term_type && is_array($list_of_terms)) {
            $icons_output = '';

            foreach($list_of_terms as $term) {
                if( get_field('payment_img', $term->taxonomy . '_' . $term->term_id) ){
                    $icon = get_field('payment_img', $term->taxonomy . '_' . $term->term_id);
                    $icons_output .= '<span class="footer-icons-item">
                            <img class="footer-icons-image" src="' . $icon['url']. '" alt="' . $icon['alt'] . '">
                        </span>';
                }
            }

            return '
                <div class="footer-icons">
                    ' . $icons_output . '
                </div>
            ';
        }

        return false;
    }
}

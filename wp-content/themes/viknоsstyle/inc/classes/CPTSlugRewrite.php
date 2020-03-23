<?php
/**
 * Class CPTSlugRewrite
 */

class CPTSlugRewrite
{
    public $cpt_slug = '';
    function na_remove_slug( $post_link, $post ) {
        $slug = $this-> cpt_slug;
        if ( $slug != $post->post_type || 'publish' != $post->post_status ) {
            return $post_link;
        }
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
        return $post_link;
    }
    function cpt_slug_redirect(){
        $slug = $this->cpt_slug;
        $url = parse_url(get_current_url());
        $new_url = explode('/',$url['path']);
        if($new_url[1] == $slug){
            wp_redirect( site_url().'/'.$new_url[2], 301 );
            exit();
        }
        else {
            return;
        }
    }
    function __construct() {
        add_filter( 'post_type_link', array($this, 'na_remove_slug'), 10, 3 );
        add_action('template_redirect', array($this, 'cpt_slug_redirect'));
    }
}
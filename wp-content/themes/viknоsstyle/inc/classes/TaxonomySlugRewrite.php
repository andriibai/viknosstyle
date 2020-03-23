<?php

/**
 * Class TaxonomySlugRewrite
 */
class TaxonomySlugRewrite
{
    public $tax = '';
    public $slug = '';
    public function rudr_change_term_request($query){

        $tax_name = $this->tax; // specify you taxonomy name here, it can be also 'category' or 'post_tag'

        // Request for child terms differs, we should make an additional check
        $name = '';
        $include_children = '';
        if( isset($query['attachment']) ) :
            $include_children = true;
            $name = $query['attachment'];
        elseif(!isset($query['attachment'])&&isset($query['name'])):
            $include_children = false;
            $name = $query['name'];
        endif;


        $term = get_term_by('slug', $name, $tax_name); // get the current term to make sure it exists

        if (isset($name) && $term && !is_wp_error($term)): // check it here

            if( $include_children ) {
                unset($query['attachment']);
                $parent = $term->parent;
                while( $parent ) {
                    $parent_term = get_term( $parent, $tax_name);
                    $name = $parent_term->slug . '/' . $name;
                    $parent = $parent_term->parent;
                }
            } else {
                unset($query['name']);
            }

            switch( $tax_name ):
                case 'category':{
                    $query['category_name'] = $name; // for categories
                    break;
                }
                case 'post_tag':{
                    $query['tag'] = $name; // for post tags
                    break;
                }
                default:{
                    $query[$tax_name] = $name; // for another taxonomies
                    break;
                }
            endswitch;

        endif;

        return $query;

    }
    public function rudr_term_permalink( $url, $term, $taxonomy ){

        $taxonomy_name = $this->tax; // your taxonomy name here
        $taxonomy_slug = $this->slug; // the taxonomy slug can be different with the taxonomy name (like 'post_tag' and 'tag' )

        // exit the function if taxonomy slug is not in URL
        if ( strpos($url, $taxonomy_slug) === FALSE || $taxonomy != $taxonomy_name ) return $url;

        $url = str_replace('/' . $taxonomy_slug, '', $url);

        return $url;
    }
    public function rudr_old_term_redirect() {

        $taxonomy_name = $this->tax;
        $taxonomy_slug = $this->slug;

        // exit the redirect function if taxonomy slug is not in URL
        if( strpos( $_SERVER['REQUEST_URI'], $taxonomy_slug ) === FALSE)
            return;

        if( ( is_category() && $taxonomy_name=='category' ) || ( is_tag() && $taxonomy_name=='post_tag' ) || is_tax( $taxonomy_name ) ) :

            wp_redirect( site_url( str_replace($taxonomy_slug, '', $_SERVER['REQUEST_URI']) ), 301 );
            exit();

        endif;

    }
    function __construct() {
        add_filter('request', array($this, 'rudr_change_term_request'), 1, 1 );
        add_filter( 'term_link', array($this, 'rudr_term_permalink'), 10, 3 );
        add_action('template_redirect',array($this, 'rudr_old_term_redirect'));
    }
}
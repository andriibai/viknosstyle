<?php
require_once 'classes/WPStructuralElements.php';
require_once 'classes/ACFFilter.php';
require_once 'classes/CustomPostType.php';
require_once 'classes/CustomTaxonomy.php';
require_once 'classes/CPTSlugRewrite.php';
require_once 'classes/TaxonomySlugRewrite.php';
require_once 'classes/RobotsTxtParser.php';
require_once 'classes/RobotsTxtValidator.php';

/**
 * Delete slug From CPT
 * (uncomend when use)
 * */
if(class_exists('CPTSlugRewrite')){
//    add_action('init', 'delete_slug_from_cpt');
    function delete_slug_from_cpt() {
        if(post_type_exists('post_type_slug')){//change
            $post_type_slug = new CPTSlugRewrite();
            $post_type_slug->cpt_slug = 'post_type_slug'; //change
        }
    }
    function na_parse_request( $query ) {
        if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
            return;
        }
        if ( ! empty( $query->query['name'] ) ) {
            $query->set( 'post_type', array( 'post', 'page', 'post_type_slug' ) ); //post type list , add items
        }
    }
//    add_action( 'pre_get_posts', 'na_parse_request');
}

/**
Delete Taxonomy Slug
 */
if(class_exists('TaxonomySlugRewrite')){
    add_action('init', 'delete_slug_from_taxonomy');
    function delete_slug_from_taxonomy() {
        if(taxonomy_exists('category')){
            $rewrite_taxonomy_slug = new TaxonomySlugRewrite();
            $rewrite_taxonomy_slug->tax = 'category';
            $rewrite_taxonomy_slug->slug = 'category';
        }
        if(taxonomy_exists('post_tag')){
            $rewrite_taxonomy_slug = new TaxonomySlugRewrite();
            $rewrite_taxonomy_slug->tax = 'post_tag';
            $rewrite_taxonomy_slug->slug = 'tag';
        }
    }
}
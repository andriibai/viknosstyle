<?php

function casino_remove_cpt_slug( $post_link, $post, $leavename ) {
    if ( 'catalog' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    return $post_link;
}
add_filter( 'post_type_link', 'casino_remove_cpt_slug', 10, 3 );

function rw_parse_request( $query ) {
    // Only noop the main query

    if ( ! $query->is_main_query() )
        return;
    // Only noop our very specific rewrite rule match
    if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }
    // 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'catalog','post' ) ); //  Will bring the bug on 404 see https://core.trac.wordpress.org/ticket/43056
    }
}
add_action( 'pre_get_posts', 'rw_parse_request' );

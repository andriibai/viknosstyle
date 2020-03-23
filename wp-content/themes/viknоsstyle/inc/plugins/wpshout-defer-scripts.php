<?php
/*
Plugin Name: WPShout Defer Scripts
Description: Defer Blocking JavaScript
Author: WPShout
Author URI: http://www.wpshout.com
*/

/*
* Getting script tags
* Thanks http://wordpress.stackexchange.com/questions/54064/how-do-i-get-the-handle-for-all-enqueued-scripts
*/

// add_action( 'wp_print_scripts', 'wsds_detect_enqueued_scripts' );
// function wsds_detect_enqueued_scripts() {
// 	global $wp_scripts;
// 	foreach( $wp_scripts->queue as $handle ) :
// 		echo $handle . ' | ';
// 	endforeach;
// }


/*
* Deferring and asyncing scripts
* Thanks http://scottnelle.com/756/async-defer-enqueued-wordpress-scripts/
*/

// DEFER internal scripts
add_filter( 'script_loader_tag', 'wsds_defer_scripts', 10, 3 );
function wsds_defer_scripts( $tag, $handle, $src ) {

    // The handles of the enqueued scripts we want to defer
    $defer_scripts = array(
        'main',
        'wp-embed',
        'admin-bar',
        'wpshout-js-cookie-demo',
        'cookie',
        'jquery-migrate',
    );

    if ( in_array( $handle, $defer_scripts ) ) {
        return '<script type="text/javascript" src="' . $src . '"></script>' . "\n";
    }

    return $tag;
}


// ASYNC external scripts
add_filter( 'script_loader_tag', 'wsds_async_scripts', 10, 3 );
function wsds_async_scripts( $tag, $handle, $src ) {

    // The handles of the enqueued scripts we want to async
    $async_scripts = array(

    );

    if ( in_array( $handle, $async_scripts ) ) {
        return '<script type="text/javascript" src="' . $src . '" async="async"></script>' . "\n";
    }

    return $tag;
}
<?php
/*
Plugin Name: Processing.js for WordPress
Plugin URI: http://www.ramoonus.nl/wordpress/processing-js/
Description: Processing.js is the sister project of the popular Processing visual programming language, designed for the web.
Version: 1.6.6
Author: Ramoonus
Author URI: http://www.ramoonus.nl/
License: GPL2
*/

/**
 * Main Function
 *
 * @todo debug minify toggle
 *
 * @version 1.6.6
 * @since 1.0.0
 */
function rw_processing() {
	wp_deregister_script( 'processing' ); //deregister

	wp_enqueue_script( 'processing', plugins_url( '/js/processing.min.js', __FILE__ ), false, '1.6.6' );

    /**
     * P5.js
     * @since 1.4.9
     * @todo implement
     */
}
add_action( 'wp_enqueue_scripts', 'rw_processing' );

/**
 * Shortcode
 * @todo param phpdoc, validate
 * @version 1.4.9
 * @author mackensen
 */
function rw_processing_sc( $attr, $content ) {
    // open
    $output = '<script type="application/processing" data-processing-target="processingcanvas">';
    // return content
    $output .= html_entity_decode( $content );
    // close
    $output .= '</script>';
    $output .= '<canvas id="processingcanvas"></canvas>';
    return $output;
}

// Do not texturize the shortcodes.
add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );
function shortcodes_to_exempt_from_wptexturize( $shortcodes ) {
    $shortcodes[] = 'processingjs';
    $shortcodes[] = 'processing';
    return $shortcodes;
}

add_shortcode( 'processing', 'rw_processing_sc' );
add_shortcode( 'processingjs', 'rw_processing_sc' );
// evil! remove_filter( 'the_content', 'wpautop' );
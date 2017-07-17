<?php
/**
 * Democrats enqueue functions
 *
 * @package Understrap
 * @subpackage Democrats\Inc
 * @since 0.0.1
 */

/**
 * Remove Parent Styles and Scripts
 *
 * @since 0.0.1
 */
function democrats_remove_parent_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'democrats_remove_parent_scripts', 20 );

/**
 * Enqueue Child Styles and Scripts
 *
 * @since 0.0.1
 */
function democrats_enqueue_styles() {
	// Get the theme data
	$the_theme = wp_get_theme();

    wp_enqueue_style( 'democrats-styles', get_stylesheet_directory_uri() . '/css/style.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'democrats-scripts', get_stylesheet_directory_uri() . '/js/app.min.js', array(), $the_theme->get( 'Version' ), true );

}
add_action( 'wp_enqueue_scripts', 'democrats_enqueue_styles' );

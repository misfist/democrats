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

    if( is_home() ) {
      $button_text = get_option( 'load_more_button_text', __( 'Load More', 'democrats' ) );
      $args = array(
        'nonce'           => wp_create_nonce( 'load_more_button' ),
        'ajax_url'        => admin_url( 'admin-ajax.php' ),
        'button_text'     => $button_text,
        'posts_per_page'  => get_option( 'posts_per_page' )
      );
      wp_enqueue_script( 'democrats-load-more', trailingslashit( get_stylesheet_directory_uri() ) . 'js/load-more.js', array( 'jquery' ), null, true );
      wp_localize_script( 'democrats-load-more', 'democrats_load_more', $args );
    }
}
add_action( 'wp_enqueue_scripts', 'democrats_enqueue_styles' );

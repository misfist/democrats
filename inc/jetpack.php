<?php
/**
 * Democrats Jetpack functions
 *
 * @package Understrap
 * @subpackage Democrats\Inc
 * @since 0.0.1
 */

/**
 * Remove Parent JetPack Settings
 */
function democrats_remove_parent_jetpack_settings() {
  remove_action( 'after_setup_theme', 'components_jetpack_setup', 1 );
}
add_action( 'after_setup_theme', 'democrats_remove_parent_jetpack_settings' );

 /**
  * Jetpack setup function.
  *
  * See: https://jetpack.me/support/infinite-scroll/
  * See: https://jetpack.me/support/responsive-videos/
  */
function democrats_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
    'type'            => 'click',
    'container'       => 'home-post-list',
    'render'          => 'democrats_infinite_scroll_render',
    'footer'          => 'page',
    'posts_per_page'  => get_option( 'posts_per_page', 4 ),
    'click_handle'    => false
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Social Menus
	// add_theme_support( 'jetpack-social-menu' );
}
//add_action( 'after_setup_theme', 'democrats_jetpack_setup', 20 );

 /**
  * Custom render function for Infinite Scroll
  *
  * @since 0.0.1
  *
  * Return void
  */
function democrats_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'loop-templates/content', 'search' );
  elseif( is_home() ) :
    get_template_part( 'loop-templates/content', 'grid' );
		else :
			get_template_part( 'loop-templates/content', get_post_format() );
		endif;
	}
}

/**
 * Modify JetPack Infinite Scroll Settings
 *
 * @since 0.0.1
 *
 * @uses infinite_scroll_js_settings filter hook
 * @link https://developer.jetpack.com/hooks/infinite_scroll_js_settings/
 *
 * @param {array} $settings
 * @return {array} $settings
 */
function democrats_jetpack_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load More', 'democrats' );
	return $settings;
}
//add_filter( 'infinite_scroll_js_settings', 'democrats_jetpack_infinite_scroll_js_settings' );

/**
 * Add Query Args to JetPack Infinite Scroll
 * Exclude latest sticky post from infinite scroll
 *
 * @since 0.0.1
 *
 * @uses infinite_scroll_query_args filter hook
 * @link https://developer.jetpack.com/hooks/infinite_scroll_query_args/
 *
 * @param {array} $args
 * @return {array} $args
 */
function democrats_jetpack_infinite_scroll_query_args( $args ) {

  if( function_exists( 'democrats_get_latest_sticky_post' ) ) {
    $sticky = democrats_get_latest_sticky_post();

    if( !empty( $sticky ) ) {
      $args['post__not_in'] = $sticky;
    }
  }

  return $args;
}
//add_filter( 'infinite_scroll_query_args', 'democrats_jetpack_infinite_scroll_query_args' );

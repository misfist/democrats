<?php
/**
 * Democrats extra functions
 *
 * @package Understrap
 * @subpackage Democrats\Inc
 * @since 0.0.1
 */

/**
 * Add Sidebar Class to Body
 *
 * @since 0.0.1
 *
 * @param {array} $classes
 * @return {array} $classes Modified array of classes
 */
function democrats_sidebar_body_class( $classes ) {
   $classes[] = is_active_sidebar( 'right-sidebar' ) ? 'has-sidebar' : 'no-sidebar';
   return $classes;
}
add_filter( 'body_class', 'democrats_sidebar_body_class' );

/**
 * Set Number of Posts
 *
 * @since 0.0.1
 *
 * @uses pre_get_posts action
 * @link https://developer.wordpress.org/reference/hooks/pre_get_posts/
 *
 * @param {obj} $query
 * @return void
 */
function democrats_pre_get_posts( $query ) {
  if( $query->is_home() && $query->is_main_query() && ! is_admin() ) {
    $posts_per_page = get_option( 'posts_per_page', 4 );
    $query->set( 'posts_per_page', $posts_per_page );
  }
}
add_action( 'pre_get_posts', 'democrats_pre_get_posts' );

/**
 * Set Post Limits
 * Override default 5 posts
 *
 * @since 0.0.1
 *
 * @param {string} $limit
 * @param {obj} $query
 * @return {string} $limit
 */
function democrats_post_limits( $limit, $query ) {
	if( $query->is_home() && $query->is_main_query() && ! is_admin() ){
		return 'LIMIT 0, 4';
	}
	return $limit;
}
add_filter( 'post_limits', 'democrats_post_limits', 10, 2 );

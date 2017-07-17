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
 * Set Main Query Vars
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
  if( $query->is_home() && $query->is_main_query() ) {
    $sticky = get_option( 'sticky_posts' );

    /**
     * Sticky posts are prepended to post object by default and `post__not_in` is not respected
     * This causes pagination issues and will make the most recent sticky (featured post) repeat
     * @link https://codex.wordpress.org/Class_Reference/WP_Query#Post_.26_Page_Parameters
     */
    if( $sticky ) {
      $query->set( 'ignore_sticky_posts', true );
    }
  }
}
add_action( 'pre_get_posts', 'democrats_pre_get_posts' );

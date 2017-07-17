<?php
/**
 * Democrats helper functions
 *
 * @package Understrap
 * @subpackage Democrats\Inc
 * @since 0.0.1
 */

/**
 * Get Latest Sticky Post
 * Get the most recent sticky post ID in an array
 *
 * @since 0.0.1
 *
 * @return array | null
 */
function democrats_get_latest_sticky_post() {
  $sticky = get_option( 'sticky_posts' );

  $posts = get_posts( array(
    'include'         => $sticky,
    'posts_per_page'  => count( $sticky ),
    'fields'          => 'ids'
  ) );

  if( !empty( $posts ) && !is_wp_error( $posts ) ) {
    return array_slice( $posts, 0, 1 );
  }

  return null;
}

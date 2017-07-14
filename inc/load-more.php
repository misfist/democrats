<?php
/**
* Democrats Load More
*
* @package Understrap
* @subpackage Democrats\Inc
* @since 0.0.1
*/

/**
* Get Posts
* Get $_POST values and return content
*
* @since 0.0.1
*
* @uses do_taxonomy_filters action
* @uses wp_ajax_ action hook
* @uses WP_Query()
* @uses wp_verify_nonce()
*
* @link https://codex.wordpress.org/Class_Reference/WP_Query
* @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_ajax_(action)
*
* @return void
*/
function democrats_load_more_posts() {

  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'load_more_button' ) ) {
    die( 'Permission denied' );
  }

  $args = array(
    'posts_per_page'  => intval( $_POST['args']['posts_per_page'] ),
    'post_type'       => 'post'
  );

  if( isset( $_POST['args']['paged'] ) ) {
    $args['paged'] = intval( $_POST['args']['paged'] );
  }

  // $sticky = get_option( 'sticky_posts' );
  //
  // if( $sticky ) {
  //   $sticky = intval( $sticky[0] );
  //   $args['post__not_in'] = array( $sticky );
  // }

  $posts_query = new WP_Query( $args );

  ob_start();

  if( $posts_query->have_posts() ) {

    while( $posts_query->have_posts() ) :
      $posts_query->the_post();

      get_template_part( 'loop-templates/content', 'home' );

    endwhile;

  } else {

    get_template_part( 'loop-templates/content', 'none' );

  }

  $response = array(
    'content'         => ob_get_clean(),
    'posts_found'     => intval( $posts_query->found_posts ),
    'paged'           => $posts_query->query_vars['paged'],
    'posts_per_page'  => intval( $posts_query->query_vars['posts_per_page'] ),
    'max_pages'       => ceil( intval( $posts_query->found_posts ) / intval( $posts_query->query_vars['posts_per_page'] ) ),
    'args'             => $args,
    'vars'             => $posts_query
  );

  wp_send_json( $response );

  die();

}
add_action( 'wp_ajax_do_democrats_load_more_posts', 'democrats_load_more_posts' );
add_action( 'wp_ajax_nopriv_do_democrats_load_more_posts', 'democrats_load_more_posts' );

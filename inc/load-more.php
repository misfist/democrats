<?php
/**
* Democrats Load More
*
* @package Understrap
* @subpackage Democrats\Inc
* @since 0.0.1
*/

/**
 * Enqueue and Localize JS for Load More
 *
 * @since 0.0.1
 *
 * @uses democrats_get_latest_sticky_post()
 *
 * @return void
 */
function democrats_enqueue_load_more_scripts() {

  /**
   * Only enqueue and localize on home page and single post pages
   */
  if( ! is_home() && ! is_singular( 'post' ) ) {
    return;
  }

  $button_text = get_option( 'load_more_button_text', __( 'Load More', 'democrats' ) );

  $query = array(
    'posts_per_page'      => get_option( 'posts_per_page', 4 ),
    'ignore_sticky_posts' => true,
  );

  /**
   * Don't include the most recent sticky post in post list
   */
  if( is_home() ) {
    $sticky = democrats_get_latest_sticky_post();
    $query['post__not_in']  = $sticky;
  }
  /**
   * Don't include the current post in post list
   */
  elseif( is_singular( 'post' ) ) {
    $query['post__not_in']  = array( get_queried_object_id() );
  }

  $args = array(
    'nonce'           => wp_create_nonce( 'load_more_button' ),
    'ajax_url'        => admin_url( 'admin-ajax.php' ),
    'button_text'     => $button_text,
    'query'           => $query,
  );

  wp_enqueue_script( 'democrats-load-more', trailingslashit( get_stylesheet_directory_uri() ) . 'js/load-more.js', array( 'jquery' ), null, true );
  wp_localize_script( 'democrats-load-more', 'democrats_load_more', $args );
}
add_action( 'wp_enqueue_scripts', 'democrats_enqueue_load_more_scripts' );

/**
 * Get Posts
 * Get $_POST values, fetch posts and send content as JSON to `do_democrats_load_more_posts` action
 *
 * @since 0.0.1
 *
 * @uses wp_ajax_ action hook
 * @uses wp_ajax_nopriv_ action hook
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

  $args = isset( $_POST['query'] ) ? array_map( 'esc_attr', $_POST['query'] ) : array();
  $args['post__not_in'] = $_POST['query']['post__not_in'];
  $args['post_type'] = isset( $args['post_type'] ) ? esc_attr( $args['post_type'] ) : 'post';
  $args['paged'] = esc_attr( $_POST['page'] );
  $args['post_status'] = 'publish';

  $posts_query = new WP_Query( $args );

  ob_start();

  if( $posts_query->have_posts() ) {

    while( $posts_query->have_posts() ) :
      $posts_query->the_post();

      /* TODO: figure out how we're going to load ad spaces and confirm intervals */
      if ( 2 === ( $posts_query->current_post + 1 ) ) {
        get_template_part( 'loop-templates/content', 'grid-adspace' );
      } else {
        get_template_part( 'loop-templates/content', 'grid' );
      }

    endwhile;

  }

  wp_reset_postdata();

  $response = array(
    'content'         => ob_get_clean(),
    'current_page'    => (int) $args['paged'],
    'max_pages'       => $posts_query->max_num_pages,
  );

  wp_send_json( $response );

  wp_die();

}
add_action( 'wp_ajax_do_democrats_load_more_posts', 'democrats_load_more_posts' );
add_action( 'wp_ajax_nopriv_do_democrats_load_more_posts', 'democrats_load_more_posts' );

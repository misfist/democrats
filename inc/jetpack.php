<?php
/**
 * Democrats Jetpack functions
 *
 * @package Understrap
 * @subpackage Democrats\Inc
 * @since 0.0.1
 */

remove_action( 'after_setup_theme', 'components_jetpack_setup', 99 );

 // /**
 //  * Jetpack setup function.
 //  *
 //  * See: https://jetpack.me/support/infinite-scroll/
 //  * See: https://jetpack.me/support/responsive-videos/
 //  */
 // function democrats_jetpack_setup() {
 // 	// Add theme support for Infinite Scroll.
 // 	add_theme_support( 'infinite-scroll', array(
 //    'type'            => 'click',
 // 		'container'       => 'main',
 // 		'render'          => 'democrats_infinite_scroll_render',
 // 		'footer'          => 'page',
 //    'posts_per_page'  => 4
 // 	) );
 //
 // 	// Add theme support for Responsive Videos.
 // 	add_theme_support( 'jetpack-responsive-videos' );
 //
 // 	// Add theme support for Social Menus
 // 	add_theme_support( 'jetpack-social-menu' );
 //
 // }
 // add_action( 'after_setup_theme', 'democrats_jetpack_setup' );
 //
 // /**
 //  * Custom render function for Infinite Scroll.
 //  */
 // function democrats_infinite_scroll_render() {
 // 	while ( have_posts() ) {
 // 		the_post();
 // 		if ( is_search() ) :
 // 			get_template_part( 'loop-templates/content', 'search' );
 //    elseif( is_home() ) :
 //      get_template_part( 'loop-templates/content', 'home' );
 // 		else :
 // 			get_template_part( 'loop-templates/content', get_post_format() );
 // 		endif;
 // 	}
 // }

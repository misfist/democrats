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

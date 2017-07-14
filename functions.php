<?php
/**
 * Democrats functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package Understrap
 * @subpackage Democrats
 * @since 0.0.1
 */

include_once( trailingslashit( get_stylesheet_directory() ) . 'inc/setup.php' );
include_once( trailingslashit( get_stylesheet_directory() ) . 'inc/enqueue.php' );
include_once( trailingslashit( get_stylesheet_directory() ) . 'inc/extras.php' );
include_once( trailingslashit( get_stylesheet_directory() ) . 'inc/template-tags.php' );
include_once( trailingslashit( get_stylesheet_directory() ) . 'inc/jetpack.php' );
include_once( trailingslashit( get_stylesheet_directory() ) . 'inc/load-more.php' );

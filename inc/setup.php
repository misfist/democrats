<?php
/**
 * Democrats setup functions
 *
 * @package Understrap
 * @subpackage Democrats\Inc
 * @since 0.0.1
 */

 /**
  * Register Widget Areas
  *
  * @since 0.0.1
  *
  * @uses register_sidebar()
  * @uses widgets_init action hook
  *
  * @return void
  */
 function democrats_widgets(){
   register_sidebar( array(
     'name'          => __( 'Footer Info', 'democrats' ),
     'id'            => 'footer-info',
     'description'   => 'Footer info area. Could be used for copyright information or terms.',
     'before_widget' => '<div id="%1$s" class="site-info %2$s">',
     'after_widget'  => '</div>',
     'before_title'  => '<h3 class="widget-title">',
     'after_title'   => '</h3>',
   ) );
 }
 add_action( 'widgets_init', 'democrats_widgets' );

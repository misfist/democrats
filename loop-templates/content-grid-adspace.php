<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package Understrap
 * @subpackage Democrats\Loop_Templates
 * @since 0.0.1
 */
?>

<article <?php post_class( 'col-12 col-md-6' ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">


	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php _e( 'Ad Space', 'democrats' ); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">


	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

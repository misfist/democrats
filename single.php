<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header();
$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<div class="wrapper" id="wrapper-static-hero">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop-templates/content', 'single' ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					// if ( comments_open() || get_comments_number() ) :
					// 	comments_template();
					// endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php get_sidebar( 'right' ); ?>

		<?php endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->



<div class="wrapper" id="wrapper-index">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- If there is a featured post, exclude in results -->
			<main class="site-main grid" id="main">

				<div class="row results" id="home-post-list">

					<?php
					$args = array(
						'post__not_in' 				=> array( get_queried_object_id() ),
				    'posts_per_page'  		=> get_option( 'posts_per_page', 4 ),
						'ignore_sticky_posts'	=> true
					);
					$query = new WP_Query( $args );
					?>

						<?php /* Start the Loop */ ?>

						<?php if( $query->have_posts() ) :  ?>

							<?php while( $query->have_posts() ) : $query->the_post(); ?>

								<?php if( $post->ID != get_queried_object_id() ) : ?>

								<?php

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'loop-templates/content', 'grid' );
								?>

							<?php endif; ?>

						<?php endwhile; ?>

						<?php// wp_reset_postdata(); ?>

					<?php endif; ?>

				</div>

			</main><!-- #main -->

			<div id="infinite-scroll"></div>

		</div><!-- #primary -->


	</div><!-- .row -->

</div><!-- Container end -->

<?php get_footer(); ?>

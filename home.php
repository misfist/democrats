<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 * @subpackage Democrats
 * @since 0.0.1
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<!-- Display 1 Featured Posts -->
<?php $sticky = get_option( 'sticky_posts' ); ?>
<?php if( !empty( $sticky ) ) : ?>

	<?php $sticky = $sticky[0]; ?>
	<?php $featured_args = array( 'include' => $sticky, 'posts_per_page' => 1 ); ?>
	<?php $featured_query = new WP_Query( $featured_args ); ?>

	<?php if( $featured_query->have_posts() ) : ?>
		<?php $count = 1; ?>
		<?php while( $featured_query->have_posts() && 1 === $count ) : $featured_query->the_post(); ?>

			<?php get_template_part( 'global-templates/hero', 'featured' ); ?>

			<?php $count++; ?>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

<?php endif; ?>

<div class="wrapper" id="wrapper-index">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php// get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

			<!-- If there is a featured post, exclude in results -->
			<main class="site-main grid" id="main">

				<div class="row results" id="home-post-list">

						<?php /* Start the Loop */ ?>

						<?php if( have_posts() ) :  ?>

							<?php while( have_posts() ) : the_post(); ?>

							<?php

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'loop-templates/content', 'grid' );
							?>

						<?php endwhile; ?>

					<?php else : ?>

						<?php get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>

				</div>

			</main><!-- #main -->

			<div id="infinite-scroll"></div>

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php get_sidebar( 'right' ); ?>

		<?php endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>

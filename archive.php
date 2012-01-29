<?php 
/**
 * The template for displaying Archive pages

 * @package WordPress
 * @subpackage Rumput_Hijau
 * @since Rumput Hijau 1.0.0
 */
 
get_header(); ?>

	<h1 class="archive-title">
		<?php if ( is_day() ) : ?>
			<?php printf( __( 'Daily Archives: %s', 'rumputhijau' ), '<span>' . get_the_date() . '</span>' ); ?>
		<?php elseif ( is_month() ) : ?>
			<?php printf( __( 'Monthly Archives: %s', 'rumputhijau' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'rumputhijau' ) ) . '</span>' ); ?>
		<?php elseif ( is_year() ) : ?>
			<?php printf( __( 'Yearly Archives: %s', 'rumputhijau' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'rumputhijau' ) ) . '</span>' ); ?>
		<?php elseif ( is_category() ) : ?>
			<?php printf( __( 'Category Archives: %s', 'rumputhijau' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
		<?php elseif ( is_tag() ) : ?>
			<?php printf( __( 'Tag Archives: %s', 'rumputhijau' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
		<?php else : ?>
			<?php _e( 'Blog Archives', 'rumputhijau' ); ?>
		<?php endif; ?>
	</h1>

	<?php get_template_part('loop'); ?>

<?php get_footer(); ?>
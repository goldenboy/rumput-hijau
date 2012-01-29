<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage Rumput_Hijau
 * @since Rumput Hijau 1.0.0
 */

 get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<div class="entry-content">
				<?php the_content(); ?>
				<?php edit_post_link( __( 'Edit', 'rumputhijau' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
			
		</div><!-- end #post-<?php the_ID(); ?> -->
		
	<?php comments_template( '', true ); ?>
		
	<?php endwhile; endif; ?>

<?php get_footer(); ?>
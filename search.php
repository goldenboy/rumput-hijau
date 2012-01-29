<?php
/**
 * The template for displaying search result
 *
 * @package WordPress
 * @subpackage Rumput_Hijau
 * @since Rumput Hijau 1.0.0
 */
 
get_header(); ?>

	<h1 class="archive-title"><?php printf( __( 'Search Results for: %s', 'rumputhijau' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

	<?php get_template_part('loop'); ?>

<?php get_footer(); ?>
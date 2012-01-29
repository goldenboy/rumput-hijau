<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Rumput_Hijau
 * @since Rumput Hijau 1.0.0
 */
 
get_header(); ?>
	
	<div id="post-0" class="post error404 not-found">
	
		<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'rumputhijau'); ?></h2>
		
		<div class="entry-content">
		
			<p><?php _e('It seems we cant find what you are looking for. Perhaps searching or one of the links below, can help.', 'rumputhijau'); ?></p>
			
			<?php get_search_form(); ?>
			
			<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>

			<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'rumputhijau' ); ?></h2>
			<ul>
				<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
			</ul>
		
		</div>
		
	</div><!-- end #post-0 -->

<?php get_footer(); ?>
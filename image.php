<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Rumput_Hijau
 * @since Rumput Hijau 1.0.0
 */
get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

			<h1 class="entry-title">
				<a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'rumputhijau' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php printf( __( '%s', 'rumputhijau' ), get_the_title( $post->post_parent ) ); ?></a>
			</h1>

			<?php $attachments = array_values(get_children( array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') ));

			foreach ( $attachments as $k => $attachment )
			if ( $attachment->ID == $post->ID )
			break;
			$next_url = isset($attachments[$k+1]) ? get_permalink($attachments[$k+1]->ID) : get_permalink($attachments[0]->ID);
			?>

			<div class="attachment-page">
			
				<a href="<?php echo $next_url; ?>"><?php echo wp_get_attachment_image( $post->ID, 'full' ); ?></a>
				<p class="download-image"><a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php _e('Download Image &raquo;', 'rumputhijau'); ?></a></p>
				
			</div><!-- end .attachment-page -->
		
			<div class="attachment-navigation">

				<?php
				$post_parent = get_post($post->ID, ARRAY_A);
				$parent = $post_parent['post_parent'];
				$attachments = get_children("post_parent=$parent&post_type=attachment&post_mime_type=image&orderby=menu_order ASC, ID ASC");
				foreach($attachments as $id => $attachment) :
					echo wp_get_attachment_link($id, array(100,100), true);
				endforeach;
				?>

			</div><!-- end .attachment-navigation -->

		</div><!-- end #post-<?php the_ID(); ?> -->

	<?php endwhile; else: ?>
		<p><?php _e('Sorry, no attachments matched your criteria.', 'rumputhijau'); ?></p>
	<?php endif; ?>

<?php get_footer(); ?>
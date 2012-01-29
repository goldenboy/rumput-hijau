<?php 
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Rumput_Hijau
 * @since Rumput Hijau 1.0.0
 */
 
if (have_posts()) : while (have_posts()) : the_post(); ?>
		
	<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
		<div class="content-right">
		
			<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'rumputhijau' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			
			<div class="entry-content">
			
				<?php if(has_post_thumbnail()){ ?>
					<span class="entry-thumbnail">
						<a href="<?php the_permalink() ?>">
							<?php the_post_thumbnail('150px', array( 'class' => 'photo', 'alt' => get_the_title(), 'title' => get_the_title()));?>
						</a>
					</span>
				<?php } ?>
			
				<?php 
					if( is_home() && is_front_page() ): // full content only for home page
						the_content( __('Read the full article &raquo;', 'rumputhijau') ); 
					else :
						the_excerpt();
					endif; 
				?>
				
			</div>

			<?php wp_link_pages( array( 'before' => '<div class="post-pages"><span>' . __( 'Pages:', 'rumputhijau' ) . '</span>', 'after' => '</div>' ) ); ?>
			
			<div class="entry-meta">
			
				<?php 
					$tags_list = get_the_tag_list( '', ', ' );
					printf( __( '<span class="%1$s">Tagged: %2$s</span>', 'rumputhijau' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
				
					$categories_list = get_the_category_list(', ');
					printf( __( '<span class="%1$s category">Posted in: %2$s</span>', 'rumputhijau' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
					
					edit_post_link( __( 'Edit', 'rumputhijau' ), '<span class="edit-link">', '</span>' );
				?>
				
			</div>
		
		</div><!-- end .content-right -->
		
		<div class="content-left">
		
			<span class="published"><?php echo esc_attr( get_the_date() ) ?></span>

			<span class="author vcard">
				<?php printf( __( 'Posted by: <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>', 'rumputhijau'),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'rumputhijau' ), get_the_author() ) ),
					get_the_author()
				); ?>
			</span>
			
			<?php if ( comments_open() ) :
				comments_popup_link( __( 'Leave a comment', 'rumputhijau' ), __( '1 Comment', 'rumputhijau' ), __( '% Comments', 'rumputhijau' ) ); ?>
				<span class="meta-sep">-</span>
			<?php endif; ?>
			
			<?php printf( __( '<a href="%1$s" title="%2$s" rel="bookmark">Permalink</a>', 'rumputhijau'),
				esc_url( get_permalink() ),
				esc_attr( sprintf( __( 'Permalink to %s', 'rumputhijau' ), the_title_attribute( 'echo=0' ) ) )
			); ?>	
			
		</div><!-- end .content-left -->
		
	</div><!-- end #post-<?php the_ID(); ?> -->
	
		
<?php endwhile; else: ?>
	<h2 class="center"><?php _e('Not Found', 'rumputhijau'); ?></h2>
	<p class="center"><?php _e('Sorry, but you are looking for something that is not here.', 'rumputhijau'); ?></p>
<?php endif; ?>


<div class="paging">
	<?php if(function_exists('wp_pagenavi')) : wp_pagenavi(); else : ?>
		<div class="prev"><?php next_posts_link( __('&laquo; Previous Posts', 'rumputhijau') ); ?></div>
		<div class="next"><?php previous_posts_link( __('Next Posts &raquo;', 'rumputhijau') ); ?></div>
	<?php endif; ?>
</div><!-- end .paging -->
<?php
/**
 * The template for displaying Comments
 *
 * @package WordPress
 * @subpackage Rumput_Hijau
 * @since Rumput Hijau 1.0.0
 */
?>
<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'rumputhijau'); ?></p>
	<?php
		return;
	endif;
?>
<!-- You can start editing here. -->

<div class="comments-box">

	<?php if ( have_comments() ) : ?>
	
	<div class="comments-heading">
		<?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'rumputhijau' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' ); ?>
	</div>
	
	<div class="navigation clearfix">
		<div class="alignleft"><?php previous_comments_link( __( '&laquo; Older Comments', 'rumputhijau' ) ); ?></div>
		<div class="alignright"><?php next_comments_link( __( 'Newer Comments &raquo;', 'rumputhijau' ) ); ?></div>
	</div> 
	
	<ol class="commentlist">
		<?php wp_list_comments('avatar_size=48'); ?>
	</ol>
	
	<div class="navigation clearfix">
		<div class="alignleft"><?php previous_comments_link( __( '&laquo; Older Comments', 'rumputhijau' ) ); ?></div>
		<div class="alignright"><?php next_comments_link( __( 'Newer Comments &raquo;', 'rumputhijau' ) ); ?></div>
	</div> 

<?php else : ?>

<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->

<?php else : ?>

<!-- If comments are closed. -->
<?php endif; ?>

<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<?php endif; ?>

<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$fields =  array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . ( __('Name', 'rumputhijau') ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $req . ' /></p>',
			
			'email'  => '<p class="comment-form-email"><label for="email">' . ( __('Email', 'rumputhijau') ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $req . ' /></p>',
			
			'url'    => '<p class="comment-form-url"><label for="url">' . ( __('Website', 'rumputhijau') ) . '</label>' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);
		
$comment_field = '<p class="comment-form-comment"><label for="comment">' . __( 'Your Comment <span class="required">*</span>', 'rumputhijau' ) . '</label><textarea id="comment" name="comment" cols="45" rows="10" aria-required="true"></textarea></p>';
	
$args = array(
  'fields' => apply_filters( 'comment_form_default_fields', $fields ),
  'comment_field' => apply_filters( 'comment_form_field_comment', $comment_field ),
);
	
	comment_form($args); 

?>

</div> <!--end #comment-box-->
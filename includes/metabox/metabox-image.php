<?php
add_action( 'add_meta_boxes', 'rumputhijau_meta_box_add' );
function rumputhijau_meta_box_add()
{
	add_meta_box( 'rumputhijau-meta-box-image', __('Big Image URL', 'rumputhijau'), 'rumputhijau_meta_box_image_url', 'post', 'normal', 'high' );
}

function rumputhijau_meta_box_image_url( $post )
{
	$values = get_post_custom( $post->ID );
	$text = isset( $values['rumputhijau_meta_box_input_image'] ) ? esc_attr( $values['rumputhijau_meta_box_input_image'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
	<p>
		<label for="rumputhijau_meta_box_input_image"><?php _e('Big Image URL:', 'rumputhijau'); ?> </label>
		<input type="text" name="rumputhijau_meta_box_input_image" id="rumputhijau_meta_box_input_image" value="<?php echo $text; ?>" size="30" style="width:70%;" />
		<small style="display: block;"><?php _e('You can display big image before the content, insert your image url here.', 'rumputhijau'); ?></small>
	</p>
	<?php	
}


add_action( 'save_post', 'rumputhijau_meta_box_save' );
function rumputhijau_meta_box_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// Probably a good idea to make sure your data is set
	if( isset( $_POST['rumputhijau_meta_box_input_image'] ) )
		update_post_meta( $post_id, 'rumputhijau_meta_box_input_image', wp_kses( $_POST['rumputhijau_meta_box_input_image'], $allowed ) );
}
?>
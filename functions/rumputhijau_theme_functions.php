<?php
################################################################################
// Favicon Option
################################################################################
function rumputhijau_favicon() {
	$options = rumputhijau_get_theme_options();
	$favicon = isset($options['favicon'])? $options['favicon']: ''; 
	
	if ( $favicon != "" ): ?>
	<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
	<?php endif;
}
add_action('wp_head', 'rumputhijau_favicon');


################################################################################
// Font Stack Option
################################################################################
function rumputhijau_add_font_stack() {
	$options = rumputhijau_get_theme_options();
	$font_stack = $options['font_stack']; ?>

	<style type="text/css">
		body, 
		p, 
		select, 
		input, 
		textarea, 
		button {
			font-family: <?php 
				if ( 'Georgia' == $font_stack )
					echo 'Georgia, Palatino, "Palatino Linotype", Times, "Times New Roman", serif;'."\n";
				elseif ( 'Arial' == $font_stack )
					echo 'Arial, "Helvetica Neue", Helvetica, sans-serif;'."\n";
				elseif ( 'Verdana' == $font_stack )
					echo 'Verdana, Geneva, Tahoma, sans-serif;'."\n";
				elseif ( 'Helvetica Neue' == $font_stack )
					echo '"Helvetica Neue", Arial, Helvetica, sans-serif;'."\n";
				elseif ( 'Tahoma' == $font_stack )
					echo 'Tahoma, Geneva, Verdana;'."\n";
				elseif ( 'Times New Roman' == $font_stack )
					echo 'Times, "Times New Roman", Georgia, serif;'."\n";
				elseif ( 'Trebuchet MS' == $font_stack )
					echo '"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif;'."\n";
				?>
			}
	</style>

	<?php do_action( 'rumputhijau_add_font_stack', $font_stack );
}
add_action('wp_head', 'rumputhijau_add_font_stack');


################################################################################
// Layout option
################################################################################
function rumputhijau_layout_add_classes( $existing_classes ) {
	$options = rumputhijau_get_theme_options();
	$current_layout = $options['theme_layout'];

	if ( in_array( $current_layout, array( 'right-sidebar') ) )
		$classes = array( 'two-column' );
	else
		$classes = array( 'one-column' );

	if ( 'right-sidebar' == $current_layout )
		$classes[] = 'right-sidebar';
	else
		$classes[] = $current_layout;

	$classes = apply_filters( 'rumputhijau_layout_add_classes', $classes, $current_layout );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'rumputhijau_layout_add_classes' );


################################################################################
// Header script option
################################################################################
function rumputhijau_header_script() {
	$options = rumputhijau_get_theme_options();
	$headerScript = isset($options['header-script'])? $options['header-script']: '';
	
	echo stripslashes($headerScript)."\n";
}
add_action('wp_head', 'rumputhijau_header_script');


################################################################################
// Tracking code option
################################################################################
function rumputhijau_tracking() {
	$options = rumputhijau_get_theme_options();
	$footercode = isset($options['tracking-script'])? $options['tracking-script']: '';
	
	echo stripslashes($footercode)."\n";
}
add_action('wp_footer', 'rumputhijau_tracking');


################################################################################
// Fixing the Read More in the Excerpts
// This removes the annoying […] to a Read More link
################################################################################

function rumputhijau_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '&nbsp; <a href="'. get_permalink($post->ID) . '" title="Read more '.get_the_title($post->ID).'">Read more &raquo;</a>';
}
add_filter('excerpt_more', 'rumputhijau_excerpt_more');


################################################################################
// Remove gallery inline style
################################################################################

function rumputhijau_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'rumputhijau_remove_gallery_css' );


################################################################################
// Disabling Wp-Pagenavi Style
################################################################################

function my_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
}
add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
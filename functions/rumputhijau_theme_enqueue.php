<?php

################################################################################
// Enqueue Scripts
################################################################################

function init_scripts() {
	
	// register min jquery requirements for this theme, only!
	if( !is_admin()){
	
		wp_deregister_script( 'comment-reply' );
		wp_deregister_script('jquery');
		
		// Register Scripts
		wp_register_script( 'comment-reply', home_url() . '/wp-includes/js/comment-reply.js?ver=20090102' );

		wp_enqueue_script( 'comment-reply' );
		
	}
	
	// register conditional script (need jquery from above)
	if (!is_admin()) add_action( 'wp_print_scripts', 'custom_print_javascript' );
	
	function custom_print_javascript( ) {
		wp_enqueue_script( 'jquery-plugins', get_template_directory_uri() . '/js/plugins.js', '', array( 'jquery' ), true ); // for plugins
		wp_enqueue_script( 'jquery-scripts', get_template_directory_uri() . '/js/script.js', '', array( 'jquery' ), true ); // for custom scripts

		if ( get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply',  home_url() . '/wp-includes/js/comment-reply.js?ver=20090102', 'jquery', '', true );
		}
	}
    
}
	
################################################################################
// Enqueue Styles
################################################################################

function init_styles() {
	
	// register css style requirements for this theme, only!
	if( !is_admin()){
		
		wp_deregister_style( 'wp-pagenavi' );
		
		// style
		//wp_register_style('droidsans',     'http://fonts.googleapis.com/css?family=Droid Sans&subset=latin');

		//wp_enqueue_style('droidsans');
		
	}
	
	
}    


################################################################################
// Footer
################################################################################

function footer_scripts() { ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/libs/jquery-1.7.1.min.js"><\/script>')</script>

<!--[if lt IE 7 ]>
	<script src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
	<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->

<?php
}
add_action('wp_footer', 'footer_scripts', 10);

if (!is_admin()){
	add_action('init', 'init_scripts', 100);
	add_action('init', 'init_styles', 100);
}
?>
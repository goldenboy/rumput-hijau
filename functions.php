<?php
if ( ! isset( $content_width ) )
	$content_width = 670;

################################################################################
// Extra Functions
################################################################################

require_once get_template_directory() . '/functions/rumputhijau_theme_enqueue.php'; // enqueue script & style
require_once get_template_directory() . '/functions/rumputhijau_theme_functions.php'; // theme functions
require_once get_template_directory() . '/functions/rumputhijau_theme_extensions.php'; // theme extensions
require_once get_template_directory() . '/options/rumputhijau_options.php'; // get theme options
// require_once get_template_directory() . '/includes/metabox/metabox-image.php'; // get custom meta box


################################################################################
// Add theme support
################################################################################

if ( function_exists( 'add_theme_support' ) ) {

	add_theme_support( 'post-thumbnails' );
	add_image_size( '150px' , 	 150,	 100,     true ); // 150px thumbnail
	
	add_theme_support( 'automatic-feed-links' );    // Add default posts and comments RSS feed links to head
	add_custom_background(); // Add custom background functions
	add_editor_style( 'extra-style/editor-style.css' );
	add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
	
}

################################################################################
// Configure WP2.9+ Navigation Menus
################################################################################

register_nav_menus( 
	array(
		'primary'    => __('Primary Menu', 'rumputhijau'),
) );

################################################################################
// Add theme sidebars
################################################################################

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name'          => __('General', 'rumputhiaju'),
		'description'   => __('This sidebar appears on the right side of your site', 'rumputhijau'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	));
}

################################################################################
// Add Custom Header Functions
################################################################################
define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', '%s/images/default_header.jpg'); // %s is the template dir uri
define('HEADER_IMAGE_WIDTH', 950); // use width and height appropriate for your theme
define('HEADER_IMAGE_HEIGHT', 200);
define('NO_HEADER_TEXT', true );

function rumputhijau_admin_header_style() { ?>
<style type="text/css">
#headimg {
	background:#fff url(<?php header_image() ?>) no-repeat center;  
	height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
}
</style>
<?php
}
add_custom_image_header('', 'rumputhijau_admin_header_style');


################################################################################
// Add custom meta box
################################################################################

?>
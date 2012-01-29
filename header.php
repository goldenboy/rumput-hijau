<?php
/**
 * The Header for the theme
 *
 * @package WordPress
 * @subpackage Rumput_Hijau
 * @since Rumput Hijau 1.0.0
 */
 $options = rumputhijau_get_theme_options();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width" />

<title><?php

	global $page, $paged;

	wp_title( '-', true, 'right' );

	bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'rumputhijau' ), max( $paged, $page ) );

	?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed">

	<div id="primary-nav" class="clearfix">
		
		<div class="inside-primary-nav">
		
			<?php 
			$pagesNav = '';
			if (function_exists('wp_nav_menu')) {
				$pagesNav = wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav sf-menu', 'echo' => false, 'fallback_cb' => '', 'container' => '' ) ); 
			};
				
			if ($pagesNav == '') { ?>
			
				<ul class="nav sf-menu">
					<?php if ( is_home() ) { ?>
						<li class="first"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="nofollow"><?php _e('Home', 'rumputhijau'); ?></a></li>
					<?php } else { ?>
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="nofollow"><?php _e('Home', 'rumputhijau'); ?></a></li>
					<?php } ?>
					<?php wp_list_pages('title_li='); ?>
				</ul>
				
			<?php }
				else 
					echo($pagesNav); 
			?>		

			<?php get_search_form(); ?><!-- get the search form, see searchform.php -->
			
		</div><!-- end .inside-primary-nav -->
	
	</div><!-- end #primary-nav -->

<div id="container">

	<div id="header">
		
		<div id="logo" class="clearfix">
		
			<?php $logo = isset($options['logo'])? $options['logo']: ''; ?>
			<?php if ($logo == ""){
			
			$hidetitle = $options['hide_title'];
			if ($hidetitle == "No") {
			
				// Do not show <h1> except on home page, SEO purpose
				if(!is_home() || !is_front_page()) { ?>
					<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a></span>
					<div class="site-description"><?php bloginfo('description'); ?></div>
				<?php } else { 
				// Only on home page display the <h1> tag, SEO purpose.
				?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a></h1>
					<div class="site-description"><?php bloginfo('description'); ?></div>
				<?php }
			}
			
			} else {
				if (is_home() || is_front_page()) { ?>
					<h1 class="logo-image"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" /><span><?php bloginfo('name'); ?></span></a></h1>
				<?php } else {  ?>
					<div class="logo-image"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" /><span><?php bloginfo('name'); ?></span></a></div>
			<?php } } ?>
			
		</div><!-- end #logo -->
		
		<?php 
			// Display the custom header
			$header_image = get_header_image(); 
			if($header_image != '') :
		?>
		
			<div class="header-img">
			
				<img src="<?php echo $header_image; ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo('name'); ?>" />
				
			</div><!-- .header-img -->
			
		<?php endif; ?>
		
	</div><!-- end #header -->
	
	<!-- If you installed wordpress seo or yoast breadcrumbs plugin, this function will automatically
		 display the yoast breadcrumbs, but if you're not. The custom breadcrumbs will change it -->
	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>');
	} else {
		echo rumputhijau_breadcrumbs(); 
	} ?>
	
	<?php $idsection  = (is_page_template('page-fullwidth.php'))? 'full-content':'main-content'; ?>
	<div id="<?php echo $idsection; ?>">
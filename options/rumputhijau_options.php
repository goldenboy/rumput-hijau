<?php
/**
 * Rumput_Hijau Theme Options
 *
 * @package WordPress
 * @subpackage Rumput_Hijau
 * @since Rumput Hijau 1.0.0
 */
 
/* =============================================================================
Enqueue Script & Style
============================================================================== */
function rumputhijau_admin_enqueue_script( $hook_suffix ) {
	/* Enqueue Style */
	wp_enqueue_style( 'rumputhijau-options-style', get_template_directory_uri() . '/options/style/admin.css', false, '1.0.0');
	wp_enqueue_style( 'rumputhijau-jqueryui-tabs-style', get_template_directory_uri() . '/options/style/jquery.ui.tabs.css', false, '1.8.16');
	wp_enqueue_style('thickbox');
	
	/* Register Script */
	wp_register_script('rumputhijau_my-upload', get_template_directory_uri().'/options/js/theme-options.js', array('jquery','media-upload','thickbox'));
	
	/* Enqueue Script */
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('rumputhijau_my-upload');
	wp_enqueue_script('jquery-ui-tabs');

}
add_action( 'admin_print_styles-appearance_page_theme_options', 'rumputhijau_admin_enqueue_script' );

function rumputhijau_theme_options_init() {

	if ( false === rumputhijau_get_theme_options() )
		add_option( 'rumputhijau_theme_options', rumputhijau_get_default_theme_options() );

	register_setting(
		'rumputhijau_options',
		'rumputhijau_theme_options',
		'rumputhijau_theme_options_validate'
	);
}
add_action( 'admin_init', 'rumputhijau_theme_options_init' );

function rumputhijau_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_rumputhijau_options', 'rumputhijau_option_page_capability' );

function rumputhijau_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Rumput Hijau Theme Options', 'rumputhijau' ),
		__( 'Rumput Hijau Theme Options', 'rumputhijau' ),
		'edit_theme_options',
		'theme_options',
		'rumputhijau_theme_options_render_page'
	);
}
add_action( 'admin_menu', 'rumputhijau_theme_options_add_page' );

/* =============================================================================
Returns an array of select options registered for Rumput Hijau
============================================================================== */
function rumputhijau_select() {
	$select_option = array(
		'Yes' => array(
			'value' => 'Yes',
			'label' => __( 'Yes', 'rumputhijau' ),
		),
		'No' => array(
			'value' => 'No',
			'label' => __( 'No', 'rumputhijau' ),
		),
	);
	
	return apply_filters( 'rumputhijau_select', $select_option );
}

/* =============================================================================
Returns an array of layout options registered for Rumput Hijau
============================================================================== */
function rumputhijau_layouts() {
	$layout_options = array(
		'right-sidebar' => array(
			'value' => 'right-sidebar',
			'label' => __('Content on left', 'rumputhijau'),
			'thumbnail' => get_template_directory_uri() . '/options/images/content-sidebar.png',
		),
		'one-column' => array(
			'value' => 'one-column',
			'label' => __('One-column - no sidebar', 'rumputhijau'),
			'thumbnail' => get_template_directory_uri() . '/options/images/content.png',
		),
	);

	return apply_filters( 'rumputhijau_layouts', $layout_options );
}

/* =============================================================================
Returns an array of font options registered for Rumput Hijau
============================================================================== */
function rumputhijau_font_stack() {
	$font_stack_options = array(
		'Arial' => array(
			'value' => 'Arial',
			'label' => 'Arial',
		),
		'Georgia' => array(
			'value' => 'Georgia',
			'label' => 'Georgia',
		),
		'Verdana' => array(
			'value' => 'Verdana',
			'label' => 'Verdana',
		),
		'Helvetica Neue' => array(
			'value' => 'Helvetica Neue',
			'label' => 'Helvetica Neue',
		),
		'Tahoma' => array(
			'value' => 'Tahoma',
			'label' => 'Tahoma',
		),
		'Times New Roman' => array(
			'value' => 'Times New Roman',
			'label' => 'Times New Roman',
		),
		'Trebuchet MS' => array(
			'value' => 'Trebuchet MS',
			'label' => 'Trebuchet MS',
		),
	);

	return apply_filters( 'rumputhijau_font_stack', $font_stack_options );
}

/* =============================================================================
Returns the default options for Rumput_Hijau
============================================================================== */
function rumputhijau_get_default_theme_options() {
	$default_theme_options = array(
		'color_scheme' => 'Default',
		'secondary_navigation' => 'Yes',
		'hide_title' => 'No',
		'theme_layout' => 'right-sidebar',
		'font_stack' => 'Georgia',
	);

	return apply_filters( 'rumputhijau_default_theme_options', $default_theme_options );
}

/**
 * Returns the options array for Rumput Hijau
 *
 */
function rumputhijau_get_theme_options() {
	return get_option( 'rumputhijau_theme_options', rumputhijau_get_default_theme_options() );
}

function rumputhijau_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'rumputhijau' ), get_current_theme() ); ?></h2>
		<?php settings_errors(); ?>
			
		<form method="post" action="options.php" id="options">
			<?php
				settings_fields( 'rumputhijau_options' );
				$options = rumputhijau_get_theme_options();
				$default_options = rumputhijau_get_default_theme_options();
			?>
			
		<div id="theme-options">
			
			<ul>
				<li><a href="#options1"><?php _e('General Options', 'rumputhijau'); ?></a></li>
				<li><a href="#options2"><?php _e('Layout Options', 'rumputhijau'); ?></a></li>
				<li><a href="#options3"><?php _e('Ads Options', 'rumputhijau'); ?></a></li>
				<li><a href="#options4"><?php _e('Changelog', 'rumputhijau'); ?></a></li>
			</ul>
			
			<table id="options1" class="form-table">
			
			<!-- Custom Header -->
			<tr valign="top">
				<th scope="row"><?php _e('Upload Custom Header:', 'rumputhijau'); ?></th>
					<td><?php printf( __('If you want to upload your custom header. Please <a href="%1$s">Go to this page</a>', 'rumputhijau'), admin_url('themes.php?page=custom-header') ); ?></td>
			</tr>
			
			<!-- Custom Background -->
			<tr valign="top">
				<th scope="row"><?php _e('Custom Background:', 'rumputhijau'); ?></th>
					<td><?php printf( __('If you want to change the background color or want to upload your background image. Please <a href="%1$s">Go to this page</a>', 'rumputhijau'), admin_url('themes.php?page=custom-background') ); ?></td>
			</tr>
			
			<!-- Custom Menus -->
			<tr valign="top">
				<th scope="row"><?php _e('Custom Menus :', 'rumputhijau'); ?></th>
					<td><?php printf( __('Easily add, edit and delete your menus using custom menus. Please <a href="%1$s">Go to this page</a> to setup your menus', 'rumputhijau'), admin_url('nav-menus.php') ); ?></td>
			</tr>
			
			<!-- Logo -->
			<tr valign="top">
				<th scope="row"><?php _e('Upload Logo:', 'rumputhijau'); ?></th>
				<td>
					<?php $l = isset($options['logo'])? $options['logo']: ''; ?>
					<input id="rumputhijau_theme_options[logo]" class="regular-text logo" type="text" name="rumputhijau_theme_options[logo]" value="<?php esc_attr( $l ); ?>" />
					<input class="upload_image_button" type="button" value="Upload Logo" />
					<label for="logo">
					<?php 
					if($l == "") { 
					echo "<br /><em>" .__('Enter the URL or upload an image for the <strong>Logo</strong>', 'rumputhijau'). "</em>"; 
					} else {
					echo "<img style='clear:both;display:block;margin-top:10px;'";
					echo 'src="'.$l.'" />';
					} ?>
					</label>
				</td>
			</tr>
			
			<!-- Favicon -->
			<tr valign="top">
			<th scope="row"><label for="favicon"><?php _e('Upload Favicon :', 'rumputhijau'); ?></label></th>
			<td>
				<?php $fav = isset($options['favicon'])? $options['favicon']: ''; ?>
				<input id="rumputhijau_theme_options[favicon]" class="regular-text favicon" type="text" name="rumputhijau_theme_options[favicon]" value="<?php esc_attr( $fav ); ?>" />
				<input class="upload_favicon_button" type="button" value="Upload Favicon" />
				<label for="favicon">
					<?php
					if($fav == "") { 
					echo "<br /><em>" .__('Enter the URL or upload an image for the <strong>Favicon</strong>', 'rumputhijau'). "</em>"; 
					} else {
					echo "<img style='clear:both;display:block;margin-top:10px;'";
					echo 'src="'.$fav.'" />';
					} ?>
				</label>
			</td>
			</tr>
			
			<!-- Header Script -->
			<tr valign="top"><th scope="row"><?php _e('Header Script :', 'rumputhijau'); ?></th>
				<td>
					<?php $headscript = isset($options['header-script'])? $options['header-script']: ''; ?>
					<textarea id="rumputhijau_theme_options[header-script]" class="large-text" cols="50" rows="10" name="rumputhijau_theme_options[header-script]"><?php echo esc_textarea( $headscript ); ?></textarea>
					<label class="description" for="rumputhijau_theme_options[header-script]"><em><?php _e('If you need to add scripts to your header (like meta tag verification, perhaps), you should enter them in the box above. They will be added before &lt;/head&gt; tag', 'rumputhijau'); ?></em></label>
				</td>
			</tr>
			
			<!-- Tracking Code -->
			<tr valign="top"><th scope="row"><?php _e('Tracking Code :', 'rumputhijau'); ?></th>
				<td>
					<?php $tracking = isset($options['tracking-script'])? $options['tracking-script']: ''; ?>
					<textarea id="rumputhijau_theme_options[tracking-script]" class="large-text" cols="50" rows="10" name="rumputhijau_theme_options[tracking-script]"><?php echo esc_textarea( $tracking ); ?></textarea>
					<label class="description" for="rumputhijau_theme_options[tracking-script]"><em><?php _e('Put your tracking script here. Such as google analytic script, they will be added before &lt;/body&gt; tag', 'rumputhijau'); ?></em></label>
				</td>
			</tr>
			
			</table>
				
			<table id="options2" class="form-table">
				
				<!-- Font- Stack -->
				<tr valign="top"><th scope="row"><?php _e('Font Stack:', 'rumputhijau'); ?></th>
					<td>
					
					<select name="rumputhijau_theme_options[font_stack]">
					<?php
						foreach ( rumputhijau_font_stack() as $font ) {
					?>
					<option <?php selected ( $options['font_stack'], $font['value'] ); ?>><?php echo esc_attr( $font['value'] ); ?></option>
					<?php } ?>
					</select>
					<label class="font_stack" for="rumputhijau_theme_options[font_stack]"><em><?php _e('Default: Georgia', 'rumputhijau'); ?></em></label>
					</td>
				</tr>
					
				<!-- Theme layout -->
				<tr valign="top"><th scope="row"><?php _e('Theme Layout :', 'rumputhijau'); ?></th>
					<td>
					
					<?php
						foreach ( rumputhijau_layouts() as $layout ) {
					?>
					<span class="layouts">
					
						<input class="choose-layout" type="radio" name="rumputhijau_theme_options[theme_layout]" value="<?php echo esc_attr( $layout['value'] ); ?>" <?php checked( $options['theme_layout'], $layout['value'] ); ?> />
						<span>
							<img class="thumbnail-layout" src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" />
						</span>
						
					</span>
					<?php } ?>
					
					</td>
				</tr>
				
				
				
			</table>
			
			<table id="options3" class="form-table">
			
			<!-- Header Ad -->
			<tr valign="top"><th scope="row"><?php _e('468x60 Header Ad :', 'rumputhijau'); ?></th>
				<td>
					<?php $headerad = isset($options['header-ads'])? $options['header-ads']: ''; ?>
					<textarea id="rumputhijau_theme_options[header-ads]" class="large-text" cols="50" rows="10" name="rumputhijau_theme_options[header-ads]"><?php echo esc_textarea( $headerad ); ?></textarea>
					<label class="description" for="rumputhijau_theme_options[header-ads]"><em><?php _e('Put your ads code here. The ads will be added in header.', 'rumputhijau'); ?></em></label>
				</td>
			</tr>
			
			<!-- Single post ad -->
			<tr valign="top"><th scope="row"><?php _e('Single Post Ads <em>(below post title)</em> :', 'rumputhijau'); ?></th>
				<td>
					<?php $singletop = isset($options['single-ads-top'])? $options['single-ads-top']: ''; ?>
					<textarea id="rumputhijau_theme_options[single-ads-top]" class="large-text" cols="50" rows="10" name="rumputhijau_theme_options[single-ads-top]"><?php echo esc_textarea( $singletop ); ?></textarea>
					<label class="description" for="rumputhijau_theme_options[single-ads-top]"><em><?php _e('Put your ads code here. The ads will be added below post title in single post.', 'rumputhijau'); ?></em></label>
				</td>
			</tr>
			
			<!-- Single post ad -->
			<tr valign="top"><th scope="row"><?php _e('Single Post Ads <em>(below post content)</em> :', 'rumputhijau'); ?></th>
				<td>
					<?php $singlebottom = isset($options['single-ads-bottom'])? $options['single-ads-bottom']: ''; ?>
					<textarea id="rumputhijau_theme_options[single-ads-bottom]" class="large-text" cols="50" rows="10" name="rumputhijau_theme_options[single-ads-bottom]"><?php echo esc_textarea( $singlebottom ); ?></textarea>
					<label class="description" for="rumputhijau_theme_options[single-ads-bottom]"><em><?php _e('Put your ads code here. The ads will be added below post content in single post.', 'rumputhijau'); ?></em></label>
				</td>
			</tr>
			
			</table>
			
			<table id="options4" class="form-table">
				<tr valign="top">
					<td>
						<pre>
						<?php
							$log_file   = file(get_bloginfo('template_url').'/changelog.txt');
							$log        = implode($log_file);
							echo $log;
						?>
						</pre>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
			
			
			</div><!-- end #theme-options -->
		</form>
		
		<div id="admin_side">

			<div class="postbox-container">
				<div class="metabox-holder">	
					<div class="meta-box-sortables ui-sortable">
					
						<div id="rumputhijau-support" class="postbox">
							<h3 class="hndle"><span><?php _e('Support', 'rumputhijau'); ?></span></h3>
							<div class="inside">
								<p><?php _e('Need a support ? Send me an email to <a href="mailto:asksatrya@gmail.com">asksatrya@gmail.com</a>', 'rumputhijau'); ?></p>
							</div>
						</div>
						
						<div id="rumputhijau-links" class="postbox">
							<h3 class="hndle"><span><?php _e('Links', 'rumputhijau'); ?></span></h3>
							<div class="inside">
								<ul class="links">
									<li><a href="http://satrya.me" target="_blank"><?php _e('Rumput Hijau by Satrya', 'rumputhijau'); ?></a></li>
									<li><a href="https://github.com/satryabima/rumputhijau-Wordpress-Theme" target="_blank"><?php _e('Rumput Hijau on github', 'rumputhijau'); ?></a></li>
									<li><a href="http://twitter.com/satryaWp" target="_blank"><?php _e('Follow me @satryaWp', 'rumputhijau'); ?></a></li>
								</ul>
							</div>
						</div>
						
					</div>
				</div>
			</div>

		</div>
		
	</div>
	<?php
}

function rumputhijau_theme_options_validate( $input ) {
	$output = $defaults = rumputhijau_get_default_theme_options();
		
	if ( isset( $input['font_stack'] ) && array_key_exists( $input['font_stack'], rumputhijau_font_stack() ) )
		$output['font_stack'] = $input['font_stack'];
		
	$output['logo'] = esc_url($input['logo']);
	
	$output['favicon'] = esc_url($input['favicon']);
		
	if ( isset( $input['theme_layout'] ) && array_key_exists( $input['theme_layout'], rumputhijau_layouts() ) )
		$output['theme_layout'] = $input['theme_layout'];
		
	$output['header-script'] = stripslashes($input['header-script']);
	
	$output['tracking-script'] = stripslashes($input['tracking-script']);
	
	$output['header-ads'] = stripslashes($input['header-ads']);
	
	$output['single-ads-top'] = stripslashes($input['single-ads-top']);
	
	$output['single-ads-bottom'] = stripslashes($input['single-ads-bottom']);

	return apply_filters( 'rumputhijau_theme_options_validate', $output, $input, $defaults );
}
<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Rumput_Hijau
 * @since Rumput Hijau 1.0.0
 */
$options = rumputhijau_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'one-column' != $current_layout ) :
?>

<div id="sidebar">

	<?php if ( !dynamic_sidebar( 'General' )): ?>

		<div id="archives" class="widget">
			<h3 class="widget-title">Archives</h3>
			<ul>
				<?php wp_get_archives( 'type=monthly' ); ?>
			</ul>
		</div>

	<?php endif; ?>
	
</div><!-- end #sidebar -->
<?php endif; ?>
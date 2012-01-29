<?php
/**
 * The template for displaying search form
 *
 * @package WordPress
 * @subpackage Rumput_Hijau
 * @since Rumput Hijau 1.0.0
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="field" name="s" id="s" value="Search in this site..." onfocus="if (this.value == 'Search in this site...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search in this site...';}" />
	<input class="search-button" type="image" src="<?php echo get_template_directory_uri(); ?>/images/search-button.png" value="Go" />
</form>
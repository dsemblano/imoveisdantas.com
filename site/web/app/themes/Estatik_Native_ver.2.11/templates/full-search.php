<?php
/**
 * Compact top search from template
 */

global $es_native_options;

if ( ! empty( $es_native_options->top_background_id ) ) {
	$top_background       = wp_get_attachment_image_src( $es_native_options->top_background_id, 'full-search-background'  );
	$top_background_image = $top_background[0];
} else {
	$top_background_image = ES_NATIVE_URL . 'assets/images/banner_image.jpg';
}

?>
<div class="search--full" style="background-image: url(<?php echo $top_background_image; ?>); background-size: cover;">
    <div  class="search--full-wrapper">
		<div class="search--full-container" ><?php dynamic_sidebar( 'top-banner-sidebar' ); ?></div>
	</div>
</div>


<style>.es-settings-field .wp-picker-container {display: inline-block;}</style>
<?php

/** @var $es_native_options Es_Native_Options_Container */

$avaliable_settings = Es_Native_Options_Container::get_available_settings();

$pages = get_pages();
$list_pages[] = __( '-- Select page --', 'es-native' );

if ( ! empty( $pages ) ) {
	foreach ( $pages as $page ) {
		$list_pages[ $page->ID ] = $page->post_title;
	}
} ?>
<div class="es-settings-field">
    <span class="es-settings-label"><?php _e( "Main Theme Color", "es-native" ); ?>:</span>
    <input type="text" name="es_native_options[theme_color]" class="js-colorpicker" value="<?php echo $es_native_options->theme_color?>"
           data-default-color="<?php echo $avaliable_settings['theme_color']['default_value'];?>"/>

</div>
<div class="es-settings-field">
    <label><span class="es-settings-label"><?php _e( 'Logo', 'es-native' ); ?>:</span></label>
    <div class="es-image-uploader">
		<?php if ( empty( $es_native_options->logo_attachment_id ) || ( $es_native_options->logo_attachment_id && ! wp_get_attachment_image( $es_native_options->logo_attachment_id ) ) ) : ?>
            <a class='es-image-add button' href='#'>
				<?php _e( 'Select image', 'es-native' ); ?>
            </a>
		<?php else: ?>
            <div class="image_preview">
                <a href='#' class='remove-image'><i class="fa fa-times-circle" aria-hidden="true"></i></a>
				<?php echo wp_get_attachment_image( $es_native_options->logo_attachment_id, 'thumbnail' ); ?>
            </div>
		<?php endif; ?>
        <input type="hidden"
               name="es_native_options[logo_attachment_id]" class="es-image-id"
               value="<?php echo $es_native_options->logo_attachment_id; ?>"/>
    </div>
</div>

<div class="es-settings-field">
    <label><span class="es-settings-label"><?php _e( 'Logo width', 'es-native' ); ?>:</span>
        <input type="text" value="<?php echo $es_native_options->logo_width; ?>" name="es_native_options[logo_width]">
    </label>
</div>

<div class="es-settings-field">
    <label><span class="es-settings-label"><?php _e( 'Logo Height', 'es-native' ); ?>:</span>
        <input type="text" value="<?php echo $es_native_options->logo_height; ?>" name="es_native_options[logo_height]">
    </label>
</div>

<div class="es-settings-field">
    <label><span class="es-settings-label"><?php _e( 'Favicon', 'es-native' ); ?>:</span></label>
    <div class="es-image-uploader favicon-upload">
		<?php if ( empty( $es_native_options->favicon_attachment_id ) ) : ?>
            <a class='es-image-add button' href='#'>
				<?php _e( 'Select image', 'es-native' ); ?>
            </a>
		<?php else: ?>
            <div class="image_preview">
                <a href='#' class='remove-image'><i class="fa fa-times-circle" aria-hidden="true"></i></a>
				<?php echo wp_get_attachment_image( $es_native_options->favicon_attachment_id, 'original' ); ?>
            </div>
		<?php endif; ?>
        <input type="hidden"
               name="es_native_options[favicon_attachment_id]" class="es-image-id"
               value="<?php echo $es_native_options->favicon_attachment_id; ?>"/>
    </div>
</div>
<div class="es-settings-field">
    <label><span class="es-settings-label"><?php _e( 'Is sticky header', 'es-native' ); ?>:</span>
        <input type="hidden" name="es_native_options[is_sticky]" value="0"/>
        <input type="checkbox" <?php checked( (bool)$es_native_options->is_sticky, true ); ?> name="es_native_options[is_sticky]" value="1" class="es-native-switch-input">
    </label>
</div>
<div class="es-settings-field">
    <label><span class="es-settings-label"><?php _e( 'Search block background image', 'es-native' ); ?>:</span></label>
    <div class="es-image-uploader">
		<?php if ( empty( $es_native_options->top_background_id ) || ! ( $image = wp_get_attachment_image( $es_native_options->top_background_id, 'thumbnail' ) ) ) : ?>
            <a class='es-image-add button' href='#'>
				<?php _e( 'Select image', 'es-native' ); ?>
            </a>
		<?php else: ?>
            <div class="image_preview">
                <a href='#' class='remove-image'><i class="fa fa-times-circle" aria-hidden="true"></i></a>
				<?php echo $image; ?>
            </div>
		<?php endif; ?>
        <input type="hidden"
               name="es_native_options[top_background_id]" class="es-image-id"
               value="<?php echo $es_native_options->top_background_id; ?>"/>
    </div>
</div>

<?php if ( $data = $es_native_options::get_setting_values( 'privacy_policy_checkbox' ) ) : $name = 'privacy_policy_checkbox'; $label = __( 'Privacy Policy Checkbox', 'es-native' ) ?>
	<?php include( 'fields/radio-list.php' ); ?>
<?php endif;

if ( $list_pages ) : $name = 'term_of_use_page_id'; $label =  __( 'Terms of Use page', 'es-native' ); $data = $list_pages; ?>
	<?php include( 'fields/dropdown.php' ); ?>
<?php endif;

if ( $list_pages ) : $name = 'privacy_policy_page_id'; $label =  __( 'Privacy Policy page', 'es-native' ); $data = $list_pages; ?>
	<?php include( 'fields/dropdown.php' ); ?>
<?php endif; ?>

<div class="es-settings-field">
    <label><span class="es-settings-label"><?php _e( "Custom CSS", "es-native" ); ?>:</span>
        <textarea name="es_native_options[option_css]"><?php echo stripcslashes( $es_native_options->option_css ); ?></textarea>
    </label>
</div>
<div class="es-settings-field">
    <label><span class="es-settings-label"><?php _e( 'News per page', 'es-native' ); ?>:</span>
        <input type="number" value="<?php echo $es_native_options->news_per_page; ?>" min="1" name="es_native_options[news_per_page]">
    </label>
</div>
<div class="es-settings-field">
    <label><span class="es-settings-label"><?php _e( 'Show breadcrumbs', 'es-native' ); ?>:</span>
        <input type="hidden" name="es_native_options[show_breadcrumbs]" value="0"/>
        <input type="checkbox" <?php checked( (bool)$es_native_options->show_breadcrumbs, true ); ?> name="es_native_options[show_breadcrumbs]" value="1" class="es-native-switch-input">
    </label>
</div>
<?php if ( $data = $es_native_options::get_setting_values( 'property_sidebar' ) ) : $name = 'property_sidebar'; $label = __( 'Single Property Layout', 'es-native' ) ?>
	<?php include( 'fields/radio-list.php' ); ?>
<?php endif; ?>
<div class="es-settings-field">
    <label><span class="es-settings-label"><?php _e( 'Copyright', "es-native" ); ?>:</span>
        <textarea name="es_native_options[copyright]"><?php echo stripslashes($es_native_options->copyright); ?></textarea>
    </label>
</div>


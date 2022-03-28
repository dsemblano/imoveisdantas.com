<?php

/**
 * Banners widget form.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Banners_Widget $this
 */

$banner_link =  !empty( $instance['banner_link'] ) ? $instance['banner_link'] : null;
$banner_title =  !empty( $instance['banner_title'] ) ? $instance['banner_title'] : null;
$banner_subtitle =  !empty( $instance['banner_subtitle'] ) ? $instance['banner_subtitle'] : null;
$banner_img_id =  !empty( $instance['banner_img_id'] ) ? $instance['banner_img_id'] : null;

?>
<div class="es-image-uploader">
	<?php if ( empty($banner_img_id) ) : ?>
		<a class='es-image-add button' href='#'>
			<?php _e( 'Select Image', 'es-native' ); ?>
		</a>
	<?php else:?>
		<div class="image_preview">
			<a href="#" class="remove-image"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
			<?php echo wp_get_attachment_image( $banner_img_id, 'thumbnail' ); ?>
		</div>
	<?php endif;?>
	<input type="hidden" id="<?php echo $this->get_field_id( 'attachment_id' ); ?>"
	       name="<?php echo $this->get_field_name('banner_img_id');?>" class="es-image-id"
	       value="<?php echo abs( $banner_img_id ); ?>"/>
</div>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'banner_link' ) ); ?>"><?php _e( 'Banner Link:', 'es-native' ); ?></label>
	<p><input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'banner_link' ) ); ?>" value="<?php echo $banner_link; ?>"/></p>
</p>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'banner_title' ) ); ?>"><?php _e( 'Banner Title:', 'es-native' ); ?></label>
	<p><input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'banner_title' ) ); ?>" value="<?php echo $banner_title; ?>"/></p>
</p>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'banner_subtitle' ) ); ?>"><?php _e( 'Banner Subtitle:', 'es-native' ); ?></label>
	<p><input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'banner_subtitle' ) ); ?>" value="<?php echo $banner_subtitle; ?>"/></p>
</p>
<div class="es-widget-wrap es-widget__wrap">
	<?php do_action( 'es_native_widget_' . $this->id_base . '_page_access_block', $instance ); ?>
</div>

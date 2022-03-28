<?php

/**
 * Hot Property widget form.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Hot_Property_Widget $this
 */

$title  = ! empty( $instance['title'] ) ? $instance['title'] : null;
$property  = ! empty( $instance['property'] ) ? $instance['property'] : null;

?>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Widget Title:', 'es-native' ); ?></label>
	<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo $title; ?>"/>
</p>
<?php if ( $properties = $this::get_properties() ) : ?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'property' ) ); ?>"><?php _e( 'Select property', 'es-native' ); ?>:</label>
		<select name="<?php echo esc_attr( $this->get_field_name( 'property' ) ); ?>" class="widefat">
			<?php foreach ( $properties as $id => $title ) : ?>
				<option <?php selected( $id, $property ); ?> value="<?php echo $id; ?>"><?php echo $title; ?></option>
			<?php endforeach; ?>
		</select>
	</p>
<?php endif; ?>
<div class="es-widget-wrap es-widget__wrap">
	<?php do_action( 'es_native_widget_' . $this->id_base . '_page_access_block', $instance ); ?>
</div>

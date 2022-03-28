<?php

/**
 * Latest News widget form.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Latest_News_Widget_Widget $this
 */

$title  = ! empty( $instance['title'] ) ? $instance['title'] : null;
$amount = ! empty( $instance['amount'] ) ? $instance['amount'] : 3;
$layout = ! empty( $instance['layout'] ) ? $instance['layout'] : 'short';
$show_button = ! empty( $instance['show_button'] ) ? $instance['show_button'] : 0;
$view_all_link = ! empty( $instance['view_all_link'] ) ? $instance['view_all_link'] : '';

?>
<p>
	<label
		for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Widget Title:', 'es-native' ); ?></label>
	<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
	       value="<?php echo $title; ?>"/>
</p>
<p>
	<label
		for="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>"><?php _e( 'Amount of News:', 'es-native' ); ?></label>
	<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'amount' ) ); ?>"
	       value="<?php echo $amount; ?>"/>
</p>
<?php if ( $layouts = $this::get_layouts() ) : ?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php _e( 'Layout', 'es-native' ); ?>:</label>
		<select name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" class="widefat">
			<?php foreach ( $layouts as $field ) : ?>
				<option <?php selected( $field, $layout ); ?> value="<?php echo $field; ?>"><?php echo $field; ?></option>
			<?php endforeach; ?>
		</select>
	</p>
<?php endif; ?>
<p>
	<label><?php _e( 'Show more button', 'es-native' ); ?>: </label>
	<label><?php _e( 'Yes', 'es-native' ); ?>
		<input type="radio" <?php checked( $show_button, 1 ); ?> class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'show_button' ) ); ?>" value="1"/>
	</label>
	<label><?php _e( 'No', 'es-native' ); ?>
		<input type="radio" <?php checked( $show_button, 0 ); ?> class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'show_button' ) ); ?>" value="0"/>
	</label>
</p>
<p>
	<label
		for="<?php echo esc_attr( $this->get_field_id( 'view_all_link' ) ); ?>"><?php _e( 'View all link:', 'es-native' ); ?></label>
	<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'view_all_link' ) ); ?>"
	       value="<?php echo $view_all_link; ?>"/>
</p>
<div class="es-widget-wrap es-widget__wrap">
	<?php do_action( 'es_native_widget_' . $this->id_base . '_page_access_block', $instance ); ?>
</div>

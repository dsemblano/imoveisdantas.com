<?php

/**
 * Properties list widget form.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Properties_Widget $this
 */

$title  = ! empty( $instance['title'] ) ? $instance['title'] : null;
$amount  = ! empty( $instance['amount'] ) ? $instance['amount'] : null;
$filter_data = ! empty( $instance['filter_data'] )  ? $instance['filter_data']    : array();


?>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Widget Title:', 'es-native' ); ?></label>
	<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo $title; ?>"/>
</p>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>"><?php _e( 'Amount of properties:', 'es-native' ); ?></label>
	<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'amount' ) ); ?>" value="<?php echo $amount; ?>"/>
</p>
<?php if ( $data = $this::get_filter_fields_data() ) : ?>
	<select data-placeholder="<?php _e( '-- Select parameters for filtering --', 'es-native' ); ?>"
	        style="width: 100%"
	        multiple class="js-select2-tags"
	        name="<?php echo esc_attr( $this->get_field_name( 'filter_data[]' ) ); ?>"
	        id="<?php echo esc_attr( $this->get_field_id( 'filter_data' ) ); ?>">

		<?php foreach ( $data as $group => $items ) : ?>
			<?php if ( empty( $items ) ) continue; ?>

			<optgroup label="<?php echo $group; ?>">
				<?php foreach ( $items as $value => $item ) : ?>
					<?php if ( $item instanceof WP_Term) : ?>
						<option <?php selected( in_array( $item->term_id , $filter_data ) ); ?> value="<?php echo $item->term_id; ?>"><?php echo $item->name; ?></option>
					<?php else : ?>
						<option <?php selected( in_array( $item->term_id , $filter_data ) ); ?> value="<?php echo $value; ?>"><?php echo $item; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</optgroup>

		<?php endforeach; ?>
	</select>
<?php endif; ?>
<div class="es-widget-wrap es-widget__wrap">
	<?php do_action( 'es_native_widget_' . $this->id_base . '_page_access_block', $instance ); ?>
</div>

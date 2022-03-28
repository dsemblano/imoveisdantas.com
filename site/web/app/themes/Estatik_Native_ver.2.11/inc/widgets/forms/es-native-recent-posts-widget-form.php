<?php

/**
 * Recent Posts widget form.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Recent_Posts_Widget $this
 */

$title  = ! empty( $instance['title'] ) ? $instance['title'] : null;
$amount = ! empty( $instance['amount'] ) ? $instance['amount'] : 3;
$category = ! empty( $instance['category'] ) ? $instance['category'] : null;
$categories = get_terms( array('taxonomy' => 'category'))
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
<p>
	<select data-placeholder="<?php _e( '-- Select category --', 'es-native' ); ?>"
	        style="width: 100%" class="js-select2-tags"
	        name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>"
	        id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">
				<?php foreach ( $categories as $value => $item ) : ?>
						<option <?php selected( $item->term_id , $category ); ?> value="<?php echo $item->term_id; ?>"><?php echo $item->name; ?></option>
				<?php endforeach; ?>
	</select>
</p>
<div class="es-widget-wrap es-widget__wrap">
	<?php do_action( 'es_native_widget_' . $this->id_base . '_page_access_block', $instance ); ?>
</div>

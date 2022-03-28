<?php

/**
 * Custom Menu widget form.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Nav_Menu_Widget $this
 */

global $wp_customize;
$title = isset( $instance['title'] ) ? $instance['title'] : '';
$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

// Get menus
$menus = wp_get_nav_menus();

// If no menus exists, direct the user to go and create some.
?>
<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
	<?php
	if ( $wp_customize instanceof WP_Customize_Manager ) {
		$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
	} else {
		$url = admin_url( 'nav-menus.php' );
	}
	?>
	<?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
</p>
<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'es-native' ) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:', 'es-native' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
			<option value="0"><?php _e( '&mdash; Select &mdash;', 'es-native' ); ?></option>
			<?php foreach ( $menus as $menu ) : ?>
				<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
					<?php echo esc_html( $menu->name ); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</p>
	<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
		<p class="edit-selected-nav-menu" style="<?php if ( ! $nav_menu ) { echo 'display: none;'; } ?>">
			<button type="button" class="button"><?php _e( 'Edit Menu', 'es-native' ) ?></button>
		</p>
	<?php endif; ?>
</div>
<div class="es-widget-wrap es-widget__wrap">
	<?php do_action( 'es_native_widget_' . $this->id_base . '_page_access_block', $instance ); ?>
</div>

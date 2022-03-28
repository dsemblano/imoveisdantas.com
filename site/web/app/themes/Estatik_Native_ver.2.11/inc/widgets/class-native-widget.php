<?php

/**
 * Class Es_Native_Widget
 */
abstract class Es_Native_Widget extends WP_Widget {
	/**
	 * Es_Widget constructor.
	 *
	 * @param string $id_base
	 * @param string $name
	 * @param array $widget_options
	 * @param array $control_options
	 */
	public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() ) {
		parent::__construct( $id_base, $name, array( 'classname' => 'widget_' . $id_base . ' es-native-widget' ),
			$control_options );
		add_action( 'es_native_widget_' . $id_base . '_page_access_block', array( $this, 'page_access_block' ), 10, 1 );
	}

	/**
	 * @inheritdoc
	 */
	public function widget( $args, $instance ) {
		if ( static::can_render( $instance ) && file_exists( $this->get_widget_template_path() ) ) {
			include( apply_filters( 'es_native_widget_template_path', $this->get_widget_template_path(), $this->id ) );
		}
	}

	/**
	 * @inheritdoc
	 */
	public function form( $instance ) {
		include( apply_filters( 'es_native_widget_form_template_path', $this->get_widget_form_template_path(),
			$this->id ) );
	}

	/**
	 * Return list of pages for page field.
	 *
	 * @return mixed|void
	 */
	public function get_pages() {
		$system_pages = array(
			'home_page'             => __( 'Home page with latest posts', 'es-native' ),
			'archive_page'          => __( 'Archive page', 'es-native' ),
			'single_page'           => __( 'Single Page', 'es-native' ),
			'single_property_page'  => __( 'Single Property Page', 'es-native' ),
			'archive_property_page' => __( 'Archive Property Page', 'es-native' ),
			'category_page'         => __( 'Category Page', 'es-native' ),
			'search_page'           => __( 'Search Page', 'es-native' ),
			'author_page'           => __( 'Author Page', 'es-native' ),
			'not_found'           => __( '404 Page', 'es-native' ),
		);

		$pages = get_pages();

		if ( ! empty( $pages ) ) {
			foreach ( $pages as $page ) {
				if ( ! empty( $page->post_title ) ) {
					$system_pages[ $page->ID ] = $page->post_title;
				}
			}
		}

		return apply_filters( 'es_native_get_widget_pages', $system_pages );
	}

	/**
	 * Render widget access pages block.
	 *
	 * @param $instance
	 */
	public function page_access_block( $instance ) {
		$pages_active = ! empty( $instance['pages'] ) ? $instance['pages'] : array();
		$display_type = ! empty( $instance['display_type'] ) ? $instance['display_type'] : null;

		if ( $display_types = static::get_display_types() ) : ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_type' ) ); ?>">
					<?php _e( 'Show on pages:', 'es-native' ); ?>
				</label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'display_type' ) ); ?>"
				        class="widefat js-show-search-pages">
					<?php
					foreach ( $display_types as $name => $field ):?>
						<option <?php selected( $name, $display_type ); ?>
							value="<?php echo $name; ?>"><?php echo $field; ?></option>
					<?php
					endforeach; ?>
				</select>
			</p>

			<?php if ( $pages = $this->get_pages() ) : ?>
				<div class="js-search-pages">
					<p><label><?php _e( 'Select pages', 'es-native' ); ?>:</label></p>
					<div class="es-checkbox-list">
						<?php
						foreach ( $pages as $id => $page ):?>
							<p>
								<label>
									<input <?php in_array( $id, $pages_active ) ? checked( true ) : null; ?>
										type="checkbox"
										name="<?php echo esc_attr( $this->get_field_name( 'pages[]' ) ); ?>"
										class="widefat" value="<?php echo $id; ?>"/>
									<?php echo $page; ?>
								</label>
							</p>
						<?php
						endforeach; ?>
					</div>
				</div>
			<?php endif;
		endif;
	}

	/**
	 * Return values for display type field.
	 *
	 * @return array
	 */
	public static function get_display_types() {
		return apply_filters( 'es_native_get_search_display_types', array(
			'all'          => __( 'All pages', 'es-native' ),
			'show_checked' => __( 'Show on checked pages', 'es-native' ),
			'hide_checked' => __( 'Hide on checked pages', 'es-native' ),
		) );
	}

	/**
	 * Check is widget can render. Check widget render pages.
	 *
	 * @param $instance
	 *
	 * @return bool
	 */
	public static function can_render( $instance ) {
		if ( $instance['display_type'] == 'all' ) {
			return true;
		} elseif ( $instance['display_type'] == 'show_checked' ) {
			$switcher = true;
		} elseif ( $instance['display_type'] == 'hide_checked' ) {
			$switcher = false;
		}

		if ( isset( $switcher ) && ! empty( $instance['pages'] ) ) {
			global $post_type;

			if ( class_exists( 'Es_Property' ) ) {
				if ( is_single() && $post_type == Es_Property::get_post_type_name() &&
				     in_array( 'single_property_page', $instance['pages'] )
				) {
					return $switcher;
				}

				if ( is_archive() && is_post_type_archive( Es_Property::get_post_type_name() ) &&
				     in_array( 'archive_property_page', $instance['pages'] )
				) {
					return $switcher;
				}
			}


			if ( is_archive() && in_array( 'archive_page', $instance['pages'] ) ) {
				return $switcher;
			}
			if ( is_single() && in_array( 'single_page', $instance['pages'] ) ) {
				return $switcher;
			}
			if ( is_search() && in_array( 'search_page', $instance['pages'] ) ) {
				return $switcher;
			}
			if ( is_category() && in_array( 'category_page', $instance['pages'] ) ) {
				return $switcher;
			}

			if ( is_front_page() && in_array( 'home_page', $instance['pages'] ) ) {
				return $switcher;
			}

			if ( is_404() && in_array( 'not_found', $instance['pages'] ) ) {
				return $switcher;
			}

			foreach ( $instance['pages'] as $page ) {
				if ( ! is_numeric( $page ) ) {
					continue;
				}

				if ( is_page( $page ) ) {
					return $switcher;
				}
			}

			return ! $switcher;
		}

		return true;
	}

	/**
	 * @return string
	 */
	abstract protected function get_widget_template_path();

	/**
	 * @return string
	 */
	abstract protected function get_widget_form_template_path();
}

<?php

/**
 * Class Es_Native_Banners_Widget
 */
class Es_Native_Banners_Widget extends Es_Native_Widget
{
	/**
	 * @inheritdoc
	 */
	public function __construct()
	{
		parent::__construct( 'es_native_banners_widget' , __( 'Native Banners', 'es-native' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_setup' ) );
	}


	/**
	 * @inheritdoc
	 */
	protected function get_widget_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'templates/es-native-banners-widget.php';
	}

	/**
	 * @return string
	 */
	protected function get_widget_form_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'forms/es-native-banners-widget-form.php';
	}

	/**
	 * Enqueue the javascript to admin panel.
	 */
	public function admin_setup() {

		// Only load on widget admin page and in the "Customizer" view.
		$screen      = get_current_screen();
		$should_load = 'customize' == $screen->base || 'widgets' == $screen->base;

		if ( ! $should_load ) {
			return;
		}

		wp_enqueue_media();

		wp_enqueue_script( 'es-native-admin-media', ES_NATIVE_ADMIN_CUSTOM_SCRIPTS_URL . 'media.js', array( 'jquery', 'media-upload', 'media-views' ));

		wp_localize_script( 'es-native-admin-media', 'NativeMedia', array(
			'frame_title' => __( 'Select Image', 'es-native' ),
			'button_title' => __( 'Insert Image', 'es-native' ),
			'remove_title' => __( 'Remove Image', 'es-native' ),
		) );
	}

	/**
	 * Updates a particular instance of a widget.
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		if ( !empty($new_instance['banner_link']) ) {
			if ( strpos( $new_instance['banner_link'], 'http' ) === false ){
				$new_instance['banner_link'] = 'http://' . $new_instance['banner_link'];
			}
		}

		return $new_instance;
	}
}


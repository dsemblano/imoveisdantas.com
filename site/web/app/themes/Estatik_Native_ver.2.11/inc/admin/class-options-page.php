<?php

/**
 * Class Native_Options_Page
 */
class Native_Options_Page {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Add options page.
		add_action('admin_menu', array( $this, 'add_options_page'));

		// Register scripts, styles, and fonts.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_styles' ) );
	}

	/**
	 * Add theme options page.
	 */
	public function add_options_page() {
		add_theme_page( __( 'Theme Native', 'es-native' ), __( 'Theme Native', "es-native" ),
			'edit_theme_options', 'es_theme_options', array( $this, 'render_page' ) );
	}

	/**
	 * Render settings page content.
	 *
	 * @return void
	 */
	public function render_page() {
		$template = apply_filters( 'es_native_options_template_path', ES_NATIVE_ADMIN_TEMPLATES . 'options.php' );
		 require_once( $template );
	}

	/**
	 * Return tabs of the settings page.
	 *
	 * @return array
	 */
	public static function get_tabs() {
		return apply_filters( 'es_native_options_get_tabs', array(
			'general'  => array(
				'label'    => __( 'General', 'es-native' ),
				'template' => ES_NATIVE_ADMIN_TEMPLATES . 'general-tab.php'
			),
			'social-sharing'  => array(
				'label'    => __( 'Social Sharing', 'es-native' ),
				'template' => ES_NATIVE_ADMIN_TEMPLATES . 'social-sharing.php'
			),
			'contact'  => array(
				'label'    => __( 'Contact Info', 'es-native' ),
				'template' => ES_NATIVE_ADMIN_TEMPLATES . 'contact.php'
			),
			'404'  => array(
				'label'    => __( '404 Page', 'es-native' ),
				'template' => ES_NATIVE_ADMIN_TEMPLATES . '404.php'
			)
		) );
	}

	/**
	 * Save settings action.
	 *
	 * @return void
	 */
	public static function save() {
		if ( isset( $_POST['es_native_save_options'] ) && wp_verify_nonce( $_POST['es_native_save_options'],
				'es_native_save_options' )
		) {
			/** @var Es_Settings_Container $es_settings */
			global $es_native_options;


			// Filtering and preparing data for save.
			$data = apply_filters( 'es_before_save_options_data', $_POST['es_native_options'] );

			// Before save action.
			do_action( 'es_before_save_options_data', $data );

			$es_native_options->save( $data );

			// After save action.
			do_action( 'es_after_save_options_data', $data );
		}
	}


	/**
	 * Enqueue admin scripts.
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts()
	{
		$screen = get_current_screen();
		$should_load = 'appearance_page_es_theme_options' == $screen->base;

		if ( ! $should_load ) {
			return;
		}

		wp_enqueue_media();
		wp_enqueue_script( 'wp-color-picker' );

		wp_register_script( 'es-native-admin-script', ES_NATIVE_ADMIN_CUSTOM_SCRIPTS_URL . 'admin.js', array (
			'jquery', 'jquery-ui-tabs', 'wp-color-picker' ) );

		wp_enqueue_script( 'es-native-admin-script' );

		wp_register_script( 'es-checkbox-script', ES_NATIVE_ADMIN_CUSTOM_SCRIPTS_URL . 'es-checkboxes.js', array ( 'jquery' ) );
		wp_enqueue_script( 'es-checkbox-script' );

		wp_localize_script( 'es-native-admin-script', 'Es_Native', static::register_js_variables() );

		wp_enqueue_script( 'es-native-admin-media', ES_NATIVE_ADMIN_CUSTOM_SCRIPTS_URL . 'media.js', array( 'jquery', 'media-upload', 'media-views' ));

		wp_localize_script( 'es-native-admin-media', 'NativeMedia', array(
			'frame_title' => __( 'Select Image', 'es-native' ),
			'button_title' => __( 'Insert Image', 'es-native' ),
			'remove_title' => __( 'Remove Image', 'es-native' ),
		) );
	}

	/**
	 * Enqueue admin styles.
	 *
	 * @return void
	 */
	public function admin_enqueue_styles()
	{

		wp_enqueue_style( 'wp-color-picker' );

		wp_register_style( 'jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' );

		wp_enqueue_style( 'es-native-awesome', ES_NATIVE_FONTS_URL . 'font-awesome/css/font-awesome.min.css');

		wp_register_style( 'es-native-admin-style', ES_NATIVE_ADMIN_CUSTOM_STYLES_URL. 'admin-style.css' );
		wp_enqueue_style( 'es-native-admin-style' );

		wp_register_style( 'es-checkboxes-style', ES_NATIVE_ADMIN_CUSTOM_STYLES_URL . 'es-checkboxes.css' );
		wp_enqueue_style( 'es-checkboxes-style' );

		wp_register_style(
			'es-google-open-sans-form',
			'https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet'
		);

		wp_enqueue_style( 'es-google-open-sans-form' );
	}

	/**
	 * Register global javascript variables.
	 *
	 * @return array
	 */
	public static function register_js_variables()
	{

		return apply_filters( 'es_native_admin_global_js_variables', array(
			'tr' => array(
				'yes' => __( 'Yes', 'es-native' ),
				'no' => __( 'No', 'es-native' ),
			)
		) );
	}

}

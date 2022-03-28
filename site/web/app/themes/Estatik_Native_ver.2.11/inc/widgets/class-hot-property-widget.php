<?php

/**
 * Class Es_Native_Hot_Property_Widget
 */
class Es_Native_Hot_Property_Widget extends Es_Native_Widget
{
	/**
	 * @inheritdoc
	 */
	public function __construct()
	{
		parent::__construct( 'es_native_hot_property_widget' , __( 'Native Hot Property', 'es-native' ) );
	}


	/**
	 * @inheritdoc
	 */
	protected function get_widget_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'templates/es-native-hot-property-widget.php';
	}

	/**
	 * @return string
	 */
	protected function get_widget_form_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'forms/es-native-hot-property-widget-form.php';
	}

	/**
	 * Return list of pages.
	 *
	 * @return array
	 */
	public static function get_properties() {

		$block_properies = array();
		global $wpdb;
		$results = $wpdb->get_results( "SELECT post_title, ID FROM {$wpdb->posts} WHERE post_type = 'properties' ORDER BY post_title ASC" );

		if ( $results ) {
			foreach ( $results as $property ) {
				if ( ! empty ( $property->post_title ) )
					$block_properies[$property->ID] = $property->post_title;
			}
		}

		return apply_filters('es_native_get_properties_widget', $block_properies);
	}
}


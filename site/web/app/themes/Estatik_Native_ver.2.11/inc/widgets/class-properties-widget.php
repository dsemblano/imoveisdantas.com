<?php

/**
 * Class Es_Native_Properties_Widget
 */
class Es_Native_Properties_Widget extends Es_Native_Widget
{
	/**
	 * @inheritdoc
	 */
	public function __construct()
	{
		parent::__construct( 'es_native_properties_widget' , __( 'Native Properties List', 'es-native' ) );
	}


	/**
	 * @inheritdoc
	 */
	protected function get_widget_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'templates/es-properties-widget.php';
	}

	/**
	 * @return string
	 */
	protected function get_widget_form_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'forms/es-properties-widget-form.php';
	}

	/**
	 * @return array
	 */
	public static function get_filter_fields_data()
	{
		/** @var Es_Settings_Container $es_settings */
		global $es_settings;

		$data = array();

		$taxonomies = $es_settings::get_setting_values( 'taxonomies' );

		if ( ! empty( $taxonomies ) ) {
			foreach ( $taxonomies as $name => $taxonomy ) {
				if ( taxonomy_exists( $name ) ) {
					$taxonomy = get_taxonomy( $name );

					$data[ $taxonomy->label ] = get_terms( array( 'taxonomy' => $taxonomy->name, 'hide_empty' => false ) );
				}
			}
		}

		return apply_filters( 'es_get_property_map_filter_fields_data', $data );
	}

	/**
	 * @param array $instance
	 *
	 * @return WP_Query
	 */
	public function prop_loop( $instance = array() ) {
		// Get property class.
		$property = es_get_property( null );
		$query_args = array(
			'post_type'           => $property::get_post_type_name(),
			'post_status'         => 'publish',
			'posts_per_page'      => !empty( $instance['amount'] ) ? $instance['amount'] : 6,
			'orderby' => 'date',
			'order' => 'DESC',
		);

		if ( ! empty( $instance['filter_data'] ) ) {
			foreach ( $instance['filter_data'] as $tid ) {
				$term = get_term( $tid );
				if ( $term && strlen( $term->taxonomy ) > 3 ) {
					$data_filter[ substr( $term->taxonomy, 3 ) ][] = $term->term_id;
				}
			}

			if ( is_array( $data_filter ) && ! empty( $data_filter ) ) {
				foreach ( $data_filter as $taxonomy => $ids ) {
					$tax_name = apply_filters( 'es_taxonomy_shortcode_name', 'es_' . $taxonomy );
					if ( taxonomy_exists( $tax_name ) ) {
						if ( ! empty( $ids ) ) {
							if ( $tax_name == 'es_labels' ) {

								if ( $ids ) {
									foreach ( $ids as $id ) {
										$term = get_term_by( 'id', $id, $tax_name );
										$query_args['meta_query'][] = array( 'compare' => '=', 'key' => 'es_property_' . $term->slug, 'value' => 1 );
									}
								}
							} else {
								$query_args['tax_query'][] = array( 'taxonomy' => $tax_name, 'field' => 'id', 'terms' => $ids );
							}
						}
					}
				}
			}

		}

		$properties_query = new WP_Query( $query_args );
		return $properties_query;
	}
}


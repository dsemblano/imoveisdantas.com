<?php

/**
 * Class Es_Native_Page_Teaser_Widget
 */
class Es_Native_Page_Teaser_Widget extends Es_Native_Widget
{
	/**
	 * @inheritdoc
	 */
	public function __construct()
	{
		parent::__construct( 'es_native_page_teaser_widget' , __( 'Native Page Teaser', 'es-native' ) );
	}


	/**
	 * @inheritdoc
	 */
	protected function get_widget_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'templates/es-native-page-teaser-widget.php';
	}

	/**
	 * @return string
	 */
	protected function get_widget_form_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'forms/es-native-page-teaser-widget-form.php';
	}

	/**
	 * Return list of pages.
	 *
	 * @return array
	 */
	public static function get_block_pages() {
		$args = array(
			'post_type' => 'page',
			'ordeby' => 'title',
			'order' => 'ASC',
			'posts_per_page' => -1
		);

		$pages = get_posts( $args );

		foreach ( $pages as $page ) {
			if ( ! empty ( $page->post_title ) )
				$block_pages[$page->ID] = $page->post_title;
		}

		return apply_filters('es_native_get_pages_widget', $block_pages);
	}
}


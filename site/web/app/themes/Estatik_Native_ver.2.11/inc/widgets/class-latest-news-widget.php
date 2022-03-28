<?php

/**
 * Class Es_Native_Latest_News_Widget
 */
class Es_Native_Latest_News_Widget extends Es_Native_Widget
{
	/**
	 * @inheritdoc
	 */
	public function __construct()
	{
		parent::__construct( 'es_native_latest_news_widget' , __( 'Native Latest News', 'es-native' ) );
	}


	/**
	 * @inheritdoc
	 */
	protected function get_widget_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'templates/es-native-latest-news-widget.php';
	}

	/**
	 * @return string
	 */
	protected function get_widget_form_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'forms/es-native-latest-news-widget-form.php';
	}

	/**
	 * Return layouts of this widget.
	 *
	 * @return array
	 */
	public static function get_layouts()
	{
		return apply_filters( 'es_native_news_widget_layouts', array( 'short', 'long' ) );
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
		if ( !empty($new_instance['view_all_link']) ) {
			if ( strpos( $new_instance['view_all_link'], 'http' ) === false ){
				$new_instance['view_all_link'] = 'http://' . $new_instance['view_all_link'];
			}
		}

		return $new_instance;
	}
}


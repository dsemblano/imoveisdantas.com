<?php

/**
 * Class Es_Native_Recent_Posts_Widget
 */
class Es_Native_Recent_Posts_Widget extends Es_Native_Widget
{
	/**
	 * @inheritdoc
	 */
	public function __construct()
	{
		parent::__construct( 'es_native_recent_posts_widget' , __( 'Native Recent Posts', 'es-native' ) );
	}


	/**
	 * @inheritdoc
	 */
	protected function get_widget_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'templates/es-native-recent-posts-widget.php';
	}

	/**
	 * @return string
	 */
	protected function get_widget_form_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'forms/es-native-recent-posts-widget-form.php';
	}

}


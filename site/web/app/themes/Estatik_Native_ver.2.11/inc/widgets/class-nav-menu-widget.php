<?php

/**
 * Class Es_Native_Nav_Menu_Widget
 */
class Es_Native_Nav_Menu_Widget extends Es_Native_Widget
{
	/**
	 * @inheritdoc
	 */
	public function __construct()
	{
		parent::__construct( 'es_native_menu_widget' , __( 'Native Custom Menu', 'es-native' ) );
	}

	/**
	 * @inheritdoc
	 */
	protected function get_widget_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'templates/es-nav-menu-widget.php';
	}

	/**
	 * @return string
	 */
	protected function get_widget_form_template_path()
	{
		return ES_NATIVE_WIDGETS_DIR . 'forms/es-nav-menu-widget-form.php';
	}

}


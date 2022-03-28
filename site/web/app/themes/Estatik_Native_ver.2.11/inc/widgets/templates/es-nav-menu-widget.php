<?php

/**
 * Custom Menu widget.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Nav_Menu_Widget $this
 */

echo $args['before_widget'];

// Get menu
$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

if ( !$nav_menu )
	return;

/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );


if ( !empty($instance['title']) )
	echo $args['before_title'] . $instance['title'] . $args['after_title'];

$nav_menu_args = array(
	'fallback_cb' => '',
	'menu'        => $nav_menu
);

wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

echo $args['after_widget'];

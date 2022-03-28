<?php

/**
 * Estatik Native Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Estatik_Theme_Native
 * @since Estatik Theme Native 1.0
 */

define( 'ES_NATIVE_DIR',  trailingslashit( get_template_directory()));
define( 'ES_NATIVE_URL',  trailingslashit( get_template_directory_uri()));
define( 'ES_NATIVE_INC_DIR',  ES_NATIVE_DIR  .trailingslashit( 'inc' ) );
define( 'ES_NATIVE_WIDGETS_DIR',  ES_NATIVE_INC_DIR  .trailingslashit( 'widgets' ) );
define( 'ES_NATIVE_TEMPLATES_DIR',  ES_NATIVE_DIR  .trailingslashit( 'templates' ) );
define( 'ES_NATIVE_CUSTOM_STYLES_URL',  ES_NATIVE_URL  . trailingslashit( 'assets/css') );
define( 'ES_NATIVE_CUSTOM_STYLES_DIR',  ES_NATIVE_DIR  . trailingslashit( 'assets/css') );
define( 'ES_NATIVE_CUSTOM_SCRIPTS_URL', ES_NATIVE_URL  . trailingslashit('assets/js/custom' ) );
define( 'ES_NATIVE_VENDOR_SCRIPTS_URL', ES_NATIVE_URL  . trailingslashit('assets/js/vendor' ) );
define( 'ES_NATIVE_ADMIN_DIR',  ES_NATIVE_DIR  .trailingslashit( 'inc/admin' ) );
define( 'ES_NATIVE_ADMIN_IMAGES_URL',  ES_NATIVE_URL  . trailingslashit( 'inc/admin/assets/images') );
define( 'ES_NATIVE_ADMIN_CUSTOM_STYLES_URL',  ES_NATIVE_URL  . trailingslashit( 'inc/admin/assets/css/custom') );
define( 'ES_NATIVE_ADMIN_CUSTOM_SCRIPTS_URL', ES_NATIVE_URL  . trailingslashit('inc/admin/assets/js/custom' ) );
define( 'ES_NATIVE_ADMIN_TEMPLATES',          ES_NATIVE_DIR . trailingslashit('inc/admin/templates' ) );
define( 'ES_NATIVE_FONTS_URL',          ES_NATIVE_URL . trailingslashit('assets/fonts' ) );

require 'plugin-update-checker/plugin-update-checker.php';

$MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://estatik.net/wp-update-server/?action=get_metadata&slug=est-native', //Metadata URL.
	__FILE__,
	'est-native'
);

if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

require_once (ES_NATIVE_DIR . 'inc/class-native-theme.php');

/* init theme. */
Native_Theme::run();

add_action( 'init', 'native_theme_supports' );

function native_theme_supports() {
    if ( ! get_option( 'native_migration_autop' ) ) {
        update_option( 'es_wp_autop',1  );
        update_option( 'native_migration_autop', 1 );
    }
}

/**
 * Delete plugin color settings tab.
 *
 * @param $tabs
 * @return mixed
 */
function native_settings_get_tabs( $tabs ) {
    unset( $tabs['color'] );
    return $tabs;
}
add_filter( 'es_settings_get_tabs', 'native_settings_get_tabs' );

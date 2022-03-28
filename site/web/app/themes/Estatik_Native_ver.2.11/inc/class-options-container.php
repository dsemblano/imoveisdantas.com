<?php

/**
 * Class Es_Native_Options_Container.
 *
 * @property string $theme_color
 * @property int $logo_attachment_id
 * @property int $favicon_attachment_id
 * @property string $option_css
 * @property int $news_per_page
 * @property string $copyright
 * @property string $twitter_link
 * @property string $facebook_link
 * @property string $youtube_link
 * @property string $pinterest_link
 * @property string $instagram_link
 * @property string $google_plus_link
 * @property string $linkedin_link
 * @property string $message_sent_text
 * @property int $not_found_background_id
 * @property int $not_found_title
 * @property int $not_found_text
 * @property int $not_found_button_label
 * @property int $top_background_id

 */
class Es_Native_Options_Container {
	/**
	 * Prefix for settings. Example {OPTIONS_PREFIX}theme_color.
	 */
	const OPTIONS_PREFIX = 'es_native_';

	/**
	 * Return list of available settings.
	 *
	 * @return array|mixed
	 */
	public static function get_available_settings() {
		return apply_filters( 'es_native_get_available_settings', array(
			'theme_color' => array(
				'default_value' => '#3a3a3a',
			),

			'logo_attachment_id' => array(
				'default_value' => '',
			),

			'logo_width' => array(
				'default_value' => 'auto',
			),

			'logo_height' => array(
				'default_value' => '100%',
			),

			'favicon_attachment_id' => array(
				'default_value' => '',
			),

			'news_per_page' => array(
				'default_value' => 3,
			),

			'show_breadcrumbs' => array(
				'default_value' => 1,
			),

            'is_sticky' => array(
				'default_value' => 1,
			),

			'option_css' => array(
				'default_value' => '',
			),

			'copyright' => array(
				'default_value' => __( 'Copyright 2017 Estatik. All rights reserved.', 'es-native' ),
			),

			'top_background_id' => array(
				'default_value' => '',
			),

			'twitter_link' => array(
				'default_value' => '#',
			),

			'facebook_link' => array(
				'default_value' => '#',
			),

			'youtube_link' => array(
				'default_value' => '#',
			),

			'pinterest_link' => array(
				'default_value' => '#',
			),

			'google_plus_link' => array(
				'default_value' => '',
			),

			'linkedin_link' => array(
				'default_value' => '#',
			),

            'instagram_link' => array(
                'default_value' => '#',
            ),

			'message_sent_text' => array(
				'default_value' => __('Drop us a line or give us a ring. We love to hear about your experience. We are happy to answer any questions.', 'es-native'),
			),

			'contact_tel' => array(
				'default_value' => '+44-(098)-765-53-43',
			),

			'email_title' => array(
				'default_value' => __( 'Email Us', 'es-native' ),
			),

			'contact_email' => array(
				'default_value' => '',
			),

			'address_title' => array(
				'default_value' => __( 'Our Address', 'es-native' ),
			),

			'contact_address' => array(
				'default_value' => '',
			),

			'not_found_background_id' => array(
				'default_value' => '',
			),

			'not_found_title' => array(
				'default_value' => __( '404 Error', 'es-native' ),
			),

			'not_found_text' => array(
				'default_value' => '',
			),

			'not_found_button_label' => array(
				'default_value' => __( 'Go to the Home page', 'es-native' )
			),
			'property_sidebar' => array(
				'default_value' => 'left',
				'values' => array(
					'left' => __( 'Left Sidebar', 'es-native' ) ,
					'right' => __( 'Right Sidebar', 'es-native' ),
				) ),

			'privacy_policy_checkbox' => array(
				'default_value' => 'required',
				'values' => array(
					'required' => __( 'Required', 'es-native' ),
					'optional' => __( 'Optional', 'es-native' ),
				),
			),

			'term_of_use_page_id' => array(
				'default_value' => '',
			),

			'privacy_policy_page_id' => array(
				'default_value' => '',
			),

		) );
	}

	/**
	 * Return list if available values using setting name.
	 *
	 * @param $name
	 *
	 * @return null
	 */
	public static function get_setting_values( $name ) {
		$settings = static::get_available_settings();

		return isset( $settings[ $name ]['values'] ) ?
			$settings[ $name ]['values'] : null;
	}

	/**
	 * Return option value using setting name.
	 *
	 * @param $name
	 *
	 * @return string|null
	 */
	public function __get( $name ) {
		$settings = static::get_available_settings();

		return isset( $settings[ $name ]['default_value'] ) ?
			get_option( static::OPTIONS_PREFIX . $name, $settings[ $name ]['default_value'] ) : null;

	}

	/**
	 * Magic method for empty and isset methods.
	 *
	 * @param $name
	 *
	 * @return bool
	 */
	public function __isset( $name ) {
		$value = $this->__get( $name );

		return ! empty( $value );
	}

	/**
	 * Save one settings.
	 *
	 * @param $name
	 * @param $value
	 *
	 * @return void
	 */
	public function saveOne( $name, $value ) {
		update_option( static::OPTIONS_PREFIX . $name, $value );
	}

	/**
	 * Save settings list.
	 *
	 * @param array $data
	 *
	 * @see update_option
	 */
	public function save( array $data ) {
		if ( ! empty( $data ) ) {
			$settings = static::get_available_settings();
			foreach ( $settings as $name => $setting ) {
				if ( isset( $data[ $name ] ) ) {
					$prev = $this->{$name};
					update_option( static::OPTIONS_PREFIX . $name, $data[ $name ] );

					do_action( 'es_native_settings_save', $name, $data[ $name ], $prev );
				}
			}
		}
	}

	/**
	 * Return label of the value.
	 *
	 * @param $name
	 * @param $value
	 *
	 * @return null
	 */
	public function get_label( $name, $value ) {
		$default = static::get_setting_values( $name );

		return ! empty( $default[ $value ] ) ? $default[ $value ] : null;
	}
}

<?php

/**
 * Class Es_Native_Contact_Form
 */
class Es_Native_Contact_Form {

	/**
	 * Form instance.
	 *
	 * @var Estatik
	 */
	protected static $_instance;

	public static $response = array();

	public static function build_terms_and_cond_string() {


	}

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function getInstance() {

		static $_instance = null;

		if ( is_null( $_instance ) ) {
			$_instance = new self;
		}

		return $_instance;
	}

	/**
	 * Constructor.
	 */
	protected function __construct()
	{
		$this->render();
	}

	/**
	 * Build form.
	 *
	 * @return void
	 */
	public static function build()
	{
		static::$_instance = static::getInstance();
	}


	/**
	 * Render form.
	 *
	 * @return void
	 */
	private function render() {
		$template = apply_filters( 'es_native_contact_form_path', ES_NATIVE_TEMPLATES_DIR . 'contact-form.php' );
		require_once( $template );
	}


	/**
	 * Submit form callback.
	 */
	public static function submit() {
	  global $es_native_options;

	  $response = array();
	  $data = $_POST;

	      if ( empty( $data['your_name'] ) || empty( $data['your_email'] ) ) {
	        $response[] = array( 'status' => 'error', 'message' => __( 'Please fill required fields.', 'es-native' ) );
	      }

	      if ( ! es_validate_recaptcha() ) {
	      	$response[] = array( 'status' => 'error', 'message' => __( 'Invalid recaptcha.', 'es-native' ) );
	      }

	      if ( $es_native_options->privacy_policy_checkbox == 'required' && empty( $data['agree_terms'] ) ) {
		      $response[] = array( 'status' => 'error', 'message' => __( 'Please, agree terms & conditions and privacy policy.', 'es-native' ) );
	      }

	      if ( empty( $response ) ) {
	        $message        = '';
	        $your_name      = $data['your_name'];
	        $your_email     = $data['your_email'];
	        $your_phone     = $data['your_phone'];
	        $your_questions = $data['your_questions'];

	        $to = get_option( 'admin_email' );

	        $subject = __( 'Contact from ' . get_bloginfo( 'site_name' ), 'es-native' );
	        $message .= __( 'Name', 'es-native' ) . ": $your_name\r\n";
	        $message .= __( 'Email', 'es-native' ) . ": $your_email \r\n";
	        $message .= __( 'Phone', 'es-native' ) . ": $your_phone\r\n";
	        $message .= __( 'Questions', 'es-native' ) . ": $your_questions";

	        if ( wp_mail( $to, $subject, $message ) ) {
		        if (!empty($es_native_options->message_sent_text )) {
			        $response[] = array( 'status' => 'success', 'message' => $es_native_options->message_sent_text ) ;
		        }
		        else {
			        $response[] = array( 'status' => 'success', 'message' => __( 'Thank you for contacting us!', 'es-native' ) );
		        }
	        } else {
		        $response[] = array( 'status' => 'error', 'message' => __( 'Message didn\'t send. Please, contact the support.', 'es-native' ) );
	        }

	      }

	      echo json_encode( $response );

		wp_die();
	}
}
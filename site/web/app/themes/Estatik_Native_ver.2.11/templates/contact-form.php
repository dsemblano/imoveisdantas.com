<?php global $es_native_options, $es_settings;

$terms_of_use = __( 'Terms of Use' ,'es-native' );
$privacy_policy = __( 'Privacy Policy' ,'es-native' );

$terms_of_use = $es_native_options->term_of_use_page_id && get_permalink( $es_native_options->term_of_use_page_id ) ?
	"<a href='" . get_permalink( $es_native_options->term_of_use_page_id ) . "' target='_blank'>{$terms_of_use}</a>" : $terms_of_use;

$privacy_policy = $es_native_options->privacy_policy_page_id && get_permalink( $es_native_options->privacy_policy_page_id ) ?
	"<a href='" . get_permalink( $es_native_options->privacy_policy_page_id ) . "' target='_blank'>{$privacy_policy}</a>" : $privacy_policy;

?>
<section class="contact-block__form">
	<div class="contact-block__send-form-wrapper">
		<form class="contact-block__send-form" action="" method="post">
            <div class="contact-block__input-wrap">
                <label><?php _e( 'Your name', 'es-native' ); ?>:</label>
                <input type="text" id="es_your_name" name="your_name" value="" data-validetta="required,minLength[3]"/>
            </div>
            <div class="contact-block__input-wrap">
                <label><?php _e( 'Your email', 'es-native' ); ?>:</label>
                <input type="text" id="es_your_email" name="your_email" value="" data-validetta="required,email"/>
            </div>
            <div class="contact-block__input-wrap">
			    <label><?php _e( 'Your phone', 'es-native' ); ?>:</label>
                <input type="text" id="es_your_phone" name="your_phone" value="" data-validetta="number"/>
            </div>
            <div class="contact-block__input-wrap">
                <label><?php _e( 'Your Questions', 'es-native' ); ?>:</label>
                <textarea id="es_your_question" name="your_questions"></textarea>
            </div>

			<?php if ( $es_native_options->privacy_policy_checkbox == 'required' ) : ?>
                <div class="contact-block__input-wrap" style="justify-content: flex-end;">
                    <label>
                        <input type="checkbox" name="agree_terms" value="1" required/>
                        <?php printf( __( 'I agree to the %s and %s', 'es-native' ), $terms_of_use, $privacy_policy ); ?>
                    </label>
                </div>
			<?php endif; ?>

            <div class="contact-block__input-wrap">
                <?php if ( $es_settings->recaptcha_site_key ) : ?>
                    <label for=""></label>
                    <div><?php do_action( 'es_recaptcha' ); ?></div>
                <?php endif; ?>
            </div>

            <input type="hidden" name="action" value="submit_contact_form"/>

			<div class="contact-block__button-container">
				<input class="native__button--solid" type="submit" value="<?php _e( 'Send', 'es-native' ); ?>" name="contact_submit"/>
			</div>
		</form>
	</div>
    <div class="message_sent" style="display:none;">
        <div class="message_sent__container">
            <div class="form_response"></div>
        </div>
    </div>

</section>


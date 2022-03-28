<div class="es-settings-field">
	<label><span class="es-settings-label"><?php _e( "User notification text", "es-native" ); ?>:</span>
		<?php
		$settings = array( 'media_buttons' => false, 'wpautop' => false, 'textarea_name' => 'es_native_options[message_sent_text]' );
		wp_editor( stripslashes( $es_native_options->message_sent_text ), 'message_sent_text', $settings );
		?>
	</label>
</div>
<div class="es-settings-field">
	<label><span class="es-settings-label"><?php _e( 'Tel Number', "es-native" ); ?>:</span>
		<input type="text" name="es_native_options[contact_tel]" value="<?php echo $es_native_options->contact_tel; ?>"/>
	</label>
</div>

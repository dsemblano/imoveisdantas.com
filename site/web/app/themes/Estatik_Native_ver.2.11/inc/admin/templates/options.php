<?php global $es_native_options; ?>

<div class='wrap es-wrap es-native-settings-wrap'>
	<?php echo Native_Theme::get_logo(); ?>

	<h1><?php _e( 'Theme Options', 'es-native' ); ?></h1>

	<form action='' method="POST">

		<div class="es-header-button">
			<span><?php _e( 'Please fill up your Theme Options and click save to finish.', 'es-native' ); ?></span>
			<input type="submit" value="<?php _e( 'Save', 'es-native' ); ?>">
		</div>

		<?php if ( $tabs = Native_Options_Page::get_tabs() ): ?>
			<div class='nav-tab-wrapper es-box'>
				<ul>
					<?php foreach ( $tabs as $key => $tab ):?>
						<li><a href='#es-<?php echo $key; ?>-tab'><?php echo $tab['label'] ?></a></li>
						<?php
					endforeach; ?>
				</ul>
				<?php foreach ( $tabs as $key => $tab ):?>
					<div id='es-<?php echo $key; ?>-tab'>
						<?php require_once $tab['template']; ?>
					</div>
					<?php
				endforeach; ?>
			</div>
		<?php endif; ?>
		<?php wp_nonce_field( 'es_native_save_options', 'es_native_save_options' ); ?>
	</form>
</div>

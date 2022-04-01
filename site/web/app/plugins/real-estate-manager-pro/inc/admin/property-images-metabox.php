<div class="ich-settings-main-wrap">
	<button class="button-secondary upload_image_button" data-title="<?php _e( 'Select images for property gallery', 'real-estate-manager' ); ?>" data-btntext="<?php _e( 'Insert', 'real-estate-manager' ); ?>">
		<span class="dashicons dashicons-images-alt2"></span>
		<?php _e( 'Upload Images', 'real-estate-manager' ); ?>
	</button>
	<p><?php echo nl2br(rem_get_option('upload_images_inst')); ?></p>
	<?php global $post; 
	$images_ids = get_post_meta( $post->ID, 'rem_property_images', true );
	?>
	<div class="row thumbs-prev">
		<?php if ($images_ids != '') {
			foreach ($images_ids as $id) {
				$image_url = wp_get_attachment_image_src( $id, 'thumbnail' );
				?>
					<div class="col-sm-3">
						<div class="rem-preview-image">
							<input type="hidden" name="rem_property_data[property_images][<?php echo $id; ?>]" value="<?php echo $id; ?>">
							<div class="rem-image-wrap">
								<img src="<?php echo $image_url[0]; ?>">
							</div>
							<div class="rem-actions-wrap">
								<a target="_blank" href="<?php echo admin_url( 'post.php' ); ?>?post=<?php echo $id; ?>&action=edit&image-editor&rem_image_editor" class="btn btn-info btn-sm">
									<i class="fa fa-crop"></i>
								</a>
								<a href="javascript:void(0)" class="btn remove-image btn-sm">
									<i class="fa fa-times"></i>
								</a>
							</div>
						</div>
					</div>
				<?php
			}
		} ?>
	</div>
	<div style="clear: both; display: block;"></div>
</div>
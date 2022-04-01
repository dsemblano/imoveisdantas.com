<section id="property-content" class="ich-settings-main-wrap">
	<div class="row">
		<div class="<?php echo ($sidebar == 'enable') ? 'col-sm-9' : 'col-sm-12' ; ?>">
			<?php do_action( 'rem_single_property_slider', $property_id ); ?>
			<?php do_action( 'rem_single_property_contents', $property_id ); ?>
		</div>
		<?php if($sidebar == 'enable') { ?>
		<div class="col-sm-3">
			<?php
				global $post;
				$author_id = $post->post_author;
				do_action( 'rem_single_property_agent', $author_id );
			?>
			</div>
		<?php } ?>
	</div>
</section>
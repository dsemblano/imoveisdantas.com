<?php

/**
 * Banners widget.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Banners_Widget $this
 */

echo $args['before_widget'];

$banner_link     = ! empty( $instance['banner_link'] ) ? $instance['banner_link'] : null;
$banner_title    = ! empty( $instance['banner_title'] ) ? $instance['banner_title'] : null;
$banner_subtitle = ! empty( $instance['banner_subtitle'] ) ? $instance['banner_subtitle'] : null;
$banner_img_id   = ! empty( $instance['banner_img_id'] ) ? $instance['banner_img_id'] : null;
$img             = wp_get_attachment_image( $banner_img_id, 'origin' );

?>

<?php do_action( 'es_before_banners_widget' ); ?>
<?php if ( ! empty( $banner_link ) ): ?>
	<a href="<?php echo $banner_link; ?>">
<?php endif; ?>
<div class="banner__info-wrap">
<?php if ( ! empty( $banner_title ) ): ?>
    <div class="banner-title"><span><?php echo $banner_title; ?></span></div>
<?php endif; ?>
<?php if ( ! empty( $banner_subtitle ) ): ?>
    <div class="banner-subtitle"><span><?php echo $banner_subtitle; ?></span></div>
<?php endif; ?>
</div>
<?php echo $img; ?>
<?php if ( ! empty( $banner_link ) ): ?>
	</a>
<?php endif; ?>
<?php do_action( 'es_after_banners_widget' ); ?>
<?php echo $args['after_widget'];

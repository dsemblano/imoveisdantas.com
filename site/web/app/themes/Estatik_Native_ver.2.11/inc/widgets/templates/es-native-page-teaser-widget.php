<?php

/**
 * Hot Property widget.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Page_Teaser_Widget $this
 */

echo $args['before_widget'];

$title    = $instance['title'];
$page = $instance['page'];
$page_post = get_post( $page );
?>

<?php do_action( 'es_before_page_teaser_widget' ); ?>
<?php if ( ! empty( $page_post ) ):?>
	<div>
		<h1><?php echo $title; ?></h1>
		<div>
			<?php echo get_the_post_thumbnail( $page_post,'thumbnail_372x103' ); ?>
			<p><?php echo wp_trim_words( strip_tags( strip_shortcodes( $page_post->post_content ) ), 25 );?></p>
			<a href="<?php echo get_the_permalink( $page_post );?>"><?php _e( 'Learn More', 'es-native' );?></a>
		</div>
	</div>
<?php endif;?>
<?php do_action( 'es_after_page_teaser_widget' ); ?>
<?php echo $args['after_widget'];

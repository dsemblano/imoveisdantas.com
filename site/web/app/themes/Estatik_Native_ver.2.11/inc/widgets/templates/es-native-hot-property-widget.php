<?php

/**
 * Hot Property widget.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Hot_Property_Widget $this
 */

echo $args['before_widget'];

$title    = $instance['title'];
$property = $instance['property'];

$query = false;

if ( function_exists( 'es_get_property' ) ) {
	$es_property = es_get_property( $property );
	$arg_posts   = array(
		'post_type'      => 'properties',
		'p'              => $property,
		'posts_per_page' => 1
	);
	$query       = new WP_Query( $arg_posts );
}
do_action( 'es_before_hot_property_widget' );

if ( $query instanceof WP_Query && $query->have_posts() ): ?>
	<h1><?php echo $title; ?></h1>
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="es-slide">
			<div class="es-slide__image">
				<a href="<?php the_permalink(); ?>">
					<?php if ( ! empty( $es_property->gallery ) ) : ?>
						<?php echo wp_get_attachment_image( $es_property->gallery[0], 'thumbnail_372x218' ); ?>
					<?php elseif ( $image = es_get_default_thumbnail( 'thumbnail_372x218' ) ) : ?>
						<?php echo $image; ?>
					<?php endif; ?>
                </a>
			</div>
			<div class="es-slide__content">
				<div class="es-slide__top">
					<?php $terms = get_the_terms( get_the_ID(), 'es_category' );?>
                    <?php if ( $terms && ! $terms instanceof WP_Error ) : ?>
				    <span class="es-property-slide-categories" ><a href="<?php echo get_term_link( $terms[ 0 ] ); ?>"><?php echo $terms[ 0 ]->name; ?></a></span>
                    <?php endif; ?>
					<?php es_the_formatted_price(); ?>
				</div>
				<div class="es-slide__bottom">
					<?php es_the_formatted_area( '<span class="es-bottom-icon"><i class="es-icon es-squirefit" aria-hidden="true"></i> ', '</span>' ); ?>
					<?php es_the_formatted_bedrooms( '<span class="es-bottom-icon"><i class="es-icon es-bed" aria-hidden="true"></i> ', '</span>' ); ?>
					<?php es_the_formatted_bathrooms( '<span class="es-bottom-icon"><i class="es-icon es-bath" aria-hidden="true"></i> ', '</span>' ); ?>
				</div>
			</div>
		</div>
	<?php endwhile;
endif;
do_action( 'es_after_hot_property_widget' );
echo $args['after_widget'];

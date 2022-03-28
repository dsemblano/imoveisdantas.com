<?php

/**
 * Properties list widget.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Properties_Widget $this
 */

echo $args['before_widget'];

$title = $instance['title'];

$properties_query = $this->prop_loop( $instance );

do_action( 'es_before_properties_widget' ); ?>
	<div class="popular-properties">
		<section class="popular-properties__container">
			<h3><?php echo $title; ?></h3>
			<?php if ( $properties_query->have_posts() ): ?>
				<ul>
					<?php while ( $properties_query->have_posts() ) : $properties_query->the_post(); ?>
						<li>
							<a class="popular-properties__title" href="<?php the_permalink();?>">
								<?php the_title(); ?>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php wp_reset_query(); endif; ?>
		</section>
	</div>
<?php do_action( 'es_after_properties_widget' ); ?>
<?php echo $args['after_widget'];

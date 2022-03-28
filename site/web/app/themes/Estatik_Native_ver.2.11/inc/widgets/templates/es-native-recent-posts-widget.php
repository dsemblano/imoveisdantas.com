<?php

/**
 * Recent Posts widget.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Recent_Posts_Widget $this
 */

echo $args['before_widget'];

$title = $instance['title'];
$amount = ! empty( $instance['amount'] ) ? $instance['amount'] : 3;
$category = ! empty( $instance['category'] ) ? $instance['category'] : null;
$query_args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => $amount,
	'orderby' => 'date',
	'order' => 'DESC',
);
if ( ! empty( $category ) ) {
	$query_args['tax_query'] = array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => $category );
}

$posts_query = new WP_Query( $query_args );

do_action( 'es_before_latest_news_widget' ); ?>
<?php if ( $posts_query->have_posts() ):  ?>
	<div class="native-recent-posts">
		<section class="native-recent-posts__container">
            <?php echo $args['before_title'] . $instance['title'] . $args['after_title'];?>
				<ul class="native-recent-posts__grid">
					<?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
						<li>
							<div class="native-recent-posts__block-wrapper">
								<a class="native-recent-posts__title" href="<?php the_permalink();?>">
									<?php the_post_thumbnail( 'thumbnail_372x218' );?>
									<p><?php echo wp_trim_words( strip_tags( strip_shortcodes( get_the_content() ) ), 25 );?></p>
								</a>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
		</section>
	</div>
<?php wp_reset_query(); endif;
do_action( 'es_after_latest_news_widget' );
echo $args['after_widget'];

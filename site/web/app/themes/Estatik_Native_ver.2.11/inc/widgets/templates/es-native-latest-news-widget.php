<?php

/**
 * Latest News widget.
 *
 * @var array $instance
 * @var array $args
 * @var Es_Native_Latest_News_Widget $this
 */

echo $args['before_widget'];

$title = $instance['title'];
$amount = ! empty( $instance['amount'] ) ? $instance['amount'] : 3;
$layout = ! empty( $instance['layout'] ) ? $instance['layout'] : 'short';
$show_button = ! empty( $instance['show_button'] ) ? $instance['show_button'] : 0;
$view_all_link = ! empty( $instance['view_all_link'] ) ? $instance['view_all_link'] : '';

$news_query = new WP_Query( array(
	'post_type' => 'news',
	'post_status' => 'publish',
	'posts_per_page' => $amount,
	'orderby' => 'date',
	'order' => 'DESC',
) );

do_action( 'es_before_latest_news_widget' ); ?>
	<div class="latest-news">
		<section class="latest-news__container">
            <?php echo $args['before_title'] . $instance['title'] . $args['after_title']; ?>
			<?php if ( $news_query->have_posts() ): ?>
				<ul class="latest-news__grid">
					<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
						<li class="layout-<?php echo $layout;?>">
							<?php if ( $layout == 'long' ):?>
							<div class="latest-news__block-wrapper">
								<a class="latest-new__title" href="<?php the_permalink();?>">
									<p><?php echo wp_trim_words( strip_tags( strip_shortcodes( get_the_content() ) ), 15 );?></p>
								</a>
								<div class="latest-new__date">
									<p><?php the_modified_date('l M d g:i a');?></p>
								</div>
							</div>
							<?php else:?>
								<div class="latest-news__block-wrapper">
									<a class="latest-new__title" href="<?php the_permalink();?>">
										<?php the_title(); ?>
									</a>
								</div>
							<?php endif;?>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php if ( ! empty( $show_button ) && ! empty( $view_all_link ) ): ?>
					<a href="<?php echo $view_all_link;?>"><?php _e( 'View all posts', 'es-nature' );?></a>
				<?php endif;?>
			<?php wp_reset_query(); endif; ?>
		</section>
	</div>
<?php do_action( 'es_after_latest_news_widget' );
echo $args['after_widget'];

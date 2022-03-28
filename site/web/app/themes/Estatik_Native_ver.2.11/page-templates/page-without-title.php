<?php
/**
 * The template Name: Page without title
 **/

global $es_native_options;

?>
<?php get_header(); ?>
	<div class="main-block">
		<div class="main-block__wrapper">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="article-block__copy">
					<?php the_content(); ?>
				</div>
			<?php endwhile; // End of the loop.?>
		</div>
	</div>
<?php get_footer();

<?php
/**
 * The template Name: Page with top Estatik search
 **/

global $es_native_options;

?>
<?php get_header(); ?>
<?php get_template_part( 'templates/full-search' ); ?>
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

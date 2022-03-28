<?php
/**
 * The template Name: Page without sidebar
 **/
?>

<?php get_header(); ?>
	<div class="main-block">
		<div class="main-block__wrapper">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="article-block__copy">
					<?php the_title( '<h1>', '</h1>' ); ?>
					<?php the_content(); ?>
				</div>
			<?php endwhile; // End of the loop.?>
		</div>
	</div>
<?php get_footer();

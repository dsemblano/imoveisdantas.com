<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Estatik_Theme_Native
 * @since Estatik Theme Native 1.0
 */
?>

<?php get_header(); ?>
	<div class="main-block">
		<div class="main-block__wrapper">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="article-block__copy">
					<?php the_title( '<h1>', '</h1>' );?>
					<?php the_content(); ?>
				</div>
			<?php endwhile; // End of the loop.?>
		</div>
	</div>
<?php get_footer();

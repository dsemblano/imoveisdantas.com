<?php
/**
 * The template Name: Page with right sidebar
 **/
?>

<?php get_header(); ?>
	<div class="main-block">
		<div class="main-block__wrapper">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="article-block__copy">
					<?php the_title( '<h1>', '</h1>' ); ?>
					<?php if ( is_dynamic_sidebar( 'content-top-sidebar' ) ): ?>
						<div class="content-top-sidebar">
							<?php if ( is_active_sidebar( 'content-top-sidebar' ) ) dynamic_sidebar( 'content-top-sidebar' ); ?>
						</div>
					<?php endif; ?>
					<?php the_content(); ?>
				</div>
			<?php endwhile; // End of the loop.?>
			<?php if ( is_dynamic_sidebar( 'page-sidebar-right' ) ): ?>
				<div class="sidebar">
					<?php if ( is_active_sidebar( 'page-sidebar-right' ) ) dynamic_sidebar( 'page-sidebar-right' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php get_footer();

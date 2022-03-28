<?php

/**
 * The template Name: Estatik Native Contact
 **/
?>
<?php get_header(); ?>
	<div class="main-block">
		<div class="main-block__wrapper">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="article-block__container">
					<?php the_content(); ?>
					<?php Es_Native_Contact_Form::build(); ?>
				</div>
			<?php endwhile; // End of the loop.?>
			<div class="sidebar">
				<?php if ( is_active_sidebar( 'page-sidebar-right' ) ) {
					dynamic_sidebar( 'page-sidebar-right' );
				} ?>
			</div>
		</div>
	</div>
<?php get_footer();


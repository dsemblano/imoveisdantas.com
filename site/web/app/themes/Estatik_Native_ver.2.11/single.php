<?php

/**
 * The single template file
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
<?php if ( is_active_sidebar( 'top-sidebar' ) ) dynamic_sidebar( 'top-sidebar' ); ?>
	<div class="main-block">
		<div class="main-block__wrapper">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="article-block__container">
                    <div class="article-block__wrapper">
                        <div class="article-block__title">
                            <?php the_title( '<h1>', '</h1>' ); ?>
                            <?php the_post_thumbnail('single-blog-image' ); ?>
                            <div class="article-block__header">
                                <span class="article-block__tags">
                                    <?php the_tags( '', ', ' ); ?>
                                </span>
                            </div>
                        </div>
                        <div class="article-block__copy">
                            <?php the_content(); ?>
                        </div>
                        <div class="article-block__footer">
                            <p class="article-block__posted">
                                <i class="glyphicon-bookmark"></i>
                                <span><?php _e( 'Posted in', 'es-native' ); ?> <?php the_category(', ');?></span>
                            </p>
                            <p class="article-block__date">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <?php the_date( 'l M d g:i a' ); ?>
                            </p>
                            <p class="article-block__reply">
                                <i class="glyphicon-comment"></i>
                                <span><?php echo comments_number(); ?></span>
                            </p>
                        </div>
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                    </div>
                </div>
                <?php endwhile; // End of the loop.?>
            <div class="sidebar">
                <?php if ( is_active_sidebar( 'content-sidebar' ) ) dynamic_sidebar( 'content-sidebar' ); ?>
            </div>
		</div>
	</div>
<?php if ( is_active_sidebar( 'bottom-sidebar' ) ) dynamic_sidebar( 'bottom-sidebar' ); ?>
<?php get_footer();

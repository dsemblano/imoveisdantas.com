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
* @since Estatik Theme Native 2.8
*/
global $es_property, $es_settings, $es_native_options;
$sidebar_active = is_active_sidebar( 'property-sidebar' );

get_header(); ?>
<div class="main-block">
    <div class="main-block__wrapper">
        <?php if ( $es_native_options->property_sidebar == 'left' && $sidebar_active ) : ?>
            <div class="sidebar">
                <?php dynamic_sidebar( 'property-sidebar' ); ?>
            </div>
        <?php endif;?>
        <div class="article-block__container es-single-<?php echo $es_settings->single_layout; ?>">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; // End of the loop.?>
        </div>
        <?php if ( $es_native_options->property_sidebar == 'right' && $sidebar_active ) : ?>
            <div class="sidebar">
                <?php dynamic_sidebar( 'property-sidebar' ); ?>
            </div>
        <?php endif;?>
    </div>
</div>
<?php get_footer();

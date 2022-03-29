<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Estatik_Theme_Native
 * @since Estatik Theme Native 1.0
 */
global $es_native_options;
$background = wp_get_attachment_image_src( $es_native_options->not_found_background_id, 'original' );
get_header(); ?>
		<div class="not-found__background" <?php if ( !empty( $background ) ):?>style="background-image: url(<?php echo $background[0]; ?>)" <?php endif;?>>
			<?php if(!empty($es_native_options->not_found_title)):?>
				<h1><?php echo apply_filters( 'the_title', $es_native_options->not_found_title ); ?></h1>
			<?php endif;?>
			<div><?php echo apply_filters( 'the_content', stripslashes( $es_native_options->not_found_text ) ); ?>
				<?php if ( !empty( $es_native_options->not_found_button_label ) ):?>
					<a class="theme-btn"
					   href="<?php echo home_url(); ?>"><?php echo $es_native_options->not_found_button_label; ?></a>
				<?php endif;?>
			</div>
		</div>
<?php get_footer();


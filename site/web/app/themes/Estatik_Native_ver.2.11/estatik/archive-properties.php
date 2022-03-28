<?php

/**
 * @var Es_Settings_Container $es_settings
 */

get_header();
$template = get_option('template'); ?>
    <div class="main-block">
        <div class="main-block__wrapper">
            <div class="content-block__container">
                <h1 class="page-title"><?php echo !empty($title) ? $title : __('Properties', 'es-native'); ?></h1>

                <?php do_action('es_before_content_list'); ?>

                <div class="es-wrap">
                    <?php do_action('es_archive_sorting_dropdown'); ?>

                    <?php if (have_posts()) : ?>
                        <ul class="<?php es_the_list_classes(); ?>">
                            <?php while (have_posts()) : the_post();
                                load_template(ES_TEMPLATES . 'content-archive.php', false);
                            endwhile; ?>
                        </ul>
                    <?php else: ?>
                        <p style="font-size: 14px;"><?php _e('Nothing to display.', 'es-native'); ?></p>
                    <?php endif; ?>

                    <?php the_posts_pagination( array(
                        'prev_next'          => __( 'Previous', 'es-native' ),
                        'show_all'           => false,
                        'end_size'           => 2,
                        'mid_size'           => 2,
                        'screen_reader_text' => ' ',
                        'type'               => 'list'
                    ) ); ?>
                </div>
                <?php do_action('es_after_content_list'); ?>
            </div>
            <div class="sidebar">
                <?php if (is_active_sidebar('content-sidebar')) dynamic_sidebar('content-sidebar'); ?>
            </div>
        </div>
    </div>
<?php get_footer();

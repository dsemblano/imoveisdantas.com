<?php global $es_native_options; ?>
<!DOCTYPE html>
<html class="nomargin" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php $favicon = wp_get_attachment_image_url(
        $es_native_options->favicon_attachment_id,
        'original'
    ); ?>
    <link rel="shortcut icon" href="<?php echo !empty($favicon) ? $favicon : ES_NATIVE_URL . 'assets/images/favicon.ico'; ?>">
    <?php wp_head(); ?>
    <style>
        .navigate-line .header__logo .header__logo-image {
            width: <?php echo $es_native_options->logo_width; ?>;
            height: <?php echo $es_native_options->logo_height; ?>;
        }
    </style>
    <?php if (!empty($es_native_options->option_css)) : ?>
        <style>
            <?php echo $es_native_options->option_css; ?>
        </style>
    <?php endif; ?>
</head>

<body <?php body_class(); ?>>
    <?php
    if (function_exists('wp_body_open')) {
        wp_body_open();
    } else {
        do_action('wp_body_open');
    } ?>
    <header class="native__color--background <?php if ($es_native_options->is_sticky) : ?>sticky-header<?php endif; ?>">
        <div class="navigate-line <?php if ($es_native_options->search_style == 'wide' && is_page_template('page-templates/page-with-top-search.php')) : ?>color-menu<?php endif; ?>">
            <div class="header__info-wrap">
                <a class="header__logo native__dark--background" href="<?php echo home_url(); ?>">
                    <?php if (!empty($es_native_options->logo_attachment_id)) : ?>
                        <img class="header__logo-image" src="<?php echo wp_get_attachment_image_url(
                                                                    $es_native_options->logo_attachment_id,
                                                                    'original'
                                                                ); ?>" />
                    <?php else : ?>
                        <img src="<?php echo ES_NATIVE_URL . 'assets/images/logo.png'; ?>">
                    <?php endif; ?>
                </a>
                <ul class="header__contact-information">
                    <?php if (!empty($es_native_options->contact_tel)) : ?>
                        <li class="header__phone">
                            <div><?php echo substr($es_native_options->contact_tel, 0, 16) ?></div>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
            <div class="navigate-line__wrapper">
                <a class="mobile-contact__button" href="#"></a>
                <a class="mobile-menu__button menu-button" href="#"></a>
                <nav class="main-menu">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'main_menu',
                        'menu_class'     => 'main-menu__menu',
                        'depth'          => 3,
                    )); ?>
                </nav>

                <nav class="mobile-menu">
                    <a class="mobile-menu__button menu-button" href="#"></a>
                    <?php wp_nav_menu(array(
                        'theme_location' => 'main_menu',
                        'menu_class'     => 'main-menu__menu',
                        'depth'          => 3,
                    )); ?>
                    <?php
                    if (is_user_logged_in()) { ?>
                        <?php wp_nav_menu(array(
                            'theme_location' => 'account_menu',
                            'menu_class'     => 'navigate-line__login',
                            'depth'          => 1,
                            'fallback_cb'    => false
                        )); ?>
                    <?php } else {
                        wp_nav_menu(array(
                            'theme_location' => 'login_menu',
                            'menu_class'     => 'navigate-line__login',
                            'depth'          => 1,
                            'fallback_cb'    => false
                        ));
                    } ?>
                </nav>
                <?php
                if (is_user_logged_in()) { ?>
                    <div class="user-logged-in"><i class="fa fa-user" aria-hidden="true"></i></div>
                    <?php wp_nav_menu(array(
                        'theme_location' => 'account_menu',
                        'menu_class'     => 'navigate-line__login',
                        'depth'          => 1,
                        'fallback_cb'    => false
                    ));

                    ?>

                <?php } else {
                    wp_nav_menu(array(
                        'theme_location' => 'login_menu',
                        'menu_class'     => 'navigate-line__login',
                        'depth'          => 1,
                        'fallback_cb'    => false
                    ));
                }
                ?>
            </div>
        </div>
    </header>
    <main <?php if ($es_native_options->is_sticky) : ?>class="sticky-header-main" <?php endif; ?>>
        <?php if (is_active_sidebar('top-wide-sidebar')) : ?> <div class="es-wide-sidebar"><?php dynamic_sidebar('top-wide-sidebar'); ?></div><?php endif; ?>
        <?php if ($es_native_options->show_breadcrumbs && !is_page_template('page-templates/page-with-top-search.php') && !is_page_template('page-templates/page-without-title.php')) : ?>
            <div class="breadcrumbs"><?php Native_Theme::breadcrumbs(); ?></div>
        <?php endif; ?>
        <?php if (is_active_sidebar('top-sidebar')) : ?><div class="es-main-width-sidebar"><?php dynamic_sidebar('top-sidebar'); ?></div> <?php endif; ?>
<?php
/**
 * Theme Color styles
 */
global $es_native_options;
$theme_color = $es_native_options->theme_color;

if ($theme_color <> '#1d1d1d'):
	$color = new Color( $theme_color);
	if ( $theme_color == '#000000') {
		$theme_color_dark = '#' . $color->lighten(5);
		$theme_color_light = '#' . $color->lighten(20);
		$theme_color_extra_light = '#' . $color->lighten(40);
		$theme_color_lighter_extra_light = '#' . $color->lighten(60);
	}
	else {
		$theme_color_dark = '#' . $color->darken(5);
		$theme_color_light = '#' . $color->lighten(20);
		$theme_color_extra_light = '#' . $color->lighten(40);
		$theme_color_lighter_extra_light = '#' . $color->lighten(60);
	}
?>
<style>
	.native__color--background,
	.banner-title,
	.native__button:hover,
	.native-login__wrap,
	.es-agent-register__wrap .es-field .es-field__content input[type=submit]:hover,
	.navigate-line__wrapper > .mobile-menu__button,
	.mobile-contact__button,
	.color-bottom-sidebar,
	.native__button--solid,
	.color-bottom-sidebar .widget_es_native_page_teaser_widget a,
	.es-login__wrap,
	.not-found__background .theme-btn:hover,
    .es-single-tabs-wrap ul.es-single-tabs li a:hover,
    .es-single .es-category-items a{
		background-color: <?php echo $theme_color;?>;
	}
    .es-single-tabs-wrap ul.es-single-tabs li a{
        border-top: 1px solid <?php echo $theme_color;?>;
        border-left:  1px solid <?php echo $theme_color;?>;
        border-right:  1px solid <?php echo $theme_color;?>;
    }

    .js-es-wishlist-button .fa {
        color:<?php echo $theme_color;?>;
    }
	.es-request-widget-wrap input[type=submit]:hover,
	.content-top-sidebar .es-dropdown-wrap ul li:hover{
		background: <?php echo $theme_color;?> !important;
	}
	.es-button.es-button-orange.es-hover-show.es-read,
	.es-search__wrapper:before,
	.content-top-sidebar .es-search__wrapper.es-search__wrapper--horizontal .es-search__buttons .es-button__wrap .es-button.es-button-orange-corner,
	.content-top-sidebar .es-search__wrapper.es-search__wrapper--horizontal .es-search__buttons .es-button__wrap .es-button.es-button-orange-corner:hover,
	.theme-btn.js-btn-submit:hover{
		background: <?php echo $theme_color;?> !important;
	}
	.native__dark--background,
	.footer__copyright,
	.native-nav-links ul li .page-numbers:hover,
	.widget_categories h2,
	.widget_search{
		background-color: <?php echo $theme_color_dark;?>;
	}
	.main-menu__menu li ul{
		background-color: <?php echo $theme_color_dark;?>;
	}
	@media (max-width: 640px){
		.header__contact-information{
			background-color: <?php echo $theme_color_dark;?>;
		}
	}
	.main-menu__menu a:before,
	.widget_categories .cat-item a:before{
		background: <?php echo $theme_color_extra_light;?>;
	}
	.main-menu__menu li a,
	.header__phone div,
	.footer__copyright,
	.color-bottom-sidebar .widget-title,
	.color-bottom-sidebar h1{
		color:<?php echo $theme_color_lighter_extra_light;?>;
	}
	.main-menu ul li:before{
		background: <?php echo $theme_color_dark;?>;
	}
	.article-block__tags a,
	.native__button,
	.content-block__title:hover > span,
	.sidr-class-mobile-menu__button:before,
	.popular-properties__container ul li a,
	.page-numbers,
	.widget_recent_entries ul li a,
	.widget_recent_entries,
	.widget_recent_entries ul,
	.post-search-form__button,
	.native__button--login,
	.es-agent__logout.es-btn.es-btn-orange-bordered,
	.not-found__background .theme-btn{
		color: <?php echo $theme_color;?>;
	}
	.es-request-widget-wrap input[type=submit]{
		color: <?php echo $theme_color;?> !important;
	}
	.es-search__wrapper.es-search__wrapper--vertical .es-search__buttons .es-button__wrap .es-button.es-button-orange-corner,
	.es-search__wrapper.es-search__wrapper--horizontal .es-search__buttons .es-button__wrap .es-button.es-button-orange-corner{
		color: <?php echo $theme_color;?> !important;
	}
	.es-search__wrapper.es-search__wrapper--vertical .es-search__buttons .es-button__wrap .es-button.es-button-orange-corner:hover,
	.es-search__wrapper.es-search__wrapper--horizontal .es-search__buttons .es-button__wrap .es-button.es-button-orange-corner:hover{
		color: <?php echo $theme_color;?> !important;
	}
	.native__button,
	.content-block__grid li:hover,
	.footer__socials a:hover,
	.page-numbers{
		border-color: <?php echo $theme_color;?>;
	}
	.es-request-widget-wrap input[type=submit],
	.es-agent__logout.es-btn.es-btn-orange-bordered,
	.es-login__wrap .es-submit__wrap .es-btn.es-btn-orange{
		border: 1px solid <?php echo $theme_color;?> !important;
	}
	.native-nav-links ul li .page-numbers:hover,
	.footer__copyright{
		border-color: <?php echo $theme_color_dark;?>;
	}
	.sidr ul li:hover > a,
	.sidr ul li:hover > span, .sidr ul li.active > a,
	.sidr ul li.active > span, .sidr ul li.sidr-class-active > a,
	.sidr ul li.sidr-class-active > span {
		background: <?php echo $theme_color_dark;?>;
		-webkit-box-shadow: 0 0 15px 3px <?php echo $theme_color;?> inset;
		box-shadow: 0 0 15px 3px <?php echo $theme_color;?>inset;
		color: #FFFFFF;
	}
	.sidr ul li ul li:hover > a,
	.sidr ul li ul li:hover > span, .sidr ul li ul li.active > a,
	.sidr ul li ul li.active > span, .sidr ul li ul li.sidr-class-active > a,
	.sidr ul li ul li.sidr-class-active > span {
		-webkit-box-shadow: 0 0 15px 3px <?php echo $theme_color;?> inset;
		box-shadow: 0 0 15px 3px <?php echo $theme_color;?> inset;
	}

    .menu-item-has-children > a:first-child:after{
       border-top-color: <?php echo $theme_color_lighter_extra_light;?> !important;
    }
</style>
<?php endif;?>
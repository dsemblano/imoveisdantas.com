<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2016
 * Time: 10:32 AM
 */




/* Site loading */
if (!function_exists('g5plus_site_loading')) {
	function g5plus_site_loading()
	{
		get_template_part('templates/site-loading');
	}

	add_action('g5plus_before_page_wrapper', 'g5plus_site_loading', 5);
}

/* Header meta */
if (!function_exists('g5plus_head_meta')) {
	function g5plus_head_meta()
	{
		get_template_part('templates/head/head-meta');
	}

	add_action('wp_head', 'g5plus_head_meta', 0);
}

/* Social meta */
if (!function_exists('g5plus_social_meta')) {
	function g5plus_social_meta()
	{
		g5plus_get_template('head/social-meta');
	}

	add_action('wp_head', 'g5plus_social_meta', 5);
}

/* Header top drawer*/
if (!function_exists('g5plus_page_top_drawer')) {
	function g5plus_page_top_drawer()
	{
		get_template_part('templates/top-drawer');
	}

	add_action('g5plus_before_page_wrapper_content', 'g5plus_page_top_drawer', 5);
}

/* Header */
if (!function_exists('g5plus_page_header')) {
	function g5plus_page_header()
	{
		if (g5plus_get_option('header_show_hide', 1)) {
			get_template_part('templates/header-desktop-template');
			get_template_part('templates/header-mobile-template');
		}
	}

	add_action('g5plus_before_page_wrapper_content', 'g5plus_page_header', 15);
}


if (!function_exists('g5plus_output_content_wrapper')) {
	function g5plus_output_content_wrapper(){
		get_template_part('templates/global/wrapper-start');
	}
	add_action('g5plus_main_wrapper_content_start','g5plus_output_content_wrapper',1);
}

if (!function_exists('g5plus_output_content_wrapper_end')) {
	function g5plus_output_content_wrapper_end(){
		get_template_part('templates/global/wrapper-end');
	}
	add_action('g5plus_main_wrapper_content_end','g5plus_output_content_wrapper_end',1);
}

// region Single post

if (!function_exists('g5plus_post_tag')) {
	function g5plus_post_tag(){
		get_template_part('templates/single/post-tag');
	}
	add_action('g5plus_after_single_post', 'g5plus_post_tag', 5);
}

if (!function_exists('g5plus_post_nav')) {
	function g5plus_post_nav()
	{
		$single_navigation_enable =  g5plus_get_option('single_navigation_enable',0);
		if ($single_navigation_enable){
			get_template_part('templates/single/post-nav');
		}
	}

	add_action('g5plus_after_single_post', 'g5plus_post_nav', 10);
}

if (!function_exists('g5plus_post_author_info')) {
	function g5plus_post_author_info()
	{
		$single_author_info_enable = g5plus_get_option('single_author_info_enable',1);
		if ($single_author_info_enable){
			get_template_part('templates/single/author-info');
		}
	}

	add_action('g5plus_after_single_post', 'g5plus_post_author_info', 15);
}

if (!function_exists('g5plus_post_comment')) {
	function g5plus_post_comment()
	{
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
	}
	add_action('g5plus_after_single_post', 'g5plus_post_comment', 20);
}

if (!function_exists('g5plus_post_related')) {
	function g5plus_post_related()
	{
		get_template_part('templates/single/related');
	}

	add_action('g5plus_after_single_post', 'g5plus_post_related', 30);
}

// endregion single post

/**
 * Footer Template
 * *******************************************************
 */
if (!function_exists('g5plus_footer_template')) {
	function g5plus_footer_template()
	{
		g5plus_get_template('footer-template');
	}

	add_action('g5plus_main_wrapper_footer', 'g5plus_footer_template');
}

//////////////////////////////////////////////////////////////////
// Page Title
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_page_title')) {
	function g5plus_page_title(){
		get_template_part('templates/page-title');
	}
	add_action('g5plus_before_main_content','g5plus_page_title',5);
}

//////////////////////////////////////////////////////////////////
// Back To Top
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_back_to_top')) {
	function g5plus_back_to_top(){
		get_template_part('templates/back-to-top');
	}
	add_action('g5plus_after_page_wrapper','g5plus_back_to_top',5);
}

if(!function_exists('g5plus_remove_action_hook'))
{
	function g5plus_remove_action_hook()
	{
		if (function_exists('ere_template_hooks')) {
			remove_action('ere_sidebar_property', array($GLOBALS['ere_template_hooks'], 'sidebar_property'));
			remove_action('ere_sidebar_agent', array($GLOBALS['ere_template_hooks'], 'sidebar_agent'));
			remove_action('ere_sidebar_invoice', array($GLOBALS['ere_template_hooks'], 'sidebar_invoice'));
		}
	}
}
add_action( 'wp_head', 'g5plus_remove_action_hook' );

if (!function_exists('g5plus_custom_css_editor_callback')) {
    function g5plus_custom_css_editor_callback() {
        $custom_css = g5plus_custom_css_editor();

        /**
         * Make sure we set the correct MIME type
         */
        header( 'Content-Type: text/css' );
        /**
         * Render RTL CSS
         */
        echo sprintf('%s',$custom_css);
        die();
    }
    add_action( 'wp_ajax_gsf_custom_css_editor', 'g5plus_custom_css_editor_callback');
    add_action( 'wp_ajax_nopriv_gsf_custom_css_editor', 'g5plus_custom_css_editor_callback');
}

if (!function_exists('g5plus_custom_css_editor')) {
    function g5plus_custom_css_editor() {
        $custom_css =<<<CSS
        body {
              margin: 9px 10px;
            }
CSS;
        $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : '';

        if (!empty($post_id)) {

            $sidebar_layout = g5plus_get_option('sidebar_layout', 'right');
            $sidebar_width = g5plus_get_option('sidebar_width', 'large');
            $sidebar =  g5plus_get_option('sidebar', 'main-sidebar');

            $preset_id = g5plus_get_option('blog_single_preset','');
            if (!empty($preset_id)) {
                $prefix = 'g5plus_framework_';
                $sidebar_layout =  g5plus_get_post_meta("{$prefix}sidebar_layout",$preset_id);
                $sidebar_width =  g5plus_get_post_meta("{$prefix}sidebar_width",$preset_id);
                $sidebar =  g5plus_get_post_meta("{$prefix}sidebar",$preset_id);
            }


            $content_width = 1170;
            $sidebar_text = esc_html__('Sidebar', 'g5-beyot');
            if ($sidebar_width === 'large') {
                $sidebar_width = 770;
            } else {
                $sidebar_width = 870;
            }

            $custom_css .= <<<CSS
            
            .mceContentBody::after {
              display: block;
              position: absolute;
              top: 0;
              left: 102%;
              width: 10px;
              -ms-word-break: break-all;
              word-break: break-all;
              font-size: 14px;
              color: #d8d8d8;
              text-align: center;
              height: 100%;
              max-width: 330px;
              z-index: 1;
              text-transform: uppercase;
              font-family: sans-serif;
              font-weight: 600;
              line-height: 26px;
              pointer-events: none;
            }
            
            .mceContentBody.mceContentBody {
              padding-right: 25px !important;
              padding-left: 15px !important;
              border-right: 1px solid #eee;
              position: relative;
              
            }
            .mceContentBody.mceContentBody[data-site_layout="none"] {
                max-width: 1170px;
                
              }
            .mceContentBody.mceContentBody[data-site_layout="none"]:after {
                  content: '';
             }
CSS;
            if ($sidebar_layout !== 'none' && is_active_sidebar($sidebar)) {
                $content_width = $sidebar_width;

                $custom_css .= <<<CSS
				.mceContentBody::after {
				    content: '{$sidebar_text}';
				}
CSS;
            }


            $custom_css .= <<<CSS
            

			.mceContentBody[data-site_layout="left"],
			.mceContentBody[data-site_layout="right"]{
			    max-width: {$sidebar_width}px;
			}
			
			.mceContentBody[data-site_layout="left"]::after,
			 .mceContentBody[data-site_layout="right"]::after{
				    content: '{$sidebar_text}';
				}

			.mceContentBody {
				max-width: {$content_width}px;
			}
			
CSS;
        }

        // Remove comments
        $custom_css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_css);
        // Remove space after colons
        $custom_css = str_replace(': ', ':', $custom_css);
        // Remove whitespace
        $custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);
        return $custom_css;
    }
}

if (!function_exists('g5plus_enqueue_block_editor_assets')) {
    function g5plus_enqueue_block_editor_assets() {
        wp_enqueue_style('fontawesome', G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css', array(),'4.5.0');

        wp_enqueue_style('block-editor', G5PLUS_THEME_URL . 'assets/css/editor-blocks.css');

        $screen = get_current_screen();
        $post_id = '';
        if ( is_admin() && ($screen->id == 'post') ) {
            global $post;
            $post_id = $post->ID;
        }

        wp_enqueue_style('gsf_custom_css_block_editor', admin_url('admin-ajax.php') . '?action=gsf_custom_css_block_editor&post_id=' . $post_id);

	    $fonts_url = g5plus_get_fonts_url();
	    $fonts_css = g5plus_get_fonts_css(false);
	    wp_enqueue_style('google-fonts',$fonts_url);
	    wp_add_inline_style('google-fonts',$fonts_css);

    }
    add_action('enqueue_block_editor_assets','g5plus_enqueue_block_editor_assets');
}

if (!function_exists('g5plus_custom_css_block_editor_callback')) {
    function g5plus_custom_css_block_editor_callback() {
        $custom_css = g5plus_custom_css_block_editor();

        /**
         * Make sure we set the correct MIME type
         */
        header( 'Content-Type: text/css' );
        /**
         * Render RTL CSS
         */
        echo sprintf('%s',$custom_css);
        die();
    }
    add_action( 'wp_ajax_gsf_custom_css_block_editor', 'g5plus_custom_css_block_editor_callback');
    add_action( 'wp_ajax_nopriv_gsf_custom_css_block_editor', 'g5plus_custom_css_block_editor_callback');
}

if (!function_exists('g5plus_custom_css_block_editor')) {
    function g5plus_custom_css_block_editor() {
        $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : '';


        $sidebar_layout = g5plus_get_option('sidebar_layout', 'right');
        $sidebar_width = g5plus_get_option('sidebar_width', 'large');
        $sidebar =  g5plus_get_option('sidebar', 'main-sidebar');

        $preset_id = g5plus_get_option('blog_single_preset','');
        if (!empty($preset_id)) {
            $prefix = 'g5plus_framework_';
            $sidebar_layout =  g5plus_get_post_meta("{$prefix}sidebar_layout",$preset_id);
            $sidebar_width =  g5plus_get_post_meta("{$prefix}sidebar_width",$preset_id);
            $sidebar =  g5plus_get_post_meta("{$prefix}sidebar",$preset_id);
        }


        $content_width = 1170;
        if ($sidebar_width === 'large') {
            $sidebar_width = 770;
        } else {
            $sidebar_width = 870;
        }

        $custom_css = '';
        if ($sidebar_layout !== 'none' && is_active_sidebar($sidebar)) {
            $content_width = $sidebar_width;
        }
        $custom_css .= <<<CSS
            
            .edit-post-layout__content[data-site_layout="left"] .wp-block,
			.edit-post-layout__content[data-site_layout="right"] .wp-block,
			.edit-post-layout__content[data-site_layout="left"] .wp-block[data-align="wide"],
			.edit-post-layout__content[data-site_layout="right"] .wp-block[data-align="wide"],
			.edit-post-layout__content[data-site_layout="left"] .wp-block[data-align="full"],
			.edit-post-layout__content[data-site_layout="right"] .wp-block[data-align="full"]{
			    max-width: {$sidebar_width}px;
			}
			
			.wp-block[data-align="full"] {
			    margin-left: auto;
			    margin-right: auto;
			}
			
            
            .wp-block,
            .wp-block[data-align="wide"],
             .wp-block[data-align="full"]{
                max-width: {$content_width}px;
            }
			
CSS;
        // Remove comments
        $custom_css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_css);
        // Remove space after colons
        $custom_css = str_replace(': ', ':', $custom_css);
        // Remove whitespace
        $custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);

        return $custom_css;
    }
}
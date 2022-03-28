<?php
/**
 * Estatik Native Theme functions and definitions
 * @package    Estatik_Theme_Native
 * @author     Estatik
 */

class Native_Theme {

	/**
	 * Theme version.
	 *
	 * @var string
	 */
	protected $_version;

	/**
	 * Theme instance.
	 *
	 * @var Estatik
	 */
	protected static $_instance;

	/**
	 * Returns the instance.
	 *
	 * @access public
	 * @return object
	 */
	public static function getInstance() {

		static $_instance = null;

		if ( is_null( $_instance ) ) {
			$_instance = new self;
		}

		return $_instance;
	}

	/**
	 * Constructor.
	 */
	protected function __construct()
	{
		$this->setup_actions();
		$this->init();
	}

	/**
	 * Initialize theme.
	 *
	 * @return void
	 */
	public static function run()
	{
		static::$_instance = static::getInstance();
	}

	/**
	 * Return theme version.
	 *
	 * @return string
	 */
	public static function getVersion()
	{
		$es_theme = wp_get_theme();
		return $es_theme->get( 'Version' );
	}

	/**
	 * Sets up initial actions.
	 *
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register sidebars.
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );

		// Register widgets.
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );

		// Theme setup.
		add_action( 'after_setup_theme', array( $this, 'theme_setup'             ),  5 );
		add_action( 'after_setup_theme', array( $this, 'custom_background_setup' ), 15 );
		add_action( 'after_setup_theme', array( $this, 'load_text_domain' ) );

		add_action( 'tgmpa_register', array( $this, 'recommended_plugins' ) );
		add_filter( 'pt-ocdi/import_files', array( $this, 'ocdi_import_files' ) );
		add_action( 'pt-ocdi/after_import', array( $this, 'ocdi_after_import_setup' ) );
		add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

		// Register menus.
		add_action( 'init', array( $this, 'register_menus' ) );

		// Register post types.
		add_action( 'init', array( $this, 'register_post_types' ) );

		// Add meta boxes.
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );

		// Save pages.
		add_action( 'save_post', array( $this, 'save_pages' ) );

		// Save theme options.
		add_action( 'init', array( 'Native_Options_Page', 'save' ) );

		// Register scripts, styles, and fonts.
		add_action( 'wp_enqueue_scripts',    array( $this, 'register_scripts' ) );
		add_action( 'enqueue_embed_scripts', array( $this, 'register_scripts' ) );

		// Remove plugin properties singe styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'remove_es_front_single_style' ) );
		add_action( 'wp_print_styles', array( $this, 'remove_es_front_single_style' ) );

		// Archive and categories page titles.
		add_filter( 'get_the_archive_title', array( $this, 'get_the_archive_title' ) );

		// Amount of news per page.
		add_action('pre_get_posts', array( $this, 'news_posts_per_page' ) );

		// Register image sizes.
		add_action( 'init', array( $this, 'register_image_sizes' ) );

        // Sorting dropdown template path.
		add_filter( 'es_archive_sorting_template', array( $this, 'archive_sorting_template' ), 10, 1 );

		// Subscription table template path.
		add_filter( 'es_subscription_table_template_path', array( $this, 'subscription_table_template_path' ), 10, 1 );

		// Change excerpt more.
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

        // Change search properties template path.
        add_filter( 'template_include', array( $this, 'template_loader' ) );

        add_action( 'wp_head', array( $this, 'customize_theme_color' ) );

        add_filter('navigation_markup_template', array( $this, 'navigation_template' ), 10, 2 );

		// Ajax contact form submit.
		add_action( 'wp_ajax_submit_contact_form', array( 'Es_Native_Contact_Form', 'submit' ) );
		add_action( 'wp_ajax_nopriv_submit_contact_form', array( 'Es_Native_Contact_Form', 'submit' ) );

    }

	/**
	 * Add some plugins to TGM plugin activation
	 */
	public function recommended_plugins(){
		$plugins = array(
			array(
				'name'      => __('Estatik Real Estate', 'es-native'),
				'slug'      => 'estatik',
				'external_url'    => 'https://estatik.net/',
				'required'  => false,
			),
			array(
				'name'      => __('Estatik Mortgage Calculator', 'es-native'),
				'slug'      => 'estatik-mortgage-calculator',
				'required'  => false,
			),
			array(
				'name'      => __('One Click Demo Import', 'es-native'),
				'slug'    => 'one-click-demo-import',
				'required'  => false,
			)
		);

		$config = array(
			'id'           => 'tgmpa-project',         // Unique ID for hashing notices for multiple instances of TGMPA.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}


	/**
	 * Settings for import demo content.
	 * @return array
	 */
	public function ocdi_import_files() {
		return array(
			array(
				'import_file_name'             => 'Demo Import',
				'local_import_file'            => ES_NATIVE_DIR . 'demo-content/demo-content.xml',
				'local_import_widget_file'     => ES_NATIVE_DIR . 'demo-content/widgets.wie',
				'import_notice'                => __( 'After you import this demo, you will have to setup the revolution slider separately and add MailChimp settings.', 'es-native' ),
			)
		);
	}

	/**
	 * Assign menus and front page.
	 */
	public function ocdi_after_import_setup() {
		// Assign menus to their locations.
		$main_menu = get_term_by( 'slug', 'main_menu', 'nav_menu' );
		$account_menu = get_term_by( 'slug', 'account_menu', 'nav_menu' );
		$login_menu = get_term_by( 'slug', 'login_menu', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
				'main_menu' => $main_menu->term_id,
				'account_menu' => $account_menu->term_id,
				'login_menu' => $login_menu->term_id
			)
		);

		// Assign front page.
		$front_page_id = get_page_by_title( 'Home' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
	}

	/**
	 * Change listing dropdown template path.
	 *
	 * @access public
	 * @return string
	 */
	public function archive_sorting_template( $path ) {
		$path = ES_NATIVE_TEMPLATES_DIR . 'sorting-list.php';
		return $path;
	}

	/**
	 * Change subscription table template path.
	 *
	 * @access public
	 * @return string
	 */
	public function subscription_table_template_path( $path ) {
		$path = ES_NATIVE_TEMPLATES_DIR . 'subscriptions-table.php';
		return $path;
	}

	/**
	 * Initialize entity classes using specific conditions.
	 *
	 * @access public
	 * @return void
	 */
	public function init() {

		// Theme Options
		require_once( 'class-options-container.php');
		require_once( 'class-tgm-plugin-activation.php');

		global $es_native_options;
		$es_native_options = new Es_Native_Options_Container();

		// Theme Options
		require_once( ES_NATIVE_ADMIN_DIR . 'class-options-page.php');
		Native_Options_Page::get_instance();

		// Contact Form.
		require_once( ES_NATIVE_INC_DIR . 'class-contact-form.php');

		// Es Native Widget.
		require_once( ES_NATIVE_WIDGETS_DIR . 'class-native-widget.php');

		// Latest News Widget.
		require_once( ES_NATIVE_WIDGETS_DIR . 'class-latest-news-widget.php');

		// Properties List Widget.
		require_once( ES_NATIVE_WIDGETS_DIR . 'class-properties-widget.php');

		// Recent Posts Widget.
		require_once( ES_NATIVE_WIDGETS_DIR . 'class-recent-posts-widget.php');

		// Banners Widget.
		require_once( ES_NATIVE_WIDGETS_DIR . 'class-banners-widget.php');

		// Menu Widget.
		require_once( ES_NATIVE_WIDGETS_DIR . 'class-nav-menu-widget.php');

		// Hot Property Widget.
		require_once( ES_NATIVE_WIDGETS_DIR . 'class-hot-property-widget.php');

		// Page Teaser Widget.
		require_once( ES_NATIVE_WIDGETS_DIR . 'class-page-teaser-widget.php');

		// Color calculation class.
		require_once( ES_NATIVE_INC_DIR . 'Color.php');
	}

	/**
	 * The theme setup function.
	 *
	 * @access public
	 * @return void
	 */
	public function theme_setup() {

		// Post formats.
		add_theme_support(
			'post-formats',
			array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery' )
		);

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'menus' );

		add_theme_support( 'title-tag' );

	}

	/**
	 * Adds support for the WordPress 'custom-background' theme feature.
	 *
	 * @access public
	 * @return void
	 */
	public function custom_background_setup() {

		add_theme_support(
			'custom-background',
			array(
				'default-color'    => 'ffffff',
			)
		);
	}

	/**
	 * Load text domain.
	 *
	 * @access public
	 * @return void
	 */
	public function load_text_domain() {
		load_theme_textdomain( 'es-native', get_template_directory() . '/languages' );
	}

	/**
	 * Registers nav menus.
	 *
	 * @access public
	 * @return void
	 */
	public function register_menus() {

		register_nav_menus( array(
			'main_menu' => __( 'Main Menu', 'es-native' ),
			'account_menu' => __( 'Account Menu', 'es-native' ),
			'login_menu' => __( 'Login Menu', 'es-native' ),
		) );
	}

	/**
	 * Registers post types.
	 *
	 * @access public
	 * @return void
	 */
	public function register_post_types() {
		// News post type.
		$labels = array(
			'name'               => _x( 'News', 'post type general name', "es-native" ),
			'singular_name'      => _x( 'News', 'post type singular name', "es-native" ),
			'add_new'            => _x( 'Add New', 'News', "es-native" ),
			'add_new_item'       => __( 'Add New News', "es-native" ),
			'edit_item'          => __( 'Edit News', "es-native" ),
			'new_item'           => __( 'New News', "es-native" ),
			'all_items'          => __( 'All News', "es-native" ),
			'view_item'          => __( 'View News', "es-native" ),
			'search_items'       => __( 'Search News', "es-native" ),
			'not_found'          => __( 'No News found', "es-native" ),
			'not_found_in_trash' => __( 'No News found in the Trash', "es-native" ),
			'parent_item_colon'  => '',
			'menu_name'          => 'News'
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'News',
			'public'        => true,
			'menu_position' => 5,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'has_archive'   => true,
			'taxonomies' => array('category', 'post_tag'),
			'show_in_nav_menus' => true
		);
		register_post_type( 'news', $args );
	}

	/**
	 * Add metaboxes.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function add_meta_boxes() {
		add_meta_box('button_label', __( 'Button Label', 'es-native' ), array( $this, 'page_fields' ), 'page');
	}

	/**
	 * Callback function for page fields.
	 *
	 * @access public
	 * @param WP_Post $post Post object.
	 * @return void
	 */
	public function page_fields( $post ) {
		wp_nonce_field( 'es_native_page_box_nonce', 'es_native_page_box_nonce' );

		$button_label = get_post_meta( $post->ID, 'page_button_label', true );

		echo '<div class="es-settings-field"><label for="page[button_label]"><span class="es-settings-label">';
		_e( 'Button link label', 'es-native' );
		echo '</span></label> ';
		echo '<input type="text" id="button_link_label" name="page[button_label]"';
		echo ' value="' . esc_attr( $button_label ) . '" size="25" /></div>';
	}

	/**
	 * Save pages callback.
	 *
	 * @access public
	 * @param int $post_id ID.
	 * @return void
	 */
	public function save_pages( $post_id) {
		if ( ! isset( $_POST['es_native_page_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['es_native_page_box_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'es_native_page_box_nonce' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;

		$data = $_POST['page'];

		foreach ( $data as $key => $field) {
			$value = sanitize_text_field( $field );
			update_post_meta( $post_id, 'page_' . $key, $value );
		}

	}

	/**
	 * Registers scripts/styles.
	 *
	 * @access public
	 * @return void
	 */
	public function register_scripts() {
		global $es_native_options, $es_settings;
		// Register scripts.

		// Form validation script.
		wp_register_script( 'es-native-validetta', ES_NATIVE_VENDOR_SCRIPTS_URL . 'validetta/validetta.min.js',
			array( 'jquery' ), null, true );
		wp_enqueue_script( 'es-native-validetta' );

		// Mobile-menu.
		wp_register_script( 'es-sidr', ES_NATIVE_VENDOR_SCRIPTS_URL . 'sidr/dist/jquery.sidr.min.js',
			array( 'jquery' ), null, true );
		wp_enqueue_script( 'es-sidr' );

		wp_register_script( 'es-native-magnific', ES_NATIVE_VENDOR_SCRIPTS_URL . 'magnific-popup/dist/jquery.magnific-popup.min.js',
			array( 'jquery' ), null, true );
		wp_enqueue_script( 'es-native-magnific' );

		$deps = array ( 'jquery', 'es-native-magnific', 'es-slick-script', 'es-menu-js' );

		if ( ! empty( $es_settings->google_api_key ) ) {
			$deps[] = 'es-admin-map-script';
		}

		if ( wp_script_is( 'es-rating-admin-script', 'registered' ) ) {
			$deps[] = 'es-rating-admin-script';
		}

		if ( wp_script_is( 'es-share-script', 'registered' ) ) {
			$deps[] = 'es-share-script';
		}

		// Viewport-checker.
		wp_register_script( 'es-native-viewport-checker',
			ES_NATIVE_VENDOR_SCRIPTS_URL . 'viewport-checker/dist/jquery.viewportchecker.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'es-native-viewport-checker' );

		wp_register_script( 'es-native', ES_NATIVE_CUSTOM_SCRIPTS_URL . 'theme.js', array(
			'jquery',
			'es-native-validetta',
			'es-native-viewport-checker',
			'es-sidr'
		), null, true );
		wp_enqueue_script( 'es-native' );

		wp_localize_script( 'es-native', 'Es_Native', static::register_js_variables() );

		// Register styles.
		wp_enqueue_style( 'es-native-reset', ES_NATIVE_CUSTOM_STYLES_URL . 'reset.css' );
		wp_enqueue_style( 'es-native-validetta', ES_NATIVE_VENDOR_SCRIPTS_URL . 'validetta/validetta.min.css' );
		wp_enqueue_style( 'es-native-magnific', ES_NATIVE_VENDOR_SCRIPTS_URL . 'magnific-popup/dist/magnific-popup.css' );

		wp_enqueue_style( 'es-native-style', ES_NATIVE_CUSTOM_STYLES_URL . 'style.css' );
		wp_enqueue_style( 'es-native-awesome', ES_NATIVE_FONTS_URL . 'font-awesome/css/font-awesome.min.css' );

	}

	/**
	 * Deregisters plugins properties single styles.
	 *
	 * @access public
	 * @return void
	 */
	public function remove_es_front_single_style() {
		wp_dequeue_style( 'estatik-calc-css-rangeslider-normalize' );
		wp_deregister_style( 'estatik-calc-css-rangeslider-normalize');
	}

	/**
	 * Register global javascript variables.
	 *
	 * @access public
	 * @return array
	 */
	public static function register_js_variables()
	{
		global $es_native_options;
		return apply_filters( 'es_native_global_js_variables', array(
			'map' => array(
				'contact_address' => $es_native_options->contact_address,
			),
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		) );
	}

	/**
	 * Register theme sidebars.
	 *
	 * @access public
	 * @return void
	 */
	public function register_sidebars() {
		register_sidebar( array(
			'name'          => __( 'Content Sidebar Right', 'es-native' ),
			'id'            => 'content-sidebar',
			'description'   => __( 'Add widgets at the right side on the content', 'es-native' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Page Sidebar Right', 'es-native' ),
			'id'            => 'page-sidebar-right',
			'description'   => __( 'Add widgets at the right side on the pages.', 'es-native' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Property Sidebar', 'es-native' ),
			'id'            => 'property-sidebar',
			'description'   => __( 'Add widgets at the right or left side on the properties.', 'es-native' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Content Top Sidebar', 'es-native' ),
			'id'            => 'content-top-sidebar',
			'description'   => __( 'Add widgets above the content after title.', 'es-native' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Top Sidebar', 'es-native' ),
			'id'            => 'top-sidebar',
			'description'   => __( 'Add widgets above the content.', 'es-native' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
        register_sidebar( array(
			'name'          => __( 'Top Wide Sidebar', 'es-native' ),
			'id'            => 'top-wide-sidebar',
			'description'   => __( 'Add widgets above the content on full window width.', 'es-native' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Top Banner Sidebar', 'es-native' ),
			'id'            => 'top-banner-sidebar',
			'description'   => __( 'Add widgets at the top of page with template Page with top Estatik search.', 'es-native' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Bottom Wide Sidebar', 'es-native' ),
			'id'            => 'bottom-sidebar',
			'description'   => __( 'Add widgets below the content.', 'es-native' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Bottom Color Wide Sidebar', 'es-native' ),
			'id'            => 'bottom-color-sidebar',
			'description'   => __( 'Add widgets below the content in color section.', 'es-native' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

	}

	/**
	 * Register theme widgets.
	 *
	 * @access public
	 * @return void
	 */
	public function register_widgets() {
		register_widget('Es_Native_Latest_News_Widget');
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if ( class_exists( 'Estatik' ) ) {
			register_widget('Es_Native_Properties_Widget');
		}
		register_widget('Es_Native_Banners_Widget');

		unregister_widget('WP_Nav_Menu_Widget');
		register_widget('Es_Native_Nav_Menu_Widget');
		register_widget('Es_Native_Recent_Posts_Widget');
		register_widget('Es_Native_Hot_Property_Widget');
		register_widget('Es_Native_Page_Teaser_Widget');
	}

	/**
	 * Return estatik logo markup.
	 *
	 * @return string;
	 */
	public static function get_logo() {
		ob_start();

		echo "<div class='es-logo clearfix'><img src='" . ES_NATIVE_ADMIN_IMAGES_URL . 'logo.png' . "'><br>
            <span class='es-version'>" . __( 'Ver', 'es-native' ) . ". " . self::getVersion() .  "</span></div>";

		return ob_get_clean();
	}

	/**
	 * Change archive and categories page titles.
	 *
	 * @access public
	 * @return title
	 */
	public function get_the_archive_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( 'Tag: ', false );
		} elseif ( is_author() ) {
			$title = get_the_author();
		} elseif ( is_year() ) {
			$title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
		} elseif ( is_month() ) {
			$title = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
		} elseif ( is_day() ) {
			$title = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		} else {
			$title = __( 'Archives', 'es-native' );
		}
		return $title;
	}

	/**
	 * Change amount of news per page.
	 *
	 * @access public
	 * @return string $title
	 */
	public function news_posts_per_page( $query ) {
		global $es_native_options;
		if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'news' ) ) {
			$query->set( 'posts_per_page', $es_native_options->news_per_page );
		}
	}



	/**
	 * Registers image sizes.
	 *
	 * @access public
	 * @return void
	 */
	public function register_image_sizes() {

		add_image_size( 'native-archive', 800, 200, true );
		add_image_size( 'single-blog-image', 734, 180, true );
		add_image_size( 'agent-image-size', 265, 352, false );
		add_image_size( 'thumbnail_372x218', 372, 218, true );
		add_image_size( 'thumbnail_372x103', 372, 103, true );
		add_image_size( 'full-search-background', 1210, 490, true );
	}

	/**
	 * Change excerpt more.
	 *
	 * @access public
	 * @return string
	 */
	public function excerpt_more( $more ) {
		return '...';
	}

	/**
	 * Change theme main color.
	 *
	 * @access public
	 * @return string
	 */
	public function customize_theme_color() {
		require_once( ES_NATIVE_CUSTOM_STYLES_DIR . 'custom-css.php' );

	}

	/**
	 * Breadcrumbs function.
	 *
	 * @access public
	 * @return string
	 */
	public static function breadcrumbs() {
		/* === OPTIONS === */
		$text['home']     = __( 'Home', 'es-native' ); // text for the 'Home' link
		$text['search']   = __( 'Search Results for "%s" Query', 'es-native' ); // text for a search results page
		$text['author']   = __( 'Articles Posted by %s', 'es-native' ); // text for an author page
		$text['404']      = __( 'Error 404', 'es-native' ); // text for the 404 page
		$showCurrent      = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$showOnHome       = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter        = ' &#8594; '; // delimiter between crumbs
		$before           = '<span class="current">'; // tag before the current crumb
		$after            = '</span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;
		$homeLink   = get_bloginfo( 'url' ) . '/';
		$linkBefore = '<span>';
		$linkAfter  = '</span>';
		$link       = $linkBefore . '<a href="%1$s">%2$s</a>' . $linkAfter;

		if ( is_home() || is_front_page() ) {
			if ( $showOnHome == 1 )
				echo '<div><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';
		} else {
			echo '<div>' . sprintf( $link, $homeLink, $text['home'] ) . $delimiter;

			if ( is_category() ) {
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) {
					$cats = get_category_parents( $thisCat->parent, true, $delimiter );
					$cats = str_replace( '<a', $linkBefore . '<a', $cats );
					$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
					echo $cats;
				}
				echo $before . single_cat_title( '', false ) . $after;
			} elseif ( is_tax() ) {
				echo $before . single_cat_title( '', false ) . $after;
			} elseif ( is_search() ) {
				echo $before . sprintf( $text['search'], get_search_query() ) . $after;
			} elseif ( is_day() ) {
				echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
				echo sprintf( $link, get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ) ) . $delimiter;
				echo $before . get_the_time( 'd' ) . $after;
			} elseif ( is_month() ) {
				echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
				echo $before . get_the_time( 'F' ) . $after;
			} elseif ( is_year() ) {
				echo $before . get_the_time( 'Y' ) . $after;
			} elseif ( is_single() && ! is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object( get_post_type() );
					$slug      = $post_type->rewrite;
					printf( $link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name );
					if ( $showCurrent == 1 )
						echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat  = get_the_category();
					$cat  = $cat[0];
					$cats = get_category_parents( $cat, true, $delimiter );
					if ( $showCurrent == 0 )
						$cats = preg_replace( "#^(.+)$delimiter$#", "$1", $cats );
					$cats = str_replace( '<a', $linkBefore . '<a' , $cats );
					$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
					echo $cats;
					if ( $showCurrent == 1 )
						echo $before . get_the_title() . $after;
				}
			} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() ) {
				$post_type = get_post_type_object( get_post_type() );
				echo $before . $post_type->labels->singular_name . $after;
			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				$cat    = get_the_category( $parent->ID );
				$cat    = $cat[0];
				$cats   = get_category_parents( $cat, true, $delimiter );
				$cats   = str_replace( '<a', $linkBefore . '<a', $cats );
				$cats   = str_replace( '</a>', '</a>' . $linkAfter, $cats );
				echo $cats;
				printf( $link, get_permalink( $parent ), $parent->post_title );
				if ( $showCurrent == 1 )
					echo $delimiter . $before . get_the_title() . $after;
			} elseif ( is_page() && ! $post->post_parent ) {
				if ( $showCurrent == 1 )
					echo $before . get_the_title() . $after;
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id   = $post->post_parent;
				$breadcrumbs = array();
				while ( $parent_id ) {
					$page          = get_post( $parent_id );
					$breadcrumbs[] = sprintf( $link, get_permalink( $page->ID ), get_the_title( $page->ID ) );
					$parent_id     = $page->post_parent;
				}
				$breadcrumbs = array_reverse( $breadcrumbs );
				for ( $i = 0; $i < count( $breadcrumbs ); $i ++ ) {
					echo $breadcrumbs[ $i ];
					if ( $i != count( $breadcrumbs ) - 1 )
						echo $delimiter;
				}
				if ( $showCurrent == 1 )
					echo $delimiter . $before . get_the_title() . $after;
			} elseif ( is_tag() ) {
				echo $before . single_tag_title( '', false ) . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo $before . sprintf( $text['author'], $userdata->display_name ) . $after;
			} elseif ( is_404() ) {
				echo $before . $text['404'] . $after;
			}
			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
					echo ' (';
				echo __( 'Page', 'es-native' ) . ' ' . get_query_var( 'paged' );
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
					echo ')';
			}
			echo '</div>';
		}

	}

    /**
     * Change search properties template path.
     *
     * @access public
     * @return string
     */
    public function template_loader( $template ) {
        $find = array();

        if ( function_exists( 'es_get_property' ) ) {
            $property = es_get_property( null );
            $type = $property::get_post_type_name();

                // If search page.
            if ( is_search() && ! is_admin() && isset( $_GET['post_type'] ) && $_GET['post_type'] == $type ) {
                $file = 'search-properties.php';
            }

            if ( ! empty( $file ) ) {
                $find[] = ES_NATIVE_TEMPLATES_DIR . $file;

                $template = locate_template( array_unique( $find ) );
                if ( ! $template ) {
                    $template = ES_NATIVE_TEMPLATES_DIR . $file;
                }
            }
        }


        return $template;
    }

    /***
     * Change pagination template
     * @param $template
     * @param $class
     * @return string
     */
    public function navigation_template( $template, $class ){
        return '<nav class="navigation %1$s" role="navigation">
                    <div class="native-nav-links">%3$s</div>
                </nav>';
    }

}

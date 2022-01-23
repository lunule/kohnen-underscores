<?php

/**
 * starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kohnen
 */

if (!function_exists('kohnen_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kohnen_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on starter, use a find and replace
		 * to change 'kohnen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('kohnen', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'kohnen'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'kohnen_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 145,
				'width'       => 280,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'kohnen_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kohnen_content_width()
{
	$GLOBALS['content_width'] = apply_filters('kohnen_content_width', 1100);
}
add_action('after_setup_theme', 'kohnen_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kohnen_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'kohnen'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'kohnen'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);	

}
add_action('widgets_init', 'kohnen_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function kohnen_scripts() {

	global $post;

	$style_dep_Arr = array();

	if ( is_front_page() && !is_posts_page() ) :

		wp_enqueue_style(
			'kohnen-lightslider', 
			get_stylesheet_directory_uri() . '/css/lightslider.min.css', 
			null, 
			false,
			'all'
		);

		array_push( $style_dep_Arr, 'kohnen-lightslider');				

	endif;

	wp_enqueue_style(
		'starter-style', 
		get_stylesheet_uri(), 
		$style_dep_Arr, 
		false,
		'all'
	);

	if ( is_default_theme_content() ) :

		wp_enqueue_style(
			'starter-default-theme-styles', 
			get_stylesheet_directory_uri() . '/css/styles-default.css', 
			$style_dep_Arr, 
			array( 'starter-style' ),
			'all'
		);	

	endif;

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	$header_script_dep_Arr = array(
		'jquery',
	);

	$footer_script_dep_Arr = array(
		'jquery',
	);

	wp_enqueue_script( 
		'kohnen-isinviewport', 
		get_stylesheet_directory_uri() . '/js/isinviewport.min.js', 
		array('jquery'),
		false, 
		false, 
	);	
	array_push( $header_script_dep_Arr, 'kohnen-isinviewport');
	array_push( $footer_script_dep_Arr, 'kohnen-isinviewport');	

	if ( is_posts_page() ) :

		wp_enqueue_script( 
			'kohnen-muuri', 
			get_stylesheet_directory_uri() . '/js/muuri.min.js', 
			array(
				'jquery'
			),
			false, 
			false, 
		);

		wp_enqueue_script( 
			'kohnen-web-animations', 
			get_stylesheet_directory_uri() . '/js/web-animations.min.js', 
			array(
				'jquery'
			), 
			false, 
			false, 
		);

		array_push( $header_script_dep_Arr, 'kohnen-muuri');
		array_push( $header_script_dep_Arr, 'kohnen-web-animations');		

	endif;

	if ( is_front_page() && !is_posts_page() ) :

		wp_enqueue_script( 
			'kohnen-tabslet', 
			get_stylesheet_directory_uri() . '/js/jquery.tabslet.min.js', 
			array(
				'jquery'
			),
			false, 
			true, 
		);

		wp_enqueue_script( 
			'kohnen-lightslider', 
			get_stylesheet_directory_uri() . '/js/lightslider.min.js', 
			array(
				'jquery'
			), 
			false, 
			true, 
		);

		array_push( $footer_script_dep_Arr, 'kohnen-tabslet');
		array_push( $footer_script_dep_Arr, 'kohnen-lightslider');		

	endif;

	if ( is_contact_page() ) :

		wp_enqueue_script( 
			'kohnen-init-google-map', 
			get_stylesheet_directory_uri() . '/js/init-google-map.js', 
			array(
				'jquery'
			), 
			false, 
			true, 
		);

	    wp_localize_script( 'kohnen-init-google-map', 'kohnen',
	        array( 
	            'googleMapsKey' => get_field('google_maps_key') 
	            					? get_field('google_maps_key')
	            					: 'AIzaSyCYjJ4QWKI8OIrMkjcOcghv-YRVmqTtDKE',
	            'siteurl' => site_url(),
	        )
	    );	    	

		array_push( $footer_script_dep_Arr, 'kohnen-init-google-map');

	endif;

	wp_enqueue_script( 
		'kohnen-global-header', 
		get_stylesheet_directory_uri() . '/js/global-to-header.js', 
		$header_script_dep_Arr, 
		false, 
		false, 
	);

	wp_enqueue_script( 
		'kohnen-global-footer', 
		get_stylesheet_directory_uri() . '/js/global-to-footer.js', 
		$footer_script_dep_Arr, 
		false, 
		true 
	);

    wp_localize_script( 'kohnen-global-footer', 'kohnen',
        array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'siteurl' => site_url(),
        )
    );	

}
add_action('wp_enqueue_scripts', 'kohnen_scripts');

// add async and defer attributes to enqueued scripts
function kohnen_script_loader_tag($tag, $handle, $src) {
	
	$scripts_to_defer_Arr = array(
		'kohnen-isinviewport',
		'kohnen-muuri',
		'kohnen-web-animations',
		'kohnen-global-header',
		'kohnen-global-footer',
	);

	if ( in_array( $handle, $scripts_to_defer_Arr ) ) {
		
		if (false === stripos($tag, 'async')) {
			
			$tag = str_replace(' src', ' async="async" src', $tag);
			
		}
		
		if (false === stripos($tag, 'defer')) {
			
			$tag = str_replace('<script ', '<script defer ', $tag);
			
		}
		
	}
	
	return $tag;
	
}
//add_filter('script_loader_tag', 'kohnen_script_loader_tag', 10, 3);

function kohnen_google_maps_api_key_to_header() {

	if ( is_contact_page() ) :

		$key = get_field('google_maps_key') 
				? get_field('google_maps_key')
				: 'AIzaSyCYjJ4QWKI8OIrMkjcOcghv-YRVmqTtDKE';

	    $output='<script src="https://maps.googleapis.com/maps/api/js?key=' . $key . '"></script>';
	    echo $output;

	endif;

}
add_action( 'wp_head', 'kohnen_google_maps_api_key_to_header', -1000 );

/*Custom Post type start*/
function custom_post_type_services()
{
	$supports = array(
		'title', // post title
		'editor', // post content
		'author', // post author
		'thumbnail', // featured images
		'excerpt', // post excerpt
		'custom-fields', // custom fields
		'revisions', // post revisions
		'page-attributes',
		'post-formats', // post formats
	);
	$labels = array(
		'name' => _x('services', 'plural'),
		'singular_name' => _x('service', 'singular'),
		'menu_name' => _x('Services', 'admin menu'),
		'name_admin_bar' => _x('services', 'admin bar'),
		'add_new' => _x('Add Service', 'add new'),
		'add_new_item' => __('Add New Services'),
		'new_item' => __('New Service'),
		'edit_item' => __('Edit Services'),
		'view_item' => __('View Services'),
		'all_items' => __('All Services'),
		'search_items' => __('Search Services'),
		'not_found' => __('No Services found.'),
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'publicly_queryable'  => false,
		'query_var' => true,
		'rewrite' => array('slug' => 'services'),
		'has_archive' => false,
		'show_in_rest' => true,
		'show_in_graphql' => true,
		'graphql_single_name' => 'service',
		'graphql_plural_name' => 'services',
		'hierarchical' => false,
		'menu_icon'	=> 'dashicons-text-page'
	);
	register_post_type('services', $args);

	register_taxonomy(
		'for',
		array('services'),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __('For'),
			),
			'public' => true,
			'show_admin_column' => true,
			'show_ui' => true,
			'show_in_graphql' => true,
			'graphql_single_name' => 'for',
			'graphql_plural_name' => 'fors',
			'query_var' => true
		)
	);
}
add_action('init', 'custom_post_type_services');

function custom_post_type_casestudies()
{
	$supports = array(
		'title', // post title
		'editor', // post content
		'author', // post author
		'thumbnail', // featured images
		'excerpt', // post excerpt
		'custom-fields', // custom fields
		'revisions', // post revisions
		'page-attributes',
		'post-formats', // post formats
	);
	$labels = array(
		'name' => _x('casestudies', 'plural'),
		'singular_name' => _x('casestudy', 'singular'),
		'menu_name' => _x('Case Studies', 'admin menu'),
		'name_admin_bar' => _x('Case Studies', 'admin bar'),
		'add_new' => _x('Add Case Study', 'add new'),
		'add_new_item' => __('Add New Case Study'),
		'new_item' => __('New Case Study'),
		'edit_item' => __('Edit Case Study'),
		'view_item' => __('View Case Study'),
		'all_items' => __('All Case Studies'),
		'search_items' => __('Search Case Studies'),
		'not_found' => __('No Case Studies found.'),
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'casestudies'),
		'has_archive' => false,
		'show_in_rest' => true,
		'show_in_graphql' => true,
		'graphql_single_name' => 'casestudy',
		'graphql_plural_name' => 'casestudies',
		'hierarchical' => false,
		'menu_icon'	=> 'dashicons-analytics'
	);
	register_post_type('casestudies', $args);
}
add_action('init', 'custom_post_type_casestudies');

function custom_post_type_team()
{
	$supports = array(
		'title', // post title
		'editor', // post content
		'author', // post author
		'thumbnail', // featured images
		'excerpt', // post excerpt
		'custom-fields', // custom fields
		'revisions', // post revisions
		'page-attributes',
		'post-formats', // post formats
	);
	$labels = array(
		'name' => _x('teammembers', 'plural'),
		'singular_name' => _x('team', 'singular'),
		'menu_name' => _x('Team Members', 'admin menu'),
		'name_admin_bar' => _x('Team Members', 'admin bar'),
		'add_new' => _x('Add Team Member', 'add new'),
		'add_new_item' => __('Add New Team Member'),
		'new_item' => __('New Team Member'),
		'edit_item' => __('Edit Team Member'),
		'view_item' => __('View Team Member'),
		'all_items' => __('All Team Members'),
		'search_items' => __('Search Team Members'),
		'not_found' => __('No Team Members found.'),
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'publicly_queryable'  => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'teammembers'),
		'has_archive' => false,
		'show_in_rest' => true,
		'show_in_graphql' => true,
		'graphql_single_name' => 'team',
		'graphql_plural_name' => 'teammembers',
		'hierarchical' => false,
		'menu_icon'	=> 'dashicons-groups'
	);
	register_post_type('team', $args);
}
add_action('init', 'custom_post_type_team');

/**
 * Disable term archives
 */
add_action('pre_get_posts', function($qry) {

    if ( is_admin() ) 
    	return;

    $taxes_Arr = array(
    	'for',
    );

    foreach( $taxes_Arr as $tax ) :

        if (
        		is_tax( $tax )
        	)
            $qry->set_404();

  	endforeach;

});

// Modify search form query
function kohnen_search_filter($query) {

    if ($query->is_search && !is_admin()) {
        $query->set(
        	'post_type', 
        	[
        		'page', 
        		'post',
        		'casestudies',
        	]
        );
    }

    return $query;
}

add_filter('pre_get_posts', 'kohnen_search_filter');

@ini_set('upload_max_size', '32M');
@ini_set('post_max_size', '32M');
@ini_set('max_execution_time', '300');

/**
 * Reset image quality.
 */
add_filter('jpeg_quality', function($arg){return 100;});

/**
 * Implement the Custom Header.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * ACF functions
 */
require get_template_directory() . '/inc/kohnen-acf.php';

/**
 * Social meta tags (Open Graph).
 */
require get_template_directory() . '/inc/kohnen-seo-opengraph-meta.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Set up constants and globals
 * ----------------------------
 */

$sidebar_enabled = false;

// Update the $sidebar_enabled global value on template_redirect
function update_sidebar_enabled() {

	global $post, $sidebar_enabled;

	if (	
			function_exists('acf_add_options_page') &&
			(
				( 
					is_singular() && 
					!is_posts_page() &&
					( true == get_field('enable_sidebar', $post->ID ) ) 
				) ||
				(
					is_posts_page() &&
					( true == get_field('enable_sidebar_blog', 'option') )
				) ||
				(
					is_post_type_archive() &&
					( true == get_field('enable_sidebar_pt', 'option') )
				) ||
				(
					is_archive() &&
					!is_post_type_archive() &&
					( true == get_field('enable_sidebar_tax', 'option') )
				)
			)
	   )
		$sidebar_enabled = true; 

	//var_dump( $sidebar_enabled );

}
add_action('template_redirect', 'update_sidebar_enabled', 9999);

$fb_app_id 			= function_exists('acf_add_options_page')
						? get_field('fb_app_id', 'option')
						: 0;

$twitter_handle 	= function_exists('acf_add_options_page')
						? get_field('twitter_handle', 'option')
						: '';

define( 'FB_APP_ID', 		$fb_app_id );	
define( 'TWITTER_HANDLE', 	$twitter_handle );
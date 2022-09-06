<?php
/**
 * Zozothemes functions and definitions
 *
 * @package Zozothemes
 */

// Set path to theme specific functions
$library_path = get_template_directory() . '/lib/';
$includes_path = get_template_directory() . '/includes/';
$admin_path = get_template_directory() . '/framework/admin/';

// Define path to theme specific functions 
define( 'GOSOLAR_LIBRARY', $library_path );
define( 'GOSOLAR_INCLUDES', $includes_path ); 
define( 'GOSOLAR_FRAMEWORK_PATH', get_template_directory() . '/framework' );
define( 'GOSOLAR_ADMIN', get_template_directory() . '/admin' );
define( 'GOSOLAR_ADMIN_URL', get_template_directory_uri() . '/admin' );
define( 'GOSOLAR_THEME_URL', get_template_directory_uri() );
define( 'GOSOLAR_THEME_DIR', get_template_directory() );
define( 'GOSOLAR_VC_ACTIVE', class_exists( 'Vc_Manager' ) );
define( 'GOSOLAR_REVSLIDER_ACTIVE', class_exists( 'RevSlider' ) );
define( 'GOSOLAR_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );

function gosolar_check_registered_post_types() {
    // types will be a list of the post type names
    $types = get_post_types( array('_builtin' => false) );
	
	if( in_array( 'zozo_testimonial', $types ) ) {
		define( 'GOSOLAR_TESTIMONIAL_ACTIVE', true );
	} else {
		define( 'GOSOLAR_TESTIMONIAL_ACTIVE', false );
	}
	
	if( in_array( 'zozo_team_member', $types ) ) {
		define( 'GOSOLAR_TEAM_ACTIVE', true );
	} else {
		define( 'GOSOLAR_TEAM_ACTIVE', false );
	}
	
} 

add_action( 'init', 'gosolar_check_registered_post_types' );
 
/**
 * Theme Framework
 */
require GOSOLAR_FRAMEWORK_PATH . '/framework.php';  

/**
 * Register Sidebar
 */
require GOSOLAR_INCLUDES . 'sidebar-register.php'; 

/**
 * Theme Actions and Filters
 */
require GOSOLAR_INCLUDES . 'theme-filters.php';

/**
 * Theme Functions
 */
require GOSOLAR_INCLUDES . 'theme-functions.php';

/**
 * Admin Custom Meta Boxes
 */
require GOSOLAR_INCLUDES . 'metaboxes.php'; 

/**
 * Admin Custom Meta Box Fields
 */
require GOSOLAR_INCLUDES . 'register-metabox-types.php'; 

/**
 * Bootstrap Library Files
 */
require GOSOLAR_LIBRARY . 'wp_bootstrap_navwalker.php'; 

/**
 * Sidebar Generator
 */
require GOSOLAR_INCLUDES . 'plugins/sidebar-generator/sidebar_generator.php';  

/**
 * Woocommerce Config
 */
if( class_exists('WooCommerce') ) {
	require GOSOLAR_INCLUDES . 'woo-functions.php';
}

/**
 * Mega Menu Framework
 */
$mega_opt = gosolar_get_theme_option( 'zozo_menu_type' );
if( $mega_opt == 'megamenu' ) require GOSOLAR_ADMIN . '/walker/custom_menu.php';

/**
 * Breadcrumbs
 */
require GOSOLAR_INCLUDES . 'class-breadcrumbs.php';  

/**
 * Demo Importer
 */
include GOSOLAR_INCLUDES . 'plugins/importer/zozo-importer.php'; 

/**
 * TGM Plugin Activation
 */
require_once GOSOLAR_FRAMEWORK_PATH . '/plugins-activation/init.php';  

/**
 * Ratings Plugin
 */
require_once GOSOLAR_INCLUDES . 'class-zozo-item-ratings.php';  

gosolar_item_ratings_init();
function gosolar_item_ratings_init() {
	
	//Init vars
	$config_options = array();
								
	//Set post types option
	$_post_types = array();
	$_post_types = array('zozo_testimonial');
	
	$_min_level = 0;
	$_max_level = 5;
	
	$config_options[] = array(
		'meta_key'			=>	'zozo_author_rating',
		'name'				=>	esc_html__( 'Rating', 'gosolar' ),
		'disable_on_update'	=>	FALSE,
		'max_rating_size'	=> 	(int) $_max_level,
		'min_rating_size'	=> 	(int) $_min_level,
		'active_post_types'	=>	$_post_types
	);
	
	//Instatiate plugin class and pass config options array
	new GoSolarItemRatings( $config_options );
}

/**
 * Visual Composer
 */
include GOSOLAR_INCLUDES . 'visual-composer/visual-composer.php'; 

/*Theme Option Default Values*/
if( ! class_exists( 'GoSolarthemesCore_Plugin' ) ) {
	require GOSOLAR_INCLUDES . 'theme-default.php';
}
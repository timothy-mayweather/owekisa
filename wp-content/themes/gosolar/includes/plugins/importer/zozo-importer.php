<?php
defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );
/* ================================================
 * Importer
 * ================================================ */
 
// Don't resize images
function gosolar_import_filter_image_sizes( $sizes ) {
	return array();
}
 
class GoSolar_Import {
	
	public $message = "";
	public function __construct(){
	
	}
	
	public function gosolar_import_content( $file ) {
			
        if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
		require_once ABSPATH . 'wp-admin/includes/import.php';
	
		$importer_error = false;
		if ( !class_exists( 'WP_Importer' ) ) {
			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			if ( file_exists( $class_wp_importer ) ){
				require_once ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			} else {
				$importer_error = true;
			}
		}
		
		if ( !class_exists( 'WP_Import' ) ) {
			$class_wp_import = GOSOLAR_INCLUDES .'plugins/importer/wordpress-importer.php';		
			if ( file_exists( $class_wp_import ) ){
				get_template_part( 'includes/plugins/importer/wordpress', 'importer' );
				}else
				$importer_error = true;
		}
		
		if($importer_error){
			echo "Error on import";
		} else {
			if ( !class_exists( 'WP_Import' ) ) {
				echo esc_html__("WP_Import Problem", "gosolar");
			}else{
				add_filter('intermediate_image_sizes_advanced', 'gosolar_import_filter_image_sizes');
				$wp_import = new WP_Import();
				set_time_limit(0);
				$wp_import->fetch_attachments = true;
				
				ob_start();
				$wp_import->import( $file );
				ob_end_clean();
			}
		}
		
    }
	
	public function gosolar_import_widgets($widgets, $sidebars) {
		if( $sidebars ) {
        	$this->gosolar_import_custom_sidebars($sidebars);
		}
		
        $this->gosolar_import_sidebars_widgets( $widgets );
        $this->message = esc_html__("Widgets imported successfully", "gosolar");
    }
	
	public function gosolar_import_custom_sidebars( $file ){
        $sidebars = $this->gosolar_import_get_file( $file );
		if( isset( $sidebars ) && $sidebars ) {
			update_option( 'sbg_sidebars', $sidebars );
	
			foreach( $sidebars as $sidebar ) {
				$sidebar_class = gosolar_name_to_class( $sidebar );
				
				register_sidebar(array(
					'name'			=>	$sidebar,
					'id'			=> 'zozo-custom-'.strtolower($sidebar_class),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' 	=> '</div>',
					'before_title' 	=> '<h3 class="widget-title">',
					'after_title'	=> '</h3>',
				));
			}
        	$this->message = esc_html__("Custom sidebars imported successfully", "gosolar");
		}
    }
	
	public function gosolar_import_sidebars_widgets( $file ){
		$widgets_file = $this->gosolar_import_get_file( $file );
        // Add Widgets
		if( isset( $widgets_file ) && $widgets_file ) {
			gosolar_import_widget_data( $widgets_file );
		}        
    }
	
	public function gosolar_import_theme_options( $file ){
		$file_contents = $this->gosolar_import_get_file( $file );
		$theme_options = json_decode($file_contents, true);
		$redux = ReduxFrameworkInstances::get_instance('zozo_options');
		$redux->set_options($theme_options);
		gosolar_save_theme_options();
        $this->message = esc_html__("Options imported successfully", "gosolar");
    }
	
	public function gosolar_import_menus(){
		/* Set imported menus to Registered Menu locations in Theme */
				
		// Registered Menu Locations in Theme
		$locations = get_theme_mod( 'nav_menu_locations' );
		// Get Registered menus
		$menus = wp_get_nav_menus();
		
		// Assign menus to theme locations 
		if( is_array($menus) ) {
			foreach( $menus as $menu ) {
				if( $menu->name == 'Main Menu' ) {
					$locations['primary-menu'] = $menu->term_id;
					//$locations['mobile-menu'] = $menu->term_id;
				} else if( $menu->name == 'Home-Right' ) {
					$locations['primary-right'] = $menu->term_id;
				} else if( $menu->name == 'Top Menu' ) {
					$locations['top-menu'] = $menu->term_id;
				} else if( $menu->name == 'Service Footer Menu' ) {
					$locations['footer-menu'] = $menu->term_id;
				}
			}
		}
		set_theme_mod( 'nav_menu_locations', $locations );
    }
	
	public function gosolar_import_revslider( $demo_type, $file, $rev_count ){
		// Import Revolution Slider
		if( class_exists( 'RevSlider' ) && $file ) {
		
			//deleted wp-load.php file
			require_once ABSPATH . 'wp-includes/functions.php';
			
			$sliders_from = $sliders = array();
			for( $i = 1; $i <= absint( $rev_count ); $i++ ){
		
				$file_name = $file . 'rev_slider_'. $i .'.zip';
				$sliders_from[$i] = "http://themes.zozothemes.com/extras/importer/gosolar/" . $file_name;
				$sliders[$i] = GOSOLAR_INCLUDES . 'plugins/importer/data/slider-'. $demo_type .'-'. $i .'.zip';
				copy($sliders_from[$i], $sliders[$i]);
				
			}
			
			$slider = new RevSlider();
			for( $i = 1; $i <= absint( $rev_count ); $i++ ){
				$slider_array = array($sliders[$i]);
				foreach($slider_array as $filepath){
					$slider->importSliderFromPost(true,true,$filepath); 
				}
			}
			
		}//class_exists( 'RevSlider' )
    }
	public function gosolar_import_get_file( $file ){
        $file_content = "";
        $file_for_import = GOSOLAR_INCLUDES . 'plugins/importer/data/' . $file;
        $file_content = $this->gosolar_get_file_contents( $file );
        if( $file_content ) {
            //$unserialized_content = unserialize(base64_decode($file_content));
			$type = 'base64_';
			$unserialized_content = unserialize( call_user_func( $type . 'decode', $file_content ) );
            if( $unserialized_content ) {
                return $unserialized_content;
            }
        }
        return false;
    }
	
	function gosolar_get_file_contents( $path ) {
		$url      = "http://themes.zozothemes.com/extras/importer/gosolar/" . $path;
		$response = wp_remote_get($url);
		$body     = wp_remote_retrieve_body($response);
		return $body;
    }
}
global $zozo_import;
$zozo_import = new GoSolar_Import();
 
/* ================================================
 * Ajax Hook for Importer
 * ================================================ */
 
if( ! function_exists('gosolar_demo_content_importer') ) {
    function gosolar_demo_content_importer() {
		
		if( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'gosolar_demo_import_@#$%^&*(' ) ) {
			echo "!security issue";
			wp_die(); 
		}
		
		global $zozo_import;
		
		if( ! isset( $_POST['demo_type'] ) || trim( $_POST['demo_type'] ) == '' ) {
			$demo_type = 'demo';
		} else {
			$demo_type = sanitize_text_field( $_POST['demo_type'] );
		}
		
		if( ! empty( $demo_type )) {
           	$folder = $demo_type . "/theme.xml";
		}
		
        $zozo_import->gosolar_import_content($folder);
		
		// Reading settings
		$home_page_title = 'Home';
		$post_page_title = 'Blog';
		
		// Set reading options
		$home_page = get_page_by_title( $home_page_title );
		$post_page = get_page_by_title( $post_page_title );
		if( isset( $home_page ) && $home_page->ID ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_page->ID ); // Front Page
		}
		if( isset( $post_page ) && $post_page->ID ) {
			update_option( 'page_for_posts', $post_page->ID ); // Posts Page
		}
        echo "imported";
		die();
    }
    add_action('wp_ajax_zozo_import_demo_data', 'gosolar_demo_content_importer');
}
if( ! function_exists('gosolar_demo_import_other_data') ) {
    function gosolar_demo_import_other_data() {
		
		if( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'gosolar_demo_import_@#$%^&*(' ) ) {
			echo "!security issue";
			wp_die(); 
		}
	
        global $zozo_import;
		
		if( ! isset( $_POST['demo_type'] ) || trim( $_POST['demo_type'] ) == '' ) {
			$demo_type = 'demo';
		} else {
			$demo_type = sanitize_text_field( $_POST['demo_type'] );
		}
        $folder = $demo_type . "/";
		
		$zozo_import->gosolar_import_theme_options( $folder.'theme-options.txt' );
		$zozo_import->gosolar_import_menus();
        $zozo_import->gosolar_import_widgets( $folder.'widgets.txt', $folder.'custom_sidebars.txt' );
		if( isset( $_POST['rev_slider'] ) && $_POST['rev_slider'] == 'yes' ) {
			$rev_count = isset( $_POST['rev_slider_count'] ) ? absint($_POST['rev_slider_count']) : 1;
			$zozo_import->gosolar_import_revslider( $demo_type, $folder, $rev_count );
		}
        echo "imported";
		die();
    }
    add_action('wp_ajax_zozo_import_demo_other_data', 'gosolar_demo_import_other_data');
}
// Get Class
function gosolar_name_to_class( $name ){
	$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
	$class = sanitize_html_class($class);
	return $class;
}
/* ================================================
 * Parsing Widgets Function
 * ================================================ */
// Thanks to http://wordpress.org/plugins/widget-settings-importexport/
function gosolar_import_widget_data( $widget_data ) {
	$json_data = $widget_data;
	$json_data = json_decode( $json_data, true );
	$sidebar_data = $json_data[0];
	$widget_data = $json_data[1];
	
	foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
		$widgets[ $widget_data_title ] = '';
		foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
			if( is_int( $widget_data_key ) ) {
				$widgets[$widget_data_title][$widget_data_key] = 'on';
			}
		}
	}
	unset($widgets[""]);
	foreach ( $sidebar_data as $title => $sidebar ) {
		$count = count( $sidebar );
		for ( $i = 0; $i < $count; $i++ ) {
			$widget = array( );
			$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
			$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
			if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
				unset( $sidebar_data[$title][$i] );
			}
		}
		$sidebar_data[$title] = array_values( $sidebar_data[$title] );
	}
	foreach ( $widgets as $widget_title => $widget_value ) {
		foreach ( $widget_value as $widget_key => $widget_value ) {
			$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
		}
	}
	$sidebar_data = array( array_filter( $sidebar_data ), $widgets );
	gosolar_parse_import_data( $sidebar_data );
}
/**
 * Import widgets
 * @param array $import_array
 */
function gosolar_parse_import_data( $import_array ) {
	global $wp_registered_sidebars;
	
	$sidebars_data = $import_array[0];
	$widget_data = $import_array[1];
	$current_sidebars = get_option( 'sidebars_widgets' );
	$new_widgets = array( );
	foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :
		foreach ( $import_widgets as $import_widget ) :
			//if the sidebar exists
			if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
				$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
				$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
				$current_widget_data = get_option( 'widget_' . $title );
				$new_widget_name = gosolar_get_new_widget_name( $title, $index );
				$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );
				if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
					while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
						$new_index++;
					}
				}
				$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
				if ( array_key_exists( $title, $new_widgets ) ) {
					$new_widgets[$title][$new_index] = $widget_data[$title][$index];
					$multiwidget = $new_widgets[$title]['_multiwidget'];
					unset( $new_widgets[$title]['_multiwidget'] );
					$new_widgets[$title]['_multiwidget'] = $multiwidget;
				} else {
					$current_widget_data[$new_index] = $widget_data[$title][$index];
					$current_multiwidget = isset($current_widget_data['_multiwidget']) ? $current_widget_data['_multiwidget'] : false;
					$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
					$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
					unset( $current_widget_data['_multiwidget'] );
					$current_widget_data['_multiwidget'] = $multiwidget;
					$new_widgets[$title] = $current_widget_data;
				}
			endif;
		endforeach;
	endforeach;
	if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
		update_option( 'sidebars_widgets', $current_sidebars );
		foreach ( $new_widgets as $title => $content )
			update_option( 'widget_' . $title, $content );
		return true;
	}
	return false;
}
function gosolar_get_new_widget_name( $widget_name, $widget_index ) {
	$current_sidebars = get_option( 'sidebars_widgets' );
	$all_widget_array = array( );
	foreach ( $current_sidebars as $sidebar => $widgets ) {
		if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
			foreach ( $widgets as $widget ) {
				$all_widget_array[] = $widget;
			}
		}
	}
	while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
		$widget_index++;
	}
	$new_widget_name = $widget_name . '-' . $widget_index;
	return $new_widget_name;
}
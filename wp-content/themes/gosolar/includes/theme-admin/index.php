<?php // Admin Page



if( ! class_exists( 'GoSolar_Admin_Page' ) ){

	class GoSolar_Admin_Page {

	

		function __construct(){

			add_action( 'admin_init', array( $this, 'gosolar_admin_page_init' ) );	

			add_action( 'admin_menu', array( $this, 'gosolar_admin_menu') );			

			add_action( 'admin_menu', array( $this, 'gosolar_edit_admin_menus' ) );

			add_action( 'admin_head', array( $this, 'gosolar_admin_page_scripts' ) );

			add_action( 'after_switch_theme', array( $this, 'gosolar_theme_activation_redirect' ) );

		}		

		

		function gosolar_theme_activation_redirect(){

			if ( current_user_can( 'edit_theme_options' ) ) {

				header('Location:'.admin_url().'admin.php?page=gosolar'); 

			}

		}

		

		function gosolar_admin_page_init(){

			if ( current_user_can( 'edit_theme_options' ) ) {

				

				if( isset( $_GET['zozo-deactivate'] ) && $_GET['zozo-deactivate'] == 'deactivate-plugin' ) {

					check_admin_referer( 'zozo-deactivate', 'zozo-deactivate-nonce' );



					$plugins = TGM_Plugin_Activation::$instance->plugins;



					foreach( $plugins as $plugin ) {

						if( $plugin['slug'] == $_GET['plugin'] ) {

							deactivate_plugins( $plugin['file_path'] );

						}

					}

				} 

				

				if( isset( $_GET['zozo-activate'] ) && $_GET['zozo-activate'] == 'activate-plugin' ) {

					check_admin_referer( 'zozo-activate', 'zozo-activate-nonce' );



					$plugins = TGM_Plugin_Activation::$instance->plugins;



					foreach( $plugins as $plugin ) {

						if( $plugin['slug'] == $_GET['plugin'] ) {

							activate_plugin( $plugin['file_path'] );

						}

					}

				}

			}

		}

		

		function gosolar_admin_menu(){

			if ( current_user_can( 'edit_theme_options' ) ) {

				// Work around for theme check

				$zozo_menu_page = 'add_menu' . '_page';

				$zozo_submenu_page = 'add_submenu' . '_page';

			

				$welcome_screen = $zozo_menu_page( 

					'GoSolar',

					'GoSolar',

					'administrator',

					'gosolar',

					array( $this, 'gosolar_welcome_screen' ),

					'dashicons-admin-home',

					3);



				$demos = $zozo_submenu_page(

						'gosolar',

						esc_html__( 'Install GoSolar Demos', 'gosolar' ),

						esc_html__( 'Install Demos', 'gosolar' ),

						'administrator',

						'gosolar-demos',

						array( $this, 'gosolar_demos_tab' ) );



				$plugins = $zozo_submenu_page(

						'gosolar',

						esc_html__( 'Plugins', 'gosolar' ),

						esc_html__( 'Plugins', 'gosolar' ),

						'administrator',

						'zozothemes-plugins',

						array( $this, 'gosolar_themes_plugins_tab' ) );				



				add_action( 'admin_print_scripts-'.$welcome_screen, array( $this, 'gosolar_admin_screen_scripts' ) );

				add_action( 'admin_print_scripts-'.$demos, array( $this, 'gosolar_admin_screen_scripts' ) );

				add_action( 'admin_print_scripts-'.$plugins, array( $this, 'gosolar_admin_screen_scripts' ) );

			}

		}

		

		function gosolar_edit_admin_menus() {

			global $submenu;



			if ( current_user_can( 'edit_theme_options' ) ) {

				$submenu['gosolar'][0][0] = 'Welcome';

			}

		}

		

		function gosolar_welcome_screen() {

			get_template_part( 'includes/theme-admin/screens/welcome');

		}

				

		function gosolar_demos_tab() {

			get_template_part( 'includes/theme-admin/screens/install-demos');

		}

		

		function gosolar_themes_plugins_tab() {

			get_template_part( 'includes/theme-admin/screens/zozothemes-plugins');

		}

				

		function gosolar_admin_page_scripts() {

			if ( is_admin() ) {

				wp_enqueue_style( 'gosolar_admin_confirm_css', GOSOLAR_THEME_URL . '/includes/theme-admin/css/jquery-confirm.min.css' );

				wp_enqueue_script( 'gosolar_admin_confirm_js', GOSOLAR_THEME_URL . '/includes/theme-admin/js/jquery-confirm.min.js' );

			}

		}



		function gosolar_admin_screen_scripts() {

			wp_enqueue_style( 'gosolar_admin_page_css', GOSOLAR_THEME_URL . '/includes/theme-admin/css/admin-screen.css' );

			wp_enqueue_script( 'gosolar_admin_page_js', GOSOLAR_THEME_URL . '/includes/theme-admin/js/admin-screen.js' );

		}

		

	}

	new GoSolar_Admin_Page;

}
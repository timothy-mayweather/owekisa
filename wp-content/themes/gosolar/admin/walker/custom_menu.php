<?php

class GoSolarCustomMenu {



	private $gosolar_menu_fields; 



	function __construct() {

	

		$this->gosolar_menu_fields = array( 'megamenu', 'megacols', 'menuico', 'bgimg', 'bgpat', 'megafull', 'megawidget', 'megatithide' );

		

		//add custom menu styles and scripts

		add_action( 'admin_menu', array( $this, 'gosolar_menu_enqueue_scripts' ) ); 

		

		// add custom menu fields to menu

		add_filter( 'wp_setup_nav_menu_item', array( $this, 'gosolar_add_custom_nav_fields' ) );

		

		// save menu custom fields

		add_action( 'wp_update_nav_menu_item', array( $this, 'gosolar_update_custom_nav_fields'), 10, 3 );

		

		// edit menu walker

		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'gosolar_edit_walker'), 10, 2 );

		

	} // end constructor

	

	

	/**

	 * Register Megamenu stylesheets and scripts		

	 */

	function gosolar_menu_enqueue_scripts() {

		// scripts

		wp_register_script( 'gosolar-megamenu-script', get_template_directory_uri() . '/admin/js/zozo-megamenu.js' , array( 'jquery' ), false, true );

		wp_enqueue_script( 'gosolar-megamenu-script' );

		

		wp_register_style( 'gosolar-megamenu-script', get_template_directory_uri() . '/admin/css/zozo-megamenu.css');

		wp_enqueue_style( 'gosolar-megamenu-script' );

		

	}

	

	/**

	 * Add custom fields to $item nav object

	 * in order to be used in custom Walker

	 *

	 * @access      public

	 * @since       1.0 

	 * @return      void

	*/

	function gosolar_add_custom_nav_fields( $menu_item ) {

	

		//_menu_item_zozo_megamenu_menutype

		$menu_fields = $this->gosolar_menu_fields;

		

		foreach( $menu_fields as $field ){

			$menu_item->$field = get_post_meta( $menu_item->ID, '_menu_item_' . $field , true );	

		}		

	

	    return $menu_item;

	    

	}

	

	/**

	 * Save menu custom fields

	 *

	 * @access      public

	 * @since       1.0 

	 * @return      void

	*/

	function gosolar_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

	

		$cf_name_suffix = $this->gosolar_menu_fields;

		

		foreach ( $cf_name_suffix as $key ) {

			$opt_key = isset( $_REQUEST['menu-item-'.$key][$menu_item_db_id] ) ? $_REQUEST['menu-item-'.$key][$menu_item_db_id] : '' ;

			update_post_meta( $menu_item_db_id, '_menu_item_'.$key, $opt_key );

		}



	}

	

	/**

	 * Define new Walker edit

	 *

	 * @access      public

	 * @since       1.0 

	 * @return      void

	*/

	function gosolar_edit_walker($walker,$menu_id) {

	

	    return 'GoSolar_Walker_Nav_Menu_Edit';

	    

	}

	

}

// instantiate plugin's class

$FinCusMenu = new GoSolarCustomMenu();

get_template_part( 'admin/walker/edit_custom_walker' );


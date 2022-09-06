<?php



/**

 * Class Name: wp_bootstrap_navwalker

 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker

 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.

 * Version: 2.0.4

 * Author: Edward McIntyre - @twittem

 * License: GPL-2.0+

 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt

 */



class gosolar_wp_bootstrap_navwalker extends Walker_Nav_Menu {



	private $megamenu_stat = '';

	private $megamenu_megafull = '';

	private $megamenu_cols = '';

	private $megamenu_bgimg = '';

	private $megamenu_pattern = '';

	private $megamenu_megatithide = '';

	private $megamenu_widget = '';



	/**

	 * @see Walker::start_lvl()

	 * @since 3.0.0

	 *

	 * @param string $output Passed by reference. Used to append additional content.

	 * @param int $depth Depth of page. Used for padding.

	 */

	public function start_lvl( &$output, $depth = 0, $args = array() ) {

 		$indent = str_repeat( "\t", $depth );

		if( class_exists( 'GoSolar_Walker_Nav_Menu_Edit' ) ){

			if( $depth == 0 && $this->megamenu_stat == 'on' ){

				$bg_img = $this->megamenu_bgimg != '' ? $this->megamenu_bgimg : '';

				$bg_pattern = $this->megamenu_pattern != '' ? $this->megamenu_pattern : '';

				

				$bg_style = '';

				if( $bg_img != '' && $bg_pattern != '' ){

					$bg_style .= "style=\"background:url(". esc_url( $bg_pattern ) .") top left repeat, url(". esc_url( $bg_img ) .") center center no-repeat;\"";

				}elseif( $bg_img != '' ){

					$bg_style .= "style=\"background:url(". esc_url( $bg_img ) .") center center no-repeat;\"";

				}

				

				$output	 .= "\n$indent<div class=\"dropdown-menu mega-dropdown-menu container\" ". $bg_style .">\n"; //Megamenu container div start

					$output	 .= "\n$indent<ul class=\"mega-parent-ul\" role=\"menu\">\n";

			}elseif( $depth >= 0 && $this->megamenu_stat == 'on' ){

				$output .= "\n$indent<ul role=\"menu\" class=\"row mega-child-ul\">\n";

			}else{

				$output .= "\n$indent<ul role=\"menu\" class=\"dropdown-menu\">\n";

			}

		}else{

			$output .= "\n$indent<ul role=\"menu\" class=\"dropdown-menu\">\n";

		}

	}

	

	/**

	 * @see Walker::end_lvl()		 

	 *

	 * @param string $output Passed by reference. Used to append additional content.

	 * @param int $depth Depth of page. Used for padding.

	 */

	public function end_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat( "\t", $depth );

		if( class_exists( 'GoSolar_Walker_Nav_Menu_Edit' ) ){

			if( $depth == 0 && $this->megamenu_stat == 'on' ){

					$output	 .= "$indent</ul>\n";

				$output	 .= "$indent</div>\n"; //Megamenu container div end

			}else{

				$output .= "$indent</ul>\n";

			}

		}else{

			$output .= "$indent</ul>\n";

		}

	}



	/**

	 * @see Walker::start_el()

	 * @since 3.0.0

	 *

	 * @param string $output Passed by reference. Used to append additional content.

	 * @param object $item Menu item data object.

	 * @param int $depth Depth of menu item. Used for padding.

	 * @param int $current_page Menu item ID.

	 * @param object $args

	 */

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		

		$mega_child_li_class = '';

		$widget_stat = 0;

		

		if( class_exists('GoSolar_Walker_Nav_Menu_Edit') ) {

			

			if($depth == 0){

				$this->megamenu_stat = $item->megamenu;

				$this->megamenu_megafull = $item->megafull;

				$this->megamenu_bgimg = $item->bgimg;

				$this->megamenu_pattern = $item->bgpat;

			}elseif($depth == 1){

				$this->megamenu_cols = $item->megacols;

				$this->megamenu_megatithide = $item->megatithide;

				$this->megamenu_widget = $item->megawidget;

			}

			

			if ( $args->has_children ){

				if( $depth == 0 && $this->megamenu_stat == 'on' ){

					if( $this->megamenu_megafull == 'on' )

						$mega_child_li_class .= ' dropdown mega-dropdown mega-override';

					else

						$mega_child_li_class .= ' dropdown mega-dropdown';		

				}elseif( $this->megamenu_stat == 'on' && $depth == 1 ){

					$cols = absint( $this->megamenu_cols ) != 0 ? absint( $this->megamenu_cols ) : 4;

					$mega_child_li_class .= ' col-sm-' . $cols;

					$mega_child_li_class .= ' mega-child-li';

				}elseif( $this->megamenu_stat == 'on' && $depth > 1 ){

					$mega_child_li_class .= ' mega-child-inner';

				}else{

					if($depth >= 1 )

						$mega_child_li_class .= ' dropdown dropdown-submenu';

					else

						$mega_child_li_class .= ' dropdown';

				}

			}elseif( $this->megamenu_stat == 'on' && $depth == 1 && $this->megamenu_widget != '' ){

				$cols = absint( $this->megamenu_cols ) != 0 ? absint( $this->megamenu_cols ) : 4;

				$mega_child_li_class .= ' col-sm-' . $cols;

				$mega_child_li_class .= ' mega-child-li mega-widget';

				$widget_stat = 1;

			}

			

		}else{

			if($args->has_children && $depth === 0){ 

				$mega_child_li_class .= ' dropdown'; 

			}elseif($args->has_children && $depth > 0){ 

				$mega_child_li_class .= ' dropdown dropdown-submenu'; 

			}

		}



		/**

		 * Dividers, Headers or Disabled

		 * =============================

		 * Determine whether the item is a Divider, Header, Disabled or regular

		 * menu item. To prevent errors we use the strcasecmp() function to so a

		 * comparison that is not case sensitive. The strcasecmp() function returns

		 * a 0 if the strings are equal.

		 */

		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {

			$output .= $indent . '<li role="presentation" class="divider">';

		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {

			$output .= $indent . '<li role="presentation" class="divider">';

		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {

			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );

		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {

			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';

		} else {



			$class_names = $value = '';



			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$classes[] = 'menu-item-' . $item->ID;



			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			

			$class_names .= $mega_child_li_class;

			

			if ( in_array( 'current-menu-item', $classes ) )

				$class_names .= ' active';

			

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';



			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );

			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';



			$output .= $indent . '<li' . $id . $value . $class_names .'>';



			$atts = array();

			$atts['title']  = ! empty( $item->title )	? $item->title	: '';

			$atts['target'] = ! empty( $item->target )	? $item->target	: '';

			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';



			// If item has_children add atts to a.

			$atts['class'] = '';

			if ( $args->has_children && $depth === 0 ) {

				$atts['href'] = ! empty( $item->url ) ? $item->url : '#'; // replaced -> $atts['href'] = '#';

				//$atts['data-toggle']	= 'dropdown';

				$atts['class']			= 'dropdown-toggle';

				$atts['aria-haspopup']	= 'true';

			} else {

				$atts['href'] = ! empty( $item->url ) ? $item->url : '';

			}

			

			if( $depth == 1 && $this->megamenu_stat == 'on' )

				$atts['class'] .= 'megamenu-title';

			if( $depth == 1 && $this->megamenu_stat == 'on' && $this->megamenu_megatithide == 'on' )

				$atts['class'] .= ' hide';



			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );



			$attributes = '';

			foreach ( $atts as $attr => $value ) {

				if ( ! empty( $value ) ) {

					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );

					$attributes .= ' ' . $attr . '="' . $value . '"';

				}

			}



			$item_output = $args->before;



			/*

			 * Menu Icon Font Awesome

			 * ===========

			 */

			$menu_icon = '';

			if( $item->menuico != '' ){ $menu_icon = '<span class="'. esc_attr( $item->menuico ) .' menu-icon"></span>'; }

				

			$item_output .= '<a'. $attributes .'>' . $menu_icon;

				

				



			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';

			$item_output .= $args->after;

			

			//Megamenu widget

			if( $widget_stat == 1 && is_active_sidebar( $this->megamenu_widget ) ){

				ob_start();

				dynamic_sidebar( $this->megamenu_widget );

				$sidebar = ob_get_clean();

				$item_output .= '<div class="megamenu-widget">'. $sidebar .'</div>';

			}



			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}

	}



	/**

	 * Traverse elements to create list from elements.

	 *

	 * Display one element if the element doesn't have any children otherwise,

	 * display the element and its children. Will only traverse up to the max

	 * depth and no ignore elements under that depth.

	 *

	 * This method shouldn't be called directly, use the walk() method instead.

	 *

	 * @see Walker::start_el()

	 * @since 2.5.0

	 *

	 * @param object $element Data object

	 * @param array $children_elements List of elements to continue traversing.

	 * @param int $max_depth Max depth to traverse.

	 * @param int $depth Depth of current element.

	 * @param array $args

	 * @param string $output Passed by reference. Used to append additional content.

	 * @return null Null on failure with no changes to parameters.

	 */

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

        if ( ! $element )

            return;



        $id_field = $this->db_fields['id'];



        // Display this element.

        if ( is_object( $args[0] ) )

           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );



        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

    }



	/**

	 * Menu Fallback

	 * =============

	 * If this function is assigned to the wp_nav_menu's fallback_cb variable

	 * and a manu has not been assigned to the theme location in the WordPress

	 * menu manager the function with display nothing to a non-logged in user,

	 * and will add a link to the WordPress menu manager if logged in as an admin.

	 *

	 * @param array $args passed from the wp_nav_menu function.

	 *

	 */

	public static function fallback( $args ) {

		if ( current_user_can( 'manage_options' ) ) {



			extract( $args );



			$fb_output = null;



			if ( $container ) {

				$fb_output = '<' . $container;



				if ( $container_id )

					$fb_output .= ' id="' . $container_id . '"';



				if ( $container_class )

					$fb_output .= ' class="' . $container_class . '"';



				$fb_output .= '>';

			}



			$fb_output .= '<ul';



			if ( $menu_id )

				$fb_output .= ' id="' . $menu_id . '"';



			if ( $menu_class )

				$fb_output .= ' class="' . $menu_class . '"';



			$fb_output .= '>';

			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">'. esc_html__( 'Add a menu', 'gosolar' ) .'</a></li>';

			$fb_output .= '</ul>';



			if ( $container )

				$fb_output .= '</' . $container . '>';



			return $fb_output;

		}

	}

}


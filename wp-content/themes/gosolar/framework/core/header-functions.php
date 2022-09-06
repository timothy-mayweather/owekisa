<?php
/* ======================================
 * Header Functions
 *
 *	gosolar_page_loader()
 *	gosolar_secondary_menu()
 *  gosolar_footer_hidden_wrapper_start()
 *  gosolar_footer_hidden_wrapper_end()
 *	gosolar_header_wrapper()
 *  gosolar_header_top_bar()
 *  gosolar_header_layout()
 *  gosolar_header_elements_wrapper()
 *  gosolar_header_elements()
 *  gosolar_header_toggle_elements()
 *  gosolar_header_contact_info()
 *  gosolar_woo_get_cart()
 *  gosolar_top_bar_menu()
 *  gosolar_main_menu()
 *  gosolar_main_right_menu()
 *  gosolar_main_mobile_menu()
 *  gosolar_logo()
 *	gosolar_header_top_anchor()
 *  gosolar_mobile_header_wrapper()
 *  gosolar_mobile_header_layout()
 *	gosolar_page_slider_wrapper()
 *	gosolar_featured_post_slider()
 *
 * ====================================== */
 
/* ======================================
 * Page Loader
 * ====================================== */
 
if ( ! function_exists( 'gosolar_page_loader' ) ) {
	function gosolar_page_loader() {
		
		if( gosolar_get_theme_option( 'zozo_disable_page_loader' ) != 1 ) {
			$custom_loader_img = gosolar_get_theme_option( 'zozo_page_loader_img' );
			$pre_load_txt = esc_html( 'Pre Loader', 'gosolar' );
			echo '<div class="pageloader">';
			if( isset( $custom_loader_img ) && ( isset( $custom_loader_img['url'] ) && $custom_loader_img['url'] != '' ) ) {
				echo '<div class="zozo-custom-loader"><img class="img-responsive custom-loader-img" src="' . esc_url( $custom_loader_img['url'] ) . '" alt="'. esc_attr( $pre_load_txt ) .'" width="'. esc_attr( $custom_loader_img['width'] ) .'" height="'. esc_attr( $custom_loader_img['height'] ) .'" /></div>' . "\n";
			} else {
				echo '<div class="zozo-custom-loader"><img class="img-responsive page-loader-img" src="' . esc_url( GOSOLAR_THEME_URL . '/images/page-loader.gif' ) . '" alt="'. esc_attr( $pre_load_txt ) .'" width="64" height="79" /></div>';
			}
			echo '</div>';
		}
	}
	add_action( 'gosolar_before_page_wrapper', 'gosolar_page_loader', 5 );
}
/* ======================================
 * Header Wrapper
 * ====================================== */
 
if ( ! function_exists( 'gosolar_header_wrapper' ) ) {
	function gosolar_header_wrapper() {
		
		$post_id 		= gosolar_get_post_id();
		$show_header 	= '';
		$show_header 	= get_post_meta( $post_id, 'zozo_show_header', true );
		if( ! $show_header ) {
			$show_header  = "yes";
		} 
		
		// Header Layout
		$header_layout  = '';
		$header_layout 	= get_post_meta( $post_id, 'zozo_header_layout', true );
		if( isset( $header_layout ) && $header_layout == '' || $header_layout == 'default' ) {
			$header_layout = gosolar_get_theme_option( 'zozo_header_layout' );
		}
			
		if( ! $header_layout ) {
			$header_layout  = "fullwidth";
		}
		
		// Header Transparency
		$header_transparency 	= '';
		$header_transparency 	= get_post_meta( $post_id, 'zozo_header_transparency', true );
		if( isset( $header_transparency ) && $header_transparency == '' || $header_transparency == 'default' ) {
			$header_transparency = gosolar_get_theme_option( 'zozo_header_transparency' );
		}
		
		if( ! $header_transparency ) {
			$header_transparency  = "no-transparent";
		}
		
		// Header Skin
		$header_skin 	= '';
		$header_skin 	= get_post_meta( $post_id, 'zozo_header_skin', true );
		if( isset( $header_skin ) && $header_skin == '' || $header_skin == 'default' ) {
			$header_skin = gosolar_get_theme_option( 'zozo_header_skin' );
		}
		
		// Header Menu Skin
		$header_menu_skin 	= '';
		$header_menu_skin 	= get_post_meta( $post_id, 'zozo_header_menu_skin', true );
		if( isset( $header_menu_skin ) && $header_menu_skin == '' || $header_menu_skin == 'default' ) {
			$header_menu_skin = gosolar_get_theme_option( 'zozo_header_menu_skin' );
		}
		
		// Header Dropdown Menu Skin
		$header_dropdown_menu_skin 	= '';
		$header_dropdown_menu_skin 	= get_post_meta( $post_id, 'zozo_header_dropdown_menu_skin', true );
		if( isset( $header_dropdown_menu_skin ) && $header_dropdown_menu_skin == '' || $header_dropdown_menu_skin == 'default' ) {
			$header_dropdown_menu_skin = gosolar_get_theme_option( 'zozo_dropdown_menu_skin' );
		}
		
		// Header Type
		$header_type = '';
		$header_toggle_position = '';
		
		$header_type 	= get_post_meta( $post_id, 'zozo_header_type', true );
		$header_toggle_position = get_post_meta( $post_id, 'zozo_header_toggle_position', true );
		
		if( isset( $header_type ) && $header_type == '' || $header_type == 'default' ) {
			$header_type = gosolar_get_theme_option( 'zozo_header_type' );
		}
		
		if( isset( $header_toggle_position ) && $header_toggle_position == '' || $header_toggle_position == 'default' ) {
			$header_toggle_position = gosolar_get_theme_option( 'zozo_header_toggle_position' );
		}
		
		$header_extra_class = '';
		if( $header_type == 'header-11' ) { 
			$header_extra_class = ' header-fullwidth-menu';
		}
		$header_extra_class .= ' header-menu-skin-'. $header_menu_skin;		
		
				
		if( isset( $show_header ) && $show_header == 'yes' ) { ?>
			<div id="header" class="header-section type-<?php echo esc_attr( $header_type ); ?><?php echo esc_attr( $header_extra_class ); ?> header-layout-<?php echo esc_attr( $header_layout ); ?> header-skin-<?php echo esc_attr( $header_skin ); ?> header-<?php echo esc_attr( $header_transparency ); ?> header-dropdown-skin-<?php echo esc_attr( $header_dropdown_menu_skin ); ?>">
				<?php if( isset( $header_layout ) && $header_layout == 'boxed' ) { ?>
					<div class="container boxed-header">
						<div class="row">
				<?php }
					/**
					 * @hooked - gosolar_header_top_bar - 15
					**/
					do_action('gosolar_header_section_start');
					//Custom Updated get_template_part
					get_template_part( 'framework/core/headers/'.$header_type );
					do_action('gosolar_header_section_end');
				
					if( isset( $header_layout ) && $header_layout == 'boxed' ) { ?>
						</div>
					</div>
				<?php } ?>
			</div><!-- #header -->
		<?php }
	}
	add_action( 'gosolar_header_wrapper_start', 'gosolar_header_wrapper', 20 );
}
if ( ! function_exists( 'gosolar_header_top_bar' ) ) {
	function gosolar_header_top_bar() {
		
		$post_id 		= gosolar_get_post_id();
		$header_top_bar = '';
		$header_top_bar 	= get_post_meta( $post_id, 'zozo_show_header_top_bar', true );
		if( isset( $header_top_bar ) && $header_top_bar == '' || $header_top_bar == 'default' ) {
			$header_top_bar = gosolar_get_theme_option( 'zozo_enable_header_top_bar' );
			if( $header_top_bar == 1 ) {
				$header_top_bar = 'yes';
			} else {
				$header_top_bar = 'no';
			}
		}
		
		// Header Type
		$header_type 	= '';
		$header_type 	= get_post_meta( $post_id, 'zozo_header_type', true );
		
		if( isset( $header_type ) && $header_type == '' || $header_type == 'default' ) {
			$header_type = gosolar_get_theme_option( 'zozo_header_type' );
		}
		
		if( isset( $header_type ) && $header_type != "header-10" ) {
		
			if( isset($header_top_bar) && $header_top_bar == 'yes' ) {
				$topbar_left_output = $topbar_right_output = '';
				$topbar_left_output = gosolar_header_elements_wrapper( 'top-bar', 'left' );
				$topbar_right_output = gosolar_header_elements_wrapper( 'top-bar', 'right' );
				
				echo '<div id="header-top-bar" class="header-top-section">';
					echo '<div class="container">';
					echo '<div class="row">';
						if( isset( $topbar_left_output ) && $topbar_left_output != '' ) {
							echo '<div class="col-sm-6 zozo-top-left">'. $topbar_left_output .'</div>';
						}
						if( isset( $topbar_right_output ) && $topbar_right_output != '' ) {
							echo '<div class="col-sm-6 zozo-top-right">'. $topbar_right_output .'</div>';
						}
					echo '</div>';
					echo '</div>';
				echo '</div>';
			}
			
		}
			
	}
	
	add_action( 'gosolar_header_section_start', 'gosolar_header_top_bar', 15 );
}
if ( ! function_exists( 'gosolar_header_elements_wrapper' ) ) {
	function gosolar_header_elements_wrapper( $type = '', $position = '', $header_type = '', $toggle_type = '', $only_search = '', $search_type = '' ) {
		
		$topbar_config = array();
		$mainbar_config = array();
		$logobar_config = array();
		$togglebar_config = array();
		$topbar_output = $topbar_text = '';
		$mainbar_output = $mainbar_text = '';
		$logobar_output = $logobar_text = '';
		$togglebar_output = $togglebar_text = '';
		
		// Top Bar
		if( $type == 'top-bar' && $position == 'left' ) {
			$topbar_config = gosolar_get_theme_option( 'zozo_header_top_bar_left' );
			$topbar_text = gosolar_get_theme_option( 'zozo_header_top_bar_left_text' );
		} else if( $type == 'top-bar' && $position == 'right' ) {
			$topbar_config = gosolar_get_theme_option( 'zozo_header_top_bar_right' );
			$topbar_text = gosolar_get_theme_option( 'zozo_header_top_bar_right_text' );
		}
		
		$header_number = explode('-', $header_type);
		// Main Bar
		if( $type == 'main-bar' && ( $header_type == 'header-1' || $header_type == 'header-3' ) ) {
			$mainbar_config = gosolar_get_theme_option( 'zozo_header_'. $header_number[1] .'_elements_config' );
			$mainbar_text = gosolar_get_theme_option( 'zozo_header_'. $header_number[1] .'_elements_text' );
		}
		else if( $type == 'main-bar' && ( $header_type == 'header-11' ) ) {
			if( $position == 'left' ) {
				$mainbar_config = gosolar_get_theme_option( 'zozo_header_'. $header_number[1] .'_left_config' );
				$mainbar_text = gosolar_get_theme_option( 'zozo_header_'. $header_number[1] .'_left_text' );
			} else if( $position == 'right' ) {
				$mainbar_config = gosolar_get_theme_option( 'zozo_header_'. $header_number[1] .'_right_config' );
				$mainbar_text = gosolar_get_theme_option( 'zozo_header_'. $header_number[1] .'_right_text' );
			}
		} else if( $type == 'main-bar' ) {
			$mainbar_config = gosolar_get_theme_option( 'zozo_header_right_alt_config' );
			$mainbar_text = gosolar_get_theme_option( 'zozo_header_right_alt_text' );
		}
		
		// Logo Bar
		if( $type == 'logo-bar' && ( $header_type == 'header-11' ) ) {
			$logobar_config = gosolar_get_theme_option( 'zozo_header_'. $header_number[1] .'_logo_bar_config' );
			$logobar_text = gosolar_get_theme_option( 'zozo_header_'. $header_number[1] .'_logo_bar_text' );
		}
		
		if( $type == 'top-bar' ) {
			if( ! empty( $topbar_config ) && isset( $topbar_config['enabled'] ) ) {
				foreach( $topbar_config['enabled'] as $item_id => $item ) {
					$topbar_output .= gosolar_header_elements( $item_id, 'top-bar-item', $topbar_text );
				}
			}
			
			return $topbar_output;
		}
		else if( $type == 'main-bar' ) {
			if( $header_type == 'header-11' ) {
				$mainbar_config_common = '';
				$mainbar_left_config = gosolar_get_theme_option( 'zozo_header_'. $header_number[1] .'_left_config' );
				$mainbar_right_config = gosolar_get_theme_option( 'zozo_header_'. $header_number[1] .'_right_config' );
				
				$mainbar_config_common = array_intersect_key( $mainbar_left_config['enabled'], $mainbar_right_config['enabled'] );
			
				if( gosolar_get_theme_option( 'zozo_header_search_type' ) == 1 && ( isset( $search_type ) && $search_type == 'toggle' ) ) {
					if( array_key_exists( 'search-icon', $mainbar_config_common ) || array_key_exists( 'search-icon', $mainbar_left_config['enabled'] ) || array_key_exists( 'search-icon', $mainbar_right_config['enabled'] ) ) {
						if( isset( $only_search ) && $only_search == 'yes' ) {
							if( $header_type != 'header-9' && $header_type != 'header-10' ) {
								$mainbar_output .= gosolar_header_elements( 'toggle-search', 'main-bar-item', '', 'content' );
							}
						} 
					}
				} 
				
				else if( gosolar_get_theme_option( 'zozo_header_search_type' ) == 2 && ( isset( $search_type ) && $search_type == 'fullscreen' ) ) {
					if( array_key_exists( 'search-icon', $mainbar_config_common ) || array_key_exists( 'search-icon', $mainbar_left_config['enabled'] ) || array_key_exists( 'search-icon', $mainbar_right_config['enabled'] ) ) {
						if( isset( $only_search ) && $only_search == 'yes' ) {
							$mainbar_output .= gosolar_header_elements( 'fullscreen-search', 'main-bar-item', '', 'content' );
						} 
					}
				}
			}
			
			if( ! empty( $mainbar_config ) && isset( $mainbar_config['enabled'] ) ) {
				foreach( $mainbar_config['enabled'] as $item_id => $item ) {
					if( isset( $only_search ) && $only_search == 'yes' ) {
						if( $item_id == "search-icon" && ( $header_type != 'header-9' && $header_type != 'header-10' ) ) {
							if( gosolar_get_theme_option( 'zozo_header_search_type' ) == 1 && ( isset( $search_type ) && $search_type == 'toggle' ) ) {
								$mainbar_output .= gosolar_header_elements( 'toggle-search', 'main-bar-item', '', 'content' );
							} else if( gosolar_get_theme_option( 'zozo_header_search_type' ) == 2 && ( isset( $search_type ) && $search_type == 'fullscreen' ) ) {
								$mainbar_output .= gosolar_header_elements( 'fullscreen-search', 'main-bar-item', '', 'content' );
							}
						}
					} else {
						if( $item_id == "search-icon" ) {
							if( gosolar_get_theme_option( 'zozo_header_search_type' ) == 1 ) {
								$mainbar_output .= gosolar_header_elements( 'toggle-search', 'main-bar-item', '', 'icon' );
							} else if( gosolar_get_theme_option( 'zozo_header_search_type' ) == 2 ) {
								$mainbar_output .= gosolar_header_elements( 'fullscreen-search', 'main-bar-item', '', 'icon' );
							} else {
								$mainbar_output .= gosolar_header_elements( 'main-search', 'main-bar-item' );
							}
						} 
						else if( $item_id == "primary-menu" && $header_type == 'header-9' ) {
							$mainbar_output .= gosolar_header_elements( 'mobile-menu', 'main-bar-item' );
						} else {
							$mainbar_output .= gosolar_header_elements( $item_id, 'main-bar-item', $mainbar_text );
						}
					}
				}
			}
			
			return $mainbar_output;
		}
		else if( $type == 'logo-bar' ) {
			if( ! empty( $logobar_config ) && isset( $logobar_config['enabled'] ) ) {
				foreach( $logobar_config['enabled'] as $item_id => $item ) {
					$logobar_output .= gosolar_header_elements( $item_id, 'logo-bar-item', $logobar_text );
				}
			}
			
			return $logobar_output;
		}		
	}
}
if ( ! function_exists( 'gosolar_header_elements' ) ) {
	function gosolar_header_elements( $element = '', $item_class = '', $shortcode_text = '', $search_type = '' ) {
		
		$element_output = '';
		
		if( $element == "contact-info" ) {
			$element_output .= '<div class="'. esc_attr( $item_class ) .' item-contact-info">'. gosolar_header_contact_info() .'</div>' . "\n";
		} 
		else if( $element == "social-icons" ) {
			$element_output .= '<div class="'. esc_attr( $item_class ) .' item-social"><div id="header-social-links" class="header-social">'. gosolar_display_social_icons() .'</div></div>' . "\n";
		} 
		else if( $element == "search-icon" ) {
			$element_output .= '<div class="'. esc_attr( $item_class ) .' item-search"><div id="header-search-form" class="header-search-form">'. get_search_form(false) .'</div></div>' . "\n";
		} 
		else if( $element == "main-search" ) {
			$element_output .= '<div class="'. esc_attr( $item_class ) .' item-main-search"><div id="header-main-search" class="header-main-right-search"><i class="simple-icon icon-magnifier btn-trigger"></i>'. get_search_form(false) .'</div></div>' . "\n";
		}
		else if( $element == "toggle-search" ) {
			global $zozo_options;
			$search_placeholder = isset( $zozo_options['zozo_search_placeholder'] ) ? $zozo_options['zozo_search_placeholder'] : ''; 
			if( $search_type == 'icon' ) {
				$element_output .= '<div class="'. esc_attr( $item_class ) .' item-search-toggle"><i class="simple-icon icon-magnifier search-trigger"></i></div>' . "\n";
			} else if( $search_type == 'content' ) {
				$element_output .= '<div id="header-toggle-search" class="header-toggle-content header-toggle-search container"><i class="flaticon flaticon-shapes btn-toggle-close"></i>' . '<form role="search" method="get" id="searchform" action="'. esc_url( home_url( '/' ) ) .'" class="search-form"><div class="toggle-search-form"><input type="text" value="" name="s" id="s" class="form-control" placeholder="'. esc_attr($search_placeholder ) .'" /></div></form></div>' . "\n";
			}
		} 
		else if( $element == "fullscreen-search" ) {
			global $zozo_options;
			$search_placeholder = isset( $zozo_options['zozo_search_placeholder'] ) ? $zozo_options['zozo_search_placeholder'] : ''; 
			if( $search_type == 'icon' ) {
				$element_output .= '<div class="'. esc_attr( $item_class ) .' item-fullscreen-search"><i class="simple-icon icon-magnifier fullscreen-search-trigger"></i></div>' . "\n";
			} else if( $search_type == 'content' ) {
				$element_output .= '<div id="header-fullscreen-search" class="header-fullscreen-search-wrapper"><a href="#" target="_self" class="fullscreen-search-close"><i class="flaticon flaticon-shapes"></i></a>' . '<div class="fullscreen-search-inner"><form role="search" method="get" id="searchform" action="'. esc_url( home_url( '/' ) ) .'" class="search-form"><input type="text" value="" name="s" id="s" class="form-control" placeholder="'. esc_attr($search_placeholder ) .'" /><button class="btn btn-search" type="submit"><i class="simple-icon icon-magnifier"></i></button></form></div></div>' . "\n";
			}
		}		
		else if( $element == "cart-icon" ) {
			if( GOSOLAR_WOOCOMMERCE_ACTIVE ) {			
				$element_output .= '<div class="'. esc_attr( $item_class ) .' item-cart zozo-woo-cart-info">'. gosolar_woo_get_cart() .'</div>' . "\n";
			}
		}
		else if( $element == "secondary-menu" ) {
			if( gosolar_get_theme_option( 'zozo_enable_secondary_menu' ) == 1 ) {
				$element_output .= '<div class="'. esc_attr( $item_class ) .' item-secondary-menu"><div id="secondary-menu" class="header-main-bar-sidemenu side-menu"><a class="secondary_menu_button menu-bars-link" href="javascript:void(0)"><span class="menu-bars"></span></a></div></div>' . "\n";
			}
		}
		else if( $element == "welcome-msg" ) {
			if( gosolar_get_theme_option( 'zozo_welcome_msg' ) != '' ) {
				$element_output .= '<div class="'. esc_attr( $item_class ) .' item-welcome-msg"><p class="welcome-msg">'. do_shortcode( gosolar_get_theme_option( 'zozo_welcome_msg' ) ) .'</p></div>' . "\n";
			}
		}
		else if( $element == "top-menu" ) {
			$element_output .= '<div class="'. esc_attr( $item_class ) .' item-top-menu">'. gosolar_top_bar_menu() .'</div>' . "\n";
		} 
		else if( $element == "mobile-menu" ) {
			$element_output .= '<div class="'. esc_attr( $item_class ) .' item-main-mobile-menu">'. gosolar_main_mobile_menu( 'primary' ) .'</div>';
		}
		else if( $element == "primary-right-menu" ) {
			$element_output .= '<div class="'. esc_attr( $item_class ) .' item-main-right-menu">'. gosolar_main_right_menu() .'</div>';
		}
		else if( $element == "primary-menu" ) {
			$element_output .= '<div class="'. esc_attr( $item_class ) .' item-main-menu">'. gosolar_main_menu() .'</div>';
		}
		else if( $element == "address-info" ) {
			$element_output .= '<div class="'. esc_attr( $item_class ) .' item-address-info">';
				if( gosolar_get_theme_option( 'zozo_header_address' ) != '' ) {
					$element_output .= '<div class="header-details-box"><div class="header-details-icon header-address-icon"><i class="simple-icon icon-pointer"></i></div><div class="header-details-info header-address">'. do_shortcode( gosolar_get_theme_option( 'zozo_header_address' ) ) .'</div></div>';
				}
				
				if( gosolar_get_theme_option( 'zozo_header_business_hours' ) != '' ) {
					$element_output .= '<div class="header-details-box"><div class="header-details-icon header-business-icon"><i class="simple-icon icon-clock"></i></div><div class="header-details-info header-business-hours">'. do_shortcode( gosolar_get_theme_option( 'zozo_header_business_hours' ) ) .'</div></div>';
				}
				
				if( ( gosolar_get_theme_option( 'zozo_header_phone' ) != '' ) || ( gosolar_get_theme_option( 'zozo_header_email' ) != '' ) ) {
					$element_output .= '<div class="header-details-box"><div class="header-details-icon header-contact-icon"><i class="simple-icon icon-earphones-alt"></i></div><div class="header-details-info header-contact-details"><strong>'. do_shortcode( gosolar_get_theme_option( 'zozo_header_phone' ) ) .'</strong><span><a href="mailto:'.esc_attr( gosolar_get_theme_option( 'zozo_header_email' ) ).'">'.esc_html( gosolar_get_theme_option( 'zozo_header_email' ) ).'</a>' .'</span></div></div>';
				}
			$element_output .= '</div>';
		}
		else if( $element == "text-shortcode" ) {
			if( isset( $shortcode_text ) && $shortcode_text != '' ) {
				$element_output .= '<div class="'. esc_attr( $item_class ) .' item-text">'. do_shortcode( $shortcode_text ) .'</div>' . "\n";
			}
		}
		
		return $element_output;
	}
}
if ( ! function_exists( 'gosolar_header_contact_info' ) ) {
	function gosolar_header_contact_info() {
	
		$header_phone = gosolar_get_theme_option( 'zozo_header_phone' );
		$header_email = gosolar_get_theme_option( 'zozo_header_email' );
		
		$output = '';
		
		$output .= '<div id="header-contact-info" class="top-contact-info">';
		$output .= '<ul class="header-contact-details">';
		if( isset( $header_phone ) && $header_phone != '' ) {
			$output .= '<li class="header-phone">' . esc_html( $header_phone ) .'</li>';
		}
		if( isset( $header_email ) && $header_email != '' ) {
			$output .= '<li class="header-email">';
				$output .= '<a href="mailto:'.esc_attr( $header_email ).'">'.esc_html( $header_email ).'</a>';
			$output .= '</li>';
		}
		$output .= '</ul>';
		$output .= '</div>';
		
		return $output;
	}
}
if ( ! function_exists( 'gosolar_woo_get_cart' ) ) {
 function gosolar_woo_get_cart() {
  global $woocommerce;
  
  $output = '';
  
  $output .= '<div class="woo-cart">';
  if( ! $woocommerce->cart->cart_contents_count ) {
   $output .= '<a class="cart-empty cart-icon" href="'. get_permalink(get_option('woocommerce_cart_page_id')) .'"><i class="simple-icon icon-handbag"></i></a>';
   $output .= '<div class="woo-cart-contents cart-empty-msg">';
    $output .= '<div class="woo-cart-empty clearfix">';
    $output .= esc_html__('Your cart is currently empty', 'gosolar');
    $output .= '</div>';
   $output .= '</div>';
  } else {
   $output .= '<a class="cart-icon" href="'. get_permalink(get_option('woocommerce_cart_page_id')) .'"><i class="simple-icon icon-handbag"></i><span class="cart-count">'. wp_kses_post( $woocommerce->cart->cart_contents_count ) .'</span></a>';
   $output .= '<div class="woo-cart-contents">';
    foreach( $woocommerce->cart->cart_contents as $cart_item_key => $cart_item ) {
     $output .= '<div class="woo-cart-item clearfix">';
     $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
     
     $output .= '<a href="'. get_permalink($cart_item['product_id']) .'" title="'. esc_html( $_product->get_title() ) .'">';
      $thumbnail_id = ($cart_item['variation_id']) ? $cart_item['variation_id'] : $cart_item['product_id'];
      $output .= get_the_post_thumbnail($thumbnail_id, 'thumbnail');
      $output .= '<div class="cart-item-content">';
       $output .= '<h5 class="cart-product-title">'. wp_kses_post( $_product->get_title() ) .'</h5>';
       $output .= '<p class="cart-product-quantity">'. wp_kses_post( $cart_item['quantity'] ) .' x '. wp_kses_post( $woocommerce->cart->get_product_subtotal($cart_item['data'], 1) ) .'</p>';
      $output .= '</div>';
     $output .= '</a>';
     
     $output .= apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove-cart-item" title="%s" data-cart_id="%s">&times;</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'gosolar'), $cart_item_key ), $cart_item_key );
                    $output .= '<div class="ajax-loading"></div>';
     
     $output .= '</div>';
    }
     
    $output .= '<div class="woo-cart-total clearfix">';
    $output .= '<h5 class="cart-total">'. esc_html__('Total: ', 'gosolar') .' '. wp_kses_post( $woocommerce->cart->get_cart_total() ) .'</h5>';
    $output .= '</div>';
     
    $output .= '<div class="woo-cart-links clearfix">';
    $output .= '<div class="cart-link"><a class="btn btn-cart" href="'. get_permalink(get_option('woocommerce_cart_page_id')) .'" title="'. esc_html__('Cart', 'gosolar') .'">'. esc_html__('View Cart', 'gosolar') .'</a></div>';
    $output .= '<div class="checkout-link"><a class="btn btn-checkout" href="'. get_permalink(get_option('woocommerce_checkout_page_id')) .'" title="'. esc_html__('Checkout', 'gosolar') .'">'. esc_html__('Checkout', 'gosolar') .'</a></div>';
    $output .= '</div>';
   $output .= '</div>';
  }
  $output .= '</div>';
  
  return $output;
 }
}
if ( ! function_exists( 'gosolar_top_bar_menu' ) ) {
	function gosolar_top_bar_menu() {
	
		$top_menu_args = array(
			'echo'           	=> false,
			'theme_location' 	=> 'top-menu',
			'walker'         	=> new gosolar_wp_bootstrap_navwalker(),
			'fallback_cb'    	=> 'gosolar_wp_bootstrap_navwalker::fallback',
			'container_class' 	=> 'zozo-nav top-menu-navigation', 
			'container_id' 		=> 'top-nav', 
			'menu_id' 			=> 'top-menu', 
			'menu_class' 		=> 'nav navbar-nav zozo-top-nav',
		);
		
		$top_menu_output = '';
		
		if ( function_exists( 'wp_nav_menu' ) ) {
			if ( has_nav_menu( 'top-menu' ) ) {
				$top_menu_output .= wp_nav_menu( $top_menu_args );
			} else {
				$top_menu_output .= '<div class="no-menu">' . esc_html__( "Please assign a menu to the Top Bar Menu", "gosolar" ) . '</div>';
			}
		}
		return $top_menu_output;
		
	}
}
if ( ! function_exists( 'gosolar_main_menu' ) ) {
	function gosolar_main_menu() {
		global $post;
		$post_id = '';
		$page_menu = '';
	
		if ( ( get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) && is_home() ) || ( get_option( 'page_for_posts' ) && is_archive() && ! is_tax( 'testimonial_categories' ) && ! is_tax( 'team_categories' ) ) ) {
			$post_id = get_option( 'page_for_posts' );
		} else {
			if ( isset( $post ) ) {
				$post_id = $post->ID;
			}
	
			if( GOSOLAR_WOOCOMMERCE_ACTIVE ) {
				if ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
					$post_id = get_option( 'woocommerce_shop_page_id' );
				}
			}
		}
		
		$page_menu = get_post_meta( $post_id, 'zozo_custom_nav_menu', true );
		$main_menu_args = array(
			'echo'           	=> false,
			'container_class' 	=> 'main-nav main-menu-container',
			'container_id' 		=> 'main-nav-container',
			'menu_id' 			=> 'main-menu',
			'menu_class' 		=> 'nav navbar-nav navbar-main zozo-main-nav',
			'theme_location' 	=> 'primary-menu',
			'walker'         	=> new gosolar_wp_bootstrap_navwalker(),
			'fallback_cb'    	=> 'gosolar_wp_bootstrap_navwalker::fallback'
		);
		if( $page_menu != '' && $page_menu != 'default' ) {
			$main_menu_args['menu'] = $page_menu;
		}
		
		$menu_extra_class = '';
		if( gosolar_get_theme_option( 'zozo_menu_separator' ) == 1 ) {
			$menu_extra_class = ' menu-style-separator';
		}
		
		$menu_output = '';
		// Menu Output
		$menu_output .= '<div class="main-navigation-wrapper'. $menu_extra_class .'">' . "\n";
		if ( function_exists( 'wp_nav_menu' ) ) {
			$menu_output .= wp_nav_menu( $main_menu_args );
		}
		$menu_output .= '</div>' . "\n";
		
		return $menu_output;
	
	}
}
if ( ! function_exists( 'gosolar_main_right_menu' ) ) {
	function gosolar_main_right_menu() {
	
		
		if( gosolar_get_theme_option( 'zozo_menu_type' ) != 'standard' && gosolar_get_theme_option( 'zozo_menu_type' ) == 'megamenu' ) {
			$right_menu_args = array(
				'echo'           	=> false,
				'container_class' 	=> 'main-right-nav main-menu-container main-megamenu',
				'container_id' 		=> 'main-right-nav-container',
				'menu_id' 			=> 'main-right-menu',
				'menu_class' 		=> 'nav navbar-nav navbar-main zozo-main-nav',
				'theme_location' 	=> 'primary-right',
				'walker'         	=> new gosolar_wp_bootstrap_navwalker(),
				'fallback_cb'    	=> 'gosolar_wp_bootstrap_navwalker::fallback'
			);
		} else {
			$right_menu_args = array(
				'echo'           	=> false,
				'container_class' 	=> 'main-right-nav main-menu-container',
				'container_id' 		=> 'main-right-nav-container',
				'menu_id' 			=> 'main-menu',
				'menu_class' 		=> 'nav navbar-nav navbar-main zozo-main-nav',
				'theme_location' 	=> 'primary-right',
				'walker'         	=> new gosolar_wp_bootstrap_navwalker(),
				'fallback_cb'    	=> 'gosolar_wp_bootstrap_navwalker::fallback'
			);
		}
		
		$menu_extra_class = '';
		if( gosolar_get_theme_option( 'zozo_menu_separator' ) == 1 ) {
			$menu_extra_class = ' menu-style-separator';
		}
		
		$right_menu_output = '';
		// Menu Output
		$right_menu_output .= '<div class="main-right-navigation-wrapper'. $menu_extra_class .'">' . "\n";
		if ( function_exists( 'wp_nav_menu' ) ) {
			$right_menu_output .= wp_nav_menu( $right_menu_args );
		}
		$right_menu_output .= '</div>' . "\n";
	
		return $right_menu_output;
		
	}
}
if ( ! function_exists( 'gosolar_main_mobile_menu' ) ) {
	function gosolar_main_mobile_menu( $menu_type = '' ) {
	
		global $post;		
		
		$post_id = '';
		$page_menu = '';
		$mobile_menu = '';
	
		if ( ( get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) && is_home() ) || ( get_option( 'page_for_posts' ) && is_archive() && ! is_tax( 'testimonial_categories' ) && ! is_tax( 'team_categories' ) ) ) {
			$post_id = get_option( 'page_for_posts' );
		} else {
			if ( isset( $post ) ) {
				$post_id = $post->ID;
			}
	
			if( GOSOLAR_WOOCOMMERCE_ACTIVE ) {
				if ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
					$post_id = get_option( 'woocommerce_shop_page_id' );
				}
			}
		}
		
		$page_menu = get_post_meta( $post_id, 'zozo_custom_nav_menu', true );
		$mobile_menu = get_post_meta( $post_id, 'zozo_custom_mobile_menu', true );
			
		if( isset( $menu_type ) && $menu_type == 'primary' ) {			
		
			$mobile_menu_args = array(
				'echo'           	=> false,
				'container_class' 	=> 'main-nav main-toggle-nav main-menu-container',
				'container_id' 		=> 'main-toggle-nav',
				'menu_id' 			=> 'main-toggle-menu',
				'menu_class' 		=> 'nav navbar-nav navbar-main zozo-main-nav',
				'theme_location' 	=> 'primary-menu',
				'walker'         	=> new gosolar_wp_bootstrap_mobile_navwalker(),
				'fallback_cb'    	=> 'gosolar_wp_bootstrap_mobile_navwalker::fallback'
			);
			
			if( $page_menu != '' && $page_menu != 'default' ) {
				$mobile_menu_args['menu'] = $page_menu;
			}
		} else {
			$mobile_menu_args = array(
				'echo'           	=> false,
				'container_class' 	=> 'main-nav main-mobile-nav main-menu-container',
				'container_id' 		=> 'main-mobile-nav',
				'menu_id' 			=> 'main-mobile-menu',
				'menu_class' 		=> 'nav navbar-nav navbar-main zozo-main-nav',
				'theme_location' 	=> 'mobile-menu',
				'walker'         	=> new gosolar_wp_bootstrap_mobile_navwalker(),
				'fallback_cb'    	=> 'gosolar_wp_bootstrap_mobile_navwalker::fallback'
			);
			
			if( $mobile_menu != '' && $mobile_menu != 'default' ) {
				$mobile_menu_args['menu'] = $mobile_menu;
			}
		}
		
		$mobile_menu_output = '';
		// Menu Output
		$mobile_menu_output .= '<div class="main-mobile-navigation-wrapper">' . "\n";
		if ( function_exists( 'wp_nav_menu' ) ) {
			$mobile_menu_output .= wp_nav_menu( $mobile_menu_args );
		}
		$mobile_menu_output .= '</div>' . "\n";
	
		return $mobile_menu_output;
		
	}
}
if ( ! function_exists( 'gosolar_logo' ) ) {
	function gosolar_logo( $logo_class = '', $logo_id = 'logo' ) {
		
		$logo = $retina_logo = $sticky_logo = array();
		$logo_output = '';
		
		$zozo_site_title 		= get_bloginfo( 'name' );
		$zozo_site_url 			= home_url( '/' );
		$zozo_site_description 	= get_bloginfo( 'description' );
		
		// Standard Logo
		$logo_opt = gosolar_get_theme_option( 'zozo_logo' );
		if( isset( $logo_opt ) ) {
			$logo = $logo_opt;
		}
		
		// Retina Logo
		$retina_logo_opt = gosolar_get_theme_option( 'zozo_retina_logo' );
		if( isset( $retina_logo_opt ) ) {
			$retina_logo = $retina_logo_opt;
		}
				
		// Sticky Logo
		$sticky_logo_opt = gosolar_get_theme_option( 'zozo_sticky_logo' );
		if( isset( $sticky_logo_opt ) ) {
			$sticky_logo = $sticky_logo_opt;
		}
		
		if( $logo_id == "mobile-logo" ) {
			$logo_class .= " zozo-no-sticky-logo"; 
		} else {
			if( isset( $sticky_logo ) && $sticky_logo['url'] ) {
				$logo_class .= " zozo-has-sticky-logo";
			} else {
				$logo_class .= " zozo-no-sticky-logo"; 
			}
		}
				
		if( isset( $retina_logo['url'] ) && $retina_logo['url'] == '' && $logo['url'] != '' ) {
			$retina_logo['url'] = $logo['url'];
		}
		
		if( isset( $logo['url'] ) && $logo['url'] != '' ) {
			$logo_class .= " has-img";
		} else {
			$logo_class .= " no-img";
		}
		
		// Logo Output
		$logo_output .= '<div id="zozo-' . esc_attr( $logo_id ) . '" class="navbar-header nav-respons zozo-' . esc_attr( $logo_id ) . ' ' . $logo_class . '">' . "\n";
		$logo_output .= '<a href="'. esc_url( home_url( '/' ) ) .'" class="navbar-brand" title="'. esc_attr( get_bloginfo( 'name', 'display' ) ) .' - '. get_bloginfo( 'description' ) .'" rel="home">' . "\n";
		
		if( $logo_id == "mobile-logo" ) {
		
			$mobile_logo = '';
			
			$mobile_logo_opt = gosolar_get_theme_option( 'mobile_logo' );
			if( isset( $mobile_logo_opt ) ) {
				$mobile_logo = $mobile_logo_opt;
			}
			
			// Standard Mobile Logo
			if ( isset( $mobile_logo['url'] ) && $mobile_logo['url'] != '' ) {
				$logo_output .= '<img class="img-responsive zozo-mobile-standard-logo" src="' . esc_url( $mobile_logo['url'] ) . '" alt="' . $zozo_site_title . '" width="'. esc_attr( $mobile_logo['width'] ) .'" height="'. esc_attr( $mobile_logo['height'] ) .'" />' . "\n";
			} else if ( isset( $logo['url'] ) && $logo['url'] != '' ) {
				$logo_output .= '<img class="img-responsive zozo-mobile-standard-logo" src="' . esc_url( $logo['url'] ) . '" alt="' . $zozo_site_title . '" width="'. esc_attr( $logo['width'] ) .'" height="'. esc_attr( $logo['height'] ) .'" />' . "\n";
			}
			
			 // Text Logo
			if ( ( ! isset( $mobile_logo['url'] ) || $mobile_logo['url'] == '' ) && ( ! isset( $logo['url'] ) || $logo['url'] == '' ) ) {
				$logo_output .= '<div class="zozo-text-logo">';
				$logo_output .= '<h1 class="logo-h1 standard-mobile-logo">' . $zozo_site_title . '</h1>' . "\n";
				$logo_output .= '</div>' . "\n";
			}
		
		} else {
		
			// Standard Logo
			if ( isset( $logo['url'] ) && $logo['url'] != '' ) {
				$logo_output .= '<img class="img-responsive zozo-standard-logo" src="' . esc_url( $logo['url'] ) . '" alt="' . $zozo_site_title . '" width="'. esc_attr( $logo['width'] ) .'" height="'. esc_attr( $logo['height'] ) .'" />' . "\n";
			}
			// Retina Logo
			if ( isset( $retina_logo['url'] ) && $retina_logo['url'] != '' ) {
				if ( isset( $retina_logo['height'] ) && $retina_logo['height'] != '' ) {
					$logo_height = (int) ( $retina_logo['height'] / 2 );
				} else {
					$logo_height = (int) ( $logo['height'] / 2 );
				}
				
				if ( isset( $retina_logo['width'] ) && $retina_logo['width'] != '' ) {
					$logo_width = (int) ( $retina_logo['width'] / 2 );
				} else {
					$logo_width = (int) ( $logo['width'] / 2 );
				}
				$logo_output .= '<img class="img-responsive zozo-retina-logo" src="' . $retina_logo['url'] . '" alt="' . $zozo_site_title . '" height="' . $logo_height . '" width="' . $logo_width . '" />' . "\n";
			}
			
			// Sticky Logo
			if ( isset( $sticky_logo['url'] ) && $sticky_logo['url'] != '' ) {
				$logo_output .= '<img class="img-responsive zozo-sticky-logo" src="' . esc_url( $sticky_logo['url'] ) . '" alt="' . $zozo_site_title . '" width="'. esc_attr( $sticky_logo['width'] ) .'" height="'. esc_attr( $sticky_logo['height'] ) .'" />' . "\n";
			}
			
			 // Text Logo
			$logo_output .= '<div class="zozo-text-logo">';
			if ( ! isset( $logo['url'] ) || $logo['url'] == '' ) {
				$logo_output .= '<h1 class="logo-h1 standard-text-logo">' . $zozo_site_title . '</h1>' . "\n";
			}
			if ( ! isset( $retina_logo['url'] ) || $retina_logo['url'] == '' ) {
				$logo_output .= '<h1 class="logo-h1 retina-text-logo">' . $zozo_site_title . '</h1>' . "\n";
			}
			$logo_output .= '</div>' . "\n";
			
		}
		$logo_output .= '</a>' . "\n";
		$logo_output .= '</div>' . "\n";
		return $logo_output;		
	}
}
/* ======================================
 * Mobile Header Wrapper
 * ====================================== */
 
if ( ! function_exists( 'gosolar_mobile_header_wrapper' ) ) {
	function gosolar_mobile_header_wrapper() {
		
		$post_id 		= gosolar_get_post_id();
		$show_header 	= '';
		$show_header 	= get_post_meta( $post_id, 'zozo_show_header', true );
		if( ! $show_header ) {
			$show_header  = "yes";
		} 		
		
		$mobile_header_layout = gosolar_get_theme_option( 'mobile_header_layout' );
		$mobile_top_text      = gosolar_get_theme_option( 'mobile_top_text' );
				
		// Header Skin
		$header_skin 	= '';
		$header_skin 	= get_post_meta( $post_id, 'zozo_header_skin', true );
		if( isset( $header_skin ) && $header_skin == '' || $header_skin == 'default' ) {
			$header_skin = gosolar_get_theme_option( 'zozo_header_skin' );
		}
				
		if( isset( $show_header ) && $show_header == 'yes' ) { ?>
			<div id="mobile-header" class="mobile-header-section header-skin-<?php echo esc_attr( $header_skin ); ?> header-mobile-<?php echo esc_attr( $mobile_header_layout ); ?>">
				<?php if( isset( $mobile_top_text ) && $mobile_top_text != '' ) {
					echo '<div id="mobile-top-text" class="mobile-top-bar-section"><div class="container">' . do_shortcode( $mobile_top_text ) . '</div></div>';
				}
				echo gosolar_mobile_header_layout( $mobile_header_layout );
				?>
			</div><!-- #mobile-header -->
		<?php } 
	}
	add_action( 'gosolar_header_wrapper_start', 'gosolar_mobile_header_wrapper', 15 ); 
}
if ( ! function_exists( 'gosolar_mobile_header_layout' ) ) {
	function gosolar_mobile_header_layout( $mobile_header_layout = '' ) {
		global $woocommerce;	
		
		$mobile_header_class = '';
		$mobile_header_output = '';
		$mobile_menu_cart = '';
		$mobile_show_cart     		= gosolar_get_theme_option( 'mobile_show_cart' );
		$mobile_show_search   		= gosolar_get_theme_option( 'mobile_show_search' ); 
		
		$mobile_menu_link = '<div class="mobile-menu-item"><a href="#main-nav-container" class="mobile-menu-nav menu-bars-link"><span class="menu-bars"></span></a></div>'; // # chnaged to main-nav-container
		$mobile_menu_search = '<div class="mobile-search-item"><a href="#" class="mobile-menu-search"><i class="simple-icon icon-magnifier"></i></a></div>';
		if( GOSOLAR_WOOCOMMERCE_ACTIVE ) {
			if( ! $woocommerce->cart->cart_contents_count ) {
				$mobile_menu_cart .= '<a class="cart-empty mobile-cart-empty" href="'. get_permalink(get_option('woocommerce_cart_page_id')) .'"><i class="simple-icon icon-handbag"></i></a>';
			} else {
				$mobile_menu_cart .= '<a class="mobile-cart-link" href="#"><i class="simple-icon icon-handbag"></i><span class="cart-count">'. wp_kses_post( $woocommerce->cart->cart_contents_count ) .'</span></a>';
			}
		}
		
		$mobile_header_output .= '<div id="header-mobile-main" class="header-mobile-main-section navbar">' . "\n";
		$mobile_header_output .= '<div class="container">';
		
		if( $mobile_header_layout == "right-logo" ) {
			$mobile_header_output .= '<div class="mobile-header-items-wrap">';
			$mobile_header_output .= $mobile_menu_link . "\n";
			if( isset( $mobile_show_search ) && $mobile_show_search == 1 ) {
				$mobile_header_output .= $mobile_menu_search . "\n";
			}
			if( GOSOLAR_WOOCOMMERCE_ACTIVE && ( isset( $mobile_show_cart ) && $mobile_show_cart == 1 ) ) {
				$mobile_header_output .= '<div class="mobile-cart-item">'. $mobile_menu_cart .'</div>' . "\n";
			}
			$mobile_header_output .= '</div>';
			$mobile_header_output .= gosolar_logo( 'logo-right', 'mobile-logo' );
		} 
		else if( $mobile_header_layout == "center-logo" ) {
			$mobile_header_output .= '<div class="mobile-header-items-wrap items-left">';
			$mobile_header_output .= $mobile_menu_link . "\n";
			$mobile_header_output .= '</div>';
			$mobile_header_output .= gosolar_logo( 'logo-center', 'mobile-logo' );
			$mobile_header_output .= '<div class="mobile-header-items-wrap items-right">';
			if( isset( $mobile_show_search ) && $mobile_show_search == 1 ) {
				$mobile_header_output .= $mobile_menu_search . "\n";
			}
			if( GOSOLAR_WOOCOMMERCE_ACTIVE && ( isset( $mobile_show_cart ) && $mobile_show_cart == 1 ) ) {
				$mobile_header_output .= '<div class="mobile-cart-item">'. $mobile_menu_cart .'</div>' . "\n";
			}
			$mobile_header_output .= '</div>';
		}
		else if( $mobile_header_layout == "center-logo-alt" ) {
			$mobile_header_output .= '<div class="mobile-header-items-wrap items-left">';
			if( isset( $mobile_show_search ) && $mobile_show_search == 1 ) {
				$mobile_header_output .= $mobile_menu_search . "\n";
			}
			if( GOSOLAR_WOOCOMMERCE_ACTIVE && ( isset( $mobile_show_cart ) && $mobile_show_cart == 1 ) ) {
				$mobile_header_output .= '<div class="mobile-cart-item">'. $mobile_menu_cart .'</div>' . "\n";
			}
			$mobile_header_output .= '</div>';
			$mobile_header_output .= gosolar_logo( 'logo-center', 'mobile-logo' );
			$mobile_header_output .= '<div class="mobile-header-items-wrap items-right">';
			$mobile_header_output .= $mobile_menu_link . "\n";
			$mobile_header_output .= '</div>';
		}
		else {
			$mobile_header_output .= gosolar_logo( 'logo-left', 'mobile-logo' );
			$mobile_header_output .= '<div class="mobile-header-items-wrap">';
			$mobile_header_output .= $mobile_menu_link . "\n";
			if( isset( $mobile_show_search ) && $mobile_show_search == 1 ) {
				$mobile_header_output .= $mobile_menu_search . "\n";
			}
			if( GOSOLAR_WOOCOMMERCE_ACTIVE && ( isset( $mobile_show_cart ) && $mobile_show_cart == 1 ) ) {
				$mobile_header_output .= '<div class="mobile-cart-item">'. $mobile_menu_cart .'</div>' . "\n";
			}
			$mobile_header_output .= '</div>';
		}
		
		$mobile_header_output .= '</div>';
		$mobile_header_output .= '</div>' . "\n";
		
		return $mobile_header_output;
	}
}
/* ======================================
 * Mobile Cart
 * ====================================== */
 
if ( ! function_exists( 'gosolar_mobile_cart_wrapper' ) ) {
	function gosolar_mobile_cart_wrapper() {
		
		$mobile_header_layout = gosolar_get_theme_option( 'mobile_header_layout' );
		$mobile_show_cart     = gosolar_get_theme_option( 'mobile_show_cart' );
	
		if( GOSOLAR_WOOCOMMERCE_ACTIVE && ( isset( $mobile_show_cart ) && $mobile_show_cart == 1 ) ) {
			if( isset( $mobile_header_layout ) && ( $mobile_header_layout == "right-logo" || $mobile_header_layout == "center-logo-alt" ) ) {
				echo '<div id="mobile-cart-wrapper" class="mobile-cart-wrapper mobile-cart-right">' . "\n";
			} else {
				echo '<div id="mobile-cart-wrapper" class="mobile-cart-wrapper mobile-cart-left">' . "\n";
			}
			
			echo '<div class="zozo-woo-cart-info">';
			echo gosolar_woo_get_cart();
			echo '</div>';
			
			echo '<div class="mobile-menu-item"><a href="#" class="mobile-cart-link"><i class="flaticon flaticon-shapes"></i></a></div>';
			echo '</div>';
		}
		
	}
	add_action( 'gosolar_before_page_wrapper', 'gosolar_mobile_cart_wrapper', 30 );
}
/* ======================================
 * Mobile Search
 * ====================================== */
 
if ( ! function_exists( 'gosolar_mobile_search_wrapper' ) ) {
	function gosolar_mobile_search_wrapper() {
		
		$mobile_header_layout 	= gosolar_get_theme_option( 'mobile_header_layout' );
		$mobile_show_search     = gosolar_get_theme_option( 'mobile_show_search' );
	
		if( isset( $mobile_show_search ) && $mobile_show_search == 1 ) {
			echo '<div id="mobile-search-wrapper" class="mobile-search-wrapper mobile-overlay-search">' . "\n";
			echo '<a href="#" target="_self" class="mobile-search-close"><i class="flaticon flaticon-shapes"></i></a>';
			
			echo '<div class="mobile-search-inner">' . "\n";
			echo '<form method="get" action="'. esc_url( home_url( '/' ) ) .'" class="search-form">';
        	echo '<input type="text" value="" name="s" class="form-control" placeholder="'. esc_html__('Enter text to search', 'gosolar') .'" />'; 
            echo '<button class="btn btn-search" type="submit"><i class="simple-icon icon-magnifier"></i></button>';
   			echo '</form>';
			echo '</div>';
			
			echo '</div>';
		}
		
	}
	add_action( 'gosolar_before_page_wrapper', 'gosolar_mobile_search_wrapper', 40 );
}
/* ======================================
 * Language Flags
 * ====================================== */
 
if ( ! function_exists( 'gosolar_language_flags' ) ) {
	function gosolar_language_flags() {
		$language_output = '';
		
		if( function_exists( 'pll_the_languages' ) ) {
			$languages = pll_the_languages( array( 'raw' => 1 ) );
			if( ! empty( $languages ) ) {
				foreach( $languages as $l ) {
					$language_output .= '<li>';
					if( $l['flag'] ) {
						if( ! $l['current_lang'] ) {
							$language_output .= '<a href="'. esc_url($l['url']) .'"><img src="'.esc_url($l['flag']).'" height="12" alt="'.esc_attr($l['slug']).'" width="18" /><span class="language name">'.$l['name'].'</span></a>'."\n";
						} else {
							$language_output .= '<div class="current-language"><img src="'. esc_url($l['flag']) .'" height="12" alt="'.esc_attr($l['slug']).'" width="18" /><span class="language name">'.$l['name'].'</span></div>'."\n";
						}
					}
					$language_output .= '</li>';
				 }
			}
		} 
		else if( function_exists( 'icl_get_languages' ) ) {
			$languages = icl_get_languages( 'skip_missing=0&orderby=code' );
			if( ! empty( $languages ) ) {
				foreach( $languages as $l ) {
					$language_output .= '<li>';
					if( $l['country_flag_url'] ) {
						if( ! $l['active'] ) {
							$language_output .= '<a href="' . esc_url($l['url']) . '"><img src="' . esc_url($l['country_flag_url']) . '" height="12" alt="' . esc_attr($l['language_code']) . '" width="18" /><span class="language name">' . $l['translated_name'] . '</span></a>' . "\n";
						} else {
							$language_output .= '<div class="current-language"><img src="' . esc_url($l['country_flag_url']) . '" height="12" alt="' . esc_attr($l['language_code']) . '" width="18" /><span class="language name">' . $l['translated_name'] . '</span></div>' . "\n";
						}
					}
					$language_output .= '</li>';
				}
			}
		}
		
		return $language_output;
		
	}
}
 
/* ======================================
 * Section Top anchor for One Page
 * ====================================== */
 
if ( ! function_exists( 'gosolar_header_top_anchor' ) ) {
	function gosolar_header_top_anchor() {
	
			echo '<div id="section-top" class="zozo-top-anchor"></div>';				
		
	}
	add_action( 'gosolar_header_wrapper_start', 'gosolar_header_top_anchor', 30 );
}
/* ======================================
 * Page Slider
 * ====================================== */
 
if ( ! function_exists( 'gosolar_page_slider_wrapper' ) ) {
	function gosolar_page_slider_wrapper() {
		global $post;
		
		$post_id = '';
		$object_id = get_queried_object_id();
		
		if( is_search() ) {
			$post_id = '';
		}
		if( ! is_search() ) {
			$post_id = '';
			if ( ! is_home() && ! is_front_page() && ! is_archive() && isset( $object_id ) ) {
				$post_id = $object_id;
			}
			if ( ! is_home() && is_front_page() && isset( $object_id ) ) {
				$post_id = $object_id;
			}
			if ( is_home() && ! is_front_page() ) {
				$post_id = get_option( 'page_for_posts' );
			}
			if ( class_exists( 'Woocommerce' ) ) {
				if ( is_shop() ) {
					$post_id = get_option( 'woocommerce_shop_page_id' );
				}
			}
		}
		
		$rev_slider 	= get_post_meta( $post_id, 'zozo_revolutionslider', true );
		
		if( GOSOLAR_REVSLIDER_ACTIVE && isset( $rev_slider ) && $rev_slider != '' ) {
			echo '<div class="zozo-revslider-section">';
			echo do_shortcode( $rev_slider );
			echo '</div>';
		}
	}
}
/* ======================================
 * Featured Post Slider
 * ====================================== */
 
if ( ! function_exists( 'gosolar_featured_post_slider' ) ) {
	function gosolar_featured_post_slider() {
		global $post;
				
		if( is_home() ) { 
			if( gosolar_get_theme_option( 'zozo_show_blog_featured_slider' ) == 1 ) {
				get_template_part('partials/blog/featured', 'slider' );	
			} 
		} 
		// Featured Post Slider for Archives
		elseif( ( ( is_archive() || is_tag() || is_category() ) && ! is_post_type_archive() ) ) { 
			if( gosolar_get_theme_option( 'zozo_show_archive_featured_slider' ) == 1 ) {
				get_template_part('partials/blog/featured', 'slider' );	
			}
		}
	}
}
/* ======================================
 * Zmm
 * ====================================== */
 
if ( ! function_exists( 'gosolar_zmm_wrapper' ) ) {
	function gosolar_zmm_wrapper() {
	?>
		<div class="zmm-wrapper">
			<span class="zmm-close flaticon flaticon-shapes"></span>
			<div class="zmm-inner">
				<?php 
					$mobile_social 	= gosolar_get_theme_option( 'mobile_social_icons' );
					if( $mobile_social )
					echo gosolar_display_social_icons();
				
					if ( has_nav_menu( 'mobile-menu' ) ) {
						echo '<div id="mobile-nav-container" class="mobile-nav mobile-menu-container">';
							$main_menu_args = array(
								'echo'           	=> false,
								'container_class' 	=> 'main-nav main-menu-container',
								'container_id' 		=> 'main-nav-container',
								'menu_id' 			=> 'main-menu',
								'menu_class' 		=> 'nav navbar-nav navbar-main zozo-main-nav',
								'theme_location' 	=> 'mobile-menu',
								'walker'         	=> new gosolar_wp_bootstrap_navwalker(),
								'fallback_cb'    	=> 'gosolar_wp_bootstrap_navwalker::fallback'
							);
							echo wp_nav_menu( $main_menu_args );
						echo '</div>';
					}
				
				?>
			</div>
		</div>
	<?php
	} 
	add_action( 'gosolar_before_page_wrapper', 'gosolar_zmm_wrapper', 10 );
}
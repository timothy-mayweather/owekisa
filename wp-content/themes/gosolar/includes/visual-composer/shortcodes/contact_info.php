<?php 

/**

 * Contact Info shortcode

 */



if ( ! function_exists( 'gosolar_vc_contact_info_shortcode' ) ) {

	function gosolar_vc_contact_info_shortcode( $atts, $content = NULL ) {

		

		$atts = vc_map_get_attributes( 'zozo_vc_contact_info', $atts );

		extract( $atts );



		$output = '';

		$extra_class = '';

		static $zozo_contact_info_id = 1;

		

		// Stylings

		$widget_title_styles = $widget_desc_styles = $address_label_styles = '';

		

		$widget_title_styles 	= !empty( $title_color ) ? ' style="color: '. $title_color .';"' : '';

		$widget_desc_styles 	= !empty( $desc_color ) ? ' style="color: '. $desc_color .';"' : '';

		$address_label_styles 	= !empty( $address_label_color ) ? ' style="color: '. $address_label_color .';"' : '';

		$phone_label_styles 	= !empty( $phone_label_color ) ? ' style="color: '. $phone_label_color .';"' : '';

		$phone_styles 			= !empty( $phone_color ) ? ' style="color: '. $phone_color .';"' : '';

		$email_label_styles 	= !empty( $email_label_color ) ? ' style="color: '. $email_label_color .';"' : '';

		$email_styles 			= !empty( $email_color ) ? ' style="color: '. $email_color .';"' : '';

		$social_label_styles 	= !empty( $social_label_color ) ? ' style="color: '. $social_label_color .';"' : '';

		$icon_styles 			= !empty( $icon_color ) ? 'color: '. $icon_color .';' : '';

		if( isset( $social_icons_type ) && $social_icons_type != 'transparent' ) {

			if( isset( $social_icons_style ) && $social_icons_style == 'background' ) {

				$icon_styles 		   .= !empty( $icon_bg_color ) ? 'background-color: '. $icon_bg_color .';' : '';

			}

			if( isset( $social_icons_style ) && $social_icons_style == 'bordered' ) {

				$icon_styles 		   .= !empty( $icon_border_color ) ? 'border-color: '. $icon_border_color .';' : '';

			}

		}

		$icon_hv_styles			= !empty( $icon_hover_color ) ? 'color: '. $icon_hover_color .';' : '';

		if( isset( $social_icons_type ) && $social_icons_type != 'transparent' ) {

			if( isset( $social_icons_style ) && $social_icons_style == 'background' ) {

				$icon_hv_styles		   .= !empty( $icon_bg_hover_color ) ? 'background-color: '. $icon_bg_hover_color .';' : '';

			}

			if( isset( $social_icons_style ) && $social_icons_style == 'bordered' ) {

				$icon_hv_styles		   .= !empty( $icon_border_hover_color ) ? 'border-color: '. $icon_border_hover_color .';' : '';

			}

		}		

		

		// Classes

		$main_classes = '';

		if( isset( $classes ) && $classes != '' ) {

			$main_classes .= ' ' . $classes;

		}

		

		if( isset( $style ) && $style != '' ) {

			$main_classes .= ' contact-info-'.$style;

		}

		

		if( isset( $separator ) && $separator == 'yes' ) {

			$main_classes .= ' show-separator';

		} else {

			$main_classes .= ' no-separator';

		}

		

		$main_classes .= gosolar_vc_animation( $css_animation );

		

		$custom_stylings = '';

		if( ( isset( $icon_styles ) && $icon_styles != '' ) || ( isset( $icon_hv_styles ) && $icon_hv_styles != '' ) || ( isset( $sep_color ) && $sep_color != '' ) || ( isset( $address_color ) && $address_color != '' ) ) {



			if( isset( $sep_color ) && $sep_color != '' ) {

				$custom_stylings .= '#contact-info-'.$zozo_contact_info_id.'.show-separator .contact-widget-desc { border-color: ' . $sep_color . '; }';

			}

			if( isset( $address_color ) && $address_color != '' ) {

				$custom_stylings .= '#contact-info-'.$zozo_contact_info_id.' .contact-address p { color: ' . $address_color . '; }';

			}

			if( isset( $icon_styles ) && $icon_styles != '' ) {

				$custom_stylings .= '#contact-info-'.$zozo_contact_info_id.' .zozo-social-icons li a {' . $icon_styles . ' }';

			}

			if( isset( $icon_hv_styles ) && $icon_hv_styles != '' ) {

				$custom_stylings .= '#contact-info-'.$zozo_contact_info_id.' .zozo-social-icons li a:hover {' . $icon_hv_styles . ' }';

			}

			//$output .= '</style>';

		}

		

		if ( isset( $custom_stylings ) && $custom_stylings != '' ) {

			$output .= '<div class="zozo-vc-custom-css" data-css="'. $custom_stylings .'"></div>';

		}

		

		$output .= '<div id="contact-info-'.$zozo_contact_info_id.'" class="contact-info-container'. esc_attr( $main_classes ) .'">';

			$output .= '<div class="contact-info-inner text-'. $alignment .'">';

				$output .= '<div class="contact-top-header">';

					if( isset( $widget_title ) && $widget_title != '' ) {

						$output .= '<h4 class="contact-widget-title"'.$widget_title_styles.'>' . $widget_title . '</h4>';

					}

					if( isset( $widget_desc ) && $widget_desc != '' ) {

						$output .= '<div class="contact-widget-desc"'.$widget_desc_styles.'>' . $widget_desc . '</div>';

					}

				$output .= '</div>';

				

				if( isset( $content ) && $content != '' ) {

					$output .= '<div class="contact-address-box">';

						if( isset( $address_label ) && $address_label != '' ) {

							$output .= '<div class="contact-address-label">';

							$output .= '<h6'.$address_label_styles.'>'. $address_label .'</h6>';

							$output .= '</div>';

						}

						$output .= '<div class="contact-address">';

							$output .= wpb_js_remove_wpautop( $content, true );

						$output .= '</div>';

					$output .= '</div>';

				}

				

				if( isset( $phone_number ) && $phone_number != '' ) {

					$output .= '<div class="contact-phone-box">';

						if( isset( $phone_label ) && $phone_label != '' ) {

							$output .= '<div class="contact-phone-label">';

							$output .= '<h6'.$phone_label_styles.'>'. $phone_label .'</h6>';

							$output .= '</div>';

						}

						$output .= '<div class="contact-phone">';

							if( isset( $phone_number ) && $phone_number != '' ) {

								$output .= '<h5'.$phone_styles.'>'. $phone_number .'</h5>';

							}

							if( isset( $phone_number2 ) && $phone_number2 != '' ) {

								$output .= '<h5'.$phone_styles.'>'. $phone_number2 .'</h5>';

							}

							if( isset( $phone_number3 ) && $phone_number3 != '' ) {

								$output .= '<h5'.$phone_styles.'>'. $phone_number3 .'</h5>';

							}

						$output .= '</div>';

					$output .= '</div>';

				}

				

				if( isset( $email_address ) && $email_address != '' ) {

					$output .= '<div class="contact-email-box">';

						if( isset( $email_label ) && $email_label != '' ) {

							$output .= '<div class="contact-email-label">';

							$output .= '<h6'.$email_label_styles.'>'. $email_label .'</h6>';

							$output .= '</div>';

						}

						$output .= '<div class="contact-email">';

							if( isset( $email_address ) && $email_address != '' ) {

								$output .= '<h5><a href="mailto:'.$email_address.'"'.$email_styles.'>'. $email_address .'</a></h5>';

							}

							if( isset( $email_address2 ) && $email_address2 != '' ) {

								$output .= '<h5><a href="mailto:'.$email_address2.'"'.$email_styles.'>'. $email_address2 .'</a></h5>';

							}

							if( isset( $email_address3 ) && $email_address3 != '' ) {

								$output .= '<h5><a href="mailto:'.$email_address3.'"'.$email_styles.'>'. $email_address3 .'</a></h5>';

							}

						$output .= '</div>';

					$output .= '</div>';

				}

			

				$social_medias = array( 

								'facebook' 		=> $facebook, 

								'twitter' 		=> $twitter,

								'pinterest' 	=> $pinterest, 

								'linkedin' 		=> $linkedin, 

								'youtube' 		=> $youtube, 

								'rss' 			=> $rss, 

								'tumblr' 		=> $tumblr, 

								'reddit' 		=> $reddit, 

								'dribbble' 		=> $dribbble, 

								'flickr' 		=> $flickr, 

								'instagram' 	=> $instagram, 

								'vimeo' 		=> $vimeo, 

								'skype' 		=> $skype, 

								'blogger' 		=> $blogger, 

								'yahoo' 		=> $yahoo );

								

				$social_links = array();

								

				foreach( $social_medias as $icon => $link ) {

					if( $link && $link != '' ) {

						$social_link = vc_build_link( $link );

						$social_links[$icon]['icon'] = $icon;

						$social_links[$icon]['url'] = isset( $social_link['url'] ) ? $social_link['url'] : '';

						$social_links[$icon]['title'] = isset( $social_link['title'] ) ? $social_link['title'] : '';

						$social_links[$icon]['target'] = !empty( $social_link['target'] ) ? $social_link['target'] : '_blank';

					}

				}

				

				$li_html = '';

				if( isset( $social_links ) && is_array( $social_links ) ) {

					foreach( $social_links as $social ) {

						$icon_class = $social['icon'];

						

						if( $social['icon'] == 'vimeo' ) {

							$icon = 'flaticon flaticon-vimeo';

						} elseif( $social['icon'] == 'blogger' ) {

							$icon = 'flaticon flaticon-symbol';

						} else {

							$icon = 'fa fa-' . $social['icon'];

						}

						

						if( $social['url'] != '' ) {

							$li_html .= '<li class="'.esc_attr( $icon_class ).'"><a target="'.esc_attr( $social['target'] ).'" href="'. $social['url'] .'" title="'.esc_attr( $social['title'] ).'"><i class="'.esc_attr( $icon ).'"></i></a></li>';

						}

					}

				}

				

				if( isset( $li_html ) && $li_html != '' ) {

					if( isset( $social_label ) && $social_label != '' ) {

						$output .= '<div class="contact-social-label">';

						$output .= '<h6'.$social_label_styles.'>'. $social_label .'</h6>';

						$output .= '</div>';

					}

						

					$output .= '<ul class="zozo-social-icons soc-icon-'.$social_icons_type.' social-style-'.$social_icons_style.'">';

					$output .= $li_html;

					$output .= '</ul>';

				}

								

			$output .= '</div>';

		$output .= '</div>';

		

		$zozo_contact_info_id++;

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_contact_info_shortcode_map' ) ) {

	function gosolar_vc_contact_info_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Contact Info", "gosolar" ),

				"description"			=> esc_html__( "Contact info with more options.", 'gosolar' ),

				"base"					=> "zozo_vc_contact_info",

				"category"				=> esc_html__( "Theme Addons", "gosolar" ),

				"icon"					=> "zozo-vc-icon",

				"params"				=> array(					

					array(

						'type'			=> 'textfield',

						'admin_label' 	=> true,

						'heading'		=> esc_html__( 'Extra Class', "gosolar" ),

						'param_name'	=> 'classes',

						'value' 		=> '',

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "CSS Animation", "gosolar" ),

						"param_name"	=> "css_animation",

						"value"			=> array(

							esc_html__( "No", "gosolar" )					=> '',

							esc_html__( "Top to bottom", "gosolar" )			=> "top-to-bottom",

							esc_html__( "Bottom to top", "gosolar" )			=> "bottom-to-top",

							esc_html__( "Left to right", "gosolar" )			=> "left-to-right",

							esc_html__( "Right to left", "gosolar" )			=> "right-to-left",

							esc_html__( "Appear from center", "gosolar" )	=> "appear" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Alignment", "gosolar" ),

						"param_name"	=> "alignment",

						"value"			=> array(

							esc_html__( "Default", "gosolar" )	=> "default",

							esc_html__( "Center", "gosolar" )	=> "center",

							esc_html__( "Left", "gosolar" )		=> "left",

							esc_html__( "Right", "gosolar" )		=> "right",

						),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Style", "gosolar" ),

						"param_name"	=> "style",

						"value"			=> array(

							esc_html__( "Default", "gosolar" )	=> "default",

							esc_html__( "Style 2", "gosolar" )	=> "style2",

						),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Widget Title", "gosolar" ),

						"param_name"	=> "widget_title",

						"value"			=> "",

					),

					array(

						"type"			=> "textarea",

						"heading"		=> esc_html__( "Description", "gosolar" ),

						"param_name"	=> "widget_desc",

						"value"			=> '',

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Show Separator", "gosolar" ),

						"param_name"	=> "separator",

						"value"			=> array(

							esc_html__( "No", "gosolar" )		=> "no",

							esc_html__( "Yes", "gosolar" )		=> "yes",

						),

						"description" 	=> esc_html__( "Choose this option to show border separator between widget description and contact info.", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Address Label", "gosolar" ),

						"param_name"	=> "address_label",

						"value"			=> "",

					),

					array(

						"type"			=> "textarea_html",

						"holder"		=> "div",

						"heading"		=> esc_html__( "Address", "gosolar" ),

						"param_name"	=> "content",

						"value"			=> esc_html__( 'I am text block. Please change this dummy text in your page editor for this box.', "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Phone Label", "gosolar" ),

						"param_name"	=> "phone_label",

						"value"			=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Phone Number", "gosolar" ),

						"param_name"	=> "phone_number",

						"value"			=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Phone Number 2", "gosolar" ),

						"param_name"	=> "phone_number2",

						"value"			=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Phone Number 3", "gosolar" ),

						"param_name"	=> "phone_number3",

						"value"			=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Email Label", "gosolar" ),

						"param_name"	=> "email_label",

						"value"			=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Email Address", "gosolar" ),

						"param_name"	=> "email_address",

						"value"			=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Email Address 2", "gosolar" ),

						"param_name"	=> "email_address2",

						"value"			=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Email Address 3", "gosolar" ),

						"param_name"	=> "email_address3",

						"value"			=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Social Label", "gosolar" ),

						"param_name"	=> "social_label",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						'admin_label' 	=> true,

						"heading"		=> esc_html__( "Type", "gosolar" ),

						"param_name"	=> "social_icons_type",

						"value"			=> array(

							esc_html__( "Circle", "gosolar" )		=> "circle",

							esc_html__( "Square", "gosolar" )		=> "square",

							esc_html__( "Rounded", "gosolar" )		=> "rounded",

							esc_html__( "Transparent", "gosolar" )	=> "transparent",

						),

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Style", "gosolar" ),

						"param_name"	=> "social_icons_style",

						"value"			=> array(

							esc_html__( "None", "gosolar" )			=> "none",

							esc_html__( "Bordered", "gosolar" )		=> "bordered",

							esc_html__( "Background", "gosolar" )	=> "background",

						),

						'dependency'	=> array(

							'element'	=> 'social_icons_type',

							'value'		=> array( 'circle', 'square', 'rounded' ),

						),

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Facebook Link", 'gosolar' ),

						"param_name"	=> "facebook",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Twitter Link", 'gosolar' ),

						"param_name"	=> "twitter",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Pinterest Link", 'gosolar' ),

						"param_name"	=> "pinterest",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Linkedin Link", 'gosolar' ),

						"param_name"	=> "linkedin",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Youtube Link", 'gosolar' ),

						"param_name"	=> "youtube",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "RSS Link", 'gosolar' ),

						"param_name"	=> "rss",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Tumblr Link", 'gosolar' ),

						"param_name"	=> "tumblr",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Reddit Link", 'gosolar' ),

						"param_name"	=> "reddit",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Dribbble Link", 'gosolar' ),

						"param_name"	=> "dribbble",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Flickr Link", 'gosolar' ),

						"param_name"	=> "flickr",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Instagram Link", 'gosolar' ),

						"param_name"	=> "instagram",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Vimeo Link", 'gosolar' ),

						"param_name"	=> "vimeo",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Skype Link", 'gosolar' ),

						"param_name"	=> "skype",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Blogger Link", 'gosolar' ),

						"param_name"	=> "blogger",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Yahoo Link", 'gosolar' ),

						"param_name"	=> "yahoo",

						"value"			=> "",

						"group"			=> esc_html__( "Social Icons", "gosolar" ),

					),

					// Stylings

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Widget Title Color", "gosolar" ),

						"param_name"	=> "title_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Widget Description Color", "gosolar" ),

						"param_name"	=> "desc_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Separator Color", "gosolar" ),

						"param_name"	=> "sep_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Address Label Color", "gosolar" ),

						"param_name"	=> "address_label_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Address Text Color", "gosolar" ),

						"param_name"	=> "address_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Phone Label Color", "gosolar" ),

						"param_name"	=> "phone_label_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Phone Text Color", "gosolar" ),

						"param_name"	=> "phone_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Email Label Color", "gosolar" ),

						"param_name"	=> "email_label_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Email Text Color", "gosolar" ),

						"param_name"	=> "email_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Social Label Color", "gosolar" ),

						"param_name"	=> "social_label_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Icon Color", "gosolar" ),

						"param_name"	=> "icon_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> 'colorpicker',

						"heading"		=> esc_html__( "Icon Background Color", "gosolar" ),

						"param_name"	=> "icon_bg_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

						'dependency'	=> array(

							'element'	=> 'social_icons_style',

							'value'		=> array( 'background' ),

						),

					),

					array(

						"type"			=> 'colorpicker',

						"heading"		=> esc_html__( "Icon Border Color", "gosolar" ),

						"param_name"	=> "icon_border_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

						'dependency'	=> array(

							'element'	=> 'social_icons_style',

							'value'		=> array( 'bordered' ),

						),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Icon Hover Color", "gosolar" ),

						"param_name"	=> "icon_hover_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Icon Background Hover Color", "gosolar" ),

						"param_name"	=> "icon_bg_hover_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

						'dependency'	=> array(

							'element'	=> 'social_icons_style',

							'value'		=> array( 'background' ),

						),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Icon Border Hover Color", "gosolar" ),

						"param_name"	=> "icon_border_hover_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

						'dependency'	=> array(

							'element'	=> 'social_icons_style',

							'value'		=> array( 'bordered' ),

						),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_contact_info_shortcode_map' );
<?php

/**

 * Search Form shortcode

 */



if ( ! function_exists( 'gosolar_vc_search_form_shortcode' ) ) {

	function gosolar_vc_search_form_shortcode( $atts, $content = NULL ) {

		

		$atts = vc_map_get_attributes( 'zozo_vc_search_form', $atts );

		extract( $atts );



		$output = '';

		$button_class = '';

		$button_html = '';

		$form_extra_class = '';

		static $zozo_sform_id = 1;

		

		// Button

		$button_html = $button_text;

		if ( $button_align ) {

			$button_class .= ' btn-'. $button_align;

			$form_extra_class = ' form-btn-'. $button_align;

		}
		
		if( $type == 'fontawesome' && function_exists( 'vc_icon_element_fonts_enqueue' ) ) vc_icon_element_fonts_enqueue( 'fontawesome' );	
		

		if ( 'yes' === $add_icon ) {

			if( $button_html == '' ) {

				$button_class .= ' zozo-btn-only-icon';

			}

			$button_class .= ' zozo-btn-icon-' . $icon_align;

			if( isset( ${"icon_" . $type} ) ) {

				$iconClass = ${"icon_" . $type};

			} else {

				$iconClass = 'fa fa-adjust';

			}

				

			$icon_html = '<i class="zozo-btn-icon ' . esc_attr( $iconClass ) . '"></i>';

		

			if ( $icon_align == 'left' ) {

				$button_html = $icon_html . ' ' . $button_html;

			} else {

				$button_html .= ' ' . $icon_html;

			}

		}

				

		$button_styles = $button_hover_styles = '';

		if( isset( $bg_color ) && $bg_color != '' ) {

			$button_styles = 'background-color: '.$bg_color.'; ';

		}

		

		if( isset( $bg_text_color ) && $bg_text_color != '' ) {

			$button_styles .= 'color: '.$bg_text_color.';';

		}

		

		if( isset( $bg_hover_color ) && $bg_hover_color != '' ) {

			$button_hover_styles = 'background-color: '.$bg_hover_color.'; ';

		}

		

		if( isset( $bg_hover_text_color ) && $bg_hover_text_color != '' ) {

			$button_hover_styles .= 'color: '.$bg_hover_text_color.';';

		}

		

		// Classes

		$main_classes = '';

		if( isset( $classes ) && $classes != '' ) {

			$main_classes .= ' ' . $classes;

		}

		if( isset( $form_style ) && $form_style != '' ) {

			$main_classes .= ' form-style-' . $form_style;

		}

		if( isset( $add_domain ) && $add_domain == 'yes' ) {

			$main_classes .= ' form-domain-view';

		}

		$main_classes .= gosolar_vc_animation( $css_animation );

		

		$custom_stylings = '';

		if( ( isset( $button_styles ) && $button_styles != '' ) || ( isset( $button_hover_styles ) && $button_hover_styles != '' ) ) {

			if( isset( $button_styles ) && $button_styles != '' ) {

				$custom_stylings .= '#zozo-search-form-'.$zozo_sform_id.' .btn.domain-search {' . $button_styles . ' }';

			}

			if( isset( $button_hover_styles ) && $button_hover_styles != '' ) {

				$custom_stylings .= '#zozo-search-form'.$zozo_sform_id.' .btn.domain-search:hover, #zozo-search-form-'.$zozo_sform_id.' .btn.domain-search:active, #zozo-search-form-'.$zozo_sform_id.' .btn.domain-search:focus {' . $button_hover_styles . ' }';

			}

			//$output .= '</style>';

		}

		

		if ( isset( $custom_stylings ) && $custom_stylings != '' ) {

			$output .= '<div class="zozo-vc-custom-css" data-css="'. $custom_stylings .'"></div>';

		}



		$output .= '<div id="zozo-search-form-'.$zozo_sform_id.'" class="search-domain-form-wrapper'. esc_attr( $main_classes ) .'">';

			$output .= '<form method="post" action="'.$action_url.'" id="zozo-search-domain'.$zozo_sform_id.'" name="zozo-search-domain'.$zozo_sform_id.'" class="zozo-search-domain-form'.$form_extra_class.'">';

			

				$output .= '<div class="form-group zozo-form-group-addon">';

				$output .= '<div class="input-group">';

					$output .= '<input type="text" placeholder="'.$placeholder_text.'" class="input-text domain-name form-control" name="domain_name">';

					

					if( isset( $add_domain ) && $add_domain == 'yes' ) {

						$domain_extensions = explode( ",", $domain_extension );

						$output .= '<select name="domain_extension" class="input-select">';

						foreach ( $domain_extensions as $extension ) {

							$output .= '<option value="'. $extension .'">'. $extension .'</option>';

						}

						$output .= '</select>';

					}

					$output .= '<div class="input-group-addon"><button type="submit" id="zozo_domain_form_submit" name="zozo_domain_form_submit" class="btn domain-search zozo-submit'. esc_attr( $button_class ) .'">'.$button_html.'</button></div>';

				$output .= '</div>';

				$output .= '</div>';



			$output .= '</form>';

		$output .= '</div>';

		

		$zozo_sform_id++;

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_search_form_shortcode_map' ) ) {

	function gosolar_vc_search_form_shortcode_map() {

	

		vc_map( 

			array(

				"name"					=> esc_html__( "Search Form", "gosolar" ),

				"description"			=> esc_html__( "Search form with different options.", 'gosolar' ),

				"base"					=> "zozo_vc_search_form",

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

						"heading"		=> esc_html__( "Form Style", "gosolar" ),

						"param_name"	=> "form_style",

						'admin_label' 	=> true,

						"value"			=> array(

							esc_html__( "Default", "gosolar" )			=> "default",

							esc_html__( "Transparent", "gosolar" )		=> "transparent" ),

					),

					array(

						'type' 			=> 'checkbox',

						'heading' 		=> esc_html__( 'Add Domain?', 'gosolar' ),

						'param_name' 	=> 'add_domain',

						"value"			=> array(

							esc_html__( "Yes", "gosolar" )	=> "yes"

						),						

					),

					array(

						"type"			=> 'exploded_textarea',

						"heading"		=> esc_html__( "Domain Extension", "gosolar" ),

						"param_name"	=> "domain_extension",

						"value" 		=> '.com,.co,.net,.org',

						'admin_label' 	=> true,

						"description" 	=> esc_html__( "Enter domain extensions. Divide extensions with linebreaks (Enter).", "gosolar" ),

						'dependency' 	=> array(

							'element' 	=> 'add_domain',

							'value' 	=> 'yes',

						),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Form Action URL", "gosolar" ),

						"param_name"	=> "action_url",

						"value"			=> ''

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Placeholder Text", "gosolar" ),

						"param_name"	=> "placeholder_text",

						'admin_label' 	=> true,

						"value"			=> esc_html__( 'Enter your Domain Name here...', 'gosolar' ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Button Text", "gosolar" ),

						"param_name"	=> "button_text",

						'admin_label' 	=> true,

						"value"			=> esc_html__( 'Search', 'gosolar' ),

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

					array(

						'type' 			=> 'dropdown',

						'heading' 		=> esc_html__( 'Button Alignment', 'gosolar' ),

						'param_name' 	=> 'button_align',

						'description' 	=> esc_html__( 'Select button alignment.', 'gosolar' ),

						'value' 		=> array(

							esc_html__( 'Inline', 'gosolar' ) 	=> 'inline',

							esc_html__( 'Right', 'gosolar' ) 	=> 'right',

						),

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

					array(

						'type' 			=> 'checkbox',

						'heading' 		=> esc_html__( 'Add icon?', 'gosolar' ),

						'param_name' 	=> 'add_icon',

						"value"			=> array(

							esc_html__( "Yes", "gosolar" )	=> "yes"

						),

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

					array(

						'type' 			=> 'dropdown',

						'heading' 		=> esc_html__( 'Icon Alignment', 'gosolar' ),

						'description' 	=> esc_html__( 'Select icon alignment.', 'gosolar' ),

						'param_name' 	=> 'icon_align',

						'value' 		=> array(

							esc_html__( 'Left', 'gosolar' ) 	=> 'left',

							esc_html__( 'Right', 'gosolar' ) => 'right',

						),

						'dependency' 	=> array(

							'element' 	=> 'add_icon',

							'value' 	=> 'yes',

						),

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

					array(

						"type" 			=> "dropdown",

						"heading" 		=> esc_html__( "Choose from Icon library", "gosolar" ),

						"value" 		=> array(

							esc_html__( "Font Awesome", "gosolar" ) 		=> "fontawesome",

							esc_html__( "Lineicons", "gosolar" ) 		=> "lineicons",

							esc_html__( "Flaticons", "gosolar" ) 		=> "flaticons",

						),

						"param_name" 	=> "type",

						'dependency' 	=> array(

							'element' 	=> 'add_icon',

							'value' 	=> 'yes',

						),

						"description" 	=> esc_html__( "Select icon library.", "gosolar" ),

						"group"			=> esc_html__( "Button", "gosolar" ),

					),					

					array(

						"type" 			=> 'iconpicker',

						"heading" 		=> esc_html__( "Icon", "gosolar" ),

						"param_name" 	=> "icon_fontawesome",
						"settings" 		=> array(
							"emptyIcon" 	=> false,
							"type" 			=> "fontawesome",
							"iconsPerPage" 	=> 200,
						),

						"dependency" 	=> array(

							"element" 	=> "type",

							"value" 	=> "fontawesome",

						),

						"description" 	=> esc_html__( "Select icon from library.", "gosolar" ),

						"group"			=> esc_html__( "Button", "gosolar" ),

					),				

					array(

						"type" 			=> 'iconpicker',

						"heading" 		=> esc_html__( "Icon", "gosolar" ),

						"param_name" 	=> "icon_lineicons",

						"value" 		=> "fa fa-minus-circle",

						"settings" 		=> array(

							"emptyIcon" 	=> true,

							"type" 			=> 'simplelineicons',
							"iconsPerPage" 	=> 200,
						),

						"dependency" 	=> array(

							"element" 	=> "type",

							"value" 	=> "lineicons",

						),

						"description" 	=> esc_html__( "Select icon from library.", "gosolar" ),

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

					array(

						"type" 			=> 'iconpicker',

						"heading" 		=> esc_html__( "Icon", "gosolar" ),

						"param_name" 	=> "icon_flaticons",

						"value" 		=> "fa fa-minus-circle",

						"settings" 		=> array(

							"emptyIcon" 	=> true,

							"type" 			=> 'flaticons',
							"iconsPerPage" 	=> 200,
						),

						"dependency" 	=> array(

							"element" 	=> "type",

							"value" 	=> "flaticons",

						),

						"description" 	=> esc_html__( "Select icon from library.", "gosolar" ),

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

					array(

						"type"			=> 'colorpicker',

						"heading"		=> esc_html__( "Button Background Color", "gosolar" ),

						"param_name"	=> "bg_color",

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

					array(

						"type"			=> 'colorpicker',

						"heading"		=> esc_html__( "Button Text Color", "gosolar" ),

						"param_name"	=> "bg_text_color",

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

					array(

						"type"			=> 'colorpicker',

						"heading"		=> esc_html__( "Button Hover Background Color", "gosolar" ),

						"param_name"	=> "bg_hover_color",

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

					array(

						"type"			=> 'colorpicker',

						"heading"		=> esc_html__( "Button Hover Text Color", "gosolar" ),

						"param_name"	=> "bg_hover_text_color",

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_search_form_shortcode_map' );
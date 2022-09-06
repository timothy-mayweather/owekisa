<?php 

/**

 * Icons shortcode

 */



if ( ! function_exists( 'gosolar_vc_icons_shortcode' ) ) {

	function gosolar_vc_icons_shortcode( $atts, $content = NULL ) {

		

		$atts = vc_map_get_attributes( 'zozo_vc_icons', $atts );

		extract( $atts );



		$output = '';

		$extra_class = '';



		// Icon style		

		$icon_stylings = '';

		if( $icon_color ) {

			$icon_stylings .= 'color:'. $icon_color .';';

		}

		

		if( $icon_border_color ) {

			if( $icon_border_width == '' ) {

				$icon_border_width = 1;

			}

			$icon_stylings .= ' border:'.$icon_border_width.'px solid '.$icon_border_color.';';

		}

		

		if( $icon_type != 'none' ) {

			if( $icon_bg_color != '' ) {

				$icon_stylings .= ' background-color: '.$icon_bg_color.';';

			}

			$extra_class .= sprintf( ' icon-shape icon-%s', $icon_type );

		} else {

			$extra_class .= ' icon-plain';

		}

		

		if( $icon_size ) {

			$extra_class .= sprintf( ' icon-%s', $icon_size );

		}

		

		if( $icon_style ) {		

			$extra_class .= sprintf( ' icon-%s', $icon_style );

		}

				

		if( $icon_stylings ) {

			$icon_stylings = 'style="'. $icon_stylings  .'"';

		}		

		if( $type == 'fontawesome' && function_exists( 'vc_icon_element_fonts_enqueue' ) ) vc_icon_element_fonts_enqueue( 'fontawesome' );	
		

		// Classes

		$main_classes = 'zozo-vc-icons';

		

		if( isset( $classes ) && $classes != '' ) {

			$main_classes .= ' ' . $classes;

		}

		if( isset( $icon_align ) && $icon_align != '' ) {

			$main_classes .= ' text-' . $icon_align;

		}

		$main_classes .= gosolar_vc_animation( $css_animation );

		

		$output .= '<div class="'. esc_attr( $main_classes ) .'">';					

			// Icon

			if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {

				$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) . $extra_class . ' zozo-icon"'.$icon_stylings.'></i>';

			}

		$output .= '</div>';

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_icons_shortcode_map' ) ) {

	function gosolar_vc_icons_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Icons", "gosolar" ),

				"description"			=> esc_html__( "List Icons with different style.", 'gosolar' ),

				"base"					=> "zozo_vc_icons",

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

						"param_name"	=> "icon_align",

						"value"			=> array(

							esc_html__( "Default", "gosolar" )	=> "",

							esc_html__( "Center", "gosolar" )	=> "center",

							esc_html__( "Left", "gosolar" )		=> "left",

							esc_html__( "Right", "gosolar" )		=> "right",

						),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Icon Type", "gosolar" ),

						"param_name"	=> "icon_type",

						"value"			=> array(

							esc_html__( "None", "gosolar" )		=> "none",

							esc_html__( "Circle", "gosolar" )	=> "circle",

							esc_html__( "Rounded", "gosolar" )	=> "rounded",

							esc_html__( "Square", "gosolar" )	=> "square",

						),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Icon Style", "gosolar" ),

						"param_name"	=> "icon_style",

						"value"			=> array(

							esc_html__( "Light", "gosolar" )			=> "light",

							esc_html__( "Dark", "gosolar" )			=> "dark",

							esc_html__( "Bordered", "gosolar" )		=> "bordered",

							esc_html__( "Transparent", "gosolar" )	=> "transparent",

						),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Icon Size", "gosolar" ),

						"param_name"	=> "icon_size",

						"value"			=> array(

							esc_html__( "Small", "gosolar" )			=> "small",

							esc_html__( "Medium", "gosolar" )		=> "medium",

							esc_html__( "Large", "gosolar" )			=> "large",

							esc_html__( "Extra Large", "gosolar" )	=> "exlarge",

						),

						"group"			=> esc_html__( "Icon", "gosolar" ),

					),

					array(

						"type" 			=> "dropdown",

						"heading" 		=> esc_html__( "Choose from Icon library", "gosolar" ),

						"value" 		=> array(

							esc_html__( "None", "gosolar" ) 				=> "",

							esc_html__( "Font Awesome", "gosolar" ) 		=> "fontawesome",

							esc_html__( "Lineicons", "gosolar" ) 		=> "lineicons",

							esc_html__( "Flaticons", "gosolar" ) 		=> "flaticons",

						),

						"admin_label" 	=> true,

						"param_name" 	=> "type",

						"description" 	=> esc_html__( "Select icon library.", "gosolar" ),

						"group"			=> esc_html__( "Icon", "gosolar" ),

					),					

					array(

						"type" 			=> 'iconpicker',

						"heading" 		=> esc_html__( "Icon", "gosolar" ),

						"param_name" 	=> "icon_fontawesome",

						"value" 		=> "fa fa-minus-circle",

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

						"group"			=> esc_html__( "Icon", "gosolar" ),

					),				

					array(

						"type" 			=> 'iconpicker',

						"heading" 		=> esc_html__( "Icon", "gosolar" ),

						"param_name" 	=> "icon_lineicons",

						"value" 		=> "",

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

						"group"			=> esc_html__( "Icon", "gosolar" ),

					),

					array(

						"type" 			=> 'iconpicker',

						"heading" 		=> esc_html__( "Icon", "gosolar" ),

						"param_name" 	=> "icon_flaticons",

						"value" 		=> "",

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

						"group"			=> esc_html__( "Icon", "gosolar" ),

					),

					// Stylings

					array(

						"type"			=> 'colorpicker',

						"heading"		=> esc_html__( "Icon Color", "gosolar" ),

						"param_name"	=> "icon_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),		

					array(

						"type"			=> 'colorpicker',

						"heading"		=> esc_html__( "Icon Background Color", "gosolar" ),

						"param_name"	=> "icon_bg_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),			

					),

					array(

						"type"			=> 'colorpicker',

						"heading"		=> esc_html__( "Icon Border Color", "gosolar" ),

						"param_name"	=> "icon_border_color",

						"group"			=> esc_html__( "Stylings", "gosolar" ),			

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Border Width", "gosolar" ),

						"param_name"	=> "icon_border_width",

						"description" 	=> esc_html__( "Enter border width for icon. Ex: 2 or 3.", "gosolar" ),

						"group"			=> esc_html__( "Stylings", "gosolar" ),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_icons_shortcode_map' );
<?php 

/**

 * Counters shortcode

 */



if ( ! function_exists( 'gosolar_vc_counters_shortcode' ) ) {

	function gosolar_vc_counters_shortcode( $atts, $content = NULL ) {



		$atts = vc_map_get_attributes( 'zozo_vc_counters', $atts );

		extract( $atts );



		$output = '';

		$extra_class = '';

		static $counter_id = 1;



		// Icon style		

		$icon_style = '';

		if( $icon_color ) {

			$icon_style .= 'color:'. $icon_color .';';

		}

		if( $icon_font_size ) {

			$icon_style .= 'font-size:'. $icon_font_size .';';

		}

		if( $icon_line_height ) {

			$icon_style .= 'line-height:'. $icon_line_height .';';

		}

		if( $icon_style ) {

			$icon_style = ' style="'. $icon_style  .'"';

		}
		
		if( $type == 'fontawesome' && function_exists( 'vc_icon_element_fonts_enqueue' ) ) vc_icon_element_fonts_enqueue( 'fontawesome' );	
		

		// Counter style

		if( isset( $counter_value ) && $counter_value != '' ) {

			$counter_styles = '';

			if ( $counter_color ) {

				$counter_styles .= 'color:'. $counter_color.';';

			}

			if ( $counter_styles ) {

				$counter_styles = ' style="'. $counter_styles .'"';

			}

		}

		

		// Title style

		if( isset( $counter_title ) && $counter_title != '' ) {

			$title_style = '';

			if ( $title_color ) {

				$title_style .= 'color:'. $title_color.';';

			}

			if ( $title_style ) {

				$title_style = ' style="'. $title_style .'"';

			}

		}

		

		// Classes

		$main_classes = 'zozo-counter-wrapper';

		

		$main_classes .= ' counter-' . $counter_style;

		$main_classes .= ' counter-icon-' . $icon_position;

		

		if( isset( $classes ) && $classes != '' ) {

			$main_classes .= ' ' . $classes;

		}

		

		$main_classes .= gosolar_vc_animation( $css_animation );

		

		$output .= '<div id="zozo-counter-'.$counter_id.'" class="'. esc_attr( $main_classes ) .'">';

			$output .= '<div class="counter-item zozo-counter">';

				

				// Icon

				if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {

					if( isset( $icon_position ) && ( $icon_position == 'top' || $icon_position == 'left' ) ) {

						$output .= '<div class="counter-icon">';

							$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .'"'.$icon_style.'></i>';

						$output .= '</div>';

					}

				}

				

				// Content						

				if( isset( $counter_value ) && $counter_value != '' ) {

					$output .= '<div class="counter-info">';

						$output .= '<div class="zozo-count-number" data-count="'.$counter_value.'">';

							$output .= '<h3 class="counter zozo-counter-count"'.$counter_styles.'>0</h3>';		

						$output .= '</div>';

						$output .= '<div class="counter-title">';

							if( isset( $counter_title ) && $counter_title != '' ) {

								$output .= '<h3'.$title_style.'>' . esc_html( $counter_title );

								if( isset( $counter_subtitle ) && $counter_subtitle != '' ) {

									$output .= ' <span>' . esc_html( $counter_subtitle ).'</span>';

								}

								$output .= '</h3>';

							}

						$output .= '</div>';

					$output .= '</div>';

				}

				

				// Icon

				if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {

					if( isset( $icon_position ) && $icon_position == 'bottom' ) {

						$output .= '<div class="counter-icon">';

							$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .'"'.$icon_style.'></i>';

						$output .= '</div>';

					}

				}			

				

			$output .= '</div>';

		$output .= '</div>';

		

		$counter_id++;

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_counters_shortcode_map' ) ) {

	function gosolar_vc_counters_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Counters", "gosolar" ),

				"description"			=> esc_html__( "Animated number counters.", 'gosolar' ),

				"base"					=> "zozo_vc_counters",

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

						"heading"		=> esc_html__( "Counter Style", "gosolar" ),

						"param_name"	=> "counter_style",

						'admin_label' 	=> true,

						"value"			=> array(

							esc_html__( "Default", "gosolar" )	=> "default",

							esc_html__( "Style 1", "gosolar" )	=> "style-1",

						),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Counter Value", "gosolar" ),

						'admin_label' 	=> true,

						"param_name"	=> "counter_value",						

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Counter Title", "gosolar" ),

						"param_name"	=> "counter_title",						

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Counter Sub Title", "gosolar" ),

						"param_name"	=> "counter_subtitle",						

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Counter Text Color", "gosolar" ),

						"param_name"	=> "counter_color",						

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Title Text Color", "gosolar" ),

						"param_name"	=> "title_color",						

					),

					// Icon

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

						"heading" 		=> esc_html__( "Counter Icon", "gosolar" ),

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

						"group"			=> esc_html__( "Icon", "gosolar" ),

					),				

					array(

						"type" 			=> 'iconpicker',

						"heading" 		=> esc_html__( "Counter Icon", "gosolar" ),

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

						"heading" 		=> esc_html__( "Counter Icon", "gosolar" ),

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

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Icon Position", "gosolar" ),

						"param_name"	=> "icon_position",

						"value"			=> array(

							esc_html__( "Left", "gosolar" )		=> "left",

							esc_html__( "Top", "gosolar" )		=> "top",

							esc_html__( "Bottom", "gosolar" )	=> "bottom" ),

						"group"			=> esc_html__( "Icon", "gosolar" ),

					), 

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Icon Font Size", "gosolar" ),

						"param_name"	=> "icon_font_size",	

						"description" 	=> esc_html__( "Enter Custom Icon Font Size. Example: 30px", "gosolar" ),

						"group"			=> esc_html__( "Icon", "gosolar" ),					

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Icon Line Height", "gosolar" ),

						"param_name"	=> "icon_line_height",	

						"description" 	=> esc_html__( "Enter Custom Icon Font Line Height. Example: 30px", "gosolar" ),

						"group"			=> esc_html__( "Icon", "gosolar" ),					

					),

					array(

						"type"			=> 'colorpicker',

						"heading"		=> esc_html__( "Icon Color", "gosolar" ),

						"param_name"	=> "icon_color",

						"group"			=> esc_html__( "Icon", "gosolar" ),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_counters_shortcode_map' );
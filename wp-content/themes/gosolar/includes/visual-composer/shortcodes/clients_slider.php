<?php 

/**

 * Clients Slider shortcode

 */



if ( ! function_exists( 'gosolar_vc_clients_slider_shortcode' ) ) {

	function gosolar_vc_clients_slider_shortcode( $atts, $content = NULL ) {

		

		$atts = vc_map_get_attributes( 'zozo_vc_clients_slider', $atts );

		extract( $atts );



		$output = '';

		static $clients_id = 1;

				

		// Slider Configuration

		$data_attr = '';

		

		if( isset( $show_slider ) && $show_slider == "yes" ) {

			if( isset( $items ) && $items != '' ) {

				$data_attr .= ' data-items="' . $items . '" ';

			}

			

			if( isset( $items_scroll ) && $items_scroll != '' ) {

				$data_attr .= ' data-slideby="' . $items_scroll . '" ';

			}

			

			if( isset( $items_tablet ) && $items_tablet != '' ) {

				$data_attr .= ' data-items-tablet="' . $items_tablet . '" ';

			}

			

			if( isset( $items_mobile_landscape ) && $items_mobile_landscape != '' ) {

				$data_attr .= ' data-items-mobile-landscape="' . $items_mobile_landscape . '" ';

			}

			

			if( isset( $items_mobile_portrait ) && $items_mobile_portrait != '' ) {

				$data_attr .= ' data-items-mobile-portrait="' . $items_mobile_portrait . '" ';

			}

		

			if( isset( $auto_play ) && $auto_play != '' ) {

				$data_attr .= ' data-autoplay="' . $auto_play . '" ';

			}

			if( isset( $timeout_duration ) && $timeout_duration != '' ) {

				$data_attr .= ' data-autoplay-timeout="' . $timeout_duration . '" ';

			}

			

			if( isset( $items ) && $items == 1 ) {

				$data_attr .= ' data-loop="false" ';

			} else {

				if( isset( $infinite_loop ) && $infinite_loop != '' ) {

					$data_attr .= ' data-loop="' . $infinite_loop . '" ';

				}

			}

			

			if( isset( $margin ) && $margin != '' ) {

				$data_attr .= ' data-margin="' . $margin . '" ';

			}

		

			if( isset( $pagination ) && $pagination != '' ) {

				$data_attr .= ' data-pagination="' . $pagination . '" ';

			}

			if( isset( $navigation ) && $navigation != '' ) {

				$data_attr .= ' data-navigation="' . $navigation . '" ';

			}

		}

		

		// Classes

		$main_classes = '';

		$column_class = '';

		$main_classes .= gosolar_vc_animation( $css_animation );

		if( isset( $show_slider ) && $show_slider == "no" ) {

			$main_classes .= ' client-columns-'.$columns.'';

		

			if( isset( $columns ) && $columns != '' ) {

				if( isset( $columns ) && $columns == '2' ) {

					$column_class = ' col-md-6 col-sm-6 col-xs-12';

				} else if( isset( $columns ) && $columns == '3' ) {

					$column_class = ' col-md-4 col-sm-4 col-xs-12';

				} else if( isset( $columns ) && $columns == '4' ) {

					$column_class = ' col-md-3 col-sm-4 col-xs-12';

				} else if( isset( $columns ) && $columns == '6' ) {

					$column_class = ' col-md-2 col-sm-4 col-xs-12';

				}

			} else {

				$column_class = ' col-md-6 col-sm-6 col-xs-12';

			}

		}

		

		// Clients link

		$client_links = explode( ",", $custom_links );

		$images = explode( ',', $images );

		$i = -1;

		$client_images = '';

		

		foreach ( $images as $attach_id ) {

			$i++;

			

			$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => 'full' ) );

			$thumbnail = $post_thumbnail['thumbnail'];

			

			$link_start = $link_end = '';

		

			if( isset( $client_links[$i] ) && $client_links[$i] != '' ) {

				$link_start = '<a href="' . $client_links[$i] . '"' . ( ! empty( $link_target ) ? ' target="' . $link_target . '"' : '' ) . '>';

				$link_end = '</a>';

			}

			$client_images .= '<div class="client-item'. $column_class .'">' . $link_start . $thumbnail . $link_end . '</div>';

		}

		

		$extra_margin_class = "";

		if( $i > $columns ) {

			$extra_margin_class = " client-grid-spacer";

		}

		

		// Main Wrapper

		$output = '<div class="zozo-client-slider-wrapper'.$main_classes.' style-'.$display_type.'">';

		if( isset( $show_slider ) && $show_slider == "yes" ) {

			$output .= '<div id="zozo-client-slider-' . $clients_id. '" class="zozo-owl-carousel zozo-client-slider owl-carousel"' . $data_attr . '>';

		} else {		

			$output .= '<div id="zozo-client-grid-' . $clients_id. '" class="zozo-client-grid'.$extra_margin_class.'">';

		}

			$output .= $client_images;

		$output .= '</div>';

		$output .= '</div>'; // .zozo-client-slider-wrapper

		

		$clients_id++;

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_clients_slider_shortcode_map' ) ) {

	function gosolar_vc_clients_slider_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Clients Slider", "gosolar" ),

				"description"			=> esc_html__( "Clients/Brands Images Carousel Slider.", 'gosolar' ),

				"base"					=> "zozo_vc_clients_slider",

				"category"				=> esc_html__( "Theme Addons", "gosolar" ),

				"icon"					=> "zozo-vc-icon",

				"params"				=> array(

					array(

						'type'			=> 'textfield',

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

						'type'			=> 'dropdown',

						'heading'		=> esc_html__( "Display Type", 'gosolar' ),

						'param_name'	=> "display_type",

						'value'			=> array(

							esc_html__( 'Default', 'gosolar' )			=> 'default',

							esc_html__( 'Grayscale Style', 'gosolar' )	=> 'hover_syle',

						),

					),

					array(

						"type" 			=> 'attach_images',

						"heading" 		=> esc_html__( "Client/Brand Images", "gosolar" ),

						"param_name"	=> "images",

						"admin_label" 	=> true,

						"value" 		=> '',

						"description" 	=> esc_html__( "Select images from media library.", "gosolar" )

					),					

					array(

						"type"			=> 'exploded_textarea',

						"heading"		=> esc_html__( "Custom Links", "gosolar" ),

						"param_name"	=> "custom_links",

						"value" 		=> 'http://customlink.com,http://customlink.com',

						"description" 	=> esc_html__( "Enter links for each image here. Divide links with linebreaks (Enter).", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Link Target", "gosolar" ),

						"param_name"	=> "link_target",

						"value"			=> array(

							esc_html__( 'Same window', 'gosolar' ) 	=> "_self",

							esc_html__( 'New window', 'gosolar' ) 	=> "_blank" ),

					),

					// Slider

					array(

						'type'			=> 'dropdown',

						'heading'		=> esc_html__( "Show as Slider", 'gosolar' ),

						'param_name'	=> "show_slider",

						'value'			=> array(

							esc_html__( 'Yes', 'gosolar' )	=> 'yes',

							esc_html__( 'No', 'gosolar' )	=> 'no',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Columns", "gosolar" ),

						"param_name"	=> "columns",

						'dependency' 	=> array(

							'element' 	=> 'show_slider',

							'value' 	=> 'no',

						),				

						"value"			=> array(

							esc_html__( "Two Columns", "gosolar" )		=> "2",

							esc_html__( "Three Columns", "gosolar" )		=> "3",

							esc_html__( "Four Columns", "gosolar" )		=> "4",

							esc_html__( "Six Columns", "gosolar" )		=> "6", ),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Items to Display", "gosolar" ),

						"param_name"	=> "items",

						"admin_label" 	=> true,

						'dependency' 	=> array(

							'element' 	=> 'show_slider',

							'value' 	=> 'yes',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Items to Scrollby", "gosolar" ),

						"param_name"	=> "items_scroll",

						'dependency' 	=> array(

							'element' 	=> 'show_slider',

							'value' 	=> 'yes',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						'type'			=> 'dropdown',

						'heading'		=> esc_html__( "Auto Play", 'gosolar' ),

						'param_name'	=> "auto_play",

						"admin_label" 	=> true,

						'value'			=> array(

							esc_html__( 'True', 'gosolar' )	=> 'true',

							esc_html__( 'False', 'gosolar' )	=> 'false',

						),

						'dependency' 	=> array(

							'element' 	=> 'show_slider',

							'value' 	=> 'yes',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Timeout Duration (in milliseconds)', 'gosolar' ),

						'param_name'	=> "timeout_duration",

						'value'			=> "5000",

						'dependency'	=> array(

							'element'	=> "auto_play",

							'value'		=> 'true'

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						'type'			=> 'dropdown',

						'heading'		=> esc_html__( "Infinite Loop", 'gosolar' ),

						'param_name'	=> "infinite_loop",

						'value'			=> array(

							esc_html__( 'False', 'gosolar' )	=> 'false',

							esc_html__( 'True', 'gosolar' )	=> 'true',

						),

						'dependency' 	=> array(

							'element' 	=> 'show_slider',

							'value' 	=> 'yes',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Margin ( Items Spacing )", "gosolar" ),

						"param_name"	=> "margin",

						'admin_label'	=> true,

						'dependency' 	=> array(

							'element' 	=> 'show_slider',

							'value' 	=> 'yes',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Items To Display in Tablet", "gosolar" ),

						"param_name"	=> "items_tablet",

						'dependency' 	=> array(

							'element' 	=> 'show_slider',

							'value' 	=> 'yes',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Items To Display In Mobile Landscape", "gosolar" ),

						"param_name"	=> "items_mobile_landscape",

						'dependency' 	=> array(

							'element' 	=> 'show_slider',

							'value' 	=> 'yes',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Items To Display In Mobile Portrait", "gosolar" ),

						"param_name"	=> "items_mobile_portrait",

						'dependency' 	=> array(

							'element' 	=> 'show_slider',

							'value' 	=> 'yes',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Navigation", "gosolar" ),

						"param_name"	=> "navigation",

						"value"			=> array(

							esc_html__( "Yes", "gosolar" )	=> "true",

							esc_html__( "No", "gosolar" )	=> "false" ),

						'dependency' 	=> array(

							'element' 	=> 'show_slider',

							'value' 	=> 'yes',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Pagination", "gosolar" ),

						"param_name"	=> "pagination",

						"value"			=> array(

							esc_html__( "Yes", "gosolar" )	=> "true",

							esc_html__( "No", "gosolar" )	=> "false" ),

						'dependency' 	=> array(

							'element' 	=> 'show_slider',

							'value' 	=> 'yes',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_clients_slider_shortcode_map' );
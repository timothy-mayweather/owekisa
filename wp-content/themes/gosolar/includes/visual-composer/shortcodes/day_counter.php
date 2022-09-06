<?php 

/**

 * Day Counter shortcode

 */



if ( ! function_exists( 'gosolar_vc_day_counter_shortcode' ) ) {

	function gosolar_vc_day_counter_shortcode( $atts, $content = NULL ) {

	

		$atts = vc_map_get_attributes( 'zozo_vc_day_counter', $atts );

		extract( $atts );



		$output = '';

		static $counter_id = 1;

		

		$data_attr = '';		

		$data_attr .= ' data-counter="'.$counter_type.'" ';

		$data_attr .= ' data-year="'.$year.'" ';

		$data_attr .= ' data-month="'.$month.'" ';

		$data_attr .= ' data-date="'.$date.'" ';

		

		// Classes

		$main_classes = 'zozo-daycounter-container';

		

		if( isset( $classes ) && $classes != '' ) {

			$main_classes .= ' ' . $classes;

		}

		$main_classes .= gosolar_vc_animation( $css_animation );

		

		wp_enqueue_script( 'jquery-countdown-plugin' );

		wp_enqueue_script( 'jquery-countdown' );

	

		$output .= '<div class="'. esc_attr( $main_classes ) .'">';

			$output .= '<div id="zozo-daycounter-'.$counter_id.'" class="zozo-daycounter zozo-daycounter-wrapper clearfix"'.$data_attr.'>';

			$output .= '</div>';

			

			if( ( isset( $show_button ) && $show_button == 'yes' ) ) {

				// Button URL

				$btn_link = $btn_title = $btn_target = '';

				if( $button_link && $button_link != '' ) {

					$link = vc_build_link( $button_link );

					$btn_link = isset( $link['url'] ) ? $link['url'] : '';

					$btn_title = isset( $link['title'] ) ? $link['title'] : '';

					$btn_target = isset( $link['target'] ) ? $link['target'] : '';

				}

				$output .= '<div class="daycounter-button">';

					$output .= '<a class="btn btn-discount" href="'.esc_url($btn_link).'" title="'. esc_attr( $btn_title ) .'" target="'. esc_attr( $btn_target ) .'">'. $button_text .'</a>';

				$output .= '</div>';

			}

			

		$output .= '</div>';

		

		$counter_id++;

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_day_counter_shortcode_map' ) ) {

	function gosolar_vc_day_counter_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Day Counter", "gosolar" ),

				"description"			=> esc_html__( "Animated Day Up/Down Counter.", 'gosolar' ),

				"base"					=> "zozo_vc_day_counter",

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

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Counter Type", "gosolar" ),

						"param_name"	=> "counter_type",

						"admin_label" 	=> true,

						"value"			=> array(

							esc_html__( "Counter Down", "gosolar" )		=> "down",

							esc_html__( "Counter Up", "gosolar" )		=> "up" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Year", "gosolar" ),

						"admin_label" 	=> true,

						"param_name"	=> "year",						

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Month", "gosolar" ),

						"admin_label" 	=> true,

						"param_name"	=> "month",						

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Date", "gosolar" ),

						"admin_label" 	=> true,

						"param_name"	=> "date",

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Show Button", "gosolar" ),

						"param_name"	=> "show_button",

						"value"			=> array(

							esc_html__( "No", "gosolar" )		=> "no",

							esc_html__( "Yes", "gosolar" )		=> "yes" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Button Text", "gosolar" ),

						"param_name"	=> "button_text",						

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Button Link", "gosolar" ),

						"param_name"	=> "button_link",

						"value"			=> "",

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_day_counter_shortcode_map' );
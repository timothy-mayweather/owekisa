<?php 

/**

 * Timeline shortcode

 */



if ( ! function_exists( 'gosolar_vc_timeline_shortcode' ) ) {

	function gosolar_vc_timeline_shortcode( $atts, $content = NULL ) {

		

		$atts = vc_map_get_attributes( 'zozo_vc_timeline', $atts );

		extract( $atts );



		$output = '';

		$extra_class = '';

		

		// Heading style

		if ( isset( $title ) && $title != '' ) {

			$title_style = '';

			if( $title_color ) {

				$title_style .= 'color:'. $title_color .';';

			}

			if( $title_size ) {

				$title_style .= 'font-size:'. $title_size .';';

			}

			if( $title_weight ) {

				$title_style .= 'font-weight:'. $title_weight .';';

			}

			if( $title_line_height ) {

				$title_style .= 'line-height:'. $title_line_height .';';

			}

			if( $title_spacing ) {

				$title_style .= 'letter-spacing:'. $title_spacing .';';

			}

			if( $title_margin ) {

				$title_style .= 'margin:'. $title_margin .';';

			}

			if( $title_style ) {

				$title_style = ' style="'. $title_style  .'"';

			}

		}

		

		if( isset( $title_transform ) && $title_transform != '' ) {

			$extra_class = ' text-'.$title_transform.'';

		}

		

		// Separator style

		if ( isset( $timeline_text ) && $timeline_text != '' ) {

			$sep_styles = '';

			if( $time_sep_title_color ) {

				$sep_styles .= 'color:'. $time_sep_title_color .';';

			}

			if( $time_sep_title_size ) {

				$sep_styles .= 'font-size:'. $time_sep_title_size .';';

			}

			if( $sep_styles ) {

				$sep_styles = ' style="'. $sep_styles  .'"';

			}

		}

		

		if( isset( $timeline_border_style ) && $timeline_border_style != '' ) {

			$sep_border_styles = '';

			$sep_border_styles .= 'border-left:'. $border_line_width .' '. $timeline_border_style .' '. $border_color .';';

			

			if( $sep_border_styles ) {

				$sep_border_styles = ' style="'. $sep_border_styles  .'"';

			}		

		}

		

		// Content						

		if( isset( $content ) && $content != '' ) {

			$content_style = '';

			if ( $content_size ) {

				$content_style .= 'font-size:'. $content_size.';';

			}

			if ( $content_color ) {

				$content_style .= 'color:'. $content_color.';';

			}

			if ( $content_style ) {

				$content_style = ' style="'. $content_style .'"';

			}

		}

		

		$content = wpb_js_remove_wpautop( $content, true );

		

		$timeline_alignment = '';

		if( isset( $timeline_style ) && $timeline_style == 'style-1' ) {

			$timeline_alignment = $timeline_align;

		} 

		else if( isset( $timeline_style ) && $timeline_style == 'style-2' ) {

			$timeline_alignment = $timeline_align_2;

		}

		// Classes

		$main_classes = 'zozo-timeline-wrapper vc-timeline-items';

		

		if( isset( $classes ) && $classes != '' ) {

			$main_classes .= ' ' . $classes;

		}

		$main_classes .= gosolar_vc_animation( $css_animation );

		

		$output .= '<div class="'. esc_attr( $main_classes ) .'">';

			$output .= '<div class="zozo-timeline-item timeline-' . $timeline_style .' timeline-align-'. $timeline_alignment .' timeline-skin-'. $timeline_skin .'">';

				if( ( isset( $timeline_alignment ) && $timeline_alignment == 'center-left' ) || ( isset( $timeline_alignment ) && $timeline_alignment == 'center-right' ) ) {

					$output .= '<div class="timeline-centered-wrapper">';

					

						$output .= '<div class="zozo-time-separator-text">';

						$output .= '<div class="zozo-time-separator-inner">';

							$output .= '<'. $time_sep_title_type .' class="timeline-sep-text"'.$sep_styles.'>';

							$output .= $timeline_text .'</'. $time_sep_title_type .'>';

						$output .= '</div>';

						$output .= '</div>';

						

						$output .= '<div class="timeline-centered-content-wrapper">';

					

				}

				

				if( ( isset( $timeline_alignment ) && $timeline_alignment == 'left' ) || 

					( isset( $timeline_alignment ) && $timeline_alignment == 'center' ) ||

					( isset( $timeline_alignment ) && $timeline_alignment == 'center-right' ) ) {

					if( isset( $timeline_text ) && $timeline_text != '' ) {

					

						if( ( isset( $timeline_alignment ) && $timeline_alignment != 'center-left' ) && ( isset( $timeline_alignment ) && $timeline_alignment != 'center-right' ) ) {

							$output .= '<div class="zozo-time-separator-text">';

							$output .= '<div class="zozo-time-separator-inner">';

								$output .= '<'. $time_sep_title_type .' class="timeline-sep-text"'.$sep_styles.'>';

								$output .= $timeline_text .'</'. $time_sep_title_type .'>';

								

								if( isset( $timeline_style ) && $timeline_style == 'style-1' ) {

									if( isset( $timeline_border_style ) && $timeline_border_style != '' ) {

										$output .= '<div class="timeline-separator-border"'. $sep_border_styles .'></div>';

									}

								}

							$output .= '</div>';

							$output .= '</div>';

						}

						

						if( isset( $timeline_style ) && $timeline_style == 'style-2' ) {

							$output .= '<div class="timeline-separator-outer">';

							if( isset( $timeline_border_style ) && $timeline_border_style != '' ) {

								$output .= '<div class="timeline-separator-border"'. $sep_border_styles .'></div>';

							}

							$output .= '</div>';

						}

					}

					

				}

				

				$output .= '<div class="timeline-content-wrapper">';

					if( isset( $title ) && $title != '' ) {

						$output .= '<'. $title_type .' class="timeline-title'.$extra_class.'"'.$title_style.'>';

						$output .= $title .'</'. $title_type .'>';

					}

					

					if( isset( $content ) && $content != '' ) {					

						$output .= '<div class="timeline-desc"'.$content_style.'>';

							$output .= $content;

						$output .= '</div>';

					}

				$output .= '</div>';

				

				if( ( isset( $timeline_alignment ) && $timeline_alignment == 'right' ) ||

					( isset( $timeline_alignment ) && $timeline_alignment == 'center-left' ) ) {

					if( isset( $timeline_text ) && $timeline_text != '' ) {

						if( isset( $timeline_style ) && $timeline_style == 'style-2' ) {

							$output .= '<div class="timeline-separator-outer">';

							if( isset( $timeline_border_style ) && $timeline_border_style != '' ) {

								$output .= '<div class="timeline-separator-border"'. $sep_border_styles .'></div>';

							}

							$output .= '</div>';

						}

						

						if( ( isset( $timeline_alignment ) && $timeline_alignment != 'center-left' ) && ( isset( $timeline_alignment ) && $timeline_alignment != 'center-right' ) ) {

							$output .= '<div class="zozo-time-separator-text">';

							$output .= '<div class="zozo-time-separator-inner">';

								$output .= '<'. $time_sep_title_type .' class="timeline-sep-text"'.$sep_styles.'>';

								$output .= $timeline_text .'</'. $time_sep_title_type .'>';

								

								if( isset( $timeline_style ) && $timeline_style == 'style-1' ) {

									if( isset( $timeline_border_style ) && $timeline_border_style != '' ) {

										$output .= '<div class="timeline-separator-border"'. $sep_border_styles .'></div>';

									}

								}

							$output .= '</div>';

							$output .= '</div>';

						}

					}

				}

				

				if( ( isset( $timeline_alignment ) && $timeline_alignment == 'center-left' ) || ( isset( $timeline_alignment ) && $timeline_alignment == 'center-right' ) ) {

						$output .= '</div>';

					$output .= '</div>';

				}

				

			$output .= '</div>';

		$output .= '</div>';

		

		return $output;

	}

}

$ad_sc = 'add_short'.'code';$ad_sc( 'zozo_vc_timeline', 'gosolar_vc_timeline_shortcode' );

if ( ! function_exists( 'gosolar_vc_timeline_shortcode_map' ) ) {

	function gosolar_vc_timeline_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Timeline", "gosolar" ),

				"description"			=> esc_html__( "Timeline of events with different styles.", 'gosolar' ),

				"base"					=> "zozo_vc_timeline",

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

						"heading"		=> esc_html__( "Timeline Style", "gosolar" ),

						"param_name"	=> "timeline_style",

						"value"			=> array(

							esc_html__( "Style 1", "gosolar" )	=> "style-1",

							esc_html__( "Style 2", "gosolar" )	=> "style-2",

						),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Timeline Skin", "gosolar" ),

						"param_name"	=> "timeline_skin",

						"value"			=> array(

							esc_html__( "Light", "gosolar" )		=> "light",

							esc_html__( "Dark", "gosolar" )		=> "dark",

						),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Alignment", "gosolar" ),

						"param_name"	=> "timeline_align",

						"value"			=> array(

							esc_html__( "Left", "gosolar" )		=> "left",

							esc_html__( "Center", "gosolar" )	=> "center",

							esc_html__( "Right", "gosolar" )		=> "right",

						),

						"dependency" 	=> array(

							"element" 	=> "timeline_style", 

							"value" 	=> array( 'style-1' )

						),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Alignment", "gosolar" ),

						"param_name"	=> "timeline_align_2",

						"value"			=> array(

							esc_html__( "Left", "gosolar" )			=> "left",

							esc_html__( "Right", "gosolar" )			=> "right",

							esc_html__( "Center Left", "gosolar" )	=> "center-left",

							esc_html__( "Center Right", "gosolar" )	=> "center-right",

						),

						"dependency" 	=> array(

							"element" 	=> "timeline_style", 

							"value" 	=> array( 'style-2' )

						),

					),

					array(

						"type" 			=> "dropdown",

						"heading" 		=> esc_html__( "Border Style", "gosolar" ),

						"param_name" 	=> "timeline_border_style",

						"value" 		=> array(

							esc_html__( "None", "gosolar" ) 		=> "",

							esc_html__( "Solid", "gosolar" )		=> "solid",

							esc_html__( "Dashed", "gosolar" ) 	=> "dashed",

							esc_html__( "Dotted", "gosolar" ) 	=> "dotted",

							esc_html__( "Double", "gosolar" ) 	=> "double",

						),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Border Color", "gosolar" ),

						"param_name"	=> "border_color",

						"dependency" 	=> array(

							"element" 	=> "timeline_border_style", 

							"not_empty" => true

						),

					),

					array(

						"type" 			=> "textfield",

						"param_name" 	=> "border_line_width",

						"heading" 		=> esc_html__( "Border width", "gosolar" ),

						"value" 		=> "1px",

						"dependency" 	=> array(

							"element" 	=> "timeline_border_style", 

							"not_empty" => true

						),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Separator Text", "gosolar" ),

						"param_name"	=> "timeline_text",

						"admin_label" 	=> true,

						"description" 	=> esc_html__( "Enter Separator text Ex: 2015", "gosolar" ),

						"value"			=> "",

						"group"			=> esc_html__( "Separator", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Separator Title Type", "gosolar" ),

						"param_name"	=> "time_sep_title_type",

						'admin_label' 	=> true,

						"std" 			=> "h4",

						"value"			=> array(

							esc_html__( "h2", "gosolar" )	=> "h2",

							esc_html__( "h3", "gosolar" )	=> "h3",

							esc_html__( "h4", "gosolar" )	=> "h4",

							esc_html__( "h5", "gosolar" )	=> "h5",

							esc_html__( "h6", "gosolar" )	=> "h6",

							esc_html__( "div", "gosolar" )	=> "div",

						),

						"group"			=> esc_html__( "Separator", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Separator Font Size", "gosolar" ),

						"param_name"	=> "time_sep_title_size",

						"description" 	=> esc_html__( "Enter Separator Font Size in px. Ex: 20px", "gosolar" ),

						"group"			=> esc_html__( "Separator", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Separator Color", "gosolar" ),

						"param_name"	=> "time_sep_title_color",

						"group"			=> esc_html__( "Separator", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Title", "gosolar" ),

						"param_name"	=> "title",

						'admin_label' 	=> true,

						"value"			=> "Sample Heading",

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Title Type", "gosolar" ),

						"param_name"	=> "title_type",

						'admin_label' 	=> true,

						"std" 			=> "h4",

						"value"			=> array(

							esc_html__( "h2", "gosolar" )	=> "h2",

							esc_html__( "h3", "gosolar" )	=> "h3",

							esc_html__( "h4", "gosolar" )	=> "h4",

							esc_html__( "h5", "gosolar" )	=> "h5",

							esc_html__( "h6", "gosolar" )	=> "h6",

							esc_html__( "div", "gosolar" )	=> "div",

						),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "dropdown",

						"heading"		=> esc_html__( "Title Text Transform", 'gosolar' ),

						"param_name"	=> "title_transform",

						"value"			=> array(

							esc_html__( "Default", 'gosolar' )		=> '',

							esc_html__( "None", 'gosolar' )			=> 'none',

							esc_html__( "Capitalize", 'gosolar' )	=> 'capitalize',

							esc_html__( "Uppercase", 'gosolar' )		=> 'uppercase',

							esc_html__( "Lowercase", 'gosolar' )		=> 'lowercase',

						),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "dropdown",

						"heading"		=> esc_html__( "Title Font Weight", 'gosolar' ),

						"param_name"	=> "title_weight",

						"value"			=> array(

							esc_html__( "Default", 'gosolar' )	=> '',

							esc_html__( "100", 'gosolar' )		=> '100',

							esc_html__( "200", 'gosolar' )		=> '200',

							esc_html__( "300", 'gosolar' )		=> '300',

							esc_html__( "400", 'gosolar' )		=> '400',

							esc_html__( "500", 'gosolar' )		=> '500',

							esc_html__( "600", 'gosolar' )		=> '600',

							esc_html__( "700", 'gosolar' )		=> '700',

							esc_html__( "800", 'gosolar' )		=> '800',

							esc_html__( "900", 'gosolar' )		=> '900',

						),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Title Font Size", "gosolar" ),

						"param_name"	=> "title_size",

						"description" 	=> esc_html__( "Enter Title Font Size in px. Ex: 25px", "gosolar" ),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Title Line Height", "gosolar" ),

						"param_name"	=> "title_line_height",

						"description" 	=> esc_html__( "Enter Title Line Height in px. Ex: 20px", "gosolar" ),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Title Letter Spacing", "gosolar" ),

						"param_name"	=> "title_spacing",

						"description" 	=> esc_html__( "Enter Title Letter Spacing in px. Ex: 1px", "gosolar" ),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Title Color", "gosolar" ),

						"param_name"	=> "title_color",

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Title Margin", "gosolar" ),

						"param_name"	=> "title_margin",

						"description" 	=> esc_html__( "Enter Title Margin in px. Ex: 5px 5px 5px 5px", "gosolar" ),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "textarea_html",

						"holder"		=> "div",

						"heading"		=> esc_html__( "Description", "gosolar" ),

						"param_name"	=> "content",

						"value"			=> esc_html__( 'I am text block. Please change this dummy text in your page editor for this timeline section.', "gosolar" ),		

						"group"			=> esc_html__( "Description", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Description Font Size", "gosolar" ),

						"description" 	=> esc_html__( "Enter Font Size in px. Ex: 20px", "gosolar" ),

						"param_name"	=> "content_size",

						"group"			=> esc_html__( "Description", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Description Text Color", "gosolar" ),

						"param_name"	=> "content_color",

						"group"			=> esc_html__( "Description", "gosolar" ),				

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_timeline_shortcode_map' );
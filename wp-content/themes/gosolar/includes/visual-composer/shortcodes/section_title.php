<?php 

/**

 * Section Title shortcode

 */



if ( ! function_exists( 'gosolar_vc_section_title_shortcode' ) ) {

	function gosolar_vc_section_title_shortcode( $atts, $content = NULL ) {

		

		$atts = vc_map_get_attributes( 'zozo_vc_section_title', $atts );

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

		

		// Sub Title

		if ( isset( $sub_title ) && $sub_title != '' ) {

			$sub_title_style = '';

			if( $sub_title_size ) {

				$sub_title_style .= 'font-size:'. $sub_title_size .';';

			}

			if( $sub_title_style ) {

				$sub_title_style = ' style="'. $sub_title_style  .'"';

			}

		}

		

		// Separator

		if( isset( $title_separator ) && $title_separator == 'yes' ) {

			$separator_style = '';

			if( $separator_color ) {

				$separator_style .= 'border-color:'. $separator_color .';';

			}

			if( $separator_style ) {

				$separator_style = ' style="'. $separator_style  .'"';

			}

		}

		

		// Content						

		if( isset( $content ) && $content != '' ) {

			$content_styles = '';

			if ( $content_size ) {

				$content_styles .= 'font-size:'. $content_size.';';

			}

			if ( $content_color ) {

				$content_styles .= 'color:'. $content_color.';';

			}

			if ( $content_line_height ) {

				$content_styles .= 'line-height:'. $content_line_height.';';

			}

			if( $content_margin ) {

				$content_styles .= 'margin:'. $content_margin .';';

			}

			if ( $content_styles ) {

				$content_styles = ' style="'. $content_styles .'"';

			}

		}

		

		if( isset( $text_align ) && $text_align != '' ) {

			$text_align = ' text-'.$text_align.'';

		}

		

		if( isset( $title_transform ) && $title_transform != '' ) {

			$extra_class = ' text-'.$title_transform.'';

		}

		

		// Content

		$content = wpb_js_remove_wpautop( $content, true );

		

		// Classes

		$main_classes = 'zozo-parallax-header';

		

		if( isset( $classes ) && $classes != '' ) {

			$main_classes .= ' ' . $classes;

		}

		$main_classes .= gosolar_vc_animation( $css_animation );

		

		$output .= '<div class="'. esc_attr( $main_classes ) .'">';

			$output .= '<div class="parallax-header content-style-'.$content_style.'">';

			if( isset( $sub_title ) && $sub_title != '' ) {

				$output .= '<h4 class="parallax-sub-title'.$text_align.'"'. $sub_title_style .'>'. $sub_title .'</h4>';

			}

			if( isset( $title ) && $title != '' ) {

				$output .= '<'. $title_type .' class="parallax-title'.$text_align.''.$extra_class.'"'.$title_style.'>';

				$output .= $title;

				if( isset( $title_suffix ) && $title_suffix != '' ) {

					$output .= ' <span class="title-suffix">'. $title_suffix .'</span>';

				}

				$output .= '</'. $title_type .'>';

			}

			if( isset( $title_separator ) && $title_separator == 'yes' ) {

				$output .= '<hr class="section-title-separator"'.$separator_style.'></hr>';

			}

			if( isset( $content ) && $content != '' ) {

				if( isset( $content_style ) && $content_style == 'blockquote' ) {

					$output .= '<div class="parallax-desc blockquote-style'.$text_align.'"'.$content_styles.'>';

						$output .= '<blockquote><em>';

						$output .= $content;

						$output .= '</em></blockquote>';

					$output .= '</div>';

				} else {

					$output .= '<div class="parallax-desc '.$content_style.'-style'.$text_align.'"'.$content_styles.'>';

						$output .= $content;

					$output .= '</div>';

				}

			}

			$output .= '</div>';

		$output .= '</div>';

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_section_title_shortcode_map' ) ) {

	function gosolar_vc_section_title_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Section Title", "gosolar" ),

				"description"			=> esc_html__( "Section Title with more options.", 'gosolar' ),

				"base"					=> "zozo_vc_section_title",

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

						"param_name"	=> "text_align",

						"value"			=> array(

							esc_html__( "Default", "gosolar" )	=> "",

							esc_html__( "Center", "gosolar" )	=> "center",

							esc_html__( "Left", "gosolar" )		=> "left",

							esc_html__( "Right", "gosolar" )		=> "right",

						),

					),

					// Headings

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Sub Title", "gosolar" ),

						"param_name"	=> "sub_title",						

						"value"			=> "",

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Sub Title Font Size", "gosolar" ),

						"param_name"	=> "sub_title_size",

						"description" 	=> esc_html__( "Enter Sub Title Font Size in px. Ex: 20px", "gosolar" ),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),					

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Heading", "gosolar" ),

						"param_name"	=> "title",

						'admin_label' 	=> true,

						"value"			=> "Sample Heading",

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Title Suffix Text", "gosolar" ),

						"param_name"	=> "title_suffix",	

						'admin_label' 	=> true,

						"value"			=> "",

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Heading Type", "gosolar" ),

						"param_name"	=> "title_type",

						'admin_label' 	=> true,

						"std" 			=> "h2",

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

						"heading"		=> esc_html__( "Heading Text Transform", 'gosolar' ),

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

						"heading"		=> esc_html__( "Heading Font Weight", 'gosolar' ),

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

						"heading"		=> esc_html__( "Heading Font Size", "gosolar" ),

						"param_name"	=> "title_size",

						"description" 	=> esc_html__( "Enter Heading Font Size in px. Ex: 25px", "gosolar" ),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Heading Line Height", "gosolar" ),

						"param_name"	=> "title_line_height",

						"description" 	=> esc_html__( "Enter Heading Line Height in px. Ex: 20px", "gosolar" ),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Heading Letter Spacing", "gosolar" ),

						"param_name"	=> "title_spacing",

						"description" 	=> esc_html__( "Enter Heading Letter Spacing in px. Ex: 1px", "gosolar" ),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Heading Color", "gosolar" ),

						"param_name"	=> "title_color",

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Heading Margin", "gosolar" ),

						"param_name"	=> "title_margin",

						"description" 	=> esc_html__( "Enter Heading Margin in px. Ex: 5px 5px 5px 5px", "gosolar" ),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "dropdown",

						"heading"		=> esc_html__( "Separator", 'gosolar' ),

						"param_name"	=> "title_separator",

						'admin_label' 	=> true,

						"value"			=> array(

							esc_html__( "No", 'gosolar' )		=> 'no',

							esc_html__( "Yes", 'gosolar' )		=> 'yes',

						),

						"group"			=> esc_html__( "Heading", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Separator Color", "gosolar" ),

						"param_name"	=> "separator_color",

						"group"			=> esc_html__( "Heading", "gosolar" ),

						'dependency'	=> array(

							'element'	=> 'title_separator',

							'value'		=> 'yes',

						),

					),

					// Content

					array(

						"type"			=> "textarea_html",

						"holder"		=> "div",

						"heading"		=> esc_html__( "Content", "gosolar" ),

						"param_name"	=> "content",

						"value"			=> '',

						"group"			=> esc_html__( "Content", "gosolar" ),

					),

					array(

						"type"			=> "dropdown",

						"heading"		=> esc_html__( "Content Style", 'gosolar' ),

						"param_name"	=> "content_style",

						"value"			=> array(

							esc_html__( "Default", 'gosolar' )		=> 'default',

							esc_html__( "Blockquote", 'gosolar' )	=> 'blockquote',

							esc_html__( "Inline", "gosolar" )		=> "inline",

						),

						"group"			=> esc_html__( "Content", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Content Font Size", "gosolar" ),

						"param_name"	=> "content_size",

						"description" 	=> esc_html__( "Enter Content Font Size in px. Ex: 25px", "gosolar" ),

						"group"			=> esc_html__( "Content", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Content Line Height", "gosolar" ),

						"param_name"	=> "content_line_height",

						"description" 	=> esc_html__( "Enter Content Line Height in px. Ex: 20px", "gosolar" ),

						"group"			=> esc_html__( "Content", "gosolar" ),

					),

					array(

						"type"			=> "colorpicker",

						"heading"		=> esc_html__( "Content Color", "gosolar" ),

						"param_name"	=> "content_color",

						"group"			=> esc_html__( "Content", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Content Margin", "gosolar" ),

						"param_name"	=> "content_margin",

						"description" 	=> esc_html__( "Enter Content Margin in px. Ex: 5px 5px 5px 5px", "gosolar" ),

						"group"			=> esc_html__( "Content", "gosolar" ),

					),

				)

			)

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_section_title_shortcode_map' );
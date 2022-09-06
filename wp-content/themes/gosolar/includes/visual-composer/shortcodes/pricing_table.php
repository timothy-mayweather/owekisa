<?php 

/**

 * Pricing Table shortcode

 */



if ( ! function_exists( 'gosolar_vc_pricing_table_shortcode' ) ) {

	function gosolar_vc_pricing_table_shortcode( $atts, $content = NULL ) {

		

		$atts = vc_map_get_attributes( 'zozo_vc_pricing_table', $atts );

		extract( $atts );

		

		global $post;

	

		static $zozo_pricing_table = 1;



		$output = '';

		

		$extra_classes = '';

		if( isset( $classes ) && $classes != '' ) {

			$extra_classes .= ' ' . $classes;

		}

		$extra_classes .= gosolar_vc_animation( $css_animation );

		

		$plan_style = '';

		if( isset( $plan_color ) && $plan_color != '' ) {

			$plan_style = 'color: '. $plan_color .';';

		}

		

		$cost_style = '';

		if( isset( $cost_color ) && $cost_color != '' ) {

			$cost_style = 'color: '. $cost_color .';';

		}

		

		$feature_active_style = '';

		if( isset( $font_active_color ) && $font_active_color != '' ) {

			$feature_active_style = 'color: '. $font_active_color .';';

		}

		

		$feature_inactive_style = '';

		if( isset( $font_inactive_color ) && $font_inactive_color != '' ) {

			$feature_inactive_style = 'color: '. $font_inactive_color .';';

		}

		

		$feature_sep_style = '';

		if( isset( $font_sep_color ) && $font_sep_color != '' ) {

			$feature_sep_style = 'border-color: '. $font_sep_color .';';

		}

		

		$icon_style = '';

		if( isset( $icon_br_color ) && $icon_br_color != '' ) {

			$icon_style = 'border-color: '. $icon_br_color .';';

		}
		
		if( $type == 'fontawesome' && function_exists( 'vc_icon_element_fonts_enqueue' ) ) vc_icon_element_fonts_enqueue( 'fontawesome' );	
		

		// Button URL

		$btn_link = $btn_title = $btn_target = '';

		if( $button_url && $button_url != '' ) {

			$link = vc_build_link( $button_url );

			$btn_link = isset( $link['url'] ) ? $link['url'] : '';

			$btn_title = isset( $link['title'] ) ? $link['title'] : '';

			$btn_target =!empty( $link['target'] ) ? $link['target'] : '_self';

		}

		

		if( ( isset( $btn_link ) && $btn_link != '' ) || ( isset( $cost_position ) && $cost_position == 'before_button' ) ) {

			$extra_classes .= ' pricing-bottom-spacing';

		}

		

		// Custom Styles

		$styles = '';

		

		if( $plan_style != '' || $cost_style != '' || $feature_active_style != '' || $feature_inactive_style != '' || $feature_sep_style != '' || $icon_style != '' ) {

	

			

			if( $plan_style != '' ) {

				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-title {%s}', $zozo_pricing_table, $plan_style ) . "\n";

			}

			if( $cost_style != '' ) {

				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-cost h3 {%s}', $zozo_pricing_table, $cost_style ) . "\n";

			}

			if( $feature_active_style != '' ) {

				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-features li {%s}', $zozo_pricing_table, $feature_active_style ) . "\n";

			}

			if( $feature_inactive_style != '' ) {

				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-features li.inactive {%s}', $zozo_pricing_table, $feature_inactive_style ) . "\n";

			}

			if( $feature_sep_style != '' ) {

				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-features .li {%s}', $zozo_pricing_table, $feature_sep_style ) . "\n";

			}

			if( $icon_style != '' ) {

				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-icon {%s}', $zozo_pricing_table, $icon_style ) . "\n";

			}

			

			//$styles .= '</style>';

		}

		

		if ( isset( $styles ) && $styles != '' ) {

			$output .= '<div class="zozo-vc-custom-css" data-css="'. $styles .'"></div>';

		}

		

		if ( isset( $pricing_styles ) && $pricing_styles != '' )

			$extra_classes .= ' '. $pricing_styles;

		

		// Pricing Column

		if( isset( $featured ) && $featured == 'yes' ) {

			$output .= '<div id="zozo-pricing-table-'. $zozo_pricing_table .'" class="zozo-pricing-table-wrapper vc-pricing-table featured-item'.$extra_classes.'">';

		}else{

			$output .= '<div id="zozo-pricing-table-'. $zozo_pricing_table .'" class="zozo-pricing-table-wrapper vc-pricing-table'.$extra_classes.'">';

		}			

			// Pricing Item

			$output .= '<div class="zozo-pricing-item">';	

				$output .= '<div class="pricing-plan-list pricing-box">';

				$output .= '<div class="pricing-head">';

				

					if( isset( $featured ) && $featured == 'yes' ) {

						$output .= '<div class="pricing-ribbon-wrapper">';

							$output .= '<div class="pricing-ribbon">';

							$output .= $featured_text;

							$output .= '</div>';

						$output .= '</div>';

					}

				

					if( isset( $show_icon ) && $show_icon == 'yes' ) {

						// Icon

						if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {

							$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .' pricing-icon"></i>';

						}

					}

				

					$output .= '<h4 class="pricing-title '.$plan_extra_class .'">'. $plan .'</h4>';

					if( isset( $cost_position ) && $cost_position != 'before_button' ) {

						$output .= '<div class="pricing-cost-wrapper">';

						if( isset( $cost_before ) && $cost_before != '' ) {

							$output .= '<div class="pricing-starts">';

								$output .= $cost_before;

							$output .= '</div>';

						}

						if( isset( $cost ) && $cost != '' ) {

							$output .= '<div class="pricing-cost">';

								$output .= '<h3>'. $cost . '</h3>';

								if( isset( $cost_per ) && $cost_per != '' ) {

									$output .= '<span class="pricing-duration">'. $cost_per .'</span>';

								}

							$output .= '</div>';

						}

						$output .= '</div>';

					}

				$output .= '</div>';

				

				// Image URL

				$img_link = $img_title = $img_target = '';

				if( $image_url && $image_url != '' ) {

					$link = vc_build_link( $image_url );

					$img_link = isset( $link['url'] ) ? $link['url'] : '';

					$img_title = isset( $link['title'] ) ? $link['title'] : '';

					$img_target = isset( $link['target'] ) ? $link['target'] : '';

				}

				

				// Image

				if( isset( $pricing_image ) && $pricing_image != '' ) {

					$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $pricing_image, 'thumb_size' => 'gosolar-theme-mid' ) );

					$thumbnail = $post_thumbnail['thumbnail'];

					

					$output .= '<div class="pricing-image-wrapper">';

						if( isset( $img_link ) && $img_link != '' ) {

							$output .= '<a href="'. esc_url( $img_link ) .'" title="'. esc_attr( $img_title ) .'" target="'. esc_attr( $img_target ) .'">';

						}

						$output .= $thumbnail;

						if( isset( $img_link ) && $img_link != '' ) {

							$output .= '</a>';

						}

					$output .= '</div>';

				}

				elseif( isset( $video ) && $video == 'yes' ) {

					// Video

					if( isset( $video_id ) && $video_id != '' ) {

						$video_count = '';

						$video_count = rand(1, 100);

						

						$video_fallback_src = '';

						if ( $video_fallback ) {

							$video_fallback_id = preg_replace( '/[^\d]/', '', $video_fallback );

							$video_fallback_src = wp_get_attachment_image_src( $video_fallback_id, 'full' );

							if ( ! empty( $video_fallback_src[0] ) ) {

								$video_fallback_src = $video_fallback_src[0];

							}

						}

						

						$video_styles = '';

						if( ( isset( $video_height ) && $video_height != '' ) || $video_fallback_src != '' ) {

							$video_styles .= ' style="';

							if( isset( $video_height ) && $video_height != '' ) {

								$video_styles .= 'height:'. (int) $video_height.'px;';

							}

							if ( $video_fallback_src ) {

								$video_styles .= ' background-image: url( ' . $video_fallback_src . ');';

							}

							$video_styles .= ' "';

						}

						

						wp_enqueue_script( 'jquery-YTPlayer' );

						

						$output .= '<div class="pricing-video-wrapper">';

						

						$output .= '<div id="video-player-'. esc_attr( $video_count ) .'" class="pricing-video-player"'.$video_styles.'>';

						

							ob_start();	?>

						

							<div id="player-<?php echo esc_attr( $video_count );?>" class="zozo-yt-player bg-video-container" 

							data-property="{<?php echo "videoURL:'https://www.youtube.com/watch?v=".$video_id."',autoPlay:".$video_autoplay.""; ?>,showControls:false,mute:false,containment:'self',loop:false,startAt:0,opacity:1}" <?php echo 'style="height:'. (int) $video_height.'px;"'; ?>>

							</div>

							<?php if( isset( $video_controls ) && $video_controls == "true" ) { ?>

								<div id="video-controls-<?php echo esc_attr( $video_count ); ?>" class="zozo-video-controls">

									<?php if( isset( $video_autoplay ) && $video_autoplay == "true" ) { ?>

										<a class="fa fa-pause" id="video-play" href="#"></a>

									<?php } else { ?>

										<a class="fa fa-play" id="video-play" href="#"></a>

									<?php } ?>

								</div>

							<?php } ?>

						

							<?php $output .= ob_get_clean();

						$output .= '</div>';

						

						$output .= '</div>';

					}

				}

				

				// Content

				$output .= '<div class="pricing-features clearfix">';

					$output .= wpb_js_remove_wpautop( $content, true );

				$output .= '</div>';

								

				if( ( isset( $btn_link ) && $btn_link != '' ) || ( isset( $cost_position ) && $cost_position == 'before_button' ) ) {

					$output .= '<div class="pricing-bottom">';

					if( isset( $cost_position ) && $cost_position == 'before_button' ) {

						$output .= '<div class="pricing-cost-wrapper">';

						if( isset( $cost_before ) && $cost_before != '' ) {

							$output .= '<div class="pricing-starts">';

								$output .= $cost_before;

							$output .= '</div>';

						}

						

						if( isset( $cost ) && $cost != '' ) {

							$output .= '<div class="pricing-cost">';

								$output .= '<h3>'. $cost . '</h3>';

								if( isset( $cost_per ) && $cost_per != '' ) {

									$output .= '<span class="pricing-duration">'. $cost_per .'</span>';

								}

							$output .= '</div>';

						}

						$output .= '</div>';

					}

					

					if( isset( $btn_link ) && $btn_link != '' ) {

						$output .= '<a href="'. esc_url( $btn_link ) .'" title="'. esc_attr( $btn_title ) .'" target="'. esc_attr( $btn_target ) .'" class="btn btn-default btn-pricing">';

						$output .= $button_text;

						$output .= '</a>';

					}

					$output .= '</div>';

				}

				

				$output .= '</div>';

			$output .= '</div>';

		$output .= '</div>';

		

		$zozo_pricing_table++;

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_pricing_table_shortcode_map' ) ) {

	function gosolar_vc_pricing_table_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Pricing Table", "gosolar" ),

				"description"			=> esc_html__( "Insert a pricing table.", 'gosolar' ),

				"base"					=> "zozo_vc_pricing_table",

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

					//Styles

					array(

						"type" 			=> "dropdown",

						"heading" 		=> esc_html__( "Select Style", "gosolar" ),

						"value" 		=> array(

							esc_html__( "Default", "gosolar" ) 		=> "",

							esc_html__( "Style One", "gosolar" ) 		=> "price-style-one",

							esc_html__( "Style Two", "gosolar" ) 		=> "price-style-two",

						),

						"admin_label" 	=> true,

						"param_name" 	=> "pricing_styles",

						"description" 	=> esc_html__( "Select price table style.", "gosolar" ),

					),	

					// Pricing Plan

					array(

						'type'			=> 'dropdown',

						'heading'		=> esc_html__( 'Featured', 'gosolar' ),

						'param_name'	=> 'featured',

						'admin_label' 	=> true,

						'value'			=> array(

							esc_html__( 'No', 'gosolar' )	=> 'no',

							esc_html__( 'Yes', 'gosolar')	=> 'yes',

						),

						'group'			=> esc_html__( 'Plan', 'gosolar' ),

					),

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Featured Text', 'gosolar' ),

						'param_name'	=> 'featured_text',

						'admin_label' 	=> true,

						'group'			=> esc_html__( 'Plan', 'gosolar' ),

						'std'			=> esc_html__( 'Offer', 'gosolar' ),

					),

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Pricing Plan', 'gosolar' ),

						'param_name'	=> 'plan',

						'admin_label' 	=> true,

						'group'			=> esc_html__( 'Plan', 'gosolar' ),

						'std'			=> esc_html__( 'Basic', 'gosolar' ),

					),

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Plan Extra Class', 'gosolar' ),

						'param_name'	=> 'plan_extra_class',

						'group'			=> esc_html__( 'Plan', 'gosolar' ),

					),

					array(

						'type'			=> 'colorpicker',

						'heading'		=> esc_html__( 'Plan Font Color', 'gosolar' ),

						'param_name'	=> 'plan_color',

						'group'			=> esc_html__( 'Plan', 'gosolar' ),

						'dependency'	=> array(

							'element'	=> 'plan',

							'not_empty'	=> true,

						),

					),

					

					// Cost

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Cost Before Text', 'gosolar' ),

						'param_name'	=> 'cost_before',

						'group'			=> esc_html__( 'Cost', 'gosolar' ),

					),

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Cost', 'gosolar' ),

						'param_name'	=> 'cost',

						'admin_label' 	=> true,

						'group'			=> esc_html__( 'Cost', 'gosolar' ),

						'std'			=> '$99.9',

					),

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Per Text', 'gosolar' ),

						'param_name'	=> 'cost_per',

						'group'			=> esc_html__( 'Cost', 'gosolar' ),

					),

					array(

						'type'			=> 'colorpicker',

						'heading'		=> esc_html__( 'Cost Font Color', 'gosolar' ),

						'param_name'	=> 'cost_color',

						'group'			=> esc_html__( 'Cost', 'gosolar' ),

						'dependency'	=> array(

							'element'	=> 'cost',

							'not_empty'	=> true,

						),

					),

					array(

						'type'			=> 'dropdown',

						'heading'		=> esc_html__( 'Cost Position', 'gosolar' ),

						'param_name'	=> 'cost_position',

						'admin_label' 	=> true,

						'value'			=> array(

							esc_html__( 'Default', 'gosolar' )		=> '',

						),

						'dependency'	=> array(

							'element'	=> 'cost',

							'not_empty'	=> true,

						),

						'group'			=> esc_html__( 'Cost', 'gosolar' ),

					),

					// Features

					array(

						'type'			=> 'textarea_html',

						'heading'		=> esc_html__( 'Features', 'gosolar' ),

						'param_name'	=> 'content',

						'value'			=> '<ul>

												<li class="inactive">WordPress</li>

												<li>HTML5 & CSS 3</li>

												<li>PSD Files</li>

												<li class="inactive">Unlimited Support</li>

											</ul>',

						'description'	=> esc_html__('Enter your pricing content.', 'gosolar'),

						'group'			=> esc_html__( 'Features', 'gosolar' ),

					),

					array(

						'type'			=> 'colorpicker',

						'heading'		=> esc_html__( 'Features Active Font Color', 'gosolar' ),

						'param_name'	=> 'font_active_color',

						'group'			=> esc_html__( 'Features', 'gosolar' ),

					),

					array(

						'type'			=> 'colorpicker',

						'heading'		=> esc_html__( 'Features InActive Font Color', 'gosolar' ),

						'param_name'	=> 'font_inactive_color',

						'group'			=> esc_html__( 'Features', 'gosolar' ),

					),

					array(

						'type'			=> 'colorpicker',

						'heading'		=> esc_html__( 'Features Divider Color', 'gosolar' ),

						'param_name'	=> 'font_sep_color',

						'group'			=> esc_html__( 'Features', 'gosolar' ),

					),

					// Image / Video

					array(

						"type"			=> "attach_image",

						"heading"		=> esc_html__( "Image", "gosolar" ),

						"param_name"	=> "pricing_image",

						"value"			=> "",

						'group'			=> esc_html__( 'Image / Video', 'gosolar' ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Image Link", 'gosolar' ),

						"param_name"	=> "image_url",

						"value"			=> "",

						'group'			=> esc_html__( 'Image / Video', 'gosolar' ),

						'dependency'	=> array(

							'element'	=> 'pricing_image',

							'not_empty'	=> true,

						),

					),

					array(

						'type'			=> 'checkbox',

						'heading'		=> esc_html__( 'Enable Video?', 'gosolar' ),

						'param_name'	=> 'video',

						'description'	=> esc_html__( 'Check this box to enable video for this pricing table.', 'gosolar' ),

						'value'			=> array(

							esc_html__( 'Yes, please', 'gosolar' )	=> 'yes'

						),

						'group'			=> esc_html__( 'Image / Video', 'gosolar' ),

					),

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Video ID', 'gosolar' ),

						'param_name'	=> 'video_id',

						'description'	=> esc_html__( 'Enter Youtube Video ID. Ex: Y-OLlJUXwKU', 'gosolar' ),

						'dependency'	=> array(

							'element'	=> 'video',

							'value'		=> 'yes'

						),

						'group'			=> esc_html__( 'Image / Video', 'gosolar' ),

					),

					array(

						'type'			=> 'attach_image',

						'heading'		=> esc_html__( 'Video Fallback Image', 'gosolar' ),

						'param_name'	=> 'video_fallback',

						'value'			=> '',

						'dependency'	=> array(

							'element'	=> 'video',

							'value'		=> 'yes'

						),

						'group'			=> esc_html__( 'Image / Video', 'gosolar' ),

					),

					array(

						'type'			=> 'dropdown',

						'heading'		=> esc_html__( 'Video Autoplay', 'gosolar' ),

						'param_name'	=> 'video_autoplay',

						'value'			=> array(

							esc_html__( 'Yes', 'gosolar' )	=> 'true',

							esc_html__( 'No', 'gosolar' )	=> 'false',

						),

						'dependency'	=> array(

							'element'	=> 'video',

							'value'		=> 'yes'

						),

						'group'			=> esc_html__( 'Image / Video', 'gosolar' ),

					),

					array(

						'type'			=> 'dropdown',

						'heading'		=> esc_html__( 'Video Controls', 'gosolar' ),

						'param_name'	=> 'video_controls',

						'value'			=> array(		

							esc_html__( 'No', 'gosolar' )	=> 'false',

							esc_html__( 'Yes', 'gosolar' )	=> 'true',

						),

						'dependency'	=> array(

							'element'	=> 'video',

							'value'		=> 'yes'

						),

						'group'			=> esc_html__( 'Image / Video', 'gosolar' ),

					),

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Video Height', 'gosolar' ),

						'param_name'	=> 'video_height',

						'description'	=> esc_html__( 'Enter Video Height. Ex: 150', 'gosolar' ),

						'dependency'	=> array(

							'element'	=> 'video',

							'value'		=> 'yes'

						),

						'group'			=> esc_html__( 'Image / Video', 'gosolar' ),

					),

					// Icon

					array(

						'type'			=> 'checkbox',

						'heading'		=> esc_html__( 'Show Icon?', 'gosolar' ),

						'param_name'	=> 'show_icon',

						'description'	=> esc_html__( 'Check this box to show icon for this pricing table.', 'gosolar' ),

						'value'			=> array(

							esc_html__( 'Yes, please', 'gosolar' )	=> 'yes'

						),

						'group'			=> esc_html__( 'Icon', 'gosolar' ),

					),

					array(

						"type" 			=> "dropdown",

						"heading" 		=> esc_html__( "Choose from Icon library", "gosolar" ),

						"value" 		=> array(

							esc_html__( "Font Awesome", "gosolar" ) 		=> "fontawesome",

							esc_html__( "Lineicons", "gosolar" ) 		=> "lineicons",

							esc_html__( "Flaticons", "gosolar" ) 		=> "flaticons",

						),

						"admin_label" 	=> true,

						"param_name" 	=> "type",

						"description" 	=> esc_html__( "Select icon library.", "gosolar" ),

						"dependency" 	=> array(

							"element" 	=> "show_icon",

							"value" 	=> "yes",

						),

						"group"			=> esc_html__( "Icon", "gosolar" ),

					),					

					array(

						"type" 			=> 'iconpicker',

						"heading" 		=> esc_html__( "Pricing Icon", "gosolar" ),

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

						"heading" 		=> esc_html__( "Pricing Icon", "gosolar" ),

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

						"heading" 		=> esc_html__( "Pricing Icon", "gosolar" ),

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

						'type'			=> 'colorpicker',

						'heading'		=> esc_html__( 'Icon Border Color', 'gosolar' ),

						'param_name'	=> 'icon_br_color',

						"dependency" 	=> array(

							"element" 	=> "show_icon",

							"value" 	=> "yes",

						),

						'group'			=> esc_html__( 'Icon', 'gosolar' ),

					),

					array(

						"type"			=> "vc_link",

						"heading"		=> esc_html__( "Button URL", "gosolar" ),

						"param_name"	=> "button_url",

						"value"			=> "",

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Button Text", "gosolar" ),

						"param_name"	=> "button_text",

						"group"			=> esc_html__( "Button", "gosolar" ),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_pricing_table_shortcode_map' );
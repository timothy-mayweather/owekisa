<?php 

/**

 * Team Slider shortcode 

 */



if ( ! function_exists( 'gosolar_vc_team_slider_shortcode' ) ) {

	function gosolar_vc_team_slider_shortcode( $atts, $content = NULL ) {

		

		$atts = vc_map_get_attributes( 'zozo_vc_team_slider', $atts );

		extract( $atts );



		$output = '';

		global $post;

		static $team_id = 1;

		

		// Classes

		$main_classes = '';

		$main_classes .= ' team-'.$member_style;

		

		// Slider Configuration

		$data_attr = '';

	

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

		

		if( isset( $items ) && $items == "1" ) {

			$image_size = 'full';

		} else {

			$image_size = 'gosolar-team';

		}

		

		$query_args = array(

						'post_type' 		=> 'zozo_team_member',

						'posts_per_page'	=> -1,						

						'orderby' 		 	=> 'date',

						'order' 		 	=> 'DESC',

					  );

					  

		if( $categories_id != 'all' ) {

			$query_args['tax_query'] 	= array(

											array(

												'taxonomy' 	=> 'team_categories',

												'field' 	=> 'slug',

												'terms' 	=> $categories_id

											) );

		

		}

		

		$team_query = new WP_Query( $query_args );

		

		if( $team_query->have_posts() ) {

			$output = '<div class="zozo-team-slider-wrapper'.$main_classes.'">';

			$output .= '<div id="zozo-team-slider'.$team_id.'" class="zozo-owl-carousel owl-carousel team-carousel-slider"'.$data_attr.'>';

			

				while ($team_query->have_posts()) : $team_query->the_post();

					$member_name 		= get_post_meta( $post->ID, 'zozo_member_name', true );

					$member_designation = get_post_meta( $post->ID, 'zozo_member_designation', true );

					$member_desc 		= get_post_meta( $post->ID, 'zozo_member_description', true );

					$email 				= get_post_meta( $post->ID, 'zozo_member_email', true );

					$facebook 			= get_post_meta( $post->ID, 'zozo_member_facebook', true );

					$twitter 			= get_post_meta( $post->ID, 'zozo_member_twitter', true );

					$linkedin 			= get_post_meta( $post->ID, 'zozo_member_linkedin', true );

					$pinterest 			= get_post_meta( $post->ID, 'zozo_member_pinterest', true );

					$dribbble 			= get_post_meta( $post->ID, 'zozo_member_dribbble', true );

					$skype 				= get_post_meta( $post->ID, 'zozo_member_skype', true );

					$yahoo 				= get_post_meta( $post->ID, 'zozo_member_yahoo', true );

					$youtube 			= get_post_meta( $post->ID, 'zozo_member_youtube', true );

					$link_target 		= get_post_meta( $post->ID, 'zozo_member_link_target', true );

					if( isset( $member_style ) && $member_style == 'style_two' ) {

						$team_image 	= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'gosolar-blog-thumb');

						$image_class 	= "img-responsive img-circle";

					} else {

						$team_image 	= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $image_size);

						$image_class 	= "img-responsive";

					}

					

					$output .= '<div class="team-item text-'.$text_align.'">';

						$output .= '<div class="team-item-inner"><!--Team Inner Div End-->';

						

						if( isset( $team_image ) && $team_image != '' ) {

							$output .= '<div class="team-item-img">';

								$output .= '<img src="'.esc_url($team_image[0]).'" width="'.esc_attr($team_image[1]).'" height="'.esc_attr($team_image[2]).'" alt="'. esc_html( get_the_title() ) .'" class="img-responsive" />';

							$output .= '</div>';

						}

						

						if( isset( $member_style ) && $member_style == 'box_type' ) {

						      $output .= '<div class="team-overlay-style"></div>';

     					}						



						$output .= '<div class="team-content">';

							if( isset( $member_style ) && $member_style != 'box_type' ) {

								if( isset( $member_desc ) && $member_desc != 'none' ) {

									if( isset( $member_desc_type ) && $member_desc_type == 'full_content' ) {

										$output .= '<div class="team-member-desc">'. $member_desc .'</div>';

									} elseif( isset( $member_desc_type ) && $member_desc_type == 'excerpt' ) {

										$output .= '<div class="team-member-desc"><p>'. gosolar_shortcode_stripped_excerpt( $member_desc, 13 ) .'</p></div>';

									}

								}

							}							
							

							$output .= '<h5 class="team-member-name">';

								if( isset( $title_link ) && $title_link == 'yes' ) {

									$output .= '<a href="'. esc_url( get_permalink() ) .'" title="'. esc_html( get_the_title() ) .'">';

								}

								if( isset( $member_name ) && $member_name != '' ) {

									$output .= $member_name;

								} else {

									$output .= get_the_title();

								}

								if( isset( $title_link ) && $title_link == 'yes' ) {

									$output .= '</a>';

								}

							$output .= '</h5>';
							
							
							if( isset( $member_designation ) && $member_designation != '' ) {

								$output .= '<p><span class="team-member-designation">'.$member_designation.'</span></p>';

							}
							

							if( isset( $member_style ) && $member_style == 'box_type' ) {

								if( isset( $member_desc ) && $member_desc != 'none' ) {

									if( isset( $member_desc_type ) && $member_desc_type == 'full_content' ) {

										$output .= '<div class="team-member-desc">'. $member_desc .'</div>';

									} elseif( isset( $member_desc_type ) && $member_desc_type == 'excerpt' ) {

										$output .= '<div class="team-member-desc"><p>'. gosolar_shortcode_stripped_excerpt( $member_desc, 13 ) .'</p></div>';

									}

								}

							}

							

							if( isset( $show_socials ) && $show_socials == 'yes' ) {

								if( ( isset( $facebook ) && $facebook != '' ) || ( isset( $twitter ) && $twitter != '' ) || ( isset( $linkedin ) && $linkedin != '' ) || ( isset( $pinterest ) && $pinterest != '' ) || ( isset( $dribbble ) && $dribbble != '' ) || ( isset( $skype ) && $skype != '' ) || ( isset( $yahoo ) && $yahoo != '' ) || ( isset( $youtube ) && $youtube != '' ) || ( isset( $email ) && $email != '' ) ) { 

								$output .= '<div class="zozo-team-social">';

									$output .= '<ul class="zozo-social-icons soc-icon-transparent zozo-team-social-list">';

										if( isset( $facebook ) && $facebook != '' ) {

											$output .= '<li class="facebook"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $facebook ).'"><i class="fa fa-facebook"></i></a></li>' . "\n";

										}

										if( isset( $twitter ) && $twitter != '' ) {

											$output .= '<li class="twitter"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $twitter ).'"><i class="fa fa-twitter"></i></a></li>' . "\n";

										}

										if( isset( $linkedin ) && $linkedin != '' ) {

											$output .= '<li class="linkedin"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $linkedin ).'"><i class="fa fa-linkedin"></i></a></li>' . "\n";

										}

										if( isset( $pinterest ) && $pinterest != '' ) {

											$output .= '<li class="pinterest"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $pinterest ).'"><i class="fa fa-pinterest"></i></a></li>' . "\n";

										}

										if( isset( $dribbble ) && $dribbble != '' ) {

											$output .= '<li class="dribbble"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $dribbble ).'"><i class="fa fa-dribbble"></i></a></li>' . "\n";

										}

										if( isset( $skype ) && $skype != '' ) {

											$output .= '<li class="skype"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $skype ).'"><i class="fa fa-skype"></i></a></li>' . "\n";

										}

										if( isset( $yahoo ) && $yahoo != '' ) {

											$output .= '<li class="yahoo"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $yahoo ).'"><i class="fa fa-yahoo"></i></a></li>' . "\n";

										}

										if( isset( $youtube ) && $youtube != '' ) {

											$output .= '<li class="youtube"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $youtube ).'"><i class="fa fa-youtube-play"></i></a></li>' . "\n";

										}

										if( isset( $email ) && $email != '' ) {

											$output .= '<li class="email"><a target="'.esc_attr( $link_target ).'" href="mailto:'.$email.'"><i class="fa fa-envelope"></i></a></li>' . "\n";

										}

									$output .= '</ul>';

								$output .= '</div>';

								}

							}

						$output .= '</div>';							

						

						$output .= '</div><!--Team-inner-->';

						

					$output .= '</div>';

					

				endwhile;

				

			$output .= '</div>';

			

			$output .= '</div>';

		}

		

		$team_id++;	

		wp_reset_postdata();

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_team_slider_shortcode_map' ) ) {

	function gosolar_vc_team_slider_shortcode_map() {

				

		vc_map( 

			array(

				"name"					=> esc_html__( "Team Slider", "gosolar" ),

				"description"			=> esc_html__( "Show your team in Slider.", 'gosolar' ),

				"base"					=> "zozo_vc_team_slider",

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

						"heading"		=> esc_html__( "Member Style", "gosolar" ),

						"param_name"	=> "member_style",

						"value"			=> array(

							esc_html__( "Style One", "gosolar" )			=> "box_type",

							esc_html__( "Style Two", "gosolar" )			=> "style_two"

						),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Alignment", "gosolar" ),

						"param_name"	=> "text_align",

						'admin_label' 	=> true,

						"value"			=> array(

							esc_html__( "Default", "gosolar" )	=> "",

							esc_html__( "Center", "gosolar" )	=> "center",

							esc_html__( "Left", "gosolar" )		=> "left",

							esc_html__( "Right", "gosolar" )		=> "right",

						),

					),

					array(

						"type"			=> 'dropdown',

						"admin_label" 	=> true,

						"heading"		=> esc_html__( "Show Social Links ?", "gosolar" ),

						"param_name"	=> "show_socials",

						"value"			=> array(

							esc_html__( 'Yes', 'gosolar' ) 	=> "yes",

							esc_html__( 'No', 'gosolar' ) 	=> "no" ),

					),

					array(

						"type"			=> 'dropdown',

						"admin_label" 	=> true,

						"heading"		=> esc_html__( "Link to Title ?", "gosolar" ),

						"param_name"	=> "title_link",

						"value"			=> array(

							esc_html__( 'Yes', 'gosolar' ) 	=> "yes",

							esc_html__( 'No', 'gosolar' ) 	=> "no" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Member Description Type", "gosolar" ),

						"param_name"	=> "member_desc_type",

						"value"			=> array(

							esc_html__( "Excerpt", "gosolar" )			=> "excerpt",

							esc_html__( "Full Content", "gosolar" )		=> "full_content",

							esc_html__( "None", "gosolar" )				=> "none"			

						),

					),

					// Slider

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Items to Display", "gosolar" ),

						"param_name"	=> "items",

						'admin_label'	=> true,

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Items to Scrollby", "gosolar" ),

						"param_name"	=> "items_scroll",

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						'type'			=> 'dropdown',

						'heading'		=> esc_html__( "Auto Play", 'gosolar' ),

						'param_name'	=> "auto_play",

						'admin_label'	=> true,

						'value'			=> array(

							esc_html__( 'True', 'gosolar' )	=> 'true',

							esc_html__( 'False', 'gosolar' )	=> 'false',

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

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Margin ( Items Spacing )", "gosolar" ),

						"param_name"	=> "margin",

						'admin_label'	=> true,

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Items To Display in Tablet", "gosolar" ),

						"param_name"	=> "items_tablet",

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Items To Display In Mobile Landscape", "gosolar" ),

						"param_name"	=> "items_mobile_landscape",

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Items To Display In Mobile Portrait", "gosolar" ),

						"param_name"	=> "items_mobile_portrait",

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Navigation", "gosolar" ),

						"param_name"	=> "navigation",

						"value"			=> array(

							esc_html__( "Yes", "gosolar" )	=> "true",

							esc_html__( "No", "gosolar" )	=> "false" ),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Pagination", "gosolar" ),

						"param_name"	=> "pagination",

						"value"			=> array(

							esc_html__( "Yes", "gosolar" )	=> "true",

							esc_html__( "No", "gosolar" )	=> "false" ),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_team_slider_shortcode_map' );
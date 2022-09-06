<?php 

/**

 * Team Grid shortcode 

 */

 

if ( ! function_exists( 'gosolar_vc_team_grid_shortcode' ) ) {

	function gosolar_vc_team_grid_shortcode( $atts, $content = NULL ) {

		

		$atts = vc_map_get_attributes( 'zozo_vc_team_grid', $atts );

		extract( $atts );



		$output = '';

		global $post;

		

		// Classes

		$main_classes = '';		

		$main_classes .= ' team-'.$member_style;

		$main_classes .= ' team-columns-'.$columns;

		

		$team_item_classes = '';

		$team_item_classes = gosolar_vc_animation( $css_animation );

		

		$column_class = '';

		

		if( isset( $columns ) && $columns != '' ) {

			if( isset( $columns ) && $columns == '2' ) {

				$column_class = 'col-sm-6 col-xs-12';

			} else if( isset( $columns ) && $columns == '3' ) {

				$column_class = 'col-md-4 col-xs-12';

			} else if( isset( $columns ) && $columns == '4' ) {

				$column_class = 'col-md-3 col-sm-6 col-xs-12';

			}

		} else {

			$column_class = 'col-sm-6 col-xs-12';

		}

		

		$align_style = '';

		if( isset( $text_align ) && $text_align != '' ) {

			$align_style = ' text-'.$text_align;

		}

		

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		

		$query_args = array(

						'post_type' 		=> 'zozo_team_member',

						'posts_per_page'	=> $posts,

						'paged' 			=> $paged,

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

			$output = '<div class="zozo-team-grid-wrapper'.$main_classes.'">';

			$output .= '<div class="row team-grid-inner">';

			

				$count = 1;

			

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

						$team_image 	= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'gosolar-team');

						$image_class 	= "img-responsive";

					}  else {

						$team_image 	= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'gosolar-team');

						$image_class 	= "img-responsive";

					}

					

					if( ( isset( $columns ) && $columns == '2' && $count == '3' ) || ( isset( $columns ) && $columns == '3' && $count == '4' ) || ( isset( $columns ) && $columns == '4' && $count == '5' ) ) {

						$count = 1;

						$output .= '<div class="team-clearfix clearfix"></div>';

					}

					

					$output .= '<div class="team-item '.$column_class.''.$align_style.''. $team_item_classes .'">';

					

						$output .= '<div class="team-item-inner">';

					

					

					

					if( isset( $member_style ) && $member_style == 'style_two' ) {

						$output .= '<div class="team-overlay-style">';

					}

						

						if( isset( $team_image ) && $team_image != '' ) {

							$output .= '<div class="team-item-img">';

								$output .= '<img src="'.esc_url($team_image[0]).'" width="'.esc_attr($team_image[1]).'" height="'.esc_attr($team_image[2]).'" alt="'. esc_html( get_the_title() ) .'" class="'.$image_class.'" />';

							$output .= '</div>';

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

						

					if( isset( $member_style ) && $member_style == 'style_two' ) {

					

						$output .= '</div>';

					

					}

							$output .= '</div><!--Team Inner Div End-->';

					

					$output .= '</div><!--Column End-->';

					

					$count++;

					

				endwhile;

				

			$output .= '</div>';

			

			if( isset( $show_pagination ) && $show_pagination == 'yes' ) {

				$output .= gosolar_pagination( $team_query->max_num_pages, '' );

			}

			

			$output .= '</div>';

		}

				

		wp_reset_postdata();

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_team_grid_shortcode_map' ) ) {

	function gosolar_vc_team_grid_shortcode_map() {

				

		vc_map( 

			array(

				"name"					=> esc_html__( "Team Grid", "gosolar" ),

				"description"			=> esc_html__( "Show your team in Grid.", 'gosolar' ),

				"base"					=> "zozo_vc_team_grid",

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

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Posts per Page", "gosolar" ),

						"admin_label" 	=> true,

						"param_name"	=> "posts",						

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Show Pagination ?", "gosolar" ),

						"param_name"	=> "show_pagination",	

						"value"			=> array(

							esc_html__( "Yes", "gosolar" )		=> "yes",

							esc_html__( "No", "gosolar" )		=> "no" ),

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

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Team Columns", "gosolar" ),

						"param_name"	=> "columns",

						"admin_label" 	=> true,

						"value"			=> array(

							esc_html__( "Two Columns", "gosolar" )		=> "2",

							esc_html__( "Three Columns", "gosolar" )		=> "3",

							esc_html__( "Four Columns", "gosolar" )		=> "4" ),

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

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_team_grid_shortcode_map' );
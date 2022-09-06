<?php 

/**

 * Team List shortcode 

 */



if ( ! function_exists( 'gosolar_vc_team_list_shortcode' ) ) {

	function gosolar_vc_team_list_shortcode( $atts, $content = NULL ) {

		

		extract( 

			shortcode_atts( 

				array(

					'classes'					=> '',

					'css_animation'				=> '',

					'text_align' 				=> 'left',

					'posts'						=> '-1',

					'show_pagination'			=> 'yes',

					'team_image' 				=> 'image',

					'categories_id' 			=> 'all',

				), $atts 

			) 

		);



		$output = '';

		global $post;

		$post_count = 1;

		

		// Classes

		$main_classes = $team_item_classes = '';

		$team_item_classes = gosolar_vc_animation( $css_animation );

		

		$data_attr = '';

		

		$data_attr .= ' data-items="1" ';

		$data_attr .= ' data-slideby="1" ';

		$data_attr .= ' data-items-tablet="1" ';

		$data_attr .= ' data-items-mobile-landscape="1" ';

		$data_attr .= ' data-items-mobile-portrait="1" ';

		$data_attr .= ' data-autoplay="true" ';

		$data_attr .= ' data-autoplay-timeout="5000" ';

		$data_attr .= ' data-loop="true" ';

		$data_attr .= ' data-margin="0" ';

		$data_attr .= ' data-pagination="true" ';

		$data_attr .= ' data-navigation="false" ';

				

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

			$output = '<div class="zozo-team-list-wrapper clearfix'.$main_classes.'">';

			$output .= '<div class="team-list-inner">';

			

				while ($team_query->have_posts()) : $team_query->the_post();

					

					$align_class = '';

					if( ($post_count % 2) > 0 ) {

						$align_class = " pull-left";

					} else {

						$align_class = " pull-right";

					}

					

					$team_img 			= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'gosolar-blog-medium');

					$member_name 		= get_post_meta( $post->ID, 'zozo_member_name', true );

					$member_designation = get_post_meta( $post->ID, 'zozo_member_designation', true );

					$member_desc 		= get_post_meta( $post->ID, 'zozo_member_description', true );

					

					$output .= '<div class="row team-item text-'.$text_align.''. $team_item_classes .'">';

					

						$output .= '<div class="col-md-6 col-xs-12'.$align_class.'">';

						

							if( isset( $team_image ) && $team_image == 'image' ) {

								$output .= '<div class="team-item-img">';

									$output .= '<img src="'.esc_url($team_img[0]).'" width="'.esc_attr($team_img[1]).'" height="'.esc_attr($team_img[2]).'" alt="'. esc_html( get_the_title() ) .'" class="img-responsive" />';

								$output .= '</div>';

							} 

							elseif( isset( $team_image ) && $team_image == 'slider' ) {

								$output .= '<div id="team-gallery-slider" class="team-gallery-slider zozo-owl-carousel owl-carousel"'. $data_attr .'>';

									$output .= gosolar_get_gallery_post_images( 'gosolar-blog-medium', $post->ID, 'no' );

								$output .= '</div>';

							}

							

						$output .= '</div>';

						

						$output .= '<div class="col-md-6 col-xs-12">';

						

							$output .= '<div class="team-content">';

								if( isset( $member_name ) && $member_name != '' ) {

									$output .= '<h4 class="team-member-name"><a href="'. esc_url( get_permalink() ) .'" title="'. esc_html( get_the_title() ) .'">'.$member_name.'</a> / <span class="team-member-designation">'. $member_designation .'</span></h4>';

								}

								else {

									$output .= '<h4 class="team-member-name"><a href="'. esc_url( get_permalink() ) .'" title="'. esc_html( get_the_title() ) .'">'. esc_html( get_the_title() ) .'</a> / <span class="team-member-designation">'. $member_designation .'</span></h4>';

								

								}

								if( isset( $member_desc ) && $member_desc != '' ) {

									$output .= '<div class="team-member-desc">'.do_shortcode( $member_desc ).'</div>';

								}

							$output .= '</div>';

							

						$output .= '</div>';

						

					$output .= '</div>';

					

					$post_count++;

					

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



if ( ! function_exists( 'gosolar_vc_team_list_shortcode_map' ) ) {

	function gosolar_vc_team_list_shortcode_map() {

				

		vc_map( 

			array(

				"name"					=> esc_html__( "Team List", "gosolar" ),

				"description"			=> esc_html__( "Show your team in List.", 'gosolar' ),

				"base"					=> "zozo_vc_team_list",

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

						"heading"		=> esc_html__( "Team Image", "gosolar" ),

						"param_name"	=> "team_image",	

						"value"			=> array(

							esc_html__( "Image", "gosolar" )		=> "image",

							esc_html__( "Slider", "gosolar" )	=> "slider" ),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_team_list_shortcode_map' );
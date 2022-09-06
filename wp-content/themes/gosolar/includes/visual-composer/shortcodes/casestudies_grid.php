<?php 

/**

 * Casestudies Grid shortcode

 */



if ( ! function_exists( 'gosolar_vc_casestudies_grid_shortcode' ) ) {

	function gosolar_vc_casestudies_grid_shortcode( $atts, $content = NULL ) {

	

		$atts = vc_map_get_attributes( 'zozo_vc_casestudies_grid', $atts );

		extract( $atts );



		$output = '';

		static $casestudies_id = 1;

		global $post;

		

		// Include categories

		$include_categories = ( '' != $include_categories ) ? $include_categories : '';

		$include_categories = ( 'all' == $include_categories ) ? '' : $include_categories;

		$include_filter_cats = '';

		if( $include_categories ) {

			$include_categories = explode( ',', $include_categories );

			$include_filter_cats = array();

			foreach( $include_categories as $key ) {

				$key = get_term_by( 'slug', $key, 'casestudy_categories' );

				$include_filter_cats[] = $key->term_id;

			}

		}

		

		if ( ! empty( $include_categories ) && is_array( $include_categories ) ) {

			$include_categories = array(

				'taxonomy'	=> 'casestudy_categories',

				'field'		=> 'slug',

				'terms'		=> $include_categories,

				'operator'	=> 'IN',

			);

		} else {

			$include_categories = '';

		}

		

		// Exclude categories

		$exclude_filter_cats = '';

		if( $exclude_categories ) {

			$exclude_categories = explode( ',', $exclude_categories );

			if ( ! empty( $exclude_categories ) && is_array( $exclude_categories ) ) {

				$exclude_filter_cats = array();

				foreach ( $exclude_categories as $key ) {

					$key = get_term_by( 'slug', $key, 'casestudy_categories' );

					$exclude_filter_cats[] = $key->term_id;

				}

				$exclude_categories = array(

						'taxonomy'	=> 'casestudy_categories',

						'field'		=> 'slug',

						'terms'		=> $exclude_categories,

						'operator'	=> 'NOT IN',

					);

			} else {

				$exclude_categories = '';

			}

		}

				

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		

		$query_args = array(

						'post_type' 		=> 'zozo_casestudies',

						'posts_per_page'	=> $posts,

						'paged' 			=> $paged,

						'orderby' 		 	=> 'date',

						'order' 		 	=> 'DESC',

					  );

					  		

		$query_args['tax_query'] 	= array(

										'relation'	=> 'AND',

										$include_categories,

										$exclude_categories );

		

		$casestudies_query = new WP_Query( $query_args );

		

		// Classes

		$main_classes = '';

		

		if( isset( $classes ) && $classes != '' ) {

			$main_classes .= ' ' . $classes;

		}

		$main_classes .= gosolar_vc_animation( $css_animation );

		$main_classes .= ' casestudies-columns-'.$columns;		

		

		$column_class = '';

		

		if( isset( $columns ) && $columns != '' ) {

			if( isset( $columns ) && $columns == '2' ) {

				$column_class = 'col-sm-6 col-xs-12';

			} else if( isset( $columns ) && $columns == '3' ) {

				$column_class = 'col-sm-4 col-xs-12';

			} else if( isset( $columns ) && $columns == '4' ) {

				$column_class = 'col-md-3 col-sm-6 col-xs-12';

			}

		} else {

			$column_class = 'col-sm-6 col-xs-12';

		}

		

		if( $casestudies_query->have_posts() ) {

		

			$output = '<div class="zozo-casestudies-grid-wrapper'.$main_classes.'">';

			$output .= '<div class="row casestudies-grid-inner">';

			

			$count = 1;

				

			while($casestudies_query->have_posts()) : $casestudies_query->the_post();

				

				if( isset( $columns ) && $columns == '2' ) {

					$image_size = 'gosolar-custom-large';

				} else {

					$image_size = 'gosolar-custom-mid';

				}

				

				$casestudies_img = '';

				$casestudies_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $image_size);				

				

				$casestudies_img_large = ''; 

				$casestudies_img_large = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

				

				if( ( isset( $columns ) && $columns == '2' && $count == '3' ) || ( isset( $columns ) && $columns == '3' && $count == '4' ) || ( isset( $columns ) && $columns == '4' && $count == '5' ) ) {

					$count = 1;

					$output .= '<div class="casestudies-clearfix clearfix"></div>';

				}

				$count++;		

				

				$output .= '<div class="casestudies-item '.$column_class.'">';

				

					if( isset( $casestudies_img ) && $casestudies_img != '' ) {

					

						$output .= '<div class="casestudies-item-img">';

							$output .= '<a href="'. esc_url( get_permalink() ) .'"><img class="img-responsive" src="'.esc_url($casestudies_img[0]).'" width="'.esc_attr($casestudies_img[1]).'" height="'.esc_attr($casestudies_img[2]).'" alt="'. esc_html( get_the_title() ) .'" /></a>';

						$output .= '</div>';

					}

									

					$output .= '<div class="casestudies-content-wrapper">';

						$output .= '<h4><a href="'. esc_url( get_permalink() ) .'" title="'. esc_html( get_the_title() ) .'">'. esc_html( get_the_title() ) .'</a></h4>';

												

						if( isset( $show_excerpt ) && $show_excerpt == 'yes' ) {

							$output .= '<div class="casestudies-excerpts">';

								if( isset( $excerpt_length ) && $excerpt_length != '' ) {

									$output .= '<p>' . gosolar_shortcode_stripped_excerpt( get_the_excerpt(), $excerpt_length ) . '</p>';

								} else {

									$output .= '<p>' . gosolar_shortcode_stripped_excerpt( get_the_excerpt(), 10 ) . '</p>';

								}

							$output .= '</div>';

						}

						if( isset( $button_text ) && $button_text != '' ) {

							$output .= '<a href="'. esc_url( get_permalink() ) .'" class="btn btn-more" title="'. esc_html( get_the_title() ) .'">'. $button_text .'</a>';

						}

					$output .= '</div>';

					

				$output .= '</div>';



			endwhile;

				

			$output .= '</div>';

				

			if( isset( $pagination ) && $pagination == 'yes' ) {

				$output .= gosolar_pagination( $casestudies_query->max_num_pages, '' );

			}

			

			$output .= '</div>';

		}		

		

		$casestudies_id++;

		wp_reset_postdata();

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_casestudies_grid_shortcode_map' ) ) {

	function gosolar_vc_casestudies_grid_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Case Studies Grid", "gosolar" ),

				"description"			=> esc_html__( "Show your case studies in grid.", 'gosolar' ),

				"base"					=> "zozo_vc_casestudies_grid",

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

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Posts per Page", "gosolar" ),

						"admin_label" 	=> true,

						"param_name"	=> "posts",						

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Show Pagination ?", "gosolar" ),

						"param_name"	=> "pagination",	

						"value"			=> array(

							esc_html__( "Yes", "gosolar" )		=> "yes",

							esc_html__( "No", "gosolar" )		=> "no" ),

					),

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Include Categories', 'gosolar' ),

						'param_name'	=> 'include_categories',

						'admin_label'	=> true,

						'description'	=> esc_html__('Enter the slugs of a categories (comma seperated) to pull posts from or enter "all" to pull recent posts from all categories. Example: category-1, category-2.','gosolar'),

					),

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Exclude Categories', 'gosolar' ),

						'param_name'	=> 'exclude_categories',

						'admin_label'	=> true,

						'description'	=> esc_html__('Enter the slugs of a categories (comma seperated) to exclude. Example: category-1, category-2.','gosolar'),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Case studies Columns", "gosolar" ),

						"param_name"	=> "columns",

						"admin_label" 	=> true,

						"value"			=> array(

							esc_html__( "Two Columns", "gosolar" )		=> "2",

							esc_html__( "Three Columns", "gosolar" )		=> "3",

							esc_html__( "Four Columns", "gosolar" )		=> "4" ),

						"description" 	=> esc_html__( "Select Columns type for Case Studies", "gosolar" ),

					),					

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Show Excerpt Content", "gosolar" ),

						"param_name"	=> "show_excerpt",

						"description" 	=> esc_html__( "Enable/Disable Excerpts", "gosolar" ),

						"value"			=> array(

							esc_html__( "Yes", "gosolar" )	=> "yes",

							esc_html__( "No", "gosolar" )	=> "no",

						),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Excerpt Length", "gosolar" ),

						"param_name"	=> "excerpt_length",

						"description" 	=> esc_html__( "Enter excerpt length", "gosolar" ),

						'dependency'	=> array(

							'element'	=> 'show_excerpt',

							"value" 	=> 'yes',

						),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Button Text", "gosolar" ),

						"param_name"	=> "button_text",

						"description" 	=> esc_html__( "Enter button text.", "gosolar" ),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_casestudies_grid_shortcode_map' );
<?php 

/**

 * Blog shortcode

 */



if ( ! function_exists( 'gosolar_vc_blog_shortcode' ) ) {

	function gosolar_vc_blog_shortcode( $atts, $content = NULL ) { 

		

		$atts = vc_map_get_attributes( 'zozo_vc_blog', $atts );

		extract( $atts );



		$output = '';

		global $post;

		

		// Include categories

		$include_categories = ( '' != $include_categories ) ? $include_categories : '';

		$include_categories = ( 'all' == $include_categories ) ? '' : $include_categories;

		if( $include_categories ) {

			$include_categories = explode( ',', $include_categories );

			if ( ! empty( $include_categories ) && is_array( $include_categories ) ) {

				$include_categories = array(

					'taxonomy'	=> 'category',

					'field'		=> 'slug',

					'terms'		=> $include_categories,

					'operator'	=> 'IN',

				);

			} else {

				$include_categories = '';

			}

		}

				

		// Exclude categories

		if( $exclude_categories ) {

			$exclude_categories = explode( ',', $exclude_categories );

			if ( ! empty( $exclude_categories ) && is_array( $exclude_categories ) ) {

				$exclude_categories = array(

						'taxonomy'	=> 'category',

						'field'		=> 'slug',

						'terms'		=> $exclude_categories,

						'operator'	=> 'NOT IN',

					);

			} else {

				$exclude_categories = '';

			}

		}

				

		if( ( is_front_page() || is_home() ) ) {

			$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);

		} else {

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		}

		

		$query_args = array(

						'posts_per_page'	=> $posts,

						'paged' 			=> $paged,

						'orderby' 		 	=> 'date',

						'order' 		 	=> 'DESC',

					  );

					  		

		$query_args['tax_query'] 	= array(

										'relation'	=> 'AND',

										$include_categories,

										$exclude_categories );

		

		$blog_query = new WP_Query( $query_args );

		

		$post_class = $container_class = $scroll_type = $scroll_type_class = '';

		$post_type_layout = $excerpt_limit = '';

		

		$data_attr = '';

		

		$column_width = '';

		$display_mode = '';

		

		// Grid Style

		if( $layout == 'grid' ) {

			$container_class = 'zozo-isotope-layout ';

			if( $columns != '' ) {

				if( $columns == 'two' ) {

					$container_class .= 'grid-layout grid-col-2';

					$grid_columns_num = 2;

				} elseif( $columns == 'three' ) {

					$container_class .= 'grid-layout grid-col-3';

					$grid_columns_num = 3;

				} elseif( $columns == 'four' ) {

					$container_class .= 'grid-layout grid-col-4';

					$grid_columns_num = 4;

				}

			}

			$post_class = 'isotope-post grid-posts ';

			$column_width = 12 / $grid_columns_num;

			$post_class .= 'post-iso-w' . $column_width;

			$post_class .= ' post-iso-h' . $column_width;

			

			$image_size = 'gosolar-blog-medium';

			$page_type_layout = 'grid';

			$display_mode = 'isotope';

			if( isset( $excerpt_length ) && $excerpt_length == '' ) {

				$excerpt_limit = gosolar_get_theme_option( 'zozo_blog_excerpt_length_grid' );

			} else {

				$excerpt_limit = $excerpt_length;

			}

			$data_attr = ' data-layout=masonry data-columns='. $grid_columns_num .' data-gutter=30';

		}

		// Large Style

		elseif( $layout == 'large' ) {

			$container_class = 'large-layout';

			$post_class = 'large-posts';

			$image_size = 'gosolar-blog-large';

			$post_type_layout = 'large';

			if( isset( $excerpt_length ) && $excerpt_length == '' ) {

				$excerpt_limit = gosolar_get_theme_option( 'zozo_blog_excerpt_length_large' );

			} else {

				$excerpt_limit = $excerpt_length;

			}

		}

		// List Style

		elseif( $layout == 'list' ) {

			$container_class = 'list-layout';

			$post_class = 'list-posts clearfix';	

			$image_size = 'gosolar-blog-medium';

			$page_type_layout = 'list';

			if( isset( $excerpt_length ) && $excerpt_length == '' ) {

				$excerpt_limit = gosolar_get_theme_option( 'zozo_blog_excerpt_length_list' );

			} else {

				$excerpt_limit = $excerpt_length;

			}

		}

		

		if( $pagination == "infinite" ) {

			$scroll_type = "infinite";

			if( isset( $display_mode ) && $display_mode == 'isotope' ) {

				$scroll_type_class = " posts-isotope-infinite";

			} else {

				$scroll_type_class = " posts-infinite";

			}

		} elseif( $pagination == "pagination" ) {

			$scroll_type = "pagination";

			$scroll_type_class = " posts-pagination";

		}

		

		// Meta 		

		$meta_array = array();

		$meta_array = array( 'more' 	=> $hide_morelink,

							'thumbnail' => $hide_thumbnail,

							'author' 	=> $hide_author,

							'comments' 	=> $hide_comments, 

							'date' 		=> $hide_date,

							'categories' => $hide_categories );



		// Animation					

		$animation = array();

		

		if( $pagination == "infinite" ) {

			$animation = array( 'animation' 	=> 'bottom-t-top',

								'delay' 		=> '200' );

		}

		

		$post_count = 1;

		

		// Classes

		$main_classes = '';

		

		if( isset( $classes ) && $classes != '' ) {

			$main_classes .= ' ' . $classes;

		}

		

		if( $blog_query->have_posts() ) {

		

			$output = '<div id="zozo-blog-posts-container" class="zozo-blog-posts-wrapper zozo-isotope-grid-system'.$main_classes.'">';

			

				if( isset( $display_mode ) && $display_mode == 'isotope' ) {

					$output .= '<div class="zozo-isotope-wrapper blog-isotope-wrapper">';

				}

							

				$output .= '<div id="archive-posts-container" class="zozo-posts-container '. esc_attr($container_class . $scroll_type_class) .' clearfix"'. $data_attr .'>';

				

				while($blog_query->have_posts()) : $blog_query->the_post();

				

					$post_id = get_the_ID();

											

					if( isset( $layout ) && ( $layout == 'large' || $layout == 'list' ) ) {

						$output .= gosolar_output_blog_large_layout( $post_id, $post_class, $image_size, $excerpt_limit, $meta_array, $layout );

					} 

					

					else if( isset( $layout ) && $layout == 'grid' ) {

						$output .= gosolar_output_blog_grid_layout( $post_id, $post_class, $image_size, $excerpt_limit, $meta_array, $animation );

					}

					

					

					

					$post_count++;



				endwhile;

				

				$output .= '</div>';

				

				if( isset( $display_mode ) && $display_mode == 'isotope' ) {

					$output .= '</div>';

				}

			

				if( $pagination != "hide" ) {

					$output .= '<div class="zozo-blog-pagination-wrapper">';

					$output .= gosolar_pagination( $blog_query->max_num_pages, $scroll_type );

					$output .= '</div>';

				}

			

			$output .= '</div>';

			

		}

		

		wp_reset_postdata();

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_blog_shortcode_map' ) ) {

	function gosolar_vc_blog_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Blog", "gosolar" ),

				"description"			=> esc_html__( "Show your blog posts in different styles.", 'gosolar' ),

				"base"					=> "zozo_vc_blog",

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

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Posts per Page", "gosolar" ),

						"admin_label" 	=> true,

						"param_name"	=> "posts",						

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

						"heading"		=> esc_html__( "Blog Layout", "gosolar" ),

						"param_name"	=> "layout",

						"admin_label" 	=> true,

						"group"			=> esc_html__( "Layout", "gosolar" ),

						"value"			=> array(

							esc_html__( "Large Layout", "gosolar" )		=> "large",

							esc_html__( "List Layout", "gosolar" )		=> "list",

							esc_html__( "Grid Layout", "gosolar" )		=> "grid" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Blog Columns", "gosolar" ),

						"param_name"	=> "columns",

						"admin_label" 	=> true,

						"group"			=> esc_html__( "Layout", "gosolar" ),

						"value"			=> array(

							esc_html__( "2 Columns", "gosolar" )		=> "two",

							esc_html__( "3 Columns", "gosolar" )		=> "three",

							esc_html__( "4 Columns", "gosolar" )		=> "four" ),

						'dependency'	=> array(

							'element'	=> 'layout',

							'value'		=>  'grid' ,

						),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Excerpt Limit", "gosolar" ),

						"param_name"	=> "excerpt_length",

						"group"			=> esc_html__( "Layout", "gosolar" ),

						"description" 	=> esc_html__( "Enter excerpt length", "gosolar" ),

						'dependency'	=> array(

							'element'	=> 'layout',

							'value'		=> array( 'large', 'list', 'grid' ),

						),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Hide Thumbnail", "gosolar" ),

						"param_name"	=> "hide_thumbnail",

						"value"			=> array(

							esc_html__( "No", "gosolar" )	=> 0,

							esc_html__( "Yes", "gosolar" )	=> 1 ),

						'dependency'	=> array(

							'element'	=> 'layout',

							'value'		=> array( 'large', 'list', 'classic', 'grid', 'masonry' ),

						),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Hide Author", "gosolar" ),

						"param_name"	=> "hide_author",

						"value"			=> array(

							esc_html__( "No", "gosolar" )	=> 0,

							esc_html__( "Yes", "gosolar" )	=> 1 ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Hide Comments", "gosolar" ),

						"param_name"	=> "hide_comments",

						"value"			=> array(

							esc_html__( "No", "gosolar" )	=> 0,

							esc_html__( "Yes", "gosolar" )	=> 1 ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Hide Date", "gosolar" ),

						"param_name"	=> "hide_date",

						"value"			=> array(

							esc_html__( "No", "gosolar" )	=> 0,

							esc_html__( "Yes", "gosolar" )	=> 1 ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Hide Categories", "gosolar" ),

						"param_name"	=> "hide_categories",

						"value"			=> array(

							esc_html__( "No", "gosolar" )	=> 0,

							esc_html__( "Yes", "gosolar" )	=> 1 ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Hide Read More Link", "gosolar" ),

						"param_name"	=> "hide_morelink",

						"value"			=> array(

							esc_html__( "No", "gosolar" )	=> 0,

							esc_html__( "Yes", "gosolar" )	=> 1 ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Pagination", "gosolar" ),

						"param_name"	=> "pagination",

						"group"			=> esc_html__( "Layout", "gosolar" ),

						"value"			=> array(

							esc_html__( "Hide", "gosolar" )				=> "hide",

							esc_html__( "Pagination", "gosolar" )		=> "pagination",

							esc_html__( "Infinite Scroll", "gosolar" )	=> "infinite" ),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_blog_shortcode_map' );
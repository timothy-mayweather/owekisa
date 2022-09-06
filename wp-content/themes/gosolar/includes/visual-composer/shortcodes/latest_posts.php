<?php 
/**
 * Latest Posts shortcode
 */

if ( ! function_exists( 'gosolar_vc_latest_posts_shortcode' ) ) {
	function gosolar_vc_latest_posts_shortcode( $atts, $content = NULL ) { 
		
		$atts = vc_map_get_attributes( 'zozo_vc_latest_posts', $atts );
		extract( $atts );

		$output = '';
		static $latest_posts_id = 1;
		global $post;
		
		// Slider Configuration
		$data_attr = '';
		
		if( isset( $blog_style ) && $blog_style == 'slider' ) {
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
		
		if( isset( $blog_style ) && $blog_style == 'slider' ) {
			$image_size = 'gosolar-blog-medium';
		} elseif( isset( $blog_style ) && $blog_style == 'list-style' ) {
			$image_size = 'gosolar-team-single';
		}else {
			$image_size = 'gosolar-blog-thumb';
		}
		
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
		
		$post_class = '';
		$excerpt_limit = '18';
				
		// Classes
		$main_classes = '';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		$main_classes .= gosolar_vc_animation( $css_animation );
		
		if( $blog_query->have_posts() ) {
			$output = '<div class="zozo-latest-posts-wrapper'.$main_classes.'">';
				if( isset( $blog_style ) && $blog_style == 'slider' ) {
					$output .= '<div id="zozo-latest-posts-slider'.$latest_posts_id.'" class="zozo-owl-carousel owl-carousel latest-posts-slider-wrapper"'.$data_attr.'>';
				} else {
					$output .= '<div class="latest-posts-layout row">'; 
				}
				
				$count = 1;
				
				while($blog_query->have_posts()) : $blog_query->the_post();
				
					$rm_stat = 0; // read more status
					
					$post_id = get_the_ID();				
					$post_format = get_post_format();
	
					$extra_post_class = '';
					if( $blog_style == 'default' ) {
						$extra_post_class = 'col-xs-12';
					} elseif($blog_style == 'two-column') {
						$extra_post_class = 'col-md-6 col-xs-12';
					} elseif( $blog_style == 'list-style' ) {
						$extra_post_class = 'col-sm-12';
					}
					
					if( isset( $blog_style ) && $blog_style == 'slider' ) {
						$extra_post_class = 'latest-posts-slider';
					}
					
					if( $blog_style == 'two-column' && ( $count % 2 ) > 0 ) {
						$output .= '<div class="latest-posts-clear clearfix"></div>';
					}
					
					if( isset( $blog_style ) && $blog_style == 'list-style' ) {
						$extra_post_class = 'latest-posts-list-style';
					}
					
					$external_url = $link_attr = '';
					$external_url = get_post_meta( $post_id, 'zozo_external_link_url', true );
					if( isset( $external_url ) && $external_url != '' ) {
						$link_attr = ' target="_blank"';
					}
					if( isset( $external_url ) && $external_url == '' ) {
						$external_url = get_permalink( $post_id );
					}
		
					$output .= '<div id="post-'.$post_id.'" '; ob_start(); post_class($extra_post_class); $output .= ob_get_clean() .'>';
					
						$output .= '<div class="post-inner-wrapper posts-inner-container clearfix">';
					
						if( isset( $blog_style ) && $blog_style == 'slider' ) {
						    $output .= '<div class="entry-meta-top-wrapper">';	
							if( $show_categories == 'yes' ) {								
								$output .= '<ul class="entry-meta">';
								
									$categories = get_the_category();
									$separator = ', ';
									$cat_output = '';
									
									if( $categories ){
										foreach( $categories as $category ) {
											$cat_output .= $category->cat_name . $separator;
										}
									}
									
									$output .= '<li class="post-categories">';
									$output .= trim( $cat_output, $separator );
									$output .= '</li>';
								$output .= '</ul>';
								
							}	
							$output .= '</div><!-- .entry-meta-top-wrapper -->';
							
						}
					
						if ( has_post_thumbnail() && ! post_password_required() ) {
							$extra_class = $blog_style == 'list-style' ? ' list-featured-image' : '';
							$output .= '<div class="post-featured-image'. esc_attr( $extra_class ) .' only-image">';
								$output .= '<div class="entry-thumbnail-wrapper">';
									$output .= '<div class="entry-thumbnail">';
										$output .= '<a href="'. esc_url($external_url) .'" class="post-img" title="'. esc_html( get_the_title() ) .'"'. $link_attr .'>'. get_the_post_thumbnail( $post_id, $image_size ) .'</a>';
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</div><!-- .post-featured-image -->';
						}
						
						$output .= '<div class="posts-content-container">';
						
							if( $blog_style == 'list-style' && $show_title == 'yes' ) {
								ob_start();
								the_title_attribute();
								$title_attr = ob_get_clean();
								$output .= '<h2><a href="'. get_the_permalink() .'" title="'. $title_attr .'">'. get_the_title() .'</a></h2>';
							}
						
							if( isset( $blog_style ) && $blog_style == 'slider' ) {
								if( isset( $show_title ) && $show_title == 'yes' ) {
									$output .= '<div class="entry-header">';
										$output .= '<h2 class="entry-title">';
											$output .= '<a href="'. esc_url($external_url) .'" rel="bookmark" title="'. esc_html( get_the_title() ) .'"'. $link_attr .'>'. esc_html( get_the_title() ) .'</a>';
										$output .= '</h2>';
									$output .= '</div><!-- .entry-header -->';
								}
							}						
							
							
							if( isset( $blog_style ) && $blog_style != 'slider' && $blog_style != 'list-style' ) {
								$output .= '<div class="entry-meta-wrapper">';							
									$output .= '<ul class="entry-meta">';
										if( $show_author == 'yes' ) {
											$output .= '<li class="post-author">';
												$output .= get_avatar(get_the_author_meta('email'), '30');
												$output .= '<span class="post-author-name">'. get_the_author_posts_link() .'</span>';
											$output .= '</li>';
										}
										if( $read_more == 'yes' ) {
											if( ! gosolar_get_theme_option( 'zozo_blog_read_more_text' ) ) {
												$more_text = esc_html__('Read more', 'gosolar'); 
											} else { 
												$more_text = gosolar_get_theme_option( 'zozo_blog_read_more_text' );
											}
											
											if( !$rm_stat ){
												$rm_stat = 1;
												$output .= '<li class="read-more"><a href="'. esc_url($external_url) .'" class="btn-more read-more-link" title="'. esc_html( get_the_title() ) .'"'. $link_attr .'>'.$more_text.'</a></li>';
											}
										}
									$output .= '</ul>';
								$output .= '</div><!-- .entry-meta-wrapper -->';
							}
							else if( isset( $blog_style ) && $blog_style == 'slider' ) {
								if( $show_author == 'yes' || $read_more == 'yes' || $show_post_date == 'yes' || $show_comment_count == 'yes' ) {
									$output .= '<div class="entry-meta-wrapper">';	
										$output .= '<div class="entry-meta">';
											// Author
											if( $show_author == 'yes' ) {
												$output .= '<div class="post-author">';
													$output .= '<i class="simple-icon icon-user"></i><h6 class="post-author-name">'. get_the_author_posts_link() .'</h6>';
												$output .= '</div>';
											}
										$output .= '</div>';
										//date 
										if( $show_post_date == 'yes' ) {
											$output .= '<div class="post-date">';
												$output .= '<p class="latest-post-date"><i class="simple-icon icon-calendar"></i>'. get_the_time( get_option('date_format') ) .'</p>';
											$output .= '</div>';
										}								
										//comment 
										if( $show_post_date == 'yes' ) {
											$output .= '<div class="post-comment-count">';
												$output .= '<p class="comment-count"><i class="simple-icon icon-speech"></i>'.( get_comments_number() ) .'</p>';
											$output .= '</div>';
										}
									$output .= '</div><!-- .entry-meta-wrapper -->';									
								}							
							}								
						

							if( isset( $show_content ) && $show_content == 'yes' ) {
								$output .= '<div class="entry-summary"><p>';
									$output .= gosolar_shortcode_stripped_excerpt( get_the_content(), $excerpt_limit );
								$output .= '</p></div><!-- .entry-summary -->';
							}
							
							if( $read_more == 'yes' && $blog_style != 'list-style' ) {
								if( ! gosolar_get_theme_option( 'zozo_blog_read_more_text' ) ) {
									$more_text = esc_html__('Read more', 'gosolar'); 
								} else { 
									$more_text = gosolar_get_theme_option( 'zozo_blog_read_more_text' );
								}
								
								if( !$rm_stat ){
									$rm_stat = 1;
									$output .= '<div class="read-more"><a href="'. esc_url($external_url) .'" class="btn-more read-more-link" title="'. esc_html( get_the_title() ) .'"'. $link_attr .'>'.$more_text.'</a></div><!-- .read-more -->';
								}
							}
						
							if( $blog_style == 'list-style' ) {
								$output .= '<div class="entry-meta-wrapper">';							
									$output .= '<ul class="entry-meta">';
										if( $show_author == 'yes' ) {
											$output .= '<li class="post-author">';
												$output .= get_avatar(get_the_author_meta('email'), '30');
												$output .= '<span class="post-author-name">'. get_the_author_posts_link() .'</span>';
											$output .= '</li>';
										}
										if( $read_more == 'yes' ) {
											if( ! gosolar_get_theme_option( 'zozo_blog_read_more_text' ) ) {
												$more_text = esc_html__('Read more', 'gosolar'); 
											} else { 
												$more_text = gosolar_get_theme_option( 'zozo_blog_read_more_text' );
											}
											
											if( !$rm_stat ){
												$rm_stat = 1;
												$output .= '<li class="read-more"><a href="'. esc_url($external_url) .'" class="btn-more read-more-link" title="'. esc_html( get_the_title() ) .'"'. $link_attr .'>'.$more_text.'</a></li>';
											}
										}
									$output .= '</ul>';
								$output .= '</div><!-- .entry-meta-wrapper -->';
							}
								
						$output .= '</div><!-- .posts-content-container -->';
						
					$output .= '</div><!-- .post-inner-wrapper -->';
					$output .= '</div>';
					
					$count++;
					
				endwhile;
				
				$output .= '</div><!-- .latest-posts-layout/.zozo-latest-posts-slider -->';
			$output .= '</div><!-- .zozo-latest-posts-wrapper -->';
			
		}
		
		$latest_posts_id++;
		wp_reset_postdata();
		
		return $output;
	}
}

if ( ! function_exists( 'gosolar_vc_latest_posts_shortcode_map' ) ) {
	function gosolar_vc_latest_posts_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> esc_html__( "Latest Posts", "gosolar" ),
				"description"			=> esc_html__( "Show your latest blog posts.", 'gosolar' ),
				"base"					=> "zozo_vc_latest_posts",
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
						"heading"		=> esc_html__( "Posts to Show?", "gosolar" ),
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
						"heading"		=> esc_html__( "Blog Style", "gosolar" ),
						"param_name"	=> "blog_style",
						"admin_label" 	=> true,
						"value"			=> array(
							esc_html__( "Default", "gosolar" )			=> "default",
							esc_html__( "List Style", "gosolar" )	=> "list-style",
							esc_html__( "2 Column Style", "gosolar" )	=> "two-column",
							esc_html__( "Slider Style", "gosolar" )		=> "slider" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> esc_html__( "Show Title", "gosolar" ),
						"param_name"	=> "show_title",
						"value"			=> array(
							esc_html__( "Yes", "gosolar" )	=> "yes",
							esc_html__( "No", "gosolar" )	=> "no" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> esc_html__( "Show Content", "gosolar" ),
						"param_name"	=> "show_content",
						"value"			=> array(
							esc_html__( "Yes", "gosolar" )	=> "yes",
							esc_html__( "No", "gosolar" )	=> "no" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> esc_html__( "Show Author Link", "gosolar" ),
						"param_name"	=> "show_author",
						"value"			=> array(
							esc_html__( "No", "gosolar" )	=> "no",
							esc_html__( "Yes", "gosolar" )	=> "yes" ),
					),					
					array(
						"type"			=> 'dropdown',
						"heading"		=> esc_html__( "Show Read More Link", "gosolar" ),
						"param_name"	=> "read_more",
						"value"			=> array(
							esc_html__( "No", "gosolar" )	=> "no",
							esc_html__( "Yes", "gosolar" )	=> "yes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> esc_html__( "Show Date", "gosolar" ),
						"param_name"	=> "show_post_date",
						"value"			=> array(
							esc_html__( "No", "gosolar" )	=> "no",
							esc_html__( "Yes", "gosolar" )	=> "yes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> esc_html__( "Show Comment Count", "gosolar" ),
						"param_name"	=> "show_comment_count",
						"value"			=> array(
							esc_html__( "No", "gosolar" )	=> "no",
							esc_html__( "Yes", "gosolar" )	=> "yes" ),
					),
					// Slider
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Show Categories", "gosolar" ),
						"param_name"	=> "show_categories",
						'value'			=> array(
							esc_html__( 'No', 'gosolar' )	=> 'no',
							esc_html__( 'Yes', 'gosolar' )	=> 'yes',
						),						
						"group"			=> esc_html__( "Slider", "gosolar" ),
						'dependency'	=> array(
							'element'	=> "blog_style",
							'value'		=> 'slider'
						),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items to Display", "gosolar" ),
						"param_name"	=> "items",
						'admin_label'	=> true,
						"group"			=> esc_html__( "Slider", "gosolar" ),
						'dependency'	=> array(
							'element'	=> "blog_style",
							'value'		=> 'slider'
						),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items to Scrollby", "gosolar" ),
						"param_name"	=> "items_scroll",
						"group"			=> esc_html__( "Slider", "gosolar" ),
						'dependency'	=> array(
							'element'	=> "blog_style",
							'value'		=> 'slider'
						),
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
						'dependency'	=> array(
							'element'	=> "blog_style",
							'value'		=> 'slider'
						),
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
						'dependency'	=> array(
							'element'	=> "blog_style",
							'value'		=> 'slider'
						),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Margin ( Items Spacing )", "gosolar" ),
						"param_name"	=> "margin",
						'admin_label'	=> true,
						"group"			=> esc_html__( "Slider", "gosolar" ),
						'dependency'	=> array(
							'element'	=> "blog_style",
							'value'		=> 'slider'
						),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items To Display in Tablet", "gosolar" ),
						"param_name"	=> "items_tablet",
						"group"			=> esc_html__( "Slider", "gosolar" ),
						'dependency'	=> array(
							'element'	=> "blog_style",
							'value'		=> 'slider'
						),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items To Display In Mobile Landscape", "gosolar" ),
						"param_name"	=> "items_mobile_landscape",
						"group"			=> esc_html__( "Slider", "gosolar" ),
						'dependency'	=> array(
							'element'	=> "blog_style",
							'value'		=> 'slider'
						),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items To Display In Mobile Portrait", "gosolar" ),
						"param_name"	=> "items_mobile_portrait",
						"group"			=> esc_html__( "Slider", "gosolar" ),
						'dependency'	=> array(
							'element'	=> "blog_style",
							'value'		=> 'slider'
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> esc_html__( "Navigation", "gosolar" ),
						"param_name"	=> "navigation",
						"value"			=> array(
							esc_html__( "Yes", "gosolar" )	=> "true",
							esc_html__( "No", "gosolar" )	=> "false" ),
						"group"			=> esc_html__( "Slider", "gosolar" ),
						'dependency'	=> array(
							'element'	=> "blog_style",
							'value'		=> 'slider'
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> esc_html__( "Pagination", "gosolar" ),
						"param_name"	=> "pagination",
						"value"			=> array(
							esc_html__( "Yes", "gosolar" )	=> "true",
							esc_html__( "No", "gosolar" )	=> "false" ),
						"group"			=> esc_html__( "Slider", "gosolar" ),
						'dependency'	=> array(
							'element'	=> "blog_style",
							'value'		=> 'slider'
						),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'gosolar_vc_latest_posts_shortcode_map' );
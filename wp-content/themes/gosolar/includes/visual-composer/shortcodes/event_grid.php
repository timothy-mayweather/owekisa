<?php 

/**

 * Event Grid shortcode

 */



if ( ! function_exists( 'gosolar_vc_event_grid_shortcode' ) ) {

	function gosolar_vc_event_grid_shortcode( $atts, $content = NULL ) {

	

		$atts = vc_map_get_attributes( 'zozo_vc_event_grid', $atts );

		extract( $atts );



		$output = '';

		static $event_id = 1;

		global $post;

		

		// Include categories

		$include_categories = ( '' != $include_categories ) ? $include_categories : '';

		$include_categories = ( 'all' == $include_categories ) ? '' : $include_categories;

		$include_filter_cats = '';

		if( $include_categories ) {

			$include_categories = explode( ',', $include_categories );

			$include_filter_cats = array();

			foreach( $include_categories as $key ) {

				$key = get_term_by( 'slug', $key, 'event_categories' );

				$include_filter_cats[] = $key->term_id;

			}

		}

		

		if ( ! empty( $include_categories ) && is_array( $include_categories ) ) {

			$include_categories = array(

				'taxonomy'	=> 'event_categories',

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

					$key = get_term_by( 'slug', $key, 'event_categories' );

					$exclude_filter_cats[] = $key->term_id;

				}

				$exclude_categories = array(

						'taxonomy'	=> 'event_categories',

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

						'post_type' 		=> 'zozo_event',

						'posts_per_page'	=> $posts,

						'paged' 			=> $paged,

						'orderby' 		 	=> 'meta_value',

						'order' 		 	=> $orderby,

					  );

					  		

		$query_args['tax_query'] 	= array(

										'relation'	=> 'AND',

										$include_categories,

										$exclude_categories );

		

		$event_query = new WP_Query( $query_args );

		

		// Classes

		$main_classes = '';

		

		if( isset( $classes ) && $classes != '' ) {

			$main_classes .= ' ' . $classes;

		}

		$main_classes .= gosolar_vc_animation( $css_animation );

		$main_classes .= ' event-columns-'.$columns;	

		

		

		$column_class = '';

		if( isset( $events_style ) && $events_style == 'grid' ) {

			if( isset( $columns ) && $columns != '' ) {

				if( isset( $columns ) && $columns == '2' ) {

					$column_class = ' col-md-6 col-sm-6 col-xs-12';

				} else if( isset( $columns ) && $columns == '3' ) {

					$column_class = ' col-md-4 col-sm-6 col-xs-12';

				} else if( isset( $columns ) && $columns == '4' ) {

					$column_class = ' col-md-3 col-sm-6 col-xs-12';

				}

			} else {

				$column_class = ' col-md-12 col-xs-12';

			}

		}elseif( isset( $events_style ) && $events_style == 'list' ) {

			$column_class = ' col-md-12 col-xs-12';

		}

		if( $event_query->have_posts() ) {

		

			$output = '<div class="zozo-event-'. ( $events_style == 'list' ? 'list' : 'grid' ) .'-wrapper'.$main_classes.'">';

			$output .= $events_style != 'list' ? '<div class="row event-grid-inner">' : '';

			

			$count = 1;			

			$c = 1;

			$r = 1;

			

			if( isset( $columns ) && $columns == '2' ) {

				$image_size = 'gosolar-custom-large';

			} else {

				$image_size = 'gosolar-custom-large';

			}

			

			if( $events_style == 'list' )

				$image_size = 'gosolar-blog-thumb';

				

			while($event_query->have_posts()) : $event_query->the_post();



				$event_img = '';

				$event_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $image_size);				

				

				$event_img_large = ''; 

				$event_img_large = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

				$event_img_mid = ''; 

				$event_img_mid = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'gosolar-team');

				

				$start_date 	 = get_post_meta( $post->ID, 'zozo_event_start_date', true );

				$start_time 	 = get_post_meta( $post->ID, 'zozo_event_start_time', true );

				$custom_link 	 = get_post_meta( $post->ID, 'zozo_event_custom_link', true );

				$custom_link_target 	 = get_post_meta( $post->ID, 'zozo_event_link_target', true );

				$button_text 	 = get_post_meta( $post->ID, 'zozo_event_button_text', true );

				if( isset( $events_style ) && $events_style == 'grid' ) 

				{				

						

					if( ( isset( $columns ) && $columns == '2' && $count == '3' ) || ( isset( $columns ) && $columns == '3' && $count == '4' ) || ( isset( $columns ) && $columns == '4' && $count == '5' ) ) {

						$count = 1;

						$output .= '<div class="event-clearfix clearfix"></div>';

					}

							

					$output .= '<div class="event-item '.$column_class.'">';

					

						if( isset( $event_img ) && $event_img != '' ) {

							$output .= '<div class="event-item-img">';

								$output .= '<a href="'.esc_url( $event_img_large[0] ).'" data-rel="prettyPhoto[gallery'.$event_id.']" class="event-img-link" title="'. esc_html( get_the_title() ) .'"><img class="img-responsive" src="'.esc_url($event_img[0]).'" width="'.esc_attr($event_img[1]).'" height="'.esc_attr($event_img[2]).'" alt="'. esc_html( get_the_title() ) .'" /></a>';

							$output .= '</div>';

						}

										

						$output .= '<div class="event-content-wrapper">';

							$output .= '<h4 class="grid-event-title"><a href="'. esc_url( get_permalink() ) .'" title="'. esc_html( get_the_title() ) .'">'. esc_html( get_the_title() ) .'</a></h4>';

							

							$organiser_name = get_post_meta( get_the_ID(), 'zozo_event_organiser_name', true );

							$organiser_designation = get_post_meta( get_the_ID(), 'zozo_event_organiser_designation', true );

							$output .= '<div class="event-short-description">';

								$output .= !empty($organiser_name) ? '<h6 class="organiser-name">'. esc_attr($organiser_name).', ' : '';

								$output .= !empty($organiser_designation) ? '<span class="organiser-designation">'. esc_attr($organiser_designation) .'</span></h6>' : '';

							$output .= '</div>';

							

							$output .= '<h5 class="grid-event-date">'.'<span class="event-date">'.' <i class="fa fa-calendar"></i> '. $start_date  .'</span>'.'<span class="event-time">'.' <i class="fa fa-clock-o"></i> '. $start_time  .'</span>'.' </h5>';

													

							if( isset( $show_excerpt ) && $show_excerpt == 'yes' ) {

								$output .= '<div class="grid-event-excerpts">';

									if( isset( $excerpt_length ) && $excerpt_length != '' ) {

										$output .= '<p>' . gosolar_shortcode_stripped_excerpt( get_the_excerpt(), $excerpt_length ) . '</p>';

									} else {

										$output .= '<p>' . gosolar_shortcode_stripped_excerpt( get_the_excerpt(), 15 ) . '</p>';

									}

								$output .= '</div>';

							}

							if( isset( $button_text ) && $button_text != '' ) {

							  $output .= '<div class="grid-event-button">';

							  if( isset( $custom_link ) && $custom_link != '' ) {

								$output .= '<a target="'. $custom_link_target .'" href="'. $custom_link .'" class="btn btn-more" title="'. esc_html( get_the_title() ) .'">'. $button_text .'</a>';

							  }

							  else{

								$output .= '<a href="'. esc_url( get_permalink() ) .'" class="btn btn-more" title="'. esc_html( get_the_title() ) .'">'. $button_text .'</a>';

							  }

							  $output .= '</div>';

							}

						$output .= '</div>';

						

					$output .= '</div>';					

				}elseif( isset( $events_style ) && $events_style == 'list' ) 

				{				

					$output .= '<div class="row event-list-inner">';

						

						$output .= '<div class="col-sm-2">';

							if( isset( $event_img ) && $event_img != '' ) {

								$output .= '<div class="event-item-img">';

									$output .= '<a href="'.esc_url( $event_img_large[0] ).'" data-rel="prettyPhoto[gallery'.$event_id.']" class="event-img-link" title="'. esc_html( get_the_title() ) .'"><img class="img-responsive img-circle" src="'.esc_url($event_img[0]).'" width="'.esc_attr($event_img[1]).'" height="'.esc_attr($event_img[2]).'" alt="'. esc_html( get_the_title() ) .'" /></a>';

								$output .= '</div>';

							}

						$output .= '</div><!--col-sm-2-->';

						

						$output .= '<div class="col-sm-7">';

							$output .= '<div class="event-content-wrapper">';

								$output .= '<h4 class="grid-event-title"><a href="'. esc_url( get_permalink() ) .'" title="'. esc_html( get_the_title() ) .'">'. esc_html( get_the_title() ) .'</a></h4>';

								$organiser_name = get_post_meta( get_the_ID(), 'zozo_event_organiser_name', true );

								$organiser_designation = get_post_meta( get_the_ID(), 'zozo_event_organiser_designation', true );

								$output .= '<div class="event-short-description">';

									$output .= !empty($organiser_name) ? '<h6 class="organiser-name">'. esc_attr($organiser_name).', ' : '';

									$output .= !empty($organiser_designation) ? '<span class="organiser-designation">'. esc_attr($organiser_designation) .'</span></h6>' : '';

								$output .= '</div>';

							$output .= '</div>';

						$output .= '</div><!--col-sm-7-->';

						

						$output .= '<div class="col-sm-3">';

							$event_venue = get_post_meta( get_the_ID(), 'zozo_event_venue', true );

							$output .= '<h3 class="list-event-venue theme-color">'. $event_venue .' </h3>';

							$output .= '<h5 class="grid-event-date">'.'<span class="event-date">'.' <i class="fa fa-calendar"></i> '. $start_date  .'</span>'.'<span class="event-time">'.' <i class="fa fa-clock-o"></i> '. $start_time  .'</span>'.' </h5>';

						$output .= '</div><!--col-sm-3-->';

						

					$output .= '</div><!--row-->';					

				}

				else

				{

					$output .= $c == 1 ? '<div class="row classic-view" >' : '';

						$push_class = $pull_class = '';

						if( ( $c <= 2 ) && ( $r % 2 == 0 ) ){

							$push_class = 'col-md-push-3';

							$pull_class = 'col-md-pull-3';

						}



						$output .= '<div class="col-md-3 '. esc_attr( $push_class ) .'">';

							if( isset( $event_img ) && $event_img != '' ) {

								$output .= '<div class="event-item-img">';

									$output .= '<a href="'. esc_url( get_permalink() ) .'" class="event-img-link" title="'. esc_html( get_the_title() ) .'"><img class="img-responsive" src="'.esc_url($event_img_mid[0]).'" width="'.esc_attr($event_img_mid[1]).'" height="'.esc_attr($event_img_mid[2]).'" alt="'. esc_html( get_the_title() ) .'" /></a>';

								$output .= '</div>';

							}

							else

							{

								$output .= '<div class="event-item-img">';

									$output .= '<img class="img-responsive" src="'. esc_url( GOSOLAR_THEME_URL . '/images/empty.jpg' ) .'" alt="'. esc_html( get_the_title() ) .'" />';

								$output .= '</div>';

							}

						$output .= '</div>';

						$output .= '<div class="col-md-3 '. esc_attr( $pull_class ) .'">';

							$output .= '<div class="event-content-wrapper">';

								

								$output .= '<h5 class="grid-event-date">'.'<span class="event-date">'.' <i class="fa fa-calendar"></i> '. $start_date  .'</span>'.'<span class="event-time">'.' <i class="fa fa-clock-o"></i> '. $start_time  .'</span>'.' </h5>';

								$output .= '<h4 class="grid-event-title"><a href="'. esc_url( get_permalink() ) .'" title="'. esc_html( get_the_title() ) .'">'. esc_html( get_the_title() ) .'</a></h4>';

								

														

								if( isset( $show_excerpt ) && $show_excerpt == 'yes' ) {

									$output .= '<div class="grid-event-excerpts">';

										if( isset( $excerpt_length ) && $excerpt_length != '' ) {

											$output .= '<p>' . gosolar_shortcode_stripped_excerpt( get_the_excerpt(), $excerpt_length ) . '</p>';

										} else {

											$output .= '<p>' . gosolar_shortcode_stripped_excerpt( get_the_excerpt(), 10 ) . '</p>';

										}

									$output .= '</div>';

								}

								if( isset( $button_text ) && $button_text != '' ) {

								  $output .= '<div class="grid-event-button">';

								  if( isset( $custom_link ) && $custom_link != '' ) {

									$output .= '<a target="'. $custom_link_target .'" href="'. $custom_link .'" class="btn btn-more" title="'. esc_html( get_the_title() ) .'">'. $button_text .'</a>';

								  }

								  else{

									$output .= '<a href="'. esc_url( get_permalink() ) .'" class="btn btn-more" title="'. esc_html( get_the_title() ) .'">'. $button_text .'</a>';

								  }

								  $output .= '</div>';

								}

							$output .= '</div>';

						$output .= '</div>';

						

					if( $c == 2 ){

						$output .= '</div>';

						$c = 0;

						$r++;

					}

					

					$c++;

				}

			endwhile;

			

			$output .= $c != 1 ? '</div>' : '';

				

			$output .= '</div>';

				

			if( isset( $pagination ) && $pagination == 'yes' ) {

				$output .= gosolar_pagination( $event_query->max_num_pages, '' );

			}

			

			$output .= '</div>';

		}		

		

		$event_id++;

		wp_reset_postdata();

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_event_grid_shortcode_map' ) ) {

	function gosolar_vc_event_grid_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Event", "gosolar" ),

				"description"			=> esc_html__( "Show your event by different styles.", 'gosolar' ),

				"base"					=> "zozo_vc_event_grid",

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

						"heading"		=> esc_html__( "Style", "gosolar" ),

						"param_name"	=> "events_style",						

						"value"			=> array(

							esc_html__( "Classic", "gosolar" )		=> "classic",

							esc_html__( "Grid", "gosolar" )		=> "grid" ,

							esc_html__( "List", "gosolar" )		=> "list" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Columns", "gosolar" ),

						"param_name"	=> "columns",

						"value"			=> array(

							esc_html__( "Two Columns", "gosolar" )		=> "2",

							esc_html__( "Three Columns", "gosolar" )		=> "3",

							esc_html__( "Four Columns", "gosolar" )		=> "4" ),

						'dependency' 	=> array(

							'element' 	=> 'events_style',

							'value' 	=> array( 'grid' ),

						),

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

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Order By", "gosolar" ),

						"param_name"	=> "orderby",

						"value"			=> array(

							esc_html__( "ASC", "gosolar" )		=> "ASC",

							esc_html__( "DESC", "gosolar" )		=> "DESC",							

						),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_event_grid_shortcode_map' );
<?php 

/**

 * Woocommerce Latest Product Slider shortcode

 */



if ( ! function_exists( 'gosolar_vc_woo_product_slider_shortcode' ) ) {

	function gosolar_vc_woo_product_slider_shortcode( $atts, $content = NULL ) {

		

		extract( 

			shortcode_atts( 

				array(

					'classes'					=> '',

					'css_animation'				=> '',

					'products' 					=> '-1',

					'categories_id' 			=> 'all',

					'items'						=> '6',

					'items_scroll' 				=> '1',

					'auto_play' 				=> 'true',					

					'timeout_duration' 			=> '5000',

					'infinite_loop' 			=> 'false',

					'margin' 					=> '30',

					'items_tablet'				=> '4',

					'items_mobile_landscape'	=> '2',

					'items_mobile_portrait'		=> '1',

					'navigation' 				=> 'true',

					'pagination' 				=> 'true',

				), $atts 

			) 

		);



		$output = '';

		global $post;

		static $product_slider_id = 1;

				

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

		

		// Classes

		$main_classes = '';

		$main_classes .= gosolar_vc_animation( $css_animation );

		

		$query_args = array(

				'post_type' 		=> 'product',

				'post_status' 		=> 'publish',

				'posts_per_page'	=> $products,

				'orderby' 			=> 'date',

				'order' 			=> 'DESC',

			);

			

		if( $categories_id != 'all' ) {

			$query_args['tax_query'] 	= array(

											array(

												'taxonomy' 	=> 'product_cat',

												'field' 	=> 'slug',

												'terms' 	=> $categories_id

											) );

		

		}

	

		$latest_product_query = new WP_Query( $query_args );

		

		if( $latest_product_query->have_posts() ) {

			$output = '<div class="zozo-woo-latest-slider-wrapper clearfix'.$main_classes.'">';

			$output .= '<div id="zozo-woo-latest-slider-' . $product_slider_id. '" class="zozo-owl-carousel zozo-woo-latest-slider owl-carousel"' . $data_attr . '>';

			

				while($latest_product_query->have_posts()) : $latest_product_query->the_post();

					global $product;

					$woo_product_img 	= wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'gosolar-theme-mid' );

					$cat_count 			= sizeof( get_the_terms( get_the_ID(), 'product_cat' ) );

					

					$output .= '<div class="woo-latest-slider-item">';

						

						$output .= '<div class="woo-latest-product-box">';

							$output .= '<a href="'.get_permalink().'" title="'.get_the_title().'"><img src="'.esc_url( $woo_product_img[0] ).'" alt="'.get_the_title().'" /></a>';

							$output .= '<div class="product-buttons-overlay">';

							$output .= '<div class="product-buttons-wrapper"><div class="product-buttons">';

								$output .= '<a href="' . get_permalink() . '" class="woo-show-details">' . esc_html__( 'Show Details', 'gosolar' ) . '</a>';

							$output .= '</div></div>';

							$output .= '</div>';

						$output .= '</div>';

						

						$output .= '<div class="woo-latest-product-content">';

							$output .= '<h6 class="latest-product-title">'.get_the_title().'</h6>';

							if ( $price_html = $product->get_price_html() ) :

								$output .= '<span class="price">'. $price_html .'</span>';

							endif;							

						$output .= '</div>';

						

					$output .= '</div>';

					

				endwhile;

				

			$output .= '</div>';

			$output .= '</div>';

		}

		

		$product_slider_id++;

		wp_reset_postdata();

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_woo_product_slider_shortcode_map' ) ) {

	function gosolar_vc_woo_product_slider_shortcode_map() {

				

		vc_map( 

			array(

				"name"					=> esc_html__( "Woo Latest Product Slider", "gosolar" ),

				"description"			=> esc_html__( "Show latest products in Slider.", 'gosolar' ),

				"base"					=> "zozo_vc_woo_product_slider",

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

						"heading"		=> esc_html__( "Number Of Products", "gosolar" ),

						"param_name"	=> "products",

						'admin_label' 	=> true,

						'value' 		=> '',

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

add_action( 'vc_before_init', 'gosolar_vc_woo_product_slider_shortcode_map' );
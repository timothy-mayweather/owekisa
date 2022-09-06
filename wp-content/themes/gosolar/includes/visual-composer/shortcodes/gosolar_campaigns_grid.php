<?php 
/**
 * Campaigns Grid shortcode
 */
if ( ! function_exists( 'gosolar_vc_gosolar_campaigns_grid_shortcode' ) ) {
	function gosolar_vc_gosolar_campaigns_grid_shortcode( $atts, $content = NULL ) {
	
		$atts = vc_map_get_attributes( 'gosolar_vc_gosolar_campaigns_grid', $atts );
		extract( $atts );
		
		$output = $gosolar_attr = '';
		
		
				// Classes

		$main_classes = '';
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		$main_classes .= gosolar_vc_animation( $css_animation );
		
				
		//posts Count
		$gosolar_attr .= isset( $num_posts ) && $num_posts != '' ? 'number=' . absint($num_posts) . ' ' : '';
		
		//column 
		if( isset( $layout_style ) && $layout_style != 'list' )
			$gosolar_attr .= isset( $columns ) && $columns != '' ? 'columns=' . absint($columns) . ' ' : '';
		else
			$gosolar_attr .= isset( $columns ) && $columns != '' ? 'columns=1 ' : '';
		
		//category
		$gosolar_attr .= isset( $include_categories ) && $include_categories != '' ? 'category=' . esc_attr($include_categories) . ' ' : '';

		//order
		$gosolar_attr .= isset( $orderby ) && $orderby != '' ? 'orderby=' . esc_attr($orderby) . ' ' : '';
		
		//Include id
		$gosolar_attr .= isset( $camp_id ) && $camp_id != '' ? 'id=' . absint($camp_id) . ' ' : '';
		
			$output .= '<div class="gosolar-campaigns' .$main_classes.'">'; 
				$output .=	do_shortcode('[campaigns '. $gosolar_attr .']');		   
			$output .= '</div>';
			return $output;


		
	}
}

if ( ! function_exists( 'gosolar_vc_gosolar_campaigns_grid_shortcode_map' ) ) {
	function gosolar_vc_gosolar_campaigns_grid_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> esc_html__( "GoSolar Campaigns", "gosolar" ),
				"description"			=> esc_html__( "Show your gosolar campaigns by different styles.", 'gosolar' ),
				"base"					=> "gosolar_vc_gosolar_campaigns_grid",
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
						"heading"		=> esc_html__( "Campaigns per Page", "gosolar" ),
						"admin_label" 	=> true,
						"param_name"	=> "num_posts",	
						"value"			=> ""					
					),
					
					array(
						"type"			=> 'dropdown',
						"heading"		=> esc_html__( "Layouts", "gosolar" ),
						"param_name"	=> "layout_style",
						"value"			=> array(
							esc_html__( "Grid", "gosolar" )=> "grid",
							esc_html__( "List", "gosolar" )=> "list"),

					),
					
					array(
						"type"			=> 'dropdown',
						"heading"		=> esc_html__( "Columns", "gosolar" ),
						"param_name"	=> "columns",
						"value"			=> array(
							esc_html__( "Two Columns", "gosolar" )		=> "2",
							esc_html__( "Three Columns", "gosolar" )	=> "3",
							esc_html__( "Four Columns", "gosolar" )		=> "4" ),
							
							'dependency'	=> array(
							'element'	=> 'layout_style',
							'value'		=>  'grid' ,
						),
					),
					
					array(

						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Include Category', 'gosolar' ),
						'param_name'	=> 'include_categories',
						'admin_label'	=> true,
						'description'	=> esc_html__( "Enter the slug of a category", 'gosolar' ),

					),
					
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Campaigns ID's", "gosolar" ),
						"admin_label" 	=> true,
						"param_name"	=> "camp_id",	
						"value"			=> "",
						'description'	=> esc_html__( "Enter the ID of a categories (comma seperated) to pull campaigns from campaigns. Example: 15, 12", 'gosolar' ),			
					),
					
					array(

						"type"			=> 'dropdown',
						"heading"		=> esc_html__( "Order By", "gosolar" ),
						"param_name"	=> "orderby",
						"value"			=> array(
							esc_html__( "Post Date", "gosolar" )		=> "post_date",
							esc_html__( "popular Campaigns", "gosolar" )		=> "post_date",
							esc_html__( "Ending Campaigns", "gosolar" )		=> "ending",							
						),
					),
			
			  )
			
			)
			
		);
	}
}
add_action( 'vc_before_init', 'gosolar_vc_gosolar_campaigns_grid_shortcode_map' );
<?php 

/**

 * Add new params to Visual Composer

 *

 * @package		GoSolar

 * @subpackage	Visual Composer

 * @author		Zozothemes

 */



/* =========================================

*  Rows

*  ========================================= */



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Background Style', 'gosolar' ),

	'param_name'	=> 'bg_style',

	'value'			=> array(

		esc_html__( 'Default', 'gosolar' )								=> '',

		esc_html__( 'Primary Background Color', 'gosolar' )			=> 'bg-normal',

		esc_html__( 'Light Background Color', 'gosolar' )				=> 'light-wrapper',

		esc_html__( 'Grey Background Color', 'gosolar' )				=> 'grey-wrapper',

		esc_html__( 'Dark Background Color', 'gosolar' )				=> 'dark-wrapper',

		esc_html__( 'Dark Grey Background Color', 'gosolar' )			=> 'dark-grey-wrapper',

		esc_html__( 'Image Left, Content on Right', 'gosolar' )		=> 'image-left',

		esc_html__( 'Image Right, Content on Left', 'gosolar' )		=> 'image-right',

	),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Background Skin', 'gosolar' ),

	'param_name'	=> 'bg_side_skin',

	'value'			=> array(

		esc_html__( 'Default', 'gosolar' )								=> '',

		esc_html__( 'Primary Background Color', 'gosolar' )			=> 'bg-normal',

		esc_html__( 'Light Background Color', 'gosolar' )				=> 'light-wrapper',

		esc_html__( 'Grey Background Color', 'gosolar' )				=> 'grey-wrapper',

		esc_html__( 'Dark Background Color', 'gosolar' )				=> 'dark-wrapper',

		esc_html__( 'Dark Grey Background Color', 'gosolar' )			=> 'dark-grey-wrapper',

	),

	'dependency'	=> array(

		'element'	=> 'bg_style',

		'value'		=> array( 'image-left', 'image-right' )

	),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'attach_image',

	'heading'		=> esc_html__( 'Left or Right Image', 'gosolar' ),

	'param_name'	=> 'bg_side_image',

	'value'			=> '',

	'dependency'	=> array(

		'element'	=> 'bg_style',

		'value'		=> array( 'image-left', 'image-right' )

	),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Background Size', 'gosolar' ),

	'param_name'	=> 'bg_side_size',

	'value'			=> array(

		esc_html__( 'Default', 'gosolar' )		=> 'default',

		esc_html__( 'Cover', 'gosolar' )		=> 'cover',

		esc_html__( 'Contain', 'gosolar' )		=> 'contain',

	),

	'dependency'	=> array(

		'element'	=> 'bg_style',

		'value'		=> array( 'image-left', 'image-right' )

	),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Background Repeat', 'gosolar' ),

	'param_name'	=> 'bg_side_repeat',

	'value'			=> array(

		esc_html__( 'No Repeat', 'gosolar' )	=> 'no-repeat',

		esc_html__( 'Repeat', 'gosolar' )		=> 'repeat',

		esc_html__( 'Repeat-x', 'gosolar' )	=> 'repeat-x',

		esc_html__( 'Repeat-y', 'gosolar' )	=> 'repeat-y',

	),

	'dependency'	=> array(

		'element'	=> 'bg_style',

		'value'		=> array( 'image-left', 'image-right' )

	),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Make Container Fluid ?', 'gosolar' ),

	'param_name'	=> 'container_fluid',

	'value'			=> array(

		esc_html__( 'No', 'gosolar' )	=> 'no',

		esc_html__( 'Yes', 'gosolar' )	=> 'yes',

	),

	'dependency'	=> array(

		'element'	=> 'bg_style',

		'value'		=> array( 'image-left', 'image-right' )

	),

	'description'	=> esc_html__( 'Use this option to make column in fluid container.', 'gosolar' ),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Column Match Height', 'gosolar' ),

	'param_name'	=> 'match_height',

	'value'			=> array(

		esc_html__( 'No', 'gosolar' )	=> 'no',

		esc_html__( 'Yes', 'gosolar' )	=> 'yes',

	),

	'dependency'	=> array(

		'element'	=> 'bg_style',

		'value'		=> array( '', 'bg-normal', 'light-wrapper', 'grey-wrapper', 'dark-wrapper' )

	),

	'description'	=> esc_html__( 'Use this option to make all column in equal heights..', 'gosolar' ),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Center Row Content', 'gosolar' ),

	'param_name'	=> 'center_row',

	'value'			=> array(

		esc_html__( 'No', 'gosolar' )	=> 'no',

		esc_html__( 'Yes', 'gosolar' )	=> 'yes',

	),

	'description'	=> esc_html__( 'Use this option to add container and center the inner content. Useful when using full-width pages.', 'gosolar' ),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'checkbox',

	'heading'		=> esc_html__( 'Enable Background Image Overlay?', 'gosolar' ),

	'param_name'	=> 'bg_overlay',

	'description'	=> esc_html__( 'Check this box to enable the overlay for background image.', 'gosolar' ),

	'value'			=> array(

		esc_html__( 'Yes, please', 'gosolar' )	=> 'yes'

	),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Background Overlay Style', 'gosolar' ),

	'param_name'	=> 'bg_overlay_style',

	'value'			=> array(

		esc_html__( 'Default', 'gosolar' )				=> 'overlay-dark',

		esc_html__( 'Dark Overlay', 'gosolar' )			=> 'overlay-dark',

		esc_html__( 'Light Overlay', 'gosolar' )			=> 'overlay-light',

		esc_html__( 'Theme Overlay', 'gosolar' )			=> 'overlay-primary',	

	),

	'dependency'	=> array(

		'element'	=> 'bg_overlay',

		'value'		=> 'yes'

	),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'checkbox',

	'heading'		=> esc_html__( 'Enable Video Background?', 'gosolar' ),

	'param_name'	=> 'enable_video_bg',

	'description'	=> esc_html__( 'Check this box to enable the options for video background.', 'gosolar' ),

	'value'			=> array(

		esc_html__( 'Yes, please', 'gosolar' )	=> 'yes'

	),

	'group'			=> esc_html__( 'Video', 'gosolar' ),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'textfield',

	'heading'		=> esc_html__( 'Video ID', 'gosolar' ),

	'param_name'	=> 'video_id',

	'description'	=> esc_html__( 'Enter Youtube Video ID to play background video. Ex: Y-OLlJUXwKU', 'gosolar' ),

	'dependency'	=> array(

		'element'	=> 'enable_video_bg',

		'value'		=> 'yes'

	),

	'group'			=> esc_html__( 'Video', 'gosolar' ),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'attach_image',

	'heading'		=> esc_html__( 'Video Fallback Image', 'gosolar' ),

	'param_name'	=> 'video_fallback',

	'value'			=> '',

	'dependency'	=> array(

		'element'	=> 'enable_video_bg',

		'value'		=> 'yes'

	),

	'group'			=> esc_html__( 'Video', 'gosolar' ),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Video Autoplay', 'gosolar' ),

	'param_name'	=> 'video_autoplay',

	'value'			=> array(

		esc_html__( 'Yes', 'gosolar' )	=> 'true',

		esc_html__( 'No', 'gosolar' )	=> 'false',

	),

	'dependency'	=> array(

		'element'	=> 'enable_video_bg',

		'value'		=> 'yes'

	),

	'group'			=> esc_html__( 'Video', 'gosolar' ),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Video Mute', 'gosolar' ),

	'param_name'	=> 'video_mute',

	'value'			=> array(

		esc_html__( 'No', 'gosolar' )	=> 'false',

		esc_html__( 'Yes', 'gosolar' )	=> 'true',

	),

	'dependency'	=> array(

		'element'	=> 'enable_video_bg',

		'value'		=> 'yes'

	),

	'group'			=> esc_html__( 'Video', 'gosolar' ),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Video Controls', 'gosolar' ),

	'param_name'	=> 'video_controls',

	'value'			=> array(

		esc_html__( 'No', 'gosolar' )	=> 'false',

		esc_html__( 'Yes', 'gosolar' )	=> 'true',

	),

	'dependency'	=> array(

		'element'	=> 'enable_video_bg',

		'value'		=> 'yes'

	),

	'group'			=> esc_html__( 'Video', 'gosolar' ),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'textfield',

	'heading'		=> esc_html__( 'Video Height', 'gosolar' ),

	'param_name'	=> 'video_height',

	'description'	=> esc_html__( 'Enter Video Height. Ex: 400', 'gosolar' ),

	'dependency'	=> array(

		'element'	=> 'enable_video_bg',

		'value'		=> 'yes'

	),

	'group'			=> esc_html__( 'Video', 'gosolar' ),

) );



vc_add_param( 'vc_row', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Typography Style', 'gosolar' ),

	'param_name'	=> 'typo_style',

	'value'			=> array(

		esc_html__( 'Default', 'gosolar' )		=> 'default',

		esc_html__( 'Dark Text', 'gosolar' )	=> 'dark',

		esc_html__( 'White Text', 'gosolar' )	=> 'light',

	),

) );



vc_add_param( 'vc_row', vc_map_add_css_animation( $label = false ) );



vc_add_param( 'vc_row', array(

	'type'			=> 'textfield',

	'heading'		=> esc_html__( 'Minimum Height', 'gosolar' ),

	'param_name'	=> 'min_height',

	'description'	=> esc_html__( 'You can enter a minimum height for this row.', 'gosolar' ),

) );



vc_remove_param( 'vc_row', 'equal_height' );



/* =========================================

*  Row Inner

*  ========================================= */



vc_add_param( 'vc_row_inner', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Column Match Height', 'gosolar' ),

	'param_name'	=> 'match_height',

	'value'			=> array(

		esc_html__( 'No', 'gosolar' )	=> 'no',

		esc_html__( 'Yes', 'gosolar' )	=> 'yes',

	),

	'description'	=> esc_html__( 'Use this option to make all column in equal heights..', 'gosolar' ),

) );



/* =========================================

*  Columns

*  ========================================= */



vc_add_param( 'vc_column', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Background Style', 'gosolar' ),

	'param_name'	=> 'bg_style',

	'value'			=> array(

		esc_html__( 'Default', 'gosolar' )								=> '',

		esc_html__( 'Primary Background Color', 'gosolar' )			=> 'bg-normal',

		esc_html__( 'Light Background Color', 'gosolar' )				=> 'light-wrapper',

		esc_html__( 'Grey Background Color', 'gosolar' )				=> 'grey-wrapper',

		esc_html__( 'Dark Background Color', 'gosolar' )				=> 'dark-wrapper',

		esc_html__( 'Dark Grey Background Color', 'gosolar' )			=> 'dark-grey-wrapper',

	),

) );



vc_add_param( 'vc_column', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Typography Style', 'gosolar' ),

	'param_name'	=> 'typo_style',

	'value'			=> array(

		esc_html__( 'Default', 'gosolar' )		=> 'default',

		esc_html__( 'Dark Text', 'gosolar' )	=> 'dark',

		esc_html__( 'White Text', 'gosolar' )	=> 'light',

	),

) );



vc_add_param( 'vc_column', vc_map_add_css_animation( $label = false) );



/* =========================================

*  Column inner

*  ========================================= */



vc_add_param( 'vc_column_inner', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Background Style', 'gosolar' ),

	'param_name'	=> 'bg_style',

	'value'			=> array(

		esc_html__( 'Default', 'gosolar' )								=> '',

		esc_html__( 'Primary Background Color', 'gosolar' )			=> 'bg-normal',

		esc_html__( 'Light Background Color', 'gosolar' )				=> 'light-wrapper',

		esc_html__( 'Grey Background Color', 'gosolar' )				=> 'grey-wrapper',

		esc_html__( 'Dark Background Color', 'gosolar' )				=> 'dark-wrapper',

		esc_html__( 'Dark Grey Background Color', 'gosolar' )			=> 'dark-grey-wrapper',

	),

) );



vc_add_param( 'vc_column_inner', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Typography Style', 'gosolar' ),

	'param_name'	=> 'typo_style',

	'value'			=> array(

		esc_html__( 'Default', 'gosolar' )		=> 'default',

		esc_html__( 'Dark Text', 'gosolar' )	=> 'dark',

		esc_html__( 'White Text', 'gosolar' )	=> 'light',

	),

) );



vc_add_param( 'vc_column_inner', vc_map_add_css_animation( $label = false) );



/* =========================================

*  Accordion

*  ========================================= */



vc_add_param( 'vc_tta_accordion', array(

	'type'			=> 'dropdown',

	'heading'		=> esc_html__( 'Style', 'gosolar' ),

	'description' 	=> esc_html__( 'Select accordion display style.', 'gosolar' ),

	'param_name'	=> 'style',

	'value'			=> array(

		esc_html__( 'Default', 'gosolar' ) 	=> 'default',

		esc_html__( 'Classic', 'gosolar' ) 	=> 'classic',

		esc_html__( 'Modern', 'gosolar' ) 		=> 'modern',

		esc_html__( 'Flat', 'gosolar' ) 		=> 'flat',

		esc_html__( 'Outline', 'gosolar' ) 	=> 'outline',

	),

) );



/* =========================================

*  Section

*  ========================================= */



vc_remove_param( 'vc_tta_section', 'el_class' );



vc_add_param( 'vc_tta_section', array(

	"type" 			=> "dropdown",

	"heading" 		=> esc_html__( "Icon library", "gosolar" ),

	"value" 		=> array(

		esc_html__( "Font Awesome", "gosolar" ) 		=> "fontawesome",

		esc_html__( 'Open Iconic', 'gosolar' ) 		=> 'openiconic',

		esc_html__( 'Typicons', 'gosolar' ) 		=> 'typicons',

		esc_html__( 'Entypo', 'gosolar' ) 			=> 'entypo',

		esc_html__( "Lineicons", "gosolar" ) 		=> "lineicons",

		esc_html__( "Flaticons", "gosolar" ) 		=> "flaticons",

	),

	"admin_label" 	=> true,

	"param_name" 	=> "i_type",

	"dependency" 	=> array(

						"element" 	=> "add_icon",

						"value" 	=> "true",

					),

	"description" 	=> esc_html__( "Select icon library.", "gosolar" ),

) );



vc_add_param( 'vc_tta_section', array(

	"type" 			=> 'iconpicker',

	"heading" 		=> esc_html__( "Icon", "gosolar" ),

	"param_name" 	=> "i_icon_lineicons",

	"value" 		=> "",

	"settings" 		=> array(

		"emptyIcon" 	=> true,

		"type" 			=> 'simplelineicons',

		"iconsPerPage" 	=> 4000,

	),

	"dependency" 	=> array(

		"element" 	=> "i_type",

		"value" 	=> "lineicons",

	),

	"description" 	=> esc_html__( "Select icon from library.", "gosolar" ),

) );



vc_add_param( 'vc_tta_section', array(

	"type" 			=> 'iconpicker',

	"heading" 		=> esc_html__( "Icon", "gosolar" ),

	"param_name" 	=> "i_icon_flaticons",

	"value" 		=> "",

	"settings" 		=> array(

		"emptyIcon" 	=> true,

		"type" 			=> 'flaticons',

		"iconsPerPage" 	=> 4000,

	),

	"dependency" 	=> array(

		"element" 	=> "i_type",

		"value" 	=> "flaticons",

	),

	"description" 	=> esc_html__( "Select icon from library.", "gosolar" ),

) );



vc_add_param( 'vc_tta_section', array(

	'type' 			=> 'textfield',

	'heading' 		=> esc_html__( 'Extra class name', 'gosolar' ),

	'param_name' 	=> 'el_class',

	'description' 	=> esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gosolar' )

) );



/* =========================================

*  Button

*  ========================================= */



vc_add_param( 'vc_btn', array(

	"type" 			=> "dropdown",

	'heading' 		=> esc_html__( 'Style', 'gosolar' ),

	'description' 	=> esc_html__( 'Select button display style.', 'gosolar' ),

	'value' 		=> array(

		esc_html__( 'Default', 'gosolar' ) 		=> 'default',

		esc_html__( 'Transparent', 'gosolar' ) 	=> 'transparent',

		esc_html__( 'Modern', 'gosolar' ) 			=> 'modern',

		esc_html__( 'Classic', 'gosolar' ) 		=> 'classic',

		esc_html__( 'Flat', 'gosolar' ) 			=> 'flat',

		esc_html__( 'Outline', 'gosolar' ) 		=> 'outline',

		esc_html__( '3d', 'gosolar' ) 				=> '3d',

		esc_html__( 'Custom', 'gosolar' ) 			=> 'custom',

		esc_html__( 'Outline custom', 'gosolar' ) 	=> 'outline-custom',

	),

	"param_name" 	=> "style",

) );



vc_add_param( 'vc_btn', array(

	'type' 					=> 'dropdown',

	'heading' 				=> esc_html__( 'Color', 'gosolar' ),

	'param_name' 			=> 'color',

	'description' 			=> esc_html__( 'Select button color.', 'gosolar' ),

	// compatible with btn2, need to be converted from btn1

	'param_holder_class' 	=> 'vc_colored-dropdown vc_btn3-colored-dropdown',

	'value' 				=> array(

				// Theme Colors

				esc_html__( 'Theme Color', 'gosolar' ) 		=> 'primary-bg',

				// Btn1 Colors

				esc_html__( 'Classic Grey', 'gosolar' ) 		=> 'default',

				esc_html__( 'Classic Blue', 'gosolar' ) 		=> 'primary',

				esc_html__( 'Classic Turquoise', 'gosolar' ) 	=> 'info',

				esc_html__( 'Classic Green', 'gosolar' ) 		=> 'success',

				esc_html__( 'Classic Orange', 'gosolar' )		=> 'warning',

				esc_html__( 'Classic Red', 'gosolar' ) 		=> 'danger',

				esc_html__( 'Classic Black', 'gosolar' ) 		=> "inverse"

			   // + Btn2 Colors (default color set)

		   ) + vc_get_shared( 'colors-dashed' ),

	'std' 					=> 'primary-bg',

	// must have default color grey

	'dependency' => array(

		'element' => 'style',

		'value_not_equal_to' => array( 'custom', 'outline-custom' )

	),

) );



/* =========================================

*  Call To Action

*  ========================================= */



vc_add_param( 'vc_cta', array(

	'type' 			=> 'dropdown',

	'heading' 		=> esc_html__( 'Style', 'gosolar' ),

	'param_name' 	=> 'style',

	'value' 		=> array(

		esc_html__( 'Default', 'gosolar' ) 	=> 'default',

		esc_html__( 'Classic', 'gosolar' ) 	=> 'classic',

		esc_html__( 'Flat', 'gosolar' ) 		=> 'flat',

		esc_html__( 'Outline', 'gosolar' ) 	=> 'outline',

		esc_html__( '3d', 'gosolar' ) 			=> '3d',

		esc_html__( 'Custom', 'gosolar' ) 		=> 'custom',

	),

	'std' 			=> 'default',

	'description' 	=> esc_html__( 'Select call to action display style.', 'gosolar' ),

) );



vc_add_param( 'vc_cta', array(

	"type" 			=> "dropdown",

	'heading' 		=> esc_html__( 'Style', 'gosolar' ),

	'description' 	=> esc_html__( 'Select button display style.', 'gosolar' ),

	'value' 		=> array(

		esc_html__( 'Default', 'gosolar' ) 		=> 'default',

		esc_html__( 'Transparent', 'gosolar' ) 	=> 'transparent',

		esc_html__( 'Modern', 'gosolar' ) 			=> 'modern',

		esc_html__( 'Classic', 'gosolar' ) 		=> 'classic',

		esc_html__( 'Flat', 'gosolar' ) 			=> 'flat',

		esc_html__( 'Outline', 'gosolar' ) 		=> 'outline',

		esc_html__( '3d', 'gosolar' ) 				=> '3d',

		esc_html__( 'Custom', 'gosolar' ) 			=> 'custom',

		esc_html__( 'Outline custom', 'gosolar' ) 	=> 'outline-custom',

	),

	'dependency' 			=> array(

		'element' 		=> 'add_button',

		'not_empty' 	=> true,

	),

	"integrated_shortcode" 			=> "vc_btn",

	"integrated_shortcode_field" 	=> "btn_",

	"param_name" 					=> "btn_style",

	"group"							=> esc_html__( 'Button', 'gosolar' ),

) );



vc_add_param( 'vc_cta', array(

	'type' 					=> 'dropdown',

	'heading' 				=> esc_html__( 'Color', 'gosolar' ),

	'param_name' 			=> 'btn_color',

	'description' 			=> esc_html__( 'Select button color.', 'gosolar' ),

	// compatible with btn2, need to be converted from btn1

	'param_holder_class' 	=> 'vc_colored-dropdown vc_btn3-colored-dropdown',

	'value' 				=> array(

				// Theme Colors

				esc_html__( 'Theme Color', 'gosolar' ) 		=> 'primary-bg',

				// Btn1 Colors

				esc_html__( 'Classic Grey', 'gosolar' ) 		=> 'default',

				esc_html__( 'Classic Blue', 'gosolar' ) 		=> 'primary',

				esc_html__( 'Classic Turquoise', 'gosolar' ) 	=> 'info',

				esc_html__( 'Classic Green', 'gosolar' ) 		=> 'success',

				esc_html__( 'Classic Orange', 'gosolar' )		=> 'warning',

				esc_html__( 'Classic Red', 'gosolar' ) 		=> 'danger',

				esc_html__( 'Classic Black', 'gosolar' ) 		=> "inverse"

			   // + Btn2 Colors (default color set)

		   ) + vc_get_shared( 'colors-dashed' ),

	'std' 							=> 'primary-bg',

	"group"							=> esc_html__( 'Button', 'gosolar' ),

	"integrated_shortcode" 			=> "vc_btn",

	"integrated_shortcode_field" 	=> "btn_",

	// must have default color grey

	'dependency' 			=> array(

		'element' 				=> 'btn_style',

		'value_not_equal_to' 	=> array( 'custom', 'outline-custom' )

	),

) );



vc_add_param( 'vc_cta', array(

	"type" 			=> "dropdown",

	'heading' 		=> esc_html__( 'Icon color', 'gosolar' ),

	'description' 	=> esc_html__( 'Select icon color.', 'gosolar' ),

	'value' 		=> array_merge( vc_get_shared( 'colors' ), array( esc_html__( 'Theme Color', 'gosolar' ) => 'primary-bg' ), array( esc_html__( 'Custom color', 'gosolar' ) => 'custom' ) ),

	'dependency' 			=> array(

		'element' 		=> 'add_icon',

		'not_empty' 	=> true,

	),

	"integrated_shortcode" 			=> "vc_icon",

	"integrated_shortcode_field" 	=> "i_",

	"param_name" 					=> "i_color",

	'param_holder_class' 			=> 'vc_colored-dropdown',

	"group"							=> esc_html__( 'Icon', 'gosolar' ),

) );



vc_add_param( 'vc_cta', array(

	"type" 			=> "dropdown",

	'heading' 		=> esc_html__( 'Background color', 'gosolar' ),

	'description' 	=> esc_html__( 'Select background color for icon.', 'gosolar' ),

	'value' 		=> array_merge( vc_get_shared( 'colors' ), array( esc_html__( 'Theme Color', 'gosolar' ) => 'primary-bg' ), array( esc_html__( 'Custom color', 'gosolar' ) => 'custom' ) ),

	'dependency' 		=> array(

		'element' 		=> 'i_background_style',

		'not_empty' 	=> true,

	),

	"integrated_shortcode" 			=> "vc_icon",

	"integrated_shortcode_field" 	=> "i_",

	"param_name" 					=> "i_background_color",

	'param_holder_class' 			=> 'vc_colored-dropdown',

	"group"							=> esc_html__( 'Icon', 'gosolar' ),

) );



/* =========================================

*  Progress Bar

*  ========================================= */



vc_add_param( 'vc_progress_bar', array(

	'type' 			=> 'dropdown',

	'heading' 		=> esc_html__( 'Color', 'gosolar' ),

	'param_name' 	=> 'bgcolor',

	'value' 		=> array(

		esc_html__( 'Default', 'gosolar' ) 	=> 'bar_default',

		esc_html__( 'Default White', 'gosolar' ) 	=> 'bar_default_white',

		esc_html__( 'Grey', 'gosolar' ) 		=> 'bar_grey',

		esc_html__( 'Blue', 'gosolar' ) 		=> 'bar_blue',

		esc_html__( 'Turquoise', 'gosolar' ) 	=> 'bar_turquoise',

		esc_html__( 'Green', 'gosolar' ) 		=> 'bar_green',

		esc_html__( 'Orange', 'gosolar' ) 		=> 'bar_orange',

		esc_html__( 'Red', 'gosolar' ) 		=> 'bar_red',

		esc_html__( 'Black', 'gosolar' ) 		=> 'bar_black',

		esc_html__( 'Custom Color', 'gosolar' ) 	=> 'custom'

	),

	'admin_label' 	=> true,

	'description' 	=> esc_html__( 'Select bar background color.', 'gosolar' ),

) );



vc_add_param( 'vc_progress_bar', array(

	'type' 			=> 'dropdown',

	'heading' 		=> esc_html__( 'Style', 'gosolar' ),

	'param_name' 	=> 'bar_style',

	'value' 		=> array(

		esc_html__( 'Default', 'gosolar' ) 		=> 'default',

		esc_html__( 'Tooltip', 'gosolar' ) 		=> 'tooltip',

	),

	'description' 	=> esc_html__( 'Select bar style.', 'gosolar' ),

) );



vc_add_param( 'vc_progress_bar', array(

	'type' 			=> 'textfield',

	'heading' 		=> esc_html__( 'Bar Height', 'gosolar' ),

	'param_name' 	=> 'bar_height',

	'description' 	=> esc_html__( 'Enter bar height. Ex: 20px', 'gosolar' )

) );



/* =========================================

*  Testimonial Categories

*  ========================================= */

if( GOSOLAR_TESTIMONIAL_ACTIVE ) {



	$testimonial_args = array(

		'orderby'                  => 'name',

		'hide_empty'               => 0,

		'hierarchical'             => 1,

		'taxonomy'                 => 'testimonial_categories'

	);

	

	$testimonial_lists = get_categories( $testimonial_args );

	$testimonials_cats = array( 'Show all categories' => 'all' );

	

	foreach( $testimonial_lists as $cat ){

		$testimonials_cats[$cat->name] = $cat->slug;

	}

	

	vc_add_param( 'zozo_vc_testimonials_slider', array(

		'type'			=> 'dropdown',

		'admin_label' 	=> true,

		'heading'		=> esc_html__( 'Choose Testimonial Categories', 'gosolar' ),

		'param_name'	=> 'categories_id',

		'value' 		=> $testimonials_cats		

	) );

	

	vc_add_param( 'zozo_vc_testimonials_grid', array(

		'type'			=> 'dropdown',

		'admin_label' 	=> true,

		'heading'		=> esc_html__( 'Choose Testimonial Categories', 'gosolar' ),

		'param_name'	=> 'categories_id',

		'value' 		=> $testimonials_cats		

	) );

	

}



/* =========================================

*  Team Categories

*  ========================================= */

if( GOSOLAR_TEAM_ACTIVE ) {



	$team_args = array(

		'orderby'                  => 'name',

		'hide_empty'               => 0,

		'hierarchical'             => 1,

		'taxonomy'                 => 'team_categories'

	);

	

	$team_lists = get_categories( $team_args );

	$team_cats = array( 'Show all categories' => 'all' );

	

	foreach( $team_lists as $cat ){

		$team_cats[$cat->name] = $cat->slug;

	}

	

	vc_add_param( 'zozo_vc_team_grid', array(

		'type'			=> 'dropdown',

		'admin_label' 	=> true,

		'heading'		=> esc_html__( 'Choose Team Categories', 'gosolar' ),

		'param_name'	=> 'categories_id',

		'value' 		=> $team_cats		

	) );

	

	vc_add_param( 'zozo_vc_team_slider', array(

		'type'			=> 'dropdown',

		'admin_label' 	=> true,

		'heading'		=> esc_html__( 'Choose Team Categories', 'gosolar' ),

		'param_name'	=> 'categories_id',

		'value' 		=> $team_cats		

	) );

	

	vc_add_param( 'zozo_vc_team_list', array(

		'type'			=> 'dropdown',

		'admin_label' 	=> true,

		'heading'		=> esc_html__( 'Choose Team Categories', 'gosolar' ),

		'param_name'	=> 'categories_id',

		'value' 		=> $team_cats		

	) );

	

}

/* =========================================

*  Woocommerce Product Categories

*  ========================================= */

if( GOSOLAR_WOOCOMMERCE_ACTIVE ) {



	$woo_args = array(

		'orderby'                  => 'name',

		'hide_empty'               => 0,

		'hierarchical'             => 1,

		'taxonomy'                 => 'product_cat'

	);

	

	$woo_lists = get_categories( $woo_args );

	$woo_cats = array( 'Show all categories' => 'all' );

	

	foreach( $woo_lists as $cat ){

		$woo_cats[$cat->name] = $cat->slug;

	}

	

	vc_add_param( 'zozo_vc_woo_product_slider', array(

		'type'			=> 'dropdown',

		'admin_label' 	=> true,

		'heading'		=> esc_html__( 'Choose Product Categories', 'gosolar' ),

		'param_name'	=> 'categories_id',

		'value' 		=> $woo_cats		

	) );

	

}
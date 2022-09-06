<?php

/**

 * Visual Composer Functions

 *

 * @package     GoSolar

 * @subpackage  Includes/Visual Composer

 * @author      Zozothemes

 */



// Retun if the Visual Composer plugin isn't active

if ( ! GOSOLAR_VC_ACTIVE ) {

    return;

}



/**

 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page

 */

if( function_exists('vc_set_as_theme') ){

	function gosolar_vcSetAsTheme() {

		vc_set_as_theme( $disable_updater = true );

	}

	add_action( 'vc_before_init', 'gosolar_vcSetAsTheme' );

}



// Admin Init

add_action( 'init', 'gosolar_vc_extend_params_init', 10 );



function gosolar_vc_extend_params_init() {



	// Add Params

	if ( function_exists( 'vc_add_param' ) ) {

		get_template_part( 'includes/visual-composer/vc', 'params' );

	}

	

}



// Admin Visual Composer New Shortcode Params

add_action( 'init', 'gosolar_vc_new_params_init' );



function gosolar_vc_new_params_init() {

	$function = 'vc_add_' . 'shortcode_param';

	// Generate param type "number"

	$function( 'number', 'gosolar_number_settings_field' );

}



// Function generate param type "number"

function gosolar_number_settings_field( $settings, $value ) {

	$dependency = '';

	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';

	$type 		= isset($settings['type']) ? $settings['type'] : '';

	$min 		= isset($settings['min']) ? $settings['min'] : '';

	$max 		= isset($settings['max']) ? $settings['max'] : '';

	$suffix 	= isset($settings['suffix']) ? $settings['suffix'] : '';

	$class 		= isset($settings['class']) ? $settings['class'] : '';

	

	$output = '<input type="number" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" />'.$suffix;

	return $output;

}



add_action( 'vc_after_init', 'gosolar_add_new_color_options' );



function gosolar_add_new_color_options() {

  //Get current values stored in the param

  $param = WPBMap::getParam( 'vc_masonry_grid', 'button_color' );

  //Append new value to the 'value' array

 // $param['value'][esc_html__( 'Theme Color', 'gosolar' )] = 'primary-bg';

  //Finally "mutate" param with new values

  vc_update_shortcode_param( 'vc_masonry_grid', $param );

}



// Get VC CSS Animation

function gosolar_vc_animation( $css_animation ) {

	$output = '';

	if ( '' !== $css_animation ) {

		wp_enqueue_script( 'vc_waypoints' );

		$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation;

	}



	return $output;

}



// Include all custom shortcodes for VC

get_template_part( 'includes/visual-composer/vc', 'init' );



/**

 * Simple Line Icons

 *

 * @param $icons - taken from filter 

 * 

 * @return array - of icons for iconpicker, can be categorized, or not.

 */

if( ! function_exists('gosolar_vc_custom_simplelineicons') ) {

	function gosolar_vc_custom_simplelineicons( $icons ) {

	

		$pattern = '/\.(icon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';

		$simpleline_icons_path = GOSOLAR_ADMIN_URL . '/css/simple-line-icons.css';

		

		$response = wp_remote_get( $simpleline_icons_path );

		if( is_array($response) ) {

			$subject = $response['body']; // use the content

		}

				

		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

		

		$all_line_icons = array();

		$all_new_line_icons = array();

		

		foreach($matches as $match){

			$all_line_icons['simple-icon ' . $match[1]] = $match[1];

		}

		

		foreach($all_line_icons as $key => $value ){

			$all_new_line_icons[] = array( $key => $value );

		}

	

		return array_merge( $icons, $all_new_line_icons );

		

	}

}



add_filter( 'vc_iconpicker-type-simplelineicons', 'gosolar_vc_custom_simplelineicons', 10, 1 );



/**

 * Flaticons

 *

 * @param $icons - taken from filter 

 * 

 * @return array - of icons for iconpicker, can be categorized, or not.

 */

if( ! function_exists('gosolar_vc_custom_flaticons') ) {

	function gosolar_vc_custom_flaticons( $icons ) {

	

		$pattern = '/\.(flaticon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';

		$flaticons_path = GOSOLAR_ADMIN_URL . '/css/flaticon.css';

		

		$response = wp_remote_get( $flaticons_path );

		if( is_array($response) ) {

			$subject = $response['body']; // use the content

		}

		

		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

		

		$all_flat_icons = array();

		$all_new_flat_icons = array();

		

		foreach($matches as $match){

			$all_flat_icons['flaticon ' . $match[1]] = $match[1];

		}

		

		foreach($all_flat_icons as $key => $value ){

			$all_new_flat_icons[] = array( $key => $value );

		}

	

		return array_merge( $icons, $all_new_flat_icons );

	}

}



add_filter( 'vc_iconpicker-type-flaticons', 'gosolar_vc_custom_flaticons', 10, 1 );



/**

 * Image hover Styles

 */

if ( ! function_exists( 'gosolar_vc_image_hovers' ) ) {

	function gosolar_vc_image_hovers() {

		$hovers = array (

			esc_html__( 'None', 'gosolar' )				=> '',

			esc_html__( 'Fade Out', 'gosolar' )			=> 'fade-out',

			esc_html__( 'Fade In', 'gosolar' )				=> 'fade-in',

			esc_html__( 'Grow', 'gosolar' )				=> 'grow',

			esc_html__( 'Grow & Rotate', 'gosolar' )		=> 'grow-rotate',

			esc_html__( 'Sepia', 'gosolar' )				=> 'sepia',

			esc_html__( 'Normal - Blurr', 'gosolar' )		=> 'blurr',

			esc_html__( 'Blurr - Normal', 'gosolar' )		=> 'blurr-invert',

			

		);

		return apply_filters( 'gosolar_vc_image_hovers', $hovers );

	}

}



/**

 * Image filter Styles

 */

if ( ! function_exists( 'gosolar_vc_image_filters' ) ) {

	function gosolar_vc_image_filters() {

		$filters = array (

			esc_html__( 'None', 'gosolar' )		=> '',

			esc_html__( 'Grayscale', 'gosolar' )	=> 'grayscale',

		);

		return apply_filters( 'gosolar_vc_image_filters', $filters );

	}

}
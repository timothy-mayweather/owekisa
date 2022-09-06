<?php

/* ======================================

 * Functions

 *

 *	gosolar_get_post_id()

 *	gosolar_header_slider_position()

 *	gosolar_featured_post_slider_position()

 *	gosolar_unregister_post_type()

 * ====================================== */

 

/* ======================================

 * Get queried post ID

 * ====================================== */

 

if ( ! function_exists( 'gosolar_get_post_id' ) ) {

	function gosolar_get_post_id() {

		

		$object_id = get_queried_object_id();

	

		if( ( get_option('show_on_front') && get_option('page_for_posts') && is_home() ) || ( get_option('page_for_posts') && is_archive() && ! is_post_type_archive() ) && ! is_tax('service_categories') && ! is_tax('testimonial_categories' ) && ! is_tax('team_categories' ) || ( get_option('page_for_posts') && is_search() ) ) {

			$post_id = get_option('page_for_posts');		

		} else {

			if( isset( $object_id ) ) {

				$post_id = $object_id;

			}



			if( ! is_singular() ) {

				$post_id = false; 

			}

		}

		

		return $post_id;

		

	}

}



/* =======================================================

 * Change slider action priority based on slider position

 * ======================================================= */

 

if ( ! function_exists( 'gosolar_header_slider_position' ) ) {

	function gosolar_header_slider_position() {

		

		$post_id = gosolar_get_post_id();

		

		$slider_position = '';

		$slider_position = get_post_meta( $post_id, 'zozo_slider_position', true );

		if( isset( $slider_position ) && $slider_position == '' || $slider_position == 'default' ) {

			$slider_position = gosolar_get_theme_option( 'zozo_slider_position' );

		}

		

		if( ! $slider_position ) {

			$slider_position = "below";

		}

		

		if( $slider_position == "above" ) {

			add_action( 'gosolar_header_wrapper_start', 'gosolar_page_slider_wrapper', 10 );

		} else {

			add_action( 'gosolar_header_wrapper_start', 'gosolar_page_slider_wrapper', 40 );

		}

		

	}

} 

add_action( 'wp_head', 'gosolar_header_slider_position' );



/* ============================================================

 * Change featured post slider action based on slider position

 * ============================================================ */

 

if ( ! function_exists( 'gosolar_featured_post_slider_position' ) ) {

	function gosolar_featured_post_slider_position() {

		if( gosolar_get_theme_option( 'zozo_featured_slider_type' ) == 'below_header' ) {

			add_action( 'gosolar_header_wrapper_start', 'gosolar_featured_post_slider', 50 );

		}

		elseif( gosolar_get_theme_option( 'zozo_featured_slider_type' ) == 'above_footer' ) {

			add_action( 'gosolar_header_wrapper_end', 'gosolar_featured_post_slider', 5 );

		}

	}

} 

add_action( 'wp_head', 'gosolar_featured_post_slider_position' );



/* =======================================================

 * Unregister Custom Post Types

 * ======================================================= */

 

function gosolar_unregister_post_type( $post_type, $slug = '' ) {

	global $wp_post_types;

	

	$cpt_disable = '';

	$cpt_disable = gosolar_get_theme_option( 'cpt_disable' );

	

	if( isset( $cpt_disable ) ) {

		if( ! empty( $cpt_disable ) ) {

			foreach( $cpt_disable as $post_type => $cpt ) {

				if( $cpt == 1 && isset( $wp_post_types[ $post_type ] ) ) {

					unset( $wp_post_types[ $post_type ] );

				}

			}

		}

	}

}

add_action( 'init', 'gosolar_unregister_post_type', 20 );
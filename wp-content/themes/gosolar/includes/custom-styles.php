<?php 

/* ======================================

 * Add theme custom styles 

 * ====================================== */



global $post;



$post_id = '';

$post_id = gosolar_get_post_id();



// Custom CSS

if( gosolar_get_theme_option( 'zozo_custom_css' ) != '' ) {

	echo gosolar_get_theme_option( 'zozo_custom_css' );

}



// Body Background Stylings 

$body_bg_image = $body_bg_image_repeat = $body_bg_color = $body_bg_attachment = $body_bg_position = $body_bg_opacity = $body_bg_cover = '';

$body_bg_image 			= get_post_meta( $post_id, 'zozo_body_bg_image', true );

$body_bg_image_repeat 	= get_post_meta( $post_id, 'zozo_body_bg_repeat', true );

$body_bg_color 			= get_post_meta( $post_id, 'zozo_body_bg_color', true );

$body_bg_attachment 	= get_post_meta( $post_id, 'zozo_body_bg_attachment', true );

$body_bg_position 		= get_post_meta( $post_id, 'zozo_body_bg_position', true );

$body_bg_opacity 		= get_post_meta( $post_id, 'zozo_body_bg_opacity', true );

$body_bg_cover 			= get_post_meta( $post_id, 'zozo_body_bg_full', true );

if( $body_bg_cover ) {

	$body_bg_cover = "cover";

}



$theme_body_img = $theme_body_color = $theme_body_position = $theme_body_size = $theme_body_repeat = $theme_body_attachment = '';

$body_bg_img_opt = gosolar_get_theme_option( 'zozo_body_bg_image' );



if( isset( $body_bg_img_opt ) ) {

	if( isset( $body_bg_img_opt['background-image'] ) && $body_bg_img_opt['background-image'] != '' ) {

		$theme_body_img = $body_bg_img_opt['background-image'];

	}	

	if( isset( $body_bg_img_opt['background-position'] ) && $body_bg_img_opt['background-position'] != '' ) {

		$theme_body_position = $body_bg_img_opt['background-position'];

	}

	if( isset( $body_bg_img_opt['background-size'] ) && $body_bg_img_opt['background-size'] != '' ) {

		$theme_body_size = $body_bg_img_opt['background-size'];

	}

	if( isset( $body_bg_img_opt['background-repeat'] ) && $body_bg_img_opt['background-repeat'] != '' ) {

		$theme_body_repeat = $body_bg_img_opt['background-repeat'];

	}

	if( isset( $body_bg_img_opt['background-attachment'] ) && $body_bg_img_opt['background-attachment'] != '' ) {

		$theme_body_attachment = $body_bg_img_opt['background-attachment'];

	}

}

if( isset( $body_bg_img_opt['background-color'] ) && $body_bg_img_opt['background-color'] != '' ) {

	$theme_body_color = $body_bg_img_opt['background-color'];

}



$body_bg_image 			= ! empty( $body_bg_image ) ? $body_bg_image : $theme_body_img;

$body_bg_color 			= ! empty( $body_bg_color ) ? $body_bg_color : $theme_body_color;

$body_bg_image_repeat 	= ! empty( $body_bg_image_repeat ) ? $body_bg_image_repeat : $theme_body_repeat;

$body_bg_attachment 	= ! empty( $body_bg_attachment ) ? $body_bg_attachment : $theme_body_attachment;

$body_bg_position 		= ! empty( $body_bg_position ) ? $body_bg_position : $theme_body_position;

$body_bg_cover 			= ! empty( $body_bg_cover ) ? $body_bg_cover : $theme_body_size;



if( isset( $body_bg_opacity ) && $body_bg_opacity != 0 ) {

	$body_rgb_color = '';

	$body_rgb_color = gosolar_hex2rgb( $body_bg_color );

}



$body_styles = '';



if( isset( $body_bg_image ) && $body_bg_image != '' ) {

	$body_styles .= 'background-image: url('. $body_bg_image .');';

	if( isset( $body_bg_image_repeat ) && $body_bg_image_repeat != '' ) {

		$body_styles .= 'background-repeat: '. $body_bg_image_repeat .';';

	}

	if( isset( $body_bg_attachment ) && $body_bg_attachment != '' ) {

		$body_styles .= 'background-attachment: '. $body_bg_attachment .';';

	}

	if( isset( $body_bg_position ) && $body_bg_position != '' ) {

		$body_styles .= 'background-position: '. $body_bg_position .';';

	}

	if( isset( $body_bg_cover ) && $body_bg_cover != '' ) {

		$body_styles .= 'background-size: '. $body_bg_cover .';';

		$body_styles .= '-moz-background-size: '. $body_bg_cover .';';

		$body_styles .= '-webkit-background-size: '. $body_bg_cover .';';

		$body_styles .= '-o-background-size: '. $body_bg_cover .';';

		$body_styles .= '-ms-background-size: '. $body_bg_cover .';';

	}

}

if( isset( $body_bg_color ) && $body_bg_color != '' ) {

	if( isset( $body_bg_opacity ) && $body_bg_opacity != 0 ) {

		$body_styles .= 'background-color: rgba(' . $body_rgb_color[0] . ',' . $body_rgb_color[1] . ',' . $body_rgb_color[2] . ', ' . $body_bg_opacity . ');';

	} else {

		$body_styles .= 'background-color: '. $body_bg_color .';';

	}

}



if( $body_styles ) {

	echo 'body { '. $body_styles . ' }' . "\n";

}



// Header Stylings

$header_styles = '';



$header_bg_image = $header_bg_image_repeat = $header_bg_color = $header_bg_attachment = $header_bg_position = $header_bg_opacity = $header_bg_cover = '';

$header_bg_image 		= get_post_meta( $post_id, 'zozo_header_bg_image', true );

$header_bg_image_repeat = get_post_meta( $post_id, 'zozo_header_bg_repeat', true );

$header_bg_color 		= get_post_meta( $post_id, 'zozo_header_bg_color', true );

$header_bg_attachment 	= get_post_meta( $post_id, 'zozo_header_bg_attachment', true );

$header_bg_position 	= get_post_meta( $post_id, 'zozo_header_bg_postion', true );

$header_bg_opacity 		= get_post_meta( $post_id, 'zozo_header_bg_opacity', true );

$header_bg_cover 		= get_post_meta( $post_id, 'zozo_body_bg_full', true );

if( $header_bg_cover ) {

	$header_bg_cover = "cover";

}



$theme_header_bg_image = $theme_header_bg_image_repeat = $theme_header_bg_color = $theme_header_bg_attachment = $theme_header_bg_position = $theme_header_bg_cover = '';

$header_bg_img_opt = gosolar_get_theme_option( 'zozo_header_bg_image' );



if( isset( $header_bg_img_opt ) ) {

	if( isset( $header_bg_img_opt['background-image'] ) && $header_bg_img_opt['background-image'] != '' ) {

		$theme_header_bg_image = $header_bg_img_opt['background-image'];

	}

	if( isset( $header_bg_img_opt['background-repeat'] ) && $header_bg_img_opt['background-repeat'] != '' ) {

		$theme_header_bg_image_repeat = $header_bg_img_opt['background-repeat'];

	}

	if( isset( $header_bg_img_opt['background-attachment'] ) && $header_bg_img_opt['background-attachment'] != '' ) {

		$theme_header_bg_attachment = $header_bg_img_opt['background-attachment'];

	}

	if( isset( $header_bg_img_opt['background-position'] ) && $header_bg_img_opt['background-position'] != '' ) {

		$theme_header_bg_position = $header_bg_img_opt['background-position'];

	}

	if( isset( $header_bg_img_opt['background-size'] ) && $header_bg_img_opt['background-size'] != '' ) {

		$theme_header_bg_cover = $header_bg_img_opt['background-size'];

	}

}

if( isset( $header_bg_img_opt['background-color'] ) && $header_bg_img_opt['background-color'] != '' ) {

	$theme_header_bg_color = $header_bg_img_opt['background-color'];

}

$header_bg_image = ! empty( $header_bg_image ) ? $header_bg_image : $theme_header_bg_image;

$header_bg_color = ! empty( $header_bg_color ) ? $header_bg_color : $theme_header_bg_color;

$header_bg_image_repeat = ! empty( $header_bg_image_repeat ) ? $header_bg_image_repeat : $theme_header_bg_image_repeat;

$header_bg_attachment = ! empty( $header_bg_attachment ) ? $header_bg_attachment : $theme_header_bg_attachment;

$header_bg_position = ! empty( $header_bg_position ) ? $header_bg_position : $theme_header_bg_position;

$header_bg_cover = ! empty( $header_bg_cover ) ? $header_bg_cover : $theme_header_bg_cover;



if( isset( $header_bg_opacity ) && $header_bg_opacity != 0 ) {

	$header_rgb_color = '';

	$header_rgb_color = gosolar_hex2rgb( $header_bg_color );

}



if( isset( $header_bg_image ) && $header_bg_image != '' ) {

	$header_styles .= 'background-image: url('. $header_bg_image .');';

	if( isset( $header_bg_image_repeat ) && $header_bg_image_repeat != '' ) {

		$header_styles .= 'background-repeat: '. $header_bg_image_repeat .';';

	}

	if( isset( $header_bg_attachment ) && $header_bg_attachment != '' ) {

		$header_styles .= 'background-attachment: '. $header_bg_attachment .';';

	}

	if( isset( $header_bg_position ) && $header_bg_position != '' ) {

		$header_styles .= 'background-position: '. $header_bg_position .';';

	}

	if( isset( $header_bg_cover ) && $header_bg_cover != '' ) {

		$header_styles .= 'background-size: '. $header_bg_cover .';';

		$header_styles .= '-moz-background-size: '. $header_bg_cover .';';

		$header_styles .= '-webkit-background-size: '. $header_bg_cover .';';

		$header_styles .= '-o-background-size: '. $header_bg_cover .';';

		$header_styles .= '-ms-background-size: '. $header_bg_cover .';';

	}

}

if( isset( $header_bg_color ) && $header_bg_color != '' ) {

	if( isset( $header_bg_opacity ) && $header_bg_opacity != 0 ) {

		$header_styles .= 'background-color: rgba(' . $header_rgb_color[0] . ',' . $header_rgb_color[1] . ',' . $header_rgb_color[2] . ', ' . $header_bg_opacity . ');';

	} else {

		$header_styles .= 'background-color: '. $header_bg_color .';';

	}

}

if( $header_styles ) {

	echo '#header.header-no-transparent, .header-section.header-menu-skin-light .header-main-section,.header-section.header-menu-skin-dark .header-main-section,.header-section.header-transparent.header-menu-skin-light .header-main-section,.header-section.header-transparent.header-menu-skin-dark .header-main-section { '. $header_styles . ' }' . "\n";

}



// Page Background Stylings

$page_bg_styles = '';



$page_bg_image = $page_bg_image_repeat = $page_bg_color = $page_bg_attachment = $page_bg_position = $page_bg_opacity = $page_bg_cover = '';

$page_bg_image 			= get_post_meta( $post_id, 'zozo_page_bg_image', true );

$page_bg_image_repeat 	= get_post_meta( $post_id, 'zozo_page_bg_repeat', true );

$page_bg_color 			= get_post_meta( $post_id, 'zozo_page_bg_color', true );

$page_bg_attachment 	= get_post_meta( $post_id, 'zozo_page_bg_attachment', true );

$page_bg_position 		= get_post_meta( $post_id, 'zozo_page_bg_position', true );

$page_bg_opacity 		= get_post_meta( $post_id, 'zozo_page_bg_opacity', true );

$page_bg_cover 			= get_post_meta( $post_id, 'zozo_page_bg_full', true );

if( $page_bg_cover ) {

	$page_bg_cover = "cover";

}



$theme_page_bg_image = $theme_page_bg_image_repeat = $theme_page_bg_color = $theme_page_bg_attachment = $theme_page_bg_position = $theme_page_bg_cover = '';

$page_bg_img_opt = gosolar_get_theme_option( 'zozo_page_bg_image' );



if( isset( $page_bg_img_opt ) ) {

	if( isset( $page_bg_img_opt['background-image'] ) && $page_bg_img_opt['background-image'] != '' ) {

		$theme_page_bg_image = $page_bg_img_opt['background-image'];

	}

	if( isset( $page_bg_img_opt['background-repeat'] ) && $page_bg_img_opt['background-repeat'] != '' ) {

		$theme_page_bg_image_repeat = $page_bg_img_opt['background-repeat'];

	}

	if( isset( $page_bg_img_opt['background-attachment'] ) && $page_bg_img_opt['background-attachment'] != '' ) {

		$theme_page_bg_attachment = $page_bg_img_opt['background-attachment'];

	}

	if( isset( $page_bg_img_opt['background-position'] ) && $page_bg_img_opt['background-position'] != '' ) {

		$theme_page_bg_position = $page_bg_img_opt['background-position'];

	}

	if( isset( $page_bg_img_opt['background-size'] ) && $page_bg_img_opt['background-size'] != '' ) {

		$theme_page_bg_cover = $page_bg_img_opt['background-size'];

	}

}

if( isset( $page_bg_img_opt['background-color'] ) && $page_bg_img_opt['background-color'] != '' ) {

	$theme_page_bg_color = $page_bg_img_opt['background-color'];

}

$page_bg_image = ! empty( $page_bg_image ) ? $page_bg_image : $theme_page_bg_image;

$page_bg_color = ! empty( $page_bg_color ) ? $page_bg_color : $theme_page_bg_color;

$page_bg_image_repeat = ! empty( $page_bg_image_repeat ) ? $page_bg_image_repeat : $theme_page_bg_image_repeat;

$page_bg_attachment = ! empty( $page_bg_attachment ) ? $page_bg_attachment : $theme_page_bg_attachment;

$page_bg_position = ! empty( $page_bg_position ) ? $page_bg_position : $theme_page_bg_position;

$page_bg_cover = ! empty( $page_bg_cover ) ? $page_bg_cover : $theme_page_bg_cover;



if( isset( $page_bg_opacity ) && $page_bg_opacity != 0 ) {

	$page_rgb_color = '';

	$page_rgb_color = gosolar_hex2rgb( $page_bg_color );

}



if( isset( $page_bg_image ) && $page_bg_image != '' ) {

	$page_bg_styles .= 'background-image: url('. $page_bg_image .');';

	if( isset( $page_bg_image_repeat ) && $page_bg_image_repeat != '' ) {

		$page_bg_styles .= 'background-repeat: '. $page_bg_image_repeat .';';

	}

	if( isset( $page_bg_attachment ) && $page_bg_attachment != '' ) {

		$page_bg_styles .= 'background-attachment: '. $page_bg_attachment .';';

	}

	if( isset( $page_bg_position ) && $page_bg_position != '' ) {

		$page_bg_styles .= 'background-position: '. $page_bg_position .';';

	}

	if( isset( $page_bg_cover ) && $page_bg_cover != '' ) {

		$page_bg_styles .= 'background-size: '. $page_bg_cover .';';

		$page_bg_styles .= '-moz-background-size: '. $page_bg_cover .';';

		$page_bg_styles .= '-webkit-background-size: '. $page_bg_cover .';';

		$page_bg_styles .= '-o-background-size: '. $page_bg_cover .';';

		$page_bg_styles .= '-ms-background-size: '. $page_bg_cover .';';

	}

}



if( isset( $page_bg_color ) && $page_bg_color != '' ) {

	if( isset( $page_bg_opacity ) && $page_bg_opacity != 0 ) {

		$page_bg_styles .= 'background-color: rgba(' . $page_rgb_color[0] . ',' . $page_rgb_color[1] . ',' . $page_rgb_color[2] . ', ' . $page_bg_opacity . ');';

	} else {

		$page_bg_styles .= 'background-color: '. $page_bg_color .';';

	}

}



if( $page_bg_styles ) {

	echo '#main { '. $page_bg_styles .' }' . "\n";

}



// Page Title Bar Styles

$page_title_border = $page_title_bg = $page_title_bg_color = $page_title_bar_bg_position = $page_title_bar_bg_repeat = $page_title_bg_full = $page_title_bg_parallax = $page_title_height = $page_title_mobile_height = '';

$page_title_styles = $page_title_outer_styles = '';



$page_title_border 				= get_post_meta( $post_id, 'zozo_page_title_bar_border_color', true );

if( $page_title_border == ''  ) {

	$page_title_border = gosolar_get_theme_option( 'zozo_page_title_border_color' );	

}

$page_title_bg 					= get_post_meta( $post_id, 'zozo_page_title_bar_bg', true );

if( $page_title_bg == ''  ) {

	$page_title_array_bg = gosolar_get_theme_option( 'zozo_page_title_background_image' );	

	$page_title_bg = isset( $page_title_array_bg['url'] ) && $page_title_array_bg['url'] != '' ? esc_url( $page_title_array_bg['url'] ) : '';

}



$page_title_bg_color 			= get_post_meta( $post_id, 'zozo_page_title_bar_bg_color', true );

if( $page_title_bg_color == ''  ) {

	$page_title_bg_color = gosolar_get_theme_option( 'zozo_page_title_background_color' );	

}

$page_title_bar_bg_position 	= get_post_meta( $post_id, 'zozo_page_title_bar_bg_position', true );

if( isset( $page_title_bar_bg_position ) && $page_title_bar_bg_position == '' || $page_title_bar_bg_position == 'default' ) {

	$page_title_bar_bg_position = gosolar_get_theme_option( 'zozo_page_title_background_position' );	

}



$page_title_bg_full 			= get_post_meta( $post_id, 'zozo_page_title_bar_bg_full', true );

if( !$page_title_bg_full  ) {

	$page_title_bg_full = gosolar_get_theme_option( 'zozo_page_title_scale_bg_image' );	

}



$page_title_bar_bg_repeat 		= get_post_meta( $post_id, 'zozo_page_title_bar_bg_repeat', true );

if( isset( $page_title_bar_bg_repeat ) && $page_title_bar_bg_repeat == '' || $page_title_bar_bg_repeat == 'default' ) {

	$page_title_bar_bg_repeat = gosolar_get_theme_option( 'zozo_page_title_background_image_repeat' );	

}

$page_title_bg_parallax 		= get_post_meta( $post_id, 'zozo_page_title_bar_bg_parallax', true );

if( isset( $page_title_bg_parallax ) && $page_title_bg_parallax == '' || $page_title_bg_parallax == 'default' ) {

	$page_title_bg_parallax = gosolar_get_theme_option( 'zozo_page_title_parallax_bg_image' );

	if( $page_title_bg_parallax ) {

		$page_title_bg_parallax = 'no';

	} else {

		$page_title_bg_parallax = 'yes';

	}

}



$page_title_height 				= get_post_meta( $post_id, 'zozo_page_title_height', true );

if( $page_title_height == ''  ) {

	$page_title_height = gosolar_get_theme_option( 'zozo_page_title_bar_height' );	

}

$page_title_mobile_height 		= get_post_meta( $post_id, 'zozo_page_title_mobile_height', true );

if( $page_title_mobile_height == ''  ) {

	$page_title_mobile_height = gosolar_get_theme_option( 'zozo_page_title_bar_mobile_height' );	

}

$page_title_color 				= get_post_meta( $post_id, 'zozo_page_title_bar_title_color', true );

if( $page_title_color == ''  ) {

	$page_title_color = gosolar_get_theme_option( 'zozo_page_title_color' );	

}

$page_slogan_color 				= get_post_meta( $post_id, 'zozo_page_title_bar_slogan_color', true );

$page_breadcrumbs_color 		= get_post_meta( $post_id, 'zozo_page_breadcrumbs_color', true );

if( $page_breadcrumbs_color == ''  ) {

	$page_breadcrumbs_color = gosolar_get_theme_option( 'zozo_page_title_breadcrumbs_color' );	

}



$parallax_styles = '';



if( isset( $page_title_bg ) && $page_title_bg != '' ) {



	if( isset( $page_title_bg_parallax ) && $page_title_bg_parallax == 'no' ) {

		$page_title_styles .= 'background-image: url('. $page_title_bg .');';

	}

	

	if( isset( $page_title_bar_bg_repeat ) && $page_title_bar_bg_repeat != '' ) {

		if( isset( $page_title_bg_parallax ) && $page_title_bg_parallax == 'yes' ) {

			$parallax_styles .= 'background-repeat: '. $page_title_bar_bg_repeat .';';

		} else {

			$page_title_styles .= 'background-repeat: '. $page_title_bar_bg_repeat .';';

		}

	}

	

	if( isset( $page_title_bar_bg_position ) && $page_title_bar_bg_position != '' ) {

		if( isset( $page_title_bg_parallax ) && $page_title_bg_parallax == 'yes' ) {

			$parallax_styles .= 'background-position: '. $page_title_bar_bg_position .';';

		} else {

			$page_title_styles .= 'background-position: '. $page_title_bar_bg_position .';';

		}

	}

	

	if( isset( $page_title_bg_full ) && $page_title_bg_full ) {

		if( isset( $page_title_bg_parallax ) && $page_title_bg_parallax == 'yes' ) {

			$parallax_styles .= 'background-size: cover;';

			$parallax_styles .= '-moz-background-size: cover;';

			$parallax_styles .= '-webkit-background-size: cover;';

			$parallax_styles .= '-o-background-size: cover;';

			$parallax_styles .= '-ms-background-size: cover;';

		} else {

			$page_title_styles .= 'background-size: cover;';

			$page_title_styles .= '-moz-background-size: cover;';

			$page_title_styles .= '-webkit-background-size: cover;';

			$page_title_styles .= '-o-background-size: cover;';

			$page_title_styles .= '-ms-background-size: cover;';

		}

	}

}



if( ( isset( $page_title_bg ) && $page_title_bg == '' ) && ( isset( $page_title_bg_color ) && $page_title_bg_color != '' ) ) {

	$page_title_styles .= 'background: '. $page_title_bg_color .';';

} 

else {

	if( isset( $page_title_bg_color ) && $page_title_bg_color != '' ) {

		$page_title_styles .= 'background-color: '. $page_title_bg_color .';';

	}

}

if( isset( $page_title_border ) && $page_title_border != '' ) {

	$page_title_styles .= 'border-color: '. $page_title_border .';';

}



if( isset( $page_title_styles ) && $page_title_styles != '' ) {

	echo '.page-title-section { '. $page_title_styles . ' }' . "\n";

}



if( isset( $page_title_bg_parallax ) && $page_title_bg_parallax == 'yes' ) {

	if( isset( $parallax_styles ) && $parallax_styles != '' ) {

		echo '.page-title-section.zozo-parallax .zozo_parallax-inner { '. $parallax_styles . ' }' . "\n";

	}

}



if( isset( $page_title_height ) && $page_title_height != '' ) {

	echo '.page-title-section .page-title-container { height: '. $page_title_height . '; }' . "\n";

}



if( isset( $page_title_color ) && $page_title_color != '' ) {

	echo '.page-title-section .page-title-captions h1 { color: '. $page_title_color . '; }' . "\n";

}



if( isset( $page_slogan_color ) && $page_slogan_color != '' ) {

	echo '.page-title-section .page-title-captions .page-entry-slogan { color: '. $page_slogan_color . '; }' . "\n";

}



if( isset( $page_breadcrumbs_color ) && $page_breadcrumbs_color != '' ) {

	echo '.page-title-section .zozo-breadcrumbs > span { color: '. $page_breadcrumbs_color . '; }' . "\n";

}



if( isset( $page_title_mobile_height ) && $page_title_mobile_height != '' ) {

	$page_title_mobile_styles .= 'height: '. $page_title_mobile_height .';';

}



if( isset( $page_title_mobile_styles ) && $page_title_mobile_styles != '' ) {

	echo '@media only screen and (max-width: 767px) { .page-title-section .page-title-container { '. $page_title_mobile_styles . ' } }' . "\n";

}



// Side Header Width

$theme_layout 			= get_post_meta( $post_id, 'zozo_theme_layout', true );

$header_type 			= get_post_meta( $post_id, 'zozo_header_type', true );

$header_vertical_position = get_post_meta( $post_id, 'zozo_header_vertical_position', true );

if( isset( $theme_layout ) && $theme_layout == '' ) {

	$theme_layout = gosolar_get_theme_option( 'zozo_theme_layout' );

}

if( isset( $header_type ) && $header_type == '' || $header_type == 'default' ) {

	$header_type = gosolar_get_theme_option( 'zozo_header_type' );

}

if( isset( $header_vertical_position ) && $header_vertical_position == '' || $header_vertical_position == 'default' ) {

	$header_vertical_position = gosolar_get_theme_option( 'zozo_header_vertical_position' );

}



$header_side_width_opt = gosolar_get_theme_option( 'zozo_header_side_width' );

if( $header_side_width_opt != '' && $header_type == 'header-10' ) {

	echo '@media only screen and (min-width: 768px) {';

	echo '.header-sidenav-section { width: '. $header_side_width_opt . '; }' . "\n";

	

	if( $theme_layout == 'fullwidth' || $theme_layout == 'wide' ) {

		if( isset( $header_vertical_position ) && $header_vertical_position == 'left' ) {

			echo '#zozo_wrapper { margin-left: '. $header_side_width_opt . '; width: auto; }' . "\n";

		}

		

		if( isset( $header_vertical_position ) && $header_vertical_position == 'right' ) {

			echo '#zozo_wrapper { margin-right: '. $header_side_width_opt . '; width: auto; }' . "\n";

		}

	} else if( $theme_layout == 'boxed' ) {

		if( isset( $header_vertical_position ) && $header_vertical_position == 'left' ) {

			echo '#zozo_wrapper .zozo-main-wrapper { margin-left: '. $header_side_width_opt . '; width: auto; }' . "\n";

		}

		

		if( isset( $header_vertical_position ) && $header_vertical_position == 'right' ) {

			echo '#zozo_wrapper .zozo-main-wrapper { margin-right: '. $header_side_width_opt . '; width: auto; }' . "\n";

		}

	}

	echo '}';

}



// Page Content Padding

$page_top_padding = $page_bottom_padding = '';



$page_top_padding 				= get_post_meta( $post_id, 'zozo_page_top_padding', true );

$page_bottom_padding 			= get_post_meta( $post_id, 'zozo_page_bottom_padding', true );



if( ( isset( $page_top_padding ) && $page_top_padding != '' ) || ( isset( $page_bottom_padding ) && $page_bottom_padding != '' ) ) {

	echo '#main-wrapper #content { ';

	

	if( isset( $page_top_padding ) && $page_top_padding != '' ) {

		echo 'padding-top: '. $page_top_padding . ';';

	}

	if( isset( $page_bottom_padding ) && $page_bottom_padding != '' ) {

		echo ' padding-bottom: '. $page_bottom_padding . ';';

	}

	

	echo ' }' . "\n";

}
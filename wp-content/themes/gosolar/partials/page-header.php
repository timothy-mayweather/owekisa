<?php global $post;

$post_id = '';

$post_id = gosolar_get_post_id();



$page_slogan = $breadcrumbs = '';



$hide_title_bar 	= get_post_meta( $post_id, 'zozo_hide_page_title_bar', true );

if( isset( $hide_title_bar ) && $hide_title_bar == '' || $hide_title_bar == 'default' ) {

	$hide_title_bar = gosolar_get_theme_option( 'zozo_enable_page_title_bar' );

	if( $hide_title_bar ) {

		$hide_title_bar = 'no';

	} else {

		$hide_title_bar = 'yes';

	}

}

$hide_title 		= get_post_meta( $post_id, 'zozo_hide_page_title', true );

if( isset( $hide_title ) && $hide_title == '' || $hide_title == 'default' ) {

	$hide_title = gosolar_get_theme_option( 'zozo_enable_page_title' );

	if( $hide_title ) {

		$hide_title = 'no';

	} else {

		$hide_title = 'yes';

	}

}

$breadcrumbs 		= get_post_meta( $post_id, 'zozo_display_breadcrumbs', true );

$show_page_slogan 	= get_post_meta( $post_id, 'zozo_show_page_slogan', true );

$page_slogan 		= get_post_meta( $post_id, 'zozo_page_slogan', true );

$page_title_align 	= get_post_meta( $post_id, 'zozo_page_title_align', true );

if( isset( $page_title_align ) && $page_title_align == '' || $page_title_align == 'default' ) {

	$page_title_align = gosolar_get_theme_option( 'zozo_page_title_alignment_new' );

}





$page_title_type 	= get_post_meta( $post_id, 'zozo_page_title_type', true );

if( isset( $page_title_type ) && $page_title_type == '' || $page_title_type == 'default' ) {

	$page_title_type = gosolar_get_theme_option( 'zozo_page_title_bar_type_new' );	

}



$page_title_skin 	= get_post_meta( $post_id, 'zozo_page_title_skin', true );

if( isset( $page_title_skin ) && $page_title_skin == '' || $page_title_skin == 'default' ) {

	$page_title_skin = gosolar_get_theme_option( 'zozo_page_title_bar_skin_new' );	

}



$page_video_bg 		= get_post_meta( $post_id, 'zozo_page_title_video_bg', true );

if( !$page_video_bg  ) {

	$page_video_bg = gosolar_get_theme_option( 'zozo_page_title_video_bg' );	

}



$page_video_id 		= get_post_meta( $post_id, 'zozo_page_title_video_id', true );

if( $page_video_id == ''  ) {

	$page_video_id = gosolar_get_theme_option( 'zozo_page_title_video_bg_id' );	

}



$page_title_bg 		= get_post_meta( $post_id, 'zozo_page_title_bar_bg', true );

if( $page_title_bg == ''  ) {

	$page_title_array_bg = gosolar_get_theme_option( 'zozo_page_title_background_image' );

	$page_title_bg = isset( $page_title_array_bg['url'] ) && $page_title_array_bg['url'] != '' ? esc_url( $page_title_array_bg['url'] ) : '';

}



$page_bg_parallax   = get_post_meta( $post_id, 'zozo_page_title_bar_bg_parallax', true );

if( isset( $page_bg_parallax ) && $page_bg_parallax == '' || $page_bg_parallax == 'default' ) {

	$page_bg_parallax = gosolar_get_theme_option( 'zozo_page_title_parallax_bg_image' );

	if( $page_bg_parallax ) {

		$page_bg_parallax = 'no';

	} else {

		$page_bg_parallax = 'yes';

	}

}



$page_title_bar_bg_position = get_post_meta( $post_id, 'zozo_page_title_bar_bg_position', true );

if( isset( $page_title_bar_bg_position ) && $page_title_bar_bg_position == '' || $page_title_bar_bg_position == 'default' ) {

	$page_title_bar_bg_position = gosolar_get_theme_option( 'zozo_page_title_background_position' );	

}





if( isset( $breadcrumbs ) && $breadcrumbs == '' || $breadcrumbs == 'default' ) {

	$breadcrumbs = gosolar_get_theme_option( 'zozo_enable_breadcrumbs' );

	if( $breadcrumbs ) {

		$breadcrumbs = 'show';

	} else {

		$breadcrumbs = 'hide';

	}

}



$title = '';

$title = get_the_title( $post_id );



if( is_home() ) {

	$title = gosolar_get_theme_option( 'zozo_blog_title' );

	$page_slogan = gosolar_get_theme_option( 'zozo_blog_slogan' );

}



if( is_search() ) {

	$title = esc_html__( 'Search results for:', 'gosolar' ) . ' ' . get_search_query();

}



if( is_404() ) {

	$title = esc_html__('Error 404 Page', 'gosolar');

}



if( ( class_exists( 'TribeEvents' ) && tribe_is_event() && ! is_single() && ! is_home() ) ||

	( class_exists( 'TribeEvents' ) && gosolar_is_events_archive() ) ||

	( class_exists( 'TribeEvents' ) && gosolar_is_events_archive() && is_404() ) ) { 

	$title = tribe_get_events_title();	

}



if( is_archive() && ! ( class_exists('bbPress') && is_bbpress() ) && ! is_search() ) {

	if ( is_day() ) {

		$title = esc_html__( 'Daily Archives:', 'gosolar' ) . '<span> ' . get_the_date() . '</span>';

	} else if ( is_month() ) {

		$title = esc_html__( 'Monthly Archives:', 'gosolar' ) . '<span> ' . get_the_date( _x( 'F Y', 'monthly archives date format', 'gosolar' ) ) . '</span>';

	} elseif ( is_year() ) {

		$title = esc_html__( 'Yearly Archives:', 'gosolar' ) . '<span> ' . get_the_date( _x( 'Y', 'yearly archives date format', 'gosolar' ) ) . '</span>';

	} elseif ( is_author() ) {

		$current_auth = get_user_by( 'id', get_query_var( 'author' ) );

		$title = $current_auth->nickname;

	} elseif( is_post_type_archive() ) {				

		$title = post_type_archive_title( '', false );

		

		$sermon_settings = get_option('wpfc_options');

		if( is_array( $sermon_settings ) ) {

			$title = $sermon_settings['archive_title'];

		}				

	} else {

		$title = single_cat_title( '', false );

	}

}



if( GOSOLAR_WOOCOMMERCE_ACTIVE && is_woocommerce() && ( is_product() || is_shop() ) && ! is_search() ) {

	if( ! is_product() ) {

		$title = woocommerce_page_title( false );

	}

	

}



if( ! is_archive() && ! is_search() && ! ( is_home() && ! is_front_page() ) ) {

	if ( $hide_title_bar != 'yes' ) {

		if( $hide_title == 'yes' ) {

			$title = '';

		}

	}

}	else {

	if ( $hide_title_bar != 'yes' ) {

		if( $hide_title == 'yes' ) {

			$title = '';

		}				

	}

}

		

$output_title_bar = '';

if( ! is_archive() && ! is_search() && ! ( is_home() && ! is_front_page() ) ) {

	if ( $hide_title_bar != 'yes' ) {

		if( is_home() && is_front_page() && ! gosolar_get_theme_option( 'zozo_blog_page_title_bar' ) ) {

			$output_title_bar = 'no';

		} else {

			$output_title_bar = 'yes';

		}

	}

} else {

	if( is_home() && ! gosolar_get_theme_option( 'zozo_blog_page_title_bar' ) ) {

		$output_title_bar = 'no';

	} else {	

		if( $hide_title_bar != 'yes' ) {

			$output_title_bar = 'yes';

		}

	}

}



$extra_class = '';

if( isset( $page_video_bg ) && $page_video_bg == 1 ) {

	if( isset( $page_video_id ) && $page_video_id != '' ) {

		$extra_class .= ' page-title-video-bg page-video-'. $post_id .'';

	}

}



$extra_class 		.= ' page-titletype-'. $page_title_type .'';

$extra_class 		.= ' page-titleskin-'. $page_title_skin .'';

$extra_class 		.= ' page-titlealign-'. $page_title_align .'';

if( isset( $page_title_bg ) && $page_title_bg != '' ) {

	$extra_class 	.= ' page-title-image-bg';

} 



$wrapper_attributes = array();

if( isset( $page_bg_parallax ) && $page_bg_parallax == 'yes' ) {

	wp_enqueue_script( 'gosolar-zozo-skrollr-js' );

	$wrapper_attributes[] = 'data-zozo-parallax="2"';

	$extra_class .= ' zozo-parallax';

}



if( ! empty( $page_title_bg ) ) {

	$wrapper_attributes[] = 'data-zozo-parallax-image="' . esc_attr( $page_title_bg ) . '"';

} 



if( ! empty( $page_title_bar_bg_position ) ) {

	$wrapper_attributes[] = 'data-zozo-parallax-position="' . esc_attr( $page_title_bar_bg_position ) . '"';

} 



$wrapper_attributes[] = 'class="page-title-section ' . esc_attr( trim( $extra_class ) ) . '"'; ?>



<?php if( isset( $output_title_bar ) && $output_title_bar == 'yes' ) { ?>

<div <?php echo implode( ' ', $wrapper_attributes ); ?>>

	

	<?php if( isset( $page_video_bg ) && $page_video_bg == 1 ) { ?>

		<!-- ===== Video Background -->

		<?php if( isset( $page_video_id ) && $page_video_id != '' ) { ?>			

			<?php wp_enqueue_script( 'jquery-YTPlayer' ); ?>				

			<div id="video-bg-<?php echo esc_attr( $post_id ); ?>" class="video-bg">

				<div id="player-<?php echo esc_attr( $post_id );?>" class="zozo-yt-player bg-video-container" 

				data-property="{<?php echo "videoURL:'https://www.youtube.com/watch?v=".$page_video_id."',autoPlay:true"; ?>,showControls:false,mute:true,containment:'<?php echo '.page-video-'. $post_id .'';?>',loop:true,startAt:0,opacity:1,ratio:'16/9',quality:'hd720'}"></div>

			</div>

		<?php } ?>

	<?php } ?>

	

	<div class="page-title-wrapper clearfix">

		<div class="container">

			<div class="page-title-container">

			<?php if( isset( $breadcrumbs ) && $breadcrumbs == 'show' && !is_front_page() && !is_home() ) {

			if( isset( $page_title_align ) && $page_title_align != 'center' && $page_title_align == 'right' ) { ?>

				<div class="page-title-breadcrumbs">

					<?php gosolar_breadcrumbs(); ?>

				</div>

			<?php }

			} ?>

			<div class="page-title-captions">

				<?php if( isset( $title ) && $title != '' ) { ?>

					<?php echo sprintf( '<h1 class="entry-title">%s</h1>', $title ); ?>

				<?php } ?>

				<?php if( isset( $show_page_slogan ) && $show_page_slogan == 'yes' && $page_slogan != '' ) { ?>

					<h5 class="page-entry-slogan">

						<?php echo do_shortcode( $page_slogan ); ?>

					</h5>

				<?php } ?>

					

				<?php if( isset( $breadcrumbs ) && $breadcrumbs == 'show' && !is_front_page() && !is_home() ) {

				if( isset( $page_title_align ) && $page_title_align == 'center' ) { ?>

					<div class="page-title-breadcrumbs">

						<?php gosolar_breadcrumbs(); ?>

					</div>

				<?php }

				} ?>

			</div>

		

			<?php if( isset( $breadcrumbs ) && $breadcrumbs == 'show' && !is_front_page() && !is_home() ) {

			if( isset( $page_title_align ) && $page_title_align != 'center' && ( $page_title_align == 'left' || $page_title_align == 'default' ) ) { ?>

				<div class="page-title-breadcrumbs">

					<?php gosolar_breadcrumbs(); ?>

				</div>

			<?php }

			} ?>

			</div>

		</div>

	</div>

	

</div>

<?php } ?>

<!-- ============ Page Header Ends ============ -->
<?php
/**
 * Single Portfolio Page
 *
 * @package Zozothemes
 */
get_header();
$media_type = $isotope_type = $portfolio_details = $portfolio_details_layout = $sticky_sidebar = '';
$media_type 				= get_post_meta( $post->ID, 'zozo_portfolio_single_media_display', true );
$isotope_type 				= get_post_meta( $post->ID, 'zozo_portfolio_isotope_type', true );
$portfolio_details			= get_post_meta( $post->ID, 'zozo_portfolio_single_details', true );
$portfolio_details_layout	= get_post_meta( $post->ID, 'zozo_portfolio_details_position', true );
$sticky_sidebar				= get_post_meta( $post->ID, 'zozo_portfolio_sticky_sidebar', true );
// Portfolio Media
$media_gallery_images = $media_images = $audio_type = $audio_sc_id = $audio_sh_url = $video_type = $video_id = '';
if( isset( $media_type ) && ( $media_type == 'stack' || $media_type == 'isotope' ) ) {
	$media_gallery_images 	= get_post_meta( $post->ID, 'zozo_portfolio_media_images', true );
	$media_images 			= explode(',', $media_gallery_images);
}
else if( isset( $media_type ) && $media_type == 'audio' ) {
	$audio_type 	= get_post_meta( $post->ID, 'zozo_portfolio_audio_type', true );
	$audio_sc_id 	= get_post_meta( $post->ID, 'zozo_portfolio_audio_sc_id', true );
	$audio_sh_url 	= get_post_meta( $post->ID, 'zozo_portfolio_audio_sh_url', true );
}
else if( isset( $media_type ) && $media_type == 'video' ) {
	$video_type 	= get_post_meta( $post->ID, 'zozo_portfolio_video_type', true );
	$video_id 		= get_post_meta( $post->ID, 'zozo_portfolio_video_id', true );
}
// Portfolio Details
if( isset( $portfolio_details ) && $portfolio_details == 'yes' ) {
	$portfolio_date = $portfolio_client = $portfolio_share = $portfolio_estimation = $portfolio_duration = $author_rating = $portfolio_custom_text = $portfolio_btn_text = $portfolio_btn_url = $ratings_display = $related_slider = $hide_categories = $hide_tags = $show_title = '';
							
	$portfolio_date 		= get_post_meta( $post->ID, 'zozo_portfolio_date', true );
	$portfolio_client 		= get_post_meta( $post->ID, 'zozo_portfolio_client', true );
	// Estimation
	$portfolio_estimation 	= get_post_meta( $post->ID, 'zozo_portfolio_estimation', true );
	// Duration
	$portfolio_duration 	= get_post_meta( $post->ID, 'zozo_portfolio_duration', true );
	$ratings_display  		= get_post_meta( $post->ID, 'zozo_portfolio_ratings', true );
	if( isset( $ratings_display ) && $ratings_display != 1 ) {
		$author_rating 	 		= get_post_meta( $post->ID, 'zozo_author_rating', true );
	}
	$portfolio_custom_text 	= get_post_meta( $post->ID, 'zozo_portfolio_custom_text', true );
	$portfolio_btn_text 	= get_post_meta( $post->ID, 'zozo_portfolio_button_text', true );
	$portfolio_btn_url 		= get_post_meta( $post->ID, 'zozo_portfolio_button_url', true );
	$portfolio_share 		= get_post_meta( $post->ID, 'zozo_portfolio_share', true ); 
	
	if( isset( $portfolio_btn_text ) && $portfolio_btn_text == '' ) {
		$portfolio_btn_text = esc_html__( 'View Project', 'gosolar' );
	} 
	$related_slider 		= get_post_meta( $post->ID, 'zozo_portfolio_related_slider', true );
	if( isset( $related_slider ) && $related_slider == '' ) {
		$related_slider_opt = gosolar_get_theme_option( 'zozo_portfolio_related_slider' );
		if( $related_slider_opt == 1 ) {
			$related_slider = 0;
		} else {
			$related_slider = 1;
		}
	}
	
	$hide_categories  		= get_post_meta( $post->ID, 'zozo_portfolio_categories_info', true );
	$hide_tags  			= get_post_meta( $post->ID, 'zozo_portfolio_tags_info', true );
	$show_title  			= get_post_meta( $post->ID, 'zozo_portfolio_title_display', true );
	
	$cat_label = $tag_label = $client_label = $date_label = $est_label = $dur_label = '';
	$cat_label 				= gosolar_get_theme_option( 'zozo_portfolio_category_label' );
	$tag_label 				= gosolar_get_theme_option( 'zozo_portfolio_tag_label' );
	$client_label			= gosolar_get_theme_option( 'zozo_portfolio_client_label' );
	$date_label				= gosolar_get_theme_option( 'zozo_portfolio_date_label' );
	$est_label				= gosolar_get_theme_option( 'zozo_portfolio_estimation_label' );
	$dur_label				= gosolar_get_theme_option( 'zozo_portfolio_duration_label' );
} ?>
<div class="container">
	<div id="main-wrapper" class="zozo-row row">
		<div id="single-sidebar-container" class="single-sidebar-container <?php gosolar_content_sidebar_classes(); ?>">
			<div class="zozo-row row">
				<div id="primary" class="content-area <?php gosolar_primary_content_classes(); ?>">
					<div id="content" class="site-content">
						<?php if ( have_posts() ):
							while ( have_posts() ): the_post(); 
						
							// Media Content
							$media_content = '';
							if( isset( $media_type ) && $media_type != 'none' ) {
								
								// Carousel Slider
								if( isset( $media_type ) && $media_type == 'carousel' ) {
									$media_content .= gosolar_portfolio_media_output( $post->ID, 'single', '', $post->ID );
								} 
								// Audio Only
								else if( isset( $media_type ) && $media_type == 'audio' ) {
									if( ( isset( $audio_type ) && $audio_type == 'soundcloud' ) && ( isset( $audio_sc_id ) && $audio_sc_id != '' ) ) {
										$media_content .= do_shortcode( '[zozo_soundcloud url="http://api.soundcloud.com/tracks/'. esc_attr( $audio_sc_id ) .'" comments="yes" autoplay="no" buy_like="yes" show_artwork="yes" color="#FF5500" width="700" height="110"]' );
									} 
									else if( ( isset( $audio_type ) && $audio_type == 'selfhosted' ) && ( isset( $audio_sh_url ) && $audio_sh_url != '' ) ) {
										$media_content .= do_shortcode( '[audio src="'. esc_url( $audio_sh_url ) .'"]' );
									}
								}
								// Video Only
								else if( isset( $media_type ) && $media_type == 'video' ) {
									if( ( isset( $video_type ) && $video_type == 'youtube' ) && ( isset( $video_id ) && $video_id != '' ) ) {
										$media_content .= do_shortcode( '[zozo_youtube id="'. $video_id .'" autoplay="no" fit_video="yes" rel_video="no"]' );
									}
									else if( ( isset( $video_type ) && $video_type == 'vimeo' ) && ( isset( $video_id ) && $video_id != '' ) ) {
										$media_content .= do_shortcode( '[zozo_vimeo id="'. $video_id .'" autoplay="no" color="#00adef" fit_video="yes" show_title="yes" show_byline="yes"]' );
									}
								}
								// Featured Image
								else if( isset( $media_type ) && $media_type == 'image' ) {
									$portfolio_full_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'gosolar-portfolio-single' );
									$media_content .= '<div class="portfolio-gallery portfolio-image">';
									$media_content .= '<img class="img-responsive" src="'. esc_url( $portfolio_full_img[0] ) .'" alt="'. the_title_attribute( 'echo=0' ) .'" />';
									$media_content .= '</div>';
								}
								// Stack Images
								else if( isset( $media_type ) && $media_type == 'stack' ) {
									$media_content .= '<div class="portfolio-stack-gallery">';
									foreach( $media_images as $image ) {
										$post_image = gosolar_get_portfolio_post_media( '', '', $image, 'gosolar-portfolio-single', '1300', '500');
										
										$media_content .= '<div class="portfolio-img"><img class="img-responsive" src="' . esc_url( $post_image[0] ) . '" width="' . $post_image[1] . '" height="' . $post_image[2] . '" alt="' . $post_image[3] . '" /></div>';
										
									}
									$media_content .= '</div>';
								}
								// Isotope Grid
								else if( isset( $media_type ) && $media_type == 'isotope' ) {
								
									$media_content .= '<div id="zozo-portfolio-wrapper-'. $post->ID .'" class="zozo-portfolio-grid-wrapper zozo-isotope-grid-system">';
									$media_content .= '<div class="zozo-isotope-wrapper portfolio-isotope-wrapper">';
										$media_content .= '<div class="zozo-portfolio zozo-isotope-layout" data-layout="'. $isotope_type .'" data-type="masonry" data-columns="3" data-gutter="20">';
										
										foreach( $media_images as $image ) {
											if( isset( $isotope_type ) && $isotope_type == 'masonry' ) {
												$post_image = gosolar_get_portfolio_post_media( '500', '', $image );
											} else {
												$post_image = gosolar_get_portfolio_post_media( '', '', $image, 'gosolar-portfolio-mid', '560', '385');
											}
											
											$portfolio_large = wp_get_attachment_image_src( $image, 'full' );
										
											$media_content .= '<div class="portfolio-item isotope-post post-iso-w4 post-iso-h4 zozo-img-wrapper">';
											$media_content .= '<div class="post-inside-wrapper margin-top-20">';
												$media_content .= '<div class="portfolio-content">';
											
												$media_content .= '<div class="portfolio-image-overlay-wrapper">';
												$media_content .= '<a href="'. esc_url( $portfolio_large[0] ) .'" data-rel="prettyPhoto[gallery'. $post->ID .']" title="'. get_the_title() .'">';
												$media_content .= '<div class="portfolio-img"><img class="img-responsive" src="' . esc_url( $post_image[0] ) . '" width="' . $post_image[1] . '" height="' . $post_image[2] . '" alt="' . $post_image[3] . '" /></div>';
												$media_content .= '<div class="portfolio-overlay default"></div>';
												$media_content .= '</a>';
												$media_content .= '</div>';
												$media_content .= '</div>';
											$media_content .= '</div>';
											$media_content .= '</div>';
										}
											
										$media_content .= '</div>';
									$media_content .= '</div>';
									$media_content .= '</div>';
								}
								
							} 
							
							// Portfolio Details Info
							$details_content = '';
							$excerpt_content = '';
							$title_content = '';
							if( isset( $portfolio_details ) && $portfolio_details == 'yes' ) {
								$details_content .= '<div class="portfolio-details">';
								
								// Custom Text
								if( isset( $portfolio_custom_text ) && $portfolio_custom_text != '' ) {
									$details_content .= '<div class="portfolio-box">';
									$details_content .= '<p class="portfolio-custom-text">'. do_shortcode( $portfolio_custom_text ) .'</p>';
									$details_content .= '</div>';
								}
								
								// Author Ratings
								if( isset( $author_rating ) && $author_rating != '' ) {
									$details_content .= '<div class="portfolio-box">';
									$details_content .= '<div class="portfolio-rating">';
									$details_content .= '<div class="rateit" data-rateit-value="'. esc_attr( $author_rating ) .'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
									$details_content .= '</div>';
									$details_content .= '</div>';
								}
								
								// Categories
								if( isset( $hide_categories ) && $hide_categories != 1 ) {
									if( get_the_term_list( $post->ID, 'portfolio_categories', '', ',', '' ) ) {
										$details_content .= '<div class="portfolio-box">';
										$details_content .= '<p><strong>'. esc_html( $cat_label ) .'</strong>';
										$details_content .= '<span class="portfolio-terms">';
										$details_content .= get_the_term_list( $post->ID, 'portfolio_categories', '', ', ', '' );
										$details_content .= '</span></p>';
										$details_content .= '</div>';
									}
								}
								
								// Client
								if( isset( $portfolio_client ) && $portfolio_client != '' ) {
									$details_content .= '<div class="portfolio-box">';
									$details_content .= '<p><strong>'. esc_html( $client_label ) .'</strong>';
									$details_content .= '<span class="portfolio-client">';
									$details_content .= esc_attr( $portfolio_client );
									$details_content .= '</span></p>';
									$details_content .= '</div>';
								}
								
								// Date
								if( isset( $portfolio_date ) && $portfolio_date != '' ) {
									$details_content .= '<div class="portfolio-box">';
									$details_content .= '<p><strong>'. esc_html( $date_label ) .'</strong>';
									$details_content .= '<span class="portfolio-date">';
									$details_content .= esc_attr( $portfolio_date );
									$details_content .= '</span></p>';
									$details_content .= '</div>';
								}
								
								// Estimation
								if( isset( $portfolio_estimation ) && $portfolio_estimation != '' ) {
									$details_content .= '<div class="portfolio-box">';
									$details_content .= '<p><strong>'. esc_html( $est_label ) .'</strong>';
									$details_content .= '<span class="portfolio-estimation">';
									$details_content .= esc_attr( $portfolio_estimation );
									$details_content .= '</span></p>';
									$details_content .= '</div>';
								}
								
								// Duration
								if( isset( $portfolio_duration ) && $portfolio_duration != '' ) {
									$details_content .= '<div class="portfolio-box">';
									$details_content .= '<p><strong>'. esc_html( $dur_label ) .'</strong>';
									$details_content .= '<span class="portfolio-duration">';
									$details_content .= esc_attr( $portfolio_duration );
									$details_content .= '</span></p>';
									$details_content .= '</div>';
								}
								
								// Tags
								if( isset( $hide_tags ) && $hide_tags != 1 ) {
									if( get_the_term_list( $post->ID, 'portfolio_tags', '', ',', '' ) ) {
										$details_content .= '<div class="portfolio-box">';
										$details_content .= '<p><strong>'. esc_html( $tag_label ) .'</strong>';
										$details_content .= '<span class="portfolio-terms">';
										$details_content .= get_the_term_list( $post->ID, 'portfolio_tags', '', ', ', '' );
										$details_content .= '</span></p>';
										$details_content .= '</div>';
									}
								}
								
								// Custom Button
								if( isset( $portfolio_btn_url ) && $portfolio_btn_url != '' ) {
									$details_content .= '<div class="portfolio-box">';
									$details_content .= '<div class="portfolio-custom-link">';
									$details_content .= '<a href="'. esc_url( $portfolio_btn_url ) .'" target="_blank" class="btn btn-default">'. esc_attr( $portfolio_btn_text ) .'</a>';
									$details_content .= '</div>';
									$details_content .= '</div>';
								}
								
								// Social Share
								if( isset( $portfolio_share ) && $portfolio_share == 1 ) {
									$details_content .= '<div class="zozo-social-share-wrapper portfolio-sharing">';
									$details_content .= gosolar_display_social_sharing_icons( 'no' );
									$details_content .= '</div>';
								} 
								
								$details_content .= '</div>';
								
								if( isset( $show_title ) && $show_title == 1 ) {
									$title_content .= '<div class="post-title-wrapper"><h1 class="entry-title">';
									$title_content .= get_the_title();
									$title_content .= '</h1></div>';
								}
								
								if( ! empty( $post->post_excerpt ) ) {
									$excerpt_content .= '<div class="portfolio-excerpt-block">';
									$excerpt_content .= '<div class="portfolio-excerpt">';
									$excerpt_content .= '<p>'. $post->post_excerpt .'</p>';
									$excerpt_content .= '</div>';
									$excerpt_content .= '</div>';
								}
							}
							
							$sticky_class = $sticky_parent_class = '';
							if( isset( $sticky_sidebar ) && $sticky_sidebar == 'yes' ) {
								$sticky_class = ' sticky-sidebar';
								$sticky_parent_class = ' sticky-sidebar-parent';
							}
							
							$the_content = '';
							$the_content = get_the_content();
							
							// Portfolio Details on Top
							if( isset( $portfolio_details_layout ) && $portfolio_details_layout == 'portfolio_top' ) {
							
								echo '<div class="portfolio-single-wrapper portfolio-lt-top">';
									echo '<div class="portfolio-single-details portfolio-info-content clearfix">
										<div class="row">';
											if( $title_content != '' || $excerpt_content != '' ) {
												echo '<div class="col-md-8 col-xs-12">'. $title_content . $excerpt_content .'</div>';
											}
											echo '<div class="col-md-4 col-xs-12">'. $details_content .'</div>
										</div>
									</div>';
									
									if( $media_content != '' ) {
										echo '<div id="portfolio-content-media" class="portfolio-single-media clearfix">'. $media_content .'</div>';
									}
									
									echo '<div id="portfolio-'. get_the_ID() .'" class="portfolio-body-content">';
										echo apply_filters('the_content', $the_content);
									echo '</div>';
								echo '</div>';
							}
							// Portfolio Details on Bottom
							else if( isset( $portfolio_details_layout ) && $portfolio_details_layout == 'portfolio_bottom' ) {
								
								echo '<div class="portfolio-single-wrapper portfolio-lt-bottom">';
									if( $media_content != '' ) {
										echo '<div id="portfolio-content-media" class="portfolio-single-media clearfix">'. $media_content .'</div>';
									}
									
									echo '<div class="portfolio-single-details portfolio-info-content clearfix">
										<div class="row">';
											if( $title_content != '' || $excerpt_content != '' ) {
												echo '<div class="col-md-8 col-xs-12">'. $title_content . $excerpt_content .'</div>';
											}
											echo '<div class="col-md-4 col-xs-12">'. $details_content .'</div>
										</div>
									</div>';
									
									echo '<div id="portfolio-'. get_the_ID() .'" class="portfolio-body-content">';
										echo apply_filters('the_content', $the_content);
									echo '</div>';
								echo '</div>';
							
							}
							// Portfolio Details on Right
							else if( isset( $portfolio_details_layout ) && $portfolio_details_layout == 'portfolio_right' ) {
								echo '<div class="portfolio-single-wrapper'. $sticky_parent_class .' portfolio-sl-right">';
									echo '<div class="row">';
										echo '<div class="col-md-8 col-xs-12 pf-sidebar-col-left">';
											echo '<div class="row"><div class="container">';
											if( $media_content != '' ) {
												echo '<div id="portfolio-content-media" class="portfolio-single-media">'. $media_content .'</div>';
											}
											
											echo '<div id="portfolio-'. get_the_ID() .'" class="portfolio-body-content">';
												echo apply_filters('the_content', $the_content);
											echo '</div>';
											echo '</div></div>';
										echo '</div>';
										
										echo '<div class="col-md-4 col-xs-12 pf-sidebar-col-right'. $sticky_class .'">
											<div class="portfolio-sidebar-element">
												<div class="portfolio-single-details portfolio-info-content">
													'. $title_content . $excerpt_content . $details_content .'
												</div>
											</div>
										</div>';
										
									echo '</div>';
								echo '</div>';
							}
							// Portfolio Details on Left
							else if( isset( $portfolio_details_layout ) && $portfolio_details_layout == 'portfolio_left' ) {
								echo '<div class="portfolio-single-wrapper'. $sticky_parent_class .' portfolio-sl-left">';
									echo '<div class="row">';
										echo '<div class="col-md-4 col-xs-12 pf-sidebar-col-left'. $sticky_class .'">
											<div class="portfolio-sidebar-element">
												<div class="portfolio-single-details portfolio-info-content">
													'. $title_content . $excerpt_content . $details_content .'
												</div>
											</div>
										</div>';
										
										echo '<div class="col-md-8 col-xs-12 pf-sidebar-col-right">';
											echo '<div class="container sticky-sidebar-row-inner">';
											if( $media_content != '' ) {
												echo '<div id="portfolio-content-media" class="portfolio-single-media">'. $media_content .'</div>';
											}
											
											echo '<div id="portfolio-'. get_the_ID() .'" class="portfolio-body-content">';
												echo apply_filters('the_content', $the_content);
											echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
							
							if( isset( $related_slider ) && $related_slider != 1 ) {
								gosolar_related_portfolio_slider();
							}
							
							if( gosolar_get_theme_option( 'zozo_portfolio_prev_next' ) == 1 ) {
								gosolar_postnavigation();
							}
						
						endwhile;
						
						else : ?>
							<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>
					</div><!-- #content -->
				</div><!-- #primary -->
		
				<?php get_sidebar(); ?>	
			</div>
		</div><!-- #single-sidebar-container -->
		<?php get_sidebar( 'second' ); ?>
	</div><!-- #main-wrapper -->
</div><!-- .container -->
<?php get_footer(); ?>
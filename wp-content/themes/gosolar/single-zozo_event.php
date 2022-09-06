<?php
/**
 * Single Event Page
 *
 * @package Zozothemes
 */
 
get_header();
?>
<div class="container">
	<div id="main-wrapper" class="zozo-row row">
		<div id="single-sidebar-container" class="single-sidebar-container <?php gosolar_content_sidebar_classes(); ?>">
			<div class="zozo-row row">
				<div id="primary" class="content-area <?php gosolar_primary_content_classes(); ?>">
					<div id="content" class="site-content">
						<?php if ( have_posts() ):
						while ( have_posts() ): the_post();
							$zozo_event_gallery = '';
							$start_date 	 = get_post_meta( $post->ID, 'zozo_event_start_date', true );
							$start_time 	 = get_post_meta( $post->ID, 'zozo_event_start_time', true );
							$venue 	 = get_post_meta( $post->ID, 'zozo_event_venue', true );
							$venue_address 	 = get_post_meta( $post->ID, 'zozo_event_venue_address', true );
							$event_phone 	 = get_post_meta( $post->ID, 'zozo_event_phone', true );
							$event_website 	 = get_post_meta( $post->ID, 'zozo_event_website', true );
							$event_google_map 	 = get_post_meta( $post->ID, 'zozo_event_google_map', true );
							$event_book_now_form 	 = get_post_meta( $post->ID, 'zozo_event_book_now_form', true );
							$custom_link 	 = get_post_meta( $post->ID, 'zozo_event_custom_link', true );
							$custom_link_target 	 = get_post_meta( $post->ID, 'zozo_event_link_target', true );
							$button_text 	 = get_post_meta( $post->ID, 'zozo_event_button_text', true );
							?>
							<div id="event-content-wrap" class="event-single clearfix">										
								<div <?php post_class(); ?> id="event-<?php the_ID(); ?>">
									
									<div class="event-single-content-wrapper">
										<div class="entry-content">
											<div class="row">
												<div class="col-md-8">
													<?php
													$event_full_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'gosolar-custom-single'); 
													if( ! empty( $event_full_img[0] ) ) { ?>
													<div class="event-gallery event-image">
														<img class="img-responsive" src="<?php echo esc_url( $event_full_img[0] ); ?>" alt="<?php the_title(); ?>" />
													</div>
													<?php } ?>
									
													<?php the_content(); ?>
												</div>
												<div class="col-md-4 event-details">
													<h3><?php echo esc_html__( 'Event Details', 'gosolar'); ?></h3>
													<?php if( isset( $start_date ) && $start_date != '' ) {?><div class="event-sdate"><i class="fa fa-calendar"></i> <?php echo esc_html( $start_date ); ?></div><?php } ?>
													
													<?php if( isset( $start_time ) && $start_time != '' ) {?><div class="event-edate"><i class="fa fa-clock-o"></i> <?php echo esc_html( $start_time ); ?></div><?php } ?>
													
													<?php if( isset( $venue ) && $venue != '' ) {?><div class="event-venue"><i class="fa fa-home"></i><b><?php echo esc_html( $venue ); ?></b></div><?php } ?>
													
													<?php if( isset( $venue_address ) && $venue_address != '' ) {?><div class="event-address"><i class="fa fa-map-marker"></i><?php echo esc_html( $venue_address ); ?></div><?php } ?>
													
													<?php if( isset( $event_phone ) && $event_phone != '' ) {?><div class="event-phone"><i class="fa fa-phone"></i> <?php echo esc_html( $event_phone ); ?></div><?php } ?>
													
													<?php if( isset( $event_website ) && $event_website != '' ) {?><div class="event-website"><i class="fa fa-globe"></i> <a href="<?php echo esc_url( $event_website ); ?>" tarket="_blank"><?php echo esc_url( $event_website ); ?></a></div><?php } ?>
													
													<?php if( isset( $event_google_map ) && $event_google_map != '' ) {
																wp_enqueue_script( 'gosolar-zozo-gmaps-js' );?>
		
																<div class="gmap-wrapper">
																	<div class="gmap_canvas" data-marker="<?php echo esc_url( GOSOLAR_THEME_URL . '/images/map-marker.png' ); ?>" data-address="<?php echo esc_attr( $event_google_map ); ?>" data-title="<?php echo esc_html( get_the_title() ); ?>" data-content="" style="width:600px; height:300px;">
																	</div>
																</div><?php
														} 
													?>
													
													<div class="event-book-now-form">
													<h3><?php echo esc_html__( 'Register Now', 'gosolar'); ?></h3>
													<?php echo do_shortcode( $event_book_now_form);  ?></div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- #event-content-wrap -->
								
						<?php endwhile;
						
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
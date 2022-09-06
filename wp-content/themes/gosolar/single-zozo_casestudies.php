<?php
/**
 * Single Casestudies Page
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
							$zozo_casestudies_gallery = '';
							$zozo_casestudies_gallery = get_post_meta( $post->ID, 'zozo_gallery_images', true ); ?>
							<div id="casestudies-content-wrap" class="casestudies-single clearfix">										
								<div <?php post_class(); ?> id="casestudies-<?php the_ID(); ?>">
									<?php if( $zozo_casestudies_gallery != '' ) {
									
										$casestudies_images = explode(',', $zozo_casestudies_gallery);
										
										$gallery_attr = '';
										if( gosolar_get_theme_option( 'zozo_casestudy_citems' ) != '' ) {
											$gallery_attr .= ' data-items=' . gosolar_get_theme_option( 'zozo_casestudy_citems' ) . ' ';
										}
										
										if( gosolar_get_theme_option( 'zozo_casestudy_citems_scroll' ) != '' ) {
											$gallery_attr .= ' data-slideby=' . gosolar_get_theme_option( 'zozo_casestudy_citems_scroll' ) . ' ';
										}
										
										if( gosolar_get_theme_option( 'zozo_casestudy_ctablet' ) != '' ) {
											$gallery_attr .= ' data-items-tablet=' . gosolar_get_theme_option( 'zozo_casestudy_ctablet' ) . ' ';
										}
										
										if( gosolar_get_theme_option( 'zozo_casestudy_cmobile_land' ) != '' ) {
											$gallery_attr .= ' data-items-mobile-landscape=' . gosolar_get_theme_option( 'zozo_casestudy_cmobile_land' ) . ' ';
										}
										
										if( gosolar_get_theme_option( 'zozo_casestudy_cmobile' ) != '' ) {
											$gallery_attr .= ' data-items-mobile-portrait=' . gosolar_get_theme_option( 'zozo_casestudy_cmobile' ) . ' ';
										}
										
										if( gosolar_get_theme_option( 'zozo_casestudy_cautoplay' ) == 1 ) {
											$gallery_attr .= ' data-autoplay=true ';
										} else {
											$gallery_attr .= ' data-autoplay=false ';
										}
										
										if( gosolar_get_theme_option( 'zozo_casestudy_ctimeout' ) != '' ) {
											$gallery_attr .= ' data-autoplay-timeout=' . gosolar_get_theme_option( 'zozo_casestudy_ctimeout' ) . ' ';
										}
										
										if( gosolar_get_theme_option( 'zozo_casestudy_cloop' ) == 1 ) {
											$gallery_attr .= ' data-loop=true ';
										} else {
											$gallery_attr .= ' data-loop=false ';
										}
										
										if( gosolar_get_theme_option( 'zozo_casestudy_cmargin' ) != '' ) {
											$gallery_attr .= ' data-margin=' . gosolar_get_theme_option( 'zozo_casestudy_cmargin' ) . ' ';
										}
										
										if( gosolar_get_theme_option( 'zozo_casestudy_cpagination' ) == 1 ) {
											$gallery_attr .= ' data-pagination=true ';
										} else {
											$gallery_attr .= ' data-pagination=false ';
										}
										
										if( gosolar_get_theme_option( 'zozo_casestudy_cnavigation' ) == 1 ) {
											$gallery_attr .= ' data-navigation=true ';
										} else {
											$gallery_attr .= ' data-navigation=false ';
										} ?>										
																			
										<div id="single-casestudies-slider" class="zozo-owl-carousel owl-carousel casestudies-gallery single-casestudies-slider"<?php echo esc_attr( $gallery_attr ); ?>>
										<?php foreach( $casestudies_images as $image ) {
												$src  = wp_get_attachment_image_src( $image, 'full' );
												$src  = $src[0]; ?>
												<div class="single-casestudies-item">
													<img src="<?php echo esc_url( $src ); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
												</div>
										<?php } ?>
										</div>
									<?php } else {
										$casestudies_full_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); 
										if( ! empty( $casestudies_full_img[0] ) ) { ?>
										<div class="casestudies-gallery casestudies-image">
											<img class="img-responsive" src="<?php echo esc_url( $casestudies_full_img[0] ); ?>" alt="<?php the_title(); ?>" />
										</div>
										<?php }
									} ?>
									
									<div class="casestudies-single-content-wrapper">
										<div class="entry-content">
											<?php the_content(); ?>
										</div>
									</div>
								</div>
							</div><!-- #casestudies-content-wrap -->
								
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
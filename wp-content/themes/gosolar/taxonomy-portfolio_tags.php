<?php
/**
 * Taxonomy Portfolio Categories Template
 *
 * @package Zozothemes
 */
 
get_header(); ?>
<div class="container">
	<div id="main-wrapper" class="zozo-row row">
		<div id="single-sidebar-container" class="single-sidebar-container <?php gosolar_content_sidebar_classes(); ?>">
			<div class="zozo-row row">	
				<div id="primary" class="content-area <?php gosolar_primary_content_classes(); ?>">
					<div id="content" class="site-content">
						<?php
						global $wp_query; 
						$term = $wp_query->get_queried_object();
						$term_id = $term->term_id;
						
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						
						if( gosolar_get_theme_option( 'zozo_portfolio_archive_count' ) != '' ) {
							$posts = gosolar_get_theme_option( 'zozo_portfolio_archive_count' );
						} else {
							$posts = 10;
						}
						
						if( gosolar_get_theme_option( 'zozo_portfolio_archive_layout' ) != '' ) {
							$style = gosolar_get_theme_option( 'zozo_portfolio_archive_layout' );
						} else {
							$style = 'grid';
						}
						
						if( gosolar_get_theme_option( 'zozo_portfolio_archive_columns' ) != '' ) {
							$grid_columns = gosolar_get_theme_option( 'zozo_portfolio_archive_columns' );
						} else {
							$grid_columns = 4;
						}
						
						$column_width = 12 / $grid_columns;
						
						if( gosolar_get_theme_option( 'zozo_portfolio_archive_gutter' ) != '' ) {
							$grid_gutter = gosolar_get_theme_option( 'zozo_portfolio_archive_gutter' );
						} else {
							$grid_gutter = 30;
						}
						
						$query = new WP_Query(array('post_type'  	=> 'zozo_portfolio',
												'posts_per_page'	=> $posts,
												'paged' 			=> $paged,
												'orderby' 		 	=> 'date',
												'order' 		 	=> 'DESC',
												'tax_query' 	 	=> array(
																	   array(
																		'taxonomy' 	=> 'portfolio_tags',
																		'field' 	=> 'id',
																		'terms' 	=> $term_id
																	) )));
						?>
						<?php if ( $query->have_posts() ):
							echo '<div class="zozo-portfolio-grid-wrapper zozo-isotope-grid-system clearfix">';
							
								echo '<div class="zozo-isotope-wrapper">';
							
								if( isset( $style ) && $style == 'classic' ) {
									echo '<div id="zozo_portfolio_'.$term_id.'" class="zozo-portfolio zozo-isotope-layout classic-grid-style portfolio-cols-'.$grid_columns.'" data-columns="'.$grid_columns.'" data-gutter="'.$grid_gutter.'" data-type="masonry" data-layout="fitRows">'. "\n";
								} else {
									echo '<div id="zozo_portfolio_'.$term_id.'" class="zozo-portfolio zozo-isotope-layout default-grid-style portfolio-cols-'.$grid_columns.'" data-columns="'.$grid_columns.'" data-gutter="'.$grid_gutter.'" data-type="masonry" data-layout="fitRows">';
								}
								while ( $query->have_posts() ): $query->the_post();
								
									if( isset( $grid_columns ) && $grid_columns == '2' ) {
										$image_size = 'gosolar-portfolio-large';
									} else {
										$image_size = 'gosolar-portfolio-mid';
									}
									
									$portfolio_img = '';
									$portfolio_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $image_size); 
									
									$media_output = '';
									$media_output = gosolar_portfolio_media_output( $post->ID, $style, $grid_columns, $term_id ); 
									
									$media_icon_output = '';
									$media_icon_output = gosolar_portfolio_media_icon_output( $post->ID, $term_id ); ?>
									
									<div id="portfolio-<?php the_ID(); ?>" <?php post_class('portfolio-item isotope-post post-iso-w' . $column_width .' post-iso-h' . $column_width .''); ?>>
									<div class="post-inside-wrapper <?php echo 'margin-top-'. $grid_gutter; ?> animate_when_almost_visible zoom-in" data-delay="300">
									
										<div class="portfolio-content">
											<?php $portfolio_large = ''; 
											$portfolio_large = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
											$author_rating 	 = get_post_meta( $post->ID, 'zozo_author_rating', true );
											$custom_text 	 = get_post_meta( $post->ID, 'zozo_portfolio_custom_text', true );
											$custom_url 	= get_post_meta( $post->ID, 'zozo_portfolio_custom_link', true );
											$custom_link 	= $custom_url == '' ? get_permalink() : esc_url( $custom_url );
											
											echo '<div class="portfolio-image-overlay-wrapper">';
												if( isset( $media_output ) && $media_output != '' ) {
													echo gosolar_portfolio_media_output( $post->ID, $style, $grid_columns, $term_id );
												}  else {				
													echo '<div class="portfolio-img zoomin"><img class="img-responsive" src="'. esc_url($portfolio_img[0]) .'" width="'. esc_attr($portfolio_img[1]) .'" height="'. esc_attr($portfolio_img[2]) .'" alt="'. get_the_title() .'" /></div>';
												}
												echo '<div class="portfolio-overlay default"></div>';
											echo '</div>'; 
											
											if( isset( $style ) && $style == 'classic' ) {
												echo '<div class="portfolio-mask overlay-mask position-center">';
													echo '<ul class="overlay-buttons fade-up">';					
														if( isset( $media_icon_output ) && $media_icon_output != '' ) {
															echo gosolar_portfolio_media_icon_output( $post->ID, $term_id );
														} else {
															echo '<li><a href="'.esc_url( $portfolio_large[0] ).'" class="pf-icon-zoom" data-rel="prettyPhoto[gallery'. $term_id .']" title="'.get_the_title().'"><i class="simple-icon icon-size-fullscreen"></i></a></li>';
														}													
														echo '<li><a href="'. $custom_link .'" class="pf-icon-link" title="'. get_the_title(). '"><i class="simple-icon icon-share-alt"></i></a></li>';
													echo '</ul>';
												echo '</div>';
												
												echo '<div class="portfolio-inner-wrapper">';
													echo '<div class="portfolio-inner-content">';
														if( isset( $custom_text ) && $custom_text != '' ) {
															echo '<h5><a href="'. $custom_link .'" title="'.get_the_title().'">'.get_the_title().'</a><p class="portfolio-custom-text">'. $custom_text .'</p></h5>';
														} else {
															echo '<h5><a href="'. $custom_link .'" title="'.get_the_title().'">'.get_the_title().'</a></h5>';
														}
														
														if( isset( $author_rating ) && $author_rating != '' ) {
															echo '<div class="portfolio-rating">';	
																echo '<div class="rateit" data-rateit-value="'.$author_rating.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
															echo '</div>';
														}
														echo '<p>' . gosolar_shortcode_stripped_excerpt( get_the_excerpt(), 15 ) . '</p>';
														
														echo '<a href="'. get_permalink() .'" class="btn btn-more" title="'.get_the_title().'">'. esc_html__('Read more', 'gosolar') .'</a>';
														
													echo '</div>';
												echo '</div>';
												
											} else {
											
												echo '<div class="portfolio-mask overlay-mask position-center">';
													echo '<div class="portfolio-title">';
														echo '<h4><a title="'. get_the_title() .'" href="'. $custom_link .'">'. get_the_title() .'</a></h4>';
														if( isset( $grid_columns ) && $grid_columns == 4 ) {
															echo '<p>' . gosolar_shortcode_stripped_excerpt( get_the_excerpt(), 5 ) . '</p>';
														} else {
															echo '<p>' . gosolar_shortcode_stripped_excerpt( get_the_excerpt(), 8 ) . '</p>';
														}
													echo '</div>';
														
													echo '<ul class="overlay-buttons fade-up">';					
														if( isset( $media_icon_output ) && $media_icon_output != '' ) {
															echo gosolar_portfolio_media_icon_output( $post->ID, $term_id );
														} else {
															echo '<li><a href="'.esc_url( $portfolio_large[0] ).'" class="pf-icon-zoom" data-rel="prettyPhoto[gallery'. $term_id .']" title="'.get_the_title().'"><i class="simple-icon icon-size-fullscreen"></i></a></li>';
														}													
														echo '<li><a href="'. $custom_link .'" class="pf-icon-link" title="'. get_the_title(). '"><i class="simple-icon icon-share-alt"></i></a></li>';
													echo '</ul>';
												echo '</div>';
												
											} ?>
											
										</div>
										
									</div>
									</div><!-- #post -->
									
								<?php endwhile; ?>
								</div>
								
								<div class="zozo-pagination-wrapper">
								<?php echo gosolar_pagination( $query->max_num_pages, '' ); ?>
								</div>
								
								</div>
							</div>
								
						<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
								
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>
						
					</div><!-- #content -->
				</div><!-- #primary -->
				<?php get_sidebar(); ?>
				
			</div>
		</div><!-- #single-sidebar-container -->
		<?php get_sidebar( 'second' ); ?>
		
	</div><!-- #main-wrapper -->
</div><!-- .container -->
<?php get_footer(); ?>
<?php
/**
 * Taxonomy Service Categories Template
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
						
						if( gosolar_get_theme_option( 'zozo_service_archive_count' ) != '' ) {
							$posts = gosolar_get_theme_option( 'zozo_service_archive_count' );
						} else {
							$posts = 10;
						}						
						
						if( gosolar_get_theme_option( 'zozo_service_archive_columns' ) != '' ) {
							$grid_columns = gosolar_get_theme_option( 'zozo_service_archive_columns' );
						} else {
							$grid_columns = 4;
						}
						
						$main_class = ' services-columns-'.$grid_columns;
		
						$column_class = '';
						
						if( isset( $grid_columns ) && $grid_columns != '' ) {
							if( isset( $grid_columns ) && $grid_columns == '2' ) {
								$column_class = 'col-sm-6 col-xs-12';
							} else if( isset( $grid_columns ) && $grid_columns == '3' ) {
								$column_class = 'col-sm-4 col-xs-12';
							} else if( isset( $grid_columns ) && $grid_columns == '4' ) {
								$column_class = 'col-md-3 col-sm-6 col-xs-12';
							}
						} else {
							$column_class = 'col-sm-6 col-xs-12';
						}
												
						$query = new WP_Query(array('post_type'  	=> 'zozo_services',
												'posts_per_page'	=> $posts,
												'paged' 			=> $paged,
												'orderby' 		 	=> 'date',
												'order' 		 	=> 'DESC',
												'tax_query' 	 	=> array(
																	   array(
																		'taxonomy' 	=> 'service_categories',
																		'field' 	=> 'id',
																		'terms' 	=> $term_id
																	) )));
						
						if( $query->have_posts() ):
							echo '<div class="zozo-services-grid-wrapper'.$main_classes.'">';
							echo '<div class="row services-grid-inner">';
							
							$count = 1;
							
							while( $query->have_posts() ): $query->the_post();
							
								if( isset( $grid_columns ) && $grid_columns == '2' ) {
									$image_size = 'gosolar-custom-large';
								} else {
									$image_size = 'gosolar-custom-mid';
								}
								
								$services_img = '';
								$services_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $image_size);				
								
								$services_img_large = ''; 
								$services_img_large = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); 
								
								if( ( isset( $columns ) && $columns == '2' && $count == '3' ) || ( isset( $columns ) && $columns == '3' && $count == '4' ) || ( isset( $columns ) && $columns == '4' && $count == '5' ) ) {
									$count = 1;
									echo '<div class="services-clearfix clearfix"></div>';
								} ?>
								
								<div class="services-item <?php echo esc_attr( $column_class ); ?>">
									<div id="services-<?php the_ID(); ?>" <?php post_class('services-item'); ?>>
										<?php if( isset( $services_img ) && $services_img != '' ) {
											echo '<div class="services-item-img">';
												echo '<a href="'.esc_url( $services_img_large[0] ).'" data-rel="prettyPhoto[gallery'.$term_id.']" class="services-img-link" title="'. esc_html( get_the_title() ) .'"><img class="img-responsive" src="'.esc_url($services_img[0]).'" width="'.esc_attr($services_img[1]).'" height="'.esc_attr($services_img[2]).'" alt="'. esc_html( get_the_title() ) .'" /></a>';
											echo '</div>';
										} ?>
											
										<div class="services-content-wrapper">
											<?php echo '<h4><a href="'. esc_url( get_permalink() ) .'" title="'. esc_html( get_the_title() ) .'">'. esc_html( get_the_title() ) .'</a></h4>';
											echo '<div class="services-excerpts"><p>';
												echo gosolar_shortcode_stripped_excerpt( get_the_excerpt(), 10 );
											echo '</p></div>';
											echo '<a href="'. esc_url( get_permalink() ) .'" class="btn btn-more" title="'. esc_html( get_the_title() ) .'">'. esc_html__('Read more', 'gosolar') .'</a>'; ?>
										</div>
									</div>
								</div>
								
							<?php endwhile;
								
							echo '</div>';
							echo gosolar_pagination( $query->max_num_pages, '' );
								
						echo '</div>';  ?>
								
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
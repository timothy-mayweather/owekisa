<?php

/**

 * Related Posts

 */



global $post; 



$tags = wp_get_post_tags($post->ID);

if($tags) {

	$tag_ids = array();

	foreach($tags as $tag) {

		$tag_ids[] = $tag->term_id;

	}

	

	$args = array(

		'tag__in'    	=> $tag_ids,

		'post__not_in'   => array($post->ID),

		'posts_per_page' => -1,

	);

	

	// Slider Configuration

	$data_attr = '';

	

	if( gosolar_get_theme_option( 'zozo_related_blog_items' ) != '' ) {

		$data_attr .= ' data-items=' . gosolar_get_theme_option( 'zozo_related_blog_items' ) . ' ';

	}

	

	if( gosolar_get_theme_option( 'zozo_related_blog_items_scroll' ) != '' ) {

		$data_attr .= ' data-slideby=' . gosolar_get_theme_option( 'zozo_related_blog_items_scroll' ) . ' ';

	}

	

	if( gosolar_get_theme_option( 'zozo_related_blog_tablet' ) != '' ) {

		$data_attr .= ' data-items-tablet=' . gosolar_get_theme_option( 'zozo_related_blog_tablet' ) . ' ';

	}

	

	if( gosolar_get_theme_option( 'zozo_related_blog_landscape' ) != '' ) {

		$data_attr .= ' data-items-mobile-landscape=' . gosolar_get_theme_option( 'zozo_related_blog_landscape' ) . ' ';

	}

	

	if( gosolar_get_theme_option( 'zozo_related_blog_portrait' ) != '' ) {

		$data_attr .= ' data-items-mobile-portrait=' . gosolar_get_theme_option( 'zozo_related_blog_portrait' ) . ' ';

	}

	

	if( gosolar_get_theme_option( 'zozo_related_blog_autoplay' ) == 1 ) {

		$data_attr .= ' data-autoplay=true ';

	} else {

		$data_attr .= ' data-autoplay=false ';

	}

	

	if( gosolar_get_theme_option( 'zozo_related_blog_timeout' ) != '' ) {

		$data_attr .= ' data-autoplay-timeout=' . gosolar_get_theme_option( 'zozo_related_blog_timeout' ) . ' ';

	}

	

	if( gosolar_get_theme_option( 'zozo_related_blog_loop' ) == 1 ) {

		$data_attr .= ' data-loop=true ';

	} else {

		$data_attr .= ' data-loop=false ';

	}

	

	if( gosolar_get_theme_option( 'zozo_related_blog_margin' ) != '' ) {

		$data_attr .= ' data-margin=' . gosolar_get_theme_option( 'zozo_related_blog_margin' ) . ' ';

	}

	

	if( gosolar_get_theme_option( 'zozo_related_blog_dots' ) == 1 ) {

		$data_attr .= ' data-pagination=true ';

	} else {

		$data_attr .= ' data-pagination=false ';

	}

	

	if( gosolar_get_theme_option( 'zozo_related_blog_nav' ) == 1 ) {

		$data_attr .= ' data-navigation=true ';

	} else {

		$data_attr .= ' data-navigation=false ';

	}

	

	$related_query = new WP_Query($args);

	if( $related_query->have_posts() ) { ?>

		<div class="related-posts-wrapper">

			<h3 class="related-title"><?php esc_html_e('Related Posts', 'gosolar'); ?></h3>

			<div id="single-related-posts" class="zozo-owl-carousel related-posts-slider owl-carousel"<?php echo esc_attr( $data_attr ); ?>>

				<?php while ($related_query->have_posts()) {

					$related_query->the_post();

					

					if( has_post_format('link') ) {

						$external_url = '';

						$external_url = get_post_meta( $post->ID, 'zozo_external_link_url', true );

						if( isset( $external_url ) && $external_url == '' ) {

							$external_url = get_permalink( $post->ID );

						}

					} ?>

					<div class="related-post-item">

						<?php if ( has_post_thumbnail() ) { ?>

							<div class="entry-thumbnail">

								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="post-img">

									<?php the_post_thumbnail( 'gosolar-blog-medium' ); ?>

								</a>

							</div>

						<?php } ?>

						<div class="related-content-wrapper">

							<h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-link"><?php the_title(); ?></a></h5>

							<div class="related-post-summary">

								<p><?php echo gosolar_shortcode_stripped_excerpt( get_the_content(), 10 ); ?></p>

							</div>

							<div class="related-post-more">

								<?php if( has_post_format('link') ) { ?>

									<a href="<?php echo esc_url($external_url); ?>" class="btn-more read-more-link" target="_blank">

								<?php } else { ?>

									<a href="<?php the_permalink(); ?>" class="btn-more read-more-link">

								<?php } ?>

								

								<?php if( ! gosolar_get_theme_option( 'zozo_blog_read_more_text' ) ) { 

									esc_html_e('Read more', 'gosolar'); 

								} else { 

									echo esc_attr( gosolar_get_theme_option( 'zozo_blog_read_more_text' ) ); 

								} ?>

								

								</a>

							</div>

						</div>

					</div>

				<?php } ?>

			</div>				

		</div>

	<?php } 

	wp_reset_postdata();

}
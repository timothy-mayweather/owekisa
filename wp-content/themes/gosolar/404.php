<?php
/**
 * 404 Template
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
						<div id="post-404" class="post post-404">
							<div class="entry-content">
								<div class="content-404page">
									<div class="search-404page">
										<?php get_search_form(); ?>
									</div>
									
									<h2 class="title-one"><?php esc_html_e('Oops! Page Not Found', 'gosolar'); ?> </h2>
									<img src="<?php echo esc_url( GOSOLAR_THEME_URL . '/images/404.png' ); ?>" alt="404" class="img-responsive" />
									<h5 class="title-three"><?php esc_html_e( 'Sorry!! The page you are looking for does not exist.', 'gosolar' ); ?></h5>									
									
									<div class="homepage-link">
										
										<a href="<?php echo esc_url( get_site_url() ); ?>" class="btn btn-default">Go To Home Page </a>
									
									</div>
								</div>
							</div>
						</div>
					</div><!-- #content -->
				</div><!-- #primary -->
				<?php get_sidebar(); ?>
			</div>
		</div><!-- #single-sidebar-container -->
		<?php get_sidebar( 'second' ); ?>
		
	</div><!-- #main-wrapper -->
</div><!-- .container -->
<?php get_footer(); ?>
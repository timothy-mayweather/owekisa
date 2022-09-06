<?php

/* ======================================

 * Footer Functions

 *

 *	gosolar_footer_wrapper()

 *	gosolar_footer_backtotop()

 *  gosolar_footer_section_widgets()

 *  gosolar_footer_section_copyrightbar()

 *  gosolar_footer_copyright()

 *  gosolar_footer_menu_output()

 *

 * ====================================== */

 

/* ======================================

 * Footer Wrapper

 * ====================================== */

 

if ( ! function_exists( 'gosolar_footer_wrapper' ) ) {

	function gosolar_footer_wrapper() {

		

		$post_id 		= gosolar_get_post_id();

		

		// Footer Style

		$footer_style  = '';

		$footer_style 	= get_post_meta( $post_id, 'zozo_footer_style', true );

		if( isset( $footer_style ) && $footer_style == '' || $footer_style == 'default' ) {

			$footer_style = gosolar_get_theme_option( 'zozo_footer_style' );

		} else if( isset( $footer_style ) && $footer_style == 'normal' ) {

			$footer_style = 'default';

		}

			

		// Footer Skin

		$footer_skin 	= '';

		$footer_skin 	= get_post_meta( $post_id, 'zozo_footer_skin', true );

		if( isset( $footer_skin ) && $footer_skin == '' || $footer_skin == 'default' ) {

			$footer_skin = gosolar_get_theme_option( 'zozo_footer_skin' );

		} ?>

		

		<div id="footer" class="footer-section footer-style-<?php echo esc_attr( $footer_style ); ?> footer-skin-<?php echo esc_attr( $footer_skin ); ?>">

			<?php 

				/**

				 * @hooked - gosolar_footer_backtotop - 10

				**/

				do_action('gosolar_footer_section_start');

				

				/**

				 * @hooked - gosolar_footer_section_widgets - 10

				 * @hooked - gosolar_footer_section_copyrightbar - 20

				**/

				do_action('gosolar_footer_section');

				

				do_action('gosolar_footer_section_end');

			?>

		</div><!-- #footer -->

		

	<?php }



	add_action( 'gosolar_footer_wrapper_start', 'gosolar_footer_wrapper', 10 );

}



if ( ! function_exists( 'gosolar_footer_backtotop' ) ) {

	function gosolar_footer_backtotop() {

	

		if( gosolar_get_theme_option( 'zozo_enable_back_to_top' ) && gosolar_get_theme_option( 'zozo_back_to_top_position' ) == 'footer_top' ) { ?>

			<div id="zozo-back-to-top" class="footer-backtotop footer-top-position">					

				<a href="#zozo_wrapper"><i class="glyphicon glyphicon-arrow-up"></i></a>

			</div><!-- #zozo-back-to-top -->

		<?php }

		

	}

	

	add_action( 'gosolar_footer_section_start', 'gosolar_footer_backtotop', 10 );

}



if ( ! function_exists( 'gosolar_footer_section_widgets' ) ) {

	function gosolar_footer_section_widgets() {

	

		$post_id = gosolar_get_post_id();

		

		$show_footer_widgets = '';

		$show_footer_widgets = get_post_meta( $post_id, 'zozo_show_footer_widgets', true );

		if( isset( $show_footer_widgets ) && $show_footer_widgets == '' || $show_footer_widgets == 'default' ) {

			$show_footer_widgets = gosolar_get_theme_option( 'zozo_footer_widgets_enable' );

			if( $show_footer_widgets == 1 ) {

				$show_footer_widgets = 'yes';

			} else {

				$show_footer_widgets = 'no';

			}

		}

		if( isset( $show_footer_widgets ) && $show_footer_widgets == 'yes' && is_active_sidebar( 'footer-top' ) ){ ?>

			<div class="container">				
				<div class="zozo-row row">
					<div class="col col-md-12">
						<div id="footer-top-area" class="footer-top-area">		
							<?php dynamic_sidebar( 'footer-top' ); ?>		
						</div>
					</div>
				</div>
			</div>

		<?php

		}

				

		if( isset( $show_footer_widgets ) && $show_footer_widgets == 'yes' && ( is_active_sidebar('footer-widget-1') || is_active_sidebar('footer-widget-2') || is_active_sidebar('footer-widget-3') || is_active_sidebar('footer-widget-4') || is_active_sidebar('footer-bottom') ) ) { ?>

		<div id="footer-widgets-container" class="footer-widgets-section">

			<div class="container">

				<div class="zozo-row row">

					<?php						

						$columns = gosolar_footer_widget_column_classes( 'yes', 'no' );

						$classes = gosolar_footer_widget_column_classes( 'no', 'yes' );

						

						for( $i = 1; $i <= intval( $columns ); $i++ ) { 

							$footer_sidebar  = '';

							$footer_sidebar 	= get_post_meta( $post_id, 'zozo_footer_sidebar_' . $i, true );

							

							if( isset( $footer_sidebar ) && $footer_sidebar == '' || $footer_sidebar == '0' ) {

								if( is_active_sidebar( 'footer-widget-' . $i ) ) { ?>

								<div id="footer-widgets-<?php echo esc_attr( $i ); ?>" class="footer-widgets <?php echo esc_attr( $classes[$i] ); ?>">

									<?php dynamic_sidebar( 'footer-widget-' . esc_attr( $i ) ); ?>

								</div>

								<?php }	

							} else {

								if( is_active_sidebar( $footer_sidebar ) ) { ?>

								<div id="footer-widgets-<?php echo esc_attr( $i ); ?>" class="footer-widgets <?php echo esc_attr( $classes[$i] ); ?>">

									<?php dynamic_sidebar( $footer_sidebar ); ?>

								</div>

								<?php }

							}

						} ?>

				</div><!-- .row -->

				<?php if ( is_active_sidebar( 'footer-bottom' ) ) { ?>

				<div class="zozo-row row">

					<div class="col col-md-12">

						<div id="footer-widgets-footer-bottom" class="footer-widgets footer-bottom">

							<?php dynamic_sidebar( 'footer-bottom' ); ?>

						</div> 

					</div>

				</div>

				<?php } ?>

			</div>

		</div><!-- #footer-widgets-container -->

		<?php }



	}

	

	add_action( 'gosolar_footer_section', 'gosolar_footer_section_widgets', 10 );

}



if ( ! function_exists( 'gosolar_footer_section_copyrightbar' ) ) {

	function gosolar_footer_section_copyrightbar() {

	

		$post_id = gosolar_get_post_id();

		

		$show_copyright_bar = '';

		$show_copyright_bar = get_post_meta( $post_id, 'zozo_show_copyright_bar', true );

		if( isset( $show_copyright_bar ) && $show_copyright_bar == '' || $show_copyright_bar == 'default' ) {

			$show_copyright_bar = gosolar_get_theme_option( 'zozo_copyright_bar_enable' );

			if( $show_copyright_bar == 1 ) {

				$show_copyright_bar = 'yes';

			} else {

				$show_copyright_bar = 'no';

			}

		}

		

		$show_footer_menu = '';

		$show_footer_menu = get_post_meta( $post_id, 'zozo_show_footer_menu', true );		

		if( isset( $show_footer_menu ) && $show_footer_menu == '' || $show_footer_menu == 'default' ) {

		    $show_footer_menu = gosolar_get_theme_option( 'zozo_enable_footer_menu' );

			if( $show_footer_menu == 1 ) {

				$show_footer_menu = 'yes';

			} else {

				$show_footer_menu = 'no';

			}

		}

		

		if( ( isset( $show_copyright_bar ) && $show_copyright_bar == 'yes' ) || ( isset( $show_footer_menu ) && $show_footer_menu == 'yes' ) ) { ?>

		<div id="footer-copyright-container" class="footer-copyright-section">

			<div class="container">

				<div class="zozo-row row">

					<div class="col col-sm-6 col-md-6 col-xs-12">

					<?php if( isset( $show_copyright_bar ) && $show_copyright_bar == 'yes' ) { 

						echo gosolar_footer_copyright();

					} ?>

					

					<?php if( isset( $show_footer_menu ) && $show_footer_menu == 'yes' ) { 

						echo gosolar_footer_menu_output();

					} ?>

					</div>

					<div class="col col-sm-6 col-md-6 col-xs-12">

						<?php if ( is_active_sidebar( 'footer-social-sidebar' ) ) { ?>

							

								<div id="footer-widgets-footer-social-sidebar" class="footer-widgets footer-social-sidebar">

									<?php dynamic_sidebar( 'footer-social-sidebar' ); ?>

								</div>

							

						<?php } ?>

					</div>

				</div>

			</div>

		</div><!-- #footer-copyright-container -->

		<?php }

		

	}

	

	add_action( 'gosolar_footer_section', 'gosolar_footer_section_copyrightbar', 20 );

}



if ( ! function_exists( 'gosolar_footer_copyright' ) ) {

	function gosolar_footer_copyright() {

		

		$copyright_output = '';

		

		if( gosolar_get_theme_option( 'zozo_footer_copyright_align' ) == 'center' ) {

			$copyright_class = "col-xs-12 text-center footer-copyright-center";

		} else {

			$copyright_class = "footer-copyright-left";

		}

	

		$copyright_output .= '<div id="copyright-text" class="'. esc_attr( $copyright_class ) .'">';

			if( gosolar_get_theme_option( 'zozo_copyright_text' ) ) {						

				$copyright_output .= '<p>'. do_shortcode( gosolar_get_theme_option( 'zozo_copyright_text' ) ) .'</p>';							

			} else {

				$copyright_output .= '<p>&copy; '. esc_html__('Copyright', 'gosolar') .' '. date('Y') .'. '. esc_html( bloginfo( 'name' ) ) .'. '. esc_html__('All rights reserved.', 'gosolar') .'</p>';

			}

		$copyright_output .= '</div>';

		

		return $copyright_output;

		

	}

}



if ( ! function_exists( 'gosolar_footer_menu_output' ) ) {

	function gosolar_footer_menu_output() {

		

		$footer_menu_output = '';

		

		if( gosolar_get_theme_option( 'zozo_footer_copyright_align' ) == 'center' ) {

			$menu_class = "col-xs-12 text-center footer-menu-center";

		} else {

			$menu_class = "col-sm-6 col-xs-12 footer-menu-left";

		}

		

		$footer_menu_output .= '<div class="footer-menu-wrapper '. $menu_class .'">';

		

			$footer_menu_output .= '<!-- ==================== Footer Menu ==================== -->';

			$footer_menu_output .= '<div class="hidden-xs">';

			$footer_menu_output .= wp_nav_menu( array( 'container_class' => 'zozo-nav footer-menu-navigation', 'container_id' => 'footer-nav', 'menu_id' => 'footer-menu', 'menu_class' => 'nav navbar-nav zozo-footer-nav', 'theme_location' => 'footer-menu', 'fallback_cb' => 'gosolar_wp_bootstrap_navwalker::fallback', 'walker' => new gosolar_wp_bootstrap_navwalker() ) );

			$footer_menu_output .= '</div>';

			

		$footer_menu_output .= '</div>';

		

		return $footer_menu_output;

		

	}

}
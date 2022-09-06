<?php
/**
 * Register widgetized areas
 */
if ( ! function_exists( 'gosolar_widgets_init' ) ) {
	function gosolar_widgets_init() {
	
	// Primary Sidebar
	    
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'gosolar' ),
		'id'            => 'primary',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description' 	=> esc_html__( 'The default sidebar used in two or three-column layouts.', 'gosolar' ),
	) );
	
	// Secondary Sidebar
	
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'gosolar' ),
		'id'            => 'secondary',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description' 	=> esc_html__( 'A secondary sidebar used in three-column layouts.', 'gosolar' ),
	) );
	
	
	// Services Sidebar
	
	register_sidebar( array(
		'name'          => esc_html__( 'Services Sidebar', 'gosolar' ),
		'id'            => 'services-widget',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description' 	=> esc_html__( 'A services sidebar used in one-column layouts.', 'gosolar' ),
	) );
	// Footer Widgets Sidebar
	$is_footer_widgets = '';
	$is_footer_widgets = gosolar_get_theme_option( 'zozo_footer_widgets_enable' ) ? gosolar_get_theme_option( 'zozo_footer_widgets_enable' ) : 0;	
	
	// Footer Top
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Top Area', 'gosolar' ),
		'id'            => 'footer-top',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description' 	=> esc_html__( 'A footer top area sidebar used in Footer top.', 'gosolar' ),
	) );
	
	if( $is_footer_widgets ) {
		
		$columns = '';
		$columns = 4;
		for ( $i = 1; $i <= intval( $columns ); $i++ ) {
		
			register_sidebar( array(
				'name'          => sprintf( esc_html__( 'Footer %d', 'gosolar' ), $i ),
				'id'            => sprintf( 'footer-widget-%d', $i ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'description'	=> sprintf( esc_html__( 'Footer widget Area %d.', 'gosolar' ), $i ),
			) );
				
		}
		
	}
	// Footer bootom Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Bottom Sidebar', 'gosolar' ),
		'id'            => 'footer-bottom',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description'  => esc_html__( 'A footer bottom sidebar used in one-column layouts.', 'gosolar' ),
	) );

	// Footer social Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Social Sidebar', 'gosolar' ),
		'id'            => 'footer-social-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description'  => esc_html__( 'A footer social sidebar used in one-column layouts.', 'gosolar' ),
	) );
	
	// Sliding Widgets Sidebar
	$sliding_widgets = '';
	$sliding_widgets = gosolar_get_theme_option( 'zozo_enable_sliding_bar' ) ? gosolar_get_theme_option( 'zozo_enable_sliding_bar' ) : 0;
	
	if( $sliding_widgets ) {
	
		$columns = '';
		$columns = gosolar_get_theme_option( 'zozo_sliding_bar_columns' );
		
		if ( ! $columns ) $columns = 3;
		for ( $i = 1; $i <= intval( $columns ); $i++ ) {
		
			register_sidebar( array(
				'name'          => sprintf( esc_html__( 'Sliding Bar Widget %d', 'gosolar' ), $i ),
				'id'            => sprintf( 'sliding-bar-%d', $i ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'description'	=> sprintf( esc_html__( 'Sliding Bar Widget Area %d.', 'gosolar' ), $i ),
			) );
				
		}
	}
	
	// Menu Sidebar
	
	register_sidebar( array(
		'name'          => esc_html__( 'Menu Sidebar', 'gosolar' ),
		'id'            => 'menu-widget',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description' 	=> esc_html__( 'A services sidebar used in one-column layouts.', 'gosolar' ),
	) );
		
	/**
	 * Woocommerce Sidebar
	 */
	if( class_exists('Woocommerce') ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'gosolar' ),
			'id'            => 'shop-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'description' 	=> esc_html__( 'Shop Sidebar to show your widgets on Shop Pages.', 'gosolar' ),
		) );
	}
		
	} // End gosolar_widgets_init()
}

add_action( 'widgets_init', 'gosolar_widgets_init' );  
?>
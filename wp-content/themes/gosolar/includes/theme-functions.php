<?php
/**
* Theme Functions
*/

/* ================================================
 * Add Navigation theme support and Register Menus
 * ================================================ */
 
if ( function_exists('wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 
		'primary-menu'	=> esc_html__( 'Primary Menu', 'gosolar' ),
		'primary-right'	=> esc_html__( 'Primary Right Menu', 'gosolar' ),
		'top-menu'		=> esc_html__( 'Top Bar Menu', 'gosolar' ),
		'mobile-menu'	=> esc_html__( 'Mobile Menu', 'gosolar' ),
		'footer-menu'	=> esc_html__( 'Footer Menu', 'gosolar' )
	) );
}

/* =========================================================
 * Main Layout Custom Classes
 * ========================================================= */
 
/**
 * Single Sidebar Container Classes works on all column layouts
 */ 
if ( ! function_exists( 'gosolar_content_sidebar_classes' ) ) { 

	function gosolar_content_sidebar_classes() {	
	
		global $post;
		$layout = $home_id = '';
		
		if( is_singular() ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );			
		}
		
		if( is_archive() ) {
			$layout = gosolar_get_theme_option( 'zozo_blog_archive_layout' );
		}
		
		if( is_home() ) {
			$home_id = get_option( 'page_for_posts' );
			$layout = get_post_meta( $home_id, 'zozo_layout', true );
			if( !$layout ) {
				$layout = gosolar_get_theme_option( 'zozo_blog_layout' );
			}
		}
		
		if ( is_singular( 'post' ) ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );
			if( !$layout ) {
				$layout = gosolar_get_theme_option( 'zozo_single_post_layout' );
			}			
		}
		
		if( !$layout ) {			
			if( gosolar_get_theme_option( 'zozo_layout' ) != '' ) {		
				$layout = gosolar_get_theme_option( 'zozo_layout' );
			}
			else {
				$layout = 'two-col-right';
			}
		}
			
		if( $layout == 'three-col-left' || $layout == 'three-col-middle' || $layout == 'three-col-right' ) {
			echo 'main-col-small';
		}
		else {
			echo 'main-col-full';
		}		
	}	
} 

/**
 * Primary Content Classes works on all column layouts
 */
if ( ! function_exists( 'gosolar_primary_content_classes' ) ) { 

	function gosolar_primary_content_classes() {	
	
		global $post;
		$sidebar_widget = $layout = $home_id = '';
		
		if( is_singular() ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );	
			$sidebar_widget = get_post_meta( $post->ID, 'zozo_primary_sidebar', true );		
		}
		
		if( is_archive() ) {
			$layout = gosolar_get_theme_option( 'zozo_blog_archive_layout' );
		}
		
		if( is_home() ) {
			$home_id = get_option( 'page_for_posts' );
			$layout = get_post_meta( $home_id, 'zozo_layout', true );
			if( !$layout ) {
				$layout = gosolar_get_theme_option( 'zozo_blog_layout' );
			}
			$sidebar_widget = get_post_meta( $home_id, 'zozo_primary_sidebar', true );
		}
		
		if ( is_singular( 'post' ) ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );
			if( !$layout ) {
				$layout = gosolar_get_theme_option( 'zozo_single_post_layout' );
			}		
			$sidebar_widget = get_post_meta( $post->ID, 'zozo_primary_sidebar', true );	
		}
		
		if( !$layout ) {			
			if( gosolar_get_theme_option( 'zozo_layout' ) != '' ) {		
				$layout = gosolar_get_theme_option( 'zozo_layout' );
			}
			else {
				$layout = 'two-col-right';
			}
		}
		
		if( $sidebar_widget == '' || $sidebar_widget == '0' ) {
			$sidebar_widget = 'primary';
		}
						
		if( $layout == 'three-col-left' || $layout == 'three-col-middle' || $layout == 'three-col-right' || $layout == 'two-col-left' || $layout == 'two-col-right' ) {
			if ( !is_active_sidebar( $sidebar_widget ) ) {	
				echo 'content-col-full';
			}else{
				echo 'content-col-small';
			}	
		}		
		elseif( $layout == 'one-col' ) {
			echo 'content-col-full';
		}
		
	}	
}

/**
 * Primary Sidebar Classes works on two-column and three-column layouts
 */
if ( ! function_exists( 'gosolar_primary_sidebar_classes' ) ) { 

	function gosolar_primary_sidebar_classes() {	
	
		global $post;
		$layout = $home_id = '';
		
		if( is_singular() ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );			
		}
		
		if( is_archive() ) {
			$layout = gosolar_get_theme_option( 'zozo_blog_archive_layout' );
		}
		
		if( is_home() ) {
			$home_id = get_option( 'page_for_posts' );
			$layout = get_post_meta( $home_id, 'zozo_layout', true );
			if( !$layout ) {
				$layout = gosolar_get_theme_option( 'zozo_blog_layout' );
			}
		}
		
		if ( is_singular( 'post' ) ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );
			if( !$layout ) {
				$layout = gosolar_get_theme_option( 'zozo_single_post_layout' );
			}			
		}
		
		if( !$layout ) {			
			if( gosolar_get_theme_option( 'zozo_layout' ) != '' ) {		
				$layout = gosolar_get_theme_option( 'zozo_layout' );
			}
			else {
				$layout = 'two-col-right';
			}
		}
				
		if( $layout == 'three-col-left' || $layout == 'three-col-middle' || $layout == 'three-col-right' || $layout == 'two-col-left' || $layout == 'two-col-right' ) {
			echo 'pm-sidebar';
		}		
	}	
} 

/**
 * Secondary Sidebar Classes works only on three-column layout
 */
if ( ! function_exists( 'gosolar_secondary_sidebar_classes' ) ) { 

	function gosolar_secondary_sidebar_classes() {	
	
		global $post;
		$layout = $home_id = '';
		
		if( is_singular() ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );			
		}
		
		if( is_archive() ) {
			$layout = gosolar_get_theme_option( 'zozo_blog_archive_layout' );
		}
		
		if( is_home() ) {
			$home_id = get_option( 'page_for_posts' );
			$layout = get_post_meta( $home_id, 'zozo_layout', true );
			if( !$layout ) {
				$layout = gosolar_get_theme_option( 'zozo_blog_layout' );
			}
		}
		
		if ( is_singular( 'post' ) ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );
			if( !$layout ) {
				$layout = gosolar_get_theme_option( 'zozo_single_post_layout' );
			}			
		}
		
		if( !$layout ) {			
			if( gosolar_get_theme_option( 'zozo_layout' ) != '' ) {		
				$layout = gosolar_get_theme_option( 'zozo_layout' );
			}
			else {
				$layout = 'two-col-right';
			}
		}
		
		if( $layout == 'three-col-left' || $layout == 'three-col-middle' || $layout == 'three-col-right' ) {
			echo 'sec-sidebar';
		}				
	}	
}

/**
 * Footer Widget Columns and Classes based on footer type
 */
if ( ! function_exists( 'gosolar_footer_widget_column_classes' ) ) { 

	function gosolar_footer_widget_column_classes( $column = 'no', $class = 'yes' ) {
	
		$post_id = gosolar_get_post_id();
		
		$footer_type = '';
		$footer_type = get_post_meta( $post_id, 'zozo_footer_type', true );
		if( isset( $footer_type ) && $footer_type == '' || $footer_type == 'default' ) {
			$footer_type = gosolar_get_theme_option( 'zozo_footer_type' );
		}
				
		$columns = '';
		$classes = array();
		
		switch( $footer_type ) {
			case 'footer-1':
				$columns = 4;
				$classes[1] = 'col-md-3 col-sm-6 col-xs-12';
				$classes[2] = 'col-md-3 col-sm-6 col-xs-12';
				$classes[3] = 'col-md-3 col-sm-6 col-xs-12';
				$classes[4] = 'col-md-3 col-sm-6 col-xs-12';
				break;
			case 'footer-2':
				$columns = 3;
				$classes[1] = 'col-sm-4 col-xs-12';
				$classes[2] = 'col-sm-4 col-xs-12';
				$classes[3] = 'col-sm-4 col-xs-12';
				break;
			case 'footer-3':
				$columns = 3;
				$classes[1] = 'col-sm-3 col-xs-12';
				$classes[2] = 'col-sm-6 col-xs-12';
				$classes[3] = 'col-sm-3 col-xs-12';
				break;
			case 'footer-8':
				$columns = 3;
				$classes[1] = 'col-sm-6 col-xs-12';
				$classes[2] = 'col-sm-3 col-xs-12';
				$classes[3] = 'col-sm-3 col-xs-12';
				break;
			case 'footer-4':
				$columns = 2;
				$classes[1] = 'col-sm-6 col-xs-12';
				$classes[2] = 'col-sm-6 col-xs-12';
				break;
			case 'footer-5':
				$columns = 2;
				$classes[1] = 'col-sm-9 col-xs-12';
				$classes[2] = 'col-sm-3 col-xs-12';
				break;
			case 'footer-6':
				$columns = 2;
				$classes[1] = 'col-sm-3 col-xs-12';
				$classes[2] = 'col-sm-9 col-xs-12';
				break;
			case 'footer-7':
				$columns = 1;
				$classes[1] = 'col-xs-12';
				break;
		}
		
		if( $column == 'yes' && $class == 'no' ) {
			return $columns;
		} elseif( $column == 'no' && $class == 'yes' ) {
			return $classes;
		} else {
			return array( $columns, $classes );
		}
				
	}
}


/* =========================================================
 * Display Social Icons
 * ========================================================= */
 
if ( ! function_exists( 'gosolar_display_social_icons' ) ) { 

	function gosolar_display_social_icons( $type = '' ) {
		
		$output = '';
		$social_links = array();
		
		if( $type == '' ) {
			$type = gosolar_get_theme_option( 'zozo_social_icon_type' );
		}
		
		if( $facebook_link = gosolar_get_theme_option( 'zozo_facebook_link' ) ) {
			$social_links['facebook'] = $facebook_link;
		}
		
		if( $twitter_link = gosolar_get_theme_option( 'zozo_twitter_link' ) ) {
			$social_links['twitter'] = $twitter_link;
		}
		
		if( $linkedin_link = gosolar_get_theme_option( 'zozo_linkedin_link' ) ) {
			$social_links['linkedin'] = $linkedin_link;
		}
		
		if( $pinterest_link = gosolar_get_theme_option( 'zozo_pinterest_link' ) ) {
			$social_links['pinterest'] = $pinterest_link;
		}
		
		if( $youtube_link = gosolar_get_theme_option( 'zozo_youtube_link' ) ) {
			$social_links['youtube'] = $youtube_link;
		}
		
		if( $rss_link = gosolar_get_theme_option( 'zozo_rss_link' ) ) {
			$social_links['rss'] = $rss_link;
		}
		
		if( $tumblr_link = gosolar_get_theme_option( 'zozo_tumblr_link' ) ) {
			$social_links['tumblr'] = $tumblr_link;
		}
		
		if( $reddit_link = gosolar_get_theme_option( 'zozo_reddit_link' ) ) {
			$social_links['reddit'] = $reddit_link;
		}
		
		if( $dribbble_link = gosolar_get_theme_option( 'zozo_dribbble_link' ) ) {
			$social_links['dribbble'] = $dribbble_link;
		}
		
		if( $digg_link = gosolar_get_theme_option( 'zozo_digg_link' ) ) {
			$social_links['digg'] = $digg_link;
		}
		
		if( $flickr_link = gosolar_get_theme_option( 'zozo_flickr_link' ) ) {
			$social_links['flickr'] = $flickr_link;
		}
		
		if( $instagram_link = gosolar_get_theme_option( 'zozo_instagram_link' ) ) {
			$social_links['instagram'] = $instagram_link;
		}
		
		if( $vimeo_link = gosolar_get_theme_option( 'zozo_vimeo_link' ) ) {
			$social_links['vimeo'] = $vimeo_link;
		}
		
		if( $skype_link = gosolar_get_theme_option( 'zozo_skype_link' ) ) {
			$social_links['skype'] = $skype_link;
		}
		
		if( $blogger_link = gosolar_get_theme_option( 'zozo_blogger_link' ) ) {
			$social_links['blogger'] = $blogger_link;
		}
		
		if( $yahoo_link = gosolar_get_theme_option( 'zozo_yahoo_link' ) ) {
			$social_links['yahoo'] = $yahoo_link;
		}
		
		$icon_class = '';
		$li_html = '';
		
		if( isset( $social_links ) && is_array( $social_links ) ) {
			foreach( $social_links as $icon => $link ) {
				$icon_class = $icon;
				
				if( $icon == 'vimeo' ) {
					$icon = 'flaticon flaticon-vimeo';
				} elseif( $icon == 'blogger' ) {
					$icon = 'flaticon flaticon-symbol';
				} else {
					$icon = 'fa fa-' . $icon;
				}
				
				$li_html .= '<li class="'.esc_attr( $icon_class ).'"><a target="_blank" href="'. $link .'"><i class="'.esc_attr( $icon ).'"></i></a></li>';
			}
		}
		
		if( isset( $li_html ) && $li_html != '' ) {
			$output = '<ul class="zozo-social-icons soc-icon-'.$type.'">';
			$output .= $li_html;
			$output .= '</ul>';
		}
				
		return $output;
	}	
} 

/* =========================================================
 * Get Post Gallery Images in Slider
 * ========================================================= */

function gosolar_get_gallery_post_images($size, $id, $echo = 'yes') {

	if( !$size ) 
		$size = 'full';
	
	$output = '';
	
	if($images = get_posts(array(
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image',
		'orderby'        => 'title',
		'order' 		 => 'ASC',
	))) {
		foreach($images as $image) {
		
			$posts_image   = wp_get_attachment_image($image->ID,$size);
			
			$posts_image_link = wp_get_attachment_image_src($image->ID, 'full');
			
			if( isset( $echo ) && $echo == 'no' ) {
				$output .= '<div class="blog-gallery-item"><a href="'.esc_url($posts_image_link[0]).'" data-rel="prettyPhoto[gallery'.esc_attr( $id ).']">' . $posts_image . '</a></div>';
			} else {
				echo '<div class="blog-gallery-item"><a href="'.esc_url($posts_image_link[0]).'" data-rel="prettyPhoto[gallery'.esc_attr( $id ).']">' . $posts_image . '</a></div>';
			}

		}
		
		if( isset( $echo ) && $echo == 'no' ) {
			return $output;
		}
	}
}

/* =========================================================
 * Display Social Sharing Icons in Blog Posts
 * ========================================================= */
 
if ( ! function_exists( 'gosolar_display_social_sharing_icons' ) ) { 

	function gosolar_display_social_sharing_icons( $echo = 'yes' ) {
	
		global $post;
		
		$output = '';
				
		if( gosolar_get_theme_option( 'zozo_sharing_facebook' ) ) {
			$output .= '<li class="facebook"><a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u='.urlencode(get_permalink()).'" title="facebook"><i class="fa fa-facebook"></i></a></li>';
		}		
		
		if( gosolar_get_theme_option( 'zozo_sharing_twitter' ) ) {
			$output .= '<li class="twitter"><a target="_blank" href="https://twitter.com/home?status='.urlencode($post->post_title). '%20-%20' . urlencode(get_permalink()).'" title="twitter"><i class="fa fa-twitter"></i></a></li>';
		}
		
		if( gosolar_get_theme_option( 'zozo_sharing_linkedin' ) ) {
			$output .= '<li class="linkedin"><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title()).'"><i class="fa fa-linkedin"></i></a></li>';
		}
		
		if( gosolar_get_theme_option( 'zozo_sharing_pinterest' ) ) {
			$share_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
			$output .= '<li class="pinterest"><a target="_blank" href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&amp;description='.urlencode($post->post_title).'&amp;media='.urlencode($share_image[0]).'"><i class="fa fa-pinterest"></i></a></li>';
		}
		
		if( gosolar_get_theme_option( 'zozo_sharing_tumblr' ) ) {
			if( has_post_format('quote') ) {
				$output .= '<li class="tumblr"><a target="_blank" href="http://www.tumblr.com/share/quote?quote='.urlencode(get_the_content()).'&amp;source='.urlencode($post->post_title).'"><i class="fa fa-tumblr"></i></a></li>';
			}
			else {
				$output .= '<li class="tumblr"><a target="_blank" href="http://www.tumblr.com/share/link?url='.urlencode(get_permalink()).'&amp;name='.urlencode($post->post_title).'&amp;description='.urlencode(get_the_excerpt()).'"><i class="fa fa-tumblr"></i></a></li>';
			}
		}
		
		if( gosolar_get_theme_option( 'zozo_sharing_reddit' ) ) {
			$output .= '<li class="reddit"><a target="_blank" href="http://reddit.com/submit?url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title()).'"><i class="fa fa-reddit"></i></a></li>';
		}
		
		if( gosolar_get_theme_option( 'zozo_sharing_digg' ) ) {
			$output .= '<li class="digg"><a target="_blank" href="http://digg.com/submit?url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title()).'"><i class="fa fa-digg"></i></a></li>';
		}
		
		if( gosolar_get_theme_option( 'zozo_sharing_email' ) ) {
			$output .= '<li class="email"><a target="_blank" href="mailto:?subject='.urlencode(get_the_title()).'&amp;body='.urlencode(get_permalink()).'"><i class="fa fa-envelope"></i></a></li>';
		}
		
		if( isset( $output ) && $output != '' ) {
			if( isset( $echo ) && $echo == 'yes' ) {
				echo '<div class="zozo-social-share-box"><ul class="zozo-social-share-icons share-box">';
				echo wp_kses_post( $output );
				echo '</ul></div>';
			} 
			else if( isset( $echo ) && $echo == 'no' ) {
				$return_output = '';
				
				$return_output = '<div class="zozo-social-share-box"><ul class="zozo-social-share-icons share-box">';
				$return_output .= $output;
				$return_output .= '</ul></div>';
				
				return $return_output;
			}
		}
	}	
}

/* =========================================================
 * Display Pagination on Archive/Category and Index Pages
 * ========================================================= */
 
if ( ! function_exists( 'gosolar_pagination' ) ) { 

	function gosolar_pagination( $pages = '', $scroll = '', $paged = '' ) {
		
		global $wp_query, $wp_rewrite;
		
		$output = '';
				
		$extra_class = '';
		if( $scroll == "infinite" ) {
			$extra_class = ' infinite-scroll';
		} else {
			$extra_class = ' scroll-pagination';
		}
		
		$pages = ($pages) ? $pages : $wp_query->max_num_pages;

		// Don't print empty markup if there's only one page.
		if ( $pages < 2 ) {
			return;
		}

		//$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		if( $paged == '' ) {
			$paged 		= get_query_var( 'paged' ) ? get_query_var( 'paged' ) : (isset($wp_query->query['paged']) ? $wp_query->query['paged'] : 1);
		}
		
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );
		
		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}
	
		$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
	
		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';
		
		// Arrows with RTL support
		$enable_rtl_mode = gosolar_get_theme_option( 'zozo_enable_rtl_mode' );
		$isRTL = 0;
		if( is_rtl() || ( isset( $enable_rtl_mode ) && $enable_rtl_mode == 1 ) || isset( $_GET['RTL'] ) ) {
			$isRTL = 1;
		}
		
		$prev_arrow = $isRTL ? 'fa fa-angle-right' : 'fa fa-angle-left';
		$next_arrow = $isRTL ? 'fa fa-angle-left' : 'fa fa-angle-right';
		
		// Set up paginated links.
		$links = paginate_links( array(
			'base'     				=> $pagenum_link,
			'format'   				=> $format,
			'total'    				=> $pages,
			'current'  				=> $paged,
			'show_all' 				=> false,
			'mid_size' 				=> 1,
			'type' 					=> 'array',
			//'add_args' 				=> array_map( 'urlencode', $query_args ),
			'add_args'           	=> false,
			'prev_text' 			=> '<i class="'. $prev_arrow .'"></i>',
			'next_text' 			=> '<i class="'. $next_arrow .'"></i>',
		) );

		if ( !empty($links) ) {
			$output .= '<ul class="pagination' . esc_attr( $extra_class ) . '">';
			foreach( $links as $link ) {
				$output .= '<li>'.$link.'</li>';
			}
			$output .= '</ul>';
		}
				
		return $output; 
	}
}

/* =========================================================
 * Display Post Navigation on Single Posts
 * ========================================================= */

if( ! function_exists( 'gosolar_postnavigation' ) ) {
	function gosolar_postnavigation() { 
		if ( is_single() ) { 
		?>
	        <div class="post-navigation">
				<ul class="pager">
					<li class="previous"><?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i> %title' ) ?></li>
					<li class="next"><?php next_post_link( '%link', '%title <i class="fa fa-angle-right"></i>' ) ?></li>
				</ul>	            
	        </div>	
		<?php 
		}
	}
}

/* =========================================================
 * Display Comments in different Layout
 * ========================================================= */
 
if( ! function_exists( "gosolar_custom_comments" ) ) {

	function gosolar_custom_comments( $comment, $args, $depth ) {
	   $GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">	    		      	
	      	<div id="li-comment-<?php comment_ID() ?>" class="comment-container media">
				
				<div class="comment-avatar media-left">
					<?php echo get_avatar($comment, $args['avatar_size']); ?>
				</div>

				<div class="comment-status-text media-body" id="comment-<?php comment_ID(); ?>">
					<?php comment_text() ?>
					<?php if ($comment->comment_approved == '0') { ?>
						<p class='comment-unapproved'><?php esc_html_e('Your comment is awaiting moderation.', 'gosolar'); ?></p>
					<?php } ?>
					<div class="comments-box">
						<div class="comment-list meta">
							<span class="author-name"><i class="fa fa-user"></i> <?php echo get_comment_author_link() ?></span>
							<span class="date"><i class="fa fa-calendar"></i><?php printf(__('%1$s', 'gosolar'), get_comment_date() ) ?></span>								
						</div>
					</div><!-- .comments-box -->
					<div class="reply">
						<span class="edit"><?php edit_comment_link( esc_html__('Edit', 'gosolar'), '<i class="fa fa-edit"></i>', ''); ?></span>	
						<span class="reply-link"><?php comment_reply_link(array_merge( $args, array('reply_text' => esc_html__('Reply', 'gosolar'), 'depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '<i class="fa fa-comments"></i>'))) ?></span>
					</div>
				</div><!-- .comment-status-text -->

			</div><!-- .comment-container -->
			
	<?php 
	}	
}

/* =========================================================
 * Display Author Info on Single Post pages
 * ========================================================= */
 
if( ! function_exists( "gosolar_author_info" ) ) {

	function gosolar_author_info() { 
		if( is_author() ) {
		
			$author_id = get_the_author_meta('ID');
			$author_name = get_the_author_meta('display_name', $author_id);			
			$author_description  = get_the_author_meta('description', $author_id); 
			
			?>
			
			<div class="author-info-page">
				<div class="author-avatar">
					<?php echo get_avatar(get_the_author_meta('email', $author_id), '80'); ?>
				</div>
				<div class="author-title">
					<h4><?php esc_html_e('About', 'gosolar'); ?> <span class="author-name"><?php echo esc_html($author_name); ?></span></h4>
				</div>
			  	<div class="author-description">
					<p>
					<?php if( !$author_description ) {
						echo sprintf( esc_html__( 'This author %s has created %s entries.', 'gosolar' ), $author_name, count_user_posts( $author_id ) );
					} else {
						echo esc_html($author_description);
					} ?>
					</p>
				</div>
				<div class="author-links">						
					<div class="author-media-links zozo-social-share-box">
						<ul class="author-social zozo-social-share-icons clearfix">
							<?php $facebook_profile = get_the_author_meta( 'facebook_profile' );
								if( isset($facebook_profile) && $facebook_profile != '' ) {
									echo '<li class="facebook"><a href="' . esc_url($facebook_profile) . '" target="_blank" ><i class="fa fa-facebook"></i></a></li>';
								}
												
								$twitter_profile = get_the_author_meta( 'twitter_profile' );
								if( isset($twitter_profile) && $twitter_profile != '' ) {
									echo '<li class="twitter"><a href="' . esc_url($twitter_profile) . '" target="_blank" ><i class="fa fa-twitter"></i></a></li>';
								}
																					
								$linkedin_profile = get_the_author_meta( 'linkedin_profile' );
								if( isset($linkedin_profile) && $linkedin_profile != '' ) {
									echo '<li class="linkedin"><a href="' . esc_url($linkedin_profile) . '" target="_blank" ><i class="fa fa-linkedin"></i></a></li>';
								}
								
								$mail = get_the_author_meta('email');
								if( isset($mail) && $mail != '' ) {
									echo '<li class="email"><a href="mailto:' . $mail . '" rel="author" target="_blank"><i class="fa fa-envelope"></i></a></li>';
								}
							?>
						</ul>
					</div>
				</div>					
			</div>
		<?php }	else { 
		
				$author_id = get_the_author_meta('ID');
				$author_description  = get_the_author_meta('description', $author_id); 
				if( $author_description != '' ) :
		?>
				<div class="author-info clearfix">				
					<div class="author-info-container">
						<div class="author-avatar">
							<?php echo get_avatar(get_the_author_meta('email'), '80'); ?>
						</div>
						<div class="author-title">						
							<h4 class="author-name"><?php the_author_posts_link(); ?></h4>
						</div>
						<div class="author-description">
							<p><?php the_author_meta("description"); ?></p>
						</div>
					</div>
				</div>
		<?php 
				endif;
			}
	}	
}

/* =========================================================
 * Get FontAwesome Icons Array
 * ========================================================= */
if ( ! function_exists( 'gosolar_get_fontawesome_icon_array' ) ) {
	function gosolar_get_fontawesome_icon_array() {
	
		$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$fontawesome_path = GOSOLAR_THEME_URL . '/css/gosolar-font-awesome.css';
		
		$response = wp_remote_get( $fontawesome_path );
		if( is_array($response) ) {
			$subject = $response['body']; // use the content
		}
		
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		
		$icons = array();
		
		foreach($matches as $match){
			$icons[$match[1]] = $match[2];
		}
		
		return $icons;
		
	}
}

/* =========================================================
 * Get Glyphicons Array
 * ========================================================= */
if ( ! function_exists( 'gosolar_get_glyphicons_array' ) ) {
	function gosolar_get_glyphicons_array() {
	
		$pattern = '/\.(glyphicon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$glyphicon_path = GOSOLAR_THEME_URL . '/css/gosolar-bootstrap.css';
		
		$response = wp_remote_get( $glyphicon_path );
		if( is_array($response) ) {
			$subject = $response['body']; // use the content
		}
		
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		
		$icons = array();
		
		foreach($matches as $match){
			$icons[$match[1]] = $match[2];
		}
		
		return $icons;
		
	}
}

/* =========================================================
 * Get Taxonomies List array for any post type
 * ========================================================= */
if ( ! function_exists( 'gosolar_get_taxonomy_terms_array' ) ) {
	function gosolar_get_taxonomy_terms_array($taxonomy, $post_type, $msg) {
	
		$list_groups = get_categories('taxonomy='.$taxonomy.'&post_type='.$post_type.'');
		$groups_list[0] = $msg;
		if( !empty($list_groups) ) {
			foreach ($list_groups as $groups) {
				$group_name = $groups->name;
				$termid = $groups->term_id;		
				$groups_list[$termid] = $group_name;
			}
		}
	
		if( isset($groups_list) ) {
			return $groups_list;
		}
		
	}
}

/* =========================================================
 * Update Post Views Count to find Popular Posts
 * ========================================================= */
if ( ! function_exists( 'gosolar_set_post_views_count' ) ) {
	function gosolar_set_post_views_count() {
		global $post;
	
		if('post' == get_post_type() && is_single()) {
			$post_id = $post->ID;
	
			if(!empty($post_id)) {
				$count_key = 'zozo_post_views_count';
				$count = get_post_meta($post_id, $count_key, true);

				if($count == '') {
					$count = 0;
					delete_post_meta($post_id, $count_key);
					add_post_meta($post_id, $count_key, '0');
				} else {
					$count++;
					update_post_meta($post_id, $count_key, $count);
				}
			}
		}
	}
}
add_action('wp_head', 'gosolar_set_post_views_count');

/* ==================================================================
 * Add Current Category Class to Categories List on Single Post
 * ================================================================== */
if ( ! function_exists( 'gosolar_current_cat_on_single_posts' ) ) {

	function gosolar_current_cat_on_single_posts($output) {
		global $post;
		
		if(is_single()) {
			$categories = wp_get_post_categories($post->ID);			
			if($categories) { 
				foreach($categories as $value) {
					if(preg_match('#item-' . $value . '">#', $output)) {
						$output = str_replace('item-' . $value . '">', 'item-' . $value . ' current-cat">', $output);
					}
				}
			}
		}
		return $output;
	}
	
}
add_filter('wp_list_categories', 'gosolar_current_cat_on_single_posts');


/* =========================================================
 * Get current ID
 * ========================================================= */ 

function gosolar_get_the_id() {

	// If singular get_the_ID
	if ( is_singular() ) {
		return get_the_ID();
	}
	// Posts page
	elseif( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
		return $page_for_posts;
	}
	else {
		return NULL;
	}
	
}

/* =========================================================
 * Get RGB values from Hexadecimal
 * ========================================================= */ 
 
function gosolar_hex2rgb($hex) {

   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   
   $rgb = array($r, $g, $b);
   
   return $rgb;
}

/* =========================================================
 * Lightens/darkens a given colour (hex format)
 * $percent ( 0.4 = lighten by 40%, -0.4 = darken by 40% )
 * ========================================================= */
 
function gosolar_color_luminance( $hex, $percent ) {
	
	// validate hex string
	$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
	$new_hex = '#';

	if( strlen( $hex ) < 6 ) {
		$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
	}

	// convert to decimal and change luminosity
	for( $i = 0; $i < 3; $i++ ) {
		$dec = hexdec( substr( $hex, $i*2, 2 ) );
		$dec = min( max( 0, $dec + $dec * $percent ), 255 ); 
		$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
	}		

	return $new_hex;
}

/* ==================================================================
 * Parallax Menu Links Creation
 * ================================================================== */
if ( ! function_exists( 'gosolar_get_parallax_link' ) ) {
	function gosolar_get_parallax_link( $item ) {
		global $wp_query;		
		$post_data = $link = $item_object_id = '';
	   
		// Front and Blog page
		$blog_page_id 	= get_option('page_for_posts');
		$front_page_id 	= get_option('page_on_front');
		
		// Get URL
		if( !is_page_template( 'template-parallax-page' ) ) {
			$blog_url = esc_url( home_url() ) . '/';
		} else {
			$blog_url = '';
		}
		
		$front_url   = is_front_page() ? esc_url( $blog_url ) . '#section-top' : esc_url( home_url() ) . '/' ;        
		if ( !empty( $item->object_id ) ) {
			$post_data = get_post($item->object_id);						$post_meta_data = get_post_meta($item->object_id);
			$item_object_id = $item->object_id;
		}
		
		$slug = ( isset($post_data->post_name) ) ? $post_data->post_name : '';
		
		// Regular link for blog - all other menu items are anchors		
		if( $blog_page_id == $item_object_id || $item->zozo_megamenu_menutype == 'page' ) {			
			$link = ! empty( $item->url ) ? esc_attr( $item->url ) : '';
		} 
		// Regular link for the front page or an anchors
		elseif( $front_page_id == $item_object_id ) {			
			// Front page
			if( is_front_page() ) {				
				$link = ! empty( $item->url ) ? esc_url( $blog_url ) . '#section-top' : '';
			} else {
				// Regular link				
				$link = ! empty( $item->url ) ? esc_attr( $item->url ) : '';	
			}
			
		} else {					
			if( $item->zozo_megamenu_menutype == 'section' ) {
				$link = ! empty( $slug ) ? esc_url( $blog_url ) .  esc_attr( $item->url ) : '';
				
			} else {
				$link = ! empty( $item->url ) ? esc_attr( $item->url ) : '';
			}			
		}
		
		return $link;
		
	}
	
}

/* ==================================================================
 * Parallax Custom Query
 * ================================================================== */
if ( ! function_exists( 'gosolar_parallax_front_query' ) ) {

	function gosolar_parallax_front_query() {
	
		$pages_query = array();
		
		$zozo_menu_items = '';
			
		// Check for primary navigation
		if( has_nav_menu( 'primary-menu' ) ) {
			
			// Primary navigation ID
			$zozo_menu_theme_locations = get_nav_menu_locations();
			$zozo_menu_objects = get_term( $zozo_menu_theme_locations['primary-menu'] , 'nav_menu' );
			$zozo_menu_id = $zozo_menu_objects->term_id;
		
			$menu_args = array(
				'orderby' => 'menu_order'
			);
			
			$zozo_menu_items = wp_get_nav_menu_items( $zozo_menu_id , $menu_args );			
				
			// Create array of query for query_posts()
			foreach( (array) $zozo_menu_items as $key => $zozo_menu_item ) {
				
				$blog_page_id = get_option('page_for_posts');
				$front_page_id = get_option('page_on_front');
	
				if( $zozo_menu_item->zozo_megamenu_menutype == 'section' && $blog_page_id != $zozo_menu_item->object_id ) {						
					$pages_query[] = $zozo_menu_item->object_id;					
				}
				
			}
				
			// Return query
			if( !empty( $pages_query ) ) {
					
				// Query Args
				$zozo_query = array(						
						'post_type' 		=> 'page',
						'post__in' 			=> $pages_query,
						'posts_per_page' 	=> count($pages_query),
						'orderby'			=> 'post__in'				
				);
				
				return $zozo_query;

			} else {			
				return array();				
			}				
		}
	
	}
}

/* ==================================================================
 * Parallax Additional Sections Query
 * ================================================================== */
if ( ! function_exists( 'gosolar_parallax_additional_query' ) ) {

	function gosolar_parallax_additional_query( $ids ) {
	
		$additional_query = array();
		
		$query_ids = explode(',', $ids);
				
		// Create array of query for WP_Query()
		foreach( (array) $query_ids as $id => $value ) {
			
			$blog_page_id = get_option('page_for_posts');
			$front_page_id = get_option('page_on_front');
	
			if( $blog_page_id != $value && $front_page_id != $value ) {
				$additional_query[] = $value;
			}
			
		}
				
		// Return query
		if( !empty( $additional_query ) ) {
				
			// Query Args
			$zozo_additional_query = array(						
					'post_type' 		=> 'page',
					'post__in' 			=> $additional_query,
					'posts_per_page' 	=> count($additional_query),
					'orderby'			=> 'post__in'				
			);
			
			return $zozo_additional_query;

		} else {			
			return array();				
		}
	
	}
}

/* =============================================================
 *	Mailchimp Functions
 * ============================================================= */

// Calls the MailChimp API	
function gosolar_call_api( $method, array $data = array() ) {

	if( gosolar_get_theme_option( 'zozo_mailchimp_api' ) != '' ) {
		$data['apikey'] = gosolar_get_theme_option( 'zozo_mailchimp_api' );
	}
	
	// If api key is empty do not make request
	if( empty( $data['apikey'] ) ) { 
		return false; 
	}
	
	$get_key = explode( '-', $data['apikey'] );
	
	// Store Api URL
	if( strpos( $data['apikey'], '-' ) !== false ) {
		$api_url = 'https://' . $get_key[1] . '.api.mailchimp.com/2.0/';
	}
	
	$url = $api_url . $method . '.json';

	$response = wp_remote_post( $url, array(
		'body' => $data,
		'timeout' => 15,
		'headers' => array('Accept-Encoding' => ''),
		'sslverify' => false
		)
	);	
	
	$body = wp_remote_retrieve_body( $response );
	return json_decode( $body );
}

// Gets the lists for the current API Key
function gosolar_get_mailing_lists() {
	
	$args = array(
		'limit' => 20
	);	
	
	// Pings the MailChimp API
	$connection_result = gosolar_call_api( 'helper/ping' );

	if( $connection_result !== false ) {
		if( isset( $connection_result->msg ) && $connection_result->msg === "Everything's Chimpy!" ) {
		} elseif( isset( $connection_result->error ) ) {
			return false;
		}
	} 
	
	// Get Lists from MailChimp for Current API
	$result = gosolar_call_api( 'lists/list', $args );

	if( is_object( $result ) && isset( $result->data ) ) {
		return $result->data;
	}

	return false;
}

// Gets formated mailing lists in an array
function gosolar_get_mailing_lists_format() {
	
	$new_key = $old_mc_api_key = '';

	if( gosolar_get_theme_option( 'zozo_mailchimp_api' ) != '' ) {
		$new_key = gosolar_get_theme_option( 'zozo_mailchimp_api' );
	}
	
	$old_mc_api_key  = get_transient( 'zozo_mailchimp_api_key_feed' );
	
	if( $old_mc_api_key != $new_key ) {
		// store api key in transients
		delete_transient( 'zozo_mailchimp_api_key_feed' );
		set_transient( 'zozo_mailchimp_api_key_feed', $new_key, ( 24 * 3600 ) );
		delete_transient( 'zozo_mailchimp_lists' );
	}
	
	$cached_mc_lists = get_transient( 'zozo_mailchimp_lists' );
	
	if( false === $cached_mc_lists || empty( $cached_mc_lists ) ) {
		$get_lists = gosolar_get_mailing_lists();
		
		if( is_array( $get_lists ) ) {

			$lists = array();
			foreach( $get_lists as $list ) {	
				$lists["{$list->id}"] = (object) array(
					'id' => $list->id,
					'name' => $list->name								
				);
			}
			// store lists in transients
			set_transient( 'zozo_mailchimp_lists', $lists, ( 24 * 3600 ) ); // 1 day
		}
	} else {
		$lists = get_transient( 'zozo_mailchimp_lists' );		
	}
	
	$mailist = array();
	if( !empty( $lists ) ) {
		foreach( $lists as $list ) {
			$name = $list->name;
			$id = $list->id;		
			$mailist[$name] = $id;
		}
	}
	
	if( isset($mailist) ) {
		return $mailist;
	}

	return false;
}

// Get WordPress Current Page URL
function gosolar_get_current_url() {
	global $wp;
	$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
	return esc_url( $current_url );
}

// Sends subscription request to the MailChimp API
function gosolar_mc_subscribeformat( $email, $merge_vars, $mc_list_id ) {		
			
	$subscribe_result = gosolar_mc_subscribe( $mc_list_id, $email, $merge_vars, 'html', true );
	
	return $subscribe_result;
	
}

function gosolar_mc_subscribe( $list_id, $email, array $merge_vars = array(), $email_type = 'html', $double_optin = true, $update_existing = false, $replace_interests = true, $send_welcome = false )	{
	
	$data = array(
		'id' => $list_id,
		'email' => array( 'email' => $email ),
		'merge_vars' => $merge_vars,
		'email_type' => $email_type,
		'double_optin' => $double_optin,
		'update_existing' => $update_existing,
		'replace_interests' => $replace_interests,
		'send_welcome' => $send_welcome
	);

	$result = gosolar_call_api( 'lists/subscribe', $data );

	if( is_object( $result ) ) {

		if( ! isset( $result->error ) ) {		               
			$mailchimp_success_msg = gosolar_get_theme_option( 'zozo_mailchimp_success_message_api' ); 
			return $mailchimp_success_msg;
		} else {

			// Check subscription Error
			if( (int) $result->code === 214 ) {				
				$mailchimp_subscription_error_msg = gosolar_get_theme_option( 'zozo_mailchimp_subscription_error_message_api' ); 
				return $mailchimp_subscription_error_msg;
			} 
		
			// Get Error Message
			$error_message = $result->error;			
			$mailchimp_error_msg = gosolar_get_theme_option( 'zozo_mailchimp_error_message_api' ); 			
			return $mailchimp_error_msg;			
		}

	}
	
	$mailchimp_error_msg = gosolar_get_theme_option( 'zozo_mailchimp_error_message_api' ); 	
	return $mailchimp_error_msg;
}

/* =========================================================
 * Mailchimp Form Submit on AJAX
 * ========================================================= */

add_action('wp_ajax_zozo_mailchimp_subscribe', 'gosolar_mailchimp_subscribe_user');
add_action('wp_ajax_nopriv_zozo_mailchimp_subscribe', 'gosolar_mailchimp_subscribe_user');

if( ! function_exists( "gosolar_mailchimp_subscribe_user" ) ) {

	function gosolar_mailchimp_subscribe_user() {
	   		
		$mailing_list = '';
		$merge_vars = array();
		
		// Get Mailing List ID value from submitted form		
		$mailing_list = trim($_POST['zozo_mc_form_list']);
				
		// Get Email id from submitted form
		$email = trim($_POST['subscribe_email']);
		
		$list_result = gosolar_mc_subscribeformat( $email, $merge_vars, $mailing_list );
		
		$msg_array = array( 'data' => $list_result );
		echo json_encode($msg_array);
		
		die();
	}
	
}

/* =============================================================
 *	Related Portfolio Slider
 * ============================================================= */ 

if( ! function_exists( 'gosolar_related_portfolio_slider' ) ) {
	function gosolar_related_portfolio_slider() {
	
		global $post;
		
		$items = $items_scroll = $itemstablet = $itemsmobileland = $itemsmobile = $pagination = $navigation = $margin = $autoplay = $duration = $loop = '';
		
		if( gosolar_get_theme_option( 'zozo_portfolio_citems' ) != '' ) {
			$items = gosolar_get_theme_option( 'zozo_portfolio_citems' );
		} else {
			$items = 3;
		}
		
		if( gosolar_get_theme_option( 'zozo_portfolio_citems_scroll' ) != '' ) {
			$items_scroll = gosolar_get_theme_option( 'zozo_portfolio_citems_scroll' );
		} else {
			$items_scroll = 1;
		}
		
		if( gosolar_get_theme_option( 'zozo_portfolio_ctablet' ) != '' ) {
			$itemstablet = gosolar_get_theme_option( 'zozo_portfolio_ctablet' );
		} else {
			$itemstablet = 2;
		}
		
		if( gosolar_get_theme_option( 'zozo_portfolio_cmobile_land' ) != '' ) {
			$itemsmobileland = gosolar_get_theme_option( 'zozo_portfolio_cmobile_land' );
		} else {
			$itemsmobileland = 2;
		}
		
		if( gosolar_get_theme_option( 'zozo_portfolio_cmobile' ) != '' ) {
			$itemsmobile = gosolar_get_theme_option( 'zozo_portfolio_cmobile' );
		} else {
			$itemsmobile = 1;
		}
		
		if( gosolar_get_theme_option( 'zozo_portfolio_cpagination' ) == 1 ) {
			$pagination = "true";
		} else {
			$pagination = "false";
		}
		
		if( gosolar_get_theme_option( 'zozo_portfolio_cnavigation' ) == 1 ) {
			$navigation = "true";
		} else {
			$navigation = "false";
		}
		
		if( gosolar_get_theme_option( 'zozo_portfolio_cmargin' ) != '' ) {
			$margin = gosolar_get_theme_option( 'zozo_portfolio_cmargin' );
		} else {
			$margin = 20;
		}
		
		if( gosolar_get_theme_option( 'zozo_portfolio_cautoplay' ) == 1 ) {
			$autoplay = "true";
		} else {
			$autoplay = "false";
		}
		
		if( gosolar_get_theme_option( 'zozo_portfolio_ctimeout' ) != '' ) {
			$duration = gosolar_get_theme_option( 'zozo_portfolio_ctimeout' );
		} else {
			$duration = 5000;
		}
		
		if( gosolar_get_theme_option( 'zozo_portfolio_cloop' ) == 1 ) {
			$loop = "true";
		} else {
			$loop = "false";
		}
		
		$data_attr = $image_size = '';
	
		if( isset( $items ) && $items == "1" ) {

			$image_size = 'full';
		} else {
			$image_size = 'gosolar-portfolio-mid';
		}
		
		if( isset( $items ) && $items != '' ) {
			$data_attr .= ' data-items="' . $items . '" ';
		}
		
		if( isset( $items_scroll ) && $items_scroll != '' ) {
			$data_attr .= ' data-slideby="' . $items_scroll . '" ';
		}
		
		if( isset( $itemstablet ) && $itemstablet != '' ) {
			$data_attr .= ' data-items-tablet="' . $itemstablet . '" ';
		}
		
		if( isset( $itemsmobileland ) && $itemsmobileland != '' ) {
			$data_attr .= ' data-items-mobile-landscape="' . $itemsmobileland . '" ';
		}
		
		if( isset( $itemsmobile ) && $itemsmobile != '' ) {
			$data_attr .= ' data-items-mobile-portrait="' . $itemsmobile . '" ';
		}
		
		if( isset( $autoplay ) && $autoplay != '' ) {
			$data_attr .= ' data-autoplay="' . $autoplay . '" ';
		}
		if( isset( $duration ) && $duration != '' ) {
			$data_attr .= ' data-autoplay-timeout="' . $duration . '" ';
		}
		
		if( isset( $loop ) && $loop != '' ) {
			$data_attr .= ' data-loop="' . $loop . '" ';
		}
		
		if( isset( $margin ) && $margin != '' ) {
			$data_attr .= ' data-margin="' . $margin . '" ';
		}
		
		if( isset( $pagination ) && $pagination != '' ) {
			$data_attr .= ' data-pagination="' . $pagination . '" ';
		}
		if( isset( $navigation ) && $navigation != '' ) {
			$data_attr .= ' data-navigation="' . $navigation . '" ';
		}
		
		$item_cats = get_the_terms( $post->ID, 'portfolio_tags' );
		
		$item_array = array();
		if( $item_cats ) {
			foreach( $item_cats as $item_cat ) {
				$item_array[] = $item_cat->term_id;
			}
		}
		
		if( $item_cats ) {
		
			$args = array(
				'post__not_in'   	=> array($post->ID),
				'posts_per_page' 	=> -1,
				'post_type'  		=> 'zozo_portfolio',
				'orderby' 			=> 'date',
				'order' 		 	=> 'DESC',
				'tax_query' => array(
							array(
								'field' 	=> 'id',
								'taxonomy' 	=> 'portfolio_tags',
								'terms' 	=> $item_array,
							)
				)
		    );
						
			$portfolio_slider_query = new WP_Query($args);
			
			if( $portfolio_slider_query->have_posts() ) { ?>
				<div class="related-portfolio-slider-section">	
					<!-- ============ Section Header ============ -->
					<div class="zozo-parallax-header">
						<div class="parallax-header">
						<?php if( gosolar_get_theme_option( 'zozo_portfolio_related_title' ) != '' ) { ?>
							<h2 class="parallax-title"><?php echo esc_html( gosolar_get_theme_option( 'zozo_portfolio_related_title' ) ); ?></h2>
						<?php } else { ?>
							<h2 class="parallax-title"><?php esc_html_e( 'Related Projects', 'gosolar'); ?></h2>
						<?php } ?>
						</div>
					</div>

					<?php echo '<div id="zozo-related-portfolio-slider" class="zozo-owl-carousel owl-carousel related-portfolio-carousel-slider"'.$data_attr.'>';

					while ($portfolio_slider_query->have_posts()) : $portfolio_slider_query->the_post();
						$portfolio_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $image_size); ?>
					
						<div id="portfolio-<?php the_ID(); ?>" class="portfolio-item portfolio-slider-item">
							<div class="portfolio-content">
								<img class="img-responsive" src="<?php echo esc_url($portfolio_img[0]); ?>" width="<?php echo esc_attr($portfolio_img[1]); ?>" height="<?php echo esc_attr($portfolio_img[2]); ?>" alt="<?php the_title(); ?>" />
								<div class="portfolio-overlay">
									<div class="portfolio-mask">
							
									<?php $portfolio_large = ''; 
									$portfolio_large = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
							
										<div class="portfolio-title">
											<h4><?php the_title(); ?></h4>
											<p><?php echo gosolar_shortcode_stripped_excerpt( get_the_content(), 8 ); ?></p>
										</div>
										<a href="<?php echo esc_url( $portfolio_large[0] ); ?>" class="pf-icon-zoom" data-rel="prettyPhoto[relatedgallery]" title="<?php the_title(); ?>"><i class="simple-icon icon-size-fullscreen"></i></a>
										<a href="<?php the_permalink(); ?>" class="pf-icon-link" title="<?php the_title(); ?>"><i class="simple-icon icon-share-alt"></i></a>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>	
					</div>
				</div>
			<?php }	
		}	
	
		wp_reset_postdata();
		
	}
}

/* =============================================================
 *	Woocommerce Build Query String
 * ============================================================= */
if( ! function_exists('gosolar_woo_build_query_string') ) {
	function gosolar_woo_build_query_string($params = array(), $overwrite_key, $overwrite_value) {
		$params[$overwrite_key] = $overwrite_value;
		
		$paged = (array_key_exists('product_count', $params)) ? 'paged=1&' : '';
		
		return "?" . $paged . http_build_query($params);
	}
}

/* =============================================================
 *	HTML Allowed Tags for wp_kses
 * ============================================================= */
if( ! function_exists('gosolar_expanded_allowed_tags') ) {
	function gosolar_expanded_allowed_tags() {
		$allowed_tags = wp_kses_allowed_html( 'post' );
		
		// iframe
		$allowed_tags['iframe'] = array(
			'src' 					=> array(),
			'id' 					=> array(),
			'height' 				=> array(),
			'width' 				=> array(),
			'frameborder' 			=> array(),
			'allowFullScreen' 		=> array(),
			'webkitAllowFullScreen' => array(),
			'mozallowfullscreen' 	=> array(),
		);
		
		// style
		$allowed_tags['style'] = array(
			'type' => array(),
		);
		
		// link
		$allowed_tags['link'] = array(
			'type'  => array(),
			'href'  => array(),
			'rel'   => array(),
			'sizes' => array(),
		);
		
		// meta
		$allowed_tags['meta'] = array(
			'name'  	=> array(),
			'content'   => array(),			
		);
		
		// select
		$allowed_tags['select'] = array(
			'name'  	=> array(),
			'multiple'  => array(),
			'required'  => array(),
			'class' 	=> array(),	
			'size' 		=> array(),
		);
		
		// option
		$allowed_tags['option'] = array(
			'id'  		=> array(),
			'value'  	=> array(),
			'label'  	=> array(),
			'selected'  => array(),			
		);
		
		// input
		$allowed_tags['input'] = array(
			'type'  	=> array(),
			'id'  		=> array(),
			'class' 	=> array(),	
			'value' 	=> array(),
			'name'  	=> array(),
			'checked'   => array(),
			'readonly'  => array(),
		);
		 
		return $allowed_tags;
	}
}

/* =============================================================
 *	Remove Extra P Tags
 * ============================================================= */

if( ! function_exists( 'gosolar_shortcodes_formatter' ) ) {
	function gosolar_shortcodes_formatter( $content ) {
		$block = join( "|", array("zozo_vc_section_title", "zozo_vc_contact_info", "zozo_vc_content_carousel", "zozo_vc_feature_box", "zozo_vc_list_item", "zozo_vc_pricing_table", "zozo_vc_service_box", "ultimate_heading") );
	
		// opening tag
		$shortcode = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
	
		// closing tag
		$shortcode = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$shortcode);
	
		return $shortcode;
	}
}

add_filter('the_content', 'gosolar_shortcodes_formatter');
add_filter('widget_text', 'gosolar_shortcodes_formatter');

/* =============================================================
 *	Render Breadcrumbs
 * ============================================================= */
 
if( ! function_exists( 'gosolar_breadcrumbs' ) ) {
	function gosolar_breadcrumbs() {
		gosolar_zozo_breadcrumbs();
	}
}

/* =============================================================
 *	Search Filters
 * ============================================================= */

if( ! is_admin() ) {
	function GoSolar_SearchFilter($query) {

		if( is_search() && $query->is_search ) {
			if( isset( $_GET ) && count( $_GET ) > 1 ) {
				return $query;
			}
	
			if( gosolar_get_theme_option( 'zozo_search_results_content' ) == 'only_posts') {
				$query->set('post_type', 'post');
			}
	
			if( gosolar_get_theme_option( 'zozo_search_results_content' ) == 'only_pages') {
				$query->set('post_type', 'page');
			}
		}
		return $query;
	}

	add_filter('pre_get_posts', 'GoSolar_SearchFilter');
}

/* =============================================================
 *	Shortcode Check for Scripts
 * ============================================================= */
 
if ( ! function_exists( 'gosolar_save_post_content_check' ) ) {
	function gosolar_save_post_content_check( $post_id ) {

		 // Make sure meta is added to the post, not a revision
		if ( $the_post = wp_is_post_revision( $post_id ) ) {
			$post_id = $the_post;
		}

		$post = get_post($post_id);

		if( $post ) {

			$content = $post->post_content;

			if( function_exists( 'has_shortcode' ) ) {
				// Products
				if ( has_shortcode( $content, 'related_products' ) || has_shortcode( $content, 'best_selling_products' ) || has_shortcode( $content, 'top_rated_products' ) || has_shortcode( $content, 'sale_products' ) || has_shortcode( $content, 'recent_products' ) || has_shortcode( $content, 'product_attribute' ) || has_shortcode( $content, 'product_category' ) || has_shortcode( $content, 'featured_products' ) || has_shortcode( $content, 'products' ) || has_shortcode( $content, 'product' ) || has_shortcode( $content, 'woocomposer_carousel' ) || has_shortcode( $content, 'woocomposer_grid' ) || has_shortcode( $content, 'woocomposer_product' ) ) {
					update_post_meta( $post_id, 'zozo_page_has_products', 1 );
				} else {
					delete_post_meta( $post_id, 'zozo_page_has_products' );
				}
				
				//for cf7
				if ( has_shortcode( $content, 'contact-form-7' ) ) {
					update_post_meta( $post_id, 'zozo_page_has_cf7', true );
				}else {
					delete_post_meta( $post_id, 'zozo_page_has_cf7' );
				}
								
			}
		}

	}
	add_action( 'save_post', 'gosolar_save_post_content_check' );
}

/* =============================================================
 *	Portfolio Gallery Content
 * ============================================================= */

if ( ! function_exists( 'gosolar_portfolio_media_output' ) ) {
	function gosolar_portfolio_media_output( $post_id, $style, $columns, $portfolio_id, $item_link = '', $overlay_animation = '', $overlay_style = '' ) {
	
		$output = '';
		
		$zozo_portfolio = $zozo_options_count = '';
		$zozo_portfolio 	= get_post_meta( $post_id, 'zozoportfolio_options', true );
		$zozo_options_count = get_post_meta( $post_id, 'zozo_portfolio_section_count', true );
		
		if( isset( $style ) && $style == 'masonry' ) {
			$image_size = 'full';
		} else if( isset( $style ) && $style == 'single' ) {
			$image_size = 'gosolar-custom-single';
		} else {
			if( isset( $columns ) && $columns == '2' ) {
				$image_size = 'gosolar-custom-large';
			} else {
				$image_size = 'gosolar-custom-mid';
			}
		}
		
		if( $zozo_options_count != '' && $zozo_options_count != 0 ) {
			// Slider Configuration
			$data_attr = '';
			$data_attr .= ' data-autoplay=false ';
						
			if( $zozo_options_count > 1 ) {
				$data_attr .= ' data-loop=true ';
				$data_attr .= ' data-nav=true ';
				$data_attr .= ' data-navmobile=true ';
			} else {
				$data_attr .= ' data-loop=false ';
			}
			
			$output .= '<div class="zozo-owl-wrapper nested-carousel">';
			$output .= '<div class="zozo-owl-slider owl-carousel-container owl-carousel-loading">';
			$output .= '<div id="'. uniqid('portfolio-media-') .'" class="owl-carousel portfolio-carousel-slider portfolio-gallery"'. esc_attr( $data_attr ) .'>';
			
			for( $opt=1; $opt<=$zozo_options_count; $opt++ ) {
				if( $zozo_portfolio['portfolio_image'][$opt] != '' || $zozo_portfolio['portfolio_video'][$opt] != '' ) {
					if( $zozo_portfolio['portfolio_image'][$opt] != '' ) {
						$portfolio_sized_image = wp_get_attachment_image_src( $zozo_portfolio['portfolio_image_attach_id'][$opt], $image_size);
						$portfolio_large = wp_get_attachment_image_src( $zozo_portfolio['portfolio_image_attach_id'][$opt], 'full');
						
						if( isset( $style ) && $style == 'masonry' ) {
							$image_id      = $zozo_portfolio['portfolio_image_attach_id'][$opt];
							$thumb_img_url = wp_get_attachment_url( $zozo_portfolio['portfolio_image_attach_id'][$opt], 'full' );
							
							$thumb_width = 530;
							$thumb_height = null;
							
							$portfolio_sized_image = gosolar_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, false, false );
							
							if( $thumb_img_url == '' ) {
								$portfolio_sized_image[0] = 'https://placehold.it/530x400?text=No+Image';
								$portfolio_sized_image[1] = 530;
								$portfolio_sized_image[2] = 400;
							}
						}
						
						$output .= '<div class="portfolio-grid-media-item portfolio-img">';
						if( isset( $item_link ) && $item_link == 'link_to_img' ) {
							$output .= '<a href="'. esc_url( $portfolio_large[0] ) .'" data-rel="prettyPhoto[gallery'. $portfolio_id .']" class="img-link-large" title="'. get_the_title() .'">';
							$output .= '<div class="'. $overlay_animation .'"'. $overlay_style .'></div>';
						}
							$output .= '<img class="img-responsive" src="'. esc_url( $portfolio_sized_image[0] ) .'" alt="'. esc_attr( $zozo_portfolio['portfolio_item_title'][$opt] ) .'" title="'. esc_attr( $zozo_portfolio['portfolio_item_title'][$opt] ) .'">';
							
						if( isset( $item_link ) && $item_link == 'link_to_img' ) {
							$output .= '</a>';
						}
						$output .= '</div>';
					} elseif ( $zozo_portfolio['portfolio_video'][$opt] != '' ) {
					
						$portfolio_videotype = "";
						if( isset( $zozo_portfolio['portfolio_video_type'][$opt] ) ) {
							$portfolio_videotype = $zozo_portfolio['portfolio_video_type'][$opt];
						}
						
						switch( $portfolio_videotype ) {
							case 'youtube':
								$output .= '<div class="portfolio-grid-media-item item-video item-youtube">';
								if( isset( $item_link ) && $item_link == 'link_to_img' ) {
									$output .= '<div class="'. $overlay_animation .'"'. $overlay_style .'></div>';
								}
								$output .= '<a class="owl-video" href="https://www.youtube.com/watch?v='. esc_attr( $zozo_portfolio['portfolio_video'][$opt] ) .'"></a>';
								$output .= '</div>';
							break;
							
							case "vimeo":
								$output .= '<div class="portfolio-grid-media-item item-video item-vimeo">';
								if( isset( $item_link ) && $item_link == 'link_to_img' ) {
									$output .= '<div class="'. $overlay_animation .'"'. $overlay_style .'></div>';
								}
								$output .= '<a class="owl-video" href="http://vimeo.com/'. esc_attr( $zozo_portfolio['portfolio_video'][$opt] ) .'"></a>';
								$output .= '</div>';
							break;					
						}
						
					}
				}
			}
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			
		}
		
		return $output;
	}
}

/* =============================================================
 *	Portfolio Media Type Icon Output
 * ============================================================= */

if ( ! function_exists( 'gosolar_portfolio_media_icon_output' ) ) {
	function gosolar_portfolio_media_icon_output( $post_id, $portfolio_id ) {
	
		$output = '';
		
		$media_type 	= get_post_meta( $post_id, 'zozo_portfolio_media_type', true );
		$audio_type 	= get_post_meta( $post_id, 'zozo_portfolio_audio_type', true );
		$audio_sc_id 	= get_post_meta( $post_id, 'zozo_portfolio_audio_sc_id', true );
		$audio_sh_url 	= get_post_meta( $post_id, 'zozo_portfolio_audio_sh_url', true );
		
		$video_type 	= get_post_meta( $post_id, 'zozo_portfolio_video_type', true );
		$video_id 		= get_post_meta( $post_id, 'zozo_portfolio_video_id', true );	
		
		$audio_output = '';
		$video_output = '';
		// Audio 
		if( isset( $media_type ) && $media_type == 'audio' ) {
			if( ( isset( $audio_type ) && $audio_type == 'soundcloud' ) && ( isset( $audio_sc_id ) && $audio_sc_id != '' ) ) {
				$audio_output = do_shortcode( '[zozo_soundcloud url="http://api.soundcloud.com/tracks/'. esc_attr( $audio_sc_id ) .'" comments="yes" autoplay="no" buy_like="yes" show_artwork="yes" color="#FF5500" width="700" height="110"]' );
			} 
			else if( ( isset( $audio_type ) && $audio_type == 'selfhosted' ) && ( isset( $audio_sh_url ) && $audio_sh_url != '' ) ) {
				$audio_output = do_shortcode( '[audio src="'. esc_url( $audio_sh_url ) .'"]' );
			}
			// Audio Output
			if( isset( $audio_output ) && $audio_output != '' ) {
				$output .= '<li class="audio-type">';
					$output .= '<a href="#portfolio-audio-'. $post_id .'" class="pf-icon-audio" data-rel="prettyPhoto[gallery'. $portfolio_id .']" title="'.get_the_title().'"><i class="simple-icon icon-music-tone-alt"></i></a>';
					$output .= '<div id="portfolio-audio-'. $post_id .'" style="display:none;">'. $audio_output .'</div>';
				$output .= '</li>';
			}
		}
		// Video
		else if( isset( $media_type ) && $media_type == 'video' ) {
			if( ( isset( $video_type ) && $video_type == 'youtube' ) && ( isset( $video_id ) && $video_id != '' ) ) {
				$video_output = "http://www.youtube.com/watch?v=". $video_id;
			}
			else if( ( isset( $video_type ) && $video_type == 'vimeo' ) && ( isset( $video_id ) && $video_id != '' ) ) {
				$video_output = "http://vimeo.com/". $video_id;
			}
			// Video Output
			if( isset( $video_output ) && $video_output != '' ) {
				$output .= '<li class="video-type">';
					$output .= '<a href="'. $video_output .'" class="pf-icon-video" data-rel="prettyPhoto[gallery'. $portfolio_id .']" title="'.get_the_title().'"><i class="simple-icon icon-control-play"></i></a>';
				$output .= '</li>';
			} 
		}
		
		return $output;
	}
}

/* =============================================================
 *	Portfolio Media Type Isotope/Stack
 * ============================================================= */
 
if ( ! function_exists( 'gosolar_get_portfolio_post_media' ) ) {
	function gosolar_get_portfolio_post_media( $thumb_width = '', $thumb_height = '', $image_id, $thumb_size = '', $thumb_size_w = '', $thumb_size_h = '' ) {
	
		$thumb_img_url = wp_get_attachment_url( $image_id, 'full' );
		
		$image = array();
		if( function_exists('gosolar_aq_resize') && ( $thumb_width != '' || $thumb_height != '' ) ) {
			$image        = gosolar_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, false, false );
		} else {
			$image[0] = wp_get_attachment_url( $image_id, $thumb_size );
			$image[1] = $thumb_size_w;
			$image[2] = $thumb_size_h;
		}
		$image_alt    = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		
		$image[3] = $image_alt;
		
		return $image;
	}
}


/* =============================================================
 *	Disable default breadcrumbs from bbPress
 * ============================================================= */
add_filter( 'bbp_no_breadcrumb', '__return_true' );

/* =============================================================
 *	Events Calendar Archive
 * ============================================================= */
function gosolar_is_events_archive() {
	if( class_exists( 'TribeEvents' ) ) {
		if( tribe_is_month() || tribe_is_day() || tribe_is_past() || tribe_is_upcoming() || class_exists( 'TribeEventsPro' ) && ( tribe_is_week() || tribe_is_photo() || tribe_is_map() ) ) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

/**
 * Blog Functions
 */

// Blog Featured Image or Slider
function gosolar_output_blog_post_slider( $post_id, $image_size, $gallery_images_type = '', $layout = '' ) {

	global $post;
	
	if( ! isset( $image_size ) || isset( $image_size ) && $image_size == '' ) {
		$image_size = 'gosolar-custom-single';
	} 
	
	$output = '';
	
	// Slider Configuration
	$data_attr = '';
	
	if( gosolar_get_theme_option( 'zozo_blog_slideshow_autoplay' ) == 1 ) {
		$data_attr .= ' data-autoplay=true ';
	} else {
		$data_attr .= ' data-autoplay=false ';
	}
	
	if( gosolar_get_theme_option( 'zozo_blog_slideshow_timeout' ) != '' ) {
		$data_attr .= ' data-timeout=' . gosolar_get_theme_option( 'zozo_blog_slideshow_timeout' ) . ' ';
	}
	
	$data_attr .= ' data-nav=true data-loop=true';

	// Gallery Slider
	if( is_single() ) {
		if( isset( $gallery_images_type ) && $gallery_images_type == 'carousel' ) {
			$gallery_attr = '';
		
			if( gosolar_get_theme_option( 'zozo_single_blog_citems' ) != '' ) {
				$gallery_attr .= ' data-items=' . gosolar_get_theme_option( 'zozo_single_blog_citems' ) . ' ';
			}
			
			if( gosolar_get_theme_option( 'zozo_single_blog_citems_scroll' ) != '' ) {
				$gallery_attr .= ' data-slideby=' . gosolar_get_theme_option( 'zozo_single_blog_citems_scroll' ) . ' ';
			}
			
			if( gosolar_get_theme_option( 'zozo_single_blog_ctablet' ) != '' ) {
				$gallery_attr .= ' data-md=' . gosolar_get_theme_option( 'zozo_single_blog_ctablet' ) . ' ';
			}
			
			if( gosolar_get_theme_option( 'zozo_single_blog_cmlandscape' ) != '' ) {
				$gallery_attr .= ' data-sm=' . gosolar_get_theme_option( 'zozo_single_blog_cmlandscape' ) . ' ';
			}
			
			if( gosolar_get_theme_option( 'zozo_single_blog_cmportrait' ) != '' ) {
				$gallery_attr .= ' data-xs=' . gosolar_get_theme_option( 'zozo_single_blog_cmportrait' ) . ' ';
			}
			
			if( gosolar_get_theme_option( 'zozo_single_blog_cautoplay' ) == 1 ) {
				$gallery_attr .= ' data-autoplay=true ';
			} else {
				$gallery_attr .= ' data-autoplay=false ';
			}
			
			if( gosolar_get_theme_option( 'zozo_single_blog_ctimeout' ) != '' ) {
				$gallery_attr .= ' data-timeout=' . gosolar_get_theme_option( 'zozo_single_blog_ctimeout' ) . ' ';
			}
			
			if( gosolar_get_theme_option( 'zozo_single_blog_cloop' ) == 1 ) {
				$gallery_attr .= ' data-loop=true ';
			} else {
				$gallery_attr .= ' data-loop=false ';
			}
			
			if( gosolar_get_theme_option( 'zozo_single_blog_cmargin' ) != '' ) {
				$gallery_attr .= ' data-margin=' . gosolar_get_theme_option( 'zozo_single_blog_cmargin' ) . ' ';
			}
			
			if( gosolar_get_theme_option( 'zozo_single_blog_cdots' ) == 1 ) {
				$gallery_attr .= ' data-dots=true ';
			} else {
				$gallery_attr .= ' data-dots=false ';
			}
			
			if( gosolar_get_theme_option( 'zozo_single_blog_cnav' ) == 1 ) {
				$gallery_attr .= ' data-nav=true ';
			} else {
				$gallery_attr .= ' data-nav=false ';
			}
		}
	}

	$audio_code = $video_code = '';
	$audio_code = get_post_meta( $post_id, 'zozo_single_audio_code', true );
	$video_code = get_post_meta( $post_id, 'zozo_single_video_code', true );
		
	if( has_post_format('link') ) {
		$external_url = '';
		$external_url = get_post_meta( $post_id, 'zozo_external_link_url', true );
		if( isset( $external_url ) && $external_url == '' ) {
			$external_url = get_permalink( $post_id );
		}
	}

	if ( has_post_thumbnail() && ! post_password_required() ) {

		if( has_post_format('gallery') ) {
		
			$output .= '<div class="post-featured-image featured-gallery-slider">';
				$output .= '<div class="entry-thumbnail-wrapper nested-carousel zozo-owl-wrapper">';
					$output .= '<div class="zozo-owl-slider owl-carousel-container owl-carousel-loading">';
					if( is_single() && isset( $gallery_images_type ) && $gallery_images_type == 'carousel' ) {
						$output .= '<div id="zozo_owl_' . $post_id .'" class="entry-thumbnail owl-carousel blog-single-carousel-slider"'. esc_attr( $gallery_attr ) .'>';
							$output .= gosolar_get_gallery_post_images( 'gosolar-blog-medium', $post_id, 'no' );
						$output .= '</div>';
					} else {
						$output .= '<div id="zozo_owl_' . $post_id .'" class="entry-thumbnail owl-carousel blog-carousel-slider"'. esc_attr( $data_attr ) .'>';
							$output .= gosolar_get_gallery_post_images( $image_size, $post_id, 'no' );
						$output .= '</div>';
					}
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			
		} else { 
	
			if( is_single() && ( has_post_format('audio') || has_post_format('video') ) ) { 
				if( has_post_format('audio') && $audio_code != '' ) {
					// ========== Audio Player ==========
					$output .= '<div class="audio-player blog-audio-player">';
						$output .= do_shortcode( $audio_code );
					$output .= '</div>			';
				} else if( has_post_format('video') && $video_code != '' ) {
					$output .= '<div class="video-player blog-video-player">';
						$output .= do_shortcode( $video_code );
					$output .= '</div>';
				} 
			} else {
				$output .= '<div class="post-featured-image only-image">';
				$output .= '<div class="entry-thumbnail-wrapper">';
					$output .= '<div class="entry-thumbnail">';
						if( ! is_single() ) {
							if( has_post_format('link') ) { 
								$output .= '<a href="'. esc_url($external_url) .'" title="'. esc_html( get_the_title() ) .'" target="_blank" class="post-img">';
							} else {
								$output .= '<a href="'. esc_url( get_permalink() ) .'" title="'. esc_html( get_the_title() ) .'" class="post-img">';
							} 
						}
						
						$output .= get_the_post_thumbnail( $post_id, $image_size );
						
						
						if( ! is_single() ) {
							$output .= '</a>';
							// Date
							$output .= '<div class="post-date-wrap">';
											$output .= '<h6 class="post-date">'. get_the_time( get_option('date_format') ) .'</h6>';
							$output .= '</div>';
							
						}
					$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
			}
		
		}
	
	} else if ( ! has_post_thumbnail() ) { 
	
		if( has_post_format('audio') ) {
			// ========== Audio Player ==========
			$output .= '<div class="audio-player blog-audio-player">';
				$output .= do_shortcode( get_post_meta( $post_id, 'zozo_single_audio_code', true ) );
			$output .= '</div>';
		} 
		
		else if( has_post_format('video') ) {
			$output .= '<div class="video-player blog-video-player">';
				$output .= do_shortcode( get_post_meta( $post_id, 'zozo_single_video_code', true ) );
			$output .= '</div>';
		}
		
	}
	
	return $output;
		
}


// Blog Large Style Output
function gosolar_output_blog_large_layout( $post_id, $post_class, $image_size, $excerpt_limit, $meta_array, $layout ) {

	$output = '';
	
	if( has_post_format('link') ) {
		$external_url = '';
		$external_url = get_post_meta( $post_id, 'zozo_external_link_url', true );
		if( isset( $external_url ) && $external_url == '' ) {
			$external_url = get_permalink( $post_id );
		}
	}
	
	if( ! isset( $post_class ) || isset( $post_class ) && $post_class == '' ) {
		$post_class = '';
	}
	
	$output .= '<article id="post-'.$post_id.'" ';
					ob_start();
						post_class($post_class);
					$output .= ob_get_clean() .'>';
	
	// Sticky Post
	if ( is_sticky() && is_home() && ! is_paged() ) {
		$output .= '<span class="sticky-post"></span>';
	}
	
	$output .= '<div class="post-inner-wrapper">';

		if( ! $meta_array['thumbnail'] ) {
			if( $layout == 'list' ) {
				$output .= gosolar_output_blog_post_slider( $post_id, $image_size, '', 'grid' );
			} else {
				$output .= gosolar_output_blog_post_slider( $post_id, $image_size );
			}
		}
		
		// Title
		$output .= '<div class="entry-header"><h2 class="entry-title">';
			if( has_post_format('link') ) {
				$output .= '<a href="'. esc_url( $external_url ) .'" rel="bookmark" title="'. esc_html( get_the_title() ) .'" target="_blank">'. esc_html( get_the_title() ) .'</a>';
			} else {
				$output .= '<a href="'. esc_url( get_permalink( $post_id ) ) .'" rel="bookmark" title="'. esc_html( get_the_title() ) .'">'. esc_html( get_the_title() ) .'</a>';
			}
		$output .= '</h2></div>';
		
		$output .= '<div class="posts-content-container">';
		
			if( has_post_format('quote') ) {
									
				$output .= '<div class="entry-summary clearfix">
					<div class="entry-quotes quote-format">';
				$output .= '<blockquote>';
					$output .= '<p>'. gosolar_blog_trim_excerpt( $excerpt_limit ) .'</p>';
					$output .= '<footer><h2 class="entry-title">';
						$output .= '<a href="'. esc_url( get_permalink( $post_id ) ) .'" rel="bookmark" title="'. esc_html( get_the_title() ) .'">'. esc_html( get_the_title() ) .'</a>';
					$output .= '</h2></footer>';
				$output .= '</blockquote>';
				
				$output .= wp_link_pages( array(
							'before' 		=> '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'gosolar' ) . '</span>',
							'after' 		=> '</div>',
							'link_before' 	=> '<span>',
							'link_after' 	=> '</span>',
							'echo' 			=> 0
						) );
			
				$output .= '</div></div>';
			
			} else {
				
				
				// Entry Content
				$output .= '<div class="entry-summary clearfix">';
				$output .= '<p>'. gosolar_blog_trim_excerpt( $excerpt_limit ) .'</p>';
				$output .= wp_link_pages( array(
							'before' 		=> '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'gosolar' ) . '</span>',
							'after' 		=> '</div>',
							'link_before' 	=> '<span>',
							'link_after' 	=> '</span>',
							'echo' 			=> 0
						) );
				$output .= '</div>';
				
			}
			
			// Entry Meta
			$output .= '<div class="entry-meta-wrapper">';
				$output .= '<div class="entry-meta">';
										
					// Author
					if( ! $meta_array['author'] ) {
						$output .= '<div class="post-author">';
							$output .= get_avatar(get_the_author_meta('email'), '40');
							$output .= '<h6 class="post-author-name">'. get_the_author_posts_link() .'</h6>';
						$output .= '</div>';
					}					
				$output .= '</div>';
				
				// Read More Link
				if( ! $meta_array['more'] ) {
					$output .= '<div class="read-more">';
						if( has_post_format('link') ) {
							$output .= '<a href="'. esc_url( $external_url ) .'" class="btn-more read-more-link" target="_blank">';
						} else {
							$output .= '<a href="'. esc_url( get_permalink( $post_id ) ) .'" class="btn-more read-more-link">';
						}
						
						if( ! gosolar_get_theme_option( 'zozo_blog_read_more_text' ) ) { 
							$output .= esc_html__('Read more', 'gosolar'); 
						} else { 
							$output .= esc_attr( gosolar_get_theme_option( 'zozo_blog_read_more_text' ) ); 
						}
						
						$output .= '</a>';
					$output .= '</div>';
				}
			$output .= '</div>';
			
			
		$output .= '</div>';
		
	$output .= '</div>';
	$output .= '</article>';
	
	return $output;
}

// Blog Grid Style Output
function gosolar_output_blog_grid_layout( $post_id, $post_class, $image_size, $excerpt_limit, $meta_array, $animation = array() ) {

	$output = '';
	
	if( has_post_format('link') ) {
		$external_url = '';
		$external_url = get_post_meta( $post_id, 'zozo_external_link_url', true );
		if( isset( $external_url ) && $external_url == '' ) {
			$external_url = get_permalink( $post_id );
		}
	}
	
	if( ! isset( $post_class ) || isset( $post_class ) && $post_class == '' ) {
		$post_class = '';
	}
	
	$css_animation = $animation_classes = $animation_delay = $data_attr = '';
	
	if( ! empty( $animation ) ) {
		$css_animation = $animation['animation'];
		$animation_delay = $animation['delay'];
	} else {
		$css_animation = '';
		$animation_delay = '';
	}
	
	if( $css_animation !== '' ) {
        $animation_classes = ' animate_when_almost_visible ' . $css_animation;
        if( $animation_delay !== '' ) {
			$data_attr = ' data-delay=' . $animation_delay;
		}
	}
	
	$output .= '<article id="post-'.$post_id.'" ';
					ob_start();
						post_class($post_class);
					$output .= ob_get_clean() .'>';

	$output .= '<div class="post-inner-wrapper post-inside-wrapper margin-top-20'. $animation_classes .'"'. esc_attr( $data_attr ) .'>';
	
		if( ! $meta_array['thumbnail'] ) {
			$output .= gosolar_output_blog_post_slider( $post_id, $image_size, '', 'grid' );
		}
		
		$output .= '<div class="posts-content-container">';
			// Title
			$output .= '<div class="entry-header"><h2 class="entry-title">';
				if( has_post_format('link') ) {
					$output .= '<a href="'. esc_url( $external_url ) .'" rel="bookmark" title="'. esc_html( get_the_title() ) .'" target="_blank">'. esc_html( get_the_title() ) .'</a>';
				} else {
					$output .= '<a href="'. esc_url( get_permalink( $post_id ) ) .'" rel="bookmark" title="'. esc_html( get_the_title() ) .'">'. esc_html( get_the_title() ) .'</a>';
				}
			$output .= '</h2></div>';
			
			// Entry Content
			$output .= '<div class="entry-summary clearfix">';
			$output .= '<p>'. gosolar_blog_trim_excerpt( $excerpt_limit ) .'</p>';
			$output .= wp_link_pages( array(
						'before' 		=> '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'gosolar' ) . '</span>',
						'after' 		=> '</div>',
						'link_before' 	=> '<span>',
						'link_after' 	=> '</span>',
						'echo' 			=> 0
					) );
			$output .= '</div>';
			
			// Entry Meta
			$output .= '<div class="entry-meta-wrapper">';
				$output .= '<div class="entry-meta">';
										
					// Author
					if( ! $meta_array['author'] ) {
						$output .= '<div class="post-author">';
							$output .= get_avatar(get_the_author_meta('email'), '40');
							$output .= '<h6 class="post-author-name">'. get_the_author_posts_link() .'</h6>';
						$output .= '</div>';
					}
				$output .= '</div>';
			
				// Read More Link
				if( ! $meta_array['more'] ) {
					$output .= '<div class="read-more">';
						if( has_post_format('link') ) {
							$output .= '<a href="'. esc_url( $external_url ) .'" class="btn-more read-more-link" target="_blank">';
						} else {
							$output .= '<a href="'. esc_url( get_permalink( $post_id ) ) .'" class="btn-more read-more-link">';
						}
						
						if( ! gosolar_get_theme_option( 'zozo_blog_read_more_text' ) ) { 
							$output .= esc_html__('Read more', 'gosolar'); 
						} else { 
							$output .= esc_attr( gosolar_get_theme_option( 'zozo_blog_read_more_text' ) ); 
						}
						
						$output .= '</a>';
					$output .= '</div>';
				}
			$output .= '</div>';
			
		$output .= '</div>';
		
	$output .= '</div>';
	$output .= '</article>';
	
	return $output;
}

/*Breadcrumbs*/
if( ! function_exists('gosolar_zozo_breadcrumbs') ) {
	function gosolar_zozo_breadcrumbs() {
	 
	  $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	  $delimiter = ''; // delimiter between crumbs
	  $home = esc_html__('Home', 'gosolar'); // text for the 'Home' link
	  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	  $before = '<span class="current">'; // tag before the current crumb
	  $after = '</span>'; // tag after the current crumb
	 
	  global $post;
	  $homeLink = home_url( '/' );
	  echo '<div id="breadcrumb" class="breadcrumb zozo-breadcrumbs">';
	
	  if (is_home() || is_front_page()) {
		
		if ($showOnHome == 1) echo '<a href="' . $homeLink . '">' . $home . '</a>';
	 
	  } else {
	
		echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	 
		if ( is_category() ) {
		  $thisCat = get_category(get_query_var('cat'), false);
		  if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
		  echo wp_kses_post( $before . single_cat_title('', false) . $after );
	 
		} elseif ( is_search() ) {
		  echo wp_kses_post( $before . get_search_query() . $after );
	 
		} elseif ( is_day() ) {
		  echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		  echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
		  echo wp_kses_post( $before . get_the_time('d') . $after );
	 
		} elseif ( is_month() ) {
		  echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		  echo wp_kses_post( $before . get_the_time('F') . $after );
	 
		} elseif ( is_year() ) {
		  echo wp_kses_post( $before . get_the_time('Y') . $after );
	 
		} elseif ( is_single() && !is_attachment() ) {
		  if ( get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			$slug = $post_type->rewrite;
			echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		  } else {
			$cat = get_the_category(); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
			echo wp_kses_post( $cats );
			if ($showCurrent == 1) echo wp_kses_post( $before . get_the_title() . $after );
		  }
	 
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
		  $post_type = get_post_type_object(get_post_type());
		  echo wp_kses_post( $before . $post_type->labels->singular_name . $after );
	 
		} elseif ( is_attachment() ) {
		  $parent = get_post($post->post_parent);
		  $cat = get_the_category($parent->ID); $cat = $cat[0];
		  echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
		  echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
		  if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	 
		} elseif ( is_page() && !$post->post_parent ) {
		  if ($showCurrent == 1) echo wp_kses_post( $before . get_the_title() . $after );
	 
		} elseif ( is_page() && $post->post_parent ) {
		  $parent_id  = $post->post_parent;
		  $breadcrumbs = array();
		  while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
			$parent_id  = $page->post_parent;
		  }
		  $breadcrumbs = array_reverse($breadcrumbs);
		  for ($i = 0; $i < count($breadcrumbs); $i++) {
			echo wp_kses_post( $breadcrumbs[$i] );
			if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
		  }
		  if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	 
		} elseif ( is_tag() ) {
		  echo wp_kses_post( $before . single_tag_title('', false) . $after );
	 
		} elseif ( is_author() ) {
		   global $author;
		  $userdata = get_userdata($author);
		  echo wp_kses_post( $before . esc_html__('Posts by ', 'gosolar') . $userdata->display_name . $after );
	 
		} elseif ( is_404() ) {
		  echo wp_kses_post( $before . esc_html__('Error 404', 'gosolar') . $after );
		}
	 
		if ( get_query_var('paged') ) {
		  if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
		  echo esc_html__( 'Page', 'gosolar' ) . ' ' . get_query_var('paged');
		  if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
	  }
	  echo '</div>';
	} 
}

/*Save Theme Options*/
if( ! function_exists('gosolar_save_theme_options') ) {
 function gosolar_save_theme_options() {
  global $wp_filesystem;
  $upload_dir = wp_upload_dir();
  $cus_dir_name = $upload_dir['basedir'] . '/gosolar';
 
  if ( ! file_exists( $cus_dir_name ) ) {
   wp_mkdir_p( $cus_dir_name );
  }

  if( empty( $wp_filesystem ) ) {
   require_once ABSPATH . '/wp-admin/includes/file.php';
   WP_Filesystem();
  }

  // Custom Styles File
  ob_start();
  include GOSOLAR_INCLUDES . 'custom-skins.php';
  $custom_css = ob_get_clean();
  $filename =  $cus_dir_name . '/theme_'.get_current_blog_id().'.css';

  if( $wp_filesystem ) {
   $wp_filesystem->put_contents(
 
    $filename,
 
    $custom_css,
 
    FS_CHMOD_FILE // predefined mode settings for WP files
 
   );
  }
 }	
}
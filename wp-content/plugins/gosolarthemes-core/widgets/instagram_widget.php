<?php
function zozo_master_widget_fun() {
	register_widget( 'zozo_null_instagram_widget_class' );
}
add_action( 'widgets_init', 'zozo_master_widget_fun' );
class zozo_null_instagram_widget_class extends WP_Widget {
	
	function __construct() {
		
		parent::__construct(
			'zozo_instagram_widget',
			esc_html__( 'Instagram', 'zozothemes' ),
			array( 'classname' => 'zozo_instagram_widget', 'description' => esc_html__( 'Displays your latest Instagram photos', 'zozothemes' ) )
		);
		
	}
	
	function widget( $args, $instance ) {
		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$access_token = $instance['access_token'];
		$limit = empty( $instance['number'] ) ? 9 : $instance['number'];
		$cols = empty( $instance['cols'] ) ? '3' : $instance['cols'];
		$size = empty( $instance['size'] ) ? 'large' : $instance['size'];
		$target = empty( $instance['target'] ) ? '_self' : $instance['target'];
		$link = empty( $instance['link'] ) ? '' : $instance['link'];
		
		$trans_name = 'zozo_insta_'. sanitize_title( $username );
		$existing_token = get_transient( 'zozo_insta_access_token' );
		$insta_images_json = get_transient( $trans_name );
		
		if( $access_token ){
			if( false === $insta_images_json ) { //|| $existing_token != $access_token
				$insta_images_json = $this->zozo_get_insta_images( $access_token );
				set_transient( $trans_name, $insta_images_json, 6 * HOUR_IN_SECONDS );
				set_transient( 'zozo_insta_access_token', $access_token, 6 * HOUR_IN_SECONDS );
			}
		}
		
		$insta_img_size = 'thumbnail';
		if( $size == 'small' ){
			$insta_img_size = 'low_resolution';
		}else if( $size == 'large' ){
			$insta_img_size = 'standard_resolution';
		}
		
		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $title ) ) { echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] ); };
		if ( $username != '' && $access_token != '' ) { 

			$insta_images_arr = $insta_images_json ? json_decode( $insta_images_json, true ) : array();
			$insta_images = array();
			foreach( $insta_images_arr['data'] as $data ){
				$url = isset( $data['images'][$insta_img_size]['url'] ) ? $data['images'][$insta_img_size]['url'] : ''; //thumbnail
				array_push( $insta_images, $url );
			}
			
			if( $limit < count( $insta_images ) ){
				$insta_images = array_slice( $insta_images, absint( count( $insta_images ) - $limit ) );
			}
				
			$ulclass = apply_filters( 'wpiw_list_class', 'instagram-pics instagram-size-' . $size );
			$ulclass .= ' insta-col-'. $cols;
			$template_part = apply_filters( 'wpiw_template_part', 'parts/wp-instagram-widget.php' );
			?><ul class="nav <?php echo esc_attr( $ulclass ); ?>">
			<?php
			foreach( $insta_images as $insta_image ){
				echo '<li class="instagram-pic"><a href="'. esc_url( $insta_image ) .'" target="'. esc_attr( $target ) .'"><div class="insta-footer-img" style="background-image:url('. esc_url( $insta_image ) .');"></div></a></li>';
			}
			?>
			</ul><?php

		}
		$linkclass = apply_filters( 'wpiw_link_class', 'clear' );
		if ( $link != '' ) {
			?><p class="<?php echo esc_attr( $linkclass ); ?>"><a href="//instagram.com/<?php echo esc_attr( trim( $username ) ); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>"><?php echo wp_kses_post( $link ); ?></a></p><?php
		}
		echo wp_kses_post( $args['after_widget'] );
	}
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => esc_html__( 'Instagram', 'zozothemes' ), 'access_token' => '', 'username' => '', 'cols' => '3', 'size' => 'large', 'link' => esc_html__( 'Follow Me!', 'zozothemes' ), 'number' => 9, 'target' => '_self' ) );
		$title = $instance['title'];
		$username = $instance['username'];
		$access_token = $instance['access_token'];
		$number = absint( $instance['number'] );
		$cols = $instance['cols'];
		$size = $instance['size'];
		$target = $instance['target'];
		$link = $instance['link'];
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'zozothemes' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>"><?php esc_html_e( 'Access Token', 'zozothemes' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'access_token' ) ); ?>" type="text" value="<?php echo esc_attr( $access_token ); ?>" /></label>
			<span class="field-description"><?php echo esc_html__( 'Get instagram access token here', 'zozothemes' ) . ' <a href="https://zozothemes.com/instagram/" target="_blank">'. esc_html__( 'Get Access Token', 'zozothemes' ) .'</a>'; ?></span>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username', 'zozothemes' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" /></label>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos', 'zozothemes' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /></label>
			<span class="field-description"><?php esc_html_e( 'Image limit may vari by public user showing limit. Maximum 10 to 12 is possible to get. Instagram restrict other user photos.', 'zozothemes' ); ?></span>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Photo size', 'zozothemes' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" class="widefat">
				<option value="thumbnail" <?php selected( 'thumbnail', $size ) ?>><?php esc_html_e( 'Thumbnail', 'zozothemes' ); ?></option>
				<option value="small" <?php selected( 'small', $size ) ?>><?php esc_html_e( 'Small', 'zozothemes' ); ?></option>
				<option value="large" <?php selected( 'large', $size ) ?>><?php esc_html_e( 'Large', 'zozothemes' ); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cols' ) ); ?>"><?php esc_html_e( 'Columns', 'zozothemes' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'cols' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cols' ) ); ?>" class="widefat">
				<?php 
					$cols_arr = array( 2, 3, 4, 5, 6, 8, 10 );
					foreach( $cols_arr as $col ){ ?>
						<option value="<?php echo esc_attr( $col ); ?>" <?php selected( $col, $cols ) ?>><?php echo esc_html( $col ); ?></option>
					<?php }
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open links in', 'zozothemes' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" class="widefat">
				<option value="_self" <?php selected( '_self', $target ) ?>><?php esc_html_e( 'Current window (_self)', 'zozothemes' ); ?></option>
				<option value="_blank" <?php selected( '_blank', $target ) ?>><?php esc_html_e( 'New window (_blank)', 'zozothemes' ); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link text', 'zozothemes' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" /></label>
		</p>
		
		<?php
	}
	function update( $new_instance, $old_instance ) { 
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = trim( strip_tags( $new_instance['username'] ) );
		$instance['access_token'] = trim( strip_tags( $new_instance['access_token'] ) );
		$instance['number'] = ! absint( $new_instance['number'] ) ? 9 : $new_instance['number'];
		$instance['size'] = ( ( $new_instance['size'] == 'thumbnail' || $new_instance['size'] == 'large' || $new_instance['size'] == 'small' || $new_instance['size'] == 'original' ) ? $new_instance['size'] : 'large' );
		$instance['cols'] = esc_attr( $new_instance['cols'] );
		$instance['target'] = ( ( $new_instance['target'] == '_self' || $new_instance['target'] == '_blank' ) ? $new_instance['target'] : '_self' );
		$instance['link'] = strip_tags( $new_instance['link'] );
		return $instance;
	}
	
	function zozo_get_insta_images( $access_token ){
		$response = wp_remote_get( 'https://api.instagram.com/v1/users/self/media/recent/?access_token='. $access_token,
			array(
				'timeout'     => 120
			)
		);
		$respose_body = wp_remote_retrieve_body( $response );
		return $respose_body;
	}
	
}
<?php

class GoSolar_Social_Link_Widget extends WP_Widget {

	

	public function __construct() 

	{				

		/* Widget settings. */

		$widget_options = array('classname' => 'zozo_social_link_widget', 'description' => esc_html__( 'Display your social links.', 'gosolar' ));

		$control_options = array('id_base' => 'zozo_social_link_widget-widget');

		

		/* Create the widget. */

		parent::__construct('zozo_social_link_widget-widget', esc_html__( 'Social Links', 'gosolar' ), $widget_options, $control_options);

	

	}	



	function widget($args, $instance)

	{

		extract($args);

		

		$icon_type 	= !empty($instance['icon_type']) ? $instance['icon_type'] : 'circle';

		$align 		= !empty($instance['align']) ? $instance['align'] : 'left';

		$icon_size 	= !empty($instance['icon_size']) ? $instance['icon_size'] : 'normal';

		$facebook 	= $instance['facebook'];

		$twitter 	= $instance['twitter'];

		$pinterest 	= $instance['pinterest'];

		$linkedin 	= $instance['linkedin'];

		$youtube 	= $instance['youtube'];

		$rss 		= $instance['rss'];

		$tumblr 	= $instance['tumblr'];

		$dribbble 	= $instance['dribbble'];

		$flickr 	= $instance['flickr'];

		$instagram 	= $instance['instagram'];

		$vimeo 		= $instance['vimeo'];

		$skype 		= $instance['skype'];

		$yahoo 		= $instance['yahoo'];

		

		$title = apply_filters('widget_title', $instance['title']);

		

		echo wp_kses( $before_widget, gosolar_expanded_allowed_tags() );

		

		if($title) {

			echo wp_kses( $before_title . $title . $after_title, gosolar_expanded_allowed_tags() );

		}

		

		$social_links = array();

		

		if( isset( $facebook ) && $facebook ) {

			$social_links['facebook'] = $facebook;

		}

		if( isset( $twitter ) && $twitter ) {

			$social_links['twitter'] = $twitter;

		}

		if( isset( $pinterest ) && $pinterest ) {

			$social_links['pinterest'] = $pinterest;

		}

		if( isset( $linkedin ) && $linkedin ) {

			$social_links['linkedin'] = $linkedin;

		}

		if( isset( $youtube ) && $youtube ) {

			$social_links['youtube'] = $youtube;

		}

		if( isset( $rss ) && $rss ) {

			$social_links['rss'] = $rss;

		}

		if( isset( $tumblr ) && $tumblr ) {

			$social_links['tumblr'] = $tumblr;

		}

		if( isset( $dribbble ) && $dribbble ) {

			$social_links['dribbble'] = $dribbble;

		}

		if( isset( $flickr ) && $flickr ) {

			$social_links['flickr'] = $flickr;

		}

		if( isset( $instagram ) && $instagram ) {

			$social_links['instagram'] = $instagram;

		}

		if( isset( $vimeo ) && $vimeo ) {

			$social_links['vimeo'] = $vimeo;

		}

		if( isset( $skype ) && $skype ) {

			$social_links['skype'] = $skype;

		}

		if( isset( $yahoo ) && $yahoo ) {

			$social_links['yahoo'] = $yahoo;

		}

		

		$icon_class = '';

		$li_html = '';

		

		if( isset( $social_links ) && is_array( $social_links ) ) {

			foreach( $social_links as $icon => $link ) {

				$icon_class = $icon;

				

				if( $icon == 'vimeo' ) {

					$icon = 'flaticon flaticon-vimeo';

				} else {

					$icon = 'fa fa-' . $icon;

				}

				

				$li_html .= '<li class="'.esc_attr( $icon_class ).'"><a target="_blank" href="'. $link .'"><i class="'.esc_attr( $icon ).'"></i></a></li>';

			}

		}

		

		if( isset( $li_html ) && $li_html != '' ) {

			echo '<ul class="zozo-social-icons soc-icon-'.$icon_type.' soc-icon-size-'. $icon_size .' text-'. $align .'">'. $li_html .'</ul>';

		} ?>

		

		<?php echo wp_kses( $after_widget, gosolar_expanded_allowed_tags() );

	}

	

	function update($new_instance, $old_instance)

	{

		$instance = $old_instance;

		

		$instance['title'] 		= $new_instance['title'];

		$instance['align'] 		= $new_instance['align'];

		$instance['icon_size'] 	= $new_instance['icon_size'];

		$instance['icon_type'] 	= $new_instance['icon_type'];

		$instance['facebook'] 	= $new_instance['facebook'];

		$instance['twitter'] 	= $new_instance['twitter'];

		$instance['pinterest'] 	= $new_instance['pinterest'];

		$instance['linkedin'] 	= $new_instance['linkedin'];

		$instance['youtube'] 	= $new_instance['youtube'];

		$instance['rss'] 		= $new_instance['rss'];

		$instance['tumblr'] 	= $new_instance['tumblr'];

		$instance['dribbble'] 	= $new_instance['dribbble'];

		$instance['flickr'] 	= $new_instance['flickr'];

		$instance['instagram'] 	= $new_instance['instagram'];

		$instance['vimeo'] 		= $new_instance['vimeo'];

		$instance['skype'] 		= $new_instance['skype'];

		$instance['yahoo'] 		= $new_instance['yahoo'];

		

		return $instance;

	}



	function form($instance)

	{

		$defaults = array('title' => '', 'align' => '', 'icon_size' => '', 'icon_type' => '', 'facebook' => '', 'twitter' => '', 'pinterest' => '', 'linkedin' => '', 'youtube' => '', 'rss' => '', 'tumblr' => '', 'dribbble' => '', 'flickr' => '', 'instagram' => '', 'vimeo' => '', 'skype' => '', 'yahoo' => '' );

		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('align') ); ?>"><?php _e('Alignment:', 'gosolar'); ?></label>

			<select id="<?php echo esc_attr( $this->get_field_id('align' )); ?>" name="<?php echo esc_attr( $this->get_field_name('align') ); ?>" class="widefat" style="width:100%;">

				<option value="left" <?php echo selected(esc_attr($instance['align']), 'left', false); ?>><?php _e('Left', 'gosolar'); ?></option>

				<option value="right" <?php echo selected(esc_attr($instance['align']), 'right', false); ?>><?php _e('Right', 'gosolar'); ?></option>

				<option value="center" <?php echo selected(esc_attr($instance['align']), 'center', false); ?>><?php _e('Center', 'gosolar'); ?></option>

			</select>

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('icon_size') ); ?>"><?php _e('Icon Size:', 'gosolar'); ?></label>

			<select id="<?php echo esc_attr( $this->get_field_id('icon_size' )); ?>" name="<?php echo esc_attr( $this->get_field_name('icon_size') ); ?>" class="widefat" style="width:100%;">

				<option value="normal" <?php echo selected(esc_attr($instance['icon_size']), 'normal', false); ?>><?php _e('Normal', 'gosolar'); ?></option>

				<option value="large" <?php echo selected(esc_attr($instance['icon_size']), 'large', false); ?>><?php _e('Large', 'gosolar'); ?></option>

			</select>

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('icon_type') ); ?>"><?php _e('Icon Type:', 'gosolar'); ?></label>

			<select id="<?php echo esc_attr( $this->get_field_id('icon_type' )); ?>" name="<?php echo esc_attr( $this->get_field_name('icon_type') ); ?>" class="widefat" style="width:100%;">

				<option value="circle" <?php echo selected(esc_attr($instance['icon_type']), 'circle', false); ?>><?php _e('Circle', 'gosolar'); ?></option>

				<option value="square" <?php echo selected(esc_attr($instance['icon_type']), 'square', false); ?>><?php _e('Square', 'gosolar'); ?></option>

				<option value="rounded" <?php echo selected(esc_attr($instance['icon_type']), 'rounded', false); ?>><?php _e('Rounded', 'gosolar'); ?></option>

				<option value="transparent" <?php echo selected(esc_attr($instance['icon_type']), 'transparent', false); ?>><?php _e('Transparent', 'gosolar'); ?></option>

			</select>

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>"><?php _e('Facebook URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name('facebook') ); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>"><?php _e('Twitter URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter') ); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>"><?php _e('Pinterest URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pinterest') ); ?>" value="<?php echo esc_attr( $instance['pinterest'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('linkedin') ); ?>"><?php _e('Linkedin URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('linkedin') ); ?>" name="<?php echo esc_attr( $this->get_field_name('linkedin') ); ?>" value="<?php echo esc_attr( $instance['linkedin'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('youtube') ); ?>"><?php _e('Youtube URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('youtube') ); ?>" name="<?php echo esc_attr( $this->get_field_name('youtube') ); ?>" value="<?php echo esc_attr( $instance['youtube'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('rss') ); ?>"><?php _e('Rss URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('rss') ); ?>" name="<?php echo esc_attr( $this->get_field_name('rss') ); ?>" value="<?php echo esc_attr( $instance['rss'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('tumblr') ); ?>"><?php _e('Tumblr URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('tumblr') ); ?>" name="<?php echo esc_attr( $this->get_field_name('tumblr') ); ?>" value="<?php echo esc_attr( $instance['tumblr'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('dribbble') ); ?>"><?php _e('Dribbble URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('dribbble') ); ?>" name="<?php echo esc_attr( $this->get_field_name('dribbble') ); ?>" value="<?php echo esc_attr( $instance['dribbble'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('flickr') ); ?>"><?php _e('Flickr URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('flickr') ); ?>" name="<?php echo esc_attr( $this->get_field_name('flickr') ); ?>" value="<?php echo esc_attr( $instance['flickr'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('instagram') ); ?>"><?php _e('Instagram URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('instagram') ); ?>" name="<?php echo esc_attr( $this->get_field_name('instagram') ); ?>" value="<?php echo esc_attr( $instance['instagram'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('vimeo') ); ?>"><?php _e('Vimeo URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('vimeo') ); ?>" name="<?php echo esc_attr( $this->get_field_name('vimeo') ); ?>" value="<?php echo esc_attr( $instance['vimeo'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('skype') ); ?>"><?php _e('Skype URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('skype') ); ?>" name="<?php echo esc_attr( $this->get_field_name('skype') ); ?>" value="<?php echo esc_attr( $instance['skype'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('yahoo') ); ?>"><?php _e('Yahoo URL:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('yahoo') ); ?>" name="<?php echo esc_attr( $this->get_field_name('yahoo') ); ?>" value="<?php echo esc_attr( $instance['yahoo'] ); ?>" />

		</p>

	<?php }

}



function gosolar_social_link_load()

{

	register_widget('GoSolar_Social_Link_Widget');

}



add_action('widgets_init', 'gosolar_social_link_load');

?>
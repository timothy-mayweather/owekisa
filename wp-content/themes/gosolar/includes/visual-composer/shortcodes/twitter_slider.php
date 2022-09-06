<?php 

/**

 * Twitter Slider shortcode 

 */



if ( ! function_exists( 'gosolar_vc_twitter_slider_shortcode' ) ) {

	function gosolar_vc_twitter_slider_shortcode( $atts, $content = NULL ) {

		

		$atts = vc_map_get_attributes( 'zozo_vc_twitter_slider', $atts );

		extract( $atts );



		$output = '';

		static $twitter_id = 1;

		

		// Slider Configuration

		$data_attr = '';

		

		$data_attr .= ' data-items="1" ';

		$data_attr .= ' data-slideby="1" ';

		$data_attr .= ' data-items-tablet="1" ';

		$data_attr .= ' data-items-mobile-landscape="1" ';

		$data_attr .= ' data-items-mobile-portrait="1" ';

		$data_attr .= ' data-loop="false" ';

		

		if( isset( $auto_play ) && $auto_play != '' ) {

			$data_attr .= ' data-autoplay="' . $auto_play . '" ';

		}

		if( isset( $timeout_duration ) && $timeout_duration != '' ) {

			$data_attr .= ' data-autoplay-timeout="' . $timeout_duration . '" ';

		}

		if( isset( $pagination ) && $pagination != '' ) {

			$data_attr .= ' data-pagination="' . $pagination . '" ';

		}

		if( isset( $navigation ) && $navigation != '' ) {

			$data_attr .= ' data-navigation="' . $navigation . '" ';

		}

		

		// Classes

		$main_classes = '';

		$main_classes .= gosolar_vc_animation( $css_animation );

		$tweets_list = '';

		

		if( $screen_name && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $twitter_count ) {

		

			if( function_exists( 'gosolar_include_tweet_php' ) ) {

				

				gosolar_include_tweet_php();

			

				$TweetPHP = new TweetPHP(array(

					'consumer_key'          => $consumer_key,

					'consumer_secret'       => $consumer_secret,

					'access_token'          => $access_token,

					'access_token_secret'   => $access_token_secret,

					'twitter_screen_name'   => $screen_name,

					'enable_cache'          => true,

					'cachetime'             => 8 * HOUR_IN_SECONDS, // Seconds to cache feed

					'tweets_to_retrieve'    => 20, // How many tweets to fetch

					'tweets_to_display'     => $twitter_count, // Number of tweets to display

					'ignore_replies'        => true, // Ignore @replies

					'ignore_retweets'       => true, // Ignore retweets

					'twitter_style_dates'   => true, // Use twitter style dates e.g. 2 hours ago

					'twitter_date_text'     => array('seconds', 'minutes', 'about', 'hour', 'ago'),

					'date_format'           => '%I:%M %p %b %d%O', // The defult date format e.g. 12:08 PM Jun 12th. See: http://php.net/manual/en/function.strftime.php

					'date_lang'             => get_locale(), // Language for date e.g. 'fr_FR'. See: http://php.net/manual/en/function.setlocale.php

					'twitter_template'      => '{tweets}',

					'tweet_template'        => '<div class="tweet-list"><span class="status">{tweet}</span> <span class="meta"><a href="{link}">{date}</a></span></div>',

					'error_template'        => '<div class="tweet-error"><span class="status">Our twitter feed is unavailable right now.</span> <span class="meta"><a href="{link}">Follow us on Twitter</a></span></div>',

					'debug'                 => false

				));

			

				$tweets_list = $TweetPHP->get_tweet_list();

				

				if( $tweets_list != '' ) {

					$output = '<div class="zozo-twitter-slider-wrapper'.$main_classes.'">';

					$output .= '<div id="zozo-twitter-slider'.$twitter_id.'" class="zozo-owl-carousel owl-carousel twitter-carousel-slider"'.$data_attr.'>';

						$output .= $tweets_list;

					$output .= '</div>';

					$output .= '</div>';

				}



			}



		} else {

            $output .= '<p>' . esc_html__('Please configure twitter options.', 'gosolar') . '</p>';

        }

		

		$twitter_id++;

		

		return $output;

	}

}



if ( ! function_exists( 'gosolar_vc_twitter_slider_shortcode_map' ) ) {

	function gosolar_vc_twitter_slider_shortcode_map() {

		

		vc_map( 

			array(

				"name"					=> esc_html__( "Twitter Slider", "gosolar" ),

				"description"			=> esc_html__( "Show your twitter feeds in Slider.", 'gosolar' ),

				"base"					=> "zozo_vc_twitter_slider",

				"category"				=> esc_html__( "Theme Addons", "gosolar" ),

				"icon"					=> "zozo-vc-icon",

				"params"				=> array(

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Extra Class', "gosolar" ),

						'param_name'	=> 'classes',

						'value' 		=> '',

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "CSS Animation", "gosolar" ),

						"param_name"	=> "css_animation",

						"value"			=> array(

							esc_html__( "No", "gosolar" )					=> '',

							esc_html__( "Top to bottom", "gosolar" )			=> "top-to-bottom",

							esc_html__( "Bottom to top", "gosolar" )			=> "bottom-to-top",

							esc_html__( "Left to right", "gosolar" )			=> "left-to-right",

							esc_html__( "Right to left", "gosolar" )			=> "right-to-left",

							esc_html__( "Appear from center", "gosolar" )	=> "appear" ),

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Consumer Key", "gosolar" ),

						"param_name"	=> "consumer_key",

						"value" 		=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Consumer Secret", "gosolar" ),

						"param_name"	=> "consumer_secret",

						"value" 		=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Access Token", "gosolar" ),

						"param_name"	=> "access_token",

						"value" 		=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Access Token Secret", "gosolar" ),

						"param_name"	=> "access_token_secret",

						"value" 		=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Twitter Screen Name", "gosolar" ),

						"param_name"	=> "screen_name",

						'admin_label'	=> true,

						"value" 		=> "",

					),

					array(

						"type"			=> "textfield",

						"heading"		=> esc_html__( "Number of Tweets", "gosolar" ),

						'admin_label'	=> true,

						"param_name"	=> "twitter_count",

						'admin_label'	=> true,

						"value" 		=> "",

					),

					// Slider

					array(

						'type'			=> 'dropdown',

						'heading'		=> esc_html__( "Auto Play", 'gosolar' ),

						'param_name'	=> "auto_play",

						'admin_label'	=> true,

						'value'			=> array(

							esc_html__( 'True', 'gosolar' )	=> 'true',

							esc_html__( 'False', 'gosolar' )	=> 'false',

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						'type'			=> 'textfield',

						'heading'		=> esc_html__( 'Timeout Duration (in milliseconds)', 'gosolar' ),

						'param_name'	=> "timeout_duration",

						'value'			=> "5000",

						'dependency'	=> array(

							'element'	=> "auto_play",

							'value'		=> 'true'

						),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Navigation", "gosolar" ),

						"param_name"	=> "navigation",

						'admin_label'	=> true,

						"value"			=> array(

							esc_html__( "Yes", "gosolar" )	=> "true",

							esc_html__( "No", "gosolar" )	=> "false" ),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

					array(

						"type"			=> 'dropdown',

						"heading"		=> esc_html__( "Pagination", "gosolar" ),

						"param_name"	=> "pagination",

						'admin_label'	=> true,

						"value"			=> array(

							esc_html__( "Yes", "gosolar" )	=> "true",

							esc_html__( "No", "gosolar" )	=> "false" ),

						"group"			=> esc_html__( "Slider", "gosolar" ),

					),

				)

			) 

		);

	}

}

add_action( 'vc_before_init', 'gosolar_vc_twitter_slider_shortcode_map' );
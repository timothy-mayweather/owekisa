<?php

class Zozo_Tweets_Widget extends WP_Widget {



	public function __construct()

	{

		/* Widget settings. */

		$widget_options = array('classname' => 'zozo_tweets_widget', 'description' => 'Displays Twitter feeds.');

		$control_options = array('id_base' => 'zozo_tweets-widget');

		

		/* Create the widget. */

		parent::__construct('zozo_tweets-widget', 'Twitter Feeds', $widget_options, $control_options);

	}



	function widget($args, $instance)

	{

		extract($args);



		$title = apply_filters('widget_title', $instance['title']);

		$twitter_id = $instance['twitter_id'];

		$consumer_key = $instance['consumer_key'];

		$consumer_secret = $instance['consumer_secret'];

		$access_token = $instance['access_token'];

		$access_token_secret = $instance['access_token_secret'];

		$tweet_count = (int) $instance['tweet_count'];

		$tweet_visible = !empty($instance['tweet_visible']) ? $instance['tweet_visible'] : 2;

		echo $before_widget;

		

		if($title) {

			echo $before_title . $title . $after_title;

		} 

		

		// Include Main Library File

		require_once( GOSOLAR_CORE_DIR . '/widgets/twitter-widget/twitteroauth.php' );

		

		//set transient name

		$transient_name = 'zozo_list_tweets_' . strtolower($twitter_id);

		

		// Get stored transients

		$cached_twitter_feeds = get_transient( $transient_name );

		

		if( false === $cached_twitter_feeds || empty( $cached_twitter_feeds ) ) {

		

			// Get Access Token

			$connection = $this->getConnectionWithAccessToken($consumer_key, $consumer_secret, $access_token, $access_token_secret);				

				

			$params = array(

			  'count' 		=> $tweet_count,

			  'screen_name' => $twitter_id

			);

			

			$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

			

			// Get Response data

			$tweets = $connection->get($url, $params);

			

			// Set it to transient

			set_transient( $transient_name, $tweets, 0 ); //HOUR_IN_SECONDS * 8

			

		} else {

		

			$tweets = $cached_twitter_feeds;

			

		}		

		

		// Check tweets array

		if($tweets && is_array($tweets)) { ?>

			<div class="zozo-twitter-widget zozo-twitter-slide" data-visible="<?php echo esc_attr( $tweet_visible ); ?>">

				<ul class="twitter-box list-unstyled">

					<?php foreach($tweets as $tweet) { ?>

							<li class="tweet-item">

								<?php $tweet_time = isset($tweet['created_at']) ? strtotime($tweet['created_at']) : ''; 

								$time_ago = $this->tweet_time_ago($tweet_time); ?>

								

								<h5 class="tweet-user-name">

									<a href="http://twitter.com/<?php echo esc_attr( $tweet['user']['screen_name'] ); ?>/statuses/<?php echo esc_attr( $tweet['id_str'] ); ?>">

										<?php echo isset($tweet['user']) ? esc_attr( $tweet['user']['screen_name'] ) : ''; ?>

									</a>

									<span class="tweet-time"><?php echo esc_attr( $time_ago ); ?></span>

								</h5>

							

								<p class="zozo_tweet_text">

									<?php $tweet_text = isset($tweet['text']) ? $tweet['text'] : '';

									$tweet_text = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $tweet_text);

									$tweet_text = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $tweet_text);

									echo wp_kses_post( $tweet_text ); ?>

								</p>

							</li>

					<?php } ?>

				</ul>

			</div>

			

		<?php } ?>

		

		<?php echo $after_widget;

	}

	

	function tweet_time_ago( $time ) {

		$periods = array( esc_html__( 'second', 'gosolar' ), esc_html__( 'minute', 'gosolar' ), esc_html__( 'hour', 'gosolar' ), esc_html__( 'day', 'gosolar' ), esc_html__( 'week', 'gosolar' ), esc_html__( 'month', 'gosolar' ), esc_html__( 'year', 'gosolar' ), esc_html__( 'decade', 'gosolar' ) );

		

		$lengths = array( '60', '60', '24', '7', '4.35', '12', '10' );

		$now = time();

		$difference = $now - $time;

		

		$tense = esc_html__( 'ago', 'gosolar' );



		for( $j = 0; $difference >= $lengths[$j] && $j < count( $lengths )-1; $j++ ) {

			$difference /= $lengths[$j];

		}



		$difference = round( $difference );



		if( $difference != 1 ) {

			$periods[$j] .= esc_html__( 's', 'gosolar' );

		}



	   return sprintf('%s %s %s', $difference, $periods[$j], $tense );

	}

	

	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) 

	{

		$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);

		return $connection;

	}

		

	function update($new_instance, $old_instance)

	{

		$instance = $old_instance;

		

		$instance['title'] = $new_instance['title'];

		$instance['twitter_id'] = $new_instance['twitter_id'];

		$instance['consumer_key'] = $new_instance['consumer_key'];

		$instance['consumer_secret'] = $new_instance['consumer_secret'];

		$instance['access_token'] = $new_instance['access_token'];

		$instance['access_token_secret'] = $new_instance['access_token_secret'];

		$instance['tweet_count'] = $new_instance['tweet_count'];

		$instance['tweet_visible'] = $new_instance['tweet_visible'];		

		

		return $instance;

	}



	function form($instance)

	{

		$defaults = array('title' => '', 'twitter_id' => '', 'consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '', 'tweet_count' => '', 'tweet_visible' => '');

		$instance = wp_parse_args((array) $instance, $defaults); ?>

		

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('twitter_id') ); ?>"><?php _e('Twitter ID:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('twitter_id') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter_id') ); ?>" value="<?php echo esc_attr( $instance['twitter_id'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('consumer_key') ); ?>"><?php _e('Consumer Key:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('consumer_key') ); ?>" name="<?php echo esc_attr( $this->get_field_name('consumer_key') ); ?>" value="<?php echo esc_attr( $instance['consumer_key'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('consumer_secret') ); ?>"><?php _e('Consumer Secret:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('consumer_secret') ); ?>" name="<?php echo esc_attr( $this->get_field_name('consumer_secret') ); ?>" value="<?php echo esc_attr( $instance['consumer_secret'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('access_token') ); ?>"><?php _e('Access Token:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('access_token') ); ?>" name="<?php echo esc_attr( $this->get_field_name('access_token') ); ?>" value="<?php echo esc_attr( $instance['access_token'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('access_token_secret') ); ?>"><?php _e('Access Token Secret:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('access_token_secret') ); ?>" name="<?php echo esc_attr( $this->get_field_name('access_token_secret') ); ?>" value="<?php echo esc_attr( $instance['access_token_secret'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('tweet_count') ); ?>"><?php _e('Number of Tweets:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('tweet_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('tweet_count') ); ?>" value="<?php echo esc_attr( $instance['tweet_count'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('tweet_visible') ); ?>"><?php _e('Number of Visible Tweets:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('tweet_visible') ); ?>" name="<?php echo esc_attr( $this->get_field_name('tweet_visible') ); ?>" value="<?php echo esc_attr( $instance['tweet_visible'] ); ?>" />

		</p>	

			

	<?php }

}



function zozo_tweets_widget_load()

{

	register_widget('Zozo_Tweets_Widget');

}



add_action('widgets_init', 'zozo_tweets_widget_load');

?>
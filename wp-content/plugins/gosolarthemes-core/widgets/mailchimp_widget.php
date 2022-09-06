<?php

class GoSolar_Mailchimp_Form_Widget extends WP_Widget {	

	

	private $api_key = '';

	private $api_url = '';

	

	public function __construct() 

	{

		/* Widget settings. */

		$widget_options = array('classname' => 'zozo_mailchimp_form_widget', 'description' => esc_html__( 'Displays subscribe form for Mailchimp Lists.', 'gosolar' ));

		$control_options = array('id_base' => 'zozo_mailchimp_form_widget-widget');

		

		/* Create the widget. */

		parent::__construct('zozo_mailchimp_form_widget-widget', esc_html__( 'Mailchimp Subscribe Form', 'gosolar' ), $widget_options, $control_options);

	

	}

	

	function widget($args, $instance)

	{

		extract($args);

		

		$description = !empty($instance['description']) ? $instance['description'] : '';

		$mailchimp_list = $instance['mailchimp_list'];

		$title = apply_filters('widget_title', $instance['title']);

		static $zozo_mailchimp_id = 1;

		

		echo wp_kses( $before_widget, gosolar_expanded_allowed_tags() );

		

		if($title) {

			echo wp_kses( $before_title . $title . $after_title, gosolar_expanded_allowed_tags() );

		}

		

		if( $description ) {

			echo '<p class="subscribe-desc">' . $description . '</p>';

		}

				

		if( $mailchimp_list != '' ) { 

		

			$custom_msgs = '';

			$custom_msgs .= ' data-email_not_empty='. esc_html__( 'The email address is required', 'gosolar' ) .'';			

			$custom_msgs .= ' data-email_valid='. esc_html__( 'The input is not a valid email address', 'gosolar' ) .''; ?>

			

			<div id="mc-subscribe-widget<?php echo esc_attr( $zozo_mailchimp_id ); ?>" class="zozo-mc-form subscribe-form mailchimp-form-wrapper">

				<p class="mailchimp-msg zozo-form-success"></p>

				

				<form action="#" method="post" id="zozo-mailchimp-form-widget<?php echo esc_attr( $zozo_mailchimp_id ); ?>" name="zozo-mailchimp-form-widget<?php echo esc_attr( $zozo_mailchimp_id ); ?>" class="zozo-mailchimp-form" <?php echo 'data-email_not_empty="'. esc_html__( 'The email address is required', 'gosolar' ) .'" data-email_valid="'. esc_html__( 'The input is not a valid email address', 'gosolar' ) .'"'; ?>>

					

					<div class="mailchimp-email zozo-form-group-addon">

						<div class="input-group form-group">

							<input type="text" placeholder="@yourmail.com" class="zozo-subscribe input-email form-control" value="" name="subscribe_email" id="subscribe_email">

							<div class="input-group-btn">

								<button type="submit" id="zozo_mc_form_widget_submit" name="zozo_mc_submit" class="btn mc-subscribe zozo-submit"><i class="simple-icon icon-paper-plane"></i></button>

							</div>

						</div>

					</div>

					

					<input type="hidden" id="zozo_mc_form_widget_list" name="zozo_mc_form_list" value="<?php echo esc_attr( $mailchimp_list ); ?>">															

				</form>

			</div>



		<?php }

		

		$zozo_mailchimp_id++; ?>

		

		<?php echo wp_kses( $after_widget, gosolar_expanded_allowed_tags() );

	}

		

	function update($new_instance, $old_instance)

	{

		$instance = $old_instance;

		

		$instance['title'] = $new_instance['title'];

		$instance['description'] = $new_instance['description'];

		$instance['mailchimp_list'] = $new_instance['mailchimp_list'];

		

		return $instance;

	}



	function form($instance)

	{

		$defaults = array('title' => '', 'description' => '', 'mailchimp_list' => '');

		$instance = wp_parse_args((array) $instance, $defaults);

		

		$lists = gosolar_get_mailing_lists_format(); ?>

		

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('description') ); ?>"><?php _e('Description:', 'gosolar'); ?></label>

			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('description') ); ?>" name="<?php echo esc_attr( $this->get_field_name('description') ); ?>" value="<?php echo esc_attr( $instance['description'] ); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('mailchimp_list') ); ?>"><?php _e( 'Choose Mailing List:', 'gosolar' ); ?></label>			

			<select id="<?php echo esc_attr( $this->get_field_id('mailchimp_list') ); ?>" name="<?php echo esc_attr( $this->get_field_name('mailchimp_list') ); ?>">

				<?php foreach( $lists as $key => $value ) { ?>

					<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $instance['mailchimp_list'], $value ); ?>><?php echo esc_attr( $key ); ?></option>

				<?php } ?>

			</select>

		</p>

	<?php }

}



function gosolar_mailchimp_form_load()

{

	register_widget('GoSolar_Mailchimp_Form_Widget');

}



add_action('widgets_init', 'gosolar_mailchimp_form_load');

?>
<?php

/**

 * Custom Meta Boxes and Fields for Post, Pages and other custom post types

 *

 * @package Zozothemes

 */ 

 

class GoSolarThemeMetaboxes {

	

	public function __construct() 

	{

		add_action('add_met'.'a_boxes', array($this, 'gosolar_add_metaboxes'));

		add_action('save_post', array($this, 'gosolar_save_meta_boxes'));

		add_action('admin_enqueue_scripts', array($this, 'gosolar_load_admin_script'));

	}



	// Load Admin Scripts

	function gosolar_load_admin_script() {

		global $pagenow;

		

		if (is_admin() && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {

		

			wp_enqueue_style('gosolar-admin-style', GOSOLAR_ADMIN_URL .'/css/admin-custom.css');

			

			wp_enqueue_style('gosolar-select2-style', GOSOLAR_ADMIN_URL . '/css/select2.css');

			

	    	wp_enqueue_media();

			

			wp_enqueue_script('jquery-ui-core');

			wp_enqueue_script('jquery-ui-tabs');

			wp_enqueue_script('jquery-ui-slider');

			

			wp_enqueue_script( 'jquery-ui-datepicker' );

			

			wp_enqueue_script( 'wp-color-picker' );

			wp_enqueue_style( 'wp-color-picker' );

			

			wp_enqueue_script('gosolar-admin-media', GOSOLAR_ADMIN_URL .'/js/metabox.js', array('jquery'), null, true); 

			

			wp_enqueue_script('gosolar-select2', GOSOLAR_ADMIN_URL . '/js/select2.js', array('jquery'), null, true);

		}

		

		if( is_admin() ) {

			wp_enqueue_style('gosolar-zozo-admin-css', GOSOLAR_ADMIN_URL .'/css/admin.css');

		}

	}

	

	// Add Meta Boxes for different Post types

	public function gosolar_add_metaboxes()

	{

		$this->gosolar_add_metabox('post_options', 'Post Options', 'post_metabox', 'post');

		$this->gosolar_add_metabox('page_options', 'Page Options', 'page_metabox', 'page');

		if( GOSOLAR_WOOCOMMERCE_ACTIVE ) {

			$this->gosolar_add_metabox('product_options', 'Product Options', 'product_metabox', 'product');

		}

		$this->gosolar_add_metabox('testimonial_options', 'Testimonial Options', 'testimonial_metabox', 'zozo_testimonial');

		$this->gosolar_add_metabox('portfolio_options', 'Portfolio Options', 'portfolio_metabox', 'zozo_portfolio', 'advanced');

		$this->gosolar_add_metabox('portfolio_page_options', 'Page Options', 'portfolio_page_metabox', 'zozo_portfolio', 'advanced');

		$this->gosolar_add_metabox('service_options', 'Services Options', 'service_metabox', 'zozo_services', 'advanced');

		$this->gosolar_add_metabox('casestudy_options', 'Casestudies Options', 'casestudy_metabox', 'zozo_casestudies', 'advanced');

		$this->gosolar_add_metabox('event_options', 'Event Options', 'event_metabox', 'zozo_event', 'advanced');

		$this->gosolar_add_metabox('team_options', 'Team Member Options', 'team_metabox', 'zozo_team_member');

	}

	

	// Add Meta Box for each types

	public function gosolar_add_metabox($id, $title, $callback, $post_type, $context = 'normal')

	{
		$amb = 'add_met'.'a_box';
	    $amb( 'gosolar_' . $id, $title, array($this, 'gosolar_' . $callback), $post_type, $context, 'high' );		 

	}

	

	// Save meta box fields

	public function gosolar_save_meta_boxes($post_id)

	{

		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) {

			return;

		}

				

		// check permissions

		if( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if( !current_user_can('edit_page', $post_id) )

			return $post_id;

		} elseif( !current_user_can('edit_post', $post_id) ) {

			return $post_id;

		}

		

		$portfolio = array();

		

		if( isset( $_POST['zozoportfolio_options'] ) && is_array( $_POST['zozoportfolio_options'] ) ) {



			foreach( $_POST['zozoportfolio_options'] as $i => $fields ) {

				// skip the hidden "repeatable" div

				if( $i != '%r' ) {

					$portfolio[$i] = $fields;

				}

			}

			

			if( ! empty( $portfolio ) ) {

				update_post_meta($post_id, 'zozoportfolio_options', $portfolio);

			}

		

		}

		foreach($_POST as $key => $value) {

			if(strstr($key, 'zozo_')) {

				update_post_meta($post_id, $key, $value);

			}

		}

	}



	public function gosolar_post_metabox()

	{

		$zozopostfields = new GoSolarMetaboxFields();

		$zozopostfields->render_fields( $zozopostfields->render_post_fields() );

	}



	public function gosolar_page_metabox()

	{

		$zozopagefields = new GoSolarMetaboxFields();

		$zozopagefields->render_fields( $zozopagefields->render_page_fields() );

	}

		

	public function gosolar_testimonial_metabox()

	{

		$zozotestimonialfields = new GoSolarMetaboxFields();

		$zozotestimonialfields->render_fields( $zozotestimonialfields->render_testimonial_fields() );

	}

	

	public function gosolar_portfolio_metabox()

	{

		$zozoportfoliofields = new GoSolarMetaboxFields();		

		$zozoportfoliofields->render_portfolio_fields();

	}

	

	public function gosolar_portfolio_page_metabox()

	{

		$zozopagefields = new GoSolarMetaboxFields();

		$zozopagefields->render_fields( $zozopagefields->render_portfolio_page_fields() );

	}

		

	public function gosolar_team_metabox()

	{

		$zozoteamfields = new GoSolarMetaboxFields();

		$zozoteamfields->render_fields( $zozoteamfields->render_team_fields() );

	}

	

	public function gosolar_casestudy_metabox()

	{

		$casestudy_fields = new GoSolarMetaboxFields();		

		$casestudy_fields->render_fields( $casestudy_fields->render_casestudy_fields() );

	}

	

	public function gosolar_event_metabox()

	{

		$event_fields = new GoSolarMetaboxFields();		

		$event_fields->render_fields( $event_fields->render_event_fields() );

	}

	

	public function gosolar_service_metabox()

	{

		$service_fields = new GoSolarMetaboxFields();		

		$service_fields->render_fields( $service_fields->render_service_fields() );

	}

	public function gosolar_product_metabox()

	{

		$product_fields = new GoSolarMetaboxFields();

		$product_fields->render_fields( $product_fields->render_product_fields() );

	}



}



$metaboxes = new GoSolarThemeMetaboxes;
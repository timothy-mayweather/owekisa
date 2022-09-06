<?php
    /**
     * Theme Options Configuration File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
    // This is your option name where all the Redux data is stored.
    $opt_name = "zozo_options";
    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */
    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get('Name') . ' ' . esc_html__('Options', 'gosolar'),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'gosolar' ),
        'page_title'           => esc_html__( 'Theme Options', 'gosolar' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyAsd03TE8ZfcIrp1Lsr-GDGOk6284M4itY',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => true,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        'disable_google_fonts_link' => false,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
		//'forced_dev_mode_off'  => true,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
        // OPTIONAL -> Give you extra features
        'page_priority'        => 62,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'zozo_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.
        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit' 		=> '',                   // Disable the footer credit of Redux. Please leave if you can help it.
        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
        //'compiler'             => true,
        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );
    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'href'  => 'http://docs.zozothemes.com/gosolar/',
        'title' => esc_html__( 'Documentation', 'gosolar' ),
    );
    $args['admin_bar_links'][] = array(
        'href'  => 'https://zozothemes.ticksy.com/',
        'title' => esc_html__( 'Support', 'gosolar' ),
    );
    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( '<p>%1$s <strong>$%2$s</strong></p>', esc_html__( 'Did you know that GoSolar Theme sets a global variable for you? To access any of your saved options from within your code you can use your global variable:', 'gosolar' ), $v );
    } else {
        $args['intro_text'] = sprintf( '<p>%1$s</p>', esc_html__( 'This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'gosolar' ) );
    }
    // Add content after the form.
    $args['footer_text'] = '';
    Redux::setArgs( $opt_name, $args );
    /*
     * ---> END ARGUMENTS
     */
    /*
     * ---> START HELP TABS
     */
    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'gosolar' ),
            'content' => sprintf( '<p>%1$s</p>', esc_html__( 'This is the tab content, HTML is allowed.', 'gosolar' ) )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'gosolar' ),
            'content' => sprintf( '<p>%1$s</p>', esc_html__( 'This is the tab content, HTML is allowed.', 'gosolar' ) )
        )
    );
    //Redux::setHelpTab( $opt_name, $tabs );
    // Set the help sidebar
    $content = sprintf( '<p>%1$s</p>', esc_html__( 'This is the sidebar content, HTML is allowed.', 'gosolar' ) );
    //Redux::setHelpSidebar( $opt_name, $content );
    /*
     * <--- END HELP TABS
     */
    /*
     *
     * ---> START SECTIONS
     *
     */
    /*
        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for
     */
    // -> START General Settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'General', 'gosolar' ),
        'id'     => 'general',
        'desc'   => '',
        'icon'   => 'el el-icon-dashboard',
        'fields' => array(
			array(
				'id'		=> 'zozo_disable_page_loader',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Disable Page Loader', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_page_loader_img',
				'type' 		=> 'media',
				'url'		=> false,
				'readonly' 	=> false,
				'title' 	=> esc_html__('Custom Page Loader Image', 'gosolar'),
				'desc'     	=> esc_html__( "Upload the custom page loader image.", "gosolar" ),
				'required'  => array('zozo_disable_page_loader', 'equals', false),
			),
			array(
				'id'		=> 'zozo_enable_responsive',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Responsive Design', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_enable_rtl_mode',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable RTL Mode', 'gosolar'),						
				'subtitle'  => esc_html__( "Enable this mode for right-to-left language mode.", "gosolar" ),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			
			array(
				'id'		=> 'zozo_disable_opengraph',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Disable Open Graph Meta Tags', 'gosolar'),						
				'subtitle'  => esc_html__( "Disable open graph meta tags which is mainly used when sharing pages on social networking sites like Facebook.", "gosolar" ),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
        )
    ) );
    // Logo
    Redux::setSection( $opt_name, array(
        'title' 	 => esc_html__('Logo', 'gosolar'),
        'id'         => 'general-logo',
        'subsection' => true,
        'fields'     => array(
            array(
				'id'		=> 'zozo_logo',
				'type' 		=> 'media',
				'url'		=> false,
				'readonly' 	=> false,
				'title' 	=> esc_html__('Logo', 'gosolar'),
				'desc'     	=> esc_html__( "Upload your website logo.", "gosolar" ),
				'default' 	=> array(
					'url' 		=> GOSOLAR_THEME_URL . '',
					'width' 	=> '93',
					'height' 	=> '26'
				)
			),
			array(
				'id'		=> 'zozo_retina_logo',
				'type' 		=> 'media',
				'url'		=> false,
				'readonly' 	=> false,
				'title' 	=> esc_html__('Retina Logo', 'gosolar'),
				'desc'     	=> esc_html__( "Upload the retina version of your logo.", "gosolar" ),
			),
			array(
				'id'		=> 'zozo_logo_maxheight',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Logo Max Height', 'gosolar'),
				'subtitle'  => esc_html__('This must be numeric (no px).', 'gosolar'),
				'desc' 		=> esc_html__('You can set a max height for the logo here, and this will resize it on the front end if your logo image is bigger.', 'gosolar'),
				'validate'  => 'numeric',
				'default'   => '100',
			),
			array(
				'id'       			=> 'zozo_logo_padding',
				'type'     			=> 'spacing',
				'mode'     			=> 'padding',
				'right'         	=> false,
				'left'          	=> false,
				'units'         	=> array( 'px' ),
				'units_extended'	=> 'false',
				'title'    			=> esc_html__( 'Logo Padding', 'gosolar' ),
				'subtitle' 			=> esc_html__( 'Choose the spacing for logo.', 'gosolar' ),
			),
			array(
				'id'			=> 'zozo_sticky_logo',
				'type' 			=> 'media',
				'url'			=> false,
				'readonly' 		=> false,
				'title' 		=> esc_html__('Sticky Header Logo', 'gosolar'),
				'desc'     		=> esc_html__( "Upload your sticky header logo.", "gosolar" ),
				'default' 		=> array(
					'url' 		=> GOSOLAR_THEME_URL . '',
					'width' 	=> '93',
					'height' 	=> '26'
				)
			),
			array(
				'id'       			=> 'zozo_sticky_logo_padding',
				'type'     			=> 'spacing',
				'mode'     			=> 'padding',
				'right'         	=> false,
				'left'          	=> false,
				'units'         	=> array( 'px' ),
				'units_extended'	=> 'false',
				'title'    			=> esc_html__( 'Sticky Logo Padding', 'gosolar' ),
				'subtitle' 			=> esc_html__( 'Choose the spacing for sticky logo.', 'gosolar' ),
			),
        )
    ) );
	
	// Icons
	if ( ! function_exists( 'wp_site_icon' ) ) {
			
	} else {
		Redux::setSection( $opt_name, array(
			'title' 	 => esc_html__('Icons', 'gosolar'),
			'id'         => 'general-icons',
			'subsection' => true,
			'fields'     => array(
				array(
					'id'		=> 'icons_info',
					'type' 		=> 'info',
					'title' 	=> esc_html__('Please use "Site Icon" feature for adding favicon and other apple icons in "Appearance > Customize > Site Identity > Site Icon"', 'gosolar'),
					'notice' 	=> false
				),
			)
		) );
	}
	
	// Mailchimp
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('API Keys & Message Text', 'gosolar'),
		'id'         => 'general-apikeys',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'		=> 'zozo_google_map_api',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Google Map API Key', 'gosolar'),
				'desc' 		=> wp_kses( __( 'Enter your Google Map API key to use google map with your site. Please follow this <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">link</a> to get API key.', 'gosolar' ), gosolar_expanded_allowed_tags() ),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_mailchimp_api',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Mailchimp API Key', 'gosolar'),
				'desc' 		=> esc_html__('Enter your Mailchimp API key to get subscribers for your lists.', 'gosolar'),
				'default' 	=> ""
			),			
			array(
				'id'		=> 'zozo_mailchimp_success_message_api',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Mailchimp Success Message', 'gosolar'),
				'desc' 		=> esc_html__('Mailchimp Success Message Text.', 'gosolar'),
				'default' 	=> esc_html__( 'Success. You receive confirmation email to subscribe into our mailing lists.', 'gosolar' )			
			),			
			array(
				'id'		=> 'zozo_mailchimp_subscription_error_message_api',	
				'type'     	=> 'text',		
				'title' 	=> esc_html__('Mailchimp Subscription Error Message', 'gosolar'),		
				'desc' 		=> esc_html__('Mailchimp Subscription Error Message Text.', 'gosolar'),	
				'default' 	=> esc_html__( 'Sorry. You already subscribed into our mailing lists.', 'gosolar' )			
			),	
			array(		
				'id'		=> 'zozo_mailchimp_error_message_api',		
				'type'     	=> 'text',		
				'title' 	=> esc_html__('Mailchimp Error Message', 'gosolar'),					
				'desc' 		=> esc_html__('Mailchimp Error Message Text.', 'gosolar'),			
				'default' 	=> "Error. Please try again."			
			),
		)
	) );
	
	// Custom CSS
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Custom CSS', 'gosolar'),
		'id'         => 'general-customcss',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'		=> 'zozo_custom_css',
				'type' 		=> 'ace_editor',
				'title' 	=> esc_html__('Custom CSS Code', 'gosolar'),
				'subtitle' 	=> esc_html__('Paste your CSS code here.', 'gosolar'),
				'mode' 		=> 'css',
				'theme' 	=> 'monokai',
				'default' 	=> ""
			),
		)
	) );
	
	// Maintenance Settings
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Maintenance', 'gosolar' ),
        'id'     => 'maintenance',
        'desc'   => '',
        'icon'   => 'el el-icon-eye-close',
		'fields' => array(
			array(
				'id'		=> 'zozo_enable_maintenance',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Enable Maintenance Mode', 'gosolar'),
				'subtitle' 	=> esc_html__('Enable the themes maintenance mode.', 'gosolar'),
				'options'  	=> array(
					'0' 	=> esc_html__('Off', 'gosolar'),
					'1' 	=> esc_html__('On ( Standard )', 'gosolar'),
					'2' 	=> esc_html__('On ( Custom Page )', 'gosolar'),
				),
				'default'  => '0'
			),
			array(
				'id'		=> 'zozo_maintenance_mode_page',
				'type' 		=> 'select',
				'data' 		=> 'pages',
				'title' 	=> esc_html__('Custom Maintenance Mode Page', 'gosolar'),
				'subtitle' 	=> esc_html__('Select the page that is your maintenance page, if you would like to show a custom page instead of the standard page from theme. You should use the Maintenance Page template for this page.', 'gosolar'),
				'required'  => array('zozo_enable_maintenance', '=', '2'),
				'default' 	=> '',
				'args' 		=> array()
			),
			array(
				'id'		=> 'zozo_enable_coming_soon',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Enable Coming Soon Mode', 'gosolar'),
				'subtitle' 	=> esc_html__('Enable the themes coming soon mode.', 'gosolar'),
				'options'  	=> array(
					'0' 	=> esc_html__('Off', 'gosolar'),
					'1' 	=> esc_html__('On ( Standard )', 'gosolar'),
					'2' 	=> esc_html__('On ( Custom Page )', 'gosolar'),
				),
				'default'  => '0'
			),
			array(
				'id'		=> 'zozo_coming_soon_page',
				'type' 		=> 'select',
				'data' 		=> 'pages',
				'title' 	=> esc_html__('Custom Coming Soon Page', 'gosolar'),
				'subtitle' 	=> esc_html__('Select the page that is your coming soon page, if you would like to show a custom page instead of the standard page from theme. You should use the Maintenance Page template for this page.', 'gosolar'),
				'required'  => array('zozo_enable_coming_soon', '=', '2'),
				'default' 	=> '',
				'args' 		=> array()
			),
		)
	) );
	
	// Layout Options
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Layout', 'gosolar' ),
        'id'     => 'layout',
        'desc'   => '',
        'icon'   => 'el el-icon-view-mode',
		'fields' => array(
			array(
				'id'		=> 'zozo_theme_layout',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Theme Layout', 'gosolar'),
				'options' 	=> array(
					'fullwidth' => array('alt' => esc_html__('Full Width', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/full-width.jpg'),
					'boxed' 	=> array('alt' => esc_html__('Boxed', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/boxed.jpg'),
					'wide' 		=> array('alt' => esc_html__('Wide', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/wide.jpg'),
				),
				'default' 	=> 'fullwidth'
			),
			array(
				'id'		=> 'zozo_layout',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Page Layout', 'gosolar'),
				'options' 	=> array(
					'one-col' 			=> array('alt' => esc_html__('Full width', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/one-col.png'),
					'two-col-right' 	=> array('alt' => esc_html__('Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/two-col-right.png'),
					'two-col-left' 		=> array('alt' => esc_html__('Left Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/two-col-left.png'),
					'three-col-middle' 	=> array('alt' => esc_html__('Left and Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-middle.png'),
					'three-col-right' 	=> array('alt' => esc_html__('Two Right Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-right.png'),
					'three-col-left' 	=> array('alt' => esc_html__('Two Left Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-left.png'),
				),
				'default' 	=> 'one-col'
			),
			array(
				'id'            => 'zozo_fullwidth_site_width',
				'type'          => 'slider',
				'title'         => esc_html__( 'Container Max Width', 'gosolar' ),
				'subtitle'      => esc_html__( 'Please choose container maximum width for fullwidth layout', 'gosolar' ),
				'default'       => 1200,
				'min'           => 1100,
				'step'          => 5,
				'max'           => 1600,
				'required' 		=> array('zozo_theme_layout', 'equals', 'fullwidth'),
				'display_value' => 'text'
			),
			array(
				'id'            => 'zozo_boxed_site_width',
				'type'          => 'slider',
				'title'         => esc_html__( 'Container Max Width', 'gosolar' ),
				'subtitle'      => esc_html__( 'Please choose container maximum width for boxed layout', 'gosolar' ),
				'default'       => 1200,
				'min'           => 1100,
				'step'          => 5,
				'max'           => 1600,
				'required' 		=> array('zozo_theme_layout', 'equals', 'boxed'),
				'display_value' => 'text'
			),
		)
	) );
	
	// Header Settings
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Header', 'gosolar' ),
        'id'     => 'header',
        'desc'   => '',
        'icon'   => 'el el-icon-website',
		'fields' => array(
			array(
				'id'		=> 'zozo_header_layout',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Header Layout', 'gosolar'),
				'options'  	=> array(
					'fullwidth'	=> esc_html__( 'Full Width', 'gosolar' ),
					'wide'		=> esc_html__( 'Wide', 'gosolar' ),
					'boxed'		=> esc_html__( 'Boxed', 'gosolar' ),
				),
				'default' 	=> 'fullwidth'
			),
			array(
				'id'		=> 'zozo_enable_header_top_bar',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Header Top Bar', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_sticky_header',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Sticky Header', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'       => 'enable_sticky_header_hide',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Sticky header show/hide', 'gosolar' ),
				'subtitle' => esc_html__( 'Enable the sticky header to hide once scrolled 800px down the page, and show on scroll up.', 'gosolar' ),
				'desc'     => '',
				'options'  => array( '1' => esc_html__( 'On', 'gosolar' ), '0' => esc_html__( 'Off', 'gosolar' ) ),
				'required' => array('zozo_sticky_header', 'equals', true),
				'default'  => '0'
			),
		)
	) );
	
	// Header Type
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Header Type', 'gosolar'),
		'id'         => 'header-headertype',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'		=> 'zozo_header_skin',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Header Skin', 'gosolar'),
				'options'  	=> array(
					'light'		=> esc_html__( 'Light', 'gosolar' ),
					'dark'		=> esc_html__( 'Dark', 'gosolar' ),
				),
				'default' 	=> 'light'
			),
			array(
				'id'		=> 'zozo_header_transparency',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Header Transparency', 'gosolar'),
				'options'  	=> array(
					'no-transparent'	=> esc_html__( 'No Transparency', 'gosolar' ),
					'transparent'		=> esc_html__( 'Transparent', 'gosolar' ),
					'semi-transparent'	=> esc_html__( 'Semi Transparent', 'gosolar' ),
				),
				'default' 	=> 'no-transparent'
			),
			array(
				'id'		=> 'zozo_header_menu_skin',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Header Menu Skin', 'gosolar'),
				'options'  	=> array(
					'default'			=> esc_html__( 'Default', 'gosolar' ),
					'light'				=> esc_html__( 'Light', 'gosolar' ),
					'dark'				=> esc_html__( 'Dark', 'gosolar' ),
					'semi-transparent'	=> esc_html__( 'Semi Transparent', 'gosolar' ),
				),
				'default' 	=> 'default'
			),
			array(
				'id'		=> 'zozo_header_search_type',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Header Search Type', 'gosolar'),
				'subtitle' 	=> esc_html__('Choose search style mode in header.', 'gosolar'),
				'options'  	=> array(
					'0' 	=> esc_html__('Standard', 'gosolar'),
					'1' 	=> esc_html__('Toggle', 'gosolar'),
					'2' 	=> esc_html__('Fullscreen', 'gosolar'),
				),
				'default'  => '1'
			),
			array(
				'id'		=> 'zozo_search_placeholder',
				'type'     	=> 'text',
				'title' 	=> __('Search Placeholder', 'advisor'),
				'desc' 		=> __('Enter placeholder text for search box', 'advisor'),
				'default' 	=> __('Search..', 'advisor')
			),
			array(
				'id'		=> 'zozo_header_type',
				'type' 		=> 'image_select',
				'full_width'=> true,
				'title' 	=> esc_html__('Header Type', 'gosolar'),
				'options' 	=> array(
					'header-1' 			=> array('alt' => esc_html__('Default Header', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/headers/header-01.jpg'),					
					'header-3' 			=> array('alt' => esc_html__('Header Center Logo', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/headers/header-03.jpg'),					
					'header-7' 			=> array('alt' => esc_html__('Header Centered Logo', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/headers/header-05.jpg'),					
					'header-11' 		=> array('alt' => esc_html__('Header Style 2', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/headers/header-07.jpg'),
				),
				'default' 	=> 'header-1'
			),
			// Header 1
			array(
				'id'       => 'zozo_header_1_elements_config',
				'type'     => 'sorter',
				'title'    => esc_html__( 'Header Elements Config', 'gosolar' ),
				'subtitle' => esc_html__( 'Choose the elements for the header area for Header 1. You can drag the items between enabled/disabled and also order them as you like.', 'gosolar' ),
				'required' 	=> array('zozo_header_type', 'equals', array( 'header-1' )),
				'options'  => array(
					'enabled'  => array(
						'primary-menu'		=> esc_html__( 'Primary Menu', 'gosolar' ),
						'cart-icon'         => esc_html__( 'Cart', 'gosolar' ),																		
					),
					'disabled' => array(
						'search-icon'		=> esc_html__( 'Search', 'gosolar' ),
						'social-icons'		=> esc_html__( 'Social Icons', 'gosolar' ),						
						'contact-info'		=> esc_html__( 'Contact Info', 'gosolar' ),
						'text-shortcode'	=> esc_html__( 'Text/Shortcode', 'gosolar' ),
						'address-info'		=> esc_html__( 'Address / Store Hours', 'gosolar' ),
						
					),
				),
			),
			array(
				'id'		=> 'zozo_header_1_elements_text',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Header Text', 'gosolar'),
				'desc' 		=> esc_html__( 'You can use any shortcodes to set text on Header when you have the config above set to Text/Shortcode', 'gosolar' ),
				'required' 	=> array('zozo_header_type', 'equals', array( 'header-1' )),
				'default' 	=> esc_html__('Header Text', 'gosolar'),				
			),
			
			// Header 3
			array(
				'id'       => 'zozo_header_3_elements_config',
				'type'     => 'sorter',
				'title'    => esc_html__( 'Header Elements Config', 'gosolar' ),
				'subtitle' => esc_html__( 'Choose the elements for the header area for Header 3. You can drag the items between enabled/disabled and also order them as you like.', 'gosolar' ),
				'required' 	=> array('zozo_header_type', 'equals', array( 'header-3' )),
				'options'  => array(
					'enabled'  => array(
						'primary-menu'		=> esc_html__( 'Primary Menu', 'gosolar' ),
						'search-icon'		=> esc_html__( 'Search', 'gosolar' ),						
					),
					'disabled' => array(
						'cart-icon'         => esc_html__( 'Cart', 'gosolar' ),
						'social-icons'		=> esc_html__( 'Social Icons', 'gosolar' ),
						'contact-info'		=> esc_html__( 'Contact Info', 'gosolar' ),
						'address-info'		=> esc_html__( 'Address / Store Hours', 'gosolar' ),
						'text-shortcode'	=> esc_html__( 'Text/Shortcode', 'gosolar' ),
					),
				),
			),
			array(
				'id'		=> 'zozo_header_3_elements_text',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Header Text', 'gosolar'),
				'desc' 		=> esc_html__( 'You can use any shortcodes to set text on Header when you have the config above set to Text/Shortcode', 'gosolar' ),
				'required' 	=> array('zozo_header_type', 'equals', array( 'header-3' )),
				'default' 	=> esc_html__('Header Text', 'gosolar'),
			),			
			
			
			// Header 11
			array(
				'id'       => 'zozo_header_11_logo_bar_config',
				'type'     => 'sorter',
				'title'    => 'Header Logo Bar Right Config',
				'subtitle' => esc_html__( 'Choose the elements for the header logo bar right area for Header 11. You can drag the items between enabled/disabled and also order them as you like.', 'gosolar' ),
				'required' 	=> array('zozo_header_type', 'equals', array( 'header-11' )),
				'options'  => array(
					'enabled'  => array(
						'address-info'		=> esc_html__( 'Address / Store Hours', 'gosolar' ),
					),
					'disabled' => array(						
						'cart-icon'         => esc_html__( 'Cart', 'gosolar' ),
						'primary-menu'		=> esc_html__( 'Primary Menu', 'gosolar' ),
						'social-icons'		=> esc_html__( 'Social Icons', 'gosolar' ),
						'contact-info'		=> esc_html__( 'Contact Info', 'gosolar' ),						
						'search-icon'		=> esc_html__( 'Search', 'gosolar' ),
						'text-shortcode'	=> esc_html__( 'Text/Shortcode', 'gosolar' ),
					),
				),
			),
			array(
				'id'		=> 'zozo_header_11_logo_bar_text',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Header Logo Bar Text', 'gosolar'),
				'desc' 		=> esc_html__( 'You can use any shortcodes to set text on Logo Bar Header when you have the config above set to Text/Shortcode', 'gosolar' ),
				'required' 	=> array('zozo_header_type', 'equals', array( 'header-11' )),
				'default' 	=> esc_html__('Header Logo Bar Text', 'gosolar'),
			),
			array(
				'id'       => 'zozo_header_11_left_config',
				'type'     => 'sorter',
				'title'    => 'Header Left Config',
				'subtitle' => esc_html__( 'Choose the elements for the header left area for Header 11. You can drag the items between enabled/disabled and also order them as you like.', 'gosolar' ),
				'required' 	=> array('zozo_header_type', 'equals', array( 'header-11' )),
				'options'  => array(
					'enabled'  => array(
						'primary-menu'		=> esc_html__( 'Primary Menu', 'gosolar' ),
					),
					'disabled' => array(
						'cart-icon'			=> esc_html__( 'Cart', 'gosolar' ),
						'search-icon'		=> esc_html__( 'Search', 'gosolar' ),						
						'social-icons'		=> esc_html__( 'Social Icons', 'gosolar' ),
						'contact-info'		=> esc_html__( 'Contact Info', 'gosolar' ),
						'address-info'		=> esc_html__( 'Address / Store Hours', 'gosolar' ),
						'text-shortcode'	=> esc_html__( 'Text/Shortcode', 'gosolar' ),
					),
				),
			),
			array(
				'id'		=> 'zozo_header_11_left_text',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Header Left Text', 'gosolar'),
				'desc' 		=> esc_html__( 'You can use any shortcodes to set text on Header when you have the left config above set to Text/Shortcode', 'gosolar' ),
				'required' 	=> array('zozo_header_type', 'equals', array( 'header-11' )),
				'default' 	=> esc_html__('Header Left Text', 'gosolar'),
			),
			array(
				'id'       => 'zozo_header_11_right_config',
				'type'     => 'sorter',
				'title'    => 'Header Right Config',
				'subtitle' => esc_html__( 'Choose the elements for the header right area for Header 11. You can drag the items between enabled/disabled and also order them as you like.', 'gosolar' ),
				'required' 	=> array('zozo_header_type', 'equals', array( 'header-11' )),
				'options'  => array(
					'enabled'  => array(
						'social-icons'		=> esc_html__( 'Social Icons', 'gosolar' ),
						'cart-icon'			=> esc_html__( 'Cart', 'gosolar' ),
						'search-icon'		=> esc_html__( 'Search', 'gosolar' ),
					),
					'disabled' => array(						
						'primary-menu'		=> esc_html__( 'Primary Menu', 'gosolar' ),
						'contact-info'		=> esc_html__( 'Contact Info', 'gosolar' ),
						'address-info'		=> esc_html__( 'Address / Store Hours', 'gosolar' ),
						'text-shortcode'	=> esc_html__( 'Text/Shortcode', 'gosolar' ),
					),
				),
			),
			array(
				'id'		=> 'zozo_header_11_right_text',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Header Right Text', 'gosolar'),
				'desc' 		=> esc_html__( 'You can use any shortcodes to set text on Header when you have the right config above set to Text/Shortcode', 'gosolar' ),
				'required' 	=> array('zozo_header_type', 'equals', array( 'header-11' )),
				'default' 	=> esc_html__('Header Right Text', 'gosolar'),
			),
			
			
			
			array(
				'id'		=> 'zozo_slider_position',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Slider Position', 'gosolar'),
				'required' 	=> array('zozo_header_type', 'equals', array( 'header-1','header-3','header-7' )),
				'options'  	=> array(
					'below'		=> esc_html__( 'Below Header', 'gosolar' ),
					'above'		=> esc_html__( 'Above Header', 'gosolar' ),
				),
				'default' 	=> 'below'
			),			
		)
	) );
	
	// Header Top Bar
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Header Top Bar', 'gosolar'),
		'id'         => 'header-headertopbar',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'zozo_header_top_bar_left',
				'type'     => 'sorter',
				'title'    => esc_html__( 'Header Top Bar Left Config', 'gosolar' ),
				'subtitle' => esc_html__( 'Choose the config for the header top bar left area', 'gosolar' ),
				'required' => array('zozo_enable_header_top_bar', 'equals', true),
				'options'  => array(
					'enabled'  => array(
						'contact-info'		=> esc_html__( 'Contact Info', 'gosolar' ),
					),
					'disabled' => array(
						'text-shortcode'	=> esc_html__( 'Text/Shortcode', 'gosolar' ),
						'social-icons'		=> esc_html__( 'Social Icons', 'gosolar' ),
						'search-icon'		=> esc_html__( 'Search', 'gosolar' ),
						'top-menu'			=> esc_html__( 'Top Menu', 'gosolar' ),						
						'welcome-msg'		=> esc_html__( 'Welcome Message', 'gosolar' ),
					),
				),
			),
			array(
				'id'		=> 'zozo_header_top_bar_left_text',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Top Bar Left Text', 'gosolar'),
				'desc' 		=> esc_html__( 'You can use any shortcodes to set text on Top Bar when you have the left config above set to Text/Shortcode', 'gosolar' ),
				'default' 	=> esc_html__('Top Bar Left Text', 'gosolar'),
			),
			array(
				'id'       => 'zozo_header_top_bar_right',
				'type'     => 'sorter',
				'title'    => esc_html__( 'Header Top Bar Right Config', 'gosolar' ),
				'subtitle' => esc_html__( 'Choose the config for the header top bar right area', 'gosolar' ),
				'required' => array('zozo_enable_header_top_bar', 'equals', true),
				'options'  => array(
					'enabled'  => array(
						'social-icons'		=> esc_html__( 'Social Icons', 'gosolar' ),
					),
					'disabled' => array(
						'contact-info'		=> esc_html__( 'Contact Info', 'gosolar' ),
						'search-icon'		=> esc_html__( 'Search', 'gosolar' ),
						'top-menu'			=> esc_html__( 'Top Menu', 'gosolar' ),						
						'welcome-msg'		=> esc_html__( 'Welcome Message', 'gosolar' ),
						'text-shortcode'	=> esc_html__( 'Text/Shortcode', 'gosolar' ),
					),
				),
			),
			array(
				'id'		=> 'zozo_header_top_bar_right_text',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Top Bar Right Text', 'gosolar'),
				'desc' 		=> esc_html__( 'You can use any shortcodes to set text on Top Bar when you have the right config above set to Text/Shortcode', 'gosolar' ),
				'default' 	=> esc_html__('Top Bar Right Text', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_welcome_msg',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Welcome Message', 'gosolar'),
				'desc' 		=> '',
				'default' 	=> esc_html__("Welcome to GoSolar", "gosolar"),
			),
			array(
				'id'		=> 'zozo_header_phone',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Header Phone Number', 'gosolar'),
				'desc' 		=> esc_html__('Phone number will display in the contact info section.', 'gosolar'),
				'default' 	=> "+12 123 456 789"
			),
			array(
				'id'		=> 'zozo_header_email',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Header Email Address', 'gosolar'),
				'desc' 		=> esc_html__('Email address will display in the contact info section.', 'gosolar'),
				'default' 	=> "info@yoursite.com"
			),
			array(
				'id'       => 'zozo_header_address',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Address', 'gosolar' ),
				'default'  => '<strong>One Canada Square, </strong><span>Canary Wharf, United Kingdom.</span>'
			),
			array(
				'id'       => 'zozo_header_business_hours',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Business Hours', 'gosolar' ),
				'default'  => '<strong>Monday-Friday: 9am to 5pm </strong><span>Saturday / Sunday: Closed</span>'
			),
		)
	) );
	
	// Header Styling Options
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Styling', 'gosolar'),
		'id'         => 'header-styling',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       			=> 'zozo_header_spacing',
				'type'     			=> 'spacing',
				'mode'     			=> 'padding',
				'units'         	=> array( 'em', 'px', '%' ),
				'units_extended'	=> 'true',
				'title'    			=> esc_html__( 'Header Padding', 'gosolar' ),
				'subtitle' 			=> esc_html__( 'Choose the spacing for header.', 'gosolar' ),
			),
		)
	) );
	
	// Header Menu Options
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Main Menu', 'gosolar'),
		'id'         => 'header-mainmenu',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       	=> 'zozo_menu_type',
				'type'     	=> 'select',
				'title'    	=> esc_html__( 'Menu Type', 'gosolar' ),
				'subtitle' 	=> esc_html__( 'Please select menu type.', 'gosolar' ),
				'options'  	=> array(
					'standard'		=> esc_html__( 'Standard Menu', 'gosolar' ),
					'megamenu'		=> esc_html__( 'Mega Menu', 'gosolar' ),
				),
				'default'  	=> 'megamenu'
			),
			array(
				'id'		=> 'zozo_menu_separator',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Menu Separator', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'       	=> 'zozo_dropdown_menu_skin',
				'type'     	=> 'select',
				'title'    	=> esc_html__( 'Dropdown Menu Skin', 'gosolar' ),
				'subtitle' 	=> esc_html__( 'Please select dropdown menu skin type.', 'gosolar' ),
				'options'  	=> array(
					'light'		=> esc_html__( 'Light', 'gosolar' ),
					'dark'		=> esc_html__( 'Dark', 'gosolar' ),
				),
				'default'  	=> 'light'
			),
			array(
				'id'             => 'zozo_dropdown_menu_width',
				'type'           => 'dimensions',
				'units'          => array( 'em', 'px', '%' ),
				'units_extended' => 'true',
				'title'          => esc_html__( 'Dropdown Menu Width ( Only Standard Mode )', 'gosolar' ),
				'subtitle'       => esc_html__( 'Enter dropdown menu width for standard mode.', 'gosolar' ),
				'height'         => false,
				'default'        => array(
					'width'  => 220,
					'units'  => 'px',
				)
			),
			array(
				'id'             => 'zozo_menu_height',
				'type'           => 'dimensions',
				'units'          => 'px',
				'units_extended' => 'false',

				'title'          => esc_html__( 'Main Menu Height', 'gosolar' ),
				'subtitle'       => esc_html__( 'Enter main menu height.', 'gosolar' ),
				'width'         => false,
				'default'        => array(
					'height'  => 80,
					'units'   => 'px',
				)
			),
			array(
				'id'             => 'zozo_sticky_menu_height',
				'type'           => 'dimensions',
				'units'          => 'px',
				'units_extended' => 'false',
				'title'          => esc_html__( 'Sticky Main Menu Height', 'gosolar' ),
				'subtitle'       => esc_html__( 'Enter main menu height in sticky.', 'gosolar' ),
				'width'         => false,
				'default'        => array(
					'height'  => 60,
					'units'   => 'px',
				)
			),
			array(
				'id'		=> 'menu_height',
				'type' 		=> 'info',
				'title' 	=> esc_html__('If Header Type 4, 5, 6, 11', 'gosolar'),
				'notice' 	=> false
			),
			array(
				'id'             => 'zozo_logo_bar_height',
				'type'           => 'dimensions',
				'units'          => 'px',
				'units_extended' => 'false',
				'title'          => esc_html__( 'Logo Bar Height', 'gosolar' ),
				'subtitle'       => esc_html__( 'Enter logo bar height.', 'gosolar' ),
				'width'         => false,
				'default'        => array(
					'height'  => 76,
					'units'   => 'px',
				)
			),
			array(
				'id'             => 'zozo_menu_height_alt',
				'type'           => 'dimensions',
				'units'          => 'px',
				'units_extended' => 'false',
				'title'          => esc_html__( 'Main Menu Height', 'gosolar' ),
				'subtitle'       => esc_html__( 'Enter main menu height.', 'gosolar' ),
				'width'         => false,
				'default'        => array(
					'height'  => 60,
					'units'   => 'px',
				)
			),
			array(
				'id'             => 'zozo_sticky_menu_height_alt',
				'type'           => 'dimensions',
				'units'          => 'px',
				'units_extended' => 'false',
				'title'          => esc_html__( 'Sticky Main Menu Height', 'gosolar' ),
				'subtitle'       => esc_html__( 'Enter main menu height in sticky.', 'gosolar' ),
				'width'         => false,
				'default'        => array(
					'height'  => 60,
					'units'   => 'px',
				)
			),
		)
	) );

	
	// Mobile Header Settings
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Mobile Header', 'gosolar' ),
        'id'     => 'mobile-header',
        'desc'   => '',
        'icon'   => 'el el-icon-iphone-home',
		'fields' => array(
			array(
				'id'		=> 'mobile_logo',
				'type' 		=> 'media',
				'url'		=> false,
				'readonly' 	=> false,
				'title' 	=> esc_html__('Mobile Logo', 'gosolar'),
				'desc'     	=> esc_html__( "Upload an image or insert an image url to use for the mobile logo.", "gosolar" ),
				'default' 	=> array(
					'url' 		=> '',
					'width' 	=> '',
					'height' 	=> ''
				)
			),
			array(
				'id' 		=> 'mobile_header_visible',
				'type' 		=> 'select',
				'title' 	=> esc_html__('Mobile Header Visiblity', 'gosolar'),
				'subtitle' 	=> esc_html__('Select at what screen size the main header is replaced by the mobile header.', 'gosolar'),
				'options' 	=> array(
					'tablet-land'	=> esc_html__( 'Tablet (Landscape)', 'gosolar' ),
					'tablet-port'	=> esc_html__( 'Tablet (Portrait)', 'gosolar' ),
					'mobile'  		=> esc_html__( 'Mobile', 'gosolar' ),
				),
				'default' 	=> 'tablet-land'
			),
			array(
				'id'		=> 'sticky_mobile_header',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Mobile Sticky Header', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'       	=> 'mobile_header_layout',
				'type'     	=> 'select',
				'title'    	=> esc_html__( 'Mobile Header Layout', 'gosolar' ),
				'subtitle' 	=> esc_html__( 'Choose the config for the layout of the mobile header.', 'gosolar' ),
				'options'  	=> array(
					'left-logo'			=> esc_html__( 'Left Logo', 'gosolar' ),
					'right-logo'		=> esc_html__( 'Right Logo', 'gosolar' ),
					'center-logo'  		=> esc_html__( 'Center Logo (Menu Left)', 'gosolar' ),
					'center-logo-alt'  	=> esc_html__( 'Center Logo (Menu Right)', 'gosolar' ),
				),
				'default'  	=> 'left-logo'
			),
			array(
				'id'		=> 'mobile_top_text',
				'type'     	=> 'textarea',
				'title' 	=> esc_html__('Mobile Top Bar Text', 'gosolar'),
				'subtitle' 	=> esc_html__( 'You can use any shortcodes or text to show above mobile header', 'gosolar' ),
				'desc' 		=> esc_html__( 'Leave blank to hide.', 'gosolar' ),
				'default' 	=> '',
			),
			array(
				'id'		=> 'mobile_show_search',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Enable search box', 'gosolar'),
				'subtitle' 	=> esc_html__('Check this to show the search box in the mobile header.', 'gosolar'),
				'options'  	=> array(
					'1' 	=> esc_html__('On', 'gosolar'),
					'0' 	=> esc_html__('Off', 'gosolar'),
				),
				'default'  => '1'
			),
			array(
				'id'		=> 'mobile_show_translation',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Enable translation options', 'gosolar'),
				'subtitle' 	=> esc_html__('Check this to show the translation options in the mobile header. NOTE: WPML plugin is required for this.', 'gosolar'),
				'options'  	=> array(
					'1' 	=> esc_html__('On', 'gosolar'),
					'0' 	=> esc_html__('Off', 'gosolar'),
				),
				'default'  => '0'
			),
			array(
				'id'		=> 'mobile_social_icons',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Enable mobile social icons', 'gosolar'),
				'subtitle' 	=> esc_html__('Enable yes to show social icons on mobile menu warpper.', 'gosolar'),
				'options'  	=> array(
					'1' 	=> esc_html__('On', 'gosolar'),
					'0' 	=> esc_html__('Off', 'gosolar'),
				),
				'default'  => '1'
			),
		)
	) );
	
		// Page Title Bar Settings
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Page Title Bar', 'gosolar' ),
        'id'     => 'page-title-bar',
        'desc'   => '',
        'icon'   => 'el el-icon-indent-left',
		'fields' => array(
			array(
				'id'		=> 'zozo_enable_breadcrumbs',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Breadcrumbs', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			
			array(
				'id'		=> 'zozo_enable_page_title_bar',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Page Title Bar', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			
			array(
				'id'		=> 'zozo_enable_page_title',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Page Title', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		
			array(
					'id'       	=> 'zozo_page_title_bar_type_new',
					'type'     	=> 'select',
					'title'    	=> esc_html__( 'Page Title Bar Type', 'gosolar' ),
					'subtitle' 	=> esc_html__( 'Choose Page Title Bar Type.', 'gosolar' ),					
					'options'  	=> array(
						'default'		=> esc_html__( 'Default', 'gosolar' ),
						'mini'		=> esc_html__( 'Mini', 'gosolar' ),
					),
					'default'  	=> 'default'
				),
				
			array(
					'id'       	=> 'zozo_page_title_bar_skin_new',
					'type'     	=> 'select',
					'title'    	=> esc_html__( 'Page Title Bar Skin', 'gosolar' ),
					'subtitle' 	=> esc_html__( 'Choose Page Title Bar Skin.', 'gosolar' ),					
					'options'  	=> array(
						'default'		=> esc_html__( 'Default', 'gosolar' ),
						'dark'		=> esc_html__( 'Dark', 'gosolar' ),
					),
					'default'  	=> 'default'
				),
				
			array(
					'id'       	=> 'zozo_page_title_alignment_new',
					'type'     	=> 'select',
					'title'    	=> esc_html__( 'Page Title Alignment', 'gosolar' ),
					'subtitle' 	=> esc_html__( 'Choose Page Title Alignment.', 'gosolar' ),					
					'options'  	=> array(
						'default'		=> esc_html__( 'Default', 'gosolar' ),
						'right'		=> esc_html__( 'Right', 'gosolar' ),
						
						'center'		=> esc_html__( 'Center', 'gosolar' ),
					),
					'default'  	=> 'default'
				),	
				
			array(
				'id'		=> 'zozo_page_title_bar_height',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Page Title Bar Height', 'gosolar'),
				'desc' 		=> esc_html__( 'Enter the height of the page title bar. In pixels ex: 120px.', 'gosolar' ),
				'default' 	=> ""
			),
			
			array(
				'id'		=> 'zozo_page_title_bar_mobile_height',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Page Title Bar Mobile Height', 'gosolar'),
				'desc' 		=> esc_html__( 'Enter the height of the page title bar on mobile. In pixels ex: 120px.', 'gosolar' ),
				'default' 	=> ""
			),
			
			array(
				'id'       		=> 'zozo_page_title_color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Title Color', 'gosolar' ),
				'validate' 		=> 'color',
				'transparent' 	=> false,
			),	
			
			array(
				'id'       		=> 'zozo_page_title_breadcrumbs_color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Breadcrumbs Color', 'gosolar' ),
				'validate' 		=> 'color',
				'transparent' 	=> false,
			),
			
			array(
				'id'       		=> 'zozo_page_title_border_color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Border Color', 'gosolar' ),
				'validate' 		=> 'color',
				'transparent' 	=> false,
			),
			
			array(
				'id'       		=> 'zozo_page_title_background_color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Background Color', 'gosolar' ),
				'validate' 		=> 'color',
				'transparent' 	=> false,
			),
			
			array(
				'id'		=> 'zozo_page_title_background_image',
				'type' 		=> 'media',
				'url'		=> false,
				'readonly' 	=> false,
				'title' 	=> esc_html__('Background Image', 'gosolar'),
				'desc'     	=> esc_html__( "Upload your background image.", "gosolar" ),
			),
			
			array(
					'id'       	=> 'zozo_page_title_background_image_repeat',
					'type'     	=> 'select',
					'title'    	=> esc_html__( 'Background Repeat', 'gosolar' ),										
					'options'  	=> array(
						'repeat'		=> esc_html__( 'Repeat', 'gosolar' ),
						'repeat-x'		=> esc_html__( 'Repeat-x', 'gosolar' ),
						
						'repeat-y'		=> esc_html__( 'Repeat-y', 'gosolar' ),
						
						'no-repeat'		=> esc_html__( 'No Repeat', 'gosolar' ),
					),
					'default'  	=> 'repeat'
				),	
				
			array(
					'id'       	=> 'zozo_page_title_background_position',
					'type'     	=> 'select',
					'title'    	=> esc_html__( 'Background Position', 'gosolar' ),										
					'options'  	=> array(
						'left top'		=> esc_html__( 'Left Top', 'gosolar' ),
						'left center'		=> esc_html__( 'Left Center', 'gosolar' ),
						
						'left bottom'		=> esc_html__( 'Left Bottom', 'gosolar' ),
						
						'center top'		=> esc_html__( 'Center Top', 'gosolar' ),
						'center center'		=> esc_html__( 'Center Center', 'gosolar' ),
						
						'center bottom'		=> esc_html__( 'Center Bottom', 'gosolar' ),
						
						'right top'		=> esc_html__( 'Right Top', 'gosolar' ),
						'right center'		=> esc_html__( 'Right Center', 'gosolar' ),
						
						'right bottom'		=> esc_html__( 'Right Bottom', 'gosolar' ),
					),
					'default'  	=> 'left top'
				),	
				
				array(
				'id'		=> 'zozo_page_title_parallax_bg_image',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Parallax Background Image', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			    ),
				
				array(
				'id'		=> 'zozo_page_title_scale_bg_image',
				'type' 		=> 'checkbox',
				'title' 	=> esc_html__('100% Scale Background Image', 'gosolar'),
				'default' 	=> '0',				
			    ),
				
				array(
				'id'		=> 'zozo_page_title_video_bg',
				'type' 		=> 'checkbox',
				'title' 	=> esc_html__('Enable Video Background ?', 'gosolar'),
				'default' 	=> '0',				
			    ),
				
				array(
				'id'		=> 'zozo_page_title_video_bg_id',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Video ID', 'gosolar'),
				'desc' 		=> esc_html__( 'Enter video id. ex:GHRv565gfg', 'gosolar' ),
				'default' 	=> ""
			),		
					
		)
	) );
	
	
	// Footer Options
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Footer', 'gosolar' ),
        'id'     => 'footer',
        'desc'   => '',
        'icon'   => 'el el-icon-website',
		'fields' => array(
			array(
				'id'		=> 'zozo_copyright_bar_enable',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Copyright Bar', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'       => 'zozo_copyright_text',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Copyright Text', 'gosolar' ),
				'desc'     => esc_html__( 'Enter an copyright text to show on footer. Use [year] shortcode to display current year.', 'gosolar' ),				
				'default'  => sprintf( wp_kses( __( 'Designed by <a href="%s">zozothemes.com</a>', 'gosolar' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( "http://themes.zozothemes.com/" ) )
			),
			array(
				'id'		=> 'zozo_footer_widgets_enable',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Footer Widgets', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_enable_back_to_top',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Back To Top', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'       	=> 'zozo_back_to_top_position',
				'type'     	=> 'select',
				'title'    	=> esc_html__( 'Back To Top Position', 'gosolar' ),
				'subtitle' 	=> esc_html__( 'Choose Back To Top position in footer.', 'gosolar' ),
				'required' 	=> array('zozo_enable_back_to_top', 'equals', true),
				'options'  	=> array(
					'floating_bar'		=> esc_html__( 'Floating Style', 'gosolar' ),
					'footer_top'		=> esc_html__( 'In Footer Top', 'gosolar' ),
				),
				'default'  	=> 'floating_bar'
			),
			array(
				'id'		=> 'zozo_enable_footer_menu',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Footer Menu', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		)
	) );
	
	// Footer Type
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Footer Type', 'gosolar'),
		'id'         => 'footer-footertype',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'		=> 'zozo_footer_copyright_align',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Footer Copyright Bar Align', 'gosolar'),
				'options'  	=> array(
					'left'		=> esc_html__( 'Left', 'gosolar' ),
					'center'	=> esc_html__( 'Center', 'gosolar' ),
				),
				'default' 	=> 'left'
			),
			array(
				'id'		=> 'zozo_footer_skin',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Footer Skin', 'gosolar'),
				'options'  	=> array(
					'light'		=> esc_html__( 'Light', 'gosolar' ),
					'dark'		=> esc_html__( 'Dark', 'gosolar' ),
				),
				'default' 	=> 'dark'
			),
			array(
				'id'		=> 'zozo_footer_style',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Footer Style', 'gosolar'),
				'options'  	=> array(
					'default'	=> esc_html__( 'Normal', 'gosolar' ),
					'sticky'	=> esc_html__( 'Sticky', 'gosolar' ),					
				),
				'default' 	=> 'default'
			),
			array(
				'id'		=> 'zozo_footer_type',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Footer Type', 'gosolar'),
				'options' 	=> array(
					'footer-1' 			=> array('alt' => esc_html__('Default Footer', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/footers/footer-01.jpg'),
					'footer-2' 			=> array('alt' => esc_html__('Footer 3 Column', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/footers/footer-02.jpg'),
					'footer-3' 			=> array('alt' => esc_html__('Footer 3 Column Centered', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/footers/footer-03.jpg'),
					'footer-8' 			=> array('alt' => esc_html__('Footer 3 Column Alt', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/footers/footer-08.jpg'),
					'footer-4' 			=> array('alt' => esc_html__('Footer 2 Column', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/footers/footer-04.jpg'),
					'footer-5' 			=> array('alt' => esc_html__('Footer 2 Column Large', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/footers/footer-05.jpg'),
					'footer-6' 			=> array('alt' => esc_html__('Footer 2 Column Large', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/footers/footer-06.jpg'),							
					'footer-7' 			=> array('alt' => esc_html__('Footer One Column', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/footers/footer-07.jpg'),
				),
				'default' 	=> 'footer-1'
			),
		)
	) );
	
	// Footer Styling Options
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Styling', 'gosolar'),
		'id'         => 'footer-styling',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       			=> 'zozo_footer_spacing',
				'type'     			=> 'spacing',
				'mode'     			=> 'padding',
				'units'         	=> array( 'em', 'px', '%' ),
				'units_extended'	=> 'true',
				'title'    			=> esc_html__( 'Footer Widgets Padding', 'gosolar' ),
				'subtitle' 			=> esc_html__( 'Choose the spacing for footer widgets section.', 'gosolar' ),
			),
			array(
				'id'       			=> 'zozo_footer_copyright_spacing',
				'type'     			=> 'spacing',
				'mode'     			=> 'padding',
				'units'         	=> array( 'em', 'px', '%' ),
				'units_extended'	=> 'true',
				'title'    			=> esc_html__( 'Footer Copyright Bar Padding', 'gosolar' ),
				'subtitle' 			=> esc_html__( 'Choose the spacing for footer copyright bar.', 'gosolar' ),
			),
		)
	) );
	
	// Typography Options
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Typography', 'gosolar' ),
        'id'     => 'typography',
        'desc'   => '',
        'icon'   => 'el el-icon-text-height',
		'fields' => array(
			array(
				'id'       		=> 'zozo_body_font',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'Body Font', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the body font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'font-weight'  	=> true,
				'font-style'  	=> false,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '14px',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-weight' => '400',
					'font-style'  => '',
					'line-height' => '28px',
				),
			),
			array(
				'id'       		=> 'zozo_h1_font_styles',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'H1 Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the H1 font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '45px',
					'font-family' => 'Roboto Slab',
					'google'      => true,
					'font-weight' => '400',
					'font-style'  => '',
					'line-height' => '42px',
				),
			),
			array(
				'id'       		=> 'zozo_h2_font_styles',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'H2 Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the H2 font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '29px',
					'font-family' => 'Roboto Slab',
					'google'      => true,
					'font-weight' => '400',
					'font-style'  => '',
					'line-height' => '35px',
				),
			),
			array(
				'id'       		=> 'zozo_h3_font_styles',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'H3 Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the H3 font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '22px',
					'font-family' => 'Roboto Slab',
					'google'      => true,
					'font-weight' => '400',
					'font-style'  => '',
					'line-height' => '29px',
				),
			),
			array(
				'id'       		=> 'zozo_h4_font_styles',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'H4 Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the H4 font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '20px',
					'font-family' => 'Roboto Slab',
					'google'      => true,
					'font-weight' => '400',
					'font-style'  => '',
					'line-height' => '24px',
				),
			),
			array(
				'id'       		=> 'zozo_h5_font_styles',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'H5 Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the H5 font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '17px',
					'font-family' => 'Roboto Slab',
					'google'      => true,
					'font-weight' => '400',
					'font-style'  => '',
					'line-height' => '20px',
				),
			),
			array(
				'id'       		=> 'zozo_h6_font_styles',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'H6 Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the H6 font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '14px',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-weight' => '400',
					'font-style'  => '',
					'line-height' => '17px',
				),
			),
		)
	) );
	
	// Menu Typography
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Menu', 'gosolar'),
		'id'         => 'typography-menu',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       		=> 'zozo_top_menu_font_styles',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'Top Menu Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the Top menu font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '12px',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-weight' => '400',
					'font-style'  => '',
					'line-height' => '12px',
				),
			),
			array(
				'id'       		=> 'zozo_menu_font_styles',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'Main Menu Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the Main menu font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'line-height'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '14px',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-weight' => '400',
					'font-style'  => '',
				),
			),
			array(
				'id'       		=> 'zozo_submenu_font_styles',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'Sub Menu Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the Sub menu font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '14px',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-weight' => '300',
					'font-style'  => '',
					'line-height' => '20px',
				),
			),
		)
	) );
	
	// Title Typography
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Page/Post', 'gosolar'),
		'id'         => 'typography-title',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       		=> 'zozo_single_post_title_fonts',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'Page/Post Title Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the Page/Post font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '25px',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-weight' => '300',
					'font-style'  => '',
					'line-height' => '35px',
				),
			),
			array(
				'id'       		=> 'zozo_post_title_font_styles',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'Blog Archive Title Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the Blog Archive Title font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '25px',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-weight' => '500',
					'font-style'  => '',
					'line-height' => '24px',
				),
			),
		)
	) );
	
	// Widgets Typography
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Widgets', 'gosolar'),
		'id'         => 'typography-widgets',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       		=> 'zozo_widget_title_fonts',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'Widget Title Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the Widget Title font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '17px',
					'line-height' => '20px',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-weight' => '',
					'font-style'  => '',
				),
			),
			array(
				'id'       		=> 'zozo_widget_text_fonts',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'Widget Text Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the Widget Text font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '15px',
					'line-height' => '28px',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-weight' => '400',
					'font-style'  => '',
				),
			),
			array(
				'id'       		=> 'zozo_footer_widget_title_fonts',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'Footer Widget Title Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the Footer Widget Title font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '17px',
					'line-height' => '20px',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-weight' => '',
					'font-style'  => '',
				),
			),
			array(
				'id'       		=> 'zozo_footer_widget_text_fonts',
				'type'     		=> 'typography',
				'title'    		=> esc_html__( 'Footer Widget Text Font Style', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the Footer Widget Text font properties.', 'gosolar' ),
				'google'   		=> true,
				'subsets'  		=> true,
				'all_styles'  	=> true,
				'text-align'	=> false,
				'default'  		=> array(
					'color'       => '',
					'font-size'   => '15px',
					'line-height' => '28px',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-weight' => '400',
					'font-style'  => '',
				),
			),
		)
	) );
	
	// Skin Options
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Skin', 'gosolar' ),
        'id'     => 'skin',
        'desc'   => '',
        'icon'   => 'el el-icon-broom',
		'fields' => array(
			array(
				'id'		=> 'zozo_theme_skin',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Theme Skin', 'gosolar'),
				'options'  	=> array(
					'light'		=> esc_html__( 'Light', 'gosolar' ),
				),
				'default' 	=> 'light'
			),
			array(
				'id'       		=> 'zozo_custom_scheme_color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Custom Color Scheme', 'gosolar' ),
				'validate' 		=> 'color',
				'transparent' 	=> false,
				'default' 	=> '#6ab43e'
			),
			array(
				'id'       		=> 'zozo_custom_color_skin',
				'type'     		=> 'link_color',
				'title'    		=> esc_html__( 'Custom Color Skin', 'gosolar' ),
				'subtitle' 		=> esc_html__( 'Specify the Color when Custom Color Scheme works as background color.', 'gosolar' ),
				'active'   		=> false,
				'default'  		=> array(
					'regular' 	=> '',
					'hover'   	=> '',							
				)
			),
			array(
				'id'       => 'zozo_link_color',
				'type'     => 'link_color',
				'title'    => esc_html__( 'Link Color', 'gosolar' ),
				'subtitle' => esc_html__( 'Choose link color.', 'gosolar' ),
				'active'   => false,
				'default'  => array(
					'regular' => '#6ab43e',
					'hover'   => '',
				)
			),
		)
	) );
	
	// Body/Page Background
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Body/Page', 'gosolar'),
		'id'         => 'skin-bodypage',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       	=> 'zozo_body_bg_image',
				'type'     	=> 'background',
				'title'    	=> esc_html__( 'Body Background', 'gosolar' ),
				'subtitle' 	=> esc_html__( 'Body background with image, color, etc.', 'gosolar' ),
			),
			array(
				'id'       	=> 'zozo_page_bg_image',
				'type'     	=> 'background',
				'title'    	=> esc_html__( 'Page Background', 'gosolar' ),
				'subtitle' 	=> esc_html__( 'Page background with image, color, etc.', 'gosolar' ),
			),
		)
	) );
	
	// Header Background
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Header', 'gosolar'),
		'id'         => 'skin-header',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       	=> 'zozo_header_bg_image',
				'type'     	=> 'background',
				'title'    	=> esc_html__( 'Header Background', 'gosolar' ),
				'subtitle' 	=> esc_html__( 'Header background with image, color, etc.', 'gosolar' ),
				'default' 	=> ''
			),
			array(
				'id'       	=> 'zozo_sticky_bg_image',
				'type'     	=> 'background',
				'title'    	=> esc_html__( 'Sticky Background', 'gosolar' ),
				'subtitle' 	=> esc_html__( 'Sticky background with image, color, etc.', 'gosolar' ),
				'default' 	=> ''
			),
			array(
				'id'       => 'zozo_header_top_background_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Header Top Background Color', 'gosolar' ),
				'default'  => '#6ab43e',
				'validate' => 'color',
			),
			array(
				'id'       => 'zozo_sliding_background_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Sliding Bar Background Color', 'gosolar' ),
				'default'  => '',
				'validate' => 'color',
			),
		)
	) );
	
	// Menu Background
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Menu', 'gosolar'),
		'id'         => 'skin-menu',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'		=> 'menu_hover',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Menu Hover Colors', 'gosolar'),
				'notice' 	=> false
			),
			array(
				'id'       => 'zozo_top_menu_hcolor',
				'type'     => 'link_color',
				'title'    => esc_html__( 'Top Menu Link Color', 'gosolar' ),
				'subtitle' => esc_html__( 'Choose Top Menu link hover color.', 'gosolar' ),
				'regular'   => false,
				'active'   => false,
				'default'  => array(
					'hover'   => '',							
				)
			),
			array(
				'id'       => 'zozo_main_menu_hcolor',
				'type'     => 'link_color',
				'title'    => esc_html__( 'Main Menu Link Hover Color', 'gosolar' ),
				'subtitle' => esc_html__( 'Choose Main Menu link hover color.', 'gosolar' ),
				'regular'   => false,
				'active'   => false,
				'default'  => array(
					'hover'   => '',							
				)
			),
			array(
				'id'		=> 'submenu_hover',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Menu Dropdown', 'gosolar'),
				'notice' 	=> false
			),
			array(
				'id'		=> 'zozo_submenu_show_border',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Border', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id' 		=> 'zozo_main_submenu_border',
				'type' 		=> 'border',
				'all' 		=> false,
				'title' 	=> esc_html__( 'Dropdown Menu Border', 'gosolar' ),
				'subtitle' 	=> esc_html__( 'Enter border for menu dropdown.', 'gosolar' ),
				'required' 	=> array('zozo_submenu_show_border', 'equals', true),
				'default' 	=> array(
					'border-color'  => '',
					'border-style'  => 'solid',
					'border-top'    => '3px',
					'border-right'  => '0px',
					'border-bottom' => '0px',
					'border-left'   => '0px'
				)
			),
			array(
				'id'       => 'zozo_submenu_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background Color', 'gosolar' ),
				'default'  => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id'       => 'zozo_sub_menu_hcolor',
				'type'     => 'link_color',
				'title'    => esc_html__( 'Sub Menu Link Color', 'gosolar' ),
				'subtitle' => esc_html__( 'Choose Sub Menu link hover color.', 'gosolar' ),
				'regular'   => false,
				'active'   => false,
				'default'  => array(
					'hover'   => '',							
				)
			),
			array(
				'id'       => 'zozo_submenu_hbg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Link Hover Background Color', 'gosolar' ),
				'default'  => '',
				'validate' => 'color',
			),
		)
	) );
	
	// Footer Background
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Footer', 'gosolar'),
		'id'         => 'skin-footer',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       	=> 'zozo_footer_bg_image',
				'type'     	=> 'background',
				'title'    	=> esc_html__( 'Footer Background', 'gosolar' ),
				'subtitle' 	=> esc_html__( 'Footer background with image, color, etc.', 'gosolar' ),
				'default'  => '',
			),
			array(
				'id'       	=> 'zozo_footer_copy_bg_image',
				'type'     	=> 'background',
				'title'    	=> esc_html__( 'Footer Copyright Background', 'gosolar' ),
				'subtitle' 	=> esc_html__( 'Footer copyright bar background with image, color, etc.', 'gosolar' ),
				'default'  => '',
			),
		)
	) );
	
	// Social Colors
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Social', 'gosolar'),
		'id'         => 'skin-social',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'zozo_social_bg_color',
				'type'     => 'link_color',
				'title'    => esc_html__( 'Social Icon Background Color', 'gosolar' ),
				'subtitle' => esc_html__( 'Choose Social Icon Background color and hover color.', 'gosolar' ),
				'active'   => false,
				'default'  => array(
					'regular' => '',
					'hover'   => '',							
				)
			),
			array(
				'id'       => 'zozo_social_icon_color',
				'type'     => 'link_color',
				'title'    => esc_html__( 'Social Icon Color', 'gosolar' ),
				'subtitle' => esc_html__( 'Choose Social Icon color and hover color.', 'gosolar' ),
				'active'   => false,
				'default'  => array(
					'regular' => '',
					'hover'   => '',							
				)
			),
		)
	) );
	
	// Social Icons
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Social', 'gosolar' ),
        'id'     => 'social',
        'desc'   => '',
        'icon'   => 'el el-icon-link',
		'fields' => array(
			array(
				'id'		=> 'zozo_social_icon_type',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Icon Type', 'gosolar'),
				'options' 	=> array(
					'circle' 		=> array('alt' => esc_html__('Circle', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/circle-icon.jpg'),
					'flat' 			=> array('alt' => esc_html__('Square', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/flat-icon.jpg'),
					'rounded' 		=> array('alt' => esc_html__('Rounded', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/rounded-icon.jpg'),
					'transparent' 	=> array('alt' => esc_html__('Transparent', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/transparent-icon.jpg'),
				),
				'default' 	=> 'transparent'
			),
			array(
				'id'		=> 'zozo_facebook_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Facebook', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Facebook icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> "#"
			),
			array(
				'id'		=> 'zozo_twitter_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Twitter', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Twitter icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> "#"
			),
			array(
				'id'		=> 'zozo_linkedin_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('LinkedIn', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for LinkedIn icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> "#"
			),
			array(
				'id'		=> 'zozo_pinterest_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Pinterest', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Pinterest icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> "#"
			),
			array(
				'id'		=> 'zozo_youtube_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Youtube', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Youtube icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_rss_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('RSS', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for RSS icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_tumblr_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Tumblr', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Tumblr icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_reddit_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Reddit', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Reddit icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_dribbble_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Dribbble', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Dribbble icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_digg_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Digg', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Digg icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_flickr_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Flickr', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Flickr icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_instagram_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Instagram', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Instagram icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_vimeo_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Vimeo', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Vimeo icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_skype_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Skype', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Skype icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_blogger_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Blogger', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Blogger icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_yahoo_link',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Yahoo', 'gosolar'),
				'desc' 		=> esc_html__('Enter the link for Yahoo icon to appear. To remove it, just leave it blank.', 'gosolar'),
				'default' 	=> ""
			),
		)
	) );
	
	// Portfolio
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Portfolio', 'gosolar' ),
        'id'     => 'portfolio',
        'desc'   => '',
        'icon'   => 'el el-icon-picture',
		'fields' => array(
			array(
				'id'		=> 'zozo_portfolio_archive_count',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Number of Portfolio Items Per Page', 'gosolar'),
				'desc' 		=> esc_html__('Enter the number of posts to display per page in archive/category.', 'gosolar'),
				'default' 	=> "10"
			),
			array(
				'id'		=> 'zozo_portfolio_archive_layout',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Portfolio Archive/Category Layout', 'gosolar'),
				'options'  	=> array(
					'grid'		=> esc_html__( 'Grid', 'gosolar' ),
					'classic'	=> esc_html__( 'Classic', 'gosolar' ),
				),
				'default' 	=> 'grid'
			),
			array(
				'id'		=> 'zozo_portfolio_archive_columns',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Portfolio Columns', 'gosolar'),
				'options'  	=> array(
					'2' 		=> esc_html__('2 Columns', 'gosolar'),
					'3' 		=> esc_html__('3 Columns', 'gosolar'),
					'4' 		=> esc_html__('4 Columns', 'gosolar')
				),
				'default' 	=> '4'
			),
			array(
				'id'		=> 'zozo_portfolio_archive_gutter',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Portfolio Items Spacing', 'gosolar'),
				'desc' 		=> esc_html__('Enter gap size between portfolio items. Only enter number Ex: 10', 'gosolar'),
				'default' 	=> "30"
			),
			array(
				'id'		=> 'portfolio_details_text',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Portfolio Details', 'gosolar'),
				'notice' 	=> false
			),
			array(
				'id'		=> 'zozo_portfolio_category_label',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Category Label', 'gosolar'),
				'desc' 		=> esc_html__('Change Category label to show in portfolio details.', 'gosolar'),
				'default' 	=> esc_html__('Category:', 'gosolar')
			),

			array(
				'id'		=> 'zozo_portfolio_tag_label',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Tag Label', 'gosolar'),
				'desc' 		=> esc_html__('Change Tag label to show in portfolio details.', 'gosolar'),
				'default' 	=> esc_html__('Tags:', 'gosolar')
			),
			array(
				'id'		=> 'zozo_portfolio_client_label',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Client Label', 'gosolar'),
				'desc' 		=> esc_html__('Change Client label to show in portfolio details.', 'gosolar'),
				'default' 	=> esc_html__('Client:', 'gosolar')
			),
			array(
				'id'		=> 'zozo_portfolio_date_label',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Date Label', 'gosolar'),
				'desc' 		=> esc_html__('Change Date label to show in portfolio details.', 'gosolar'),
				'default' 	=> esc_html__('Date:', 'gosolar')
			),
			array(
				'id'		=> 'zozo_portfolio_estimation_label',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Estimation Label', 'gosolar'),
				'desc' 		=> esc_html__('Change Estimation label to show in portfolio details.', 'gosolar'),
				'default' 	=> esc_html__('Estimation:', 'gosolar')
			),
			array(
				'id'		=> 'zozo_portfolio_duration_label',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Duration Label', 'gosolar'),
				'desc' 		=> esc_html__('Change Duration label to show in portfolio details.', 'gosolar'),
				'default' 	=> esc_html__('Duration:', 'gosolar')
			),
			array(
				'id'		=> 'zozo_portfolio_prev_next',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Post Navigation', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_portfolio_related_slider',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Related Works Slider', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_portfolio_related_title',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Related Works Slider Title', 'gosolar'),
				'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
				'default' 	=> "Related Projects"
			),
			array(
				'id'		=> 'zozo_portfolio_citems',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Display', 'gosolar'),
				'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
				'default' 	=> "3"
			),
			array(
				'id'		=> 'zozo_portfolio_citems_scroll',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Scrollby', 'gosolar'),
				'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
				'default' 	=> "1"
			),
			array(
				'id'		=> 'zozo_portfolio_ctablet',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Tablet', 'gosolar'),
				'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
				'default' 	=> "2"
			),
			array(
				'id'		=> 'zozo_portfolio_cmobile_land',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Landscape', 'gosolar'),
				'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
				'default' 	=> "1"
			),
			array(
				'id'		=> 'zozo_portfolio_cmobile',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Portrait', 'gosolar'),
				'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
				'default' 	=> "1"
			),
			array(
				'id'		=> 'zozo_portfolio_cmargin',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Margin ( Items Spacing )', 'gosolar'),
				'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
				'default' 	=> "20"
			),
			array(
				'id'		=> 'zozo_portfolio_cautoplay',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Autoplay', 'gosolar'),
				'default' 	=> true,
				'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_portfolio_ctimeout',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Timeout Duration (in milliseconds)', 'gosolar'),
				'required' 	=> array('zozo_portfolio_cautoplay', 'equals', true),
				'default' 	=> "5000"
			),
			array(
				'id'		=> 'zozo_portfolio_cloop',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Infinite Loop', 'gosolar'),
				'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_portfolio_cpagination',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Pagination', 'gosolar'),
				'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_portfolio_cnavigation',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Navigation', 'gosolar'),
				'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		)
	) );
	
	// Services
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Services', 'gosolar' ),
        'id'     => 'services',
        'desc'   => '',
        'icon'   => 'el el-icon-star-empty',
		'fields' => array(
			array(
				'id'		=> 'zozo_service_archive_count',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Number of Service Items Per Page', 'gosolar'),
				'desc' 		=> esc_html__('Enter the number of posts to display per page in archive/category.', 'gosolar'),
				'default' 	=> "10"
			),
			array(
				'id'		=> 'zozo_service_archive_columns',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Service Columns', 'gosolar'),
				'options'  	=> array(
					'2' 		=> esc_html__('2 Columns', 'gosolar'),
					'3' 		=> esc_html__('3 Columns', 'gosolar'),
					'4' 		=> esc_html__('4 Columns', 'gosolar')
				),
				'default' 	=> '4'
			),
			array(
				'id'		=> 'icons_service_info',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Services Slider Configuration', 'gosolar'),
				'notice' 	=> false
			),
			array(
				'id'		=> 'zozo_service_citems',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Display', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_service_citems_scroll',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Scrollby', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_service_ctablet',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Tablet', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_service_cmobile_land',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Landscape', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_service_cmobile',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Portrait', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_service_cmargin',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Margin ( Items Spacing )', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_service_cautoplay',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Autoplay', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_service_ctimeout',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Timeout Duration (in milliseconds)', 'gosolar'),
				'default' 	=> "5000"
			),
			array(
				'id'		=> 'zozo_service_cloop',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Infinite Loop', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_service_cpagination',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Pagination', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_service_cnavigation',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Navigation', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		)
	) );
	
	// Casestudies
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Case Studies', 'gosolar' ),
        'id'     => 'casestudies',
        'desc'   => '',
        'icon'   => 'el el-icon-search-alt',
		'fields' => array(
			array(
				'id'		=> 'zozo_casestudy_archive_count',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Number of Case Study Items Per Page', 'gosolar'),
				'desc' 		=> esc_html__('Enter the number of posts to display per page in archive/category.', 'gosolar'),
				'default' 	=> "10"
			),
			array(
				'id'		=> 'zozo_casestudy_archive_columns',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Case Study Columns', 'gosolar'),
				'options'  	=> array(
					'2' 		=> esc_html__('2 Columns', 'gosolar'),
					'3' 		=> esc_html__('3 Columns', 'gosolar'),
					'4' 		=> esc_html__('4 Columns', 'gosolar')
				),
				'default' 	=> '4'
			),
			array(
				'id'		=> 'icons_casestudy_info',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Case Studies Slider Configuration', 'gosolar'),
				'notice' 	=> false
			),
			array(
				'id'		=> 'zozo_casestudy_citems',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Display', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_casestudy_citems_scroll',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Scrollby', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_casestudy_ctablet',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Tablet', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_casestudy_cmobile_land',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Landscape', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_casestudy_cmobile',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Portrait', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_casestudy_cmargin',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Margin ( Items Spacing )', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_casestudy_cautoplay',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Autoplay', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_casestudy_ctimeout',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Timeout Duration (in milliseconds)', 'gosolar'),
				'default' 	=> "5000"
			),
			array(
				'id'		=> 'zozo_casestudy_cloop',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Infinite Loop', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_casestudy_cpagination',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Pagination', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_casestudy_cnavigation',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Navigation', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		)
	) );
	
	
	// Post
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Post', 'gosolar' ),
        'id'     => 'post',
        'desc'   => '',
        'icon'   => 'el el-icon-file',
		'fields' => array(
			array(
				'id'		=> 'zozo_disable_blog_pagination',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Infinite Scroll', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_blog_read_more_text',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Read More Button Text', 'gosolar'),
				'desc' 		=> esc_html__('Enter the custom read more button text.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'blog_excerpt_length',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Excerpt Length', 'gosolar'),
				'notice' 	=> false
			),
			array(
				'id'		=> 'zozo_blog_excerpt_length_large',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Large Layout', 'gosolar'),
				'desc' 		=> esc_html__('Enter the excerpt length for blog style large.', 'gosolar'),
				'default' 	=> "80"
			),
			array(
				'id'		=> 'zozo_blog_excerpt_length_grid',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Grid Layout', 'gosolar'),
				'desc' 		=> esc_html__('Enter the excerpt length for blog style grid.', 'gosolar'),
				'default' 	=> "10"
			),
			array(
				'id'		=> 'zozo_blog_excerpt_length_list',
				'type'     	=> 'text',
				'title' 	=> esc_html__('List Layout', 'gosolar'),
				'desc' 		=> esc_html__('Enter the excerpt length for blog style list.', 'gosolar'),
				'default' 	=> "30"
			),
			array(
				'id'		=> 'gallery_slider',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Blog Gallery Slider', 'gosolar'),
				'notice' 	=> false
			),
			array(
				'id'		=> 'zozo_blog_slideshow_autoplay',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Autoplay for Gallery Slider', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_blog_slideshow_timeout',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Timeout Duration (in milliseconds)', 'gosolar'),
				'required' 	=> array('zozo_blog_slideshow_autoplay', 'equals', true),
				'default' 	=> "5000"
			),
			array(
				'id'		=> 'post_meta',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Blog Post Meta', 'gosolar'),
				'notice' 	=> false
			),
			array(
				'id'		=> 'zozo_blog_date_format',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Post Meta Date Format', 'gosolar'),
				"desc" 		=> "Enter post meta date format. Refer formats from <a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date and Time</a>",
				'default' 	=> "d.m.Y"
			),
			array(
				'id'		=> 'zozo_blog_post_featured_image',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Disable Post Featured Image', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_blog_post_meta_author',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Disable Post Meta Author', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_blog_post_meta_date',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Disable Post Meta Date', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_blog_post_meta_categories',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Disable Post Meta Categories', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_blog_post_meta_comments',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Disable Post Meta Comments', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_blog_read_more',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Disable Read More Link', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		)
	) );
	
	// Blog Archive
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Blog Archive', 'gosolar'),
		'id'         => 'post-blogarchive',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'		=> 'zozo_blog_archive_layout',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Archive Layout', 'gosolar'),
				'options' 	=> array(
					'one-col' 			=> array('alt' => esc_html__('Full width', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/one-col.png'),
					'two-col-right' 	=> array('alt' => esc_html__('Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/two-col-right.png'),
					'two-col-left' 		=> array('alt' => esc_html__('Left Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/two-col-left.png'),
					'three-col-middle' 	=> array('alt' => esc_html__('Left and Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-middle.png'),
					'three-col-right' 	=> array('alt' => esc_html__('Two Right Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-right.png'),
					'three-col-left' 	=> array('alt' => esc_html__('Two Left Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-left.png'),
				),
				'default' 	=> 'two-col-right'
			),
			array(
				'id'		=> 'zozo_archive_blog_type',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Post Layout', 'gosolar'),
				'options' 	=> array(
					'large' 	=> array('alt' => esc_html__('Large Layout', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/blog-large.jpg'),
					'list' 		=> array('alt' => esc_html__('List Layout', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/blog-list.jpg'),
					'grid' 		=> array('alt' => esc_html__('Grid Layout', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/blog-grid.jpg'),					
				),
				'default' 	=> 'large'
			),
			array(
				'id'		=> 'zozo_archive_blog_grid_columns',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Grid Columns', 'gosolar'),
				'required' 	=> array('zozo_archive_blog_type', 'equals', 'grid'),
				'options'  	=> array(
					'two' 		=> esc_html__('2 Columns', 'gosolar'),
					'three' 	=> esc_html__('3 Columns', 'gosolar'),
					'four' 		=> esc_html__('4 Columns', 'gosolar')
				),
				'default' 	=> 'two'
			),
			array(
				'id'		=> 'zozo_show_archive_featured_slider',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Featured Post Slider', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		)
	) );
	
	// Blog
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Blog', 'gosolar'),
		'id'         => 'post-blog',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'		=> 'zozo_blog_page_title_bar',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Page title bar for Blog', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_blog_title',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Blog Page Title', 'gosolar'),	
				'desc' 		=> esc_html__('Blog Page Title for the main blog page.', 'gosolar'),
				'default' 	=> "Our Blog"
			),
			array(
				'id'		=> 'zozo_blog_slogan',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Blog Page Slogan', 'gosolar'),	
				'desc' 		=> esc_html__('Blog Page Slogan for the main blog page.', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_blog_layout',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Blog Layout', 'gosolar'),
				'options' 	=> array(
					'one-col' 			=> array('alt' => esc_html__('Full width', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/one-col.png'),
					'two-col-right' 	=> array('alt' => esc_html__('Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/two-col-right.png'),
					'two-col-left' 		=> array('alt' => esc_html__('Left Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/two-col-left.png'),
					'three-col-middle' 	=> array('alt' => esc_html__('Left and Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-middle.png'),
					'three-col-right' 	=> array('alt' => esc_html__('Two Right Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-right.png'),
					'three-col-left' 	=> array('alt' => esc_html__('Two Left Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-left.png'),
				),
				'default' 	=> 'two-col-right'
			),
			array(
				'id'		=> 'zozo_blog_type',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Post Layout', 'gosolar'),
				'options' 	=> array(
					'large' 	=> array('alt' => esc_html__('Large Layout', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/blog-large.jpg'),
					'list' 		=> array('alt' => esc_html__('List Layout', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/blog-list.jpg'),
					'grid' 		=> array('alt' => esc_html__('Grid Layout', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/blog-grid.jpg'),					
				),
				'default' 	=> 'large'
			),
			array(
				'id'		=> 'zozo_blog_grid_columns',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Grid Columns', 'gosolar'),
				'required' 	=> array('zozo_blog_type', 'equals', 'grid'),
				'options'  	=> array(
					'two' 		=> esc_html__('2 Columns', 'gosolar'),
					'three' 	=> esc_html__('3 Columns', 'gosolar'),
					'four' 		=> esc_html__('4 Columns', 'gosolar')
				),
				'default' 	=> 'two'
			),
			array(
				'id'		=> 'zozo_show_blog_featured_slider',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Featured Post Slider', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		)
	) );
	
	// Single Post Layout
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Single Post', 'gosolar'),
		'id'         => 'post-single',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'		=> 'zozo_single_post_layout',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Single Post Layout', 'gosolar'),
				'options' 	=> array(
					'one-col' 			=> array('alt' => esc_html__('Full width', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/one-col.png'),
					'two-col-right' 	=> array('alt' => esc_html__('Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/two-col-right.png'),
					'two-col-left' 		=> array('alt' => esc_html__('Left Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/two-col-left.png'),
					'three-col-middle' 	=> array('alt' => esc_html__('Left and Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-middle.png'),
					'three-col-right' 	=> array('alt' => esc_html__('Two Right Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-right.png'),
					'three-col-left' 	=> array('alt' => esc_html__('Two Left Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/three-col-left.png'),
				),
				'default' 	=> 'two-col-right'
			),
			array(
				'id'		=> 'zozo_blog_social_sharing',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Social Sharing', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_blog_author_info',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Author Info', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_blog_comments',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Comments', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'related_post_slider',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Related Posts Slider', 'gosolar'),
				'notice' 	=> false
			),
			array(
				'id'		=> 'zozo_show_related_posts',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Related Posts', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_related_blog_items',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Display', 'gosolar'),
				'required' 	=> array('zozo_show_related_posts', 'equals', true),
				'default' 	=> "3"
			),
			array(
				'id'		=> 'zozo_related_blog_items_scroll',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Scrollby', 'gosolar'),
				'required' 	=> array('zozo_show_related_posts', 'equals', true),
				'default' 	=> "1"
			),
			array(
				'id'		=> 'zozo_related_blog_autoplay',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Auto Play', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
				'required' 	=> array('zozo_show_related_posts', 'equals', true),
			),
			array(
				'id'		=> 'zozo_related_blog_timeout',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Timeout Duration (in milliseconds)', 'gosolar'),
				'required' 	=> array('zozo_show_related_posts', 'equals', true),
				'default' 	=> "5000"
			),
			array(
				'id'		=> 'zozo_related_blog_loop',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Infinite Loop', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
				'required' 	=> array('zozo_show_related_posts', 'equals', true),
			),
			array(
				'id'		=> 'zozo_related_blog_margin',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Margin ( Items Spacing )', 'gosolar'),
				'required' 	=> array('zozo_show_related_posts', 'equals', true),
				'default' 	=> "30"
			),
			array(
				'id'		=> 'zozo_related_blog_tablet',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Tablet', 'gosolar'),
				'required' 	=> array('zozo_show_related_posts', 'equals', true),
				'default' 	=> "3"
			),
			array(
				'id'		=> 'zozo_related_blog_landscape',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Landscape', 'gosolar'),
				'required' 	=> array('zozo_show_related_posts', 'equals', true),
				'default' 	=> "2"
			),
			array(
				'id'		=> 'zozo_related_blog_portrait',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Portrait', 'gosolar'),
				'required' 	=> array('zozo_show_related_posts', 'equals', true),
				'default' 	=> "1"
			),
			array(
				'id'		=> 'zozo_related_blog_dots',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Pagination', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
				'required' 	=> array('zozo_show_related_posts', 'equals', true),
			),
			array(
				'id'		=> 'zozo_related_blog_nav',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Navigation', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
				'required' 	=> array('zozo_show_related_posts', 'equals', true),
			),
			array(
				'id'		=> 'zozo_blog_prev_next',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Post Navigation', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'gallery_slider',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Blog Gallery Slider', 'gosolar'),
				'notice' 	=> false
			),
			array(
				'id'		=> 'zozo_single_blog_carousel',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Gallery Slider as Carousel globally ?', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_single_blog_citems',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Display', 'gosolar'),
				'default' 	=> "3"
			),
			array(
				'id'		=> 'zozo_single_blog_citems_scroll',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Scrollby', 'gosolar'),
				'default' 	=> "1"
			),
			array(
				'id'		=> 'zozo_single_blog_cautoplay',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Auto Play', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_single_blog_ctimeout',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Timeout Duration (in milliseconds)', 'gosolar'),
				'default' 	=> "5000"
			),
			array(
				'id'		=> 'zozo_single_blog_cloop',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Infinite Loop', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_single_blog_cmargin',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Margin ( Items Spacing )', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_single_blog_ctablet',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Tablet', 'gosolar'),
				'default' 	=> "3"
			),
			array(
				'id'		=> 'zozo_single_blog_cmlandscape',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Landscape', 'gosolar'),
				'default' 	=> "2"
			),
			array(
				'id'		=> 'zozo_single_blog_cmportrait',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Portrait', 'gosolar'),
				'default' 	=> "1"
			),
			array(
				'id'		=> 'zozo_single_blog_cdots',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Pagination', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_single_blog_cnav',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Navigation', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		)
	) );
	
	// Featured Post Slider
	Redux::setSection( $opt_name, array(
		'title' 	 => esc_html__('Featured Post Slider', 'gosolar'),
		'id'         => 'post-featuredpostslider',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'		=> 'zozo_featured_slider_type',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Featured Post Slider Display', 'gosolar'),
				'options'  	=> array(
					'below_header' 		=> esc_html__('Below Header', 'gosolar'),
					'above_content' 	=> esc_html__('Above Content', 'gosolar'),
					'above_footer' 		=> esc_html__('Above Footer', 'gosolar')
				),
				'default' 	=> 'below_header'
			),
			array(
				'id'		=> 'zozo_featured_posts_limit',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Featured Posts Limit', 'gosolar'),						
				'default' 	=> "6"
			),
			array(
				'id'		=> 'zozo_featured_slider_citems',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Display', 'gosolar'),						
				'default' 	=> "3"
			),
			array(
				'id'		=> 'zozo_featured_slider_citems_scroll',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items to Scrollby', 'gosolar'),						
				'default' 	=> "1"
			),
			array(
				'id'		=> 'zozo_featured_slider_cautoplay',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Auto Play', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_featured_slider_ctimeout',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Timeout Duration (in milliseconds)', 'gosolar'),
				'default' 	=> "5000"
			),
			array(
				'id'		=> 'zozo_featured_slider_cloop',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Infinite Loop', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_featured_slider_cmargin',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Margin ( Items Spacing )', 'gosolar'),
				'default' 	=> ""
			),
			array(
				'id'		=> 'zozo_featured_slider_ctablet',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Tablet', 'gosolar'),
				'default' 	=> "3"
			),
			array(
				'id'		=> 'zozo_featured_slider_cmlandscape',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Landscape', 'gosolar'),
				'default' 	=> "2"
			),
			array(
				'id'		=> 'zozo_featured_slider_cmportrait',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Items To Display in Mobile Portrait', 'gosolar'),
				'default' 	=> "1"
			),
			array(
				'id'		=> 'zozo_featured_slider_cdots',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Pagination', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_featured_slider_cnav',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Navigation', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		)
	) );
	
	// Search Page
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Search Page', 'gosolar' ),
        'id'     => 'search',
        'desc'   => '',
        'icon'   => 'el el-icon-search',
		'fields' => array(
			array(
				'id'		=> 'zozo_search_page_type',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Search Results Layout', 'gosolar'),
				'options' 	=> array(
					'large' 	=> array('alt' => esc_html__('Large Layout', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/blog-large.jpg'),
					'list' 		=> array('alt' => esc_html__('List Layout', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/blog-list.jpg'),
					'grid' 		=> array('alt' => esc_html__('Grid Layout', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS . '/images/layouts/blog-grid.jpg'),					
				),
				'default' 	=> 'grid'
			),
			array(
				'id'		=> 'zozo_search_grid_columns',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Grid Columns', 'gosolar'),
				'required' 	=> array('zozo_search_page_type', 'equals', 'grid'),
				'options'  	=> array(
					'two' 		=> esc_html__('2 Columns', 'gosolar'),
					'three' 	=> esc_html__('3 Columns', 'gosolar'),
					'four' 		=> esc_html__('4 Columns', 'gosolar')
				),
				'default' 	=> 'two'
			),			
			array(
				'id'		=> 'zozo_search_results_content',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Search Results Content', 'gosolar'),
				'options'  	=> array(
					'both' 			=> esc_html__('Posts and Pages', 'gosolar'),
					'only_posts' 	=> esc_html__('Only Posts', 'gosolar'),
					'only_pages' 	=> esc_html__('Only Pages', 'gosolar'),
				),
				'default' 	=> 'only_posts'
			),
		)
	) );
	
	// Social Sharing Options
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Social Share', 'gosolar' ),
        'id'     => 'socialshare',
        'desc'   => '',
        'icon'   => 'el el-icon-share-alt',
		'fields' => array(
			array(
				'id'		=> 'zozo_sharing_facebook',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Facebook Share', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_sharing_twitter',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Twitter Share', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_sharing_linkedin',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable LinkedIn Share', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_sharing_pinterest',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Pinterest Share', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_sharing_tumblr',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Tumblr Share', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_sharing_reddit',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Reddit Share', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_sharing_digg',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Digg Share', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_sharing_email',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Email Share', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		)
	) );
	
		
	// Custom Post Type Options
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Custom Post Types', 'gosolar' ),
        'id'     => 'customposttypes',
        'desc'   => '',
        'icon'   => 'el el-icon-adjust-alt',
		'fields' => array(
			array(
				'id' 		=> 'cpt_disable',
				'type' 		=> 'checkbox',
				'title' 	=> esc_html__('Disable Custom Post Types', 'gosolar'),
				'subtitle' 	=> esc_html__('You can disable the custom post types used within the theme here, by checking the corresponding box.', 'gosolar'),
				'options' 	=> array(
					'zozo_portfolio' 	=> esc_html__( 'Portfolio', 'gosolar' ),
					'zozo_services' 	=> esc_html__( 'Services', 'gosolar' ),
					'zozo_casestudies' 	=> esc_html__( 'Casestudies', 'gosolar' ),
					'zozo_event' 	=> esc_html__( 'Event', 'gosolar' ),
					'zozo_testimonial' 	=> esc_html__( 'Testimonials', 'gosolar' ),
					'zozo_team_member' 	=> esc_html__( 'Team Member', 'gosolar' )
				),
				'default' 	=> array(
					'zozo_portfolio' 	=> '0',
					'zozo_services' 	=> '0',
					'zozo_casestudies' 	=> '0',
					'zozo_event' 	=> '0',
					'zozo_testimonial' 	=> '0',
					'zozo_team_member' 	=> '0',
				)
			),
			array(
				'id'		=> 'portfolio_slug',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Portfolio Slug', 'gosolar'),
				'subtitle' 	=> esc_html__('The slug name cannot be the same name as your portfolio page or the layout will break. This option changes the permalink when you use the permalink type as %postname%.', 'gosolar'),
				'default' 	=> "portfolio"
			),
			array(
				'id'		=> 'portfolio_categories_slug',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Portfolio Categories Slug', 'gosolar'),
				'subtitle' 	=> esc_html__('This option changes the permalink when you use the permalink type as %postname%.', 'gosolar'),
				'default' 	=> "portfolio-categories"
			),
			array(
				'id'		=> 'portfolio_tags_slug',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Portfolio Tags Slug', 'gosolar'),
				'subtitle' 	=> esc_html__('This is portfolio tag slug.', 'gosolar'),
				'default' 	=> "portfolio-tags"
			),
			array(
				'id'		=> 'services_slug',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Services Slug', 'gosolar'),
				'subtitle' 	=> esc_html__('The slug name cannot be the same name as your services page or the layout will break. This option changes the permalink when you use the permalink type as %postname%.', 'gosolar'),
				'desc' 		=> "<strong>Make sure to regenerate permalinks.</strong>",
				'default' 	=> "services"
			),
			array(
				'id'		=> 'service_categories_slug',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Service Categories Slug', 'gosolar'),
				'subtitle' 	=> esc_html__('This option changes the permalink when you use the permalink type as %postname%.', 'gosolar'),
				'desc' 		=> "<strong>Make sure to regenerate permalinks.</strong>",
				'default' 	=> "service-categories"
			),
			array(
				'id'		=> 'casestudies_slug',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Case Studies Slug', 'gosolar'),
				'subtitle' 	=> esc_html__('The slug name cannot be the same name as your casestudies page or the layout will break. This option changes the permalink when you use the permalink type as %postname%.', 'gosolar'),
				'desc' 		=> "<strong>Make sure to regenerate permalinks.</strong>",
				'default' 	=> "case-studies"
			),
			array(
				'id'		=> 'casestudy_categories_slug',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Casestudy Categories Slug', 'gosolar'),
				'subtitle' 	=> esc_html__('This option changes the permalink when you use the permalink type as %postname%.', 'gosolar'),
				'desc' 		=> "<strong>Make sure to regenerate permalinks.</strong>",
				'default' 	=> "case-study-categories"
			),
			array(
				'id'		=> 'event_slug',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Event Slug', 'gosolar'),
				'subtitle' 	=> esc_html__('The slug name cannot be the same name as your event page or the layout will break. This option changes the permalink when you use the permalink type as %postname%.', 'gosolar'),
				'desc' 		=> "<strong>Make sure to regenerate permalinks.</strong>",
				'default' 	=> "event"
			),
			array(
				'id'		=> 'event_categories_slug',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Event Categories Slug', 'gosolar'),
				'subtitle' 	=> esc_html__('This option changes the permalink when you use the permalink type as %postname%.', 'gosolar'),
				'desc' 		=> "<strong>Make sure to regenerate permalinks.</strong>",
				'default' 	=> "event-categories"
			),
		)
	) );
	
	// Woocommerce Options
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Woocommerce', 'gosolar' ),
        'id'     => 'woocommerce',
        'desc'   => '',
        'icon'   => 'el el-icon-shopping-cart',
		'fields' => array(
			array(
				'id'		=> 'zozo_woo_enable_catalog_mode',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Catalog Mode', 'gosolar'),
				'default' 	=> false,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
				'desc' 		=> esc_html__('Enable this setting to set the products into catalog mode, with no cart or checkout process.', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_woo_archive_layout',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Product Archive Layout', 'gosolar'),
				'options' 	=> array(
					'one-col' 			=> array('alt' => esc_html__('Full width', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/one-col.png'),
					'two-col-right' 	=> array('alt' => esc_html__('Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/two-col-right.png'),
					'two-col-left' 		=> array('alt' => esc_html__('Left Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/two-col-left.png'),
					'three-col-middle' 	=> array('alt' => esc_html__('Left and Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/three-col-middle.png'),
					'three-col-right' 	=> array('alt' => esc_html__('Two Right Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/three-col-right.png'),
					'three-col-left' 	=> array('alt' => esc_html__('Two Left Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/three-col-left.png'),
				),
				'default' 	=> 'one-col'
			),
			array(
				'id'		=> 'zozo_woo_single_layout',
				'type' 		=> 'image_select',
				'title' 	=> esc_html__('Single Product Layout', 'gosolar'),
				'options' 	=> array(
					'one-col' 			=> array('alt' => esc_html__('Full width', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/one-col.png'),
					'two-col-right' 	=> array('alt' => esc_html__('Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/two-col-right.png'),
					'two-col-left' 		=> array('alt' => esc_html__('Left Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/two-col-left.png'),
					'three-col-middle' 	=> array('alt' => esc_html__('Left and Right Sidebar', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/three-col-middle.png'),
					'three-col-right' 	=> array('alt' => esc_html__('Two Right Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/three-col-right.png'),
					'three-col-left' 	=> array('alt' => esc_html__('Two Left Sidebars', 'gosolar'), 'img' => GOSOLAR_CORE_ADMIN_ASSETS.'/images/layouts/three-col-left.png'),
				),
				'default' 	=> 'two-col-right'
			),
			array(
				'id'		=> 'zozo_loop_products_per_page',
				'type'     	=> 'text',
				'title' 	=> esc_html__('Products Per Page', 'gosolar'),
				'default' 	=> "12"
			),
			array(
				'id'		=> 'zozo_loop_shop_columns',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Product Columns', 'gosolar'),
				'options'  	=> array(
					'2' 		=> esc_html__('2 Columns', 'gosolar'),
					'3' 		=> esc_html__('3 Columns', 'gosolar'),
					'4' 		=> esc_html__('4 Columns', 'gosolar'),
					'5' 		=> esc_html__('5 Columns', 'gosolar')
				),
				'default' 	=> '3'
			),
			array(
				'id'		=> 'zozo_related_products_count',
				'type'     	=> 'select',
				'title' 	=> esc_html__('Related Products Count', 'gosolar'),
				'options'  	=> array(
					'2' 		=> esc_html__('2 Products', 'gosolar'),
					'3' 		=> esc_html__('3 Products', 'gosolar'),
					'4' 		=> esc_html__('4 Products', 'gosolar'),
					'5' 		=> esc_html__('5 Products', 'gosolar')
				),
				'default' 	=> '3'
			),
			array(
				'id'		=> 'zozo_woo_shop_ordering',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Enable Shop Page Ordering', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_woo_social_sharing',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Show Woocommerce Social Sharing', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
			),
		)
	) );
	
	// Miscellaneous Options
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Miscellaneous', 'gosolar' ),
        'id'     => 'miscellaneous',
        'desc'   => '',
        'icon'   => 'el el-icon-wrench',
		'fields' => array(
			array(
				'id'		=> 'zozo_remove_scripts_version',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Remove Version Parameter From JS & CSS Files', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
				'subtitle' 	=> esc_html__('Most scripts and style-sheets includes query string to identifying the version. This can cause issues with caching and such, which will result in less than optimal load times. You can enable this setting on to remove the query string from such strings.', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_minify_css',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Minify CSS', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
				'subtitle' 	=> esc_html__('This theme makes use of a lot of css styles, use this function to load a single minified file with all the required styles. Disable for testing purposes.', 'gosolar'),
			),
			array(
				'id'		=> 'zozo_minify_js',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Minify JS', 'gosolar'),
				'default' 	=> true,
				'on' 		=> esc_html__('Yes', 'gosolar'),
				'off' 		=> esc_html__('No', 'gosolar'),
				'subtitle' 	=> esc_html__('This theme makes use of a lot of js scripts, use this function to load a single minified file with all the required code. Disable for testing purposes.', 'gosolar'),
			),
		)
	) );
    /*
     * <--- END SECTIONS
     */
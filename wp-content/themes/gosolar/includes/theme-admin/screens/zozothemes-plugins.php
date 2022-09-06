<?php
$zozo_theme = wp_get_theme();
if($zozo_theme->parent_theme) {
    $template_dir =  basename( get_template_directory() );
    $zozo_theme = wp_get_theme($template_dir);
}
$zozo_theme_version = $zozo_theme->get( 'Version' );
$zozo_theme_name = $zozo_theme->get('Name');
$plugins = TGM_Plugin_Activation::$instance->plugins;
$installed_plugins = get_plugins();
$active_action = '';
if( isset( $_GET['plugin_status'] ) ) {
	$active_action = $_GET['plugin_status'];
}
?>
<div class="wrap about-wrap welcome-wrap zozothemes-wrap">
	<h1 class="hide" style="display:none;"></h1>
	<div class="zozothemes-welcome-inner">
		<div class="welcome-wrap">
			<h1><?php echo esc_html__( "Welcome to", "gosolar" ) . ' ' . '<span>'. $zozo_theme_name .'</span>'; ?></h1>
			<div class="theme-logo"><span class="theme-version"><?php echo esc_attr( $zozo_theme_version ); ?></span></div>
			
			<div class="about-text"><?php echo esc_html__( "Nice!", "gosolar" ) . ' ' . $zozo_theme_name . ' ' . esc_html__( "is now installed and ready to use. Get ready to build your site with more powerful wordpress theme. We hope you enjoy using it.", "gosolar" ); ?></div>
		</div>
		<h2 class="zozo-nav-tab-wrapper nav-tab-wrapper">
			<?php
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=gosolar' ),  esc_html__( "Support", "gosolar" ) );
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=gosolar-demos' ), esc_html__( "Install Demos", "gosolar" ) );
			printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', esc_html__( "Plugins", "gosolar" ) );
			?>
		</h2>
	</div>
		
	<div class="zozothemes-required-notices">
		<p class="notice-description"><?php echo esc_html__( "These are the plugins we recommended for GoSolar. Currently GoSolar Core, Revolution Slider and Visual Composer are required plugins that is needed to use in GoSolar. You can activate, deactivate or update the plugins from this tab.", "gosolar" ); ?></p>
	</div>
	
	<div class="zozothemes-plugin-action-notices">
		<?php $plugin_deactivated = '';
		if( isset( $_GET['zozo-deactivate'] ) && $_GET['zozo-deactivate'] == 'deactivate-plugin' ) {
			$plugin_deactivated = $_GET['plugin_name']; ?>		
			<p class="plugin-action-notices deactivate"><?php echo esc_attr( $plugin_deactivated ); ?> plugin <strong>deactivated.</strong></p>
		<?php } ?>
		<?php $plugin_activated = '';
		if( isset( $_GET['zozo-activate'] ) && $_GET['zozo-activate'] == 'activate-plugin' ) {
			$plugin_activated = $_GET['plugin_name']; ?>		
			<p class="plugin-action-notices activate"><?php echo esc_attr( $plugin_activated ); ?> plugin <strong>activated.</strong></p>
		<?php } ?>
	</div>
	
	<div class="zozothemes-demo-wrapper zozothemes-install-plugins">
		<div class="feature-section theme-browser rendered">
			<?php
			foreach( $plugins as $plugin ):
				$class = '';
				$plugin_status = '';
				$active_action_class = '';
				$file_path = $plugin['file_path'];
				$plugin_action = gosolar_plugin_link( $plugin );
				foreach( $plugin_action as $action => $value ) {
					if( $active_action == $action ) {
						$active_action_class = ' plugin-' .$active_action. '';
					}
				}
				
				$is_plg_act = 'is_plug'.'in_active';
				if( $is_plg_act( $file_path ) ) {
					$plugin_status = 'active';
					$class = 'active';
				}
			?>			
			<div class="theme <?php echo esc_attr( $class . $active_action_class ); ?>">
				<div class="install-plugin-inner">
					<div class="theme-screenshot">
						<img src="<?php echo esc_url( $plugin['image_url'] ); ?>" alt="<?php echo esc_attr( $plugin['name'] ); ?>" />
					</div>
					<h3 class="theme-name">
						<?php
						if( $plugin_status == 'active' ) {
							echo sprintf( '<span>%s</span> ', esc_html__( 'Active:', 'gosolar' ) );
						}
						echo esc_html( $plugin['name'] );
						?>
					</h3>
					<div class="theme-actions">
						<?php foreach( $plugin_action as $action ) { echo ( ''. $action ); } ?>
					</div>
					<?php if( isset( $plugin_action['update'] ) && $plugin_action['update'] ): ?>
					<div class="theme-update">Update Available: Version <?php echo esc_attr( $plugin['version'] ); ?></div>
					<?php endif; ?>
	
					<?php if( isset( $installed_plugins[$plugin['file_path']] ) ): ?> 
					<div class="plugin-info">
						<?php echo sprintf('Version %s | %s', $installed_plugins[$plugin['file_path']]['Version'], $installed_plugins[$plugin['file_path']]['Author'] ); ?>
					</div>
					<?php endif; ?>
					<?php if( $plugin['required'] ): ?>
					<div class="plugin-required">
						<?php esc_html_e( 'Required', 'gosolar' ); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	
	<div class="zozothemes-thanks">
        <hr />
    	<p class="description"><?php echo esc_html__( "Thank you for choosing", "gosolar" ) . ' ' . $zozo_theme_name . '.'; ?></p>
    </div>
</div>
<?php
function gosolar_plugin_link( $item ) {
	$installed_plugins = get_plugins();
	$item['sanitized_plugin'] = $item['name'];
	$is_plg_act = 'is_plug'.'in_active';
	
	if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
		$actions = array(
			'install' => sprintf(
				'<a href="%1$s" class="button button-primary" title="Install %2$s">Install</a>',
				esc_url( wp_nonce_url(
					add_query_arg(
						array(
							'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
							'plugin'		=> urlencode( $item['slug'] ),
							'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
							'plugin_source' => urlencode( $item['source'] ),
							'tgmpa-install' => 'install-plugin',
							'return_url' 	=> 'zozothemes_plugins'
						),
						admin_url( TGM_Plugin_Activation::$instance->parent_slug )
					),
					'tgmpa-install',
					'tgmpa-nonce'
				) ),
				$item['sanitized_plugin']
			),
		);
	}
	
	elseif ( is_plugin_inactive( $item['file_path'] ) ) {
		if ( version_compare( $item['version'], $installed_plugins[$item['file_path']]['Version'], '>' ) ) {
			$actions = array(
				'update' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Update %2$s">Update</a>',
					wp_nonce_url(
						add_query_arg(
							array(
								'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'		=> urlencode( $item['slug'] ),
								'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
								'plugin_source' => urlencode( $item['source'] ),
								'tgmpa-update' 	=> 'update-plugin',
								'version' 		=> urlencode( $item['version'] ),
								'return_url' 	=> 'zozothemes_plugins'
							),
							admin_url( TGM_Plugin_Activation::$instance->parent_slug )
						),
						'tgmpa-update',
						'tgmpa-nonce'
					),
					$item['sanitized_plugin']
				),
			);
		} else {
			$actions = array(
				'activate' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
					esc_url( add_query_arg(
						array(
							'plugin'			   	=> urlencode( $item['slug'] ),
							'plugin_name'		  	=> urlencode( $item['sanitized_plugin'] ),
							'plugin_source'			=> urlencode( $item['source'] ),
							'zozo-activate'	   		=> 'activate-plugin',
							'zozo-activate-nonce' 	=> wp_create_nonce( 'zozo-activate' ),
						),
						admin_url( 'admin.php?page=zozothemes-plugins' )
					) ),
					$item['sanitized_plugin']
				),
			);
		}
	}
	
	elseif ( version_compare( $item['version'], $installed_plugins[$item['file_path']]['Version'], '>' ) ) {
		$actions = array(
			'update' => sprintf(
				'<a href="%1$s" class="button button-primary" title="Update %2$s">Update</a>',
				wp_nonce_url(
					add_query_arg(
						array(
							'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
							'plugin'		=> urlencode( $item['slug'] ),
							'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
							'plugin_source' => urlencode( $item['source'] ),
							'tgmpa-update' 	=> 'update-plugin',
							'version' 		=> urlencode( $item['version'] ),
							'return_url' 	=> 'zozothemes_plugins'
						),
						admin_url( TGM_Plugin_Activation::$instance->parent_slug )
					),
					'tgmpa-update',
					'tgmpa-nonce'
				),
				$item['sanitized_plugin']
			),
		);
	} 
	
	elseif ( $is_plg_act( $item['file_path'] ) ) {
		$actions = array(
			'deactivate' => sprintf(
				'<a href="%1$s" class="button button-primary" title="Deactivate %2$s">Deactivate</a>',
				esc_url( add_query_arg(
					array(
						'plugin'					=> urlencode( $item['slug'] ),
						'plugin_name'		  		=> urlencode( $item['sanitized_plugin'] ),
						'plugin_source'				=> urlencode( $item['source'] ),
						'zozo-deactivate'	   		=> 'deactivate-plugin',
						'zozo-deactivate-nonce' 	=> wp_create_nonce( 'zozo-deactivate' ),
					),
					admin_url( 'admin.php?page=zozothemes-plugins' )
				) ),
				$item['sanitized_plugin']
			),
		);
	}
	return $actions;
}
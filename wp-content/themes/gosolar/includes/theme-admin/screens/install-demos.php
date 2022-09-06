<?php
$zozo_theme = wp_get_theme();
if($zozo_theme->parent_theme) {
    $template_dir =  basename( get_template_directory() );
    $zozo_theme = wp_get_theme($template_dir);
}
$zozo_theme_version = $zozo_theme->get( 'Version' );
$zozo_theme_name = $zozo_theme->get('Name');
$zozothemes_url = 'http://zozothemes.com/';
?>
<div class="wrap about-wrap welcome-wrap zozothemes-wrap">
	<h1 class="hide" style="display:none;"></h1>
	<div class="zozothemes-welcome-inner">
		<div class="welcome-wrap">
			<h1><?php echo esc_html__( "Welcome to", "gosolar" ) . ' ' . '<span>'. $zozo_theme_name .'</span>'; ?></h1>
			<p class="theme-logo"><span class="theme-version"><?php echo esc_attr( $zozo_theme_version ); ?></span></p>
			
			<div class="zozo-error zozo-importer-notice importer-notice-error">
				<p><strong><?php echo esc_html__( "We're sorry but the demo data could not import. It is most likely due to low PHP configurations on your server. Please do necessary configurations noticed in Warning message of imported demo.", 'gosolar' ); ?></strong></p>
			</div>
			
			<div class="zozo-updated zozo-importer-notice importer-notice-success"><p><strong><?php echo esc_html__( "Demo data successfully imported. Now, please install and run", "gosolar" ); ?> <a href="<?php echo admin_url();?>plugin-install.php?tab=plugin-information&amp;plugin=regenerate-thumbnails&amp;TB_iframe=true&amp;width=830&amp;height=472" class="thickbox" title="<?php echo esc_html__( "Regenerate Thumbnails", "gosolar" ); ?>"><?php echo esc_html__( "Regenerate Thumbnails", "gosolar" ); ?></a> <?php echo esc_html__( "plugin once", "gosolar" ); ?>.</strong></p></div>
			
			<div class="about-text"><?php echo esc_html__( "Nice!", "gosolar" ) . ' ' . $zozo_theme_name . ' ' . esc_html__( "is now installed and ready to use. Get ready to build your site with more powerful wordpress theme. We hope you enjoy using it.", "gosolar" ); ?></div>
		</div>
		<h2 class="zozo-nav-tab-wrapper nav-tab-wrapper">
			<?php
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=gosolar' ),  esc_html__( "Support", "gosolar" ) );
			printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', esc_html__( "Install Demos", "gosolar" ) );
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=zozothemes-plugins' ), esc_html__( "Plugins", "gosolar" ) );
			?>
		</h2>
	</div>
		
	 <div class="zozothemes-required-notices">
		<p class="notice-description"><?php echo esc_html__( "Installing a demo provides pages, posts, images, theme options, widgets and more. IMPORTANT: The required plugins need to be installed and activated before you install a demo.", "gosolar" ); ?></p>
	</div>
	
	<div class="zozothemes-demo-title">
	<h3 class="one-page"><?php esc_html_e( 'GoSolar Demo', 'gosolar' ); ?></h3>
	</div>
	
	<div class="zozothemes-demo-wrapper">
		<div class="features-section theme-demos theme-browser rendered">
		
			<?php wp_nonce_field( 'gosolar_demo_import_@#$%^&*(', 'gosolar_demo_import_nonce' ); ?>
			
			<!-- Demo - App -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<a href="<?php echo esc_url( 'http://gosolar.catchpixel.com/' ); ?>"><img src="<?php echo esc_url( GOSOLAR_ADMIN_URL . '/images/demo/demo1.jpg'); ?>" /></a>
					</div>
					<h3 class="theme-name" id="demo"><?php echo esc_html__( "Demo", "gosolar" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo" data-demo-revslider="yes" data-rev-count="4" href="#">%1s</a>', esc_html__( "Install", "gosolar" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', esc_url( 'http://gosolar.catchpixel.com/' ), esc_html__( "Preview", "gosolar" ) ); ?>
					</div>
					
					<div class="theme-requirements" data-requirements="<?php printf( '<h2>%1s:</h2> %2s <h3>%3s:</h3><ol><li>%4s</li><li>%5s</li></ol>',
						esc_html__( "WARNING", "gosolar" ),
						esc_html__( "Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.", "gosolar" ),
						esc_html__( "DEMO REQUIREMENTS", "gosolar" ),
						esc_html__( "Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.", "gosolar" ),
						esc_html__( "Contact Form 7 must be installed & activated for the forms to import .", "gosolar" )
						 ); 
					?>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>			
		</div>
	</div>
	
	<div class="zozothemes-thanks">
        <hr />
    	<p class="description"><?php echo esc_html__( "Thank you for choosing", "gosolar" ) . ' ' . $zozo_theme_name . '.'; ?></p>
    </div>
</div>
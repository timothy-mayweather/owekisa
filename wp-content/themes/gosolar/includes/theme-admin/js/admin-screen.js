/*
 * Admin Screen
 * 
 */

( function( $ ) {
	"use strict";
	
	var zozo_admin_screen = {

		install_demos: function() {
			$(document).on( 'click', '.button-install-demo', function(e) {
				e.preventDefault();
				
				var choosed_demo 	= $(this).data('demo-id');
				var sidebar 		= $(this).data('demo-sidebar');
				var rev_slider 		= $(this).data('demo-revslider');
				var rev_slider_count 		= $(this).data('rev-count');
				var loading_wrap 	= $('.zozo-preview-' + choosed_demo);
				var requirement 	= $(this).parents('.demo-inner').find('.theme-requirements').data('requirements');
				var security 		= $("#gosolar_demo_import_nonce").val();
				
				if( choosed_demo !== null ) {
					
					$.confirm({
						theme: 'supervan',
						title: false,
						content: requirement,
						confirmButtonClass: 'btn-success',
    					cancelButtonClass: 'btn-danger',
						confirm: function(){
							loading_wrap.show();
																		
							$('.zozo-importer-notice').hide();
							
							$.ajax({
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'zozo_import_demo_data',
									demo_type: choosed_demo,
									nonce: security
								},
								success: function(response){								
									
									if( response && response.indexOf('imported') == -1 ) {
										$('.importer-notice-error').attr('style', 'display:block !important');
										loading_wrap.hide();
									} else {
										$.ajax({
											type: 'POST',
											url: ajaxurl,
											data: {
												action: 'zozo_import_demo_other_data',
												demo_type: choosed_demo,
												rev_slider: rev_slider,
												rev_slider_count: rev_slider_count,
												nonce: security
											},
											success: function(response){
												if( response && response.indexOf('imported') == -1 ) {
													$('.importer-notice-error').attr('style', 'display:block !important');
												} else {
													$('.importer-notice-success').attr('style', 'display:block !important');
												}
												loading_wrap.hide();
											},
											error: function(){
												$('.importer-notice-error').attr('style', 'display:block !important');
												loading_wrap.hide();
											}
										});
									}
								},
								error: function(){
									$('.importer-notice-error').attr('style', 'display:block !important');
									loading_wrap.hide();
								}
							});
						},
						cancel: function(){}
					});
					
				}
				
			});
		},
		
	};
	
	$(document).ready(function(){
	
		zozo_admin_screen.install_demos();
		
	});
	
})( jQuery );
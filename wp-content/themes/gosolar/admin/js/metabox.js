jQuery.noConflict();
jQuery(document).ready(function($){

	$('.zozo-radio-img-img').on( "click", function(){
		$(this).parent().parent().find('.zozo-radio-img-img').removeClass('zozo-radio-img-selected');
		$(this).addClass('zozo-radio-img-selected');
	});
	
	$('.zozo-radio-img-label, .zozo-radio-img-radio').hide();
	$('.zozo-radio-img-img').show();
	
	$('.zozo-meta-color').wpColorPicker();
	
	$('select.chosen-select').select2({placeholder: "Select Options", allowClear: true});
	var filters = new Array();
	$(".chosen-select").on("change", function(e) {
		if( filters.length === 0 ) {
			var filters_string = $(this).parent().find('.chosen-order').val();
			if( filters_string != '' ) {
				var filters_array = filters_string.split(',');				
				filters = new Array();	
				$.each(filters_array, function(i) {
					if( filters_array[i] != '' ) {						
						filters.push(filters_array[i]);	
					}
				});
			} else if( filters_string === null ) {
				filters = new Array();
			}
			$(this).parent().find('.chosen-order').val('');			
		}
		
		if( e.val === null ) {
			$(this).parent().find('.chosen-order').val('');
			filters = new Array();
		}
				
		if( typeof e.added != "undefined" ) {
			var add_id = e.added.id;			
			filters.push(add_id);			
		}
		
		if( typeof e.removed != "undefined" ) {		
			var remove_id = e.removed.id;			
			var found = $.inArray(remove_id, filters);			
			if (found >= 0) {
				// Element was found, remove it.
				filters.splice(found, 1);
			}
		}
		
		$(this).parent().find('.chosen-order').val(filters);
		
	});
	
	$(".chosen-select").on("select2-removing", function(e) { 
		
		if( filters.length === 0 ) {
			var filters_string = $(this).parent().find('.chosen-order').val();
			if( filters_string != '' ) {
				var filters_array = filters_string.split(',');	
				filters = new Array();
				$.each(filters_array, function(i) {
					if( filters_array[i] != '' ) {						
						filters.push(filters_array[i]);						
					}
				});
			} else if( filters_string === null ) {
				filters = new Array();
			}
			$(this).parent().find('.chosen-order').val('');
		}
	});
	
	$(".chosen-select").on("select2-removed", function(e) {		
		
		var remove_id = e.choice.id;
		
		var found = $.inArray(remove_id, filters);		
		if (found >= 0) {
			// Element was found, remove it.
			filters.splice(found, 1);
		}
		$(this).parent().find('.chosen-order').val(filters);
	});
		
	// Uploader
	// Only show remove button when needed
	$('.zozo-meta-upload').each(function() {
		if ( ! $(this).val() ) {
			$(this).parent('.field-upload').find('.zozo_meta_remove_button').hide();
		}
	});

	// Uploading files
	var file_frame, upload_btn;

	$(document).on( 'click', '.zozo_meta_upload_button', function( event ){

		event.preventDefault();
		
		upload_btn = $(this);

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select image',
			button: {
				text: 'Upload image',
			},						
			multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();
			
			upload_btn.parent('.field-upload').find('.zozo-meta-upload').val( attachment.url );
			upload_btn.parent('.field-upload').find('.zozo-meta-upload-attach_id').val( attachment.id );
			upload_btn.parent('.field-upload').find('.zozo_meta_remove_button').show();
					
		});
		
		// Finally, open the modal.
		if( file_frame ) {
			file_frame.open();
		}
		
	});

	$(document).on( 'click', '.zozo_meta_remove_button', function( event ){	
		$(this).parent('.field-upload').find('.zozo-meta-upload').val('');
		$(this).parent('.field-upload').find('.zozo-meta-upload-attach_id').val('');
		$(this).parent('.field-upload').find('.zozo_meta_remove_button').hide();		
		return false;
	});
	
	// Uploader Advanced
	var frame;
	$( 'body' ).on( 'click', '.zozo_meta_upload_advanced_button', function( e ){

		e.preventDefault();
		
		var upload_btn = $(this);

		if ( ! frame ) {
			// Create the media frame.
			frame = wp.media({
				multiple: 'add',
				filterable: 'uploaded',
				title: 'Select images',
				button: {
					text: 'Upload images',
				},
				library: {
					type: 'image'
				}
			});
		}
		
		// Open media uploader
		frame.open();

		// Remove all attached 'select' event
		frame.off( 'select' );

		// When an image is selected, run a callback.
		frame.on( 'select', function() {
			var selection = frame.state().get('selection').toJSON();
			
			selection = _.filter( selection, function( attachment ) {
				return upload_btn.parent('.field-uploader-advanced').find('.zozo-uploaded-images').children( 'li#item_' + attachment.id ).length == 0;
			});
			
			var ids = _.pluck( selection, 'id' );
			
			var $old_selection = upload_btn.parent( '.field-uploader-advanced' ).find('.zozo-meta-uploader-advanced').val();
			
			$attachments = new Array();
			if( $old_selection != '' ) {
				var selection_array = $old_selection.split(',');
				$.each( selection_array, function(i) {
					if( selection_array[i] != '' ) {						
						$attachments.push(selection_array[i]);						
					}
				});
				$.each( ids, function(i) {
					if( ids[i] != '' ) {						
						$attachments.push(ids[i]);						
					}
				});
			} else {
				$.each( ids, function(i) {
					if( ids[i] != '' ) {						
						$attachments.push(ids[i]);						
					}
				});
			}
			
			if( $attachments.length > 0 ) {
				upload_btn.parent('.field-uploader-advanced').find('.zozo-meta-uploader-advanced').val( $attachments );
				_.each( selection, function( attachment ) {
					if ( attachment.sizes.hasOwnProperty( 'thumbnail' ) ) { 
						var attachment_img = '<img src="'+ attachment.sizes.thumbnail.url + '">';
					}
					else { 
						var attachment_img = '<img src="' + attachment.sizes.full.url +'">';
					}
					
					upload_btn.parent('.field-uploader-advanced').find('.zozo-uploaded-images').append('<li id="item_' + attachment.id +'">' + attachment_img + ' <div class="zozo-image-actions-wrapper"><a title="Edit" class="zozo-edit-file" href="' + attachment.editLink +'" target="_blank">Edit</a> | <a title="Deselect" class="zozo-delete-file" href="#" data-attachment_id="'+ attachment.id +'">&times;</a></div></li>');
				});
			}
		});
		
	});
	
	// Uploader Advanced
	$( '.zozo-uploaded-images' ).on( 'click', '.zozo-delete-file', function( e ){
		e.preventDefault();
		var $this = $( this ),
			$parent = $this.parents( 'li' ),
			$container = $this.closest( '.zozo-uploaded-images' ),
			attachment_id = $this.data( 'attachment_id' );
			
		var $selection = $this.parents( '.field-uploader-advanced' ).find('.zozo-meta-uploader-advanced').val();
		
		$attachments = new Array();
		if( $selection != '' ) {
			var selection_array = $selection.split(',');	
			$attachments = new Array();
			$.each( selection_array, function(i) {
				if( selection_array[i] != '' ) {						
					$attachments.push(selection_array[i]);						
				}
			});
		} else if( $selection === null ) {
			$attachments = new Array();
		}
		
		$this.parents('.field-uploader-advanced' ).find('.zozo-meta-uploader-advanced').val('');
		
		$attachments = $.grep( $attachments, function(value) {
			return value != attachment_id;
		});
		
		$this.parents('.field-uploader-advanced' ).find('.zozo-meta-uploader-advanced').val( $attachments );
		
		$container.find('li#item_' + attachment_id).delay(1000).fadeOut( 'slow', function() {
			$(this).remove();
		});
	});
	
	// Range Slider	
	$('.zozo-rangeslider').each(function() {
		
		var obj   		= $(this);
		var slider_id   = "#" + obj.data('id');
		var val   		= obj.data('val');
		var min_val		= obj.data('min');
		var max_val		= obj.data('max');
		var step  		= obj.data('step');
		
		//slider init
		obj.slider({
			value: val,
			min: min_val,
			max: max_val,
			step: step,
			range: "min",
			slide: function( event, ui ) {
				$(slider_id).val( ui.value );
			}
		});
		
	});
	
	// Tabs
	$('.zozo-page-tabs').each(function() {
		var obj = $(this);
		obj.tabs();
	});
	
	// Icon Selection
    $('.zozo-iconpicker i').on('click', function( event ) {
			
        event.preventDefault();		
		
		var fontName = $(this).attr('data-iconclass');
		
		 if($(this).hasClass('selected')) {
            $(this).removeClass('selected');
			$(this).parent().parent().find('input').attr('value', '');
        } else {
            $('.zozo-iconpicker i').removeClass('selected');
            $(this).addClass('selected');
			$(this).parent().parent().find('input').attr('value', fontName);
        }
		
		return false;
		        
    });
	
	//Metabox Date Picker Script
	if( $('.zozo-metabox-datepicker').length ){
		$('.zozo-metabox-datepicker').each(function() {
			var format = $(this).data('format');
			$(this).datepicker({
				dateFormat : format
			});
		});
	}
});
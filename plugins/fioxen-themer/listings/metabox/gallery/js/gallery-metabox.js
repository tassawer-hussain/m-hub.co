jQuery(function($) {

  	var file_frame;

  	$(document).on('click', '#gallery-metabox a.gallery-add', function(e) {
	 	e.preventDefault();
	 	if(file_frame) file_frame.close();
	 	file_frame = wp.media.frames.file_frame = wp.media({
			title: $(this).data('uploader-title'),
			button: {
			  text: $(this).data('uploader-button-text'),
			},
			multiple: true
	 	});

	 	file_frame.on('select', function(){
			var listIndex = $('#gallery-metabox-list li').index($('#gallery-metabox-list li:last')),
			selection = file_frame.state().get('selection');
			var new_image = true;

			selection.map(function(attachment, i) {
			  	attachment = attachment.toJSON(),
			  	index      = listIndex + (i + 1);
			  	
			  	new_image = true;
			  	$('#gallery-metabox-list li').each(function(i) {
					var val = $(this).find('input:hidden').val();
					if(attachment.id == val){
						new_image = false;
					}
				});

				if(new_image){
				  	var html = '<li>';
				  	html += '<input type="hidden" name="_lt_gallery_images[' + index + ']" value="' + attachment.id + '">';
				  		html += '<img class="image-preview" src="' + attachment.sizes.thumbnail.url + '">';
			  			html += '<a class="change-image" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image"><i class="dashicons dashicons-edit"></i></a>';
			  			html += '<a class="remove-image" href="#"><i class="dashicons dashicons-no-alt"></i></a>';
				  	html += '</li>';
				  	
				  	$('#gallery-metabox-list').append(html);
				}else{
					alert('Photo already exists!');
				}
				
			});

	 	});

	 	makeSortable();
	 	file_frame.open();
  });

  	$(document).on('click', '#gallery-metabox a.change-image', function(e) {
	 	e.preventDefault();
	 	var that = $(this);
	 	if (file_frame) file_frame.close();

	 	file_frame = wp.media.frames.file_frame = wp.media({
			title: $(this).data('uploader-title'),
			button: {
		  		text: $(this).data('uploader-button-text'),
			},
			multiple: false
	 	});

	 	file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();

			that.parent().find('input:hidden').attr('value', attachment.id);
			that.parent().find('img.image-preview').attr('src', attachment.sizes.thumbnail.url);
	 	});

	 file_frame.open();
  });

  	function resetIndex() {
	 	$('#gallery-metabox-list li').each(function(i) {
			$(this).find('input:hidden').attr('name', '_lt_gallery_images[' + i + ']');
	 	});
  	}

  	function makeSortable() {
	 	$('#gallery-metabox-list').sortable({
			opacity: 0.6,
			stop: function() {
		  		resetIndex();
			}
	 	});
  	}

  	$(document).on('click', '#gallery-metabox a.remove-image', function(e) {
	 	e.preventDefault();

	 	$(this).parents('li').animate({ opacity: 0 }, 200, function() {
			$(this).remove();
			resetIndex();
	 	});
  	});

  	makeSortable();

});
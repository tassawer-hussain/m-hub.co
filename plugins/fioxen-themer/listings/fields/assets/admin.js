(function($) {
	"use strict";
	var listingFieldsManager = {
		init: function(){
			this.manageField();
			this.lt_show_hide_parents_elements();
			$('.btn-lt-save-fields').on('click', function(){
			   $('.lt-row-body').addClass("lt-field-visible");
			});
		},
		lt_show_hide_parents_elements: function(e){
			$(document).delegate('#lt-manager-listing-field .edit_field', 'click', function(e){
				e.preventDefault();
				var hiddenDiv = $(this).closest('.lt-repeater-field-wrap').find('.lt-row-body'),
					parentDiv = hiddenDiv.closest('.lt-repeater-field-wrap');

				if(hiddenDiv) {
					hiddenDiv.toggleClass('lt-field-visible');

					if(parentDiv.hasClass('lt-opened')) {
						parentDiv.removeClass('lt-opened').addClass('lt-closed');
					} else {
						parentDiv.removeClass('lt-closed').addClass('lt-opened');
					}
				}
			})
		},
		templateField: function(m){
			//var rand = 'custom_field_' + Math.floor(Math.random() * 1000000);
			var rand = 'custom_field_' + (Math.random() + 1).toString(36).substring(5);
			var html = 
				'<div class="lt-field-row">\
					<div class="lt-repeater-field-wrap lt-column" >\
						<div class="field-row-head lt-move ui-sortable-handle">\
							<div class="field_title">\
								<span>Custom Field</span>\
							<span></span>\
						</div>\
						<div class="lt-header-btn-group">\
							<button class="edit_field"><i class="dashicons-before dashicons-edit"></i></button>\
							<button type="button" class="lt-btn-remove-field"><i class="dashicons-before dashicons-trash"></i></button>\
						</div>\
					</div>\
					<div class="lt-row-body">\
                  <input type="hidden" name="gva_listing_fields[' + m + '][type_field]" value="custom">\
						<div class="form-group">\
							<label>Priority</label>\
							<input type="text" class="field_priority" name="gva_listing_fields[' + m + '][priority]" value="' + m + '">\
						</div>\
						<div class="form-group">\
							<label>Key</label>\
							<input type="text" name="gva_listing_fields[' + m + '][key]" value="' + rand + '" />\
						</div>\
						<div class="form-group">\
							<label>Label</label>\
							<input type="text" name="gva_listing_fields[' + m + '][label]" value="Custom Field" required placeholder="Label">\
						</div>\
						<div class="form-group">\
							<label>Placeholder</label>\
							<input type="text" name="gva_listing_fields[' + m + '][placeholder]" value="" placeholder="">\
						</div>\
						<div class="form-group">\
							<label>Description</label>\
							<input type="text" name="gva_listing_fields[' + m + '][description]" value="" placeholder="">\
						</div>\
						<div class="form-group">\
							<label>Type</label>\
							<select class="lt-field lt_select_filed" name="gva_listing_fields[' + m + '][type]">\
								<option value="text">Text</option>\
								<option value="textarea">Textarea</option>\
							</select>\
						</div>\
						<div class="form-group">\
							<label>Group</label>\
							<select class="lt-field lt_select_filed" name="gva_listing_fields[' + m + '][group]">\
								<option value="general">General</option>\
								<option value="media">Media</option>\
								<option value="location">Location</option>\
								<option value="business">Business</option>\
								<option value="price">Price</option>\
								<option value="social">Social</option>\
								<option value="hours">Business Hours</option>\
								<option value="additional">Additional Info</option>\
								<option value="other" selected="">Other</option>\
							</select>\
						</div>\
						<div class="form-group">\
							<label>\
								<input class="input-checkbox" type="checkbox" name="gva_listing_fields[' + m + '][required]" value="1">\
								Required\
							</label>\
						</div>\
						<div class="form-group">\
							<label>\
								<input class="input-checkbox" type="checkbox" name="gva_listing_fields[' + m + '][disable]" value="0">\
								Disable\
							</label>\
						</div>\
					</div>\
				</div>\
			</div>';
			return html;
		},

		manageField: function(){
			//Add Field
			var m = $('.lt-field-btn_add').attr('data-index');
			$('.lt-field-btn_add').on('click', function(){
				m++;
				var html = listingFieldsManager.templateField(m);
				$(html).insertAfter($('.lt-listing-field-wrap .lt-field-row').last());
			});

			// Delete Field
			$('.lt-btn-remove-field').on('click', function(){
				$(this).parents('.lt-field-row').remove();
			});
		},
	}

	$(document).ready(function(){
		listingFieldsManager.init();
	})

})(jQuery);


(function($) {
	var FioxenListingField = {

		init: function(){
		  	this.initAmeities();
		  	this.initRegions();
		  	this.initFieldSocials();
		  	this.initFieldHours();
		  	this.initFieldBookingType();
		  	this.initFieldAdditionalInfo();
		},

		initAmeities: function(){
		  
		  	FioxenListingField.loadAmeities();
		  	$('ul.job-manager-term-checklist-_lt_category li input').each(function(){
			 	// Trigger Category Click
			 	$(this).on('click', function(){
					FioxenListingField.loadAmeities();
			 	});
		  	});

		 	if( $('#submit-job-form .fieldset-lt_category').length ){
			 	$('#submit-job-form .fieldset-lt_category select').on('change', function(){
					FioxenListingField.loadAmeities();
				});
			}

		},

		loadAmeities: function(){
		  	$('ul.job-manager-term-checklist-lt_amenities').addClass('loading');
		  	$('ul.job-manager-term-checklist-lt_amenities li').addClass('d-none');
		  	$('ul.job-manager-term-checklist-lt_amenities li').removeClass('d-block');

			var cat_ids = [];
			cat_ids.push('all');
			$.each($("input[id*='in-job_listing_category']:checked"), function(){
				cat_ids.push($(this).val());
			});

			//console.log("Categories IDs: " + cat_ids.join(", "));
			if( $('#submit-job-form .fieldset-lt_category').length > 0 ){
				select_val = $('#submit-job-form .fieldset-lt_category .lt_category').val();
				if(select_val){ 
					cat_ids = select_val;
					cat_ids.push('all');
				}
				//console.log(cat_ids);
			}

			$('ul.job-manager-term-checklist-lt_amenities li').each(function(){
				if( FioxenListingField.hasAnyClass($(this), cat_ids, 'cat-') ){
				  	$(this).addClass('d-block');
				  	$(this).removeClass('d-none');
				}
				if( !FioxenListingField.hasAnyClass($(this), cat_ids, 'cat-') ){
				  	$(this).find('input').prop( "checked", false );
				}
			});

			setTimeout(function() {
				$('ul.job-manager-term-checklist-lt_amenities').removeClass('loading');
			}, 500);
		},

		initRegions: function(){
			if($('#lt_field_job_country').length){
			  	var cities_data = fioxen_region_cities.region_cities;
			  	var value = fioxen_region_cities.default_value;
			  	var select_country = $('#lt_field_job_country');
			  	var country = select_country.find(':selected').data('id');
			  	FioxenListingField.loadRegions(cities_data, country, value);
			  
			  	//Load Cities when select Country
			  	select_country.on('change', function(){
			  		var value = $(this).val();
				 	var country = $(this).find('option[value="'+value+'"]').data('id');
				 	FioxenListingField.loadRegions(cities_data, country, value);
			  	});
			  }
		},

		loadRegions: function(cities_data, country, default_value){
		  	//console.log(fioxen_region_cities.region_cities);
		  	$('#lt_field_job_city').addClass('loading');

		  	var html_cities_option = '<option value="">' + fioxen_region_cities.str_select_city + '</option>';
		  	for(var i = 0; i< cities_data.length; i++){
			 	if(cities_data[i]['parent'] == country){

					var selected = '';
					if(default_value == cities_data[i]['slug']) selected = ' selected="selected"';
					html_cities_option += '<option value="' + cities_data[i]['slug'] + '"' + selected + '>' + cities_data[i]['name'] + '</option>';
			 	}
		  	}
		  	$('#lt_field_job_city').html(html_cities_option);
		  	setTimeout(function() {
			 	$('#lt_field_job_city').removeClass('loading');
		  	}, 500);
		},

		hasAnyClass: function(element, classes, prefix) {
			if(classes){
			  	for (var i = 0; i < classes.length; i++) {
				 	if ( element.hasClass(prefix + classes[i]) ) {
						return true;
				 	}
			  	}
			}
		  	return false;
		},

		loadMap: function(){
			if( $('.custom-map-field_map').length < 1 ) return; 
			var map_options = {
          	latitude: 				fioxen_map_options.latitude,
          	longitude: 				fioxen_map_options.longitude,
          	map_zoom: 				fioxen_map_options.map_zoom,
          	map_source: 			fioxen_map_options.map_source,
          	mapbox_token: 			fioxen_map_options.mapbox_token,
          	mapbox_style: 			fioxen_map_options.mapbox_style,
          	google_map_style: 	fioxen_map_options.google_map_style
        	};

		   var latlng = L.latLng(map_options.latitude, map_options.longitude);
		   var map = L.map('custom-map-field_map',{
		   	//Options map
		   }).setView(latlng, map_options.map_zoom);

		   //--Ctrl + mousewhell zoom
      	map.scrollWheelZoom.disable();
        	$("#custom-map-field_map").bind('mousewheel DOMMouseScroll', function (event) {
          	event.stopPropagation();
          	if (event.ctrlKey == true) {
	            event.preventDefault();
	            map.scrollWheelZoom.enable();
	            $('#custom-map-field_map').removeClass('map-scroll');
	            setTimeout(function(){
	              map.scrollWheelZoom.disable();
	            }, 1000);
          	} else {
            	map.scrollWheelZoom.disable();
            	$('#custom-map-field_map').addClass('map-scroll');
          	}
        	});

        	$(window).bind('mousewheel DOMMouseScroll', function (event) {
          	$('#custom-map-field_map').removeClass('map-scroll');
        	})
       //-- End zoom
		   
		   if(map_options.map_source == 'mapbox'){
			 	//--- Use map_source mapbox
			 	//https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png
			 	//https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}
			 	//https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png
			 	L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
					attribution: '',
					maxZoom: 18,
					id: map_options.mapbox_style,
					tileSize: 512,
       			zoomOffset: -1,
					accessToken: map_options.mapbox_token,
			 	}).addTo(map)
				//--- Use map_source mapbox
		  	}

		  	if(map_options.map_source == 'openstreetmap'){
		  		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '',
					maxZoom: 18,
			 	}).addTo(map)
		  	}

		  	if(map_options.map_source == 'google'){
		   	//--- Use map_source google map
	         var styles_gray = [{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "color": "#444444" } ] }, { "featureType": "landscape", "elementType": "all", "stylers": [ { "color": "#f2f2f2" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100 }, { "lightness": 45 } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#cae5f0" }, { "visibility": "on" } ] }];
	         
	         var styles = [];
	         if(map_options.google_map_style){
	         	styles = map_options.google_map_style;
	         }
	         
	         var google_map = L.gridLayer.googleMutant({
	          	type: 'roadmap',
	          	maxZoom: 18,
	          	gestureHandling: 'greedy',
	          	styles: styles
	        	}).addTo(map);
	        //--- Use map_source google map
		   }


		   var markers = L.markerClusterGroup();

		   var marker = L.marker(latlng, {draggable: 'true'}).on('dragend', function(){
		      var position = marker.getLatLng();
		      FioxenListingField.getLatLng(position);
	        	marker.setLatLng(position, {
	          	draggable: 'true'
	        	}).bindPopup(position).update();
		   });

		  	map.addLayer(marker);

		   var geocoder = L.Control.geocoder({

		      defaultMarkGeocode: false

		   }).on('markgeocode', function(e) {
		      //console.log(e);

		      var position = e.geocode.center;

		      marker.setLatLng(position, {
		         draggable: 'true'
		      }).bindPopup(position).update();

		      map.setView(position, map_options.map_zoom);
		      FioxenListingField.getLatLng(position);
		      //$('input.id_job_listing_location_text').val(e.geocode.name);

		   }).addTo(map);

	      var geocoder = new L.Control.Geocoder.Nominatim();
	      var timeout = null;

	      $('.id_job_listing_location_text').on('keyup', function search(e) {
	      	return;
	         var text = $(this).val();
	         clearTimeout(timeout);
	         if ( text) {
	            timeout = setTimeout(function() {
                  geocoder.geocode(text, function(data) {
                    	var html = '';
                    	//console.log(data);
                     for (var i = 0; i < data.length; i++) {
                        html += '<li class="location-item"><a class="location-item-link" data-lat="' + data[i].center.lat + '" data-lng="' + data[i].center.lng + '" ><i class="icon fa fa-map-marker"></i><span class="name">' + data[i].name + '</span></a></li>';
                     }
                     if ( html ) {
                        $('.places_list_autocomplete').html('<ul>' + html + '</ul>').css('display', 'block');
                     }
                  });
	            }, 600);
	         } else {
	            $(".places_list_autocomplete").html('').css('display', 'none');
	         }
	      });

		   $('.places_list_autocomplete').delegate('.location-item-link', 'click', function(){
		        	
	        	var position = {lat: $(this).data('lat'), lng: $(this).data('lng')};
	        
	        	marker.setLatLng(position, {
	          	draggable: 'true'
	        	}).bindPopup(position).update();

	        	map.setView(position, map_options.map_zoom);
	        	//console.log(position);
	        	$('.id_job_listing_location_text').val($(this).find('.name').text())
	        	FioxenListingField.getLatLng(position);
	        	$('.places_list_autocomplete').html('').css('display', 'none');

		   });
		},

		getLatLng: function(latlng) {
        	$('#latitude-text').val( latlng.lat );
        	$('#longitude-text').val( latlng.lng );
      },

      initFieldSocials: function(){
			var m = $('.btn-add_custom_social_item').attr('data-index');
			var key = $('.btn-add_custom_social_item').attr('data-key');
			$('.btn-add_custom_social_item').on('click', function(e){
				e.preventDefault();
				var html = '<div class="social-media-item">\
					<div class="col-width-2 col-select">\
	               <select name="'+key+'[' + m + '][name]">\
	                  <option value="">Select Social Media</option>\
                     <option value="facebook">Facebook</option>\
                     <option value="twitter">Twitter</option>\
                     <option value="instagram">Instagram</option>\
                     <option value="linkedin-in">LinkedIn</option>\
                     <option value="youtube">Youtube</option>\
                     <option value="snapchat">Snapchat</option>\
                     <option value="reddit">Reddit</option>\
                     <option value="tumblr">Tumblr</option>\
                     <option value="pinterest">Pinterest</option>\
                     <option value="discord">Discord</option>\
	            </select>\
	           </div>\
	            <div class="col-width-2 col-link">\
	               <input type="text" name="'+key+'[' + m + '][url]" value="#"/>\
	            </div>\
	            <div class="item-del">\
                  <a class="btn-primary btn-inline-remove btn-remove_social_item" href="#"><i class="las la-trash"></i></a>\
               </div>\
	         </div>\
	         ';
				$('.lt-custom-socials-field .content-inner').append(html);
				m++;
			});
			$(document).delegate('.btn-remove_social_item', 'click', function(e){
				e.preventDefault();
				if (confirm('Do you want remove this item?')) {
					$(this).parents('.social-media-item').remove();
				}
			});
		},

		initFieldAdditionalInfo: function(){
			$('.btn-add-additional_info_item').on('click', function(e){
				var m = $(this).attr('data-index');
				m++;
				var key = $(this).attr('data-key');
				e.preventDefault();
				var html = '<div class="additional-info-item">\
					<div class="col-width-2 col-name">\
	               <input type="text" name="' + key + '[' + m + '][name]" value="" placeholder="Name"/>\
	           </div>\
	            <div class="col-width-2 col-value">\
	               <input type="text" name="' + key + '[' + m + '][val]" value="" placeholder="Value"/>\
	            </div>\
	            <div class="item-del">\
                  <a class="btn-primary btn-inline-remove btn-remove_additional_item" href="#"><i class="las la-trash"></i></a>\
              	</div>\
	         </div>\
	         ';
				$('.lt-custom-additional-info-field .content-inner').append(html);
				$(this).attr('data-index', m);
			});

			$('.btn-remove_additional_item').on('click', function(e){
				e.preventDefault();
				if (confirm('Do you want remove this item?')) {
					$(this).parents('.additional-info-item').remove();
				}
			});
		},

		initFieldHours: function(){
			$('.btn-add_custom_hour_item').on('click', function(e){
				e.preventDefault();
				var m = $(this).attr('data-index');
				var day = $(this).attr('data-day');
				m++;
				var html_options = fioxen_hour_options.html_options;
				var html = '<div class="field-repeater-item">\
                  <select name="lt_hours_items[' + day + '][hrs][' + m + '][from]">' + html_options + '</select>\
                  <select name="lt_hours_items[' + day + '][hrs][' + m + '][to]">' + html_options + '</select>\
                  <a class="btn-primary btn-inline-remove btn-remove_custom_hour_item" href="#"><i class="las la-trash"></i></a>\
               </div>';

            $(this).parents('.field-repeater').find('.content-inner').append(html);
				$(this).attr('data-index', m);
			});

			$(document).delegate('.btn-remove_custom_hour_item', 'click', function(e){
				e.preventDefault();
				if (confirm('Do you want remove this item?')) {
					$(this).parents('.field-repeater-item').remove();
				}
			});
		},

		initFieldBookingType: function(){
			var wrapper = '.lt-custom-booking-type-field';
			var input = '.lt-custom-booking-type-field .field-tab input';
			var id = $(input + ':checked').parent().attr('data-id');
			$(input).parents(wrapper).find('.tab-content-item#' + id).addClass('active');
			$(input + ':checked').parent().addClass('active');
			
			$(input).on('change', function(){
				var id = $(this).parent().attr('data-id');
				$(this).parents(wrapper).find('.tab-content-item').removeClass('active');
				$(this).parents(wrapper).find('.tab-content-item#' + id).addClass('active');
				$(this).parents(wrapper).find('.form-field').removeClass('active');
				$(this).parent().addClass('active');
			});
		}

	}

	$(document).ready(function(){
		FioxenListingField.init();
	});

	$(window).load(function(){
		FioxenListingField.loadMap();
	});

})(jQuery);

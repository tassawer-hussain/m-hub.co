(function($) {

  var markers = [], points =[], map, marker_center, lat_lng_list = [], bounds; 
  var FioxenListing = {

		init: function(){
			this.initResponsive();
		  	this.initMap();
		  	this.uiSlider();
		  	this.iniSelect2();
		  	this.stickyMap();
		  	this.updateListings();
		  	this.sortingResults();
		  	this.initRegions();
		  	this.initMobile();
		  	this.keywordAutoComplete();
		  	this.other();
		},
		 initResponsive: function(){
		  	var _event = $.event,
		  	$special, resizeTimeout;
		  	$special = _event.special.debouncedresize = {
				setup: function () {
					$(this).on("resize", $special.handler);
				},
			 	teardown: function () {
					$(this).off("resize", $special.handler);
			 	},
			 	handler: function (event, execAsap) {
					var context = this,
				  		args = arguments,
				  		dispatch = function () {
					 		event.type = "debouncedresize";
					 		_event.dispatch.apply(context, args);
				  		};
				  	if (resizeTimeout) {
					 	clearTimeout(resizeTimeout);
				  	}
					execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
			 	},
		  		threshold: 150
			};
	 	},

	 	keywordAutoComplete: function(){
	 		var timeout;
	 		$('.lt-search-keyword-autocomplete').blur(function() {
	 			$(this).parents('.search_keywords').removeClass('focus');
	 		}).focus(function() {
        		$(this).parents('.search_keywords').addClass('focus');
      	});

	 		$('.lt-search-keyword-autocomplete').on('keyup', function(e){
	 			var keyword = $(this).val();
	 			var input = $(this);
	 			var wrapper = input.parents('.search_keywords');
	 			var wrapper_result = input.parent().find('.keyword_list_autocomplete');
			 	clearTimeout(timeout);
			 	if(keyword){
			 		if(keyword.length > 1){
			 			wrapper.addClass('lt-input-loading');
				 		timeout = setTimeout(function() {
				 			$html = '';
				 			$.ajax({
								type: 'POST',
								dataType: 'json',
								url: fioxen_ajax_object.ajaxurl,
								data: { 
									'action': 'fioxen_keyword_autocomplete', 
									'keyword': keyword, 
									'security': fioxen_ajax_object.security_nonce
								},
								success: function(data){                    
									wrapper_result.html(data.html).css('display', 'block');
			 						wrapper.removeClass('lt-input-loading');
								},
								error: function(data) {
			 						wrapper.removeClass('lt-input-loading');
				          	}
						  	});
				 		}, 400);
				 	}
			 	}else{
			 		wrapper.removeClass('lt-input-loading');
			 		wrapper_result.html('').css('display', 'none');
					input.val('').trigger('change');
			 	}
	 		});
	 	},

		locationAutoComplete: function(L){
		  var geocoder = new L.Control.Geocoder.Nominatim();
		  var timeout = null;
		  
		  $('.id_listing_location_text').blur(function() {
	 			$(this).parents('.lt_search_location').removeClass('focus');
	 		}).focus(function() {
        		$(this).parents('.lt_search_location').addClass('focus');
      	});

		  	$('.id_listing_location_text').on('keyup', function(e) {
			 	e.preventDefault();
			 	var text = $(this).val();
			 	var wrapper = $(this).parents('.lt_search_location');
			 	clearTimeout(timeout);
			 	if( text ) {
			 		wrapper.addClass('lt-input-loading');
					timeout = setTimeout(function() {
						geocoder.geocode(text, function(data) {
							var html = '';
						  	for (var i = 0; i < data.length; i++) {
							 	html += '<li class="location-item">';
									html += '<a class="location-item-link" data-lat="' + data[i].center.lat + '" data-lng="' + data[i].center.lng + '" >';
									  	html += '<i class="icon fa fa-map-marker"></i>';
									  	html += '<span class="name">' + data[i].name + '</span>';
									  	html += '<span class="information hidden">';
										 	if(data[i].properties.address.state){
												html += '<span class="country">State: ' + data[i].properties.address.state + '</span> - ';
										 	}
									 		if(data[i].properties.address.city){
												html += '<span class="city">City: ' + data[i].properties.address.city + '</span> - ';
									 		}
									 		if(data[i].properties.address.country){
												html += '<span class="country">Country: ' + data[i].properties.address.country + '</span>';
									 		}
											if(data[i].properties.address.country_code){
												html += '<span class="country_code">(' + data[i].properties.address.country_code + ')</span>';
									 		}
								 		html +='</span>';
									html + '</a>';
							 	html += '</li>';
						  	}
						  	if ( html ) {
							 	$('.places_list_autocomplete').html('<ul>' + html + '</ul>').css('display', 'block');
							 	wrapper.removeClass('lt-input-loading');
						  	}
						});
					}, 400);
			 	}else{
					$(".places_list_autocomplete").html('').css('display', 'none');
					$('input#lt_filter_location_value').val('').trigger('change');
					wrapper.removeClass('lt-input-loading');
			 	}
		  	});

		  	$('.places_list_autocomplete').delegate('.location-item-link', 'click', function(){
			 	var position = {lat: $(this).data('lat'), lng: $(this).data('lng')};
		  	});

		  	$('.places_list_autocomplete').delegate('.location-item-link', 'click', function(){
			 	var position = {lat: $(this).data('lat'), lng: $(this).data('lng')};
			 	$('.places_list_autocomplete').html('').css('display', 'none');
			 	$('.id_listing_location_text').val($(this).find('.name').text())
			 	$('input#lt_filter_location_value').val(position['lat'] + ',' + position['lng']).trigger('change'); 
		  	});
		},

		getPoints: function(){

		  	$('.job_listings .listing-block').each(function(){
			 	var id = $(this).find('.data-id').text();
			 	var lat = $(this).find('.data-lat').html();
			 	var lon = $(this).find('.data-lon').html();
			 	var html = $(this).find('.data-html').html();
			 	var icon = '';
			 
			 	$(this).find('.data-logo').each(function(){
					if($(this).html()){
				  		icon = $(this).html();
					}
			 	}); 

			 	if(lat && lon){
			 		var tmp = [id, lat, lon, html, icon];
			 		points.push(tmp); 
			 	}	
		  })
		},

		initMap: function(){

			FioxenListing.locationAutoComplete(L);
		  	var listing_map = $('#lt-listing--map');
		  	if(listing_map.length == 0) return;

		  	var map_options = {
				latitude					: fioxen_map_options.latitude,
				longitude				: fioxen_map_options.longitude,
				map_zoom					: fioxen_map_options.map_zoom,
				map_source				: fioxen_map_options.map_source,
				mapbox_token			: fioxen_map_options.mapbox_token,
				mapbox_style			: fioxen_map_options.mapbox_style,
				google_map_style		: fioxen_map_options.google_map_style,
				mode						: fioxen_map_options.mode
			};
		  
			if(points[0]){
			  	var location_0 = points[0];
			  	latlng = L.latLng( location_0[0], location_0[1] );
			}else{
				if( map_options.latitude && map_options.longitude ){
			  		latlng = L.latLng(map_options.latitude, map_options.longitude);
				}else{
			  		latlng = L.latLng('42.7247484', '-78.0127572');
				}
			}
		
			map = L.map('lt-listing--map',{
				//zoomControl:false
				//zoomSnap: 0.1,
			}).setView(latlng, map_options.map_zoom);

			//--Ctrl + mousewhell zoom
      	map.scrollWheelZoom.disable();
        $("#lt-listing--map").bind('mousewheel DOMMouseScroll', function (event) {
          event.stopPropagation();
          if (event.ctrlKey == true) {
            event.preventDefault();
            map.scrollWheelZoom.enable();
            $('#lt-listing--map').removeClass('map-scroll');
            setTimeout(function(){
              map.scrollWheelZoom.disable();
            }, 1000);
          } else {
            map.scrollWheelZoom.disable();
            $('#lt-listing--map').addClass('map-scroll');
          }
        });

        $(window).bind('mousewheel DOMMouseScroll', function (event) {
          $('#lt-listing--map').removeClass('map-scroll');
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
	         	styles = JSON.parse(map_options.google_map_style);
	         }
	         var google_map = L.gridLayer.googleMutant({
	          	type: 'roadmap',
	          	maxZoom: 18,
	          	gestureHandling: 'greedy',
	          	styles: styles
	        	}).addTo(map);

	        //--- Use map_source google map
		   }

		   if(map_options.mode == 'single'){
			 	var icon_svg = '<svg version="1.1" id="listing-single-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.443 512.443" style="enable-background:new 0 0 512.443 512.443;" xml:space="preserve"><g><g><path d="M220.643,3.003c-71.68,12.8-128,71.68-140.8,143.36c-12.8,69.12,15.36,133.12,64,171.52c48.64,40.96,84.48,94.72,102.4,156.16l10.24,38.4l12.8-38.4c17.92-64,58.88-117.76,107.52-161.28c35.84-30.72,58.88-79.36,58.88-133.12C435.683,69.563,335.843-17.477,220.643,3.003z M256.483,282.043c-56.32,0-102.4-46.08-102.4-102.4s46.08-102.4,102.4-102.4s102.4,46.08,102.4,102.4S312.803,282.043,256.483,282.043z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';

				var icon = new L.DivIcon({
				  	iconSize: [54, 54],
				  	iconAnchor: [27, 54],
				  	popupAnchor: [0, -26],
				  	className: 'gva-icon-map',
				  	html: '<span class="icon-map">' + icon_svg + '<span class="icon-cat"><i class=""></i></span></span>'
				});
			
				var marker = L.marker(L.latLng( map_options.latitude, map_options.longitude ), { icon: icon } );
				map.addLayer(marker);
		   	return;
		   }

		  	// ---Reload Map after update results by ajax
		  	markers = new L.markerClusterGroup();
		  	$('.job_listings').on('updated_results', function(e, result) {

			 	lat_lng_list = [];
			 	points = [];
			 	FioxenListing.getPoints();

			 	//console.log('------- Points -------')
			 	//console.log(points);

			 	if(points.length == 0){
			 		navigator.geolocation.getCurrentPosition(function(location) {
					 	map.setView(L.latLng(location.coords.latitude, location.coords.longitude), 12);
				 	});
				 	return;
			 	}

			 	if(markers != 'undefined'){
				  	map.removeLayer(markers);
			 	}

			 	//marker_center = L.marker(latlng);

			 	//map.addLayer(marker_center);

			 	markers = new L.markerClusterGroup();

			 	var markerList = [];
			 	var icon_svg = '';
			 
			 	for (var i = 0; i < points.length; i++) {
					var point = points[i];
					var popup = point[3];
					icon_svg = FioxenListing.svgPin();
					var icon = new L.DivIcon({
					  	iconSize: [54, 54],
					  	iconAnchor: [27, 54],
					  	popupAnchor: [0, -26],
					  	className: 'gva-logo-map',
					  	html: '<span class="logo-map">' + icon_svg + '<span class="lt-logo">' + point[4] + '</span></span>'
					});
				
					var marker = L.marker(L.latLng(point[1], point[2]), { icon: icon, post_id: point[0] }).bindPopup(popup, {'maxWidth': '500','className' : 'custom'});

					markers.addLayer(marker);
				
					markerList.push(marker);

			  		lat_lng_list.push([point[1], point[2]]);
			 	}

			 	navigator.geolocation.getCurrentPosition(function(location) {
				 	  var marker = L.marker(L.latLng(location.coords.latitude, location.coords.longitude));
				 	  markers.addLayer(marker);
				 	  markerList.push(marker);
			 	});

				map.addLayer(markers);
				bounds = new L.LatLngBounds(lat_lng_list);
				var fit_bounds = map.fitBounds(bounds, { 'padding': [150, 150] });	
				if($(window).width() < 560){
					//map.setZoom(6);
				}
				// var fit_bounds = map.fitBounds(bounds, { 'padding': [10, 10] });	
				
				FioxenListing.stickyMap();

			}); // End update ajax event
		},

		svgPin: function(){
			var icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="54px" height="54px" viewBox="0 0 54 54" style="enable-background:new 0 0 54 54;" xml:space="preserve">';
			 	icon_svg += '<path class="pin-st0" d="M27,54C27,54,27,54,27,54c0.7,0,1.3-0.3,1.7-0.8C41.1,38,47,29.2,47,20.3C47,9.1,38,0,27,0S7,9.1,7,20.3c0,8.7,5.6,17.2,18.3,32.9C25.7,53.7,26.3,54,27,54z"></path>';
			 	icon_svg += '<path class="pin-st1" d="M27,1C16.5,1,8,9.6,8,20.1c0,8.2,5.4,16.2,17.4,31.1c0.4,0.5,1,0.8,1.6,0.8c0,0,0,0,0,0c0.6,0,1.2-0.3,1.6-0.8C40.4,36.9,46,28.6,46,20.1C46,9.6,37.5,1,27,1z M27,36c-8.8,0-16-7.2-16-16S18.2,4,27,4c8.8,0,16,7.2,16,16S35.8,36,27,36z"></path>';
			 	icon_svg += '</svg>';
			 	return icon_svg;
		},

		updateListings: function(){
			$('.job_listings').on('updated_results', function(e, result) {
				$('.lt_results-sorting .results-text .results-number').html(result.found);
			});
		},

		initRegions: function(){
			if($('#filter-listing-country').length == 0) return;
		  	var cities_data = fioxen_region_cities.region_cities;
		  	var value = fioxen_region_cities.default_value;
		  	var select_country = $('#filter-listing-country');
		  	var country = select_country.val();
		  	FioxenListing.loadRegions(cities_data, country, value);
		  
		  //Load Cities when select Country
		  	select_country.on('change', function(){
			 	var country = $(this).val();
			 	FioxenListing.loadRegions(cities_data, country, value);
		  	});
		},

		loadRegions: function(cities_data, country, default_value){
		  
		  $('#filter-listing-city').addClass('loading');
		  	var html_cities_option = '<option value="">' + fioxen_region_cities.str_select_city + '</option>';
		  	for(var i = 0; i< cities_data.length; i++){
			 	if(cities_data[i]['parent'] == country){
					var selected = '';
					if(default_value == cities_data[i]['id']) selected = ' selected="selected"';
					html_cities_option += '<option value="' + cities_data[i]['id'] + '"' + selected + '>' + cities_data[i]['name'] + '</option>';
			 	}
		  	}
		  	$('#filter-listing-city').html(html_cities_option);
		  	setTimeout(function() {
			 	$('#filter-listing-city').removeClass('loading');
		  	}, 500);

		},

		hasAnyClass: function(element, classes, prefix) {
		  	for (var i = 0; i < classes.length; i++) {
			 	if ( element.hasClass(prefix + classes[i]) ) {
					return true;
			 	}
		  	}
		  	return false;
		},

		uiSlider: function(){
			if($('.lt-filter-slider').length == 0) return;
			$('.lt-filter-slider').each(function(){
				var _slider = $(this);
          	var _input = _slider.parents('.lt-filter-distance-slider').find('input[name*=lt_filter_distance]');
          	var _text = _slider.parents('.lt-filter-distance-slider').find('.value-text');
          	var _value = _input.val();
          	$(this).slider({
              	range: "min",
              	value: _value,
              	min: 1,
              	max: 120,
              	slide: function( event, ui ) {
                  _text.text(ui.value);
              	},
              	stop: function( event, ui ) {
                  $('.lt-distance-slider-ui', _slider).attr( "data-value", ui.value );
                  _input.val( ui.value ).trigger('change');
              	}
          	});
      	});
		},

		iniSelect2: function(){
			if($.fn.select2){
			  	$('.option-select2-filter, .fieldset-type-term-select #lt_category').each(function(){
				 	var placeholder = $(this).attr('placeholder');
				 	$(this).select2({
						allowClear : true,
						theme: 'default option-select2-filter',
						placeholder: placeholder
				 	}); 
			  	});

			  	$('.list_job_types').select2({
			  		placeholder: (typeof fioxen_lt_types !== 'undefined') ? fioxen_lt_types.str_select_type : '',
				 	allowClear : true,
			  	});

				$('.option-select2-filter, .list_job_types').on('select2:unselecting', function(e) {
			  		$(this).on('select2:opening', function(e) {
						e.preventDefault();
			  		});
				});
				
				$('.option-select2-filter, .list_job_types').on('select2:unselect', function(e) {
			 		var sel = $(this);
			 		setTimeout(function() {
						sel.off('select2:opening');
			 		}, 1);
				});
			}
		},

		stickyMap: function(){

			if (window.innerWidth < 992){
	         $('.map-sticky').trigger("sticky_kit:detach");
	     	} else {
				var headerFixedHeight= $('.gv-sticky-wrapper').height();
	         $('.map-sticky').stick_in_parent({
	            offset_top: headerFixedHeight,
	            inner_scrolling: false
	         });
	     	}

	     	$(window).on("debouncedresize", function(event) {
				if (window.innerWidth < 992) {
		         $('.map-sticky').trigger("sticky_kit:detach");
		     	} else {
					var headerFixedHeight= $('.gv-sticky-wrapper').height();
		         $('.map-sticky').stick_in_parent({
		            offset_top: headerFixedHeight,
	            	inner_scrolling: false
		         });
		     	}
			});

			// var listing_map = $('#lt-listing--map');
		 //  	if(listing_map.length == 0) return;

			// var headerHeight = $('.header-builder-frontend').height();
			// var headerFixedHeight= $('.gv-sticky-wrapper').height();
			// listing_map.css('top', headerHeight);

			// if( $('.gv-sticky-menu').length > 0 ){
			// 	$(window).on('scroll', function () {
			// 		if($('body').hasClass('header-is-fixed')){
			// 			listing_map.css('top', headerFixedHeight);
			// 		}else{
			// 			listing_map.css('top', headerHeight);
			// 		}
			// 	});
			// }

		},

		sortingResults: function(){
			var _sorting = $('.select_lt_results_sorting');
			var _input = $('.lt_results_sorting');
			_input.val(_sorting.val());
			_sorting.on('change', function(){
				_input.val($(this).val());
				_input.trigger('change');
			});
		},

		initMobile: function(){
			$('.lt-control-search-mobile').on('click', function(e){
				e.preventDefault();
				var lt_filter = $(this).parent().find('.lt-listing-filters');
				if( lt_filter.hasClass('open') ){ 
					lt_filter.removeClass('open');
				}else{
					lt_filter.addClass('open');
				}
			});
			$('.lt-control-search-mobile-close').on('click', function(e){
				e.preventDefault();
				$(this).parent().removeClass('open');
			});
		},



		other: function(){
			var element = $('.lt-filter-by-amenities .filter-by-amenities');
			$('.lt-filter-by-amenities .title').on('click', function(){
				if( !element.is(':visible') ) {
					element.slideDown('normal');
				}else{
					element.slideUp('normal');
				}
			})

			$('.lt-listing-search-form .lt-search-form-main .form-action .btn-action').on('click', function(e){
				e.preventDefault();
				var _form = $(this).parents('.lt-search-form-main');
				sessionStorage.clear();
				var url = _form.attr('action') + '?' + _form.serialize();
				window.location.href = url;
			});

			$('.lt-listing-filters.style-1 .search_submit input').on('click', function(){
				$(this).parents('.lt-listing-filters').removeClass('open');
			});
		}
	}

	$(document).ready(function(){
		FioxenListing.init();

	});


})(jQuery);

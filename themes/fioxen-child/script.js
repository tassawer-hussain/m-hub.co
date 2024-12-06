(function ($) {

	var FioxenListingChild = {

		init: function () {
			this.initRegions();
		},


		initRegions: function () {
			if ($('#th-filter-listing-country').length == 0) return;
			var cities_data = fioxen_region_cities.region_cities;
			var value = fioxen_region_cities.default_value;
			var select_country = $('#th-filter-listing-country');
			var country = select_country.val();
			FioxenListingChild.loadRegions(cities_data, country, value);

			//Load Cities when select Country
			select_country.on('change', function () {
				var country = $(this).val();
				FioxenListingChild.loadRegions(cities_data, country, value);
			});
		},

		loadRegions: function (cities_data, country, default_value) {

			$('#th-filter-listing-city').addClass('loading');
			var html_cities_option = '<option value="">' + fioxen_region_cities.str_select_city + '</option>';
			for (var i = 0; i < cities_data.length; i++) {
				if (cities_data[i]['parent'] == country) {
					var selected = '';
					if (default_value == cities_data[i]['id']) selected = ' selected="selected"';
					html_cities_option += '<option value="' + cities_data[i]['id'] + '"' + selected + '>' + cities_data[i]['name'] + '</option>';
				}
			}
			$('#th-filter-listing-city').html(html_cities_option);
			setTimeout(function () {
				$('#th-filter-listing-city').removeClass('loading');
			}, 500);

		},
	}

	$(document).ready(function () {
		FioxenListingChild.init();

		// Listen for change event on th-filter-listing-country
		$('#th-filter-listing-country').on('change', function() {
			var selectedValue = $(this).val(); // Get the selected value
			console.log(selectedValue);
			$('#filter-listing-country').val(selectedValue).trigger('change'); // Set the value and trigger change event
		});

		// Listen for change event on th-filter-listing-country
		$('#th-filter-listing-city').on('change', function() {
			var selectedValue = $(this).val(); // Get the selected value
			console.log(selectedValue);
			$('#filter-listing-city').val(selectedValue).trigger('change'); // Set the value and trigger change event
		});

	});


})(jQuery);

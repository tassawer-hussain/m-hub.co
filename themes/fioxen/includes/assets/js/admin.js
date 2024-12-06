(function($) {
"use strict";
    $(window).load(function() {
        function gavias_setup_metatabs() {
            //Breacrumb js
            $('.breadcrumb_setting').hide();
            if($('#fioxen_breadcrumb_layout').val() == 'page_options'){
                $('.breadcrumb_setting').show();
            }
            $('#fioxen_breadcrumb_layout').on('change', function(e){
                if($(this).val() == 'page_options'){
                    $('.breadcrumb_setting').show();
                }else{
                    $('.breadcrumb_setting').hide();
                }
            })

            // Show Map Top setting
            $('.setting-lt_show_map_top').hide(); 
            var layout_page = $('#fioxen_lt_layout_page').val();
            if( layout_page == 'filters_left' || layout_page == 'filters_right' || layout_page == 'filters_top'){
                $('.setting-lt_show_map_top').show(); 
            }
            
            if( layout_page == 'full_map' ){
                $('.rwmb-field.grid_setting').hide();
            }

            $('#fioxen_lt_layout_page').on('click', function(e){
                var layout_page = $(this).val();
                if( layout_page == 'filters_left' || layout_page == 'filters_right' || layout_page == 'filters_top'){
                    $('.setting-lt_show_map_top').show(); 
                }else{
                    $('.setting-lt_show_map_top').hide(); 
                }
            });

            //Layout settings
            $('.grid_setting').hide();
            if($('#fioxen_lt_layout_item').val() == 'item-grid-1'){
                $('.grid_setting').show();
            }
            $('#fioxen_lt_layout_item').on('change', function(e){
                if($(this).val() == 'item-grid-1'){
                    $('.grid_setting').show();
                }else{
                    $('.grid_setting').hide();
                }
            })

        }
        gavias_setup_metatabs(); 

        if( $('#page_template, .editor-page-attributes__template select').length > 0){

            var val = $('#page_template, .editor-page-attributes__template select').val();
            if(val == 'page-listing.php'){
                $('#gavias_metaboxes_listings_page').css('display', 'block');
                $('#gavias_metaboxes_sidebar_page').css('display', 'none');
            }else{
                $('#gavias_metaboxes_listings_page').css('display', 'none');
                $('#gavias_metaboxes_sidebar_page').css('display', 'block');
            }

            $('#page_template, .editor-page-attributes__template select').change(function(){
                var val = $(this).val();
                if(val == 'page-listing.php'){
                    $('#gavias_metaboxes_listings_page').css('display', 'block');
                    $('#gavias_metaboxes_sidebar_page').css('display', 'none');
                }else{
                    $('#gavias_metaboxes_listings_page').css('display', 'none');
                    $('#gavias_metaboxes_sidebar_page').css('display', 'block');
                }
            });
        }
  
    }); 
})(jQuery);
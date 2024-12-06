(function($) {
   var GaviasMetaTermAdmin = {

      init: function(){
         this.initTermColorInput();
         this.initTermLogo();
      },

      initTermColorInput: function(){
         if ($('#gva_term_color_input').length > 0 ){ 
            $('#gva_term_color_input').wpColorPicker();
         }
      },

      initTermLogo: function(){
         var custom_uploader = false;
         if( $('#gva_term_icon_image_demo').attr('src') == '' ){
            $('#gva_term_icon_image_demo').css('display', 'none');
         }
         $('.term-add-image').on('click', function(e) {
            e.preventDefault();
            if (custom_uploader) {
               return;
            }

            custom_uploader = wp.media({
               title: 'Choose Image',
               button: {
                  text: 'Choose Image'
               },
               multiple: false
            });

            custom_uploader.open();

             custom_uploader.on('select', function() {
                 attachment = custom_uploader.state().get('selection').first().toJSON();
                 $('#gva_term_icon_image_input').val(attachment.id);
                 $('#gva_term_icon_image_demo').attr('src', attachment.url);
                 $('#gva_term_icon_image_demo').css('display', 'block');
                 console.log(attachment);

             custom_uploader.close();
             custom_uploader = false;
            });
         });  

         $('.term-remove-image').on('click', function(e) {
            $('#gva_term_icon_image_demo').attr('src', '');
            $('#gva_term_icon_image_demo').css('display', 'none');
         });

         var icon_type = $('input[name=gva_term_icon_type]:checked').val();
         if ( icon_type == 'icon_type_font' ) {
            $('.field-icon-type-font').css('display', '');
            $('.field-icon-type-image').css('display', 'none');
         } else {
            $('.field-icon-type-font').css('display', 'none');
            $('.field-icon-type-image').css('display', '');
         }

         $('input[name=gva_term_icon_type]').on('change', function(){
            icon_type = $(this).val();
            if ( icon_type == 'icon_type_font' ) {
               $('.field-icon-type-font').css('display', '');
               $('.field-icon-type-image').css('display', 'none');
            } else {
               $('.field-icon-type-font').css('display', 'none');
               $('.field-icon-type-image').css('display', '');
            }
         });

      },
   }

   $(document).ready(function(){
      GaviasMetaTermAdmin.init();
   });


})(jQuery);

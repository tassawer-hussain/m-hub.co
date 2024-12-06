<?php
   if( !defined( 'ABSPATH' ) ) { exit; }
   global $post;
   wp_enqueue_script('fioxen-listing-fields');
   $post_id = isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id']) ? absint($_REQUEST['job_id']) : $post->ID;
   $result = get_post_meta($post_id, '_lt_place_booking', true);
   if(empty($result)){
      $result = array(
         'type' => 'contact',
         'affiliate' => array(
            'link'   => '',
            'site'   => '',
            'link_2' => '',
            'site_2' => ''
         ),
         'banner' => array(
            'url' => ''
         )
      );
   }
?>

<div class="lt-custom-booking-type-field lt-booking-type-<?php echo esc_attr( $key ); ?>">
   <div class="custom-booking-type-field">
      <div class="field-tab">
         <div class="content-inner">
            <div class="form-field" data-id="booking-info">
               <input type="radio" id="booking_type_info" name="lt_place_booking[type]" value="info" <?php echo esc_attr($result['type'] == 'info' ? 'checked' : '') ?>>
               <label for="booking_type_info"><?php echo esc_html__('Listing Info', 'fioxen') ?></label>
            </div>
            <div class="form-field" data-id="booking-url">
               <input type="radio" id="booking_type_link" name="lt_place_booking[type]" value="link" <?php echo esc_attr($result['type'] == 'link' ? 'checked' : '') ?>>
               <label for="booking_type_link"><?php echo esc_html__('Affiliate Link', 'fioxen') ?></label>
            </div>
            <div class="form-field" data-id="booking-banner">
               <input type="radio" id="booking_type_banner" name="lt_place_booking[type]" value="banner" <?php echo esc_attr($result['type'] == 'banner' ? 'checked' : '') ?>>
               <label for="booking_type_banner"><?php echo esc_html__('Affiliate Banner', 'fioxen') ?></label>
            </div>
            <div class="form-field" data-id="booking-contact">
               <input type="radio" id="booking_type_contact" name="lt_place_booking[type]" value="contact" <?php echo esc_attr($result['type'] == 'contact' ? 'checked' : '') ?>>
               <label for="booking_type_contact"><?php echo esc_html__('Enquiry Form', 'fioxen') ?></label>
            </div>
         </div>
      </div>

      <div class="field-tab-content">
         
         <div class="tab-content-item" id="booking-url">
            <div class="tab-content-inner">
               <div class="form-group">
                  <label><?php echo esc_html__('Booking URL', 'fioxen') ?></label>
                  <input type="text" class="form-control" name="lt_place_booking[affiliate][link]" value="<?php echo esc_attr($result['affiliate']['link']) ?>" placeholder="<?php echo esc_attr__('Link', 'fioxen') ?>">
               </div>
               <div class="form-group">
                  <label><?php echo esc_html__('Booking Site', 'fioxen') ?></label>
                  <input type="text" class="form-control" name="lt_place_booking[affiliate][site]" value="<?php echo esc_attr($result['affiliate']['site']) ?>" placeholder="<?php echo esc_attr__('Site URL', 'fioxen') ?>">
               </div>
               <div class="form-group">
                  <label><?php echo esc_html__('Booking URL 2', 'fioxen') ?></label>
                  <input type="text" class="form-control" name="lt_place_booking[affiliate][link_2]" value="<?php echo esc_attr($result['affiliate']['link_2']) ?>" placeholder="<?php echo esc_attr__('Link', 'fioxen') ?>">
               </div>
               <div class="form-group">
                  <label><?php echo esc_html__('Booking Site 2', 'fioxen') ?></label>
                  <input type="text" class="form-control" name="lt_place_booking[affiliate][site_2]" value="<?php echo esc_attr($result['affiliate']['site_2']) ?>" placeholder="<?php echo esc_attr__('Site URL', 'fioxen') ?>">
               </div>
            </div>   
         </div>   

         <div class="tab-content-item" id="booking-banner">
            <div class="tab-content-inner">
               <div class="form-group">
                  <label><?php echo esc_html__('Link Banner', 'fioxen') ?></label>
                  <input type="text" class="form-control" name="lt_place_booking[banner][url]" value="<?php echo esc_attr($result['banner']['url']) ?>" placeholder="<?php echo esc_attr__('Link', 'fioxen') ?>">
               </div>
            </div>   
         </div>

      </div>
   </div>
</div>

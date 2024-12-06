<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;
   $booking = get_post_meta( $post_id, '_lt_place_booking', true );
   if(empty($booking)){
      $booking = array(
         'type' => 'info'
      );
   }
   if( isset($booking['type']) && $booking['type'] == 'info' ) return;

?>

<div class="gva-listing-booking booking-type-<?php echo esc_attr($booking['type']) ?>">
      <div class="content-inner">
         <?php 
            if( $booking['type'] == 'link' ){
               echo '<div class="booking-online element-item-listing">';
                  echo '<h3 class="block-title">' . esc_html__('Booking Online', 'fioxen-themer') . '</h3>';
                  
                  if( isset($booking['affiliate']['link']) && $booking['affiliate']['link'] ){
                     echo '<div class="booking-online-item">';
                        echo '<a class="btn-booking-online" href="'.esc_url($booking['affiliate']['link']).'">' . esc_html__('Book Now', 'fioxen-themer') . '</a>';
                        if( isset($booking['affiliate']['site']) && $booking['affiliate']['site'] ){
                           echo '<span class="desc">' . esc_html( 'By', 'fioxen-themer' ) . ' ' . $booking['affiliate']['site'] . '</span>';
                        }
                     echo '</div>';
                  }

                  if( isset($booking['affiliate']['link_2']) && $booking['affiliate']['link_2'] ){
                     echo '<div class="booking-online-item">';
                        echo '<a class="btn-booking-online" href="'.esc_url($booking['affiliate']['link_2']).'">' . esc_html__('Book Now', 'fioxen-themer') . '</a>';
                        if( isset($booking['affiliate']['link_2']) && $booking['affiliate']['link_2'] ){
                           echo '<span class="desc">' . esc_html( 'By', 'fioxen-themer' ) . ' ' . $booking['affiliate']['site_2'] . '</span>';
                        }
                     echo '</div>';
                  }
               echo '</div>';
            }
         ?>

         <?php 
            if( $booking['type'] == 'banner' ){
               $banner_image_id = get_post_meta( $post_id, '_lt_banner_image', true );
               $banner_image = wp_get_attachment_image_src( $banner_image_id, 'full' );
               if( isset($banner_image[0]) && $banner_image[0] ){
                  echo '<div class="booking-banner">';
                     echo isset($booking['banner']['url']) && $booking['banner']['url'] ? '<a href="' . $booking['banner']['url'] . '">' : '';
                        echo '<img src="' . esc_url($banner_image[0]) . '" />';
                     echo isset($booking['banner']['url']) && $booking['banner']['url'] ? '</a>' : '';
                  echo '</div>';
               }
            }
         ?>

         <?php 
            if( $booking['type'] == 'contact' ){
               $lt_email = get_post_meta( get_the_ID(), '_lt_email', true );
               $class = '';
               if( empty($lt_email) ){
                  $lt_email = get_the_author_meta( 'email' );
               }
               echo '<div class="booking-contact element-item-listing">';
                  echo '<h3 class="block-title">' . esc_html__( 'Contact Business', 'ziston' ) . '</h3>';
                  echo '<div class="box-content">';
                     echo '<div class="hidden lt-email">';
                        echo '<a href="mailto:' . esc_attr($lt_email) . '"><i class="icon fas fa-envelope"></i></i>' . esc_html($lt_email) . '</a>';
                     echo '</div>';
                     $contact_form_id = fioxen_themer_get_theme_option('lt_single_contact_form', 1415);
                     echo do_shortcode( '[contact-form-7 id="' . esc_attr($contact_form_id) . '" author_email="' . esc_attr($lt_email) . '"]' ); 
                  echo '</div>'; 
               echo '</div>';   
            }
         ?>

      </div>
</div>


<?php
if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly
}

// if (
//          ! isset( $_GET['new'] ) // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Input is used safely.
//          && (
//             'before' === get_option( 'job_manager_paid_listings_flow' )
//             || ! $this->job_id
//          )
//          && ! empty( $_COOKIE['wp-job-manager-submitting-job-id'] )
//          && ! empty( $_COOKIE['wp-job-manager-submitting-job-key'] )
//          && empty( $this->job_id )
//       ) {
//          $job_id     = absint( $_COOKIE['wp-job-manager-submitting-job-id'] );
//          $job_status = get_post_status( $job_id );

//          if (
//             (
//                'preview' === $job_status
//                || 'pending_payment' === $job_status
//             )
//             && get_post_meta( $job_id, '_submitting_key', true ) === $_COOKIE['wp-job-manager-submitting-job-key']
//          ) {
//             $this->job_id      = $job_id;
//             $this->resume_edit = get_post_meta( $job_id, '_submitting_key', true );
//          }
//       }

class Fioxen_Listing_Submit {
   public function __construct(){ 
      add_action( 'job_manager_save_job_listing', array( $this, 'listing_save' ), 10, 2 );
      add_action( 'job_manager_update_job_data', array( $this, 'listing_submit_update_data' ), 10, 2 );
   }

   public function listing_save( $id, $values ){
      if( isset($_POST['_lt_category']) ) {
         if( is_array($_POST['_lt_category']) ) {
            $terms = $_POST['_lt_category'];
         }else{
            $terms = array( $_POST['_lt_category'] );
         }
         wp_set_object_terms( $id, $terms, 'job_listing_category', false );
      }


      // Region
      $lt_regions = false;
      if( isset($_POST['_lt_regions']) ) {
         $lt_regions = $_POST['_lt_regions'];
      }else{
         if(isset($_POST['lt_regions'])){
            $lt_regions = $_POST['lt_regions'];
         }
      }
      if( $lt_regions ) {
         if(is_array($lt_regions)){
            $terms = $lt_regions;
         }else{
            $terms = array($lt_regions);
         }
         wp_set_object_terms( $id, $terms, 'job_listing_region', false );
      }

      // Social Media
      if(isset($_POST['lt_social_items'])){
         $socials = isset($_POST['lt_social_items']) ? $this->sanitize($_POST['lt_social_items']) : [];
         update_post_meta($id, '_lt_socials_media_values', $socials);
         delete_post_meta($id, '_lt_socials_media');
      }

      // Hours
      if(isset($_POST['lt_hours_items'])){
         $hours = $_POST['lt_hours_items'];
         update_post_meta($id, '_lt_hours_value', $hours);
         delete_post_meta($id, '_lt_hours');
      }
      
      // Booking Type
      if(isset($_POST['lt_place_booking'])){
         $booking_type = $_POST['lt_place_booking'];
         update_post_meta($id, '_lt_place_booking', $booking_type);
         delete_post_meta($id, '_lt_booking_type');
      }

      // Additional
      if(isset($_POST['_lt_additional_info'])){
         $additional_info = $_POST['_lt_additional_info'];
         update_post_meta($id, '_lt_additional_info_value', $additional_info);
         delete_post_meta($id, '_lt_additional_info');
      }
     
      $keys = array('_lt_banner_image', '_lt_logo_image', '_lt_gallery_images');
      foreach ($keys as $key) {
         if ( isset($_POST[$key]) && !empty($_POST[$key]) ) {
            update_post_meta( $id, $key, $_POST[$key] );
         } else {
            delete_post_meta( $id, $key);
         }
      }
   }

   public function listing_submit_update_data( $id, $values ) {
      
      if ( isset($values['job']['lt_regions']) && !empty($values['job']['lt_regions']) ) {
         $lt_regions = $values['job']['lt_regions'];
         if(is_array($lt_regions)){
            $terms = $lt_regions;
         }else{
            $terms = array($lt_regions);
         }
         wp_set_object_terms( $id, $terms, 'job_listing_region', false );
      }

      // Social Media
      if(isset($_POST['lt_social_items'])){
         $socials = isset($_POST['lt_social_items']) ? $this->sanitize($_POST['lt_social_items']) : [];
         update_post_meta($id, '_lt_socials_media_values', $socials);
         delete_post_meta($id, '_lt_socials_media');
      }

      // Hours
      if(isset($_POST['lt_hours_items'])){
         $hours = $_POST['lt_hours_items'];
         update_post_meta($id, '_lt_hours_value', $hours);
         delete_post_meta($id, '_lt_hours');
      }
      
      // Booking Type
      if(isset($_POST['lt_place_booking'])){
         $booking_type = $_POST['lt_place_booking'];
         update_post_meta($id, '_lt_place_booking', $booking_type);
         delete_post_meta($id, '_lt_booking_type');
      }

      // Additional
      if(isset($_POST['_lt_additional_info'])){
         $additional_info = $_POST['_lt_additional_info'];
         update_post_meta($id, '_lt_additional_info_value', $additional_info);
         delete_post_meta($id, '_lt_additional_info');
      }

      $keys = array('lt_banner_image', 'lt_logo_image');
      foreach ($keys as $key) {
         $image = '';
         if ( isset($values['job'][$key]) && !empty($values['job'][$key]) ) {
            $image = $values['job'][$key];
            if ( is_numeric($image) ) {
               $image_id = $image;
            } else {
               $image_id = $this->get_attachment_id_from_url($image);
            }

            if($key == 'lt_banner_image'){
               if ( !empty($image_id) ) {
                  update_post_meta( $id, '_thumbnail_id', $image_id );
               } 
            }
            update_post_meta( $id, '_' . $key, $image_id );
         }
      }

      $key = 'lt_gallery_images';
      if( isset($values['job'][$key]) &&!empty($values['job'][$key]) ){
         $images = array();
         $value_images = $values['job'][$key];
         $i = 1;
         if( is_array($value_images) &&! empty($value_images) ) {
            foreach ($value_images as $image) {
               $image_id = 0;
               if( is_numeric($image) ) {
                  $images[] = $image_id = $image;
               }else{
                  $image_id = $this->get_attachment_id_from_url($image);
                  if( !empty($image_id) && is_numeric($image_id) ){
                     $images[] = $image_id;
                  }
               }
               if($i==1){
                  if($image_id){
                     update_post_meta( $id, '_thumbnail_id', $image_id );
                  }
               }
               $i++;
            }
            update_post_meta( $id, '_lt_gallery_images', $images);
         }
      }
   }
   
   public function sanitize($value, $senitize_func = 'sanitize_text_field') {
      $senitize_func = (in_array($senitize_func, [
         'sanitize_email',
         'sanitize_file_name',
         'sanitize_hex_color',
         'sanitize_hex_color_no_hash',
         'sanitize_html_class',
         'sanitize_key',
         'sanitize_meta',
         'sanitize_mime_type',
         'sanitize_sql_orderby',
         'sanitize_option',
         'sanitize_text_field',
         'sanitize_title',
         'sanitize_title_for_query',
         'sanitize_title_with_dashes',
         'sanitize_user',
         'esc_url_raw',
         'wp_filter_nohtml_kses',
      ])) ? $senitize_func : 'sanitize_text_field';

      if(!is_array($value)) {
         return $senitize_func($value);
      } else {
         return array_map(function($inner_value) use ($senitize_func) {
            return self::sanitize($inner_value, $senitize_func);
         }, $value);
      }
   }

   #https://philipnewcomer.net/2012/11/get-the-attachment-id-from-an-image-url-in-wordpress/
   public function get_attachment_id_from_url( $attachment_url = '' ) {

      global $wpdb;
      $attachment_id = false;

      // If there is no url, bail.
      if ( '' == $attachment_url ) {
         return false;
      }

      // Get the upload directory paths
      $upload_dir_paths = wp_upload_dir();

      // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
      if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

         // If this is the URL of an auto-generated thumbnail, get the URL of the original image
         $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

         // Remove the upload path base directory from the attachment URL
         $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

         // Finally, run a custom database query to get the attachment ID from the modified attachment URL
         $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

      }

      return $attachment_id;
   }

}

new Fioxen_Listing_Submit();
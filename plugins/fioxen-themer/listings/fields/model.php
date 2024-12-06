<?php
if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly
}

class Fioxen_LT_Fields_Model {

   private static $instance = null;
   public static function instance() {
      if ( is_null( self::$instance ) ) {
         self::$instance = new self();
      }
      return self::$instance;
   }

   public function default_fields(){
      $fields = array();

      $fields['featured'] = array(
         'label'        => esc_html__('Featured Listing', 'fioxen-themer'),
         'type'         => 'checkbox',
         'required'     => false,
         'priority'     => 1.1,
         'description'  => esc_html__('Featured Listing will be display to top during searches and styling featured.', 'fioxen-themer')
      );
      $fields['lt_claimed'] = array(
         'label'        => esc_html__('Claimed', 'fioxen-themer'),
         'type'         => 'checkbox',
         'required'     => false,
         'priority'     => 1.2,
         'description'  => esc_html__(' The owner has been verified.', 'fioxen-themer')
      );
      $fields['lt_tagline'] = array(
         'label' => esc_html__('Tagline', 'fioxen-themer'),
         'type' => 'text',
         'required' => false,
         'placeholder' => esc_html__('tagline', 'fioxen-themer'),
         'priority'    => 1.3,
         'default'     => '',
         'group'       => 'general'
      );
      $fields['job_expires'] = array(
         'label' => esc_html__('Listing Expiry Date', 'fioxen-themer'),
         'type' => 'date',
         'required' => false,
         'placeholder' => esc_html__('Listing Expiry Date', 'fioxen-themer'),
         'priority'    => 1.4
      );
      // Category and Amenities
      $fields['lt_heading_2'] = array(
         'label' => esc_html__( 'Listing Category and Amenities', 'fioxen-themer' ),
         'type'        => 'custom-heading',
         'priority'     => 2.1,
         'required' => false,
         'heading_under' => false
      );
      $fields['lt_category'] = array(
         'label'       => esc_html__( 'Listing Category', 'fioxen-themer' ),
         'type'        => 'term-checklist',
         'taxonomy'    => 'job_listing_category',
         'priority'    => 2.3,
         'required'    => false, 
         'placeholder' => esc_html__( 'Add Category', 'fioxen-themer' ),
         'group'       => 'general'
      );
      $fields['lt_amenities'] = array(
         'type' => 'term-checklist',
         'default' => '',
         'taxonomy' => 'job_listing_amenity',
         'priority'     => 2.4,
         'required' => false, 
         'placeholder' => esc_html__( 'Add Amenity', 'fioxen-themer' ),
         'label' => esc_html__( 'Listing Amenity', 'fioxen-themer' ),
         'group'       => 'general'
      );
      //Video 
      $fields['lt_heading_3'] = array(
         'label' => esc_html__( 'Listing Media', 'fioxen-themer' ),
         'type'        => 'custom-heading',
         'priority'     => 3.0,
         'required' => false,
         'heading_under' => true
      );
      $fields['lt_logo_image'] = array(
         'label'        => esc_html__( 'Listing Logo', 'fioxen-themer' ),
         'priority'     => 3.1,
         'required'     => false,
         'type'         => 'file',
         'ajax'         => true,
         'placeholder'  => '',
         'multiple'     => false,
         'allow_types'  => array(
            'jpg|jpeg|jpe',
            'jpeg',
            'gif',
            'png',
         ),
         'group'       => 'media'
      );
      $fields['lt_gallery_images'] = array(
         'label' => esc_html__( 'Listing Gallery', 'fioxen-themer' ),
         'priority' => 3.2,
         'required' => false,
         'type' => 'file',
         'ajax' => true,
         'placeholder' => '',
         'multiple'    => true,
         'allow_types' => array(
            'jpg|jpeg|jpe',
            'jpeg',
            'gif',
            'png',
         ),
         'description'     => esc_html__('The first image will be featured image of Listing'),
         'group'       => 'media'
      );
      $fields['lt_banner_image'] = array(
         'label' => esc_html__( 'Listing Banner Image', 'fioxen-themer' ),
         'priority'        => 3.3,
         'required'        => false,
         'type'            => 'file',
         'ajax'            => true,
         'placeholder'     => '',
         'multiple'        => false,
         'description'     => esc_html__('Optional for Booking Type = Banner'),
         'allow_types'     => array(
            'jpg|jpeg|jpe',
            'jpeg',
            'gif',
            'png',
         ),
         'group'           => 'media'
      );

      $fields['lt_video'] = array(
         'label'        => esc_html__( 'Listing Video', 'fioxen-themer' ),
         'type'         => 'text',
         'priority'     => 3.4,
         'required'     => false, 
         'placeholder' => esc_html__( 'Listing Video Link', 'fioxen-themer' ),
         'group'        => 'media'
      );
      //Location Information
      $fields['lt_heading_4'] = array(
         'label' => esc_html__( 'Listing Location Information', 'fioxen-themer' ),
         'type'        => 'custom-heading',
         'priority'     => 4.0,
         'required' => false,
         'heading_under' => false
      );
      $fields['lt_regions'] = array(
         'label'        => esc_html__( 'Listing Region', 'fioxen-themer' ),
         'type'         => 'custom-regions',
         'taxonomy'     => 'job_listing_region',
         'priority'     => 4.1,
         'required'     => false, 
         'placeholder'  => esc_html__( 'Select Region', 'fioxen-themer' ),
         'group'        => 'location'
      );
      $fields['job_location'] = array(
         'label'        => esc_html__( 'Location', 'fioxen-themer' ),
         'type'         => 'text',
         'priority'     => 4.2,
         'required'     => false, 
         'placeholder'  => esc_html__( 'e.g 34 Wigmore Street, London', 'fioxen-themer' ),
         'description'  => esc_html__( 'Leave this blank if the location is not important.', 'fioxen-themer' ),
         'classes'      => array('id_job_listing_location_text'),
         'group'        => 'location'
      );
      $fields['lt_map'] = array(
         'label'       => esc_html__( 'Location Map', 'fioxen-themer' ),
         'type' => 'custom-map',
         'priority' => 4.2,
         'required'  => false, 
         'placeholder' => esc_html__( 'e.g 34 Wigmore Street, London', 'fioxen-themer' ),
         'group'        => 'location'
      );
      //Business Information
      $fields['lt_heading_5'] = array(
         'label' => esc_html__( 'Listing Business Information', 'fioxen-themer' ),
         'type'          => 'custom-heading',
         'priority'      => 5.0,
         'required' => false,
         'heading_under' => false
      );
      $fields['lt_email'] = array(
         'label'        => esc_html__('Email', 'fioxen-themer'),
         'type'         => 'text',
         'required'     => false,
         'priority'     => 5.1,
         'placeholder'  => esc_html__( 'e.g: contact@example.com', 'fioxen-themer' ),
         'group'        => 'business'
      );
      $fields['lt_phone'] = array(
         'label'        => esc_html__('Phone', 'fioxen-themer'),
         'type'         => 'text',
         'required'     => false,
         'priority'     => 5.2,
         'placeholder'  => esc_html__( 'e.g: +84 123456789', 'fioxen-themer' ),
         'group'        => 'business'
      );
      $fields['lt_website'] = array(
         'label'        => esc_html__('Website', 'fioxen-themer'),
         'type'         => 'text',
         'required'     => false,
         'priority'     => 5.3,
         'placeholder'  => esc_html__( 'e.g: https://example.com', 'fioxen-themer' ),
         'group'        => 'business'
      );
      $fields['lt_address'] = array(
         'label'        => esc_html__('Address', 'fioxen-themer'),
         'type'         => 'text',
         'required'     => false,
         'priority'     => 5.4,
         'placeholder'  => esc_html__( 'e.g: 68 Sunrise Oakdale, New York USA', 'fioxen-themer' ),
         'group'        => 'business'
      );
      // Price Range
      $lt_currency = fioxen_themer_get_theme_option('lt_currency_symbol', '$');
      $fields['lt_heading_6'] = array(
         'label' => esc_html__( 'Listing Information', 'fioxen-themer' ),
         'type'          => 'custom-heading',
         'priority'      => 6.0,
         'required'     => false,
         'heading_under' => true
      );
      $fields['lt_price_range'] = array(
         'label'     => esc_html__('Price Range', 'fioxen-themer'),
         'type'      => 'select',
         'required'  => false,
         'priority'  => 6.1,
         'options' => array(
            'inexpensive'        => $lt_currency . esc_html__(' - Inexpensive', 'fioxen-themer'),
            'moderate'           => $lt_currency . $lt_currency . esc_html__(' - Moderate', 'fioxen-themer'),
            'pricey'             => $lt_currency . $lt_currency . $lt_currency . esc_html__(' - Pricey', 'fioxen-themer'),
            'ultra-high'         => $lt_currency . $lt_currency . $lt_currency . $lt_currency . esc_html__(' - Ultra High', 'fioxen-themer')
         ),
         'group'     => 'information'
      );

      $fields['lt_price_from'] = array(
         'label'        => esc_html__('Price From', 'fioxen-themer') . '(' . $lt_currency . ')',
         'type'         => 'text',
         'required'     => false,
         'priority'     => 6.2,
         'placeholder'  => esc_html__( 'e.g: 80', 'fioxen-themer' ),
         'group'        => 'information'
      );
      $fields['lt_price_to'] = array(
         'label'        => esc_html__('Price To', 'fioxen-themer'),
         'type'         => 'text',
         'required'     => false,
         'priority'     => 6.3,
         'placeholder'  => esc_html__( 'e.g: 150', 'fioxen-themer' ),
         'group'        => 'information'
      );
      $fields['lt_duration'] = array(
         'label'        => esc_html__('Duration', 'fioxen-themer'),
         'type'         => 'text',
         'required'     => false,
         'priority'     => 6.4,
         'placeholder'  => esc_html__( 'e.g: 10 days', 'fioxen-themer' ),
         'group'        => 'information'
      );
      $fields['lt_language'] = array(
         'label'        => esc_html__('Language', 'fioxen-themer'),
         'type'         => 'text',
         'required'     => false,
         'priority'     => 6.4,
         'placeholder'  => esc_html__( 'e.g: English', 'fioxen-themer' ),
         'group'        => 'information'
      );

      // Socials Link
      $fields['lt_heading_7'] = array(
         'label'           => esc_html__( 'Listing Socials', 'fioxen-themer' ),
         'type'            => 'custom-heading',
         'priority'        => 7.0,
         'required'        => false,
         'heading_under'   => false
      );
      $fields['lt_socials_media'] = array(
         'label'     => esc_html__("Social Media", 'fioxen-themer'),
         'type'      => 'custom-socials',
         'required'  => false,
         'priority'  => 7.1,
          'group'    => 'social'
      );

      // Booking Type
      $fields['lt_heading_8'] = array(
         'label'           => esc_html__( 'Listing Booking Type', 'fioxen-themer' ),
         'type'            => 'custom-heading',
         'priority'        => 8.0,
         'required'        => false,
         'heading_under'   => false
      );
      $fields['lt_booking_type'] = array(
         'label'     => esc_html__("Listing Booking Type", 'fioxen-themer'),
         'type'      => 'custom-booking-type',
         'required'  => false,
         'priority'  => 8.1,
         'group'    => 'booking_type'
      );
      
      // Business Hours
      $fields['lt_heading_9'] = array(
         'label'           => esc_html__( 'Business Hours', 'fioxen-themer' ),
         'type'            => 'custom-heading',
         'priority'        => 9.0,
         'required'        => false,
         'heading_under'   => false
      );
      $fields['lt_hours'] = array(
         'label'     => esc_html__("Business Hours", 'fioxen-themer'),
         'type'      => 'custom-hours',
         'required'  => false,
         'priority'  => 9.1,
         'group'    => 'hours'
      );
      // Business Hours
      $fields['lt_heading_10'] = array(
         'label'           => esc_html__( 'Additional Info', 'fioxen-themer' ),
         'type'            => 'custom-heading',
         'priority'        => 10.0,
         'required'        => false,
         'heading_under'   => false 
      ); 
      $fields['lt_additional_info'] = array(
         'label'     => esc_html__("Additional Info", 'fioxen-themer'),
         'type'      => 'custom-additional-info',
         'required'  => false,
         'priority'  => 10.1,
         'group'    => 'additional'
      );

     // Custom Fields
      $fields['lt_heading_10'] = array(
         'label'           => esc_html__( 'Custom Fields', 'fioxen-themer' ),
         'type'            => 'custom-heading',
         'priority'        => 11.0,
         'required'        => false,
         'heading_under'   => false 
      ); 

      return $fields;
   }

   public function listing_fields($admin = false){
      $fields = $this->default_fields();
      
      // Remove Field Heading on Submit Form
      if(!$admin){
         foreach ($fields as $key => $field) {
            if( $field['type'] == 'custom-heading'){
               unset($fields[$key]);
            }
         }
      }

      $fields_option = $this->listing_fields_option();
      //print"<pre>"; print_r($fields_option);
      if($fields_option){
         $priority_custom_fields = 11;
         foreach ($fields_option as $key => $field) {

            if(isset($fields[$key]) && $fields[$key]){
               $fields[$key]['type_field'] = 'available';
               $field['type_field'] = 'available';
            }

            if($field['type_field'] == 'available'){
               if($field['disable']){
                  unset($fields[$key]);
               }else{
                  $fields[$key]['label'] = $field['label'];
                  $fields[$key]['description'] = $field['description'];
                  $fields[$key]['placeholder'] = $field['placeholder'];
                  $fields[$key]['default'] = $field['default'];
                  $fields[$key]['group'] = $field['group'];
                  if(!$admin){
                     $fields[$key]['priority'] = $field['priority'];
                  }
               }
            }else{
               $priority_custom_fields = $priority_custom_fields + 0.1;
               $fields[$key] = $field;
               $fields[$key]['priority'] = $priority_custom_fields;
            }
         }
      }
      return $fields;
   }

   public function listing_fields_option(){
      $fields = array();
      $fields_data = get_option('gva_listing_fields');
      if(!empty($fields_data)){
         foreach ($fields_data as $key => $field){
            $field_key = isset($field['key']) ? $field['key'] : '';
            $fields[$field_key] = array(
               'label'        => isset($field['label']) ? $field['label'] : '',
               'key'          => isset($field['key']) ? $field['key'] : '',
               'description'  => isset($field['description']) ? $field['description'] : '',
               'placeholder'  => isset($field['placeholder']) ? $field['placeholder'] : '',
               'priority'     => isset($field['priority']) ? $field['priority'] : '90',
               'type'         => isset($field['type']) ? $field['type'] : '',
               'type_field'   => isset($field['type_field']) ? $field['type_field'] : 'custom',
               'default'      => isset($field['default']) ? $field['default'] : '',
               'disable'      => isset($field['disable']) ? $field['disable'] : '',
               'required'     => isset($field['required']) ? $field['required'] : '',
               'group'        => isset($field['group']) ? $field['group'] : 'other'
            );
         }
      }
      return $fields;
   }

   public function listing_fields_groups(){
      return array(
         'general'         => esc_html__('General', 'fioxen-themer'),
         'media'           => esc_html__('Media', 'fioxen-themer'),
         'location'        => esc_html__('Location', 'fioxen-themer'),
         'business'        => esc_html__('Business Information', 'fioxen-themer'),
         'information'     => esc_html__('Listing Information', 'fioxen-themer'),
         'social'          => esc_html__('Social', 'fioxen-themer'),
         'hours'           => esc_html__('Business Hours', 'fioxen-themer'),
         'booking_type'    => esc_html__('Booking Type', 'fioxen-themer'),
         'additional'      => esc_html__('Additional Info', 'fioxen-themer'),
         'other'           => esc_html__('Other', 'fioxen-themer')
      );
   }

   
   public function select_hours($fvalue = ''){
      $lower = 0; $upper = 86400; $step = 1800;
      $format = get_option( 'time_format' );
      $html = '';
      $times = array();
      $html .= '<option value="">' . esc_html__( 'From', 'fioxen-themer' ) . '</option>';
      
      foreach(range( $lower, $upper, $step ) as $increment){
         $value = gmdate('H:i', $increment);
         $display = gmdate($format, $increment);
         if( !isset($times[$value]) ){
            $html .= '<option value="' . $value . '"'.trim($value == $fvalue ? ' selected="selected"' : '') . '>' . esc_html($display) . '</option>';
         }
         $times[$value] = $display; 
      }

      return $html;
   }
}


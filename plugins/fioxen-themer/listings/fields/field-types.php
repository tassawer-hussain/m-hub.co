<?php

if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly
}

class Fioxen_Listing_Fields_Types {
   private static $instance = null;
      public static function instance() {
         if ( is_null( self::$instance ) ) {
            self::$instance = new self();
         }
         return self::$instance;
      }

   public function __construct(){ 
      add_action( 'job_manager_input_custom-map', array( $this, 'field_custom_map_fields' ), 10, 2 );
      add_action( 'job_manager_input_custom-regions', array( $this, 'field_custom_regions_fields' ), 10, 2 );
      add_action( 'job_manager_input_custom-heading', array( $this, 'field_custom_heading_fields' ), 10, 2 );
      add_action( 'job_manager_input_custom-empty', array( $this , 'field_custom_custom_empty_fields' ), 10, 2 );
      add_action( 'job_manager_input_custom-socials', array( $this , 'field_custom_custom_socials_fields' ), 10, 2 );
      add_action( 'job_manager_input_custom-additional-info', array( $this , 'field_custom_custom_additional_info_fields' ), 10, 2 );
      add_action( 'job_manager_input_custom-hours', array( $this , 'field_custom_custom_hours_fields' ), 10, 2 );
      add_action( 'job_manager_input_custom-booking-type', array( $this , 'field_custom_custom_booking_type_fields' ), 10, 2 );
      add_action( 'job_manager_input_term-select', array( $this , 'field_custom_term_select_fields' ), 10, 2 );
      add_action( 'job_manager_input_term-multiselect', array( $this , 'field_custom_term_multi_fields' ), 10, 2 );
      add_action( 'job_manager_input_term-checklist', array( $this , 'field_custom_term_checklist_fields' ), 10, 2 );
      add_action( 'job_manager_input_date', array( $this , 'field_custom_date_fields' ), 10, 2 );
      add_action( 'job_manager_input_text', array( $this , 'field_custom_text_fields' ), 10, 2 );
   }

   public function field_custom_map_fields($key, $field) {
      echo '<div class="form-field field-name-' . $key . '" style="width: 100%;">';
         get_job_manager_template( 'form-fields/custom-map-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';
   }

   public function field_custom_regions_fields($key, $field) {
      echo '<div class="form-field field-name-' . $key . '">';
         echo '<label for="' . $key . '">' . $field['label'] . ':</label>';
         $field['value'] = $this->get_values_term_region($field);
         get_job_manager_template( 'form-fields/custom-regions-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';

   }

   public function field_custom_custom_empty_fields($key, $field){
      get_job_manager_template( 'form-fields/custom-empty-field.php', array('key' => $key, 'field' => $field) );
   }

   public function field_custom_term_select_fields($key, $field) {
      echo '<div class="form-field field-name-' . $key . '">';
         echo '<label for="' . $key . '">' . $field['label'] . ':</label>';
         $field['value'] = $this->get_values_term($field);
         get_job_manager_template( 'form-fields/term-select-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';
   }

   public function field_custom_term_multi_fields($key, $field) {
      echo '<div class="form-field field-name-' . $key . '">';
         echo '<label for="' . $key . '">' . $field['label'] . ':</label>';
         $field['value'] = $this->get_values_term($field);
         get_job_manager_template( 'form-fields/term-multiselect-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';
   }

   public function field_custom_term_checklist_fields($key, $field) {
      echo '<div class="form-field field-name-' . $key . '">';
         echo '<label for="' . $key . '">' . $field['label'] . ':</label>';
         $field['value'] = $this->get_values_term($field);
         get_job_manager_template( 'form-fields/term-checklist-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';
      
   }

   public function field_custom_date_fields($key, $field) {
      echo '<div class="form-field field-type-date field-name-' . $key . '">';
         echo '<label for="' . $key . '">' . $field['label'] . ':</label>';
         get_job_manager_template( 'form-fields/date-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';
      
   }

   public function field_custom_text_fields($key, $field) {
      global $post;
      echo '<div class="form-field field-type-text field-name-' . $key . '">';
         $field['value'] = get_post_meta($post->ID, $key, true);         
         echo '<label for="' . $key . '">' . $field['label'] . ':</label>';
         get_job_manager_template( 'form-fields/text-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';
   }

   public function field_custom_heading_fields($key, $field) {
      echo '<div class="form-field field-type-custom-heading full-width">';
         get_job_manager_template( 'form-fields/custom-heading-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';
      if($field['heading_under']) echo '<div class="form-field"></div>';
   }
   
   public function field_custom_custom_socials_fields($key, $field) {
      echo '<div class="form-field field-type-custom-socials full-width">';
         get_job_manager_template( 'form-fields/custom-socials-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';
   }

   public function field_custom_custom_additional_info_fields($key, $field) {
      echo '<div class="form-field field-type-custom-additional-info full-width">';
         get_job_manager_template( 'form-fields/custom-additional-info-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';
   }

   public function field_custom_custom_hours_fields($key, $field) {
      echo '<div class="form-field field-type-custom-hours full-width">';
         get_job_manager_template( 'form-fields/custom-hours-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';
   }

   public function field_custom_custom_booking_type_fields($key, $field) {
      echo '<div class="form-field field-type-custom-booking-type full-width">';
         get_job_manager_template( 'form-fields/custom-booking-type-field.php', array('key' => $key, 'field' => $field) );
      echo '</div>';
   }

   public function get_values_term($field){
      global $post;
      $values = array();
      $terms = wp_get_post_terms( $post->ID, $field['taxonomy'] );
      if ( !empty($terms) ) {
         foreach ($terms as $term) {
            $values[] = $term->term_id;
         }
      }
      return $values;
   }

   public function get_values_term_region($field){
      global $post;
      $values = array();
      $terms = wp_get_post_terms( $post->ID, $field['taxonomy'] );
      if ( !empty($terms) ) {
         foreach ($terms as $term) {
            if($term->parent == 0){
               $values['country'] = $term->slug;
            }else{
               $values['city'] = $term->slug;
            }
         }
      }
      return $values;
   }
}

new Fioxen_Listing_Fields_Types();
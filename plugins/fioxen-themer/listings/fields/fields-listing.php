<?php
if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly
}

class Fioxen_Listing_Fields {
   
   public function __construct(){ 
      add_filter( 'submit_job_form_prefix_post_name_with_company', array( $this, 'slug_only_title' ), 100 );
      add_filter( 'submit_job_form_prefix_post_name_with_location', array( $this, 'slug_only_title' ), 100 );
      add_filter( 'submit_job_form_prefix_post_name_with_job_type', array( $this, 'slug_only_title' ), 100 );
      
      add_filter( 'job_manager_job_listing_data_fields', array( $this, 'listing_data_fields' ), 100 );
      add_filter( 'job_manager_job_listing_data_fields', array( $this, 'listing_data_fields_custom' ), 999 );
      add_filter( 'job_manager_job_listing_wp_admin_fields', array( $this, 'listing_data_fields_custom' ), 999 );

      add_filter( 'submit_job_form_fields', array( $this, 'listing_form_submit_fields' ) );
   }

   public function slug_only_title($return) {
      return false;
   }

   public function listing_data_fields_custom($fields){
      $fields['_filled'] = [
         'label'         => __( 'Position Filled', 'fioxen-themer' ),
         'type'          => 'checkbox',
         'priority'      => 1,
         'data_type'     => 'integer',
         'show_in_admin' => true,
         'show_in_rest'  => true,
         'description'   => __( 'Filled listings will no longer accept applications.', 'fioxen-themer' )
      ];
      unset($fields['_company_twitter']);
      unset($fields['_company_name']);
      unset($fields['_company_website']);
      unset($fields['_application']);
      unset($fields['_company_video']);
      unset($fields['_company_tagline']);
      return $fields;
   }

   public function listing_data_fields($fields){
      

      $_fields = Fioxen_LT_Fields_Model::instance()->listing_fields(true);
      $results = array();
      foreach ($_fields as $key => $field) {
         if( !in_array($key, array('lt_logo_image', 'lt_banner_image','lt_gallery_images')) ){
            $results['_' . $key] = $field;
         }
      }
       
      return $results;
   }

   public function listing_form_submit_fields($fields){
      $_fields = Fioxen_LT_Fields_Model::instance()->listing_fields();
      $fields['job']['job_type']['required'] = false; 

      $fields['job']['job_type']['type'] = 'term-select';
      $fields['job']['job_type']['default'] = '';

      $fields['job']['job_title'] = array(
         'label'        => esc_html__('Listing Title', 'fioxen-themer'),
         'type'         => 'text',
         'required'     => true,
         'priority'     => 0.1,
         'group'        => 'general'
      );

      foreach ($_fields as $key => $field) {
         $fields['job'][$key] = $field;
      }

      $fields['job']['job_description']['group'] = 'general';
      $fields['job']['job_description']['required'] = false;

      $fields['job']['job_type']['group'] = 'general';

      if( isset($fields['job']['lt_category']['type']) ){ 
         $fields['job']['lt_category']['type'] = 'term-multiselect';
      }
      $fields['job']['job_category']['required'] = false;
      $fields['job']['job_type']['required'] = false;
      $fields['job']['application']['required'] = false;
      $fields['job']['job_location']['required'] = false;
      $fields['company']['company_name']['required'] = false;
    
      $fields['job']['job_title']['label'] = esc_html__( 'Listing Title', 'fioxen-themer' );
      unset($fields['company']['company_name']);
      unset($fields['company']['company_website']);
      unset($fields['company']['company_tagline']);
      unset($fields['company']['company_video']);
      unset($fields['company']['company_twitter']);
      unset($fields['company']['company_logo']);
      unset($fields['company']['application']);


      unset($fields['job']['remote_position']);

      unset($fields['job']['job_category']);
      unset($fields['job']['featured']);
      unset($fields['job']['lt_claimed']);
      unset($fields['job']['application']);
      unset($fields['job']['job_expires']);
      
      return $fields;
   }

}

new Fioxen_Listing_Fields();
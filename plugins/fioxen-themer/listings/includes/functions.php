<?php
class Fioxen_Listing_Function{

   public function __construct(){
      add_action( 'add_meta_boxes', array($this, 'fioxen_remove_meta_box'), 10);
      add_action( 'init', array($this, 'fioxen_lt_setting'), 1 );
   }

   public function fioxen_remove_meta_box($args){
      $terms_remove = array('job_listing_category', 'job_listing_amenity', 'job_listing_region');
      foreach ($terms_remove as $term) {
         remove_meta_box( $term . 'div' , 'job_listing' , 'side' );
      }
   }

   public function fioxen_lt_setting(){
      if( !get_option( 'job_manager_enable_categories', '0' ) ){
         update_option('job_manager_enable_categories', '1');
      }
      if( !get_option( 'job_manager_hide_filled_positions', '0' ) ){
         update_option('job_manager_hide_filled_positions', '1');
      }
      if( !get_option( 'job_manager_jobs_page_id', '' ) ){
         update_option('job_manager_jobs_page_id', '114');
      }
      if( !get_option( 'job_manager_job_dashboard_page_id', '' ) ){
         update_option('job_manager_job_dashboard_page_id', '113');
      }
      if( !get_option( 'job_manager_submit_job_form_page_id', '' ) ){
         update_option('job_manager_submit_job_form_page_id', '112');
      }
   }

   
}

new Fioxen_Listing_Function();
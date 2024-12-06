<?php

if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly
}
class Fioxen_Listings_Taxonomy_Tags{


   public static function getInstance() {
      if (!isset(self::$instance) && !(self::$instance instanceof Fioxen_Listings_Taxonomy_Tags)) {
         self::$instance = new Fioxen_Listings_Taxonomy_Tags();
      }
      return self::$instance;
   }

   public function __construct(){ 
      add_action( 'init', array( $this, 'definition' ), 1 );
   }


   public static function definition() {
      $labels = array(
         'name'              => __( 'Tags', 'fioxen-themer' ),
         'singular_name'     => __( 'Tag', 'fioxen-themer' ),
         'search_items'      => __( 'Search Tags', 'fioxen-themer' ),
         'all_items'         => __( 'All Tags', 'fioxen-themer' ),
         'parent_item'       => __( 'Parent Tag', 'fioxen-themer' ),
         'parent_item_colon' => __( 'Parent Tag:', 'fioxen-themer' ),
         'edit_item'         => __( 'Edit', 'fioxen-themer' ),
         'update_item'       => __( 'Update', 'fioxen-themer' ),
         'add_new_item'      => __( 'Add New', 'fioxen-themer' ),
         'new_item_name'     => __( 'New Tag', 'fioxen-themer' ),
         'menu_name'         => __( 'Tags', 'fioxen-themer' ),
      );

      register_taxonomy( 'job_listing_tag', 'job_listing', array(
         'labels'             => apply_filters( 'fioxen_taxomony_tags_labels', $labels ),
         'hierarchical'       => true,
         'query_var'          => 'listing-tag',
         'rewrite'            => array( 'slug' => __( 'listing-tag', 'fioxen-themer' ) ),
         'public'             => true,
         'show_ui'            => true,
         'show_in_rest'       => true
      ) );
   }

}

new Fioxen_Listings_Taxonomy_Tags();
<?php

if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly
}
class Fioxen_Listings_Taxonomy_Amenities{


   public static function getInstance() {
      if (!isset(self::$instance) && !(self::$instance instanceof Fioxen_Listings_Taxonomy_Amenities)) {
         self::$instance = new Fioxen_Listings_Taxonomy_Amenities();
      }
      return self::$instance;
   }

   public function __construct(){ 
      add_action( 'init', array( $this, 'definition' ), 1 );
   }


   public static function definition() {
      $labels = array(
         'name'              => __( 'Amenities', 'fioxen-themer' ),
         'singular_name'     => __( 'Amenity', 'fioxen-themer' ),
         'search_items'      => __( 'Search Amenities', 'fioxen-themer' ),
         'all_items'         => __( 'All Amenities', 'fioxen-themer' ),
         'parent_item'       => __( 'Parent Amenity', 'fioxen-themer' ),
         'parent_item_colon' => __( 'Parent Amenity:', 'fioxen-themer' ),
         'edit_item'         => __( 'Edit', 'fioxen-themer' ),
         'update_item'       => __( 'Update', 'fioxen-themer' ),
         'add_new_item'      => __( 'Add New', 'fioxen-themer' ),
         'new_item_name'     => __( 'New Amenity', 'fioxen-themer' ),
         'menu_name'         => __( 'Amenities', 'fioxen-themer' ),
      );

      register_taxonomy( 'job_listing_amenity', 'job_listing', array(
         'labels'            => apply_filters( 'fioxen_taxomony_amenities_labels', $labels ),
         'hierarchical'      => true,
         'query_var'         => 'amenity',
         'rewrite'           => array( 'slug' =>  'amenity' ),
         'public'            => true,
         'show_ui'           => true,
         'show_in_rest'      => false,
         'menu_position'       => 10,
         'show_in_nav_menus'   => true,
         'publicly_queryable'  => true
      ) );
   }

}

new Fioxen_Listings_Taxonomy_Amenities();
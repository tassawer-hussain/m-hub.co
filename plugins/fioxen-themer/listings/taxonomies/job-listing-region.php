<?php

if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly
}
class Fioxen_Listings_Taxonomy_Region{


   public static function getInstance() {
      if (!isset(self::$instance) && !(self::$instance instanceof Fioxen_Listings_Taxonomy_Region)) {
         self::$instance = new Fioxen_Listings_Taxonomy_Region();
      }
      return self::$instance;
   }

   public function __construct(){ 
      add_action( 'init', array( $this, 'definition' ), 1 );
   }


   public static function definition() {
      $labels = array(
         'name'              => __( 'Regions', 'fioxen-themer' ),
         'singular_name'     => __( 'Region', 'fioxen-themer' ),
         'search_items'      => __( 'Search Regions', 'fioxen-themer' ),
         'all_items'         => __( 'All Regions', 'fioxen-themer' ),
         'parent_item'       => __( 'Parent Region', 'fioxen-themer' ),
         'parent_item_colon' => __( 'Parent Region:', 'fioxen-themer' ),
         'edit_item'         => __( 'Edit', 'fioxen-themer' ),
         'update_item'       => __( 'Update', 'fioxen-themer' ),
         'add_new_item'      => __( 'Add New', 'fioxen-themer' ),
         'new_item_name'     => __( 'New Region', 'fioxen-themer' ),
         'menu_name'         => __( 'Regions', 'fioxen-themer' ),
      );

      register_taxonomy( 'job_listing_region', 'job_listing', array(
         'labels'            => apply_filters( 'fioxen_taxomony_regions_labels', $labels ),
         'hierarchical'      => true,
         'query_var'         => 'region',
         'rewrite'           => array( 'slug' => __( 'region', 'fioxen-themer' ) ),
         'public'            => true,
         'show_ui'           => true,
         'show_in_rest'      => false,
         'show_in_menu'        => true,
         'menu_position'       => 5,
         'show_in_nav_menus'   => true,
         'publicly_queryable'  => true,
         'exclude_from_search' => false,
         'has_archive'         => true
      ) );
   }

}

new Fioxen_Listings_Taxonomy_Region();
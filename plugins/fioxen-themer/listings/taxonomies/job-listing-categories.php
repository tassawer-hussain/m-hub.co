<?php

if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly
}
class Fioxen_Listings_Taxonomy_Categories{


   public static function getInstance() {
      if (!isset(self::$instance) && !(self::$instance instanceof Fioxen_Listings_Taxonomy_Categories)) {
         self::$instance = new Fioxen_Listings_Taxonomy_Categories();
      }
      return self::$instance;
   }

   public function __construct(){ 
      add_filter( 'register_taxonomy_job_listing_category_args', array( $this, 'override_taxonomy_category_label' ), 10 );
   }


   public static function override_taxonomy_category_label($args) {
      $singular = 'Listing Category'; 
      $plural   = 'Listing Categories';

      $args['label'] = $plural;

      $args['labels'] = array(
         'name'              => $plural,
         'singular_name'     => $singular,
         'menu_name'         => ucwords( $plural ),
         // translators: Placeholder %s is the plural label of the job listing category taxonomy type.
         'search_items'      => sprintf( __( 'Search %s', 'fioxen-themer' ), $plural ),
         // translators: Placeholder %s is the plural label of the job listing category taxonomy type.
         'all_items'         => sprintf( __( 'All %s', 'fioxen-themer' ), $plural ),
         // translators: Placeholder %s is the singular label of the job listing category taxonomy type.
         'parent_item'       => sprintf( __( 'Parent %s', 'fioxen-themer' ), $singular ),
         // translators: Placeholder %s is the singular label of the job listing category taxonomy type.
         'parent_item_colon' => sprintf( __( 'Parent %s:', 'fioxen-themer' ), $singular ),
         // translators: Placeholder %s is the singular label of the job listing category taxonomy type.
         'edit_item'         => sprintf( __( 'Edit %s', 'fioxen-themer' ), $singular ),
         // translators: Placeholder %s is the singular label of the job listing category taxonomy type.
         'update_item'       => sprintf( __( 'Update %s', 'fioxen-themer' ), $singular ),
         // translators: Placeholder %s is the singular label of the job listing category taxonomy type.
         'add_new_item'      => sprintf( __( 'Add New %s', 'fioxen-themer' ), $singular ),
         // translators: Placeholder %s is the singular label of the job listing category taxonomy type.
         'new_item_name'     => sprintf( __( 'New %s Name', 'fioxen-themer' ), $singular ),
      );

      return $args;
   }

}

new Fioxen_Listings_Taxonomy_Categories();
<?php

if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly
}
class Fioxen_Job_Listing{


   public static function getInstance() {
      if (!isset(self::$instance) && !(self::$instance instanceof Fioxen_Job_Listing)) {
         self::$instance = new Fioxen_Job_Listing();
      }
      return self::$instance;
   }

   public function __construct(){ 
      add_filter( 'register_post_type_job_listing', array( $this, 'override_content_type_label' ), 10 );
      add_filter( 'wp_insert_post_data', array($this, 'default_comments_on') );
   }

   public static function override_content_type_label($args) {
      $singular = 'Listing'; 
      $plural   = 'Listings';

      $args['label'] = $plural;

      $args['labels'] = array(
         'name'                  => $plural,
         'singular_name'         => $singular,
         'menu_name'             => __( 'Listings', 'fioxen-themer' ),
         // translators: Placeholder %s is the plural label of the job listing post type.
         'all_items'             => sprintf( __( 'All %s', 'fioxen-themer' ), $plural ),
         'add_new'               => __( 'Add New', 'fioxen-themer' ),
         // translators: Placeholder %s is the singular label of the job listing post type.
         'add_new_item'          => sprintf( __( 'Add %s', 'fioxen-themer' ), $singular ),
         'edit'                  => __( 'Edit', 'fioxen-themer' ),
         // translators: Placeholder %s is the singular label of the job listing post type.
         'edit_item'             => sprintf( __( 'Edit %s', 'fioxen-themer' ), $singular ),
         // translators: Placeholder %s is the singular label of the job listing post type.
         'new_item'              => sprintf( __( 'New %s', 'fioxen-themer' ), $singular ),
         // translators: Placeholder %s is the singular label of the job listing post type.
         'view'                  => sprintf( __( 'View %s', 'fioxen-themer' ), $singular ),
         // translators: Placeholder %s is the singular label of the job listing post type.
         'view_item'             => sprintf( __( 'View %s', 'fioxen-themer' ), $singular ),
         // translators: Placeholder %s is the singular label of the job listing post type.
         'search_items'          => sprintf( __( 'Search %s', 'fioxen-themer' ), $plural ),
         // translators: Placeholder %s is the singular label of the job listing post type.
         'not_found'             => sprintf( __( 'No %s found', 'fioxen-themer' ), $plural ),
         // translators: Placeholder %s is the plural label of the job listing post type.
         'not_found_in_trash'    => sprintf( __( 'No %s found in trash', 'fioxen-themer' ), $plural ),
         // translators: Placeholder %s is the singular label of the job listing post type.
         'parent'                => sprintf( __( 'Parent %s', 'fioxen-themer' ), $singular ),
         'featured_image'        => __( 'Featured Image', 'fioxen-themer' ),
         'set_featured_image'    => __( 'Set Featured Image', 'fioxen-themer' ),
         'remove_featured_image' => __( 'Remove Featured Image', 'fioxen-themer' ),
         'use_featured_image'    => __( 'Use as Featured Image', 'fioxen-themer' )
      );
      $args['show_in_nav_menus'] = true;
      $args['show_in_rest']      = false;
      $args['supports']          = array( 'title', 'editor', 'custom-fields', 'publicize', 'thumbnail', 'author', 'excerpt', 'comments');
   
      return $args;
   }

   function default_comments_on( $data ) {
      if( $data['post_type'] == 'job_listing' ) {
         $data['comment_status'] = 'open';
      }
      return $data;
   }
}

new Fioxen_Job_Listing();
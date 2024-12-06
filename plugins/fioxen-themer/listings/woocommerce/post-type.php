<?php
class Fioxen_Package{
	
	private static $instance;
  	public static function getInstance() {
    	if (!isset(self::$instance) && !(self::$instance instanceof Fioxen_Package)) {
      	self::$instance = new Fioxen_Package();
    	}
    	return self::$instance;
  	}

  	public function __construct(){
	 	add_action('init', array($this, 'register_post_type_lt_package'));
  	}

	function register_post_type_lt_package(){
		$labels = array(
			'name' => __( 'LT Package', 'fioxen-themer' ),
			'singular_name' => __( 'Package', 'fioxen-themer' ),
			'add_new' => __( 'Add New Package', 'fioxen-themer' ),
			'add_new_item' => __( 'Add New Package', 'fioxen-themer' ),
			'edit_item' => __( 'Edit Package', 'fioxen-themer' ),
			'new_item' => __( 'New Package', 'fioxen-themer' ),
			'view_item' => __( 'View Package', 'fioxen-themer' ),
			'search_items' => __( 'Search Packages', 'fioxen-themer' ),
			'not_found' => __( 'No Packages found', 'fioxen-themer' ),
			'not_found_in_trash' => __( 'No Packages found in Trash', 'fioxen-themer' ),
			'parent_item_colon' => __( 'Parent Package:', 'fioxen-themer' ),
			'menu_name' => __( 'Listing Packages', 'fioxen-themer' ),
		);

		$args = array(
			'labels' => $labels,
			'hierarchical' => true,
			'description' => 'List Package',
			'supports' => array( 'title'),
			'public' => true,
			'show_ui' => true,
			'show_in_menu'		=> 'edit.php?post_type=job_listing',
			'menu_position' => 30,
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'capability_type' => 'post'
		);
		register_post_type( 'lt_package', $args );
	}
}

new Fioxen_Package();
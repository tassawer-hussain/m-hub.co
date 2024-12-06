<?php 
	$default = '';
	if( isset($_GET['search_categories']) && !empty($_GET['search_categories']) ){
		$default = $_GET['search_categories'];
	}
	if($categories){
		$default = $categories;
	}
?>

<div class="lt-search_categories">
	<div class="content-inner">
		<i class="icon fa-solid fa-tags"></i>
		<?php 
			job_manager_dropdown_categories([ 
				'taxonomy' => 'job_listing_category',
				'hierarchical' => 1,
				'show_option_all' => __( 'Filter by Category', 'fioxen' ),
				'name' => 'search_categories',
				'orderby' => 'name',
				'selected' => $default,
				'multiple' => false,
				'hide_empty' => false,
				'placeholder' => esc_html__('Filter by Category', 'fioxen'),
				'class' => 'option-select2-filter' 
			]); 
		?>
	</div>	
</div>

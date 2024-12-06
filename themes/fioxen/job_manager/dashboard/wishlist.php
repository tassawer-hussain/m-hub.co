<?php
	$user = wp_get_current_user();
	$userid = $user->ID;
	$lt_ids = get_user_meta($userid, 'lt_wishlist', true);
	
	echo '<h4 class="title">' . esc_html__('My Favorite', 'fioxen') . '</h4>';

	if( $lt_ids ){
		$query_args = [
			'post_type'             => array('job_listing'),
			'posts_per_page'        => 10,
			'ignore_sticky_posts'   => 1,
			'post_status'           => 'publish',
			'post__in'              => $lt_ids
	  	];
		$query = new WP_Query( $query_args );
		$attrs = array(
			'show_info_map'	=> false,
			'show_tagline'		=> true,
			'thumb_size'		=> 'medium'
		);
		
	  	while ( $query->have_posts() ){ 
		  	$query->the_post();
		  	get_job_manager_template( 'loop/item-list.php', $attrs);
		}
	  wp_reset_postdata();
	}else{
		echo '<div class="alert alert-warning">' . esc_html__('There are no listings in your favorite', 'fioxen') . '</div>';
	}

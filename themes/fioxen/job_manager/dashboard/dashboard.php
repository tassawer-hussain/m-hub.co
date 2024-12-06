<?php
$total_post = $total_views = $total_reviews = $total_bookmarks = 0;
$userid = get_current_user_id();
$args = array(
  	'post_type'        => 'job_listing',
  	'post_status'        => array( 'publish', 'expired', 'pending' ),
  	'posts_per_page'   => -1,
  	'orderby'          =>  'post_date',
  	'order'            =>  'ASC',
  	'author'           =>  get_current_user_id()
);

$posts = get_posts($args);
if( !empty($posts) ){
  	$total_post = count($posts);
  	foreach ($posts as $post) {
	 	$comment_count = wp_count_comments( $post->ID );
	 	$total_reviews += !empty($comment_count->approved) ? $comment_count->approved : 0;
	 	$total_views += intval(get_post_meta($post->ID, '_count_views', true));
  	}
}

$bookmarks = get_user_meta($userid, 'lt_wishlist', true);
if($bookmarks){
	$total_bookmarks = count($bookmarks);
}
?>
<h3 class="page-title"><?php echo esc_html__('Dashboard', 'fioxen') ?></h3>
<div class="dashboard-inner-block">
	<div class="lg-block-grid-3">
		
		<div class="item-columns">
			<div class="dashboard-card all-listings">
				<div class="content-inner">
					<div class="value"><?php echo esc_html($total_post) ?></div>
					<div class="label"><?php echo esc_html__('All Listings', 'fioxen') ?></div>
				</div>   
				<div class="icon"><i class="fas fa-map-marked-alt"></i></div>
			</div>
		</div>   

		<div class="item-columns">
			<div class="dashboard-card total-views">
				<div class="content-inner">
					<div class="value"><?php echo esc_html($total_views) ?></div>
					<div class="label"><?php echo esc_html__('Total Views', 'fioxen') ?></div>
				</div>   
				<div class="icon"><i class="far fa-eye"></i></div>
			</div>
		</div>
		
		<div class="item-columns">   
			<div class="dashboard-card total-reviews">
				<div class="content-inner">
					<div class="value"><?php echo esc_html($total_reviews) ?></div>
					<div class="label"><?php echo esc_html__('Total Reviews', 'fioxen') ?></div>
				</div>   
				<div class="icon"><i class="far fa-comments"></i></div>
			</div>
		</div>
		
		<?php
			$args = array(
			  'post_type'           => 'job_listing',
			  'post_status'         => array( 'publish', 'expired', 'pending' ),
			  'ignore_sticky_posts' => 1,
			  'posts_per_page'      => -1,
			  'orderby'             => 'date',
			  'order'               => 'desc',
			  'author'              => get_current_user_id()
			);
			$query = new WP_Query;
			$posts = $query->query( $args );

			$posts_status = array();
			if ( !empty($posts) ) {
				foreach ($posts as $post) {
					$posts_status[$post->post_status][] = $post;
				}
			}
			wp_reset_postdata();
		?>

		<div class="item-columns">   
			<div class="dashboard-card total-bookmarks">
				<div class="content-inner">
					<div class="value"><?php echo esc_html($total_bookmarks) ?></div>
					<div class="label"><?php echo esc_html__('Total Bookmarks', 'fioxen') ?></div>
				</div>   
				<div class="icon"><i class="far fa-heart"></i></div>
			</div>
		</div>
		
		<div class="item-columns">   
			<div class="dashboard-card published">
				<div class="content-inner">
					<div class="value"><?php echo isset($posts_status['publish']) ? count($posts_status['publish']) : 0 ?></div>
					<div class="label"><?php echo esc_html__('Published', 'fioxen') ?></div>
				</div>   
				<div class="icon"><i class="far fa-calendar-check"></i></div>
			</div>
		</div>
		
		<div class="item-columns">   
			<div class="dashboard-card pending">
				<div class="content-inner">
					<div class="value"><?php echo isset($posts_status['pending']) ? count($posts_status['pending']) : 0 ?></div>
					<div class="label"><?php echo esc_html__('Pending', 'fioxen') ?></div>
				</div>   
				<div class="icon"><i class="fas fa-sync"></i></div>
			</div>
		</div>
		
		<div class="item-columns">   
			<div class="dashboard-card expired">
				<div class="content-inner">
					<div class="value"><?php echo isset($posts_status['expired']) ? count($posts_status['expired']) : 0 ?></div>
					<div class="label"><?php echo esc_html__('Expired', 'fioxen') ?></div>
				</div>   
				<div class="icon"><i class="far fa-calendar-times"></i></div>
			</div>
		</div>   
	</div>
</div>	
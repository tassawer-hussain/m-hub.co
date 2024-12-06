<?php
/**
 * Job dashboard shortcode content.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-dashboard.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.34.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( !is_user_logged_in() ){
	return false;
}  
$job_dashboard_page_id = get_option( 'job_manager_job_dashboard_page_id' );
$link = $job_dashboard_page_id ? get_the_permalink($job_dashboard_page_id) : '';
$dashboard = isset($_GET['dashboard']) && $_GET['dashboard'] ? $_GET['dashboard'] : '';

$user = wp_get_current_user();
$userid = $user->ID;
$data = get_userdata( $userid );
$avatar_image = ''; 
$avatar = get_the_author_meta( '_user_avatar', $userid);
if($avatar){
	$avatar = wp_get_attachment_image_src( $avatar, 'thumbnail' );
	if( isset($avatar[0]) && $avatar[0] ){
		$avatar_image = $avatar[0];
	}
}

switch ( $dashboard ){
	case 'profile':
		echo '<div class="change-profile">';
			get_job_manager_template( 'dashboard/profile.php');
		echo '</div>';
		break;
	
	case 'my-listings':
		echo '<div class="my-listings">';
			$attrs['jobs'] = $jobs;
			$attrs['max_num_pages'] = $max_num_pages;
			get_job_manager_template( 'dashboard/my-listings.php', $attrs);

		echo '</div>';
		break;

	case 'packages':
		echo '<div class="my-packages">';
		get_job_manager_template( 'dashboard/packages.php');
	echo '</div>';
	break;

	case 'favorite':
			echo '<div class="my-favorite">';
			get_job_manager_template( 'dashboard/wishlist.php');
		echo '</div>';
		break;

	case 'change-password':
			echo '<div class="change-password">';
			get_job_manager_template( 'dashboard/change-password.php');
		echo '</div>';
		break;

	default:
		echo '<div class="main-dashboard">';
			get_job_manager_template( 'dashboard/dashboard.php');
		echo '</div>';
		break;
	}


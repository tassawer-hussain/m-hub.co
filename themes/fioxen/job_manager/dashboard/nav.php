<?php
$job_dashboard_page_id = get_option( 'job_manager_job_dashboard_page_id' );
$link = $job_dashboard_page_id ? get_the_permalink($job_dashboard_page_id) : '';;
$dashboard = isset($_GET['dashboard']) && $_GET['dashboard'] ? $_GET['dashboard'] : '';
$user = wp_get_current_user();
$userid = $user->ID;
$data = get_userdata( $userid );
$avatar = fioxen_get_avatar($userid);

?>
<div class="dashboard-sidebar-content">
	
	<div class="content-inner">
		<?php if( $avatar ){ ?>
			<div class="user-avatar">
				<?php echo wp_kses_post($avatar, false) ?>
			</div>
		<?php } ?>	
		<div class="user-information">
			<h3 class="username"><?php echo esc_html($data->display_name) ?></h3>
			<div class="date-created">
				<?php printf( esc_html__('Member Since : %s', 'fioxen'), date_i18n("M Y", strtotime( $data->user_registered )) ); ?>
			</div>
		</div>
		<div class="user-navigation">
			<ul class="dashboard-navigation">
				<li class="<?php echo esc_attr($dashboard == '' ? 'active' : '') ?>">
					<a href="<?php echo esc_url($link) ?>"><i class="icon fas fa-tachometer-alt"></i><?php echo esc_html__('Dashboard', 'fioxen') ?></a>
				</li>
				<li class="<?php echo esc_attr($dashboard == 'profile' ? 'active' : '') ?>">
					<a href="<?php echo add_query_arg( array('dashboard' => 'profile' ), $link ) ?>"><i class="icon far fa-user-circle"></i><?php echo esc_html__('My Profile', 'fioxen') ?></a>
				</li>
				<li class="<?php echo esc_attr($dashboard == 'my-listings' ? 'active' : '') ?>">
					<a href="<?php echo add_query_arg( array('dashboard' => 'my-listings' ), $link ) ?>"><i class="icon fas fa-clipboard-list"></i><?php echo esc_html__('My Listings', 'fioxen') ?></a>
				</li>
				<li class="<?php echo esc_attr($dashboard == 'favorite' ? 'active' : '') ?>">
					<a href="<?php echo add_query_arg( array('dashboard' => 'favorite' ), $link ) ?>"><i class="icon far fa-heart"></i><?php echo esc_html__('Favorite', 'fioxen') ?></a>
				</li>
				<?php if( class_exists('LT_Package_Function') ){ ?>
					<li class="<?php echo esc_attr($dashboard == 'packages' ? 'active' : '') ?>">
						<a href="<?php echo add_query_arg( array('dashboard' => 'packages' ), $link ) ?>"><i class="icon fas fa-layer-group"></i></i><?php echo esc_html__('Packages', 'fioxen') ?></a>
					</li>
				<?php } ?>
				<li class="<?php echo esc_attr($dashboard == 'change-password' ? 'active' : '') ?>">
					<a href="<?php echo add_query_arg( array('dashboard' => 'change-password' ), $link ) ?>"><i class="icon fas fa-lock"></i><?php echo esc_html__('Change Password', 'fioxen') ?></a>
				</li>
				<li>
					<a href="<?php echo wp_logout_url(get_home_url()) ?>"><i class="icon fas fa-sign-out-alt"></i><?php echo esc_html__('Log Out', 'fioxen') ?></a>
				</li>
			</ul>
		</div>   
	</div>
</div> 
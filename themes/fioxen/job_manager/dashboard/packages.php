<?php
	if( !class_exists('LT_Package_Function') ) { return; }
	$user = wp_get_current_user();
	$packages = LT_Package_Function::getInstance()->get_packages_by_user($user->ID);
?>

<h3 class="page-title"><?php echo esc_html__('My Packages', 'fioxen') ?></h3>
<div class="dashboard-inner-block">
	<?php if(is_array($packages) & count($packages)){ ?>
		<div class="lg-block-grid-2">
			<?php foreach ($packages as $package) { ?>
				<div class="item-columns">
					<div class="package-item margin-bottom-30">
						<div class="content-inner">
							<h4 class="title"><?php echo esc_html( $package['title'] ) ?></h4>
							<div class="package-content">
								<div class="content-left">
									<div class="package-id">
										<span class="label"><?php echo esc_html__('ID', 'fioxen') ?>:</span>
										<span><?php echo esc_html($package['id']) ?></span>
									</div>
									<div class="posted">
										<span class="label"><?php echo esc_html__('Posted', 'fioxen') ?>:</span>
										<span><?php echo esc_html($package['count']) ?>/<?php echo esc_html($package['limit']) ?></span>
									</div>
								</div>
								<div class="content-right">   
									<div class="limit-posts">
										<span class="label"><?php echo esc_html__('Limit Posts', 'fioxen') ?>:</span>
										<span><?php echo esc_html($package['limit']) ?></span>
									</div>
									<div class="posted">
										<span class="label"><?php echo esc_html__('Duration', 'fioxen') ?>:</span>
										<span><?php echo esc_html($package['duration']) ?> <?php echo esc_html__('days', 'fioxen') ?></span>
									</div>
								</div>   
							</div>
						</div>
					</div>
				</div>   
			<?php } ?>	
		</div>
	<?php }else{
		echo '<div class="alert alert-warning">' . esc_html__( 'You do not have any active package.', 'fioxen' ) . '</div>';
	}
	?>
</div>	
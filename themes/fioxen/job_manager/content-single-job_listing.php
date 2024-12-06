<?php
/**
 * Single job listing.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.0.0
 * @version     1.28.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
?>
<div class="single_job_listing">
	<?php if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>
		<div class="container">
			<div class="lt-manager-info margin-top-40 margin-bottom-40">
				<div class="alert alert-warning"><?php echo esc_html__( 'This listing has expired.', 'fioxen' ); ?></div>
			</div>
		</div>
	<?php else : ?>
		<?php
			/**
			 	* single_job_listing_start hook
			 	*
			 	* @hooked job_listing_meta_display - 20
			 	* @hooked job_listing_company_display - 30
			 */
			do_action( 'single_job_listing_start' );
		?>

		<?php get_job_manager_template( 'single/content.php' ); ?>

		<?php
			/**
			 * single_job_listing_end hook
			 */
			do_action( 'single_job_listing_end' );
		?>
	<?php endif; ?>
</div>

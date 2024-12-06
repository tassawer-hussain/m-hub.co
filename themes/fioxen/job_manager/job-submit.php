<?php
/**
 * Content for job submission (`[submit_job_form]`) shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-submit.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.34.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $job_manager;
// print '<pre>';
// print_r($job_fields);
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-ui');

?>
<form action="<?php echo esc_url( $action ); ?>" method="post" id="submit-job-form" class="job-manager-form" enctype="multipart/form-data">

	<?php
	if ( isset( $resume_edit ) && $resume_edit ) {
		printf( '<p><strong>' . esc_html__( "You are editing an existing job. %s", 'fioxen' ) . '</strong></p>', '<a href="?job_manager_form=submit-job&new=1&key=' . esc_attr( $resume_edit ) . '">' . esc_html__( 'Create A New Job', 'fioxen' ) . '</a>' );
	}
	?>

	<?php do_action( 'submit_job_form_start' ); ?>

	<?php if ( apply_filters( 'submit_job_form_show_signin', true ) ) : ?>

		<?php get_job_manager_template( 'account-signin.php' ); ?>

	<?php endif; ?>

	<?php if ( job_manager_user_can_post_job() || job_manager_user_can_edit_job( $job_id ) ) : ?>

		<!-- Job Information Fields -->
		<?php do_action( 'submit_job_form_job_fields_start' ); ?>
		
		<!-- General Information Fields -->
		<div class="listing-submit-group">
			<div class="group-title"><?php echo esc_html__('General information', 'fioxen') ?></div>
			<div class="group-content">
				<?php foreach ( $job_fields as $key => $field ) : ?>
					<?php if( isset($field['group']) && $field['group'] == 'general' ){ ?>
						<fieldset class="fieldset-<?php echo esc_attr( $key ); ?> fieldset-type-<?php echo esc_attr( $field['type'] ); ?>">
							<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : '', $field ) ); ?></label>
							<div class="field <?php echo esc_attr($field['required'] ? 'required-field' : ''); ?>">
								<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
							</div>
						</fieldset>
					<?php } ?>
				<?php endforeach; ?>
			</div>	
		</div>	

		<!-- Media Fields -->
		<div class="listing-submit-group listing_submit-group-media">
			<div class="group-title"><?php echo esc_html__('Media', 'fioxen') ?></div>
			<div class="group-content clearfix">
				<?php foreach ( $job_fields as $key => $field ) : ?>
					<?php if( isset($field['group']) && $field['group'] == 'media' ){ ?>
						<fieldset class="fieldset-<?php echo esc_attr( $key ); ?> fieldset-type-<?php echo esc_attr( $field['type'] ); ?>">
							<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : '', $field ) ); ?></label>
							<div class="field <?php echo esc_attr($field['required'] ? 'required-field' : ''); ?>">
								<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
							</div>
						</fieldset>
					<?php } ?>
				<?php endforeach; ?>
			</div>	
		</div>	

		<!-- Location Fields -->
		<div class="listing-submit-group">
			<div class="group-title"><?php echo esc_html__('Location Information', 'fioxen') ?></div>
			<div class="group-content">
				<?php foreach ( $job_fields as $key => $field ) : ?>
					<?php if( isset($field['group']) && $field['group'] == 'location' ){ ?>
						<fieldset class="fieldset-<?php echo esc_attr( $key ); ?> fieldset-type-<?php echo esc_attr( $field['type'] ); ?>">
							<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : '', $field ) ); ?></label>
							<div class="field <?php echo esc_attr($field['required'] ? 'required-field' : ''); ?>">
								<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
							</div>
						</fieldset>
					<?php } ?>
				<?php endforeach; ?>
			</div>	
		</div>	

		<!-- Business Information Fields -->
		<div class="listing-submit-group listing_submit-group-business">
			<div class="group-title"><?php echo esc_html__('Business Information', 'fioxen') ?></div>
			<div class="group-content">
				<?php foreach ( $job_fields as $key => $field ) : ?>
					<?php if( isset($field['group']) && $field['group'] == 'business' ){ ?>
						<fieldset class="fieldset-<?php echo esc_attr( $key ); ?> fieldset-type-<?php echo esc_attr( $field['type'] ); ?>">
							<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : '', $field ) ); ?></label>
							<div class="field <?php echo esc_attr($field['required'] ? 'required-field' : ''); ?>">
								<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
							</div>
						</fieldset>
					<?php } ?>
				<?php endforeach; ?>
			</div>	
		</div>	

		<!-- Price Range Fields -->
		<div class="listing-submit-group listing_submit-group-information">
			<div class="group-title"><?php echo esc_html__('Listing Information', 'fioxen') ?></div>
			<div class="group-content">
				<?php foreach ( $job_fields as $key => $field ) : ?>
					<?php if( isset($field['group']) && $field['group'] == 'information' ){ ?>
						<fieldset class="fieldset-<?php echo esc_attr( $key ); ?> fieldset-type-<?php echo esc_attr( $field['type'] ); ?>">
							<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : '', $field ) ); ?></label>
							<div class="field <?php echo esc_attr($field['required'] ? 'required-field' : ''); ?>">
								<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
							</div>
						</fieldset>
					<?php } ?>
				<?php endforeach; ?>
			</div>	
		</div>	

		<!-- Social Information Fields -->
		<div class="listing-submit-group listing_submit-group-social">
			<div class="group-title"><?php echo esc_html__('Social Information', 'fioxen') ?></div>
			<div class="group-content">
				<?php foreach ( $job_fields as $key => $field ) : ?>
					<?php if( isset($field['group']) && $field['group'] == 'social' ){ ?>
						<fieldset class="fieldset-<?php echo esc_attr( $key ); ?> fieldset-type-<?php echo esc_attr( $field['type'] ); ?>">
							<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : '', $field ) ); ?></label>
							<div class="field <?php echo esc_attr($field['required'] ? 'required-field' : ''); ?>">
								<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
							</div>
						</fieldset>
					<?php } ?>
				<?php endforeach; ?>
			</div>	
		</div>	

		<?php if(fioxen_get_option('lt_business_hours', 'enable') == 'enable'){ ?>
			<!-- Business Hours Fields -->
			<div class="listing-submit-group listing_submit-business-hours">
				<div class="group-title"><?php echo esc_html__('Business Hours', 'fioxen') ?></div>
				<div class="group-content clearfix">
					<?php foreach ( $job_fields as $key => $field ) : ?>
						<?php if( isset($field['group']) && $field['group'] == 'hours' ){ ?>
							<fieldset class="fieldset-<?php echo esc_attr( $key ); ?> fieldset-type-<?php echo esc_attr( $field['type'] ); ?>">
								<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : '', $field ) ); ?></label>
								<div class="field <?php echo esc_attr($field['required'] ? 'required-field' : ''); ?>">
									<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
								</div>
							</fieldset>
						<?php } ?>
					<?php endforeach; ?>
				</div>	
			</div>	
		<?php } ?>	

		<!-- Social Additional Fields -->
		<div class="listing-submit-group listing_submit-booking-type">
			<div class="group-title"><?php echo esc_html__('Booking Type', 'fioxen') ?></div>
			<div class="group-content clearfix">
				<?php foreach ( $job_fields as $key => $field ) : ?>
					<?php if( isset($field['group']) && $field['group'] == 'booking_type' ){ ?>
						<fieldset class="fieldset-<?php echo esc_attr( $key ); ?>">
							<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : '', $field ) ); ?></label>
							<div class="field <?php echo esc_attr($field['required'] ? 'required-field' : ''); ?>">
								<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
							</div>
						</fieldset>
					<?php } ?>
				<?php endforeach; ?>
			</div>	
		</div>	


		<!-- Social Additional Fields -->
		<div class="listing-submit-group listing_submit-additional">
			<div class="group-title"><?php echo esc_html__('Additional Info', 'fioxen') ?></div>
			<div class="group-content clearfix">
				<?php foreach ( $job_fields as $key => $field ) : ?>
					<?php if( isset($field['group']) && $field['group'] == 'additional' ){ ?>
						<fieldset class="fieldset-<?php echo esc_attr( $key ); ?>">
							<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : '', $field ) ); ?></label>
							<div class="field <?php echo esc_attr($field['required'] ? 'required-field' : ''); ?>">
								<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
							</div>
						</fieldset>
					<?php } ?>
				<?php endforeach; ?>
			</div>	
		</div>	

		<?php 
		// print '<pre>';
		// print_r($job_fields);
			$other_fields = array();
			foreach ( $job_fields as $key => $tmp_field ){
				if( !isset($tmp_field['group']) || (isset($tmp_field['group']) && empty($tmp_field['group'])) ){ 
					$other_fields[$key] = $tmp_field;
				}
			}

			if($other_fields && count($other_fields)){ 
				echo '<div class="listing-submit-group listing_submit-other">';
					echo '<div class="group-title">' . esc_html__('Other', 'fioxen') . '</div>';
					echo '<div class="group-content clearfix">';
						foreach ( $other_fields as $key => $field ){ 
							echo '<fieldset class="fieldset-' . esc_attr($key) .'">';
								$label = wp_kses_post($field['label']) . wp_kses_post( apply_filters('submit_job_form_required_label', $field['required'] ? '' : '', $field) );
								echo '<label for="' . esc_attr($key) . '">' . $label . '</label>';
								echo '<div class="field ' . esc_attr($field['required'] ? 'required-field' : '') . '">';
									get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] );
								echo '</div>';
							echo '</fieldset>';
						}
					echo '</div>';
				echo '</div>';		
			} 
		?>


		<?php do_action( 'submit_job_form_job_fields_end' ); ?>

		<input type="hidden" id="application" name="application" value="http://example.com" />

		<!-- Company Information Fields -->
		<?php if ( $company_fields ) : ?>
			<div class="listing-submit-group">
				<div class="group-title"><?php esc_html_e( 'Company Details', 'fioxen' ); ?></div>
					<div class="group-content clearfix">
						
						<?php do_action( 'submit_job_form_company_fields_start' ); ?>
						<?php foreach ( $company_fields as $key => $field ) : ?>
							<fieldset class="fieldset-<?php echo esc_attr( $key ); ?> fieldset-type-<?php echo esc_attr( $field['type'] ); ?>">
								<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : ' <small>' . __( '(optional)', 'fioxen' ) . '</small>', $field ) ); ?></label>
								<div class="field <?php echo esc_attr($field['required'] ? 'required-field' : ''); ?>">
									<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
								</div>
							</fieldset>
						<?php endforeach; ?>
						<?php do_action( 'submit_job_form_company_fields_end' ); ?>
					</div>
				</div>
			</div>				
		<?php endif; ?>

		<?php do_action( 'submit_job_form_end' ); ?>

		<p>
			<input type="hidden" name="job_manager_form" value="<?php echo esc_attr( $form ); ?>" />
			<input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />
			<input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>" />

			<input type="submit" name="submit_job" class="button" value="<?php echo esc_attr( $submit_button_text ); ?>" />
			
			<?php if ( isset( $can_continue_later ) && $can_continue_later ) {
				echo '<input type="submit" name="save_draft" class="d-none button secondary save_draft" value="' . esc_attr__( 'Save Draft', 'fioxen' ) . '" formnovalidate />';
			} ?>

			<span class="spinner" style="background-image: url(<?php echo esc_url( includes_url( 'images/spinner.gif' ) ); ?>);"></span>
		</p>


	<?php else : ?>

		<?php do_action( 'submit_job_form_disabled' ); ?>

	<?php endif; ?>
</form>

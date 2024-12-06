<?php
/**
 * Filter in `[jobs]` shortcode for job types.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-filter-job-types.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.31.1
 */

if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly.
}
?>
<?php if ( ! is_tax( 'job_listing_type' ) && empty( $job_types ) ) : ?>
   
   <select class="list_job_types job-manager-filter job-manager-category-dropdown" name="lt_filter_job_type[]" >
      <option value=""><?php echo esc_html__( 'Filter by Type', 'fioxen' ) ?>
      <?php foreach ( get_job_listing_types() as $type ) : ?>
         <option value="<?php echo esc_attr( $type->slug ); ?>"  id="job_type_<?php echo esc_attr( $type->slug ); ?>" /> <?php echo esc_html( $type->name ); ?></option>
      <?php endforeach; ?>
   </select>

<?php endif ?>

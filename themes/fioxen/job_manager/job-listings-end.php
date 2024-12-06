<?php
/**
 * Content shown after job listings in `[jobs]` shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-listings-end.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.15.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$layout_settings = fioxen_listings_layout_page();
$layout = $layout_settings['layout'];

?>
</div>

<?php 
   if( $layout == 'filters_left' || $layout == 'filters_right' ){ 
      echo '</div>';
   }
?>
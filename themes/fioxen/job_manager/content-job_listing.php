<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.0.0
 * @version     1.34.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
$settings = fioxen_listings_layout_page();
$layout = $settings['layout'];
$layout_item = $settings['layout_item'];
$show_map = $settings['show_map_top'];

if( empty($layout_item) ) $layout_item = 'item-grid-1';
$atts = array();
$atts['show_tagline'] = $settings['show_tagline'];
$atts['show_rating'] = $settings['show_rating'];
if($layout == 'half_map' || $layout == 'half_map_2' || $layout == 'full_map'){
   $atts['show_info_map'] = 'show';
}

if( $layout == 'filters_left' || $layout == 'filters_right' || $layout == 'filters_top' ){
   if( $show_map == 'container' || $show_map == 'contain-fw' ){
      $atts['show_info_map'] = 'show';
   }
}

?>

<div class="listing-block-item">
   <?php get_job_manager_template( 'loop/' . $layout_item . '.php', $atts ); ?> 
</div>

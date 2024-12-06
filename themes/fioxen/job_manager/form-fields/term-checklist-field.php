<?php
/**
 * Shows `checkbox` form fields in a list from a list on job listing forms.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/form-fields/term-checklist-field.php.
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

<?php if ( $field['taxonomy'] == 'job_listing_amenity' ) { ?>

	<?php wp_enqueue_script('fioxen-listing-fields'); ?>

	<div class="amenities-alert"><?php echo esc_html__( 'Please choose category to display available Amenities', 'fioxen') ?></div>
	
	<ul class="job-manager-term-checklist job-manager-term-checklist-lt_amenities">
	<?php
		require_once( ABSPATH . '/wp-admin/includes/template.php' );

		$values = isset( $field['value'] ) ? $field['value'] : ( is_array( $field['default'] ) ? $field['default'] : [ $field['default'] ] );
		
      if( isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id']) ){
         $post_id = $_REQUEST['job_id'];
	      $terms_value = wp_get_post_terms( $post_id, $field['taxonomy'] );
	      $tmp_values = array();
	      if ( !empty($terms_value) ) {
	         foreach ($terms_value as $term) {
	            $tmp_values[] = $term->term_id;
	         }
	      }
	      $values = $tmp_values;
      }

		if( empty($values) ){
			$values = array();
		}

		$terms = get_terms( array(
	      'taxonomy' => 'job_listing_amenity',
	      'hide_empty' => false,
	   ));

		$categories = array();
		$categories_query = get_terms( array(
		   'taxonomy'   => 'job_listing_category',
		   'hide_empty' => false,
		));

		foreach ($categories_query as $category) {
			$categories[$category->slug] = $category->term_id;
		}

    	if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
	      foreach ($terms as $term) {
	      	$term_amenity_cats_slug = $term && !empty($term->term_id) ? get_term_meta( $term->term_id, 'gva_amenity_categories', true ) : false;
	      	$term_amenity_cats_class_array = array();
	      	if($term_amenity_cats_slug){
		      	foreach ($term_amenity_cats_slug as $amenity_cat_slug) {
		      		if($categories[$amenity_cat_slug] && $categories[$amenity_cat_slug]){
		      			$term_amenity_cats_class_array[] = 'cat-' . $categories[$amenity_cat_slug];
		      		}
		      	}
		      }
	      	$term_amenity_cats_class = count($term_amenity_cats_class_array) > 0 ? implode(' ', $term_amenity_cats_class_array) : 'cat-all';
	        	echo '<li class="d-none ameity-cat-item ' .  $term_amenity_cats_class . '">';
	          	echo '<div class="pretty p-icon p-curve p-smooth">';
	          		echo ('<input name="tax_input[job_listing_amenity][]" type="checkbox" value="' . $term->term_id . '"' . ( in_array($term->term_id, $values) ? 'checked="checked"' : '' ) . '/>');
	        			echo '<div class="state">';
                     echo '<i class="icon fas fa-check"></i>';
                     echo '<label>' . esc_html($term->name) . '</label>';
                  echo '</div>';
	        		echo '</div>';
	        	echo '</li>';
	      }
    	}  
	?>
	</ul>


<?php }else{ ?>

	<ul class="job-manager-term-checklist job-manager-term-checklist-<?php echo esc_attr( $key ); ?>">
	<?php
		require_once( ABSPATH . '/wp-admin/includes/template.php' );

		if ( empty( $field['default'] ) ) {
			$field['default'] = '';
		}

		$args = [
			'descendants_and_self'  => 0,
			'selected_cats'         => isset( $field['value'] ) ? $field['value'] : ( is_array( $field['default'] ) ? $field['default'] : [ $field['default'] ] ),
			'popular_cats'          => false,
			'taxonomy'              => $field['taxonomy'],
			'checked_ontop'         => false
		];

		// $field['post_id'] needs to be passed via the args so we can get the existing terms.
		ob_start();
		wp_terms_checklist( 0, $args );
		$checklist = ob_get_clean();
		echo str_replace( "disabled='disabled'", '', $checklist );
	?>
	</ul>

<?php } ?>

<?php if ( ! empty( $field['description'] ) ) : ?><small class="description"><?php echo wp_kses_post( $field['description'] ); ?></small><?php endif; ?>

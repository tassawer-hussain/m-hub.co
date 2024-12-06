<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Fioxen_Listings_Term_Metabox{

  	public function __construct(){ 
	 	add_action( 'job_listing_category_add_form_fields', array($this, 'fioxen_themer_term_add_meta_field') );
	 	add_action( 'job_listing_category_edit_form_fields', array($this, 'fioxen_themer_term_edit_meta_field'), 999);

	 	add_action( 'job_listing_amenity_add_form_fields', array($this, 'fioxen_themer_term_add_meta_field') );
	 	add_action( 'job_listing_amenity_edit_form_fields', array($this, 'fioxen_themer_term_edit_meta_field'), 999);

	 	add_action( 'create_term', array($this, 'fioxen_themer_save_taxonomy_custom_meta'), 10, 2 );
	 	add_action( 'edit_term', array($this, 'fioxen_themer_save_taxonomy_custom_meta'), 10, 2 );
  	}

  	public function fioxen_themer_term_edit_meta_field( $term ) {
  		wp_enqueue_style( 'wp-color-picker' );
  		wp_enqueue_media();
		wp_enqueue_script('meta-term', GAVIAS_FIOXEN_PLUGIN_URL . 'listings/assets/js/meta-term.js', array('jquery', 'wp-color-picker'));
		$gva_term_color = $term && !empty($term->term_id) ? get_term_meta( $term->term_id, 'gva_term_color', true ) : false;
		$gva_term_icon_type = $term && !empty($term->term_id) ? get_term_meta( $term->term_id, 'gva_term_icon_type', true ) : 'icon_type_font';
		$gva_term_icon_font = $term && !empty($term->term_id) ? get_term_meta( $term->term_id, 'gva_term_icon_font', true ) : false;
		$gva_term_icon_image = $term && !empty($term->term_id) ? get_term_meta( $term->term_id, 'gva_term_icon_image', true ) : false;
		$gva_term_icon_image_demo_url = $gva_term_icon_image ? wp_get_attachment_image_src($gva_term_icon_image)[0] : '';
		?>

		<?php if( $term->taxonomy == 'job_listing_amenity' ){ ?>
			<tr class="form-field job-listing-amenity-category">
			  <td><label><strong><?php _e( 'Listing Category Amenity', 'fioxen-themer' ); ?></strong></label></td>
			  <td class="values">
				 <?php 
					$gva_amenity_categories = $term && !empty($term->term_id) ? get_term_meta( $term->term_id, 'gva_amenity_categories', true ) : array();
					$this->get_categories_field($gva_amenity_categories); 
				 ?>
			  </td>  
			</tr>
		<?php } ?>  

	 	<tr class="form-field">
			<td><label for="term_meta[gva_term_color]"><strong><?php _e( 'Choose Color', 'fioxen-themer' ); ?></strong></label></td>
			<td><input id="gva_term_color_input" name="gva_term_color" type="text" value="<?php echo esc_attr($gva_term_color); ?>"></td>
	 	</tr>
	  
	 	<tr class="form-field">
			<td><label for="term_meta[gva_term_icon_type]"><strong><?php _e( 'Icon Type', 'fioxen-themer' ); ?></strong></label></td>
			<td>
			  <label><input name="gva_term_icon_type" type="radio" value="icon_type_font" <?php echo ( $gva_term_icon_type == 'icon_type_font' ? 'checked="checked"' : '' ); ?>>Icon Font</label>
			  <label><input name="gva_term_icon_type" type="radio" value="icon_type_image" <?php echo ( $gva_term_icon_type == 'icon_type_image' ? 'checked="checked"' : '' ); ?>>Icon Image</label>
			</td>
	 	</tr>

	  	<tr class="form-field field-icon-type-font">
			<td><label><strong><?php _e( 'Icon Font', 'fioxen-themer' ); ?></strong></label></td>
			<td><input id="gva_term_icon_font_input" name="gva_term_icon_font" type="text" value="<?php echo esc_attr($gva_term_icon_font); ?>"></td>
	  	</tr>

	  	<tr class="form-field field-icon-type-image">
	  		<td><label for="term_meta[gva_term_icon_image]"><strong><?php _e( 'Icon Image', 'fioxen-themer' ); ?></strong></label></td>
	  		<td>
		 		<input id="gva_term_icon_image_input" name="gva_term_icon_image" type="hidden" value="<?php echo esc_attr($gva_term_icon_image); ?>">
		 		<img id="gva_term_icon_image_demo" src="<?php echo esc_url($gva_term_icon_image_demo_url) ?>" style="max-width:120px;padding:6px 0;" />
		 		<div class="upload_image_action">
					<input type="button" class="button term-add-image" value="Add Icon Image">
					<input type="button" class="button term-remove-image" value="Remove Icon Image">
		 		</div>
	  		</td> 
	  	</tr>

	  <?php
  }

  public  function fioxen_themer_term_add_meta_field( $term ) {
  		wp_enqueue_style( 'wp-color-picker' );
  		wp_enqueue_media();
		wp_enqueue_script('meta-term', GAVIAS_FIOXEN_PLUGIN_URL . 'listings/assets/js/meta-term.js', array('jquery', 'wp-color-picker'));
	 
		$gva_term_color = $term && !empty($term->term_id) ? get_term_meta( $term->term_id, 'gva_term_color', true ) : false;
		$gva_term_icon_type = isset($term->term_id) && get_term_meta( $term->term_id, 'gva_term_icon_type', true ) ? get_term_meta( $term->term_id, 'gva_term_icon_type', true ) : 'icon_type_font';
		$gva_term_icon_font = $term && !empty($term->term_id) ? get_term_meta( $term->term_id, 'gva_term_icon_font', true ) : false;
		$gva_term_icon_image = $term && !empty($term->term_id) ? get_term_meta( $term->term_id, 'gva_term_icon_image', true ) : false;
		$gva_term_icon_image_demo_url = $gva_term_icon_image ? wp_get_attachment_image_src($gva_term_icon_image) : '';
	 ?>

		<div class="form-field">
		  	<label><strong><?php _e( 'Listing Category Amenity', 'fioxen-themer' ); ?></strong></label>
		  	<?php if( $term == 'job_listing_amenity' ) $this->get_categories_field(false); ?>
		</div>

		<div class="form-field" style="display: none;">
		  	<label for="term_meta[gva_term_color]"><strong><?php _e( 'Choose Color', 'fioxen-themer' ); ?></strong></label>
		  	<input id="gva_term_color_input" name="gva_term_color" type="text" value="<?php echo esc_attr($gva_term_color); ?>">
	  	</div>
	  	<div class="form-field">
		  	<label for="term_meta[gva_term_icon_type]"><strong><?php _e( 'Icon Type', 'fioxen-themer' ); ?></strong></label>
		  	<label><input name="gva_term_icon_type" type="radio" value="icon_type_font" <?php echo ( $gva_term_icon_type == 'icon_type_font' ? 'checked="checked"' : '' ); ?>>Icon Font</label>
		  	<label><input name="gva_term_icon_type" type="radio" value="icon_type_image" <?php echo ( $gva_term_icon_type == 'icon_type_image' ? 'checked="checked"' : '' ); ?>>Icon Image</label>
	  	</div>
	  	<div class="form-field field-icon-type-font" style="display: none;">
		  	<label><strong><?php _e( 'Icon Font', 'fioxen-themer' ); ?></strong></label>
		  	<input id="gva_term_icon_font_input" name="gva_term_icon_font" type="text" value="<?php echo esc_attr($gva_term_icon_font); ?>">
	  	</div>
	  	<div class="form-field field-icon-type-image" style="display: none;">
		  	<label for="term_meta[gva_term_icon_image]"><strong><?php _e( 'Icon Image', 'fioxen-themer' ); ?></strong></label>
		  	<input id="gva_term_icon_image_input" name="gva_term_icon_image" type="hidden" value="<?php echo esc_attr($gva_term_icon_image); ?>">
		  	<img id="gva_term_icon_image_demo" src="" style="max-width:120px;padding:6px 0;" />
		  	<div class="upload_image_action">
			 	<input type="button" class="button term-add-image" value="Add Icon Image">
			 	<input type="button" class="button term-remove-image" value="Remove Icon Image">
		 	</div>
	  	</div>

	  <?php
  }


  public function fioxen_themer_save_taxonomy_custom_meta( $term_id ) {
	 if(isset( $_POST['gva_term_color'] ) && $_POST['gva_term_color'] ){
		update_term_meta( $term_id, 'gva_term_color', $_POST['gva_term_color'] );
	 }

	 if(isset( $_POST['gva_term_icon_type'] ) && $_POST['gva_term_icon_type'] ){
		update_term_meta( $term_id, 'gva_term_icon_type',  $_POST['gva_term_icon_type'] );
	 }

	 if(isset( $_POST['gva_term_icon_font'] ) && $_POST['gva_term_icon_font'] ){
		update_term_meta( $term_id, 'gva_term_icon_font',  $_POST['gva_term_icon_font'] );
	 }

	 if(isset( $_POST['gva_term_icon_image'] ) && $_POST['gva_term_icon_image'] ){
		update_term_meta( $term_id, 'gva_term_icon_image',  $_POST['gva_term_icon_image'] );
	 }

	 if(isset( $_POST['gva_amenity_categories'] ) && $_POST['gva_amenity_categories'] ){
		update_term_meta( $term_id, 'gva_amenity_categories',  $_POST['gva_amenity_categories'] );
	 }
  }

  public function get_categories_field( $val = array() ) {
	 
	 $terms = get_terms( array(
		'taxonomy' => 'job_listing_category',
		'hide_empty' => false,
	 ));

	 if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
		foreach ($terms as $term) {
		  $checked = '';
		  if( $val && ( in_array($term->slug, $val)) ){
			 $checked = 'checked="checked"';
		  }
		  echo '<label>';
			 echo ('<input name="gva_amenity_categories[]" type="checkbox" value="' . $term->slug . '"' . $checked . '/>' . $term->name);
		  echo '</label>';
		}
	 }       
  }

}

new Fioxen_Listings_Term_Metabox();
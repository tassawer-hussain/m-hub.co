<?php
/**
 * Shows the `text` form field on job listing forms.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/form-fields/text-field.php.
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
<?php if($key == '_job_location'){ ?>

   <div class="field-places-autocomplete">
      <input type="text" class="input-text id_job_listing_location_text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>" autocomplete="off" id="<?php echo esc_attr( $key ); ?>" placeholder="<?php echo empty( $field['placeholder'] ) ? '' : esc_attr( $field['placeholder'] ); ?>" value="<?php echo isset( $field['value'] ) ? esc_attr( $field['value'] ) : ''; ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
      <?php if ( ! empty( $field['description'] ) ) : ?><small class="description"><?php echo wp_kses_post( $field['description'] ); ?></small><?php endif; ?>
      <div class="places_list_autocomplete"></div>
   </div> 

<?php }else{ ?>

   <?php if( isset($field['list_type']) && $field['list_type'] == 'hours' ){ ?>
      <?php
         $value = isset($field['value']) ? $field['value'] : array();
         $time_from = isset($value[0]) && $value[0] ? $value[0] : '';
         $time_to = isset($value[1]) && $value[1] ? $value[1] : '';
      ?>
      <label class="time-from">
         <span class="title"><?php echo esc_html__('From', 'fioxen') ?></span>
         <input type="text" class="input-text input-time" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[0]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder'] ) ? '' : esc_attr( $field['placeholder'] ); ?>" value="<?php echo esc_attr($time_from) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
      </label>
      <label class="time-to">
         <span class="title"><?php echo esc_html__('To', 'fioxen') ?></span>
         <input type="text" class="input-text input-time" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[1]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder_1'] ) ? '' : esc_attr( $field['placeholder_1'] ); ?>" value="<?php echo esc_attr($time_to) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
      </label>


   <?php }elseif( isset($field['list_type']) && $field['list_type'] == 'additional' ){ ?>

      <?php
         $value = isset($field['value']) ? $field['value'] : array();
         $val_label_1 = isset($value[0][0]) && $value[0][0] ? $value[0][0] : '';
         $val_value_1 = isset($value[0][1]) && $value[0][1] ? $value[0][1] : '';
      ?>
      <div class="clearfix margin-bottom-10">
         <input style="width: 50%;float: left;" type="text" class="input-text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[0][]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder'] ) ? '' : esc_attr( $field['placeholder'] ); ?>" value="<?php echo esc_attr($val_label_1) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
         <input style="width: 50%;float: left;" type="text" class="input-text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[0][]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder_1'] ) ? '' : esc_attr( $field['placeholder_1'] ); ?>" value="<?php echo esc_attr($val_value_1) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
      </div>

      <?php
         $val_label_2 = isset($value[1][0]) && $value[1][0] ? $value[1][0] : '';
         $val_value_2 = isset($value[1][1]) && $value[1][1] ? $value[1][1] : '';
      ?>
      <div class="clearfix margin-bottom-10">
         <input style="width: 50%;float: left;" type="text" class="input-text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[1][]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder'] ) ? '' : esc_attr( $field['placeholder'] ); ?>" value="<?php echo esc_attr($val_label_2) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
         <input style="width: 50%;float: left;" type="text" class="input-text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[1][]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder_1'] ) ? '' : esc_attr( $field['placeholder_1'] ); ?>" value="<?php echo esc_attr($val_value_2) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
      </div>

      <?php
         $val_label_3 = isset($value[2][0]) && $value[2][0] ? $value[2][0] : '';
         $val_value_3 = isset($value[2][1]) && $value[2][1] ? $value[2][1] : '';
      ?>
      <div class="clearfix margin-bottom-10">
         <input style="width: 50%;float: left;" type="text" class="input-text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[2][]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder'] ) ? '' : esc_attr( $field['placeholder'] ); ?>" value="<?php echo esc_attr($val_label_3) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
         <input style="width: 50%;float: left;" type="text" class="input-text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[2][]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder_1'] ) ? '' : esc_attr( $field['placeholder_1'] ); ?>" value="<?php echo esc_attr($val_value_3) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
      </div>

      <?php
         $val_label_4 = isset($value[3][0]) && $value[3][0] ? $value[3][0] : '';
         $val_value_4 = isset($value[3][1]) && $value[3][1] ? $value[3][1] : '';
      ?>
      <div class="clearfix margin-bottom-10">
         <input style="width: 50%;float: left;" type="text" class="input-text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[3][]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder'] ) ? '' : esc_attr( $field['placeholder'] ); ?>" value="<?php echo esc_attr($val_label_4) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
         <input style="width: 50%;float: left;" type="text" class="input-text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[3][]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder_1'] ) ? '' : esc_attr( $field['placeholder_1'] ); ?>" value="<?php echo esc_attr($val_value_4) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
      </div>

      <?php
         $val_label_5 = isset($value[4][0]) && $value[4][0] ? $value[4][0] : '';
         $val_value_5 = isset($value[4][1]) && $value[4][1] ? $value[4][1] : '';
      ?>
      <div class="clearfix margin-bottom-10">
         <input style="width: 50%;float: left;" type="text" class="input-text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[4][]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder'] ) ? '' : esc_attr( $field['placeholder'] ); ?>" value="<?php echo esc_attr($val_label_5) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
         <input style="width: 50%;float: left;" type="text" class="input-text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[4][]"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> placeholder="<?php echo empty( $field['placeholder_1'] ) ? '' : esc_attr( $field['placeholder_1'] ); ?>" value="<?php echo esc_attr($val_value_5) ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
      </div>
   <?php }else{ ?>
      
      <input type="text" class="input-text" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> id="<?php echo esc_attr( $key ); ?>" placeholder="<?php echo empty( $field['placeholder'] ) ? '' : esc_attr( $field['placeholder'] ); ?>" value="<?php echo isset( $field['value'] ) ? esc_attr( $field['value'] ) : ''; ?>" maxlength="<?php echo esc_attr( ! empty( $field['maxlength'] ) ? $field['maxlength'] : '' ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
      <?php if ( ! empty( $field['description'] ) ) : ?><small class="description"><?php echo wp_kses_post( $field['description'] ); ?></small><?php endif; ?>

   <?php } ?>

<?php } ?>


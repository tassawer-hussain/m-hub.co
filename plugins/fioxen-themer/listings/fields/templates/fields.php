<h2 style="margin: 15px 10px;"><?php echo esc_html__('Listing Fields Manager', 'fioxen-themer') ?></h2>
<form id="lt-manager-listing-field" method="POST" style="padding: 10px;">
   
   <fieldset class="lt-listing-field-wrap">
      <?php 
      if( is_array($fields_group) ){
         $m = 0;
         foreach($fields_group as $gkey => $fields){
            echo '<div class="lt-field-row field-type-group">' . $gkey . ' Group</div>';

            foreach ($fields as $fkey => $field){
               $label = isset($field['label']) ? $field['label'] : '';
               $key = isset($field['key']) ? $field['key']  : '';
               $type = isset($field['type']) ? $field['type']  : '';
               $type_field = isset($field['type_field']) ? $field['type_field']  : '';
               $group = isset($field['group']) ? $field['group']  : '';
         ?>
            <div class="lt-field-row field-type-<?php echo $type ?>">
               <div class="lt-repeater-field-wrap lt-column" >
                  <div class="field-row-head lt-move ui-sortable-handle">
                     <div class="field_title">
                        <span><?php echo $label ?></span>
                        <span>(<?php echo $key; ?>)</span>
                     </div>
                     <div class="lt-header-btn-group">
                        <button class="edit_field"><i class="dashicons-before dashicons-edit"></i></button>
                        <?php if($type_field == 'custom'){
                           echo '<button type="button" class="lt-btn-remove-field"><i class="dashicons-before dashicons-trash"></i></button>';
                        }?>
                     </div>
                  </div>

                  <div class="lt-row-body">
                  <input type="hidden" name="gva_listing_fields[<?php echo $m;?>][type]" value="<?php echo $type ?>">
                  <input type="hidden" name="gva_listing_fields[<?php echo $m;?>][key]" value="<?php echo $key ?>">
                  <input type="hidden" name="gva_listing_fields[<?php echo $m;?>][type_field]" value="<?php echo $type_field ?>">
                     
                     <div class="form-group">
                        <label>Priority</label>
                        <input type="text" class="field_priority" name="gva_listing_fields[<?php echo $m;?>][priority]" value="<?php echo isset($field['priority']) ? $field['priority'] : $m ?>">
                     </div>
                     
                     <div class="form-group">
                        <label>Label</label>
                        <input type="text" name="gva_listing_fields[<?php echo $m;?>][label]" data-pattern-name="gva_listing_fields[++][label]" onkeyup="lt_modify_label_name(this);" value="<?php echo $label ?>" required placeholder="Label" class="lt-text-field">
                     </div>

                     <div class="form-group">
                        <label>Placeholder</label>
                        <input type="text" name="gva_listing_fields[<?php echo $m;?>][placeholder]" data-pattern-name="gva_listing_fields[++][placeholder]" value="<?php echo isset($field['placeholder']) ? $field['placeholder'] : ''; ?>" placeholder="" class="lt-text-field">
                     </div>
                     <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="gva_listing_fields[<?php echo $m;?>][description]" data-pattern-name="gva_listing_fields[++][description]" value="<?php echo isset($field['description']) ? $field['description'] : ''; ?>" placeholder="" class="lt-text-field">
                     </div>
                     <div class="form-group">
                        <label>Group on Sumbit Form</label>
                        <select name="gva_listing_fields[<?php echo $m;?>][group]" data-pattern-name="gva_listing_fields[++][group]">
                           <?php 
                              foreach (Fioxen_LT_Fields_Model::instance()->listing_fields_groups() as $key => $item) {
                                 echo '<option value="' . $key . '"' . ($group==$key ? ' selected' : '') . '>' . $item . '</option>';
                              }
                           ?>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>
                           <input class="input-checkbox" type="checkbox" <?php echo (isset($field['required']) && $field['required'] == '1') ? 'checked' : ''; ?> name="gva_listing_fields[<?php echo $m;?>][required]" data-pattern-name="gva_listing_fields[++][required]" value="1">
                           Required
                        </label>
                     </div>
                    
                     <div class="form-group">
                        <label>
                           <input class="input-checkbox" type="checkbox" <?php echo (isset($field['disable']) && $field['disable'] == '1') ? 'checked' : ''; ?> name="gva_listing_fields[<?php echo $m;?>][disable]" data-pattern-name="gva_listing_fields[++][disable]" value="1">
                           Disable
                        </label>
                     </div>

                  </div>
                        
               </div>
            </div>
         <?php
               $m++;
            }
         }
      }
      ?> 
      <div class="add_button_sections">
         <button type="button" class="lt-field-btn_add btn btn-second lt-review-add-button" data-index="<?php echo $m ?>"><?php echo esc_html__('Add Custom Field', 'wp-fundraising'); ?></button>
      </div>

   </fieldset>




   <div class="form-action" style="border-top: 1px solid #ccc;padding-top: 15px; margin-top: 15px;">
      <button type="submit" class="button button-primary btn-lt-save-fields" href="#">Save Fields</button>
   </div>
</form>

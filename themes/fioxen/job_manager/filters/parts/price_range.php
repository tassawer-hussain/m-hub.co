<?php 
   $lt_currency = fioxen_get_option('lt_currency_symbol', '$');
?>
<div class="search_price_range clearfix">
   <div class="content-inner">
      <i class="icon fa-solid fa-money-check"></i>
      <select class="filter_price_range job-manager-filter" data-placeholder="<?php echo esc_attr__( 'Price Range', 'fioxen' ); ?>" name="lt_filter_price_range">
         <option value=""><?php esc_html_e( 'Price Range', 'fioxen' ); ?></option>
         <option value="inexpensive"><?php echo esc_html($lt_currency) ?>&nbsp;-&nbsp;<?php echo esc_html__('Inexpensive', 'fioxen') ?></option>
         <option value="moderate"><?php echo esc_html($lt_currency . $lt_currency) ?>&nbsp;-&nbsp;<?php echo esc_html__('Moderate', 'fioxen') ?></option>
         <option value="pricey"><?php echo esc_html($lt_currency . $lt_currency . $lt_currency) ?>&nbsp;-&nbsp;<?php echo esc_html__('Pricey', 'fioxen') ?></option>
         <option value="ultra-high"><?php echo esc_html($lt_currency . $lt_currency . $lt_currency . $lt_currency) ?>&nbsp;-&nbsp;<?php echo esc_html__('Ultra High', 'fioxen') ?></option>
      </select>
   </div>
</div>

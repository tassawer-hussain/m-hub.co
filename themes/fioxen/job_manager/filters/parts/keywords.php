<?php
   $keywords = isset( $_REQUEST['search_keywords'] ) ? $_REQUEST['search_keywords'] : $keywords;
?>
<div class="lt-search_keywords search_keywords">
   <div class="content-inner">
      <i class="icon fa-solid fa-globe"></i>
	  <input type="text" name="search_keywords" class="lt-search-keyword-autocomplete" id="search_keywords" placeholder="<?php esc_attr_e( 'Looking for shopping, restaurant...', 'fioxen' ); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
      <div class="keyword_list_autocomplete" style="display:none;"></div>
   </div>
</div> 
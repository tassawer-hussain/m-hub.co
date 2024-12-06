<?php
   $keywords = isset( $_REQUEST['search_title'] ) ? $_REQUEST['search_title'] : $keywords;
?>
<div class="lt-search_title search_title">
   <div class="content-inner">
      <i class="icon fa-solid fa-globe"></i>
	  <input type="text" name="search_title" class="lt-search-title-autocomplete job-manager-filter" id="search_title" placeholder="<?php esc_attr_e( 'Title...', 'fioxen' ); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
      <!-- <div class="keyword_list_autocomplete" style="display:none;"></div> -->
   </div>
</div> 
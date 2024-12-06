<div class="gva-template-wrapper">
   <div class="navigate">

   </div>
   <div class="gva-template-content">
      
      <?php require_once('parts/header.php'); ?>
      <?php require_once('parts/footer.php'); ?>
      <?php require_once('parts/page.php'); ?>

      <?php require_once('parts/listing_single.php'); ?>
      
      <?php require_once('parts/post_single.php'); ?>
      <?php require_once('parts/post_archive.php'); ?>

      <div id="gva-ajax-loadding" class="ajax-message" style="opacity: 0;">
         <div class="content">
            <img src="<?php echo GAVIAS_FIOXEN_PLUGIN_URL ?>/layout/assets/loading.gif"/>
         </div>  
      </div>

      <div id="gva-ajax-success" class="ajax-message" style="opacity: 0;">
         <div class="content-inner" style="text-align: center;">
            <img src="<?php echo GAVIAS_FIOXEN_PLUGIN_URL ?>/layout/assets/animated-check.gif"/>
            <h2><?php echo esc_html__('Changes saved successfully', 'fioxen-themer') ?></h2>
         </div>  
      </div>

      <div class="gva-ajax-overlay"></div>
   </div>
</div>
<section class="page-banner">
  <img src="<?php echo the_field('banner_image'); ?>" class="fordeskbanner">
  <!-- <img src="<?php echo the_field('mobile_banner_image'); ?>" class="formobbanner"> -->
  <div class="page-banner-inner">
    <div class="container">
      <div class="banner-text">
        <div class="overflow-hidden"><h1 class="drop-in"><?php echo the_field('banner_title'); ?></h1></div>
        <div class="overflow-hidden"><p class="drop-in-2"><?php echo the_field('banner_subtitle'); ?></p></div>
        <?php echo the_field('banner_button'); ?>
      </div>
    </div>
    <div class="breadcrumbs">
      <?php
        if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb('<div class="breadcrumb-inner">','</div>');
        }
      ?>
    </div>
  </div>
</section>
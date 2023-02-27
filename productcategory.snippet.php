<?php final class getProdCatLists{   
  function __construct(){

  }
  function getCatLists(){
    $prdTerms = get_terms([
      'taxonomy' => 'product_cat',
      'hide_empty' => false,
      'order' => 'ASC',
    ]); ?>
    <div class="tab_ul_div">
      <ul class="prd-cats-tab-ul">             
        <?php
        
          foreach ($prdTerms as $key => $prdTerm) { ?>     
            <li onclick="getCatId(this.id)" class="prd-cats-lists" id="parent_<?php echo $prdTerm->term_id; ?>">
              <div class="prod_tab_box"><?php echo $prdTerm->name; ?></div>
            </li>
          <?php 
          
        } ?>
      </ul>  
    </div>
    <?php 
  } 
   function getCatListDetails(){
    $prdTerms = get_terms([
      'taxonomy' => 'product_cat',
      'hide_empty' => false,
      'order' => 'ASC',
    ]); ?>
    <div class="prd-cats-div">
      <div class="inner-prd-cats-div">             
        <?php
        $ptCtr = 0;
          foreach ($prdTerms as $key => $prdTerm) { ?>     
            <div class="tab_detail_div prd-cats-lists <?php echo ($ptCtr == 0 )? "" : "hideme" ?> parent_<?php echo $prdTerm->term_id; ?>" id="parent_contents_<?php echo $prdTerm->term_id; ?>">
              <div class="prod_tab_img_box">
                  <div class="prod_tab_img">
                    <a href="<?php echo $prdTerm->slug; ?>">
                      <?php $thumbnail = get_field('product_category_image','product_cat_'.$prdTerm->term_id);
                      if($thumbnail){ ?>
                        <img src="<?php echo get_field('product_category_image','product_cat_'.$prdTerm->term_id); ?>" alt="<?php echo $prdTerm->name; ?>" />
                      <?php }else{?>
                        <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2023/02/Centrifugal-Pump-img.png" alt="<?php echo $prdTerm->name; ?>" />
                      <?php }?>
                    </a>
                  </div>
                  <div class="prod_tab_img_title">
                    <h3><?php echo $prdTerm->name; ?></h3>
                  </div>
                </div>
                <div class="prod_tab_text">
                  <div class="tab_text">
                    <?php echo category_description($prdTerm->term_id); ?>
                    <a class="explorenow" href='<?php echo $prdTerm->slug; ?>'>
                      <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2023/01/explore-now-icon.png">
                    EXPLORE NOW</a>
                  </div>
              </div>
            </div>
            <!-- category products --> 
            <div class="tab_related_prod_div">
              <ul class="prd-cats-tab-ul">               
              <?php 
              $prdArgs = array(
                'post_type' => 'cb_products',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => array($prdTerm->term_id),
                  ),
                ),
              );

              $prdArgQuery = new WP_Query($prdArgs);            
              while($prdArgQuery->have_posts()):$prdArgQuery->the_post(); ?>                
                <li class="related_prod_box prd-cats-lists <?php echo($ptCtr == 0)? "" : "hideme"; ?> parent_<?php echo $prdTerm->term_id; ?>" id="parent_product_<?php echo $prdTerm->term_id; ?>">
                  <a href="<?php the_permalink() ?>">
                    <?php $thumbnail = get_the_post_thumbnail_url(); 
                    if($thumbnail){ ?>
                      <img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
                    <?php }else{?>
                      <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2023/02/Fristam-FP-Centrifugal-Pump.jpg" alt="<?php the_title(); ?>" />
                    <?php }?>
                  </a>
                  <h3>
                    <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
                  </h3>
                </li>
              <?php endwhile; ?>
              <?php wp_reset_query(); ?>
              </ul>
            </div>
            <!-- category products --> 
          <?php 
          $ptCtr++;
        } ?>
      </div>  
    </div>
    <?php 
  }  
}
$objCats = new getProdCatLists();
$objCats-> getCatLists();
$objCats->getCatListDetails();
?>
<script>  
  jQuery(document).ready(function(){
    jQuery('.prd-cats-tab-ul .prd-cats-lists:eq(0)').addClass('activetab');
  });
  function getCatId(id) {    
    jQuery(".activetab").removeClass('activetab');
    jQuery("#"+id).addClass('activetab');
    jQuery(".prd-cats-div .inner-prd-cats-div .prd-cats-lists").addClass('hideme');
    jQuery(".prds-contents .prd-cats-tab-ul li").addClass('hideme');
    jQuery(".prd-cats-div .inner-prd-cats-div ."+id).removeClass('hideme');
    jQuery(".prds-contents .prd-cats-tab-ul ."+id).removeClass('hideme');  
  }
</script>
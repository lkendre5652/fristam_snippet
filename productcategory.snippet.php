<!-- <div class="prod_tab_sec">
  <div class="tab_ul_div">
    <ul>
      <li>
        <div class="prod_tab_box">Centrifugal Pump</div>
      </li>
    </ul>
  </div>
  <div class="tab_detail_div">
    <div class="prod_tab_img_box">
        <div class="prod_tab_img">
          <img src="https://development.ikf.in/fristampumps/wp-content/uploads/2023/01/Centrifugal-Pump-img.png" alt="" />
        </div>
        <div class="prod_tab_img_title">
          <h3>Centrifugal</h3>
          <h3>Pump</h3>
        </div>
      </div>
      <div class="prod_tab_text">
        <div class="tab_text">
          <p>
            Fristam centrifugal pumps combine robust design with sophisticated
            engineering to ensure flawless and frictionless processing. The
            wide-ranging assortment of types means you are sure to find a
            reliable solution that fits your products, installations, and
            performance requirements. Easy to look after and maintain, our
            centrifugal pumps make replacing worn-out components easy,
            minimising downtime and extending your system's lifecycle.
          </p>
          <a href="centrifugal-pump">EXPLORE NOW</a>
        </div>
    </div>
  </div>
   <div class="tab_related_prod_div">
    <ul>
        <li>
            <div class="related_prod_box">
                <img src="https://development.ikf.in/fristampumps/wp-content/uploads/2023/01/Fristam-FP-Centrifugal-Pump.jpg" alt="">
                <h3>Fristam FP Centrifugal Pump</h3>
            </div>
        </li>
    </ul>
  </div>
</div>
 -->



<style>  
  ul.prd-cats-tab-ul li {
    float: left;
    margin-left: 43px;
    list-style: none;
    background: #FFFFFF;
}

ul.prd-cats-tab-ul a {
  text-decoration: none !important;
}

.hideme{
  display: none;
}
.showme{
  display: block; 
}
</style>



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
                    <img src="<?php echo get_field('product_category_image','product_cat_'.$prdTerm->term_id); ?>" alt="<?php echo $prdTerm->name; ?>"/>
                  </div>
                  <div class="prod_tab_img_title">
                    <h3><?php echo $prdTerm->name; ?></h3>
                  </div>
                </div>
                <div class="prod_tab_text">
                  <div class="tab_text">
                    <p><?php echo category_description($prdTerm->term_id); ?></p>
                    <a href='<?php echo $prdTerm->slug; ?>'>EXPLORE NOW</a>
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
                  <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                  <h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
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
  function getCatId(id) {    
    jQuery(".prd-cats-div .inner-prd-cats-div .prd-cats-lists").addClass('hideme');
    jQuery(".prds-contents .prd-cats-tab-ul li").addClass('hideme');
    jQuery(".prd-cats-div .inner-prd-cats-div ."+id).removeClass('hideme');
    jQuery(".prds-contents .prd-cats-tab-ul ."+id).removeClass('hideme');  
  }
</script>
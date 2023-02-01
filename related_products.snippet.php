<ul class="othr-prdcts-list">
  <?php    
  class getRelatedProducts{
    function __construct($term_id,$post_id){
      $this->term_id=$term_id;        
      $this->post_id = $post_id;
    }
    function getRelatedProductLists(){
      $prodArgs = array(
        'post_type' => 'cb_products',
        'posts_per_page' => -1,
        'post__not_in' => array($this->post_id),
        'tax_query' => array(
          array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => array($this->term_id),
          ),
        ),        
      );
      $prodQuery = new WP_Query($prodArgs);        
      while($prodQuery->have_posts()){$prodQuery->the_post(); ?>
        <li class="othr-prdcts-list-wrap">
          <div class="othr-prdcts-div">
            <div class="othr-prdcts-img">
              <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?= the_title(); ?>" />
            </div>
            <div class="othr-prdcts-content">
              <div class="prdcts-content-inr-wrap">
              <h3><?= the_title(); ?></h3>
              <a href="<?= the_permalink(); ?>" class="cmn-circle-btn"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="33.985" height="34" viewBox="0 0 33.985 34">
  <defs>
    <clipPath id="clip-path">
      <rect id="Rectangle_120" data-name="Rectangle 120" width="33.985" height="34" fill="none"/>
    </clipPath>
  </defs>
  <g id="Group_173" data-name="Group 173" clip-path="url(#clip-path)">
    <path id="Path_198" data-name="Path 198" d="M15.995,34c-.644-.087-1.293-.151-1.932-.265a16.686,16.686,0,0,1-9.829-5.53A16.425,16.425,0,0,1,.088,18.7,16.532,16.532,0,0,1,3.525,6.666,16.406,16.406,0,0,1,13.422.4a16.482,16.482,0,0,1,13.87,3.113A16.511,16.511,0,0,1,33.6,13.46c.157.721.217,1.462.324,2.194.017.118.041.235.061.353V18c-.027.239-.055.478-.082.717a16.794,16.794,0,0,1-4.268,9.619,16.669,16.669,0,0,1-9.717,5.4c-.639.113-1.287.177-1.931.264ZM17,1.711A15.292,15.292,0,1,0,32.28,17.034,15.3,15.3,0,0,0,17,1.711" transform="translate(0 0)"/>
    <path id="Path_199" data-name="Path 199" d="M109.1,131.036h-.355q-6.024,0-12.048,0a1.032,1.032,0,0,1-.82-.278.78.78,0,0,1-.2-.826.862.862,0,0,1,.724-.6,2.674,2.674,0,0,1,.4-.011h12.393c-.129-.135-.206-.218-.287-.3q-1.49-1.491-2.981-2.98a.866.866,0,0,1-.228-.943.7.7,0,0,1,.7-.519,1.109,1.109,0,0,1,.686.238c1.6,1.564,3.174,3.147,4.748,4.734a.843.843,0,0,1,0,1.248q-2.348,2.369-4.715,4.72a.846.846,0,1,1-1.192-1.2q1.47-1.487,2.955-2.96c.086-.085.182-.16.274-.239l-.04-.088" transform="translate(-86.875 -113.177)"/>
  </g>
</svg>
</a>
              </div>
            </div>
          </div>
        </li>
      <?php 
      }
    }
  }
  global $post;
  $terms = wp_get_object_terms( get_queried_object_id(), 'product_cat');    
  $obj = new getRelatedProducts($terms[0]->term_id,$post->ID);
  $obj->getRelatedProductLists();    
  ?>             
</ul>
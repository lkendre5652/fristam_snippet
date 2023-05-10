<?php 
// first
// $first = 17;
// $first_f = 20;
// $first_s = 23;


// sec
$sec = 18;
$sec_f = 21;


// third
$third = 19;
$third_f = 22;



if($first && $sec && $third){
  echo "all";
  $args = array(
    'post_type' => 'cb_testimonials',
    'posts_per_page' => 5,
    'tax_query' => array(
      'relation' => "AND",
        array(
            'taxonomy' => 'testimonials_type',
            'field' => 'term_id',
            'terms' => array($first_f,$first_s),
            'operator' => "IN"

        ),
          array(
            'taxonomy' => 'testimonials_type',
            'field' => 'term_id',
            'terms' => array($sec_f),
            'operator' => "IN"

        ),
           array(
            'taxonomy' => 'testimonials_type',
            'field' => 'term_id',
            'terms' => array($third_f),
            'operator' => "IN"

        )
    )
);


}else if($first && $sec ){
  echo "fs";
  $args = array(
    'post_type' => 'cb_testimonials',
    'posts_per_page' => 5,
    'tax_query' => array(
      'relation' => "AND",
        array(
            'taxonomy' => 'testimonials_type',
            'field' => 'term_id',
            'terms' => array($first_f,$first_s),
            'operator' => "IN"

        ),
          array(
            'taxonomy' => 'testimonials_type',
            'field' => 'term_id',
            'terms' => array($sec_f),
            'operator' => "IN"

        )

    )
);

}else if($first && $third ){
  echo "ft";
  $args = array(
    'post_type' => 'cb_testimonials',
    'posts_per_page' => 5,
    'tax_query' => array(
      'relation' => "AND",
        array(
            'taxonomy' => 'testimonials_type',
            'field' => 'term_id',
            'terms' => array($first_f,$first_s),
            'operator' => "IN"

        ),
          array(
            'taxonomy' => 'testimonials_type',
            'field' => 'term_id',
            'terms' => array($third_f),
            'operator' => "IN"

        )
         
    )
);

}else if($sec && $third ){
  echo "st";
  $args = array(
      'post_type' => 'cb_testimonials',
      'posts_per_page' => 5,
      'tax_query' => array(
        'relation' => "AND",
          array(
              'taxonomy' => 'testimonials_type',
              'field' => 'term_id',
              'terms' => array($sec_f),
              'operator' => "IN"

          ),
            array(
              'taxonomy' => 'testimonials_type',
              'field' => 'term_id',
              'terms' => array($third_f),
              'operator' => "IN"
          )

      )
  );

}else{
  echo "defalut";

  $args = array(
    'post_type' => 'cb_testimonials',
    'posts_per_page' => 5,
    'tax_query' => array(      
        array(
            'taxonomy' => 'testimonials_type',
            'field' => 'term_id',
            'terms' => array($first_f,$first_s,$sec_f,$third_f),
            'operator' => "IN"

        )
    )
);

}



$query = new WP_Query($args);

// echo "<pre>";
// print_r($query);
// echo "</pre>";


while($query->have_posts() ):$query->the_post();
  the_title();
endwhile;


?>
<div class="testim_slider_div">
  <?php
      // BOF News  display  
      $query = new WP_Query(array(
          'post_type'  => 'cb_testimonials',
          'posts_per_page'  =>  -1,
          'order' => 'ASC'
      ));
      while ($query->have_posts()) {
          $query->the_post();
  ?>
      <div class="testim_box">
        <img class="testim_quote_img" src="https://development.ikf.in/sancheti/wp-content/uploads/2023/04/testim_qoute.svg" alt="">
        <?php the_content(); ?>
        <div class="testim_desig"><h3><?php the_title(); ?></h3><span><?php echo the_field('testi_project_name'); ?></span></div>
      </div>
  <?php
       } // EOF while loop
       // echo paginate_links();
  ?>
</div>

<script type="text/javascript">
  jQuery('.testim_slider_div').slick({
    dots: false,
    arrows:true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: true,
      variableWidth: true,
     infinite: true,
  });
</script>
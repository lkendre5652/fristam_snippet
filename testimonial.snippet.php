<div class="testimonial-container">
  <div class="testimonialswiper">
    <div class="swiper-wrapper">
      <?php 
      class getTestimonial{
        const TESTARG = ['post_type' => 'cb_testimonials','posts_per_page' => -1,'order' => 'ASC',]; 
        public function getAllList(){
          $TESTARGS = new WP_Query(self :: TESTARG);        
          while($TESTARGS->have_posts()):$TESTARGS->the_post(); ?>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="testimonial-item_icon">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="43.829" height="37.647" viewBox="0 0 43.829 37.647">
                    <defs>
                      <clipPath id="clip-path">
                        <rect id="Rectangle_99" data-name="Rectangle 99" width="43.829" height="37.647" fill="#0053a4"/>
                      </clipPath>
                    </defs>
                    <g id="Group_79" data-name="Group 79" opacity="0.13">
                      <g id="Group_78" data-name="Group 78" clip-path="url(#clip-path)">
                        <path id="Path_156" data-name="Path 156" d="M237.7,37.647c-.184-.012-.367-.036-.551-.036q-8.85,0-17.7.008c-.424,0-.549-.094-.548-.537.016-6-.07-12,.031-18,.137-8.136,3.961-13.985,11.313-17.475A16.81,16.81,0,0,1,236.9.068c.269-.01.537-.045.805-.068V6.331c-7.719-.022-12.778,6.754-12.435,12.492H237.7Z" transform="translate(-193.874)" fill="#0053a4"/>
                        <path id="Path_157" data-name="Path 157" d="M.031,37.942v-.5c0-6.031-.081-12.063.02-18.092C.187,11.193,4.086,5.392,11.44,1.932A17.055,17.055,0,0,1,18.571.418a1.569,1.569,0,0,1,.221.03v6.22a12.449,12.449,0,0,0-9.7,4.658,12.3,12.3,0,0,0-2.805,7.853h12.5V37.942Z" transform="translate(0 -0.37)" fill="#0053a4"/>
                      </g>
                    </g>
                  </svg>
                </div>
                <div class="testimonial-contents">
                  <?php the_excerpt(); ?>
                </div>
                <div class="testimonial-name">
                  <div class="testimonial-img">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
                  </div>
                  <div class="testimonial-heading">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo get_field('designation'); ?></p>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile;
        }
      }
      $tstObj = new getTestimonial();
      $tstObj->getAllList();
      ?> 
    </div>
    <!-- <div class="testimonialpagination"></div> -->
    <div class="testimonial_next_prev">
      <div class="testimonialprev">
        <img src="https://development.ikf.in/fristampumps/wp-content/uploads/2023/01/explore-now-icon.png" />
      </div>
      <div class="testimonialnext">
        <img src="https://development.ikf.in/fristampumps/wp-content/uploads/2023/01/explore-now-icon.png" />
      </div>
    </div>
  </div>
</div>
<style>
.testimonial-item {
    background: #fff;
    border: 1px solid #707070;
    padding: 30px 30px 25px 30px;
}
.testimonial-item .testimonial-item_icon {
    margin: 0 0 10px 0;
}
.testimonial-item .testimonial-contents p {
    padding: 0;
    margin: 0;
    font-size: 16px;
    line-height: 26px;
    color: #000;
}
.testimonial-item .testimonial-name {
    display: flex;
    margin: 15px 0 0;
}
.testimonial-item .testimonial-name .testimonial-img {
    width: 63px;
    height: 63px;
    border-radius: 100%;
    overflow: hidden;
    margin-right: 24px;
}
.testimonial-item .testimonial-name .testimonial-heading h3 {
    font-size: 20px;
    color: #0053A4;
    line-height: 26px;
    margin: 0;
}
.testimonial-item .testimonial-name .testimonial-heading p {
    font-size: 14px;
    line-height: 26px;
    color: #8A8A8A;
    margin-bottom: 0;
}
.swiper-slide {
    opacity: 0 !important;
}
.swiper-slide.active {
    opacity: 1 !important;
}
.swiper-slide.active + .swiper-slide,
.swiper-slide.active + .swiper-slide  + .swiper-slide,
.swiper-slide.active + .swiper-slide  + .swiper-slide  + .swiper-slide{
    opacity: 1 !important;
}
.testimonial_next_prev {
    display: flex;
    margin: 50px 0 50px 0;
}

.testimonial_next_prev .testimonialprev {
    transform: rotate(180deg);
    margin: 0 26px 0 0;
}
</style>
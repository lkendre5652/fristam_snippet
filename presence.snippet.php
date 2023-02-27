<?php 
$prCatArgs = array(
  'taxonomy' => 'presence_type',
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 0,
    'parent' => 0
);
$prCats = get_categories($prCatArgs); ?>
<div class="our-prsnc-inputs">
    <ul class="input-list">
      <li>
        <input id="search" type="text" name="search" placeholder="Search" ></li>
      <li>
        <select class="opcontinent" id="continent" name="continent">
          <option value="" >Select Continent</option>
          <?php foreach($prCats as $prCat){ ?>
            <option ><?php echo $prCat->name; ?></option>
          <?php } ?>                    
      </select>
      </li> 
      <li>        
         <select class="opcountry"id="country" >
            <option value="">Select Country</option>
            <?php foreach($prCats as $prCat){ ?>  
            <?php $childcats=get_categories( array( 'hide_empty' => 0,'parent' => $prCat->term_id, 'taxonomy' => 'presence_type' ) ); 
            foreach($childcats as $child){ ?>
              <option class="<?php echo str_replace(" ","-",$prCat->name); ?>"><?php echo $child->name; ?></option> 
              <?php } } ?>       
          </select>        
      </li>
    </ul>
</div>
<?php 
$prnsArg = array(
  'post_type' => 'cb_ourpresence',
  'posts_per_page' => -1,
  'order' => 'ASC',   
);
$prsnQry = new WP_Query( $prnsArg ); 
?>
<div class="our-prsnc-info" id="ourpresence" >  
  <ul class="info-list">
    <?php while($prsnQry->have_posts()){ $prsnQry->the_post(); 
      $presence_tel = get_field("presence_tel");
      $presence_email = get_field("presence_email");
      $presence_mobile = get_field("presence_mobile"); 
    ?>
      <li>        
        <span><?php the_title(); ?></span>
        <?php echo (!empty($presence_tel) ) ? "<span> Tel: <a href='#.'>".$presence_tel."</a></span>" : "" ;?>
        <?php echo (!empty($presence_email) ) ? "<span> Tel: <a href='#.'>".$presence_email."</a></span>" : "" ;?>
        <?php echo (!empty($presence_mobile) ) ? "<span> Tel: <a href='#.'>".$presence_mobile."</a></span>" : "" ;?>
      </li>        
    <?php  } ?>     
  </ul>
</div>
  
<script>
  jQuery(document).ready(function(){  
    jQuery("#country option").hide()
    jQuery("#continent").change(function(){ 
      const continent = jQuery(this).find(" :selected").text();
      console.log(continent.replaceAll(" ","-"));
      jQuery("#country option").hide()
      jQuery("#country ."+continent.replaceAll(" ","-")).show();      
    });
   
   // on key search
   jQuery("#search").keyup(function(){
      const search = jQuery(this).val().toLowerCase();            
      const country = jQuery('#country').val().toLowerCase(); 
      jQuery("#ourpresence ul li").filter(function(){
        if(search.length > 0 && country.length > 1 ){
          console.log("both"+country.length)
          jQuery(this).toggle( jQuery(this).text().toLowerCase().includes(search) &&  jQuery(this).text().toLowerCase().includes(country)  );
        }else if( search.length > 0 ){          
          jQuery(this).toggle( jQuery(this).text().toLowerCase().includes(search) );
        }else{
          jQuery(this).toggle( jQuery(this).text().toLowerCase().includes(country) );
        }        
      })
   })

   // on country change
    jQuery("#country").change(function(){
      const country = jQuery(this).val().toLowerCase();            
      const search = jQuery('#search').val().toLowerCase(); 
      jQuery("#ourpresence ul li").filter(function(){
        if(country.length > 0 && search.length > 1 ){
          console.log("both"+search.length)
          jQuery(this).toggle( jQuery(this).text().toLowerCase().includes(search) &&  jQuery(this).text().toLowerCase().includes(search)  );
        }else if( country.length > 0 ){          
          jQuery(this).toggle( jQuery(this).text().toLowerCase().includes(country) );
        }else{
          jQuery(this).toggle( jQuery(this).text().toLowerCase().includes(search) );
        }
        
      })
   })

  });
</script>
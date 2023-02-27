<div style='display:none; ' class="loader_gif" id='loader-img'>
	<img src="<?php echo esc_url(home_url()); ?>/wp-content/uploads/2022/11/loader.gif"  />
</div>

<?php 
	$args = array(
		'taxonomy' => 'dealerlocator_type',
	  	'orderby' => 'name',
	  	'order' => 'ASC',
	  	'hide_empty' => 0,
	  	'parent' => 0
	);
	$categories = get_categories($args); 
?>

<div class="popfrmbx">
    <div class="popfrmtr">
    	<select class="slctdrp" id="dealerState" onchange="isError(this.value);" >
			<option value="">Select State</option>
			<?php foreach($categories as $parent_cat){ ?>
				<option value="<?php echo $parent_cat->name; ?>"><?php echo $parent_cat->name; ?></option>
			<?php } ?>
		</select>
       <span id="error-dep1" class="hiddengroup errormsg">Please select the field</span>
    </div>
    <div class="popfrmtr">
       <select class="slctdrp" id="dealerCity1" >
			<option value="">Select City</option>
			<?php 
			foreach($categories as $parentcat){ 
				$childcats=get_categories( array( 'hide_empty' => 0,'parent' => $parentcat->term_id, 'taxonomy' => 'dealerlocator_type' ) );
				foreach($childcats as $child){ ?>
					<!-- <optgroup class="hiddengroup <?php //echo str_replace(' ', '', $parentcat->name); ?>" >  -->
						<option class="<?php echo str_replace(' ', '', $parentcat->name); ?> hiddengroup" value="<?php echo $child->name;?> " ><?php echo $child->name;?></option>
					<!-- </optgroup>  -->
			<?php }
			} ?>
		</select>
    </div>
      <div class="rdmrebtn">
      	<button onclick="fetchdealerdata();">Locate</button>
	   </div>
 </div>
<div id="dealerAddressAjaxData" style="display: none;">
   <div class="wrapscroll">
      <div class="dealerlist">
         <div class="row">
            <div class="col-md-6">
               <div class="statecity">Dealers in <span class="delearcity" id="location_name">Pune</span>,<span class="delearstates" id="location_name_1">Maharashtra
                  </span>
               </div>
            </div>
            <div class="col-md-6">
               <div class="statecity1"><span class="resultshow">Showing <span class="resultnumb" id="location_count">9</span> results</span></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="listdealers pop-location">
                  <div class="innerdelear demo-2y" id="innerdelear">
                        
                          
                        
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<script>	

function isError(values){
	const mainCatgoryCls = values.replaceAll(" ","");
	jQuery('#dealerCity1 option').addClass('hiddengroup');	
	if(values.length > 1){
		jQuery("#error-dep1").addClass("hiddengroup");
		jQuery('#dealerCity1 .'+mainCatgoryCls).removeClass('hiddengroup');
	}else{		
		jQuery('#dealerCity1 option:first').addClass('hiddengroup');		
		jQuery("#error-dep1").removeClass("hiddengroup");
	}
}

jQuery(document).ready(function(){
	jQuery("#dealerCity1 option").hide();
});

function fetchdealerdata(){
	var stateName = jQuery('#dealerState option:selected').val();
	var cityName = jQuery('#dealerCity1 option:selected').val();
	
	// on submit error
	isError(stateName);
	
	if( (stateName.length > 1 && cityName.length > 1 )  ){
		jQuery('#error-dep').addClass("hiddengroup");
		jQuery('#error-desig').addClass("hiddengroup");		
		jQuery.ajax({
			type : 'post',
			dataType : 'json',
			url: "<?= site_url() ?>/wp-admin/admin-ajax.php",            
			data : {action:'my_location_action',stateName : stateName, cityName:cityName,},
			beforeSend: function() {
             	jQuery('#loader-img').show(); 
            },
            complete: function() {             
             	jQuery('#loader-img').hide();
            },
            success: function(resp){
            	if(resp.status == 'error'){					
					var output = '';				
					output += `<li>`;
					output += `<div>${resp.msg}</div>`;
					output += `</li>`;
					jQuery('#dealerlisting').html(output);					
				}
				if(resp.status == 'success'){
				var datas = resp.data.length;									
				if(datas >= 1 ){
					var output = '';
					var locationcount = '';

					for(l=0;l<datas; l++){
						location_count = resp.data[0].location_count
						output += `<div class="addrsbx2">`;
						output += `<div class="dealername">`;
						output += `<h3>${resp.data[l].title}</h3>`;
						output += `</div>`;
						output += `<div class="adrlst add">`;
						output += `<p>${resp.data[l].locationName}</p>`;
						output += `</div>`;
						output += `<div class="adrlst phn">`;
						output += `<p>${resp.data[l].phoneNumber}</p>`;
						output += `</div>`;
						output += `<div class="adrlst mail">`;
						output += `<p><a href="${resp.data[l].emailId}" target="_blank" rel="noopener noreferrer">${resp.data[l].emailId}</a></p>`;
						output += `</div>`;
						output += `</div>`;						
					}
					jQuery('#innerdelear').html(output);
					jQuery('#location_count').html(location_count);	
					jQuery('#location_name').html(cityName);	
					jQuery('#location_name_1').html(stateName);
					jQuery('#dealerAddressAjaxData').show();								
				} 	
			}
            }
		});

	}else{
	if(stateName.length < 1 ){
		jQuery('#error-dep').removeClass("hiddengroup");		
	}				
		jQuery('#error-desig').removeClass("hiddengroup");
	}
}
</script>
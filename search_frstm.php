<script>

class SearchCheck{

	searchFilterSearch(){
		var searchp = jQuery('#searchp').val();
		if (searchp.length >= 1) {
			jQuery('#type_all').val('any');
			jQuery('#type_pages').val('page');
			jQuery('#type_post').val('cb_products');

			jQuery('#type-page').val('page');
			jQuery('#type-cb_products').val('cb_products');
		} else {

		}

	}

	ischeck(event){
		if(event.checked){
			
			if(event.id === "type_all"){
				jQuery('#type_all').val('any');
				jQuery('#type_pages').val('page');
				jQuery('#type_post').val('cb_products');

				jQuery('#type-page').val('page');
				jQuery('#type-cb_products').val('cb_products');


				jQuery('#type-page').prop('checked', true);
				jQuery('#type-cb_products').prop('checked', true);

				jQuery('#type_pages').prop('checked', true);
				jQuery('#type_post').prop('checked', true);
			}else{
				jQuery("#"+event.id).val(event.id.split("-")[1]);
				jQuery("#"+event.id).attr('checked');							
			}
			
		}else{			
			
			if( event.id === "type_all" ){
				jQuery('#type_all').val('');				
				jQuery('#type_pages').val('');
				jQuery('#type_post').val('');

				jQuery('#type-page').val('');
				jQuery('#type-cb_products').val('');


				jQuery('#type-page').prop('checked', false);
				jQuery('#type-cb_products').prop('checked', false);

				jQuery('#type_pages').prop('checked', false);
				jQuery('#type_post').prop('checked', false);

			}else{
				jQuery('#type_all').val('');
				jQuery("#"+event.id).val('');

				jQuery('#type_all').prop('checked', false);
				jQuery("#"+event.id).removeAttr('checked');	
			}
			
		}	
	}
}
const srchObj = new SearchCheck();

 // ajax search function 
function searchFilter() {
	var search_text = jQuery('#searchp').val();
	var type_all = jQuery('#type_all').val();	
	var type_pages = jQuery('#type-page').val();
	var type_post = jQuery('#type-cb_products').val();	

	var value = parseInt(document.getElementById('number').value);
	jQuery.ajax({
		type: 'post',
		dataType: 'json',
		url: "<?= site_url() ?>/wp-admin/admin-ajax.php",
		data: {
			'action': 'search_action',
			'search_text': search_text,
			'type_all': type_all,
			'type_pages': type_pages,
			'type_post': type_post,
			'number': value
		},
		beforeSend: function() {
			jQuery('.loader-img').show();
		},
		complete: function() {
			jQuery('.loader-img').hide();
		},
		success: function(resp) {
			
			if (resp.status == 'error') {
				var output = '';
				//output += `<ul>`;
				output += `<li class="search-error-msg" >${resp.msg}</li>`;
				//output += `</ul>`;
				jQuery('#search_div').html(output);
				jQuery('#searchp').css('border', '1px solid red');
				jQuery("#load_button").css('display', 'none');
			}
			if (resp.status == 'success') {
				jQuery('#searchp').css('border', '0px');
				var datas = resp.data.length;
				var pcount = resp.data[0].post_count;
				if(pcount >= 5 ){
					jQuery("#load_button").css('display', 'block');
				}else{
					jQuery("#load_button").css('display', 'none');
				}
				if (datas >= 1) {
					var output = '';
					for (i = 0; i < datas; i++) {
						// if(resp.data[i].post_count < value ){						
						// 	jQuery("#load_button").hide();
						// }

						output += `<li class="searchresule">`;
						output += `<div class="img_box"><div class="img_box_wrap"><a href="${resp.data[i].permalink}">`;
						if (resp.data[i].thumbnail.length >= 1) {
							output += `<img src="${resp.data[i].thumbnail}" />`;
						} else { 
							output += `<img src="<?= site_url() ?>/wp-content/uploads/2023/04/not_found.jpg" />`;
						}
						output += `</a></div></div>`;
						output += `<div class="content_box">`;
						output += `<div class="title"> <a href="${resp.data[i].permalink}">${resp.data[i].title}</a></div>`;
						output += `<div class="content"> ${resp.data[i].contents}</div>`;
						output += `<div class="publishdate"><span>${resp.data[i].publishdate} </span></div>`;
						output += `<div class="explore_wrap"> <a href="${resp.data[i].permalink}" class="Explore_btn"> Explore </a></div>`;
						output += `</div>`;
						output += `</li>`;
					}
					jQuery('#search_div').html(output);
					jQuery('.content_box .read-more').css('display','none');
					jQuery('.content_box .read-more').remove();
				}
			}
		}
	})
}

// load more button
value = 5
function incrementValue()
{
    value = parseInt(document.getElementById('number').value,10);
    value = isNaN(value) ? 0 : value;
    value+= 5;
    document.getElementById('number').value = value;
    searchFilter();
}

// user enter on form
jQuery(document).ready(function () {  
	jQuery("#searchform").bind("keypress", function (e) {  
		//console.log(e.keyCode);		
		if (e.keyCode == 13) {  
			return false;  
		}  
	});  
});

</script>
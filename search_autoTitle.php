<script>
	
// // auto complete JS
function searchFilterTitle(valuetitle){
    var search_text = valuetitle;
    if(search_text.length > 0){  
    jQuery('.ast-header-search .ast-search-menu-icon.slide-search .search-form input.search-field').css('borderBottom','2px solid #5DBC30');                
    jQuery("#searchformhomelk").attr('action',"<?php echo esc_url( home_url( '/' ) ); ?>");
    jQuery("#searchformhomelk input").attr('name',"s");      
    jQuery.ajax({type : 'post',
            dataType : 'json',
            url: "<?= site_url() ?>/wp-admin/admin-ajax.php",
            data: {'action':'title_search_action','searchtitle': search_text,},            
            success:function(resp){         
            	var output = '';        
				if(resp.status == 'error'){        
					console.log(resp.msg);
					output += `<li class="searchresulered">`;
					output += `<div>${resp.msg}</div>`;                     
					output += `</li>`;
					jQuery('.searchfilter_ul').html(output);

				}
              if(resp.status == 'success'){                                
                var datas = resp.data.length;                                 
                if(datas >= 1 ){
                  //var output = '';
                  var count = 0;
                  for(l=0;l<datas; l++){                    
                    if(count <= 4){
                        output += `<li class="searchresule">`;
                        output += `<div onclick="changeTitlte(jQuery(this).text())">${resp.data[l].posts_title}</div>`;                     
                        output += `</li>`;
                    }else{
                        break;
                    }
                    count++;                    
                  }
                  jQuery('.searchfilter_ul').html(output);  
                } 
              }     
          }
    })

}else{
        jQuery("#searchformhomelk").attr('action',"");
        jQuery("#searchformhomelk input").attr('name',"");
        jQuery('.ast-header-search .ast-search-menu-icon.slide-search .search-form input.search-field').css('borderBottom','2px solid red');
    }
}
function changeTitlte(values){   
    jQuery(".search-field").val(values); 
    if(values != ""){                
        jQuery("#searchformhomelk").trigger( "submit" );               
    }
}

// auto complete JS
</script>
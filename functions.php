<?php // Shri //

define('DEV_MODE', true);

require locate_template('/inc/core/lib.php');
require locate_template('/inc/core/util.php');
require locate_template('/inc/core/user-agent.php');
require locate_template('/inc/core/scripts.php');
require locate_template('/inc/core/cleanup.php');
require locate_template('/inc/core/init.php');

if( function_exists('WC') ){
	// Include WooCommerce [remove if non woocommerce theme]
	require locate_template('/woocommerce/functions.php');
}

// WRITE-BELOW-THIS //


// Styles ---------------------------------------------------------------------------

add_google_fonts(
	'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800'
);

cb_style( 'style_name', array(
	'src' => 'assets/css/style_name.css'
) );
cb_style( 'fancybox-style', array(
	'src' => 'assets/css/jquery.fancybox.css',
));
cb_style( 'font-awesome-style', array(
	'src' => 'assets/css/font-awesome.min.css',
));

// Loads our main stylesheet.
cb_style( 'cbwptheme-style', array(
	'src' => 'assets/css/style.less',
), 9999 );

cb_style( 'slick-style', array(
	'src' => 'assets/css/slick.css',
), 9999);

cb_style( 'cbwptheme-style-1', array(
	'src' => 'assets/css/style-1.css',
), 9999 );

// Scripts ---------------------------------------------------------------------------

// Add Custom JS
cb_script( 'jquery-fancybox-js', array(
	'src' => 'assets/js/jquery.fancybox-new.js',
) );
cb_script( 'jquery-fancybox-media-js', array(
	'src' => 'assets/js/jquery.fancybox-media-new.js',
) );
cb_script( 'slick-js', array(
	'src' => 'assets/js/slick.min-new.js',
) );
cb_script( 'filetype-js', array(
	'src' => 'assets/js/jquery-filestyle.min-new.js',
) );
cb_script( 'custom-js', array(
	'src' => 'assets/js/custom.js',
) );




// Adds jQuery
cb_script( 'jquery', array(
	'register' => false
), 0 );

// Handles jQuery conflict
cb_script( 'jquery_no_conflict_reset', array(
	'src' => 'assets/js/jquery-no-conflict-reset.js'
), 0 );

// Add html 5 support for older browsers
cb_script( 'cbwptheme-html5', array(
	'src' => 'assets/js/html5.js',
	'ver' => '1.0',
	'condition' => ( cb_is_browser('msie') && cb_get_browser_version() < 9 )
), 1 );

// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
cb_script( 'comment-reply', array(
	'condition' => (is_singular() && comments_open() && get_option('thread_comments')),
	'register' => false
) );

// Add Sidebars
function cb_add_sidebars() {

	register_sidebar(array(
		'name' => __('Content Sidebar', 'cbwptheme'),
		'id' => 'content-sidebar',
		'description' => __('Content Sidebar', 'cbwptheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Header Sidebar', 'cbwptheme'),
		'id' => 'header-sidebar',
		'description' => __('Header Sidebar', 'cbwptheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Footer Sidebar', 'cbwptheme'),
		'id' => 'footer-sidebar',
		'description' => __('Footer Sidebar', 'cbwptheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

}
add_action( 'cb_add_sidebars', 'cb_add_sidebars' );





// Add Nav Menus
function cb_add_nav_menus(){

	register_nav_menu( 'primary', __( 'Primary Menu', 'cbwptheme') );
	register_nav_menu( 'sitemap', __( 'Sitemap Menu', 'cbwptheme') );

}
add_action( 'cb_add_nav_menus', 'cb_add_nav_menus' );





// Post Formats
function cb_post_formats( $formats ){
	// 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
	return array();
}
add_filter( 'cb_post_formats', 'cb_post_formats', 1 );

add_action('wp_head', 'add_loader_gif');

function add_loader_gif() {
  echo '<style>.wpcf7 .ajax-loader{background-image: url('. plugins_url() .'/contact-form-7/images/ajax-loader.gif);visibility:hidden;display:inline-block;width:16px;height:16px;border:none;padding:0;margin:0 0 0 4px;vertical-align:middle}.wpcf7 .ajax-loader.is-active{visibility:visible}</style>';
}

add_action('wp_footer', 'countryStateRetrival', 99);
function countryStateRetrival()
{ ?>
	<script type="text/javascript">
		jQuery(function(){
			jQuery('select[name="menu-182"],select[name="menu-735"],select[name="menu-657"]').empty().append('<option value="">Please Wait..</option>');
			jQuery.ajax({
				url : "",
				method : "POST",
				data : {getCountry : 786},
				success : function(resp){
					var response = jQuery.parseJSON(resp);
					if(response.countries)
					{
						jQuery('select[name="menu-182"],select[name="menu-735"],select[name="menu-657"]').empty().append('<option value="">Country</option>');;
						var countries = response.countries;
						jQuery.each(countries, function(key, value){
							jQuery('select[name="menu-182"],select[name="menu-735"],select[name="menu-657"]').append('<option value="'+value.name+'" data-id="'+value.id+'">'+value.name+'</option>');
						});
					}
				},
				error : function(ts){
					console.log(ts.responseText);
				}
			});
		});

		jQuery(document).on('change', 'select[name="menu-182"]', function(){
			var selected = jQuery('option:selected', this).data('id');
			if(selected == "")
			{
				return false;
			}
			jQuery('select[name="menu-662"]').empty().append('<option value ="">Please Wait..</option>');
			jQuery.ajax({
				url : "",
				method : "POST",
				data : {countryId : selected},
				success : function(resp){
					var response = jQuery.parseJSON(resp);
					if(response.states)
					{
						jQuery('select[name="menu-662"]').empty().append('<option value ="">State</option>');
						var states = response.states;
						jQuery.each(states, function(key, value){
							jQuery('select[name="menu-662"]').append('<option value="'+value.name+'" data-id="'+value.id+'">'+value.name+'</option>');
						});
					}
				},
				error : function(ts){
					console.log(ts.responseText);
				}
			});
		});
	</script>	
<?php }

if(isset($_POST['getCountry']) && $_POST['getCountry'] == 786)
{
	global $wpdb;
	$data = array();
	$qryGetCountries = "SELECT * FROM countries WHERE active_sts = 'y'";
	$qryGetCountriesExec = $wpdb->get_results($qryGetCountries);
	if($qryGetCountriesExec)
	{
		$data['countries'] = $qryGetCountriesExec;
	} else {
		$data['countries'] = null;
	}
	echo json_encode($data); exit;
}
if(isset($_POST['countryId']) && $_POST['countryId'] != null)
{
	global $wpdb;
	$countryId = $_POST['countryId'];
	$data = array();
	$qryGetStates = "SELECT * FROM states WHERE country_id = ".$countryId." AND active_sts = 'y'";
	$qryGetStatesExec = $wpdb->get_results($qryGetStates);
	if($qryGetStatesExec)
	{
		$data['states'] = $qryGetStatesExec;
	}
	else
	{
		$data['states'] = null;	
	}

	echo json_encode($data); exit;
}


/*
* nah - handle ajax request from regulatory filling page
*/
add_action('wp_ajax_get_regulatory_filling', 'getRegulatoryFilling');
add_action('wp_ajax_nopriv_get_regulatory_filling', 'getRegulatoryFilling');
function getRegulatoryFilling() {
	$response = [];
	$no_of_posts = absint($_POST['no_of_posts']);
	$page_no = absint($_POST['page_no']);
	$catId = ($_POST['cat_id']) ? absint($_POST['cat_id']) : null;
	$freeText = ($_POST['free_text']) ? sanitize_text_field($_POST['free_text']) : null; 	
    
    $args = array(
		        'post_type'  => 'cb_regulatory',
		        'posts_per_page'  =>  $no_of_posts,
		        'paged'=>$page_no,
		        'orderby'   => 'ID',
		        'order' => 'DESC'
		    );
    
    if($freeText != null) {
    	$args['s'] = $freeText;
    }

    if($catId != null) {
    	$args['tax_query'] = array(
		array(
			'taxonomy' => 'regulatory_type',
			'field'    => 'term_id',
			'terms'    => array($catId)
		)	
	 );
    }
    
    $query = new WP_Query($args);

    $postCount = $query->found_posts;
    $data = [];
    if($postCount == 0) {
    	$response = [
    		'status' => 'error',
    		'data' => null,
    		'response_type' => 'get_records',
    		'msg' => 'No records found'
    	];

    	wp_send_json($response);
    	wp_die();
    }
    
	while ($query->have_posts()) {
            $query->the_post();
        $data[] = 	'<tr>
		                <td>'.get_the_title().'</td>
		                <td>'.get_field('regulatory_filings_cepasmf').'</td>
		                <td>'.get_field('regulatory_filings_us_dmf').'</td>
		            </tr>';
    }

    $response = [
    	'status' => 'success',
		'data' => $data,
		'page_no' => $page_no,
		'no_of_posts' => $no_of_posts,
		'total_number' => $postCount,
		'response_type' => 'get_records',
		'msg' => 'records found'
    ];

    wp_send_json($response);
    wp_die();
     
}
add_action('wp_ajax_contact_us','ajax_contact_us');
function ajax_contact_us(){
	$yearSelect = absint($_POST['select_year_box']);
//wp_send_json_success("test");
//	$arr = [];
	//wp_parse_str($_POST['contact_us'],$arr);
	//echo "<pre>";
	//print_r($arr);
  wp_die();
}


// Ajax request handling here
add_action('wp_ajax_nopriv_debt_filter_action', 'getDebtIssuePosts');
add_action('wp_ajax_debt_filter_action', 'getDebtIssuePosts');

function getDebtIssuePosts() {
	$data = $_POST;

	$termId = absint($data['term_id']);
	
	$yearField = (!empty($data['select_year_box'])) ? sanitize_text_field($data['select_year_box']) : "";
	$docField = (!empty($data['debtDoc'])) ? sanitize_text_field($data['debtDoc']) : "";
	$counterField = (!empty($data['counter'])) ? absint($data['counter']) : "";


	$args = array(
        'post_type' => 'cb_debtissue',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => array(
		    	array(
		                'taxonomy' => 'debtissue_type',
		                'field'    => 'term_id',
		                'terms'    => [$termId]
		            ),
		    ),
    );

		if($yearField != "" || $docField != "") {
			$args['meta_query'] = array(
					'relation' => 'AND',
			);

			if($yearField != "") {
				$args['meta_query'][] = array(
						'key' => 'financial_year',
            'value' => $yearField,
            'compare' => '='
				);
			}

			if($docField != "") {
				$args['meta_query'][] = array(
						'key' => 'debt_documents',
            'value' => $docField,
            'compare' => '='
				);
			}
		}

   
	// print_r($args);
	// exit;    

    $getPosts = new WP_Query($args);

    $post_count = $getPosts->post_count;
    if($post_count == 0) {
        $result = [
        'status' => 'error',
        'response_type' => 'get posts',
        'msg' => __( 'No Result found' ),
        'post_count' => $post_count,
        'data' => null,
        'counter' => $counterField
        ];
        wp_send_json($result);
        wp_die();    
    }
  $posts = [];
  if ( $getPosts->have_posts() ) { 
      while ($getPosts->have_posts()) {
    		$getPosts->the_post();
    		$posts[] = array(
    			'investor_date' => get_field('investor_date'),
    			'title' => get_the_title(),
    			'updf_link' => get_field('upload_pdf'),
    			'uaudio_link' => get_field('upload_audio')
    		);
  	 	}    
   } 
	$result = [
        'status' => 'success',
        'response_type' => 'get posts',
        'msg' => 'products found',
        'post_count' => $post_count,
        'data' => $posts,
        'counter' => $counterField
    ];
    wp_send_json($result);
    wp_die();
}

 // financial filter
add_action('wp_ajax_nopriv_financial_filter_action', 'getFinancialIssuePost');
add_action('wp_ajax_financial_filter_action', 'getFinancialIssuePost');

function getFinancialIssuePost() {
	$data = $_POST;
	$termId = absint($data['term_id']);	
	$yearField = (!empty($data['select_year_box'])) ? sanitize_text_field($data['select_year_box']) : "";	
	$counterField = (!empty($data['counter'])) ? absint($data['counter']) : "";
	$args = array(
        'post_type' => 'cb_financialresults',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => array(
		    	array(
            'taxonomy' => 'financialresults_type',
            'field'    => 'term_id',
            'terms'    => [$termId]
            ),
		    ),
    );

		if($yearField != "") {
			$args['meta_query'] = array(
					'relation' => 'AND',
			);
			if($yearField != "") {
				$args['meta_query'][] = array(
						'key' => 'financial_year',
            'value' => $yearField,
            'compare' => '='
				);
			}			
		}   
	// print_r($args);
	// exit;   
    $getPosts = new WP_Query($args);
    $post_count = $getPosts->post_count;
    if($post_count == 0) {
        $result = [
        'status' => 'error',
        'response_type' => 'get posts',
        'msg' => __( 'No Result found' ),
        'post_count' => $post_count,
        'data' => null,
        'counter' => $counterField,
        'layoutType' => $data['layout'],
        ];
        wp_send_json($result);
        wp_die();    
    }
  $posts = [];
  if ( $getPosts->have_posts() ) { 
      while ($getPosts->have_posts()) {
    		$getPosts->the_post();
    		$posts[] = array(
    			'title' => get_the_title(),
    			'thumbnail_img' => get_field('thumbnail_img'),
    			'investor_date' => get_field('investor_date'),
    			'upload_pdf' => get_field('upload_pdf'),
    			'updf_link' => get_field('upload_pdf'),
    			'uaudio_link' => get_field('upload_audio'),
    			'q1_pdf_link' => get_field('q1_pdf'),
					'q1_audio_link' => get_field('q1_audio'),
					'q2_pdf_link' => get_field('q2_pdf'),
					'q2_audio_link' => get_field('q2_audio'),
					'q3_pdf_link' => get_field('q3_pdf'),
					'q3_audio_link' => get_field('q3_audio'),
					'q4_pdf_link' => get_field('q4_pdf'),
					'q4_audio_link' => get_field('q4_audio'),
					'uploadv_link' => get_field('upload_video'),
					'custom_link' => get_field('custom_link'),

    		);
  	 	}    
   } 
	$result = [
        'status' => 'success',
        'response_type' => 'get posts',
        'msg' => 'products found',
        'post_count' => $post_count,
        'data' => $posts,
        'counter' => $counterField,
        'layoutType' => $data['layout'],
    ];
    wp_send_json($result);
    wp_die();
}

//  M & A Updates 

add_action('wp_ajax_nopriv_MAUpdates_filter_action', 'getDebtIssuePostMAUpdates');
add_action('wp_ajax_MAUpdates_filter_action', 'getDebtIssuePostMAUpdates');

function getDebtIssuePostMAUpdates() {
	$data = $_POST;
	$termId = absint($data['term_id']);	
	$yearField = (!empty($data['select_year_box'])) ? sanitize_text_field($data['select_year_box']) : "";
	$docField = (!empty($data['debtDoc'])) ? sanitize_text_field($data['debtDoc']) : "";
	$counterField = (!empty($data['counter'])) ? absint($data['counter']) : "";
	$args = array(
        'post_type' => 'cb_maupdates',
        'posts_per_page' => -1,
        'post_status' => 'publish',        
    );

		if($yearField != "" || $docField != "") {
			$args['meta_query'] = array(
					'relation' => 'AND',
			);

			if($yearField != "") {
				$args['meta_query'][] = array(
						'key' => 'financial_year',
            'value' => $yearField,
            'compare' => '='
				);
			}

			
		}

   
	// print_r($args);
	// exit;    

    $getPosts = new WP_Query($args);

    $post_count = $getPosts->post_count;
    if($post_count == 0) {
        $result = [
        'status' => 'error',
        'response_type' => 'get posts',
        'msg' => __( 'No Result found' ),
        'post_count' => $post_count,
        'data' => null,
        'counter' => $counterField
        ];
        wp_send_json($result);
        wp_die();    
    }
  $posts = [];
  if ( $getPosts->have_posts() ) { 
      while ($getPosts->have_posts()) {
    		$getPosts->the_post();
    		$posts[] = array(
    			'title' => get_the_title(),
    			'investor_date' => get_field('investor_date'),
					'updf_link' => get_field('upload_pdf'),
					'uaudio_link' => get_field('upload_audio'), 
    		);
  	 	}    
   } 
	$result = [
        'status' => 'success',
        'response_type' => 'get posts',
        'msg' => 'products found',
        'post_count' => $post_count,
        'data' => $posts,
        'counter' => $counterField
    ];
    wp_send_json($result);
    wp_die();
}


// AGM EGM
add_action('wp_ajax_nopriv_AgmEgm_filter_action', 'getAgmEgmPostMAUpdates');
add_action('wp_ajax_AgmEgm_filter_action', 'getAgmEgmPostMAUpdates');
function getAgmEgmPostMAUpdates() {
	$data = $_POST;
	$termId = absint($data['term_id']);	
	$yearField = (!empty($data['select_year_box'])) ? sanitize_text_field($data['select_year_box']) : "";
	$docField = (!empty($data['debtDoc'])) ? sanitize_text_field($data['debtDoc']) : "";
	$counterField = (!empty($data['counter'])) ? absint($data['counter']) : "";
	$args = array(
        'post_type' => 'cb_agmegm',
        'posts_per_page' => -1,
        'post_status' => 'publish',        
    );
		if($yearField != "" || $docField != "") {
			$args['meta_query'] = array(
					'relation' => 'AND',
			);
			if($yearField != "") {
				$args['meta_query'][] = array(
						'key' => 'financial_year',
            'value' => $yearField,
            'compare' => '='
				);
			}			
		}   
	// print_r($args);
	// exit;  
    $getPosts = new WP_Query($args);
    $post_count = $getPosts->post_count;
    if($post_count == 0) {
        $result = [
        'status' => 'error',
        'response_type' => 'get posts',
        'msg' => __( 'No Result found' ),
        'post_count' => $post_count,
        'data' => null,
        'counter' => $counterField
        ];
        wp_send_json($result);
        wp_die();    
    }
  $posts = [];
  if ( $getPosts->have_posts() ) { 
      while ($getPosts->have_posts()) {
    		$getPosts->the_post();
    		$posts[] = array(
    			'title' => get_the_title(),
    			'investor_date' => get_field('investor_date'),
					'updf_link' => get_field('upload_pdf'),
					'uaudio_link' => get_field('upload_audio'), 
    		);
  	 	}    
   } 
	$result = [
        'status' => 'success',
        'response_type' => 'get posts',
        'msg' => 'products found',
        'post_count' => $post_count,
        'data' => $posts,
        'counter' => $counterField
    ];
    wp_send_json($result);
    wp_die();
}



//  Equity Issue IPO

add_action('wp_ajax_nopriv_Issue_filter_action', 'getDebtIssuePostIssue');
add_action('wp_ajax_Issue_filter_action', 'getDebtIssuePostIssue');

function getDebtIssuePostIssue() {
	$data = $_POST;
	$termId = absint($data['term_id']);	
	$yearField = (!empty($data['select_year_box'])) ? sanitize_text_field($data['select_year_box']) : "";
	$docField = (!empty($data['debtDoc'])) ? sanitize_text_field($data['debtDoc']) : "";
	$counterField = (!empty($data['counter'])) ? absint($data['counter']) : "";
	$args = array(
        'post_type' => 'cb_ipo',
        'posts_per_page' => -1,
        'post_status' => 'publish',        
    );
		if($yearField != "") {
			$args['meta_query'] = array(
					'relation' => 'AND',
			);

			if($yearField != "") {
				$args['meta_query'][] = array(
						'key' => 'financial_year',
            'value' => $yearField,
            'compare' => '='
				);
			}
		}
	// print_r($args);
	// exit;   
    $getPosts = new WP_Query($args);
    $post_count = $getPosts->post_count;
    if($post_count == 0) {
        $result = [
        'status' => 'error',
        'response_type' => 'get posts',
        'msg' => __( 'No Result found' ),
        'post_count' => $post_count,
        'data' => null,
        'counter' => $counterField
        ];
        wp_send_json($result);
        wp_die();    
    }
  $posts = [];
  if ( $getPosts->have_posts() ) { 
      while ($getPosts->have_posts()) {
    		$getPosts->the_post();
    		$posts[] = array(    			
    			'title' => get_the_title(),
    			'investor_date' => get_field('investor_date'),
					'updf_link' => get_field('upload_pdf'),
					'uaudio_link' => get_field('upload_audio'), 
    		);
  	 	}    
   } 
	$result = [
        'status' => 'success',
        'response_type' => 'get posts',
        'msg' => 'products found',
        'post_count' => $post_count,
        'data' => $posts,
        'counter' => $counterField
    ];
    wp_send_json($result);
    wp_die();
}

// Preferential-issue  pending.............

add_action('wp_ajax_nopriv_PreferentialIssue_filter_action', 'getPostIssuePreferentialIssue');
add_action('wp_ajax_PreferentialIssue_filter_action', 'getPostIssuePreferentialIssue');

function getPostIssuePreferentialIssue() {
	$data = $_POST;
	$termId = absint($data['term_id']);	
	$yearField = (!empty($data['select_year_box'])) ? sanitize_text_field($data['select_year_box']) : "";
	$docField = (!empty($data['debtDoc'])) ? sanitize_text_field($data['debtDoc']) : "";
	$counterField = (!empty($data['counter'])) ? absint($data['counter']) : "";
	$args = array(
        'post_type' => 'cb_preferentialissue',
        'posts_per_page' => -1,
        'post_status' => 'publish',        
    );

		if($yearField != "") {
			$args['meta_query'] = array(
					'relation' => 'AND',
			);

			if($yearField != "") {
				$args['meta_query'][] = array(
						'key' => 'financial_year',
            'value' => $yearField,
            'compare' => '='
				);
			}
		}
	// print_r($args);
	// exit;   
    $getPosts = new WP_Query($args);
    $post_count = $getPosts->post_count;
    if($post_count == 0) {
        $result = [
        'status' => 'error',
        'response_type' => 'get posts',
        'msg' => __( 'No Result found' ),
        'post_count' => $post_count,
        'data' => null,
        'counter' => $counterField
        ];
        wp_send_json($result);
        wp_die();    
    }
  $posts = [];
  if ( $getPosts->have_posts() ) { 
      while ($getPosts->have_posts()) {
    		$getPosts->the_post();
    		$posts[] = array(    			
    			'title' => get_the_title(),
    			'investor_date' => get_field('investor_date'),
					'updf_link' => get_field('upload_pdf'),
					'uaudio_link' => get_field('upload_audio'), 
    		);
  	 	}    
   } 
	$result = [
        'status' => 'success',
        'response_type' => 'get posts',
        'msg' => 'products found',
        'post_count' => $post_count,
        'data' => $posts,
        'counter' => $counterField
    ];
    wp_send_json($result);
    wp_die();
}

//  Complains Issue

add_action('wp_ajax_nopriv_Compliance_filter_action', 'getDebtIssuePostCompliance');
add_action('wp_ajax_Compliance_filter_action', 'getDebtIssuePostCompliance');

function getDebtIssuePostCompliance() {
	$data = $_POST;
	$termId = absint($data['term_id']);	
	$yearField = (!empty($data['select_year_box'])) ? sanitize_text_field($data['select_year_box']) : "";
	$docField = (!empty($data['debtDoc'])) ? sanitize_text_field($data['debtDoc']) : "";
	$counterField = (!empty($data['counter'])) ? absint($data['counter']) : "";
	$args = array(
        'post_type' => 'cb_compliancereport',
        'posts_per_page' => -1,
        'post_status' => 'publish',        
    );

		if($yearField != "" || $docField != "") {
			$args['meta_query'] = array(
					'relation' => 'AND',
			);

			if($yearField != "") {
				$args['meta_query'][] = array(
						'key' => 'financial_year',
            'value' => $yearField,
            'compare' => '='
				);
			}

			
		}

   
	// print_r($args);
	// exit;    

    $getPosts = new WP_Query($args);

    $post_count = $getPosts->post_count;
    if($post_count == 0) {
        $result = [
        'status' => 'error',
        'response_type' => 'get posts',
        'msg' => __( 'No Result found' ),
        'post_count' => $post_count,
        'data' => null,
        'counter' => $counterField
        ];
        wp_send_json($result);
        wp_die();    
    }
  $posts = [];
  if ( $getPosts->have_posts() ) { 
      while ($getPosts->have_posts()) {
    		$getPosts->the_post();
    		$posts[] = array(
    			'title' => get_the_title(),
					'updf_link' => get_field('upload_pdf'),
					'uaudio_link' => get_field('upload_audio'), 
    		);
  	 	}    
   } 
	$result = [
        'status' => 'success',
        'response_type' => 'get posts',
        'msg' => 'products found',
        'post_count' => $post_count,
        'data' => $posts,
        'counter' => $counterField
    ];
    wp_send_json($result);
    wp_die();
}

//  Stock Exchange

// test

add_action('wp_ajax_filterData','getFilteData');
add_action('wp_ajax_nopriv_filterData','getFilteData');
function getFilteData(){

	
}

//test

add_action('wp_ajax_nopriv_StockExch_filter_action', 'getDebtIssuePostStockExch');
add_action('wp_ajax_StockExch_filter_action', 'getDebtIssuePostStockExch');

function getDebtIssuePostStockExch() {
	$data = $_POST;
	$termId = absint($data['term_id']);	
	$yearField = (!empty($data['select_year_box'])) ? sanitize_text_field($data['select_year_box']) : "";
	$docField = (!empty($data['debtDoc'])) ? sanitize_text_field($data['debtDoc']) : "";	
	$counterField = (!empty($data['counter'])) ? absint($data['counter']) : "";
	$args = array(
        'post_type' => 'cb_stockexchfilings',
        'posts_per_page' => -1,
        'post_status' => 'publish',                
    );
		if($yearField != "" || $docField != "") {
			$args['meta_query'] = array(
					'relation' => 'AND',
			);

			if($yearField != "") {
				$args['meta_query'][] = array(
						'key' => 'financial_year',
            'value' => $yearField,
            'compare' => '='
				);
			}
			if($docField != "") {
				$args['meta_query'][] = array(
						'key' => 'other_regulatory_filings',
            'value' => $docField,
            'compare' => '='
				);
			}

			
		}

   
	// print_r($args);
	// exit;    

    $getPosts = new WP_Query($args);

    $post_count = $getPosts->post_count;
    if($post_count == 0) {
        $result = [
        'status' => 'error',
        'response_type' => 'get posts',
        'msg' => __( 'No Result found' ),
        'post_count' => $post_count,
        'data' => null,
        'counter' => $counterField
        ];
        wp_send_json($result);
        wp_die();    
    }
  $posts = [];
  if ( $getPosts->have_posts() ) { 
      while ($getPosts->have_posts()) {
    		$getPosts->the_post();
    		$posts[] = array(
    			'title' => get_the_title(),
    			'investor_date' => get_field('investor_date'),
					'updf_link' => get_field('upload_pdf'),
					'uaudio_link' => get_field('upload_audio'), 
    		);
  	 	}    
   } 
	$result = [
        'status' => 'success',
        'response_type' => 'get posts',
        'msg' => 'products found',
        'post_count' => $post_count,
        'data' => $posts,
        'counter' => $counterField
    ];
    wp_send_json($result);
    wp_die();
}
// functions.php
function filter_projects() {
  $catSlug = $_POST['category'];
  $ajaxposts = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => -1,
    'category_name' => $catSlug,
//  'orderby' => 'menu_order',
    'order' => 'desc',
  ]);
  $response = '';

  if($ajaxposts->have_posts()) {
    while($ajaxposts->have_posts()) : $ajaxposts->the_post();
      $response .= the_title();
    endwhile;
  } else {
    $response = 'empty';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_filter_projects', 'filter_projects');
add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');

// form validation

// form validation
add_filter( 'wpcf7_validate_text', 'custom_name_validation_filter', 20, 2 );
add_filter( 'wpcf7_validate_text*', 'custom_name_validation_filter', 20, 2 );
function custom_name_validation_filter( $result, $tag ) {    
 
  if ( "your-name" == $tag->name ) {
    $name = isset( $_POST[$tag->name] ) ? $_POST[$tag->name]  : '';
 
    if ( $name != "" && !preg_match("/^[a-zA-Z ]*$/",$name) ) {
       $result->invalidate( $tag, "Only character allowed." );
    }
  }  
   if ( "your-email" == $tag->name ) {
    $name = isset( $_POST[$tag->name] ) ? $_POST[$tag->name]  : '';
    $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
 
    if ( $name != "" && !preg_match($pattern,$name) ) {
       $result->invalidate( $tag, "Please enter valid email address." );
    }
  }
  if ( "your-mobile" == $tag->name ) {
    $name = isset( $_POST[$tag->name] ) ? $_POST[$tag->name]  : '';
 
    if ( $name != "" && !preg_match("/^[6-9][0-9]{9}$/",$name) ) {
       $result->invalidate( $tag, "Please enter valid Number." );
    }
  }
  return $result;
}

// form code for download variants
add_filter( 'wpcf7_form_elements', 'mycustom_wpcf7_form_elements' );

function mycustom_wpcf7_form_elements( $form ) {
$form = do_shortcode( $form );

return $form;
}

// remove -- from contact form 7 select box
function my_wpcf7_form_elements($html) {
    $text = 'Select Product';
    $html = str_replace('<option value="">---</option>', '<option value="">'.$text.'</option>', $html);
    return $html;
}
add_filter('wpcf7_form_elements', 'my_wpcf7_form_elements');



// Search filter start
add_action('wp_ajax_nopriv_search_action', 'searchdata_fetch');
add_action('wp_ajax_search_action', 'searchdata_fetch');
function searchdata_fetch(){    
   $search = (!empty($_POST['search_text']) )? sanitize_text_field($_POST['search_text']) : '';     
   $type_all = (!empty($_POST['type_all']) )? sanitize_text_field($_POST['type_all']) : ''; 
   $type_post = (!empty($_POST['type_post']) )? sanitize_text_field($_POST['type_post']) : ''; 
   $type_page = (!empty($_POST['type_pages']) )? sanitize_text_field($_POST['type_pages']) : '';            
   $no_post1 = (!empty($_POST['number']) )? sanitize_text_field($_POST['number']) : '';   
   $no_post = (int)$no_post;    
    if( ( !empty($search) ) && ( !empty($type_all) ) || (!empty($type_page) && ( !empty($type_post) ) ) ){                  
        $args = array(
            'post_type' => array('cb_product','page'),
            'posts_per_page' => $no_post,
            'order' => 'DESC',
            's' => $search,           
        );
        $getPosts = new WP_Query($args);        
    }else if( ( !empty($search) ) && ( !empty($type_page) ) || ( !empty($type_post) ) ){
        $type_page = (!empty($type_page) )? $type_page: ''; 
        $post_types = (!empty($type_post) )? $type_post: '';                                             
        $args = array(
            'post_type' => array($type_page,$post_types ),
            'posts_per_page' => $no_post,
            'order' => 'DESC',
            's' => $search,           
        );
        $getPosts = new WP_Query($args);       
    }else{
        $result = [
        'status' => 'error',        
        'msg' => ( 'No Data found!! ' ),        
        ];
        wp_send_json($result);
        wp_die(); 
    }
   
    $post_count = $getPosts->post_count;
    if($post_count == 0) {
        $result = [
        'status' => 'error',        
        'msg' => ( 'No Result found' ),        
        ];
        wp_send_json($result);
        wp_die();    
    }
    $posts = [];
     if ( $getPosts->have_posts() ) { 
          while ($getPosts->have_posts()) {
            $getPosts->the_post();                       
            $posts[] = array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'contents' => get_the_excerpt(), 
                'thumbnail' => get_the_post_thumbnail_url(), 
                'publishdate' => get_the_date(),
                'post_count' => $post_count,
            );
        }
    }
    $result = [
        'status' => 'success',
        'response_type' => 'get posts',
        'msg' => 'results',        
        'data' => $posts,              
    ];
    wp_send_json($result);
    wp_die();    
}

// search title
add_action('wp_ajax_nopriv_title_search_action','lkGetTheSearchTitle');
add_action('wp_ajax_title_search_action','lkGetTheSearchTitle');

function lkGetTheSearchTitle(){
    $searchtitle = (!empty($_POST['searchtitle']) )? sanitize_text_field($_POST['searchtitle']) : '';      
    if(!empty($searchtitle) ){     
       global $wpdb;
       $myposts = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type IN('page','cb_product') AND post_title LIKE '%s'", '%'. $wpdb->esc_like($searchtitle).'%') );
       $posts = [];
       if(count($myposts) >= 1 ){
            foreach ($myposts as $key => $value) {
            $posts[] = array(
                'posts_title' => $value->post_title,
            );        
           }                  
            $result = [
                'status' => 'success',
                'response_type' => 'get posts',
                'msg' => 'results',        
                'data' => $posts,              
            ];

       }else{
            $result = [
                'status' => 'error',        
                'msg' => ( '' ),             
            ];
       }       
    }          
    wp_send_json($result);
    wp_die();
}

// Search filter end

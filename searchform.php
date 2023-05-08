<?php include('search_autoTitle.php'); ?>
<?php
/**
 * Search Form for Astra theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 3.3.0
 */

/**
 * Adding argument checks to avoid rendering search-form markup from other places & to easily use get_search_form() function.
 *
 * @see https://themes.trac.wordpress.org/ticket/101061
 * @since 3.6.1
 */
// $astra_search_input_placeholder = isset( $args['input_placeholder'] ) ? $args['input_placeholder'] : astra_default_strings( 'string-search-input-placeholder', false );
// $astra_search_show_input_submit = isset( $args['show_input_submit'] ) ? $args['show_input_submit'] : true;
// $astra_search_data_attrs        = isset( $args['data_attributes'] ) ? $args['data_attributes'] : '';
// $astra_search_input_value       = isset( $args['input_value'] ) ? $args['input_value'] : '';
?>
<form role="search" method="get" class="search-form" id='searchformhomelk' action="<?php echo esc_url( home_url() ); ?>">	    
		<!-- <span class="screen-reader-text"></span> -->
        <div class="frm-dic">
		  <input onkeyup="searchFilterTitle(this.value);" id='searchtitle' type="text" class="search-field"  placeholder="Search..." value="" name="s" tabindex="-1">
            <button class="submit-btn" > Search </button>
        </div>
		<ul class="searchfilter_ul"></ul>        
</form>


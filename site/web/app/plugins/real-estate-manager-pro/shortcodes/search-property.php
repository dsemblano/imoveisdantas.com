 <?php
	// geting data from rem class
	global $rem_ob;

	$default_fields = $rem_ob->single_property_fields();
	if (is_array($fields_to_show)) {
		$fields_arr =  $fields_to_show;
	} else {
		$fields_arr =  explode(',', $fields_to_show );
	}
	$offset = rem_get_option('properties_per_page', -1);
	$property_individual_cbs = $rem_ob->get_all_property_features();
	$masonry = ($masonry == 'enable') ? 'masonry-enabled' : '' ;
?>
<div class="ich-settings-main-wrap" data-autoscroll="<?php echo $scroll_results; ?>">
<section id="rem-search-box" class="no-margin search-property-page <?php echo $masonry; ?>">
	<form data-resselector="<?php echo $results_selector; ?>" class="<?php echo ($results_page != '') ? '' : 'search-property-form' ; ?>" action="<?php echo $results_page; ?>" method="get" id="search-property" data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-offset="<?php echo $offset; ?>">
		<?php
			if ($fixed_fields != '') {
				$fixed_va_arr = explode(",", $fixed_fields);
				foreach ($fixed_va_arr as $fixed_va) {
					$fixed_data = explode("|", $fixed_va);
					if (strpos($fixed_data[1], "*") !== false) {
						$multi_values_fixed_data = explode("*", $fixed_data[1]);
						
						if (!empty($multi_values_fixed_data)) {							
							foreach ($multi_values_fixed_data as $value) {
								
								echo '<input type="hidden" name="'.$fixed_data[0].'[]" value="'.$value.'">';
							}
						}
					}else{
						
						echo '<input type="hidden" name="'.$fixed_data[0].'" value="'.$fixed_data[1].'">';
					}
				}
			}
			if ($agent_id != '') {
				echo '<input type="hidden" name="agent_id" value="'.$agent_id.'">';
			}
			if ($order != '') {
				echo '<input type="hidden" name="order" value="'.$order.'">';
			}
			if ($orderby != '') {
				echo '<input type="hidden" name="orderby" value="'.$orderby.'">';
			}
			$wpml_current_language = apply_filters( 'wpml_current_language', NULL );
			if ($wpml_current_language) {
				echo '<input type="hidden" name="lang" value="'.$wpml_current_language.'">';
			}
		?>
		<input type="hidden" name="action" value="rem_search_property">
		<?php
			$in_theme = get_stylesheet_directory().'/rem/shortcodes/search-forms/style'.$style.'.php';
			if (file_exists($in_theme)) {
				include $in_theme;
			} else {
				include REM_PATH. '/shortcodes/search-forms/style'.$style.'.php';
			}
		?>
	</form>
</section>

<section id="grid-content" class="search-results">
	<div class="loader text-center margin-bottom" style="display:none;margin-top:20px;">
		<img src="<?php echo REM_URL.'/assets/images/ajax-loader.gif'; ?>" alt="<?php _e( 'Loading...', 'real-estate-manager' ); ?>">
	</div>
	<div class="searched-properties">
		<?php echo apply_filters( 'the_content', $content ); ?>
	</div>
	<?php do_action( 'rem_after_searched_properties' ); ?>
</section>
</div>
<?php
class Divi_REM_Search_Property extends ET_Builder_Module
{
	
	function init() {
	    $this -> name = __('Search Property Form', 'real-estate-manager');
	    $this -> slug = 'et_pb_rem_search_property';
	}

	function get_fields() {
		return rem_vc_into_divi_settings('rem_search_property');
	}
	
	public function render( $unprocessed_props, $content = null, $render_slug ) {
		$all_search_fields = get_search_fields_for_page_builders();
		$selected_fields =  isset($unprocessed_props['fields_to_show']) ? explode('|', $unprocessed_props['fields_to_show']) : array();
		$new_fields = !empty($selected_fields) ? array_combine($all_search_fields, $selected_fields) : $all_search_fields;
		$values_string = '';
		foreach ($new_fields as $key => $value) {
			if ($value == 'on') {
				$values_string .= $key.',';
			}
		}
		$values_string = rtrim($values_string,',');
		$unprocessed_props['fields_to_show'] = $values_string;
		global $rem_sc_ob;
		return $rem_sc_ob->search_property($unprocessed_props, $content);
	}	
}

new Divi_REM_Search_Property;
?>
<?php
class Divi_REM_Logout_Button extends ET_Builder_Module
{
	
	function init() {
	    $this -> name = __('Logout Button', 'real-estate-manager');
	    $this -> slug = 'et_pb_rem_agent_logout';
	}

	function get_fields() {
		return rem_vc_into_divi_settings('rem_agent_logout');
	}
	
	public function render( $unprocessed_props, $content = null, $render_slug ) {
		global $rem_sc_ob;
		return $rem_sc_ob->logout_button($unprocessed_props, $content);
	}	
}
new Divi_REM_Logout_Button;
?>
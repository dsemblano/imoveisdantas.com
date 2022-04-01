<?php
class Elementor_REM_Agent_Profile_Widget extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'rem_agent_profile';
	}

	public function get_title() {
		return __( 'Agent Profile', 'real-estate-manager' );
	}

	public function get_categories() {
		return [ 'real-estate-manager' ];
	}

	public function get_style_depends() {
		return [ 'rem-archive-property-css' ];
	}

	protected function _register_controls() {
		rem_vc_into_elementor_settings($this, 'rem_agent_profile');
	}

	public function render() {
		global $rem_sc_ob;
		$settings = $this->get_settings_for_display();
		$fields = rem_page_builder_fields('rem_agent_profile');
		$attrs = array();
		foreach ($fields as $field) {
			if (isset($settings[$field['param_name']]) && $settings[$field['param_name']] != '') {
				$attrs[$field['param_name']] = $settings[$field['param_name']];
			}
		}
		echo $rem_sc_ob->display_agent($attrs);
	}	
}
?>
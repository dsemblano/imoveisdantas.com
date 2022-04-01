<?php
class Elementor_REM_Attachments_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rem_attachments';
	}

	public function get_title() {
		return __( 'Property Attachments', 'real-estate-manager' );
	}

	public function get_keywords() {
		return [ 'rem', 'files', 'floorplans' ];
	}

	public function get_icon() {
		return 'fa fa-paperclip';
	}
	
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Settings', 'real-estate-manager' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Font', 'real-estate-manager' ),
				'scheme' => 1,
				'selector' => '{{WRAPPER}} .rem-attachment-title',
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'real-estate-manager' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'12' => __( '1', 'real-estate-manager' ),
					'6' => __( '2', 'real-estate-manager' ),
					'4' => __( '3', 'real-estate-manager' ),
					'3' => __( '4', 'real-estate-manager' ),
					'5th-1' => __( '5', 'real-estate-manager' ),
					'2' => __( '6', 'real-estate-manager' ),
				],
			]
		);

		$this->end_controls_section();

	}
	public function get_categories() {
		return [ 'single-property-page' ];
	}

	protected function render() {
		$value = get_post_meta(get_the_id(), 'rem_file_attachments', true);
		$max_length = apply_filters( 'rem_attachments_title_length', '16', get_the_id() );

		$settings = $this->get_settings_for_display();
		echo '<div class="ich-settings-main-wrap"><div class="row">';
		if (!empty($value)) {
			
	        if ($value != '' && !is_array($value)) {
	            $attachments = explode("\n", $value);
	        }
	        if (is_array($value)) {
	            $attachments = $value;
	        }
	        foreach ($attachments as $a_id) {
	            if ($a_id != '') {
	                $a_id = intval($a_id);
	                $filename_only = basename( get_attached_file( $a_id ) );
	                $fullsize_path = get_attached_file( $a_id );
	                $attachment_title = get_the_title($a_id);
	                $display_title = ($attachment_title != '') ? $attachment_title : $filename_only ;                        
	                $file_url = wp_get_attachment_url( $a_id );
	                $file_type = wp_check_filetype_and_ext($fullsize_path, $filename_only);
	                $extension = ($file_type['ext']) ? $file_type['ext'] : 'file' ;
	                
	                	echo '<div class="rem-attachment-icon col-md-'.$settings['columns'].'">';
		                    echo '<span class="file-type-icon pull-left '.$extension.'" filetype="'.$extension.'">';
		                        echo '<span class="fileCorner"></span>';
		                    echo '</span>';
		                    echo '<a class="rem-attachment-title" target="_blank" href="'.$file_url.'">'.substr($display_title, 0, $max_length).'</a>';
	                	echo '</div>';
	            }
	        }

		}  else {
        	echo '<div class="alert alert-info">'.__( 'No attachments found for the property', 'real-estate-manager' ).' <b>'.get_the_title().'</b></div>';
        }
        echo '</div></div>'; 
	}
}
?>
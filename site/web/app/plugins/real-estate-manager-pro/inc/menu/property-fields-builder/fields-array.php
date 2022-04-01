<?php
    $sectionTabs = rem_get_single_property_settings_tabs();
    foreach ($sectionTabs as $tabData) {
        if (isset($tabData['key']) && isset($tabData['title'])) {
            $tabOptions[$tabData['key']] = $tabData['title'];
        }   
    }
	$fields = array(
        array(
            'type' => 'text',
            'name' => 'title',
            'title' => __( 'Label', 'real-estate-manager' ),
        ),
        array(
            'type' => 'text',
            'name' => 'key',
            'title' => __( 'Data Name (lowercase without spaces)', 'real-estate-manager' ),
        ),
        array(
            'type' => 'hidden',
            'name' => 'editable',
        ),
        array(
            'type' => 'textarea',
            'name' => 'options',
            'title' => __( 'Options (each per line)', 'real-estate-manager' ),
            'show_if' => array('select', 'select2'),
        ),
        array(
            'type' => 'text',
            'name' => 'default',
            'title' => __( 'Default Value', 'real-estate-manager' ),
        ),
        array(
            'type' => 'textarea',
            'name' => 'help',
            'title' => __( 'Help Text', 'real-estate-manager' ),
        ),
        array(
            'type' => 'select',
            'name' => 'tab',
            'options' => $tabOptions,
            'title' => __( 'Section or Tab', 'real-estate-manager' ),
        ),
        array(
            'type' => 'select',
            'name' => 'accessibility',
            'options' => array(
            	'public' => __( 'Public', 'real-estate-manager' ),
            	'agent' => __( 'Agent', 'real-estate-manager' ),
            	'admin' => __( 'Admin', 'real-estate-manager' ),
            	'disable' => __( 'Disable', 'real-estate-manager' ),
            ),
            'title' => __( 'Accessibility', 'real-estate-manager' ),
        ),
        array(
            'type' => 'checkbox',
            'name' => 'required',
            'title' => __( 'Required', 'real-estate-manager' ),
        ),
        array(
            'type' => 'number',
            'name' => 'max_files',
            'title' => __( 'Maximum Number of Attachments', 'real-estate-manager' ),
            'show_if' => array('upload'),
        ),
        array(
            'type' => 'text',
            'name' => 'max_files_msg',
            'title' => __( 'Maximum Numbers Reached Message', 'real-estate-manager' ),
            'show_if' => array('upload'),
        ),
        array(
            'type' => 'text',
            'name' => 'file_type',
            'title' => __( 'File Types (Comma Separated)', 'real-estate-manager' ),
            'show_if' => array('upload'),
        ),
        array(
            'type' => 'checkbox',
            'name' => 'range_slider',
            'title' => __( 'Display as range slider on search form', 'real-estate-manager' ),
            'show_if' => array('number'),
        ),
        array(
            'type' => 'checkbox',
            'name' => 'any_value_on_slider',
            'title' => __( 'Make range slider checkbox checked by default', 'real-estate-manager' ),
            'show_if' => array('number'),
        ),
        array(
            'type' => 'number',
            'name' => 'max_value',
            'title' => __( 'Maximum Value', 'real-estate-manager' ),
            'show_if' => array('number'),
        ),
        array(
            'type' => 'number',
            'name' => 'min_value',
            'title' => __( 'Minimum Value', 'real-estate-manager' ),
            'show_if' => array('number'),
        ),
	);
?>
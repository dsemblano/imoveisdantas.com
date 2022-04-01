<?php 
	$field_sections = rem_get_single_property_settings_tabs();

	$accessibilities = array(
		'public'		=> __('Public', 'real-estate-manager' ),
		'agent'			=> __('Agent', 'real-estate-manager' ),
		'registered'	=> __('Registered Users', 'real-estate-manager' ),
		'admin'			=> __('Administrator', 'real-estate-manager' ),
		'disable'		=> __('Disable', 'real-estate-manager' ),
	);
?>
<div class="wrap ich-settings-main-wrap">
	<h2><?php _e( 'Property Field Sections', 'real-estate-manager' ); ?></h2>

    	<div class="row">
    	<div class="col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
	                <h3 class="panel-title"><?php _e( 'Create Section', 'real-estate-manager' ); ?></h3>
                </div>
                <div class="panel-body">
                	<p class="text-center"><?php esc_attr_e( 'Here you can create, delete or sort the sections for the property fields.', 'real-estate-manager' ); ?></p>
                	<p class="text-center">
                		<button class="button btn-success rem-create-field-section"><?php _e( 'Create New', 'real-estate-manager' ); ?></button>
                	</p>
                </div>
            </div>    		
    	</div>
        <div class="col-sm-9">
            <div class="panel panel-primary">
                <div class="panel-heading">
	                <h3 class="panel-title">
	                	<?php _e( 'Property Field Sections', 'real-estate-manager' ); ?>
	                </h3>
                </div>
                <div class="panel-body" id="field-sections-panel">
		                <?php foreach ($field_sections as $index => $tab) { ?>
						<div class="panel panel-default">
						    <div class="panel-heading">
						        <b><?php echo $tab['title']; ?>  - </b>  <span class="key"> <?php echo $tab['key']; ?> </span>
						        <span class="pull-right btn btn-xs btn-default trigger-sort">
						            <span class="glyphicon glyphicon-move"></span>
						        </span>
						        <a href="#" class="btn btn-xs btn-default pull-right trigger-toggle">
						            <span class="glyphicon glyphicon-menu-down"></span>
						        </a>
						        <a href="#" class="pull-right btn btn-xs btn-danger remove-field">
						            <span class="glyphicon glyphicon-remove-sign"></span>
						        </a>
						    </div>
						    <div class="panel-body inside-contents form-horizontal">
						        <div class="form-group">
								    <label class="col-sm-4 control-label"><?php _e( 'Section Title', 'real-estate-manager' ); ?></label>
								    <div class="col-sm-8">
								        <input type="text" class="form-control input-sm section_title" value="<?php echo $tab['title']; ?>">
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-4 control-label"><?php _e( 'Data Name (lowercase without spaces)', 'real-estate-manager' ); ?></label>
								    <div class="col-sm-8">
								        <input type="text" class="form-control input-sm section_key" value="<?php echo $tab['key']; ?>">
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-4 control-label"><?php _e( 'Icon Class or Image URL', 'real-estate-manager' ); ?></label>
								    <div class="col-sm-8">
								        <input type="text" class="form-control input-sm section_icon" value="<?php echo $tab['icon']; ?>">
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-4 control-label"><?php _e( 'Accessibility', 'real-estate-manager' ); ?></label>
								    <div class="col-sm-8">
								        <select class="form-control input-sm section_accessibility">
								        	<?php foreach ($accessibilities as $key => $value) { ?>
												<option value="<?php echo $key; ?>" <?php echo selected( $tab['icon'], $key, 'selected' ); ?>><?php echo $value;  ?></option>
								        	<?php } ?>
										</select>
								    </div>
								</div>
						    </div>
						</div>
		                <?php } ?>
                </div>
            </div>
			
        </div>
        <div class="col-sm-12">
        	<button class="button btn-success pull-right rem-save-field-section"><?php _e( 'Save Sections', 'real-estate-manager' ); ?></button>
        </div>
    </div>
</div>
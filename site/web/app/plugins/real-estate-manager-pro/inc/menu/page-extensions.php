<?php
$plugins_data = array(
	array(
		'title' => 'XML, CSV Importer',
		'desc' => 'Import property data from XML or CSV file using this addon and WP All Import, easily and free',
		'class_name' => 'RapidAddon',
		'button_url' => 'https://webcodingplace.com/xml-csv-importer-real-estate-manager/',
		'plugin_type' => 'free',
		'docs' => 'https://kb.webcodingplace.com/real-estate-manager/importer-for-wp-all-import-xml-csv/',
	),
	array(
		'title' => 'Conditional Fields',
		'desc' => 'Make property meta fields dependable in search form and when creating/editing properties.',
		'class_name' => 'REM_CONDITIONAL_FIELDS',
		'button_url' => 'https://webcodingplace.com/conditional-fields-real-estate-manager-extension/',
		'plugin_type' => 'pro',
		'docs' => 'https://kb.webcodingplace.com/real-estate-manager/conditional-fields-addon/',
	),
	array(
		'title' => 'Saved Searches and Notify',
		'desc' => 'Lets your visitors save the search criteria and then notify them when a listing is available matching that criteria.',
		'class_name' => 'REM_SSE',
		'button_url' => 'https://webcodingplace.com/saved-searches-and-notify-real-estate-manager-extension/',
		'plugin_type' => 'pro',
		'docs' => 'https://kb.webcodingplace.com/real-estate-manager/saved-searches-and-notify/',
	),
	array(
		'title' => 'Add to Wishlist',
		'desc' => 'Lets the users add properties into wishlist and access them on a separate page using shortcode. Bulk contact is also available.',
		'class_name' => 'REM_WISHLIST',
		'button_url' => 'https://webcodingplace.com/add-to-wish-list-real-estate-manager/',
		'plugin_type' => 'free',
		'docs' => 'https://kb.webcodingplace.com/real-estate-manager/wish-list-addon/',
	),
	array(
		'title' => 'Export Import',
		'desc' => 'It lets you export Settings, Fields, and Properties from one site in a JSON file, and then allows you to import them into another site.',
		'class_name' => 'REM_Export_Import',
		'button_url' => 'https://webcodingplace.com/export-import-real-estate-manager/',
		'plugin_type' => 'free',
		'docs' => 'https://kb.webcodingplace.com/real-estate-manager/export-and-import/',
	),
	array(
		'title' => 'Property Listing Styles',
		'desc' => 'Add 20+ more property listing styles to your site by just installing this addon. All styles are fully responsive and supported with all major browsers.',
		'class_name' => 'REM_Property_Styles',
		'button_url' => 'https://webcodingplace.com/property-listing-styles-real-estate-manager-extension/',
		'plugin_type' => 'pro',
		'docs' => 'https://kb.webcodingplace.com/real-estate-manager/property-listing-styles/',
	),
	array(
		'title' => 'Social Share Properties',
		'desc' => 'Share properties socially. More than 15 social networks are integrated including Facebook, Twitter, Google+, Tumblr, E-Mail, Pinterest, LinkedIn, Reddit, XING, WhatsApp, Hacker News, VK and Telegram.',
		'class_name' => 'REM_Social_Share',
		'button_url' => 'https://webcodingplace.com/social-share-real-estate-manager-extension/',
		'plugin_type' => 'pro',
		'docs' => 'https://kb.webcodingplace.com/real-estate-manager/social-share-properties/',
	),
	array(
		'title' => 'Google Map Filters',
		'desc' => 'Display properties on map and let the users search them on map directly. You can also display results in map and page at the same time.',
		'class_name' => 'REM_Map_Filters',
		'button_url' => 'https://webcodingplace.com/google-map-filters-real-estate-manager/',
		'plugin_type' => 'free',
		'docs' => 'https://kb.webcodingplace.com/real-estate-manager/google-map-filters/',
	),
	array(
		'title' => 'Filterable Properties Grid',
		'desc' => 'Create animated grid of properties with filter menu. You can filter properties by Type, Purpose, Status or any custom field. You can provide custom button colors for active and hover state.',
		'class_name' => 'REM_Filterable_Grid',
		'button_url' => 'https://webcodingplace.com/filterable-properties-grid-real-estate-manager-extension/',
		'plugin_type' => 'pro',
		'docs' => 'https://kb.webcodingplace.com/real-estate-manager/filterable-properties-grid/',
	),
	array(
		'title' => 'Woo Estato',
		'desc' => 'A WooCommerce Addon to manage monthly/annually paid subscriptions based on number of properties for agents.',
		'class_name' => 'REM_WOO_ESTATO',
		'button_url' => 'https://webcodingplace.com/woo-estato-real-estate-manager/',
		'plugin_type' => 'free',
		'docs' => 'https://kb.webcodingplace.com/real-estate-manager/woo-estato-paid-listings/',
	),
);
?>

<div class="wrap ich-settings-main-wrap">
	<h2>Extend the functionality of Real Estate Manager using these addons</h2>
	<div class="row">
		<div class="col-sm-8">
			<?php foreach ($plugins_data as $key => $plugin_data) { ?>
		        <div class="panel panel-default">
		            <div class="panel-heading">
		                <h3 class="panel-title"><?php echo $plugin_data['title']; ?>
							<?php if (class_exists($plugin_data['class_name'])) { ?>
			                <span class="badge pull-right">
								<span class="glyphicon glyphicon-ok"></span> Installed and Active
			                </span>
							<?php } ?>
		                </h3>
		            </div>
		            <div class="panel-body">
		                <p><?php echo $plugin_data['desc']; ?></p>
		                <hr>
						<?php if(!class_exists($plugin_data['class_name'])) { ?>
							<a href="<?php echo $plugin_data['button_url']; ?>" target="_blank" class="btn btn-success">
								<span class="glyphicon glyphicon-download-alt"></span> <?php echo ($plugin_data['plugin_type'] == 'pro') ? 'Details / Purchase' : 'Download Free' ; ?>
							</a>
						<?php } ?>
						<?php if (isset($plugin_data['docs']) && $plugin_data['docs'] != '') { ?>
							<a href="<?php echo $plugin_data['docs']; ?>" target="_blank" class="btn btn-info">
								<span class="glyphicon glyphicon-question-sign"></span> 
								Documentation
							</a>
						<?php } ?>
		            </div>
		        </div>
			<?php } ?>	
		</div>
		<div class="col-sm-4">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h3 class="panel-title">Mobile App</h3>
	            </div>
	            <div class="panel-body">
	                Manage your listings from your phone.
	                Real Estate Manager's free mobile app allows you to manage all your listings from your phone easily.
	                <hr>
	                <a target="_blank" class="btn btn-info" href="https://play.google.com/store/apps/details?id=com.webcodingplace.rem">
	                	Google Play
	                </a>
	                <a target="_blank" class="btn btn-info" href="https://apps.apple.com/us/app/real-estate-manager-pro/id1530321208">
	                	App Store
	                </a>
	            </div>
	        </div>
		</div>
	</div>
</div>
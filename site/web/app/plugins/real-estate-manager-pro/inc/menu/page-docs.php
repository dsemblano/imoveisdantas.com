<div class="wrap ich-settings-main-wrap">
	<div class="row">
		<div class="col-sm-12">
			<div class="alert alert-info">
				Thank you for your purchase of <b>Real Estate Manager</b>. Our development team is continuously working hard to bring more awesome features and provide everything that is necessary for real estate marketplace in this plugin. We would love to hear your positive feedback <a target="_blank" href="https://codecanyon.net/downloads"><strong>here</strong></a> or if you have any issues beyond the scope of the following helpful links, just open a ticket <a target="_blank" href="https://kb.webcodingplace.com/real-estate-manager/how-to-get-support/"><strong>following this URL</strong></a>.
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Create Essential Pages</h3>
				</div>
				<div class="panel-body">
					<p>
						Click on the following button if you want to create these pages automatically.
					</p>
					<ol>
						<li>All Listings Page</li>
						<li>Search Properties Page</li>
						<li>Create Property Page</li>
						<li>Agent Registration Page</li>
						<li>Agent Login Page</li>
						<li>Edit Profile Page</li>
						<li>Edit Property Page</li>
						<li>My Properties Page</li>
					</ol>
					<?php if(get_option( 'rem_basic_pages_created' )){ ?>
						<div class="alert alert-warning">You have already created these pages. It may add duplicate entries.</div>
					<?php } ?>
					<hr>
					<a href="#" class="btn btn-info rem-create-pages"> <span class="glyphicon glyphicon-refresh"></span> Create Pages</a>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Basic Settings</h3>
				</div>
				<div class="panel-body">
					<p>
						After installation, you can configure some basic settings like defining currency symbol, setting up area unit, changing property slug etc. You can configure these settings <a href="<?php echo admin_url('edit.php?post_type=rem_property&page=rem_settings'); ?>">here</a>.
						<hr>
						<a href="<?php echo admin_url('edit.php?post_type=rem_property&page=rem_settings'); ?>" target="_blank" class="btn btn-info"> <span class="glyphicon glyphicon-dashboard"></span> Basic Settings</a>
					</p>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Documentation</h3>
				</div>
				<div class="panel-body">
					<p>
						You can find the full documentation on the following URL. Please read this before submitting the tickets. 
						<hr>
						<a href="http://kb.webcodingplace.com/real-estate-manager/" target="_blank" class="btn btn-info"> <span class="glyphicon glyphicon-list-alt"></span> View Docs</a>
					</p>
				</div>
			</div>

		</div>
		<div class="col-sm-6">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Using Shortcodes</h3>
				</div>
				<div class="panel-body">
					<p>
						There are several shortcodes included in this plugin to display listings, render forms, login/register agents etc. You can just copy/paste them into your WordPress pages to make them work.
						<hr>
						<a href="https://webcodingplace.com/how-to-use-shortcodes-in-wordpress/" target="_blank" class="btn btn-info"> <span class="glyphicon glyphicon-list-alt"></span> What are Shortcodes?</a>
						<a href="https://kb.webcodingplace.com/real-estate-manager/category/shortcodes/" target="_blank" class="btn btn-info"> <span class="glyphicon glyphicon-list-alt"></span> All Available Shortcodes</a>
					</p>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Single Property Page 404 Error</h3>
				</div>
				<div class="panel-body">
					<p>
						If you are unable to view the single property listing page or it redirects to 404 page, then you need to reset your permalinks.
						Just go to permalink settings and click the save changes button without changing anything.
						<hr>
						<a href="<?php echo admin_url('options-permalink.php'); ?>" target="_blank" class="btn btn-info"> <span class="glyphicon glyphicon-wrench"></span> Permanlik Settings</a>
					</p>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Video Tutorials</h3>
				</div>
				<div class="panel-body">
					<p>
						We're creating short videos covering the different aspects of the plugin. You can find them under this YouTube's playlist.
						<hr>
						<a href="https://www.youtube.com/playlist?list=PLAyqGZN06NDryROa1PRrooHxpjOT1MRJV" target="_blank" class="btn btn-info"> <span class="glyphicon glyphicon-facetime-video"></span> Video Tutorials</a>
					</p>
				</div>
			</div>

		</div>
	</div>
</div>
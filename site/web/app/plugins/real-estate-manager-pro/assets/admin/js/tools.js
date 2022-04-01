jQuery(document).ready(function($) {
	$('.panel-body').on('click', '.rem-create-pages', function(event) {
        event.preventDefault();
        swal({
          title: "Create Basic Pages?",
          text: "If you have already created these pages, it may add duplicate entries.",
          icon: "warning",
          buttons: true,
          dangerMode: false,
        })
        .then((createPages) => {
        	if(createPages){
				swal('Please Wait', 'Creating Pages...', 'info');
				$.post(ajaxurl, {action: 'rem_create_pages_auto'}, function(resp) {
					swal('Done', 'Pages are created!', 'success');
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				});
        	}
        });
	});
});
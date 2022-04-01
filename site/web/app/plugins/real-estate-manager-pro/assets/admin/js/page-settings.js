jQuery(document).ready(function($) {
    $('select').select2();
    $('.wcp-progress').hide();
    var icons = {
        header: "dashicons dashicons-plus",
        activeHeader: "dashicons dashicons-minus"
    }

    // tabs relates
    $("#rem-settings-form .panel-settings").hide().first().show();
    $(".wcp-tabs-menu a:first").addClass("active");
    $(".wcp-tabs-menu a").on('click', function (e) {
        e.preventDefault();
        $(this).addClass("active").siblings().removeClass("active");
        $($(this).attr('href')).show().siblings('.panel-settings').hide();
    });
    var hash = $.trim( window.location.hash );
    if (hash) $('.wcp-tabs-menu a[href$="'+hash+'"]').trigger('click');


	$('#rem-settings-form').submit(function(event) {
		event.preventDefault();
        $('.wcp-progress').show();
        var data = $(this).serialize();

        $.post(ajaxurl, data, function(resp) {
            $('.wcp-progress').hide();
            swal(resp.title, resp.message, resp.status);
		}, 'json');
	});

    $('.rem-register-btn').click(function(event) {
        event.preventDefault();
        swal({
          text: 'Provide your purchase code',
          content: "input",
          button: {
            text: "Validate",
            closeModal: false,
          },
        })
        .then(name => {
          if (!name) throw null;
            $.post(ajaxurl, {code: name, action: 'rem_validate_pcode'}, function(results) {
                // console.log(results);
                  swal(results.title, results.message, results.status);
                  if (results.status == 'success') {
                      setTimeout(function() {
                        window.location.reload();
                      }, 50);
                  }
            }, 'json');
        });
    });

    $('.rem-deregister-btn').click(function(event) {
        event.preventDefault();
        swal({
          title: "Are you sure?",
          text: "Once de-register, you will have to use the purchase code to register again.",
          icon: "warning",
          buttons: true,
          dangerMode: false,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.post(ajaxurl, {action: 'rem_remove_pcode'}, function(results) {
                // console.log(results);
                  swal(results.title, results.message, results.status);
                  if (results.status == 'success') {
                      setTimeout(function() {
                        window.location.reload();
                      }, 50);
                  }
            }, 'json');
          }
        });
    });

    $('.colorpicker').wpColorPicker();

    // Media Uploader
    var ich_cpt_uploader;
     
    jQuery('.ich-settings-main-wrap').on('click', '.upload_image_button', function( event ){
     
        event.preventDefault();

        var this_widget = jQuery(this).closest('.form-group');
     
        // Create the media frame.
        ich_cpt_uploader = wp.media.frames.ich_cpt_uploader = wp.media({
          title: jQuery( this ).data( 'title' ),
          button: {
            text: jQuery( this ).data( 'btntext' ),
          },
          multiple: false  // Set to true to allow multiple files to be selected
        });
     
        // When an image is selected, run a callback.
        ich_cpt_uploader.on( 'select', function() {
          // We set multiple to false so only get one image from the uploader
          attachment = ich_cpt_uploader.state().get('selection').first().toJSON();
            jQuery(this_widget).find('.image-url').val(attachment.url);
        });
     
        // Finally, open the modal
        ich_cpt_uploader.open();
    });

    $('[data-cond-option]').conditionize();
});
(function($) {

    var frame;

    $(document).on('click', '.es-image-uploader .es-image-add', function(e) {

        e.preventDefault();
        var el = $(this);
        if (frame) frame.close();

        frame = wp.media.frames.file_frame = wp.media({
            title: NativeMedia.frame_title,
            button: {
                text: NativeMedia.button_title
            },
            library : { type : 'image' },
            multiple: false
        });

        frame.on('close',function( ) {
            var attachments = frame.state().get('selection').toJSON();
            var img_url;

            if (attachments[0].sizes['thumbnail']) {
                img_url = attachments[0].sizes['thumbnail'].url;
            }
            else{
                img_url = attachments[0].sizes['full'].url;
            }
            var preview_html = '<div class="image_preview"><a href="#" class="remove-image"><i class="fa fa-times-circle" aria-hidden="true"></i></a><img src="' + img_url + '"> </div>';
            var parent = el.parents('.es-image-uploader');
            parent.prepend(preview_html);
            parent.find('.es-image-add').remove();
            parent.find('.es-image-id').val(attachments[0].id);
        });

        frame.open();
        return false;
    });


    $(document).on('click', '.es-image-uploader a.remove-image', function(e) {
        e.preventDefault();

        $(this).parents('.image_preview').animate({ opacity: 0 }, 200, function() {
            $(this).remove();
        });

        $(this).parents('.es-image-uploader').prepend('<a class="es-image-add button" href="#">'+NativeMedia.frame_title+'</a>');
        $(this).closest('.es-image-uploader').find('.es-image-id').val('');
        return false;
    });


})(jQuery);

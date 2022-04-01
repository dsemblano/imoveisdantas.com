jQuery( window ).on( 'elementor/frontend/init', () => {
    const addHandler = ( $element ) => {
        if (jQuery('.fotorama-custom').length) {
            jQuery('.fotorama-custom').on('fotorama:ready fotorama:fullscreenenter fotorama:fullscreenexit', function (e, fotorama) {
                var fotoramaFit = jQuery(this).data('fit');

                if (e.type === 'fotorama:fullscreenenter') {
                    // Options for the fullscreen
                    fotorama.setOptions({
                        fit: 'contain'
                    });
                } else {
                    // Back to normal settings
                    fotorama.setOptions({
                        fit: fotoramaFit
                    });
                }
                
                if (e.type === 'fotorama:ready') {
                    jQuery('#property-content').find('.fotorama-custom').css('visibility', 'visible');
                }        
            }).fotorama();
        }
        
        if (jQuery('.slick-custom').length) {
            jQuery('.slick-custom').slick();
        }

        if (jQuery('.grid-custom').length) {
            var images = jQuery('.grid-custom').children('img').map(function(){
                return jQuery(this).attr('src')
            }).get();
            var grid_options = jQuery('.grid-custom').data('grid');
            grid_options.images = images;
            jQuery('.grid-custom').html('');
            jQuery('.grid-custom').imagesGrid(grid_options);
        }    
    };
    elementorFrontend.hooks.addAction( 'frontend/element_ready/gallery_images.default', addHandler );
});
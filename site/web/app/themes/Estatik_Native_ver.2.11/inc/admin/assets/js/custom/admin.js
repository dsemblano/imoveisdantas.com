(function($) {
    'use strict';


    $(function() {
        var $styledCheckboxes = $('.es-native-switch-input');

        $( window ).trigger( 'resize' );

        if ($styledCheckboxes.length) {
            $styledCheckboxes.esCheckbox({
                labelTrue: Es_Native.tr.yes,
                labelFalse: Es_Native.tr.no
            });
        }

        var $tabs = $('.nav-tab-wrapper');

        if ($tabs.length) {
            $tabs.tabs();
        }

        $('.js-colorpicker').wpColorPicker();

    });
})(jQuery);

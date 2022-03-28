(function($) {
    'use strict';

    // contact form validation.
    var $form = $(".contact-block__send-form");
    $form.validetta({
        bubblePosition: "bottom",
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        realTime : true,
        onValid: function (e) {
            e.preventDefault();
            $.ajax({
                url: Es_Native.ajaxurl,
                method: 'post',
                data: $(this.form).serialize(),
                dataType: 'json',
                beforeSend: function(){
                    $('.response_message').remove();
                    $('.contact-block__send-form').find('.ajax_loader').css('display', 'block');
                },
                success: function(data){

                    if ( typeof grecaptcha !== 'undefined' ) {
                        grecaptcha.reset();
                    }

                    var html = '';
                    var success = false;
                    $.each( data, function( key, value ) {
                        html = html + '<div class="' + value.status + ' response_message"> ' + value.message + ' </div>';
                        if (value.status === 'success') {
                            success = true;
                        }
                    });
                    $('.contact-block__send-form').find('.ajax_loader').css('display', 'none');
                    if (success) {
                        $('.contact-block__send-form')[0].reset();
                        $('.form_response').html(html);
                        $.magnificPopup.open({
                            items: {
                                src: '.message_sent__container',
                                type: 'inline'
                            }
                        });
                    }
                    else {
                        $('.contact-block__send-form').prepend(html);
                    }

                }
            });
        }
    });

    $('.mobile-menu__button').sidr({
       name: 'sidr-left-top',
       timing: 'ease-in-out',
       speed: 500,
       source: '.mobile-menu',
       displace: false
     });

    $( '<i class="fa fa-sort-desc" aria-hidden="true"></i>' ).insertAfter( '.sidr-class-menu-item-has-children > a' );

    $(document).on('click touch', '.sidr-class-menu-item-has-children > .fa, .sidr-class-menu-item-has-children > a[href="#"]', function(e) {
        $(this).closest('li').find('ul').toggle( "slow" );

        return false;
    });

     $(document).on('click touch', '.sidr-class-mobile-menu__button', function(e) {
         $.sidr('close', 'sidr-left-top');
         return false;
     });

     $(document).on('click touch', '.mobile-contact__button', function(e) {
         $('.header__contact-information').toggle('slow');
         return false;
     });


     if ($('.es-main-width-sidebar').children().length === 0) {
         $('.es-main-width-sidebar').remove();
     }

     if ($('.es-wide-sidebar').children().length === 0) {
         $('.es-wide-sidebar').remove();
     }

     if ( $('[data-menu]').length ) {
         $('[data-menu]').menu();
     }

     $( window ).on( 'resize', function() {
         setTimeout( function() {
             if ( $( '.main-menu' ).height() > 60 ) {
                 $( '.main-menu, .navigate-line__login, .user-logged-in' ).css( 'display', 'none' );
                 $( '.navigate-line__wrapper > .mobile-menu__button' ).css( 'display', 'block' );
             } else {
                 $( '.main-menu, .navigate-line__login, .user-logged-in' ).css( 'display', 'flex' );
                 $( '.navigate-line__wrapper > .mobile-menu__button' ).css( 'display', 'none' );
             }
         }, 500 );
     } ).trigger( 'resize' );
})(jQuery);

jQuery(document).ready(function($) {
	// property compare button click
	// 1st check if already in compare box then exit
	// 2nd creating and adding hmtl to compare box
	// 3rd animate the compare box if 2 proerpties selected
	$( 'body' ).on('click', '.rem-compare-btn', function(e) {
		event.preventDefault();
		if (!$(this).hasClass('active')) {
			$(this).addClass('active');
			$(this).find('i').removeClass('fa-plus').addClass('fa-check');
		} else {
			return;
		};
		var p_id = $(this).data('property_id');
		var the_box = $(this).closest('.rem-property-box');
		var html = get_compare_box_html(p_id, the_box);
		$(".property-box").append(html);
		// open side area
		if ($(".prop-compare-wrapper .items_compare").length > 1) {
			$( ".prop-compare-wrapper" ).animate({
			right: "0"
			}, 500 );
			$('.compare_close').show();
		};
	});

	// comapre box open button click
	// 1s open comapre box
	// 2nd hide open button
	// 3rd show close button
	$( 'body' ).on('click', '.compare_open', function() {
	  $( ".prop-compare-wrapper" ).animate({
	    right: "0"
	  }, 500 );
	  $('.compare_open').hide();
	  $('.compare_close').show();
	});

	// compare box close button click
	// 1st close box
	// 2nd open button show
	// 3rd close button show
	$( 'body' ).on('click', '.compare_close', function() {
	  $( ".prop-compare-wrapper" ).animate({
	    right: "-301"
	  }, 500 );
	  $('.compare_open').show();
	  $('.compare_close').hide();
	});
	
	// building html for adding listing information in compare box
	function get_compare_box_html(p_id, the_box){
		var imgurl = the_box.find('.rem-f-image').attr('src');
		var title = the_box.find('.property-title').text();
		var price = the_box.find('.property-price').html();
		var html = '<tr class="items_compare" id="compare-'+p_id+'" data-property_id="'+p_id+'">';
					html += '<td><img src="'+imgurl+'"></td>';
					html += '<td><span class="compare-title">'+title+'</span><span class="compare-price">'+price+'</span></td>';
					html += '<td><button class="remove-from-compare-btn"><i class="fa fa-times" aria-hidden="true"></i></button></td>';
				html += '</tr>';
		return html;
	}

	// property information in compare box will reomve when x button clicked
	// remove active class from property compare button
	// compare box closed if property information form box will removed or box have only one proeprty info
	$('body').on('click', '.remove-from-compare-btn', function(event) {
		event.preventDefault();

		var id = $(this).closest('.items_compare').data('property_id');
		$('a[data-property_id="'+id+'"]').removeClass('active');
		$('a[data-property_id="'+id+'"] i').removeClass('fa-check').addClass('fa-plus');
		$(this).closest('.items_compare').remove();
		if ($(".prop-compare-wrapper .items_compare").length <= 1){
			$( ".prop-compare-wrapper" ).animate({
				right: "-301"
			}, 500 );
			$('.compare_open').hide();
			$('.compare_close').hide();
		}
	});

	// init comapre model
	// geting all selected property ids and send ajax request 
	// geting required data and put on modal body
	$("#rem-compare-modal").iziModal({
 		zindex : 999,
 		padding: 10,
 		// theme : "light",
 		width : '80%',
 		fullscreen : true,
 		// openFullscreen: true,
 		overlayColor: "rgba(0,0,0,0.6)",
 		transitionOut: "bounceInUp",
 		transitionOut: "fadeOutDown",
	    onOpening: function(modal){
	 		var property_ids = [];
	 		$('.items_compare').each( function(index, val) {
	 			 property_ids.push($(this).data('property_id') );
	 		
	 		});
	 		var data = {
	 			'action' : 'rem_compare_properties',
	 			'property_ids' : property_ids
	 		}
	        modal.startLoading();
	        $.post(rem_compare.ajaxurl, data , function(resp) {
	        	
	            $("#rem-compare-modal .iziModal-content tbody").html(resp);
	 			// stop loading
	            modal.stopLoading();
	        });
	    }
	});
});
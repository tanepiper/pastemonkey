/**
 * @description: Base JS file for paste add form
 */

(function($){
	
	$('#instructions').livequery(function(){
		$(this).hide();
	});

	$('.showInstructions').livequery(function(){
		$(this).toggle(function(){
			$('#instructions').animate({height: 'show'});
		}, function(){
			$('#instructions').animate({height: 'hide'});
		});
	});	

	$('#PastePaste').livequery(function(){
		var thisWidth = $(this).parent().width();
		$(this).resizable({ autohide: true, minHeight: 100, minWidth: thisWidth, maxHeight: 900, maxWidth: thisWidth });
		$(this).focus();
	});


	$('#paste-extra-area').livequery(function(){
		$(this).hide();
	});
				
	$('.toggleExtraFields').livequery(function(){
		$(this).toggle(function(){
			$('#paste-extra-area').animate({height: 'show'});
			$(this).text('Hide Additional Fields');
		}, function(){
			$('#paste-extra-area').animate({height: 'hide'});
			$(this).text('Show Additional Fields');
		});
	});
	
	$('#PasteTags').livequery(function(){
			$(this).autocomplete('/tags/find/', {multiple: true, matchContains: true, delay: 1000});
	});
})(jQuery);
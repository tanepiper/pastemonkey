(function($){
$(document).ready(function(){
	$('a', '.paging').livequery(function(){
		$(this).bind('click.paging', function(){
			pmhelpers.load($(this).attr('href'));
			return false;
		});
	}, function(){
		$(this).unbind('click.paging');
	});

	$('.ajaxLink').livequery(function(){
		$(this).bind('click.ajaxLink', function(){
			pmhelpers.load($(this).attr('href'));
			return false;
		});
	}, function(){
		$(this).unbind('click.ajaxLink');
	});

	$('.nav-link').livequery(function(){
		$(this).bind('click.active', function(){
			$(this).parent().siblings('li').children('a').removeClass('active');
			$(this).addClass('active');
		});
	}, function(){
		$(this).unbind('click.active');
	});
	
	$('a.download').livequery(function() {
		$(this).bind('click', function() {
			$('body').append($('<iframe />').attr('src', $(this).attr('href')));
			return false;
		});
	});
});
})(jQuery);
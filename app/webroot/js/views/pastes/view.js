(function($){
	$('.PasteCopy').livequery(function(){
		var self = this;
		$('<a href="#" class="copyText">Copy This Code</a>').insertAfter(self);
		$('.copyText').livequery(function(){
			$(this).bind('click.copyButton', function(){
				$.clipboard($(self).val(), {swfpath: '/js/jquery.clipboard.swf'});
				return false;
			});
		});
	}, function(){
		$(this).unbind('click.copyButton');
	});
})(jQuery);
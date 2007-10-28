(function($){
	$('#PasteSearchTerm').livequery(function(){
		
		// We hide the search button for AJAX users
		$('input[type=submit]', '#PasteSearchForm').hide();
		
		// This search activates on the search box loosing focus.
		$(this).bind('blur', function(){
			$(this).css({backgroundColor: '#fff'});
			var searchTerm = $(this).val();
			if (searchTerm != '' && searchTerm.length >= 3) {
				$('#content').load('/pastes/search/' + searchTerm, function(){
					$('*','ol li').each(function(){
						$.highlight(this, searchTerm.toUpperCase());	
					});
				});
			}
		});
		
		$(this).bind('focus', function(){
			$(this).val('');
		});
		
		$(this).bind('keyup', function(){
			// Check to see the search value is at least 3 figures.
			if ($(this).val().length < 3) {
				$(this).css({backgroundColor: '#EA444A'});
			} else {
				$(this).css({backgroundColor: '#5CFF69'});
			}
		});
	});
})(jQuery);
(function($){
$(document).ready(function(){
	/***
	 * The core message area
	 */

	$('.pm-message').livequery(function(){
		var self = this;
		$(self).fadeIn(1000);
		setTimeout(function() {
			$(self).animate({ top: -100, opacity: 0 }, 2000);
		}, 3000);
	});
	
	/***
	 * Message firing functions
	 */

	$('#PasteAddForm').livequery(function(){
		$(this).ajaxForm({
			beforeSubmit: function() {
				pmhelpers.block();
			},
			target: '#content',
			success: function() {
				pmhelpers.unblock();
				$('.pm-message').hide(0);
				$('html,body').animate({scrollTop: '0'}, 2000);
        	}
		});
	});
		$('#PasteEditForm').livequery(function(){
		$(this).ajaxForm({
			beforeSubmit: function() {
				pmhelpers.block();
			},
			target: '#content',
			success: function() {
				pmhelpers.unblock();
				$('.pm-message').hide(0);
				$('html,body').animate({scrollTop: '0'}, 2000);
        	}
		});
	});
});
})(jQuery);
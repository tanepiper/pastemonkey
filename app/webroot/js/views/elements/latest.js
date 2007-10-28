(function($) {
$(document).ready(function(){
	window.setInterval(function() {
		pmhelpers.load('/pastes/latest', '#ajaxLatest', true);
	}, 10000);
});
})(jQuery);
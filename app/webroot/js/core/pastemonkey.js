(function($) {
	
	$(document).ready(function() {
		var pmhelpers = {
			load: function(u,c,b) {
				b = b || false;
				c = c || '#content';
				self = this;
				if(!b) self.block(c);
				$(c).load(u, function() {
					if (!b) self.unblock(c);
				});
			},
			block: function(c) {
				c = c || '#content';
				$(c).animate({ opacity: 0.4 }, 1000);
				//$(c).block('<img src="/img/ajax-loader.gif" /> Loading', { color: '#000', backgroundColor: '#fff' });
			},
			unblock: function(c) {
				c = c || '#content';
				$(c).animate({ opacity: 0.4 }, 1000);
				//$(c).unblock();
			}
		};

		$.jss.disableCaching = 0;
		$.jss.debugMode = 0;
		$.jss.apply();

		/* AJAX Control */

		$.ajaxSetup({timeout: 10000});	
	});
})(jQuery);
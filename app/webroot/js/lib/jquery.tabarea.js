(function($){

	$.fn.extend({
	
		tabarea : function(options, evt) {
			var options = $.extend({
				tabwidth : "    "
			}, options);
		
			var t = evt.target;
            var ss = t.selectionStart;
            var se = t.selectionEnd;

            // Tab key - insert tab expansion
            if (evt.keyCode == 9) {
                evt.preventDefault();
                
                // Special case of multi line selection
                if (ss != se && t.value.slice(ss,se).indexOf("\n") != -1) {
                    // In case selection was not of entire lines (e.g. selection begins in the middle of a line)
                    // we ought to tab at the beginning as well as at the start of every following line.
                    var pre = t.value.slice(0,ss);
                    var sel = t.value.slice(ss,se).replace(/\n/g,"\n"+options.tabwidth);
                    var post = t.value.slice(se,t.value.length);
                    t.value = pre.concat(options.tabwidth).concat(sel).concat(post);
                    
                    t.selectionStart = ss + options.tabwidth.length;
                    t.selectionEnd = se + options.tabwidth.length;
                }
                
                // "Normal" case (no selection or selection on one line only)
                else {
                    t.value = t.value.slice(0,ss).concat(options.tabwidth).concat(t.value.slice(ss,t.value.length));
                    if (ss == se) {
                        t.selectionStart = t.selectionEnd = ss + options.tabwidth.length;
                    }
                    else {
                        t.selectionStart = ss + options.tabwidth.length;
                        t.selectionEnd = se + options.tabwidth.length;
                    }
                }
            }
            
            // Backspace key - delete preceding tab expansion, if exists
            else if (evt.keyCode==8 && t.value.slice(ss - 4,ss) == options.tabwidth) {
                evt.preventDefault();
                
                t.value = t.value.slice(0,ss - 4).concat(t.value.slice(ss,t.value.length));
                t.selectionStart = t.selectionEnd = ss - options.tabwidth.length;
            }
            
            // Delete key - delete following tab expansion, if exists
            else if (evt.keyCode==46 && t.value.slice(se,se + 4) == options.tabwidth) {
                evt.preventDefault();
                
                t.value = t.value.slice(0,ss).concat(t.value.slice(ss + 4,t.value.length));
                t.selectionStart = t.selectionEnd = ss;
            }
            
            // Left/right arrow keys - move across the tab in one go
            else if (evt.keyCode == 37 && t.value.slice(ss - 4,ss) == options.tabwidth) {
                evt.preventDefault();
                t.selectionStart = t.selectionEnd = ss - 4;
            }
            else if (evt.keyCode == 39 && t.value.slice(ss,ss + 4) == options.tabwidth) {
                evt.preventDefault();
                t.selectionStart = t.selectionEnd = ss + 4;
            }
		
		}
	});

})(jQuery);
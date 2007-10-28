/*

Clipboard - Copy utility for jQuery
Version 1.1
October 7, 2007

Project page:

	http://bradleysepos.com/projects/jquery/clipboard/

Files:

	Source:            jquery.clipboard.js
	Source (packed):   jquery.clipboard.pack.js
	Helper SWF:        jquery.clipboard.swf

Usage:

	Basic usage:
	$.clipboard( "Text to copy" );

	Advanced usage
	$.clipboard( "Text to copy", { swfpath: "path/to/helper.swf", debug: true } );

Compatibility:

	Tested with jQuery 1.2.1


Released under an MIT-style license

LICENSE
------------------------------------------------------------------------

Copyright (c) 2007 Bradley Sepos

Permission is hereby granted, free of charge, to any person obtaining a
copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be included
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

------------------------------------------------------------------------

*/
(function($){
	
$.clipboard = function( text, options ) {
	
	options = $.extend({
		swfpath: "jquery.clipboard.swf",
		debug: false
	}, options);
	var debug = options['debug'];
	var swfpath = options['swfpath'];
	
	// Logging
	var log = function(string){
		if ( typeof console.log == "function" ){
			console.log(string);
		} else {
			alert(string);
		}
	}
	
	// Flash detection
	// Based on swfObject 2.0: http://code.google.com/p/swfobject/
	var flashVersion = [0,0,0];
	var swfdetect = function( minVersion ){
		var d = null;
		if (typeof navigator.plugins != "undefined" && typeof navigator.plugins["Shockwave Flash"] == "object") {
			d = navigator.plugins["Shockwave Flash"].description;
			if (d) {
				// Got Flash, parse version
				d = d.replace(/^.*\s+(\S+\s+\S+$)/, "$1");
				flashVersion[0] = parseInt(d.replace(/^(.*)\..*$/, "$1"), 10);
				flashVersion[1] = parseInt(d.replace(/^.*\.(.*)\s.*$/, "$1"), 10);
				flashVersion[2] = /r/.test(d) ? parseInt(d.replace(/^.*r(.*)$/, "$1"), 10) : 0;
				if (flashVersion[0] > minVersion[0] || (flashVersion[0] == minVersion[0] && flashVersion[1] > minVersion[1]) || (flashVersion[0] == minVersion[0] && flashVersion[1] == minVersion[1] && flashVersion[2] >= minVersion[2])){
					// Version ok
					return true;
				} else {
					// Version too old
					return false;
				};
			}
		}
		// No Flash detected
		return false;
	}
	
	// Check for input
	if ( arguments.length < 1 || typeof text != "string" ){
		// No text to copy
		if ( debug ){ log( "jQuery.clipboard: ERROR. Nothing to copy. You must specify a string as the first parameter." ); }
		return false;
	}
	
	// Copy
	if ( typeof window.clipboardData != "undefined" ){
		// Use Internet Explorer's built-in method
		window.clipboardData.setData( "Text", text );
		if ( debug ){ log( "jQuery.clipboard: OK. Copied "+text.length+" bytes to clipboard using native IE method." ); }
		return true;
		
	} else {
		// Use Flash helper method
		var swfmin = [6,0,21]
		var swfok = swfdetect( swfmin );
		if ( swfok ){
			
			// We cannot detect failure to load the swf at this time, be careful your path is correct
			var swfdiv = $( "jquery_clipboard_helper:first" );
			if ( swfdiv.size() < 1 ) {
				// No existing object to reuse, so let's create it
				swfdiv = $( "<div/>" ).attr( "id", "jquery_clipboard_helper" ).appendTo( "body" );
			}
			
			// Do the magic
			$(swfdiv).html( '<embed src="'+swfpath+'" FlashVars="clipboard='+encodeURIComponent(text)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>' );
			if ( debug ){ log( "jQuery.clipboard: OK. Copied "+text.length+" bytes to clipboard using Flash. Detected Flash version: "+flashVersion[0]+"."+flashVersion[1]+"."+flashVersion[2] ); }
			return true;
			
		} else if ( flashVersion[0] == 0 ){
			// Flash not detected
			if ( debug ){ log( "jQuery.clipboard: ERROR. Flash plugin not detected." ); }
			return false;
			
		} else {
			// Flash version too old
			if ( debug ){ log( "jQuery.clipboard: ERROR. Minimum Flash version: "+swfmin[0]+"."+swfmin[1]+"."+swfmin[2]+" Detected Flash version: "+flashVersion[0]+"."+flashVersion[1]+"."+flashVersion[2] ); }
			return false;
			
		}
	}
}
})(jQuery); /* jQuery.clipboard */
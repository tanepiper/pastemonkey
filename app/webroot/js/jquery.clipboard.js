/*

Clipboard - Copy utility for jQuery
Version 1.0
October 4, 2007

Project page:

	http://bradleysepos.com/projects/jquery/clipboard/

Files:

	jquery.clipboard.js
	jquery.clipboard.swf

Usage:

	If the helper swf is in the same directory as your document:
	$.clipboard( "Text to copy" );

	Add the second parameter to specify the helper swf's path:
	$.clipboard( "Text to copy", "http://domain.tld/path/to/swf/" );

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

jQuery.clipboard = function( text, swfpath ) {
	
	// Validate input
	if ( arguments.length < 1 || typeof text != "string" ){
		// Print error to console. Yay for Firebug.
		if ( typeof console == "function" ){
			console.log( "jQuery.clipboard: You must specify a string as the first parameter." );
		}
		// Fail gracefully, since we cannot catch SWF errors anyway
		return;
	}
	if ( arguments.length < 2 ){
		// Default path is cwd
		var swfpath = "";
	}
	
	// Copy
	if ( typeof window.clipboardData != "undefined" ){
		// Use Internet Explorer's built-in method
		window.clipboardData.setData( "Text", text );
	} else {
		// Everything other than IE, we use a Flash object as a helper
		// We cannot detect failure to load the swf at this time, be careful your path is correct
		var swfdiv = $("jquery_clipboard_helper:first");
		if ( swfdiv.size() < 1 ) {
			// No existing object to reuse, so let's create it
			swfdiv = $( "<div/>" ).attr( "id", "jquery_clipboard_helper" ).appendTo( "body" );
		}
		// Do the magic
		$(swfdiv).html( '<embed src="'+swfpath+'jquery.clipboard.swf" FlashVars="clipboard='+encodeURIComponent(text)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>' );
	}
	
	// All done
	return;
	
}
// JSS - 0.3																				by Andy Kent
// ------------------------------------------------------------

// TODO allow loading of only some stylesheets
// TODO support for rel="jss-stylesheet"
// TODO add basic :hover support
// TODO refactor to be more OO

(function($) {

$.jss = {
	
	loadExternalStyles: true, // set to false to only analyse in document styles and avoid ajax requests. 
	exclude: [ // can be used to set selector patterns that should be ignored.
							/^[^:>\[\]\+\~]+$/, // only bother with complex selectors that include ':', '[', ']' or '>'.
							/\:hover$/i // ignore hover events for now as the functionality is incomplete
						], 
	only: [], // only include selectors that match one these patterns
	debugMode: false, // turn on/off debugging alerts
	
	disableCaching: false, // turn this on to disable caching
	
	cache: {}, // used to cache selectors
	
	apply: function(content) {
		var selectors = [];
		var jss = this;
		$('style,link[type=text/css]').each(function() {
			if(this.href) {
				if(jss.loadExternalStyles) jss.loadStylesFrom(this.href);
			} else {
				selectors = selectors.concat(jss.parse(this.innerHTML));
			}
		});
		if(content) selectors.concat(this.parse(content)); // parse any passed in styles
		selectors = this.filterSelectors(selectors);
		this.applySelectors(selectors);
	},
	
	loadStylesFrom: function(href) {
		var jss = this;
		$.get(href, function(data) {
			var selectors = jss.filterSelectors(jss.parse(data));
			jss.applySelectors(selectors);
		});
	}, 
	
	applySelectors: function(selectors) {
		var jss= this;
		var result = null;
		$.each(selectors, function(){ // load each of the matched selectors
			if(jss.disableCaching) return $(this.selector).css(this.attributes); // cache is turned off so just apply styles
			if(jss.cache[this.selector]){ // check the cache
				jss.debug('HIT',this.selector)
				jss.cache[this.selector].css(this.attributes); // direct cache hit
			} else if( result=jss.scanCache(this.selector) ) {
				jss.debug('PARTIAL',result,result[0].find(result[1]))
				result[0].find(result[1]).css(this.attributes); // partial cache hit
			}	else {
				jss.debug('MISS',this.selector)
				jss.cache[this.selector] = $(this.selector).css(this.attributes); // cache miss
			};
		});
	},
	
	scanCache: function(selector) {
		for(var s in this.cache) {
			if(selector.search(new RegExp('^'+s+'[ >]'))>-1)
				return [ this.cache[s], selector.replace(new RegExp('^'+s+'[ >]'),'') ];
		};
	},
	
	filterSelectors: function(selectors){
		if(!selectors.length) return [];
		var s = selectors;
		this.debug('Before Filtering:',s.length,s);
		if(this.only && this.only.length) { // filter selectors to remove those that don't match the only include rules
			var inclusions = this.only;
			var t=[]; // temp store for matches
			for(var i=0;i<inclusions.length;i++){
				for(var pos=0;pos<s.length;pos++){
					if( typeof inclusions[i]=='string' ? s[pos].selector==inclusions[i] : s[pos].selector.match(inclusions[i]) ) {
						this.debug('Added:',s[pos]);
						t.push(s[pos]);
					};
				};
			};
			s=t;
		};
		if(this.exclude && this.exclude.length){ // filter selectors to remove those that match the exclusion rules
			var exclusions = this.exclude;
			for(var i=0;i<exclusions.length;i++){
				for(var pos=0;pos<s.length;pos++){
					if( typeof exclusions[i]=='string' ? s[pos].selector==exclusions[i] : s[pos].selector.match(exclusions[i]) ) {
						this.debug('Removed:',s[pos]);
						s.splice(pos,1);
						pos--;
					};
				};
			};
		};
		this.debug('After Filtering:',s.length,s);
		return s;
	},
	
	
	
	// ---
	// ultra lightweight CSS parser, only works with 100% valid css files, no support for hacks etc.
	// ---
	
	sanitize: function(content) {
		if(!content) return '';
		var c = content.replace(/[\n\r]/gi,''); // remove newlines
		c = c.replace(/\/\*.+?\*\//gi,''); // remove comments
		return c;
	},
	
	parse: function(content){
		var c = this.sanitize(content);
		var tree = []; // this is the css tree that is built up
		c = c.match(/.+?\{.+?\}/gi); // seperate out selectors
		if(!c) return [];
		for(var i=0;i<c.length;i++) // loop through the selectors & parse the attributes
			if(c[i]) 
				tree.push( { selector: this.parseSelectorName(c[i]),  attributes: this.parseAttributes(c[i]) } );
		return tree;
	},
	
	parseSelectorName: function(content){
		return $.trim(content.match(/^.+?\{/)[0].replace('{','')); // extract the selector
	},
	
	parseAttributes: function(content){
		var attributes = {};
		c = content.match(/\{.+?\}/)[0].replace(/[\{\}]/g,'').split(';').slice(0,-1);
		for(var i=0;i<c.length; i++){
			if(c[i]){
				c[i] = c[i].split(':');
				attributes[$.trim(c[i][0])] = $.trim(c[i][1]);
			}; 
		};
		return attributes;
	},

	debug: function() {
		if(this.debugMode) 
			console==undefined ? alert(arguments[0]) : console.log(arguments);
	}
	
};

})(jQuery);
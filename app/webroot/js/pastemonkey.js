$pastemonkey(document).ready(function() {
	
	/* Basic Bind Functions */
	
	$pastemonkey('.nav-link').bind('click.newPaste', function(){
			$pastemonkey('.#content').load($pastemonkey(this).attr('href'));
			return false;
	});
	
	/* Live Query Functions*/
	
	$pastemonkey('a', '.paging').livequery(function(){
		$pastemonkey(this).bind('click.paging', function(){
			$pastemonkey('#content').load($pastemonkey(this).attr('href'));
			return false;
		});
	}, function(){
		$pastemonkey(this).unbind('click.paging');
	});
	
	$pastemonkey('.viewPaste').livequery(function(){
		$pastemonkey(this).bind('click.viewPaste', function(){
			$pastemonkey('#content').load($pastemonkey(this).attr('href'));
			return false;
		});
	}, function(){
		$pastemonkey(this).unbind('click.viewPaste');
	});
	
	$pastemonkey('.editPaste').livequery(function(){
		$pastemonkey(this).bind('click.editPaste', function(){
			$pastemonkey('#content').load($pastemonkey(this).attr('href'));
			return false;
		});
	}, function(){
		$pastemonkey(this).unbind('click.editPaste');
	});
	
	/* AJAX Start/Stop Functions*/
	
	$pastemonkey('#content').ajaxStart(function(){
		$pastemonkey('.loading').animate({opacity:'show', backgroundColor: '#0f0'}, 'slow', 'linear')
		.animate({backgroundColor: '#000'});
	});
	$pastemonkey('#content').ajaxStop(function(){
		$pastemonkey('.loading').animate({opacity: 'hide'});
	});
	
	/* Resizable Text Areas */
	
	$pastemonkey('textarea').livequery(function(){
		$pastemonkey(this).resizable({ autohide: true, minHeight: 100, minWidth: 200, maxHeight: 300, maxWidth: 1000 });
	});
	
	$pastemonkey('.copyButton').livequery(function(){
		$pastemonkey(this).bind('click.copyButton', function(){
			$pastemonkey('#PasteCopy' + $pastemonkey(this).attr('rel')).focus();
			$pastemonkey('#PasteCopy' + $pastemonkey(this).attr('rel')).select();
			return false;
		});
	}, function(){
		$pastemonkey(this).unbind('click.copyButton');
	});
		
});
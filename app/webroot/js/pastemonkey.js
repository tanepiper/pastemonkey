$pastemonkey(document).ready(function() {
	
	/* Basic Bind Functions */
	
	$pastemonkey('.new-paste').bind('click.newPaste', function(){
			$pastemonkey('.pastes').replaceWith($pastemonkey('<div></div>').addClass('ajax-new-paste').css({display: 'none'}));
			$pastemonkey('.paging').remove();
			$pastemonkey('.ajax-new-paste').load('/pastes/add', function(){
				$pastemonkey(this).animate({height: 'show', opacity: 'show'});
			});	
			return false;
	});
	
	$pastemonkey('.home').bind('click.home', function(){
		$pastemonkey('.#main').load($pastemonkey(this).attr('href'));
		return false;
	});
	
	/* Live Query Functions*/
	
	$pastemonkey('a', '.paging').livequery(function(){
		$pastemonkey(this).bind('click.paging', function(){
			$pastemonkey('#main').load($pastemonkey(this).attr('href'));
			return false;
		});
	}, function(){
		$pastemonkey(this).unbind('click.paging');
	});
	
	$pastemonkey('.viewPaste').livequery(function(){
		$pastemonkey(this).bind('click.viewPaste', function(){
			$pastemonkey('#main').load($pastemonkey(this).attr('href'));
			return false;
		});
	}, function(){
		$pastemonkey(this).unbind('click.viewPaste');
	});
	
	/* AJAX Start/Stop Functions*/
	
	$pastemonkey('#main').ajaxStart(function(){
		$pastemonkey('.loading').animate({opacity:'show', backgroundColor: '#0f0'}, 'slow', 'linear')
		.animate({backgroundColor: '#fff'});
	});
	$pastemonkey('#main').ajaxStop(function(){
		$pastemonkey('.loading').animate({opacity: 'hide'});
	});
	
		
});
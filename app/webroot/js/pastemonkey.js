$pastemonkey(document).ready(function() {
	
	/* Basic Bind Functions */
	
	$pastemonkey('.new-paste').bind('click.newPaste', function(){
			$pastemonkey('<div></div>').addClass('ajax-new-paste').css({display: 'none'}).insertBefore('.pastes');
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
	
	$pastemonkey('.cancel-paste').livequery(function(){
		$pastemonkey(this).bind('click.cancelPaste', function(){
			$pastemonkey('.ajax-new-paste').animate({height:'hide', opacity:'hide'}).remove();
			return false;
		});
	}, function(){
		$pastemonkey(this).unbind('click.cancelPaste');
	});
	
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
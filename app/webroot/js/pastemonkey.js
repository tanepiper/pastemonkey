$pastemonkey(document).ready(function() {
	$pastemonkey('.new-paste').bind('click', function(){
			$pastemonkey('<div></div>').addClass('ajax-new-paste').css({display: 'none'}).insertBefore('.pastes');
			$pastemonkey('.ajax-new-paste').load('/pastes/add', function(){
				$pastemonkey(this).animate({height: 'show', opacity: 'show'});
			});	
			return false;
	});
	
	$pastemonkey('.home').bind('click', function(){
		$pastemonkey('#main').load('/');
		return false;
	});
	
	$pastemonkey('.cancel-paste').livequery(function(){
		$pastemonkey(this).bind('click', function(){
			$pastemonkey('.ajax-new-paste').animate({height:'hide', opacity:'hide'}).remove();
			return false;
		});
	});
	
	$pastemonkey('#PasteExpiry').livequery(function(){
		$pastemonkey(this).calendar();
	});
	
	$pastemonkey('a', '.paging').livequery(function(){
		$pastemonkey(this).bind('click', function(){
			$pastemonkey('#main').load($pastemonkey(this).attr('href'));
			return false;
		});
	});
	
	$pastemonkey('#main').ajaxStart(function(){
		$pastemonkey('.loading').fadeIn();
	});
	$pastemonkey('#main').ajaxStop(function(){
		$pastemonkey('.loading').fadeOut();
	});
	
	$pastemonkey('.viewPaste').livequery(function(){
		$pastemonkey(this).bind('click', function(){
			$pastemonkey('#main').load($pastemonkey(this).attr('href'));
			return false;
		});
	});
	
});
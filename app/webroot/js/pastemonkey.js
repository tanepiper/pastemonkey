var $pastemonkey = jQuery.noConflict();

$pastemonkey(document).ready(function() {
	$pastemonkey('.new-paste').bind('click', function(){
			$pastemonkey('<div></div>').addClass('ajax-new-paste').css({display: 'none'}).insertBefore('.pastes');
			$pastemonkey('.ajax-new-paste').load('/pastes/add', function(){
				$pastemonkey(this).animate({height: 'show', opacity: 'show'});
			});	
			return false;
	});
	
	$pastemonkey('ol').shadow();
});
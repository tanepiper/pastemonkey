$pastemonkey(document).ready(function() {
	
	/* Live Query Functions*/
	
	$pastemonkey('a', '.paging').livequery(function(){
		$pastemonkey(this).bind('click.paging', function(){
			$pastemonkey('#content').load($pastemonkey(this).attr('href'));
			return false;
		});
	}, function(){
		$pastemonkey(this).unbind('click.paging');
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
	
	$pastemonkey('#Highlight').livequery(function(){
		$pastemonkey(this).bind('blur.highlight', function(){
				var highlightVal = $pastemonkey(this).val();
				$pastemonkey('*','ol li').each(function(){
					$pastemonkey.highlight(this, highlightVal.toUpperCase());	
				});
		});
		$pastemonkey(this).bind('focus.hightlight', function(){
			$pastemonkey('*','ol li').each(function(){
					$pastemonkey(this).removeHighlight();	
				});
		})
	}, function(){
		$pastemonkey(this).unbind('blur.hightlight').unbind('focus.hightlight');
	});
	
	$pastemonkey('.ajaxLink').livequery(function(){
		$pastemonkey(this).bind('click.ajaxLink', function(){
			$pastemonkey('#content').load($pastemonkey(this).attr('href'));
			return false;
		});
	}, function(){
		$pastemonkey(this).unbind('click.ajaxLink');
	});
	
	/* Resizable Text Areas */
	
	$pastemonkey('textarea').livequery(function(){
		$pastemonkey(this).resizable({ autohide: true, minHeight: 100, minWidth: 200, maxHeight: 300, maxWidth: 1000 });
	});
	
	/* Live Search */
	$pastemonkey('#PasteLivesearch').livequery(function(){
		$pastemonkey('input[type=submit]', '#PasteFindForm').hide();
		$pastemonkey(this).bind('blur', function(){
			$pastemonkey(this).css({backgroundColor: '#fff'});
			var highlightVal = $pastemonkey(this).val();
			if (highlightVal != '' && highlightVal.length >= 3) {
				$pastemonkey('#content').load('/pastes/find/?q=' + highlightVal, function(){
					$pastemonkey('*','ol li').each(function(){
						$pastemonkey.highlight(this, highlightVal.toUpperCase());	
					});
				});
			}
		});
		$pastemonkey(this).bind('focus', function(){
			$pastemonkey(this).val('');
		});
		$pastemonkey(this).bind('keyup', function(){
			if ($pastemonkey(this).val().length < 3) {
				$pastemonkey(this).css({backgroundColor: '#EA444A'});
			} else {
				$pastemonkey(this).css({backgroundColor: '#5CFF69'});
			}
		});
	});
	
	/* Tags */
	$pastemonkey('#PasteTags').livequery(function(){
		$pastemonkey(this).autocomplete('/tags/find/', {multiple: true, matchContains: true});
	});
	
	/* AJAX Start/Stop Functions*/
	
	$pastemonkey.blockUI.defaults.pageMessage = '<img src="/img/ajax-loader.gif" /> Loading';
	$pastemonkey.extend($pastemonkey.blockUI.defaults.pageMessageCSS, { color: '#000', backgroundColor: '#fff' });
/*	
	$pastemonkey('#content').ajaxStart(function(){
		$pastemonkey.blockUI();
	});
	$pastemonkey('#content').ajaxStop(function(){
		$pastemonkey.unblockUI();
	});

	$pastemonkey('#recaptcha_div').livequery(function(){
		var self = this;
		$pastemonkey.getScript('http://api.recaptcha.net/js/recaptcha_ajax.js', function(){
				Recaptcha.create("6Lf3dAAAAAAAANFCQ7r0Nn3mcOfc4UYPyzvRkZ6v", self);
		});
	});
*/	
	$pastemonkey('#flashMessage').livequery(function(){
		var self = this;
		var level = $pastemonkey(this).attr('rel');
		switch (level) {
			case "fatal":
				var options = {
					backgroundColor: 'red'
				}
			break;
			case "error":
				var options = {
					backgroundColor: 'orange'
				}
			break;
			case "warning":
				var options = {
					backgroundColor: 'yellow'
				}
			break;
			case "notice":
				var options = {
					backgroundColor: 'green'
				}
			break;
		}
		
		$pastemonkey(this).addClass(level);
		$pastemonkey(this).animate(options, 'slow', 'linear')
			.animate({backgroundColor: '#fff'}, 'slow', 'linear', function(){
				setTimeout(function(){$pastemonkey(self).animate({opacity: 'hide'}, 'slow', 'linear');}, '5000');
			});
	});
		
});
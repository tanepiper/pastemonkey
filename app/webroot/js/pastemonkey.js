$pm(document).ready(function() {
	
	/* AJAX Control */
	
	$pm.blockUI.defaults.pageMessage = '<img src="/img/ajax-loader.gif" /> Loading';
	$pm.extend($pm.blockUI.defaults.pageMessageCSS, { color: '#000', backgroundColor: '#fff' });

	$pm.ajaxSetup({timeout: 10000});
	
	$pm('#content').ajaxStart(function(){
		$pm.blockUI();
	});
	$pm('#content').ajaxStop(function(){
		$pm.unblockUI();
	});
	
	/* Navigation Functions */
	$pm('a', '.paging').livequery(function(){
		$pm(this).bind('click.paging', function(){
			$pm('#content').load($pm(this).attr('href'));
			$pm('#ajaxLatest').load('/pastes/latest');
			return false;
		});
	}, function(){
		$pm(this).unbind('click.paging');
	});
	
	$pm('.ajaxLink').livequery(function(){
		$pm(this).bind('click.ajaxLink', function(){
			$pm('#content').load($pm(this).attr('href'));
			return false;
		});
	}, function(){
		$pm(this).unbind('click.ajaxLink');
	});
	
	/* Paste Form Functions */
	$pm('.copyButton').livequery(function(){
		$pm(this).bind('click.copyButton', function(){
			var copyText = $pm('#PasteCopy' + $pm(this).attr('rel')).val();
			$pm.clipboard(copyText, '/js/');
			return false;
		});
	}, function(){
		$pm(this).unbind('click.copyButton');
	});
	
	$pm('textarea').livequery(function(){
		$pm(this).resizable({ autohide: true, minHeight: 100, minWidth: 200, maxHeight: 300, maxWidth: 1000 });
	});
	
	/* Search-type Functions */
	
	/* Live Search */
	$pm('#PasteSearchTerm').livequery(function(){
		$pm('input[type=submit]', '#PasteSearchForm').hide();
		$pm(this).bind('blur', function(){
			$pm(this).css({backgroundColor: '#fff'});
			var highlightVal = $pm(this).val();
			if (highlightVal != '' && highlightVal.length >= 3) {
				$pm('#content').load('/pastes/search/' + highlightVal, function(){
					$pm('*','ol li').each(function(){
						$pm.highlight(this, highlightVal.toUpperCase());	
					});
				});
			}
		});
		$pm(this).bind('focus', function(){
			$pm(this).val('');
		});
		$pm(this).bind('keyup', function(){
			if ($pm(this).val().length < 3) {
				$pm(this).css({backgroundColor: '#EA444A'});
			} else {
				$pm(this).css({backgroundColor: '#5CFF69'});
			}
		});
	});
	
	/* Tags */
	$pm('#PasteTags').livequery(function(){
		$pm(this).autocomplete('/tags/find/', {multiple: true, matchContains: true});
	});
	
	
	/* Message Handling Functions */
	
	$pm('#flashMessage').livequery(function(){
		var self = this;
		var level = $pm(this).attr('rel');
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
		
		$pm(this).addClass(level);
		$pm(this).animate(options, 'slow', 'linear')
			.animate({backgroundColor: '#fff'}, 'slow', 'linear', function(){
				setTimeout(function(){$pm(self).animate({opacity: 'hide'}, 'slow', 'linear');}, '5000');
			});
	});
	
	$pm('#PasteAddForm').livequery(function(){
		$pm(this).ajaxForm({
			target: '#content',
			success: function() {
				$pm('html,body').animate({scrollTop: '0'}, 1000);
				$pm('#ajaxLatest').load('/pastes/latest');
        	}
		});
	});
	
	$pm('#PasteEditForm').livequery(function(){
		$pm(this).ajaxForm({
			target: '#content',
			success: function() {
				$pm('html,body').animate({scrollTop: '0'}, 1000);
				$pm('#ajaxLatest').load('/pastes/latest');
        	}
		});
	});
});
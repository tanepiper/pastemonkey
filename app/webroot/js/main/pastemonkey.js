(function($) {	
	$(document).ready(function() {
		
		// AJAX Setup
		$.ajaxHistory.initialize();
		$.ajaxSetup({timeout: 10000});
		$('#content').ajaxStart(function(){
			$('.loading').animate({opacity: 'show'});
		});
		$('#content').ajaxStop(function(){
			$('.loading').animate({opacity: 'hide'});
		});
		
		// JSS Setup
		$.jss.disableCaching = 0;
		$.jss.debugMode = 0;
		$.jss.apply();

		/* Navigation Functions */
		$('a', '.paging').livequery(function(){
			$(this).remote('#content');
			$('html', 'body').animate({scrollTo: '0'});
			return false;
		});

		$('a.ajaxLink').livequery(function(){
			$(this).remote('#content');
			return false;
		});
		
		$('.tag').livequery(function(){
			$(this).remote('#content');
			return false;
		});

		/* Paste Form Functions */
		$('.PasteCopy').livequery(function(){
			var self = this;
			$('.copyText').livequery(function(){
				$(this).bind('click.copyButton', function(){
					$.clipboard($(self).val(), {swfpath: '/js/lib/jquery.clipboard.swf'});
					return false;
				});
			});
		}, function(){
			$(this).unbind('click.copyButton');
		});
		
		$('.permalinks').livequery(function(){
			$('.copy-pastePermalink').bind('click.copyPastePermalink', function(){
				$.clipboard($('.pastePermalink').text(), {swfpath: '/js/lib/jquery.clipboard.swf'});
				return false;
			});
			$('.copy-personalLink').bind('click.copyPersonalLink', function(){
				$.clipboard($('.personalLink').text(), {swfpath: '/js/lib/jquery.clipboard.swf'});
				return false;
			});
		});
		
		$('a.download').livequery(function() {
			$(this).bind('click', function() {
				$('body').append($('<iframe />').attr('src', $(this).attr('href')));
				return false;
			});
		});
	
	
		$('textarea').livequery(function(){
			var thisWidth = $(this).parent().width();
			$(this).width(thisWidth);
			$('#PastePaste').focus();
			$(this).keypress(function(event){
				$.fn.tabarea(null, event);
			});
		});
		
		$('.increase').livequery(function(){
			var target = $(this).attr('rel');
			$(this).click(function(){
				var thisHeight = $('#' + target).height();
				thisHeight = thisHeight + 20;
				$('#' + target).height(thisHeight);
				return false;
			});
		});
		
		$('.decrease').livequery(function(){
			var target = $(this).attr('rel');
			$(this).click(function(){
				var thisHeight = $('#' + target).height();
				thisHeight = thisHeight - 20;
				if (thisHeight > 100) { thisHeight = 100 }
				$('#' + target).height(thisHeight);
				return false;
			});
		});
	
		/* Search Functions */
		
		$('#searchPastes').toggle(function(){
			$('#searchArea').animate({opacity: 'show', height: 'show'});
			return false;
		}, function(){
			$('#searchArea').animate({opacity: 'hide', height: 'hide'});
			return false;
		});
		
		/* Live Search */
		$('#PasteSearchTerm').livequery(function(){
			$('input[type=submit]', '#PasteSearchForm').hide();
			$(this).bind('blur', function(){
				$(this).css({backgroundColor: '#fff'});
				var searchTerm = $(this).val();
				if (searchTerm != '' && searchTerm.length >= 3) {
					$('#content').load('/pastes/search/' + searchTerm, function(){
						$('#searchArea').animate({opacity: 'hide', height: 'hide'});
					});
				}
			});
			$(this).bind('focus', function(){
				$(this).val('');
			});
			$(this).bind('keyup', function(){
				if ($(this).val().length < 3) {
					$(this).css({backgroundColor: '#EA444A'});
				} else {
					$(this).css({backgroundColor: '#5CFF69'});
				}
			});
		});

		/* Tags */
		$('#PasteTags').livequery(function(){
			$(this).autocomplete('/tags/find/', {multiple: true, matchContains: true, delay: 1000});
		});


		/* Message Handling Functions */
		$('.pm-message').livequery(function(){
			var self = this;
			$(self).addClass('message-' + $(this).attr('rel'));
			$(self).animate({top: -90, opacity: 0.9}, 2000);
			setTimeout(function() {
				$(self).animate({ top: -150, opacity: 0 }, 1000);
			}, 5000);
		});
		
		/* Live Inline Comments */
		$('.geshi-output-view ol').livequery(function() {
			var i = 1;
			$(this).children('li').each(function(){
				$(this).attr('id', i).dblclick(function(e){
					
					$('.comment-box').remove();
					
					oPos = $(this).offset();
					lineId = $(this).attr('id');
					pasteId = $('div.paste').attr('id');
					$(this).css({backgroundColor:'#fff', backgroundImage: 'url(/img/comment-open.png)', backgroundRepeat: 'no-repeat', backgroundPosition: 'center right'});
					$('<div></div>').addClass('comment-box').css({top: oPos.top, left: oPos.left}).appendTo('body').append(
						$('<div class="viewComments"></div>').load('/comments/view/' + pasteId + '/' + lineId)
					).append(
						$('<div class="addComment"></div>').load('/comments/add', function(){
								$('#CommentPasteId').val(pasteId);
								$('#CommentLinePosition').val(lineId);
						})
					);
				});
				if ($('div.comment').hasClass(i)) {
					$(this).css({backgroundImage: 'url(/img/comment.png)', backgroundRepeat: 'no-repeat', backgroundPosition: 'center right'});
				}
				i++;
			});
			
			$('li').livequery(function(){
				var self = $(this);
				self.click(function(e){
					$('.comment-box').remove();
					
					self.each(function(){
						$(this).css({backgroundColor:'#eee'});
						if ($('div.comment').hasClass($(this).attr('id'))) {
							$(this).css({backgroundImage: 'url(/img/comment.png)', backgroundRepeat: 'no-repeat', backgroundPosition: 'center right'});
						} else {
							$(this).css({backgroundImage: '', backgroundRepeat: 'no-repeat', backgroundPosition: 'center right'});
						}
					});
				});
			});
			
			$('.cancelComment').livequery(function(){
				$(this).bind('click', function(){
					$('.comment-box').remove();
				});
			});
		});
		
		$('#CommentAddForm').livequery(function(){
			var paste = $('#CommentPasteId').val();
			$('#CommentComment').focus();
			$(this).ajaxForm({
				beforeSubmit: function() {
				},
				target: '.comment-box',
				success: function() {
					$('#content').livequery(function(){
						$(this).load('/pastes/view/' + paste);
					});
					$('.comment-box').remove();
	        	}
			});
		});

		$('#PasteLanguageId').livequery(function(){
			$(this).autocomplete('/languages/find/', {multiple: false, matchContains: true, delay: 1000});
		});
	});
})(jQuery);
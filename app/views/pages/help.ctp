<h2><?php __('Paste Monkey');?> <?php __('Help');?></h2>
<div class="box help-entry">
	<h2><?php __('What Is Paste Monkey');?>?</h2>
	<div class="inner">
	<p>
		Paste Monkey is a collaborative pastebin, or 'nopaste', application.
	</p>
	<p>
		If you are in a IRC channel, or speaking on IM it's very difficult (and rude) to post
		lines and lines of code, so the pastebin comes in handy by allowing you to paste the
		code into the web-based interface, and in return you recieve a URL that you can paste.
	</p>
	<p>
		Once a paste is added, it can then be edited by anyone who views the page, and a modified
		version is generated - with Paste Monkey you can then download the source code, or download
		a diff patch file, as well as leaving comments.
	</p>
	</div>
</div>
<div class="box help-entry">
	<h2><?php __('How to use Paste Monkey');?>?</h2>
	<div class="inner">
	<p>
		Paste Monkey tries to be as intuative as possible, but just incase you need to know, here is the lowdown.
	</p>
	<h3><?php __('Creating a Paste');?></h3>
	<p>
		When you first visit Paste Monkey, you are presented with a new paste form.  The first thing to
		do is to copy the code you want to paste into your clipboard, then click on the Paste textbox.  Paste
		your code into this box.  If you wish to highlight any lines, at the beginning of the line,
		type in '!!!'.  This will be removed from your code, but the system will still know to highlight these lines.
	</p>
	<p>
		Next you can enter a note, this is a descriptive note that allows anyone looking at the code to know whats
		going on.  Next you can enter tags.  The tag field has an autocomplete on it, so type in the first letter
		of the tag and see if it pops up, if it doesn't go ahead and create the tag.  All tags are seperated by a comma (,).
		<br />
		Then select the language of the post.  This allows <a href="http://geshi.sf.net">GeSHi</a> to correctly mark
		up your code to be highlighted.  Next you can type in your name.  You can remain anonymous if you wish.
		<br />
		Finally you can select how long the paste exists for.  Pastes that are set to "Never" will never be removed automatically
		from the site, however in future versions a password can be set for the post that allows you to remove it.
	</p>
	</div>
</div>

<div class="box help-entry">
	<h2><?php __('What is Paste Monkey developed in');?>?</h2>
	<div class="inner">	<p>
		Paste Monkey is developed in PHP and JavaScript.  It uses the <a href="http://cakephp.org">CakePHP</a>
		MVC library to help rapidly develop the PHP and MySQL application side.  It then uses
		<a href="http://jquery.com">jQuery</a> JavaScript library to achieve it's AJAX magic.
	</p>
	<p>
		A full list of plugins and code used is available on the about dialog.
	</p>
	</div>
</div>
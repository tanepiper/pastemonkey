<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php e($pm_sitename);?></title>
		<?php e($html->charset());?>
		
		<?php echo $html->css('pastemonkey2');?>
		<?php echo $html->css('flora.resizable');?>
		<?php e($javascript->link('jquery'));?>
		<?php e($javascript->codeBlock('var $pastemonkey = jQuery.noConflict();'));?>
		<?php e($javascript->link('jquery.dimensions.min'));?>
		<?php e($javascript->link('jquery.livequery'));?>
		<?php e($javascript->link('jquery.color'));?>
		<?php e($javascript->link('ui.mouse'));?>
		<?php e($javascript->link('ui.resizable'));?>
		<?php e($javascript->link('pastemonkey'));?>
		<?php echo $scripts_for_layout;?>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1><a href="/"><?php e($pm_sitename);?></a></h1>
				<div class="loading" style="display:none"><?php e($html->image('ajax-loader.gif'));?> <?php __('Loading');?></div>
				</div>
			<div id="wrapper">
				<div id="content">
					<?php
					if ($session->check('Message.flash')):
							$session->flash();
					endif;
				?>
	
				<?php echo $content_for_layout;?>
				</div>
			</div>
			<div id="navigation">
				<?php e($this->renderElement('navigation'));?>
				<?php e($this->renderElement('latest'));?>
			</div>
			<div id="extra">
				<?php e($this->renderElement('buttons'));?>
			</div>
		<div id="footer"><?php e($this->renderElement('credits'));?></div>
	</div>
	<?php echo $cakeDebug?>
	</body>
</html>
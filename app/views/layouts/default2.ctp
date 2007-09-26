<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php e($pm_sitename);?></title>
		<?php e($html->charset());?>
		
		<?php echo $html->css('pastemonkey2');?>
		<?php e($javascript->link('jquery'));?>
		<?php e($javascript->codeBlock('var $pastemonkey = jQuery.noConflict();'));?>
		<?php e($javascript->link('jquery.dimensions.min'));?>
		<?php e($javascript->link('jquery.livequery'));?>
		<?php e($javascript->link('jquery.color'));?>
		<?php e($javascript->link('pastemonkey'));?>
		<?php echo $scripts_for_layout;?>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1><a href="/"><?php e($pm_sitename);?></a></h1>
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
				<div class="loading" style="display:none"><?php e($html->image('ajax-loader.gif'));?> <?php __('Loading');?></div>
				<?php e($this->renderElement('navigation'));?>
				<?php e($this->renderElement('latest'));?>
				<?php e($this->renderElement('credits'));?>
			</div>
			<div id="extra">
			
			</div>
		<div id="footer"><p>Here it goes the footer</p></div>
	</div>
	<?php echo $cakeDebug?>
	</body>
</html>
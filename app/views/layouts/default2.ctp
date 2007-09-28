<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php e($pm_sitename);?> (beta)</title>
		<?php e($html->charset());?>
		<link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
	
		<?php echo $html->css('pastemonkey2');?>
		<?php echo $html->css('flora.resizable');?>
		<?php e($javascript->link('jquery'));?>
		<?php e($javascript->codeBlock('var $pastemonkey = jQuery.noConflict();'));?>
		<?php e($javascript->link('jquery.dimensions.min'));?>
		<?php e($javascript->link('jquery.livequery'));?>
		<?php e($javascript->link('jquery.color'));?>
		<?php e($javascript->link('ui.mouse'));?>
		<?php e($javascript->link('ui.resizable'));?>
		<?php e($javascript->link('jquery.highlight-1'));?>
		<?php e($javascript->link('jquery.blockUI'));?>
		<?php e($javascript->link('pastemonkey-min'));?>
		<?php echo $scripts_for_layout;?>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1><a href="/"><?php e($pm_sitename);?> (beta)</a></h1>
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
				<?php e($this->element('navigation', array('cache'=>'1 day')));?>
				<?php e($this->element('latest', array('cache'=>'1 day')));?>
				<?php e($this->element('donate', array('cache'=>'1 day')));?>
			</div>
			<div id="extra">
				<?php e($this->element('buttons', array('cache'=>'1 day')));?>
			</div>
		<div id="footer"><?php e($this->element('credits', array('cache'=>'1 day')));?></div>
	</div>
	<?php echo $cakeDebug?>
	</body>
</html>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php e($pm_sitename);?></title>
		<?php e($html->charset());?>
		
		<?php echo $html->css('pastemonkey');?>
		<?php echo $html->css('flora.calendar');?>
		<?php e($javascript->link('jquery'));?>
		<?php e($javascript->codeBlock('var $pastemonkey = jQuery.noConflict();'));?>
		<?php e($javascript->link('jquery.dimensions.min'));?>
		<?php e($javascript->link('jquery.livequery'));?>
		<?php e($javascript->link('jquery.color'));?>
		<?php e($javascript->link('jquery.form'));?>
		<?php e($javascript->link('pastemonkey'));?>
	</head>
	<body>
		<div id="wrap">
			<div id="header"><h1><a href="/"><?php e($pm_sitename);?></a></h1></div>
			<div id="nav">
				<?php e($this->renderElement('navigation'));?>
			</div>
			<div class="loading" style="display:none"><?php e($html->image('ajax-loader.gif'));?> <?php __('Loading');?></div>
			<div id="main">
				<?php
					if ($session->check('Message.flash')):
							$session->flash();
					endif;
				?>
	
				<?php echo $content_for_layout;?>
			</div>
			<div id="sidebar">
				<?php e($this->renderElement('latest'));?>
			</div>
			<div id="footer">
				<?php echo $html->link(
							$html->image('cake.power.png', array('alt'=>"CakePHP: the rapid development php framework", 'border'=>"0")),
							'http://www.cakephp.org/',
							array('target'=>'_new'), null, false
						);
			?>
			</div>
		</div>
		<?php echo $cakeDebug?>
	</body>
</html>
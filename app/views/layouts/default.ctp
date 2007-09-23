<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>\_/ Paste Monkey \_/</title>
		<?php e($html->charset());?>
		
		<?php echo $html->css('pastemonkey');?>
		<?php e($javascript->link('jquery'));?>
		<?php e($javascript->link('jquery.dimensions.min'));?>
		<?php e($javascript->link('jquery.livequery'));?>
		<?php e($javascript->link('ui.shadow'));?>
		<?php e($javascript->link('pastemonkey'));?>
	</head>
	<body>
		<div id="wrap">
			<div id="header"><h1><a href="/"><?php __('Paste Monkey'); ?></a></h1></div>
			<div id="nav">
				<ul>
					<li><?php e($html->link(__('New Post',true), array('controller'=> 'pastes', 'action'=>'add'), array('class'=>'new-paste')));?></li>
					<li><a href="#">Option 2</a></li>
					<li><a href="#">Option 3</a></li>

					<li><a href="#">Option 4</a></li>
					<li><a href="#">Option 5</a></li>
				</ul>
			</div>
			<div id="main">
				<?php
					if ($session->check('Message.flash')):
							$session->flash();
					endif;
				?>
	
				<?php echo $content_for_layout;?>
			</div>
			<div id="sidebar">
				<h3>Column 2</h3>
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
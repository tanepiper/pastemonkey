<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php e(__SITE_NAME);?> (beta)</title>
		<?php e($html->charset());?>
		<link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
	
		<?php echo $html->css('pastemonkey');?>
		<?php echo $html->css('flora.resizable');?>
		<?php echo $html->css('jquery.autocomplete');?>
		<?php echo $html->css('thickbox');?>
		<?php e($this->element('jsfiles'));?>
		<?php echo $scripts_for_layout;?>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1><a href="/" title="Paste Monkey Beta"><?php e($html->image('pastemonkey-logo.png'));?></a></h1>
				<?php e($this->element('navigation'));?>
			</div>
			<div id="wrapper">
				<div id="content">
					<?php echo $content_for_layout;?>
				</div>
			</div>
			<div id="navigation">
				<?php e($this->element('search'));?>
				<div id="ajaxLatest">
					<?php e($this->element('latest'));?>
				</div>
				<?php e($this->element('donate'));?>
				<?php e($this->element('googleads'));?>
			</div>
			<div id="extra">
				<?php e($this->element('buttons'));?>
			</div>
		<div id="footer"><?php e($this->element('credits'));?></div>
	</div>
	<?php echo $cakeDebug?>
	</body>
</html>
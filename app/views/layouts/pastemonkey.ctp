<!DOCTYPE html>
<html>
	<head>
		<title><?php e(Configure::read('Site.sitename'));?> (beta)</title>
		<?php e($html->charset());?>
		<link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
	
		<?php echo $html->css('core/core');?>
		<?php echo $html->css('flora.resizable');?>
		<?php echo $html->css('jquery.autocomplete');?>
		<?php e($this->element('jsfiles'));?>
		<?php echo $scripts_for_layout;?>
	</head>
	<body>
  	<div id="header">
    	<h1 class="title"><a href="<?php e(Configure::read('Site.url'));?>" title="Goto The Pastemonkey Website"><?php e(Configure::read('Site.sitename'));?><sup>Beta</sup></a></h1>
    	<?php e($this->element('navigation'));?>
			<div class="loading" style="display:none;">Loading</div>
		</div>
  	<div id="wrapper">
  		<?php e($this->element('search'));?>
    	<div id="content">
      		<?php echo $content_for_layout;?>
    	</div>
  	</div>
		<?php e($this->element('footer'));?>
		<?php e($this->element('buttons'));?>
	</body>
</html>
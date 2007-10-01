<div id="search">
	<?php e($form->create('Paste', array('action'=>'find')));?>
	<?php e($form->input('livesearch' /*, array('disabled'=>'disabled')*/));?>
	<?php e($form->end('Search'));?>
</div>
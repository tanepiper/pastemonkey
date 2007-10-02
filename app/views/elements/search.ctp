<div id="search">
	<h3><?php __('Search Code');?></h3>
	<?php e($form->create('Paste', array('action'=>'find')));?>
	<?php e($form->input('livesearch' , array('label'=>'', 'value'=>__('Search',true) . '...')));?>
	&nbsp;
	<?php e($form->end('Search'));?>
</div>
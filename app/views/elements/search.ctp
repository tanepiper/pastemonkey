<div id="search">
	<?php e($form->create('Paste', array('action'=>'find')));?>
	<fieldset>
		<legend><?php __('Search Code');?></legend>
		<?php e($form->input('livesearch' , array('value'=>__('Search',true) . '...')));?>
		<?php e($form->end('Search'));?>
	</fieldset>
</div>
<div class="language">
<?php echo $form->create('Language');?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('Language');?></legend>
	<?php
		echo $form->input('language');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true).' '.__('Languages', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Pastes', true), array('controller'=> 'pastes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Paste', true), array('controller'=> 'pastes', 'action'=>'add')); ?> </li>
	</ul>
</div>
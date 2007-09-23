<div class="language">
<?php echo $form->create('Language');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Language');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('language');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Language.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('Language.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Languages', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Pastes', true), array('controller'=> 'pastes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Paste', true), array('controller'=> 'pastes', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="paste">
<?php echo $form->create('Paste');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Paste');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('paste');
		echo $form->input('note');
		echo $form->input('tags');
		echo $form->input('parent_id');
		echo $form->input('language_id');
		echo $form->input('expiry');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Paste.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('Paste.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Pastes', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Languages', true), array('controller'=> 'languages', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Language', true), array('controller'=> 'languages', 'action'=>'add')); ?> </li>
	</ul>
</div>
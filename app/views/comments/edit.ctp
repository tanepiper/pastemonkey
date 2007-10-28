<div class="comment">
<?php echo $form->create('Comment');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Comment');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('paste_id');
		echo $form->input('line_position');
		echo $form->input('comment');
		echo $form->input('author');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Comment.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('Comment.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Comments', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Pastes', true), array('controller'=> 'pastes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Paste', true), array('controller'=> 'pastes', 'action'=>'add')); ?> </li>
	</ul>
</div>
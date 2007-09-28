<div class="user">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('User');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('email');
		echo $form->input('passwd');
		echo $form->input('author');
		echo $form->input('pastes_count');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('User.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('User.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Users', true), array('action'=>'index'));?></li>
	</ul>
</div>
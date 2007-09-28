<div class="pinboard">
<?php echo $form->create('Pinboard');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Pinboard');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('body');
		echo $form->input('author');
		echo $form->input('tags');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Pinboard.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('Pinboard.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Pinboards', true), array('action'=>'index'));?></li>
	</ul>
</div>
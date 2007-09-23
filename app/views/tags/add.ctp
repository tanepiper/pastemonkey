<div class="tag">
<?php echo $form->create('Tag');?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('Tag');?></legend>
	<?php
		echo $form->input('tag');
		echo $form->input('Paste');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true).' '.__('Tags', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Pastes', true), array('controller'=> 'pastes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Paste', true), array('controller'=> 'pastes', 'action'=>'add')); ?> </li>
	</ul>
</div>
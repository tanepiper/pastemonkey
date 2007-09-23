<div class="paste">
<?php echo $form->create('Paste');?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('Paste');?></legend>
	<?php
		echo $form->input('paste');
		echo $form->input('note');
		echo $form->input('tags', array('type'=>'text'));
		echo $form->input('parent_id', array('type'=>'hidden'));
		echo $form->input('language_id');
		echo $form->input('author');
		echo $form->input('expiry');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true).' '.__('Pastes', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Languages', true), array('controller'=> 'languages', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Language', true), array('controller'=> 'languages', 'action'=>'add')); ?> </li>
	</ul>
</div>
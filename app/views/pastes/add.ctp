<div class="paste">
<?php echo $form->create('Paste');?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('Paste');?></legend>
	<?php
		echo $form->input('paste');
		echo $form->input('note');
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Paste');?> <?php __('Details');?></legend>
	<?php
		echo $form->input('tags', array('type'=>'text'));
		echo $form->input('parent_id', array('type'=>'hidden'));
		echo $form->input('language_id');
		echo $form->input('author');
		e($form->input('remember_me', array('type'=>'checkbox', 'disabled'=>'disabled')));
		echo $form->input('expiry');
	?>
	</fieldset>
<?php e($html->link(__('Cancel Paste',true), array('controller'=> 'pastes', 'action'=>'index'), array('class'=>'cancel-paste')));?>
<?php echo $form->end('Submit', array('class'=>'submit-paste'));?>
</div>
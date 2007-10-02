<div class="paste-add">
<?php echo $form->create('Paste');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Paste');?></legend>
	<?php
		echo $form->input('paste');
		echo $form->input('note');
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Paste');?> <?php __('Details');?></legend>
	<?php
		echo $form->input('tags', array('type'=>'text'));
		echo $form->input('parent_id', array('type'=>'hidden', 'value'=>$this_id));
		echo $form->input('language_id');
		echo $form->input('author', array('value'=>$name));
		e($form->input('remember_me', array('type'=>'checkbox', 'value'=>'1')));
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Expiry');?></legend>
		<?php e($form->input('expire_type', array('type'=>'radio', 'options'=>$expiry_types)));?>
	</fieldset>
	<fieldset id="captchField">
		<legend><?php __('Captcha');?></legend>
		<div id="recaptcha_div"></div>
	</fieldset>
	<?php echo $form->end(__('Add Modified Paste', true), array('class'=>'submit-paste'));?>
</div>
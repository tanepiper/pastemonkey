<div class="paste">
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
		echo $form->input('author');
		e($form->input('remember_me', array('type'=>'checkbox', 'disabled'=>'disabled')));
		//echo $form->input('expiry');
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
	<?php echo $form->end('Submit', array('class'=>'submit-paste'));?>
</div>
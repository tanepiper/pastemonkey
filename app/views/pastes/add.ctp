<div class="pasteAdd">
	<?php e($form->create('Paste', array('type'=>'file')));?>
		<fieldset>
 			<legend><?php __('Add');?> <?php __('Paste');?></legend>
			<?php
				e($form->input('paste'));
				e($form->input('note'));
			?>
		</fieldset>
	
		<fieldset>
			<legend><?php __('Paste');?> <?php __('Details');?></legend>
			<?php
				e($form->input('tags', array('type'=>'text')));
				e($form->input('parent_id', array('type'=>'hidden')));
				e($form->input('language_id'));
				e($form->input('author', array('value'=>$name)));
				e($form->input('remember_me', array('type'=>'checkbox', 'value'=>$remember_me)));
			?>
		</fieldset>
	
		<fieldset id="pasteOptions">
			<legend><?php __('Paste');?> <?php __('Expiry');?></legend>
			<?php e($form->select('expire_type', $expiry_types, null, null, false));?>
			<?php e($form->input('private', array('type'=>'checkbox', 'label'=>'Make this paste private?')));?>
		</fieldset>
	
		<fieldset id="captchField">
			<legend><?php __('Captcha');?></legend>
			<?php e($recaptcha->render('6Lf3dAAAAAAAANFCQ7r0Nn3mcOfc4UYPyzvRkZ6v', $error));?>
		</fieldset>
	<?php e($form->end(__('Add New Paste', true), array('class'=>'submit-paste')));?>
</div>
<div class="paste-add">
	<?php e($form->create('Paste'));?>
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
				e($form->input('remember_me', array('type'=>'checkbox')));
			?>
		</fieldset>
	
		<fieldset>
			<legend><?php __('Paste');?> <?php __('Options');?></legend>
			<?php e($form->radio('expire_type', $expiry_types, null, array('label'=>'How long do you want this paste to last?')));?>
			<?php e($form->input('private', array('type'=>'checkbox')));?>
		</fieldset>
	
		<fieldset id="captchField">
			<legend><?php __('Captcha');?></legend>
			<?php e($recaptcha->render('6Lf3dAAAAAAAANFCQ7r0Nn3mcOfc4UYPyzvRkZ6v', $error));?>
		</fieldset>
	<?php e($form->end(__('Add New Paste', true), array('class'=>'submit-paste')));?>
</div>
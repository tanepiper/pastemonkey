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
		//echo $form->input('expiry');
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Expiry');?></legend>
		<?php e($form->input('expire_type', array('type'=>'radio', 'options'=>$expiry_types)));?>
	</fieldset>
	<?php echo $form->end('Submit', array('class'=>'submit-paste'));?>
</div>
<div class='attach_this'>
<fieldset>
		<legend><?php __('Attachment');?></legend>
		
			<?php 
				$html->css('swf_upload', null, null, false);
				$javascript->link('swfobject', false);
				$javascript->link('swf_upload', false); 
				$javascript->link('swf_upload_functions', false); 
		
				echo $this->renderElement('attachment_form', array('model'=>'Paste','model_id'=>$this->data['Paste']['id'],'group'=>'image', 'title'=>'Upload image'));
		
				echo $this->renderElement('attachment_list', array('model'=>'Paste','model_id'=>$this->data['Paste']['id'],'group'=>'image'));
		?>	
</fieldset>
</div>
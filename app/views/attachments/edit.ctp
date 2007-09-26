<?php
$html->css('swf_upload', null, null, false); 
$javascript->link('jquery-1.1.4', false); 
$javascript->link('swf_upload', false); 
$javascript->link('swf_upload_functions', false); 

?>
<div id="general">
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Attachment');?></legend>
	<?php
		echo $this->renderElement('attachment_thumbnail', array('id_name'=>$this->data['Attachment']['id'].'_image', 'thumbOptions'=>array('h'=>400, 'w'=>500)));
		echo $this->renderElement('attachment_form', array('id'=>$this->data['Attachment']['id'],'model'=>$this->data['Attachment']['model'],'model_id'=>$this->data['Attachment']['model_id'],'group'=>$this->data['Attachment']['group'],'file_upload_limit'=>1, 'title'=>'Replace file'));
		
		echo $form->create('Attachment');
		echo $form->hidden('referer');
		echo $form->hidden('id');
		echo $form->hidden('model');
		echo $form->hidden('model_id');
		echo $form->hidden('group');
		echo $form->input('title');
		echo $form->input('description');
		echo $form->end('Submit');
		//echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Attachment.id'), $form->value('Attachment.referer')), null, __('Are you sure you want to delete', true).' #' . $form->value('Attachment.id'));
	?>
	</fieldset>
</div>
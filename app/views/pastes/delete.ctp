<?php e($this->element('notify'));?>
<?php e($form->create('Paste', array('action'=>'delete')));?>
	<?php e($form->input('delete_password', array('type'=>'password')));?>
<?php e($form->end('Delete'));?>
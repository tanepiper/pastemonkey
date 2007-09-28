<div>
	<?php e($form->create('User', array('action'=>'login')));?>
		<?php e($form->input('email'));?>
		<?php e($form->input('passwd'));?>
	<?php e($form->end('Login'));?>
</div>
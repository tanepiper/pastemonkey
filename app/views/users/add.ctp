<div class="user">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Regular Signup');?></legend>
	<?php
		echo $form->input('email');
		echo $form->input('passwd');
		echo $form->input('author');
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('OpenID Signup');?></legend>
		<?php e($form->input('openid_url', array('class'=>'openid_url')));?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true).' '.__('Users', true), array('action'=>'index'));?></li>
	</ul>
</div>
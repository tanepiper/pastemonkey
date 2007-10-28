<?php if ($session->check('Message.flash')): ?>
		<?php $session->flash();?>
<?php endif; ?>
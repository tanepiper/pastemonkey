<?php $latest = $this->requestAction('/pastes/latest/'); ?>

<div id="latest-pastes">
	<h3><?php __('Latest Pastes');?></h3>
	<ul>
		<?php foreach($latest as $paste) { ?>
			<li><?php __('Paste by');?> <?php e($html->link($paste['Paste']['author'], array('controller'=> 'pastes', 'action'=>'view', $paste['Paste']['id'])));?> <?php __('on');?> <?php e($paste['Paste']['created']);?></li>
		<?php } ?>
	</ul>
</div>
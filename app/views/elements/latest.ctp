<?php $latest = $this->requestAction('/pastes/latest/'); ?>

<div id="latest-pastes">
	<h3><?php __('Latest Pastes');?></h3>
	<ul>
		<?php foreach($latest as $paste) { ?>
			<li>Paste by <?php e($paste['Paste']['author']);?> on <?php e($paste['Paste']['created']);?></li>
		<?php } ?>
	</ul>
</div>
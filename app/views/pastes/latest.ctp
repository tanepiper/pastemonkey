	<h3><?php __('Latest Pastes');?></h3>
	<ul>
		<?php foreach($latest as $paste) { ?>
			<li><?php __('Paste by');?> <?php e($html->link($paste['Paste']['author'], array('controller'=> 'pastes', 'action'=>'view', $paste['Paste']['id']), array('class'=>'ajaxLink')));?> <?php e($pastemonkey->timeAgo($paste['Paste']['created']));?></li>
		<?php } ?>
	</ul>
<h2><?php __('Latest Pastes');?></h2>
	<div class="inner">
		<ul>
			<?php foreach($latest as $paste) { ?>
				<li><?php e($html->link(__('Paste by', true) . ' ' . $paste['Paste']['author'], array('controller'=> 'pastes', 'action'=>'view', $paste['Paste']['id']), array('class'=>'ajaxLink', 'title'=>__('View Paste By', true) . ' ' . $paste['Paste']['author'])));?> <?php e($pastemonkey->timeAgo($paste['Paste']['created']));?></li>
			<?php } ?>
		</ul>
	</div>
<div id="search">
	<h3><?php __('Search Code');?></h3>
	<?php e($form->create('Paste', array('action'=>'search')));?>
	<?php e($form->input('search_term' , array('label'=>'', 'value'=>__('Search',true) . '...')));?>
	&nbsp;
	<?php e($form->end('Search'));?>
</div>
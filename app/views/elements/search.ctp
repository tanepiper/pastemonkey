<div class="box" id="searchArea" style="display:none;">
	<h2><?php __('Search Code');?></h2>
	<div class="inner">
		<?php e($form->create('Paste', array('action'=>'search')));?>
		<?php e($form->input('search_term' , array('label'=>'', 'value'=>__('Search',true) . '...')));?>
		&nbsp;
		<?php e($form->end('Search'));?>
	</div>
</div>
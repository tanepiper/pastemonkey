<div id="nav">
	<ul>
		<li><?php e($html->link(__('New Paste',true), array('controller'=> 'pastes', 'action'=>'add'), array('class'=>'topNav', 'id'=>'newPaste', 'title'=>__('New Paste', true))));?></li>
		<li><?php e($html->link(__('Upload Paste',true), array('controller'=> 'pastes', 'action'=>'upload'), array('class'=>'topNav', 'id'=>'uploadPaste', 'title'=>__('Upload File', true))));?></li>
		<li><?php e($html->link(__('View All Pastes', true), array('controller'=> 'pastes', 'action'=>'index'), array('class'=>'topNav', 'id'=>'allPastes', 'title'=>__('View All Pastes', true))));?>
		<li><?php e($html->link(__('Search', true), array('controller'=> 'pastes', 'action'=>'search'), array('class'=>'topNav', 'id'=>'searchPastes', 'title'=>__('Search Pastes', true))));?>
		<li><?php e($html->link(__('View All Tags', true), array('controller'=> 'tags', 'action'=>'tagcloud'), array('class'=>'topNav', 'id'=>'viewTags', 'title'=>__('View All Tags', true))));?>
		<li><?php e($html->link(__('Help', true), array('controller'=> 'pages', 'action'=>'display', 'help'), array('class'=>'topNav', 'id'=>'viewHelp', 'title'=>__('Help', true))));?>
	</ul>
</div>

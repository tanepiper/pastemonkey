				<ul>
					<li><?php e($html->link(__('New Paste',true), array('controller'=> 'pastes', 'action'=>'add'), array('class'=>'ajaxLink nav-link', 'id'=>'newPaste')));?></li>
					<li><?php e($html->link(__('View All Pastes', true), array('controller'=> 'pastes', 'action'=>'index'), array('class'=>'ajaxLink nav-link')));?>
					<li><?php e($html->link(__('Pinboard', true), array('controller'=> 'pinboards', 'action'=>'index'), array('class'=>'ajaxLink nav-link')));?>
				</ul>

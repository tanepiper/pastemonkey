				<ul>
					<li><?php e($html->link(__('New Paste',true), array('controller'=> 'pastes', 'action'=>'add'), array('class'=>'nav-link')));?></li>
					<li><?php e($html->link(__('View All Pastes', true), array('controller'=> 'pastes', 'action'=>'index'), array('class'=>'nav-link')));?>
					<li><?php e($html->link(__('Search',true), '#', array('class'=>'nav-link')));?></li>
				</ul>

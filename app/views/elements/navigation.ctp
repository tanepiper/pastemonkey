				<ul>
					<li><?php e($html->link(__('Home', true), SITE_URL, array('class'=>'home')));?>
					<li><?php e($html->link(__('New Paste',true), array('controller'=> 'pastes', 'action'=>'add'), array('class'=>'new-paste')));?></li>
					<li><?php e($html->link(__('Get Source Code',true), 'http://code.google.com/p/pastemonkey/'));?></li>
				</ul>

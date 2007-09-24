				<ul>
					<li><?php e($html->link(__('Home', true), SITE_URL, array('class'=>'home')));?>
					<li><?php e($html->link(__('New Paste',true), array('controller'=> 'pastes', 'action'=>'add'), array('class'=>'new-paste')));?></li>
				</ul>

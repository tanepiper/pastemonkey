<?php
/***
	*	Core Routes for Navigation
	***/

	Router::connect('/', array('controller' => 'pastes', 'action' => 'add'));
	Router::connect('/add/*', array('controller' => 'pastes', 'action' => 'add'));
	Router::connect('/paste/*', array('controller' => 'pastes', 'action' => 'view'));
	Router::connect('/news', array('controller' => 'pinboards', 'action' => 'index'));
	Router::connect('/all/*', array('controller' => 'pastes', 'action' => 'index'));
	Router::connect('/search/*', array('controller' => 'pastes', 'action' => 'search'));
	Router::connect('/help', array('controller' => 'pages', 'action' => 'display', 'help'));
	Router::connect('/tags', array('controller' => 'tags', 'action' => 'tagcloud'));
	Router::connect('/upload', array('controller' => 'pastes', 'action' => 'upload'));

/**
 * REST interfaces
**/	
	Router::mapResources('pastes');
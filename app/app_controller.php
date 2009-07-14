<?php

class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Javascript', 'Time', 'Text', 'Diff', 'Geshi', 'Pastemonkey');
	var $components = array('Session','RequestHandler', 'DebugKit.Toolbar');
	
	function beforeFilter()
	{
		$this->layout = "pastemonkey";
	}	
	
	function redirect($url, $status= null, $exit= true) {
		if ($this->RequestHandler->isAjax() || isset ($this->params['requested'])) {
			echo $this->requestAction(Router::url($url), array ('return'));
		} else {
			return parent :: redirect($url, $status,$exit);
		}
		if ($exit) {
			die();
		} else {
			return false;
		}
	}
}
?>

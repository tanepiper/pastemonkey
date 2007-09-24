<?php

class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Javascript', 'Time', 'Text');
	var $components = array('Session','RequestHandler', 'Geshi','Conf');
	
	function beforeFilter()
	{
  		$this->Conf->startup(&$this);
		$this->set('pm_sitename', $this->Conf->get('app.basics','Paste Monkey', true, true)); 
	} 
	
}
?>
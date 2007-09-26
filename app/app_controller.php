<?php

class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Javascript', 'Time', 'Text', 'Diff');
	var $components = array('Session','RequestHandler','Conf');
	
	function beforeFilter()
	{
		$this->layout = "default2";
  		$this->Conf->startup(&$this);
		$this->set('pm_sitename', $this->Conf->get('app.basics','Paste Monkey', true, true)); 
	} 
	
}
?>
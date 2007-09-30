<?php

class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Javascript', 'Time', 'Text', 'Diff', 'Geshi', 'Pastemonkey',
						 'Recaptcha');
	var $components = array('Session','RequestHandler','Conf');
	
	function beforeFilter()
	{
		$this->layout = "default";
  		$this->Conf->startup(&$this);
		$this->set('pm_sitename', $this->Conf->get('app.sitename','Paste Monkey', true, true)); 
		$this->set('pm_siteurl', $this->Conf->get('app.siteurl','http://pastemonkey.digitalspaghetti.me.uk', true, true)); 
	} 
	
}
?>

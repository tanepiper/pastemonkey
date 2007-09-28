<?php

class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Javascript', 'Time', 'Text', 'Diff', 'Geshi');
	var $components = array('Session','RequestHandler','Conf','Auth');
	
	function beforeFilter()
	{
		$this->layout = "default2";
  		$this->Conf->startup(&$this);
		$this->set('pm_sitename', $this->Conf->get('app.sitename','Paste Monkey', true, true)); 
		$this->set('pm_siteurl', $this->Conf->get('app.siteurl','http://pastemonkey.digitalspaghetti.me.uk', true, true)); 
		
		$this->Auth->fields = array('username' => 'email', 'password' => 'passwd');
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'pastes', 'action' => 'add');
		$this->Auth->logoutRedirect = array('controller' => 'pastes', 'action' => 'add');
		$this->Auth->loginError = 'Invalid e-mail / password combination.  Please try again';
		$this->Auth->autoRedirect = false;
	} 
	
}
?>

<?php

class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Javascript', 'Time', 'Text', 'Diff', 'Geshi', 'Pastemonkey');
	var $components = array('Session','RequestHandler','Conf'/*, 'Auth'*/);
	
	function beforeFilter()
	{
		$this->layout = "default";
  		$this->Conf->startup(&$this);
		$this->set('pm_sitename', $this->Conf->get('app.sitename','Paste Monkey', true, true)); 
		$this->set('pm_siteurl', $this->Conf->get('app.siteurl','http://pastemonkey.org', true, true));
		
		$this->Auth->fields = array('username' => 'email', 'password' => 'passwd');
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'pastes', 'action' => 'add');
		$this->Auth->logoutRedirect = '/';
		$this->Auth->loginError = 'Invalid e-mail / password combination.  Please try again';
		$this->Auth->autoRedirect = false;
		$this->Auth->authorize = 'controller'; 
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

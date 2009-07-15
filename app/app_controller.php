<?php

/**
 * The AppController provides application level access to helpers and components
 * as well as override the beforeFilter and redirect of every page
 * @package pastemonkey
 * @author Tane Piper <pastemonkey@ifies.org>
 * @name app_controller.php
 * @version 0.6
 * @var $AppController
 *
 */
class AppController extends Controller {
	
	/**
	 * The AppController var for autocomplete
	 * @var $AppController
	 */
	var $AppController;
	
	/**
	 * The Helpers used throughout the application
	 * @var $helpers
	 */
	var $helpers = array('Html', 'Form', 'Javascript', 'Time', 'Text', 'Diff', 'Geshi', 'Pastemonkey');
	
	/**
	 * The components used throughout the application
	 * @var $components
	 */
	var $components = array('Session','RequestHandler', 'DebugKit.Toolbar');
	
	/**
	 * The global beforeFilter override
	 * Here we import the Sanitize utility and set the theme for output
	 */
	function beforeFilter() {
	  App::import('Sanitize');
		$this->layout = Configure::read('Site.theme');
	}	
	
	/**
	 * The global redirect override
	 * Here, we check to see if the request is ajax and if so, we handle objects
	 * though the Ajax router, otherwise we output standard HTML
	 */
	function redirect($url, $status=null, $exit=true) {
		if ($this->RequestHandler->isAjax() || isset ($this->params['requested'])) {
			echo $this->requestAction(Router::url($url), array ('return'));
		} else {
			return parent::redirect($url, $status,$exit);
		}
		if ($exit) {
			die();
		} else {
			return false;
		}
	}
}
?>
<?php

class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Javascript', 'Time', 'Text');
	var $components = array('Session','RequestHandler', 'Geshi');
}
?>
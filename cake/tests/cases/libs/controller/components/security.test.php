<?php
/* SVN FILE: $Id: security.test.php 5768 2007-10-16 09:05:25Z phpnut $ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <https://trac.cakephp.org/wiki/Developement/TestSuite>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package			cake.tests
 * @subpackage		cake.tests.cases.libs.controller.components
 * @since			CakePHP(tm) v 1.2.0.5435
 * @version			$Revision: 5768 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-10-16 10:05:25 +0100 (Tue, 16 Oct 2007) $
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
uses('controller' . DS . 'components' . DS .'security');

/**
* Short description for class.
*
* @package		cake.tests
* @subpackage	cake.tests.cases.libs.controller.components
*/
class SecurityTestController extends Controller {
	var $name = 'SecurityTest';
	var $components = array('Security');

	function redirect($option, $code, $exit) {
		return $code;
	}
}

/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.cases.libs.controller.components
 */
class SecurityComponentTest extends CakeTestCase {

	function setUp() {
		$this->Controller =& new SecurityTestController();
		restore_error_handler();
		@$this->Controller->_initComponents();
		set_error_handler('simpleTestErrorHandler');
	}

	function testStartup() {
		$this->Controller->Security->startup($this->Controller);
		$result = $this->Controller->params['_Token']['key'];
		$this->assertNotNull($result);
		$this->assertTrue($this->Controller->Session->check('_Token'));
	}

	function testValidatePostSimple() {
		$this->Controller->Security->startup($this->Controller);
		$key = $this->Controller->params['_Token']['key'];

		$data['Model']['username'] = '';
		$data['Model']['password'] = '';
		$data['__Token']['key'] = $key;

		$fields = array('Model' => array('username','password'),
						'__Token' => array('key' => $key));

		$fields = $this->__sortFields($fields);

		$fields = urlencode(Security::hash(serialize($fields) . Configure::read('Security.salt')));
		$data['__Token']['fields'] = $fields;
		$this->Controller->data = $data;
		$result = $this->Controller->Security->__validatePost($this->Controller);
		$this->assertTrue($result);
	}

	function testValidatePostCheckbox() {

		$this->Controller->Security->startup($this->Controller);
		$key = $this->Controller->params['_Token']['key'];

		$data['Model']['username'] = '';
		$data['Model']['password'] = '';
		$data['_Model']['valid'] = '0';
		$data['__Token']['key'] = $key;

		$fields = array('Model' => array('username', 'password', 'valid'),
						'_Model' => array('valid' => '0'),
						'__Token' => array('key' => $key));

		$fields = $this->__sortFields($fields);

		$fields = urlencode(Security::hash(serialize($fields) . Configure::read('Security.salt')));
		$data['__Token']['fields'] = $fields;

		$this->Controller->data = $data;
		$result = $this->Controller->Security->__validatePost($this->Controller);
		$this->assertTrue($result);
	}

	function testValidatePostHidden() {
		$this->Controller->Security->startup($this->Controller);
		$key = $this->Controller->params['_Token']['key'];

		$data['Model']['username'] = '';
		$data['Model']['password'] = '';
		$data['_Model']['hidden'] = '0';
		$data['__Token']['key'] = $key;

		$fields = array('Model' => array('username', 'password', 'hidden'),
						'_Model' => array('hidden' => '0'),
						'__Token' => array('key' => $key));

		$fields = $this->__sortFields($fields);

		$fields = urlencode(Security::hash(serialize($fields) . Configure::read('Security.salt')));
		$data['__Token']['fields'] = $fields;

		$this->Controller->data = $data;
		$result = $this->Controller->Security->__validatePost($this->Controller);
		$this->assertTrue($result);
	}

	function testValidateHiddenMultipleModel() {
		$this->Controller->Security->startup($this->Controller);
		$key = $this->Controller->params['_Token']['key'];

		$data['Model']['username'] = '';
		$data['Model']['password'] = '';
		$data['_Model']['valid'] = '0';
		$data['_Model2']['valid'] = '0';
		$data['_Model3']['valid'] = '0';
		$data['__Token']['key'] = $key;

		$fields = array('Model' => array('username', 'password', 'valid'),
						'Model2'=> array('valid'),
						'Model3'=> array('valid'),
						'_Model2'=> array('valid' => '0'),
						'_Model3'=> array('valid' => '0'),
						'_Model' => array('valid' => '0'),
						'__Token' => array('key' => $key));

		$fields = $this->__sortFields($fields);

		$fields = urlencode(Security::hash(serialize($fields) . Configure::read('Security.salt')));
		$data['__Token']['fields'] = $fields;

		$this->Controller->data = $data;
		$result = $this->Controller->Security->__validatePost($this->Controller);
		$this->assertTrue($result);
	}

	function __sortFields($fields) {
		foreach ($fields as $key => $value) {
			if(strpos($key, '_') !== 0) {
				sort($fields[$key]);
			}
		}
		ksort($fields);
		return $fields;
	}
}
?>